<html>
<body>
<?php
$log = $_GET["log"];
$post_id = $_GET["post_id"];
$username = $_GET["username"];
$begdate = $_GET["begdate"];
$endate = $_GET["endate"];
$search_string = $_GET["search_string"];
$filters = $_GET["filters"];

if (is_numeric($post_id) == False AND !EMPTY($post_id)){
    $good_to_go = False;
    echo "<br><br><br><center><font size=5>Post ID must be a number.</font>";
    echo "<br><br>You will be redirected to your previous page in 3 seconds</center>";
    echo "<script type='text/javascript'>setTimeout(function(){history.back()}, 3000);</script>";
}
else{
    $good_to_go = True;
    echo "<br><br><br><center>Searching...</center>";
}
?>

<form id="inbetween" name="inbetween" method = "GET" action=<?php echo "/logbook/main/daily_log/viewposts.php?log=" . $_GET["log"]; ?>>
<input type="hidden" name="username" value ="<?php echo $username; ?>">
<input type="hidden" name="post_id" value = "<?php echo $post_id; ?>">
<input type="hidden" name="begdate" value = "<?php echo $begdate; ?>">
<input type="hidden" name="endate" value = "<?php echo $endate; ?>">
<input type="hidden" name="search_string" value = "<?php echo $search_string; ?>">
<input type="hidden" name="filters" value = "<?php echo $filters; ?>">
<input type="hidden" name="log" value = "<?php echo $log; ?>">
</form>
</body>

<?php
if ($good_to_go == True){
    echo "<script type='text/javascript'>setTimeout(function(){document.inbetween.submit()},1000);</script>";
}
?>
