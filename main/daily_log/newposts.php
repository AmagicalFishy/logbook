<?php
include "../../common/info.inc";

$logbook = $_GET["log"];
$connection = new PDO($dbinfo, $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!EMPTY($_POST["crossout_entry_number"]) == false){
    $NCTS = False; #Flag for manually entering a time stamp
    $post_contents = nl2br($_POST["post_contents"]);
    $poster_name = $_POST["poster_name"];

    #Process and Combine Timestamps (kind of messy)
    if (!EMPTY($_POST["big_timestamp"]) == false){
        $big_timestamp = date("Y-m-d");
    }   
    else {
        $big_timestamp = $_POST["big_timestamp"];
        $NCTS = True;
    }
    if (!EMPTY($_POST["small_timestamp"]) == false){
        $small_timestamp = date("G:i:s");
    }
    else {
        $small_timestamp = $_POST["small_timestamp"];
        $NCTS = True;
    }
    if ($NCTS == True){
        $post_contents = $post_contents . "<i><br>**This timestamp was manually entered on " . date('Y-m-d, H:i:s') . "**</i>";
    }
    $timestamp = $big_timestamp ." ". $small_timestamp;

    #Deals with uploaded files
    $filenames = array();
    $contain_file = False;
    for ($i = 1; $i <= 7; ++$i){
        if (!EMPTY($_FILES["file" . $i]["name"]) == True){
            $contain_file = True;
            $file = $_FILES["file" . $i];
            if (file_exists("uploads/".$_GET["log"]."/".$file["name"])){
                $_SESSION["duplicate"] = $file["name"];
            }
            else{
                array_push($filenames, $file["name"]);
                move_uploaded_file($file["tmp_name"], "uploads/".$_GET["log"]."/".$file["name"]);
            }
        }
    }
    if ($contain_file == True){
        $filenames = serialize($filenames);
    }
    elseif ($contain_file == False){
        $filenames = NULL;
    }
    
    #Actually adds the post and relevant information.
    $add_post = $connection->prepare("INSERT INTO $logbook (time, username, message, filenames) VALUES(:time, :name, :message, :filenames)");
    $add_post->bindParam(":time", $timestamp);
    $add_post->bindParam(":name", $poster_name);
    $add_post->bindParam(":message", $post_contents);
    $add_post->bindParam(":filenames", $filenames);
    $add_post->execute();
}

#Crossout posts if the "Cross Out" button was pressed
else {
    $crossout_entry_number = $_POST["crossout_entry_number"];
    $crossout_post = $connection->prepare("UPDATE $logbook SET crossout = 1 WHERE post_id = $crossout_entry_number");
    $crossout_post->execute();

    # Return user to date of post's crossing out (02.23.2016)
    $getDate = $connection->prepare("SELECT time from $logbook
        WHERE post_id = $crossout_entry_number");
    $getDate->execute();
    $date = $getDate->fetchAll();
    $crossoutDate = date('Y-m-d', strtotime($date[0][0]));
    $big_timestamp = $crossoutDate;
}
?>

<script>
var logname = "<?php echo $_GET["log"]; ?>";
var timestamp = <?php echo json_encode($big_timestamp); ?>;
window.location.replace("viewposts.php?log=" + logname + "&begdate=" + timestamp + "&endate=" + timestamp
    + "&filters=Calendar");
</script>
