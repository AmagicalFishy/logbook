<!-- Session Starter & DB Info  -->
<?php 
include "../../common/info.inc"; ?>

<html>
<!--Javascript functions to show additional uploads, to 
alert user when uploaded file title is a duplicate, and
to ensure that required forms are filled out-->
<script>
function validateForm(){
    var req_name = document.forms["newpostform"]["poster_name"].value;
    var req_message = document.forms["newpostform"]["post_contents"].value;
    if (req_name == null || req_name == "" || req_message == null || req_message == ""){
	alert("Name and Message are required forms and must be filled.");
        return false;
    }
}

function additional_uploads() {
    var table = document.getElementById("forms_table");
    for (i = 2; i <= 4; i++){
        for (j = 0; j <= 1; j++){
            var new_upload_field = table.rows[i].cells[j];
            var num = 3*j + i
            var html = "File " + num + ": &nbsp";
            html += "<input type='file' name='file" + num + "' value='Choose File'>" ;
            new_upload_field.innerHTML = html;
        }
    }
}

function file_duplicate(name){
    document.getElementById("file_duplicate").innerHTML = "<font color=red>A file with the name '" + name + "' already exists in this logbook. File was not uploaded.</font>"
}
</script>

<head>
<title>Daily Logbook</title>
<link rel="stylesheet" href="../../common/style.css">

<?php 
include "../../common/navigation.php";

#Alerts user if file uploaded had duplicate title
echo "<center><p id='file_duplicate' name='file_duplicate'></p></center>";

if (!EMPTY($_SESSION["duplicate"])){
    echo "<script>file_duplicate('".$_SESSION["duplicate"]."');</script>";
    $_SESSION["duplicate"] = "";
}

#Deals with arrows moving forward/back a day. 
if (ISSET($_GET["begdate"])){
    $forward_arrow = date("Y-m-d",strtotime($_GET["begdate"] . "+1 day"));
    $backward_arrow = date("Y-m-d",strtotime($_GET["begdate"] . "-1 day"));

}
else{
    $forward_arrow = date("Y-m-d", strtotime(date("Y-m-d") . "+1 day"));
    $backward_arrow = date("Y-m-d", strtotime(date("Y-m-d") . "-1 day"));
}

echo "<center><div id='daylog_title'>";
#Backward Arrow
echo "<form method='GET'>";
echo "<input type='hidden' name='filters' value='Calendar'>";
echo "<input type='hidden' name='begdate' value=$backward_arrow . '00:00:00'>";
echo "<input type='hidden' name='endate' value=$backward_arrow . '23:59:59'>";
echo "<input type='hidden' name='log' value=" . $_GET['log'] . ">";
echo "<input type='image' src='../arrow_left.gif' alt='Submit'>";
echo "</form>";

$query = $connection->prepare('SELECT title FROM logbooks WHERE table_name = :title');
$query->bindParam(':title', $_GET["log"]);
$query->execute();
$logbook_title = $query->fetch(PDO::FETCH_ASSOC);
echo "<font size='6.5'> " . $logbook_title['title'] . " </font>";

#Forward Arrow
echo "<form method='GET'>";
echo "<input type='hidden' name='filters' value='Calendar'>";
echo "<input type='hidden' name='begdate' value=$forward_arrow . '00:00:00'>";
echo "<input type='hidden' name='endate' value=$forward_arrow . '23:59:59'>";
echo "<input type='hidden' name='log' value=" . $_GET['log'] . ">";
echo "<input type='image' src='../arrow_right.gif'>";
echo "</form>";
echo "</div>";

#Generate subtitle based on filters
echo "<font size='5'>Posts ";

if (!EMPTY($_GET["filters"])){
    $filters = $_GET["filters"];
}
else{
    $filters = "None";
}

