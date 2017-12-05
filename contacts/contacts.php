<html>
<head>
<title>Contacts</title>
<link rel="stylesheet" href="../common/style.css">
</div>
</head>

<body>
<!-- Creation of Table w/ User Info --!>
<div id="main" align="center">
<h1>Directory</h1>
<i>To change a user's details, click on their name.</i>

<table border=1 frame=1 cellpadding=1 cellspacing=2 width=100%>
<tr>
<td><b>Name</b>
<td><b>E-mail Address</b>
<td><b>Alt. E-mail Address</b>
<td><b>Phone (Cell)</b>
<td><b>Phone (Other)</b>

<!--Get users from database and place in table-->
<?php
$connection = new PDO("mysql:host=localhost;dbname=logbook", $username, $password);
$query = $connection->prepare("SELECT * FROM contacts ORDER BY name ASC");
try { $query->execute(); }
catch (PDOEXception $E) { echo $e->getMessage(); }

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td><a href=/logbook/index.php?page=edit_contact&name_id=" .$row["name_id"]. ">" .$row["name"]. 
    "<td>" .$row["email"]. "<td>" .$row["email2"]. "<td>" .$row["phone"]. "<td>" .$row["phone2"];
    }
?>

</table>

<!--Add/Delete Form-->
<form name="adduser" style="display:inline;" action=/logbook/index.php?page=add_contact method="POST"><br>
    Add/Delete Contact <input type="text" name="entered_name">
    Add <input type="radio" name="add_user" value=1 checked='checked'>
    Remove <input type="radio" name="add_user" value=0>
<input type="submit" value="Submit">
</form>
</body>
</html>
