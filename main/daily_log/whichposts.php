<?php 
#Sets up information for post filters
#Using two-dimensional (nested) arrays

$filter_array = array(
    $filter_postnum = array("post_id = ", "post_id"),
    $filter_user = array("username = '", "username", "'"),
    $filter_begdate = array("time >='", "begdate", " 00:00:00'"),
    $filter_endate = array("time <='", "endate", " 23:59:59'"),
    $filter_string = array("message LIKE '%", "search_string", "%'")
);

#Preparation of Query In Case of Filters
$query_string = array("SELECT * FROM " . $_GET["log"]);
$filter_flag = False;
for ($i = 0; $i <= 4; ++$i) {
    if (!EMPTY($_GET[$filter_array[$i][1]]) == True) {          # If the i'th filter is NOT empty
        if ($filter_flag == False){                             # If no filters have been registered
            array_push($query_string, " WHERE ");               # Add this filter to the query
            $filter_array[$i][1] = $_GET[$filter_array[$i][1]];
            array_push($query_string, implode($filter_array[$i]));
            $filter_flag = True;
        }
        elseif ($filter_flag == True){  # If a filter has been registered, add other filters with AND
            $filter_array[$i][1] = $_GET[$filter_array[$i][1]];
            array_push($query_string, " AND " . implode($filter_array[$i]));
        }
    }
}

#Use today's posts if there are no filters
if (EMPTY($_GET["filters"])){
    $filter_array[2][1] = date("Y-m-d");
    $filter_array[3][1] = date("Y-m-d"); 
    array_push($query_string, " WHERE " . implode($filter_array[2]) . " AND " . implode($filter_array[3]));
}

#This is the final string which sends the query
#fetching all the posts determined by the filters
$query_string = implode($query_string);

#Prints out the table of posts
$connection = new PDO($dbinfo,$username,$password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$get_posts = $connection->prepare($query_string);
$get_posts->execute();

while ($row = $get_posts->fetch(PDO::FETCH_ASSOC)){
    #For crossing out posts
    $co = "";
    if ($row["crossout"] == 1){
        $co = "<del>";
    }

    #Actually displays post
    echo    "<tr><td>" .$co. $row["post_id"].
            "<td>" .$co. $row["time"].
            "<td>" .$co. $row["username"].
            "<td>" .$co. $row["message"];
    
    #Deals w/ displaying uploaded files
    if (ISSET($row["filenames"]) == True){
        echo "<br><br>Attachments: ";
        $filenames = unserialize($row["filenames"]); 
        #Displays a text-link or a thumbnail 
        foreach ($filenames as $filename){
            $is_image = exif_imagetype(__DIR__ . "/uploads/" . $_GET["log"] . "/" . $filename);
            $file_loc = '/logbook/main/daily_log/uploads/' . $_GET['log'] . '/' . $filename;

            if ($is_image){
                echo "<a href = '" . $file_loc . "'> <img src='" . $file_loc . "' height='150' width='250'></a>";
            }
            else {
                echo "<a href='" . $file_loc . "'>" .$filename. "</a> &nbsp";
            }
        }
    }
}
?> 