if ($filters == "Search"){
    $countdown = 5;

    if (!EMPTY($_GET["begdate"])){
        echo "after <b>" . $_GET["begdate"] . "</b> ";
        --$countdown;
    }
    if (!EMPTY($_GET["endate"])){
        echo "through <b>" . $_GET["endate"] . "</b> ";
        --$countdown;
    }
    if (!EMPTY($_GET["post_id"])){
        echo "with entry #<b>" . $_GET["post_id"] . "</b> ";
        --$countdown;
    }
    if (!EMPTY($_GET["username"])){
        echo "written by<b> " . $_GET["username"] . "</b> ";
        --$countdown;
    }
    if (!EMPTY($_GET["search_string"])){
        echo "containing<b> " . $_GET["search_string"] . "</b> ";
        --$countdown;
    }
    if ($countdown == 5){
        echo "for <b>All</b> Dates</B>";
}
    
    echo "<br><font size = 3><a href=viewposts.php?log=" . $_GET["log"] . ">Remove Filters</a></font>";
}

elseif ($filters == 'Calendar'){
    if (strtotime($_GET["begdate"]) == strtotime(date("Y-m-d"))){
        $date = "Today, " . date("Y-m-d");
    }
    else{
        $date = date("M. d, Y", strtotime($_GET["begdate"]));
    }
    
    echo "from <b>" . $date . "</b><br></font>";
}

else{
    echo "from <b>Today, " . date("Y-m-d") . "</b> ";
}

echo "</font>";
 
?>
</head>

<body>
<br>
<br>
<center><a href = "../logbook_frontpage.php?month=0">Back to Calendar</a></center>

<!--Adds "Back to Today" button if date does not match today's date -->
<?php
    if (!EMPTY($_GET["begdate"]) & !EMPTY($_GET["endate"])){
        if ($_GET["begdate"] != date("Y-m-d") & $_GET["endate"] != date("Y-m-d")){ 
            echo "<center><a href = '../daily_log/viewposts.php?log=" . $_GET["log"] . "'>Back to Today</a></center>";
        }
    }
?>

<!--Actually generates the post tables-->
<div id="post_display">
<table>
<tr>
<td>Entry #
<td>Date/Time Posted
<td>Name
<td>Message

<?php include "whichposts.php"; ?>
</table>
</div>
<!---------------------------------------->
<br>

<HR width=75%>
<br>

<!--All the Forms:
I make heavy use of tables and whitespace to organize the
way forms are presented because I'm a bad person-->

<div id="post_form">

<center>
Message<font color="red">*</font>
<br>
<textarea 
    form="newpostform" name="post_contents" rows="7" placeholder="Enter your post here." required method="POST">
</textarea>
</center>
</div>
<br>

<div id="info_input">
<form id="newpostform" action=<?php echo "newposts.php?log=". $_GET["log"]; ?> method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
<table id="forms_table">
<tr>
<td>Name <font color="red">*</font> <input type="text" name="poster_name" required>
<td>Attach File <input type="file" name="file1" value="Choose File">


<tr>
<td>Non-Current Timestamp?  
    <input type="text" placeholder="YYYY-MM-DD" name="big_timestamp" size=10 maxlength="10">
    <input type="text" placeholder="HH:MM:SS" name="small_timestamp" size=8 maxlength="8">
<td>Attach More Files? <button type="button" onclick="additional_uploads()">+</button>

<!--- For Additional Uploads ------>
<tr>
<td>
<td>
<tr>
<td>
<td>
<tr>
<td>
<td>
<!-------------------------------->

<tr>
<td><br><font color="red">*Required</font>
<td>
<td>&nbsp &nbsp &nbsp <input type="submit" value="Submit"><br><font size="3" color="red">All posts are final.</font>
</table>
</div>
<HR width=75%>
</form>

<div id="info_input">
<form id="crossout" action=<?php echo "newposts.php?log=". $_GET["log"]; ?> method ="POST">
<table>
<tr>
<td>Cross Out Entry: <input type="text" placeholder="Entry #" name="crossout_entry_number" size=9>
<td>
<td><input type="submit" value="Cross Out">
</table>
</form>
</div>
<br>

<?php include "../search_filters.php" ?>

</body>

<!--Generates the Additional Uploads Fields-->
    
</html>
