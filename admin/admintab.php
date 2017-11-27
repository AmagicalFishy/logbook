<html>
<head>
<title>Administration Functions</title>
</head>
</html>

<?php
$connection = new PDO("mysql:host=localhost;dbname=logbook", $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<br>
Create New Logbook: 
<br><br>
<form action="/logbook/index.php?page=adminfunctions" method="POST">
    <input name="new_logbook" type="text" name="text" placeholder='New Logbook Name' maxlength=20>
    <input type="submit" value="Create">
</form>

<b>Active Logbooks:</b> 
<br>
<br>

<table>

<tr>
<th>Logbook Name</th>
<th>Make Inactive?</th>
</tr>

<?php
$query = $connection->prepare('SELECT * FROM logbooks WHERE active = 1');
$query->execute();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr><td>' . $row['title'] . '</td>';
    echo '<td><form action="/logbok/index.php?page=adminfunctions" method="POST">';
    echo '<input name="deactivate" type="submit" value="Make Inactive"></td>';
    echo '</tr>';
}
?>

</table>


<br>
<br>
<b>Inactive Logbooks:</b>

<?php
    $query = $connection->prepare('SELECT title, table_name FROM logbooks WHERE active = 0');
    $query->execute();
    while ($titles = $query->fetch(PDO::FETCH_ASSOC)) {
        echo $titles['title'] . "<br>";
    }
?>

