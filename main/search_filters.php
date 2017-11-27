<!-- This is the form at the bottom of each page which takes
the various search options and adds them to the URL for GET 
processing.-->

<div id = "post_form">
<form id="search_filters" name="search_filters" method="GET" action="/logbook/main/search.php">

<center>
<table>
<tr>
<td style="border: 0;"><input type="submit" value="Search">
<td style="border: 0;"><select name="log" id="logname">


<?php
include "../common/info.inc";

$connection = new PDO($dbinfo, $username, $password); 
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $connection->prepare('SELECT title, table_name FROM logbooks');
$query->execute();

$ii = 0;
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $selected = '';
    if ($_GET['log'] == $row['table_name']){ $selected = 'selected';}
    echo '<option value="' . $row['table_name'] . '"' . $selected . '>' . $row['title'] . '</option>';
    $ii = $ii + 1;
}

?>

</select>

<td><input type="text" name="post_id" placeholder="Entry #" size="5" maxlength="5">
<td><input type="text" name="username" placeholder="Username" size="15">
<td><input type="text" name="begdate" placeholder="Posted After YYYY-MM-DD" size="21" maxlength="10">
<td><input type="text" name="endate" placeholder="Posted Before YYYY-MM-DD" size="21" maxlength="10">
<td><input type="text" name="search_string" placeholder="Containing...">
</table>
<input type="hidden" name="filters" value="Search">
</form>
</div>

