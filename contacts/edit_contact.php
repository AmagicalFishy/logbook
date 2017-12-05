<html>
<head>
<title>Edit Contact</title>
<link rel="stylesheet" href="../common/style.css">
</div>
</head>

<body>

<?php
$connection = new PDO("mysql:host=localhost;dbname=logbook", $username, $password);
$query = $connection->prepare("SELECT * FROM contacts WHERE name_id = :name_id");
$query->bindParam(":name_id", $_GET["name_id"], PDO::PARAM_INT);
$query->execute(); 
$contact_info = $query->fetch(PDO::FETCH_ASSOC);

?>


<!-- Creation of Table w/ User Info --!>
<div id="main" align="center">
<h1>Edit Contact</h1>

<table border=1 frame=1 cellpadding=1 cellspacing=2 width=33%>
<tr><td><b>Current</b> <td><b>Value</b></td><td><b>Change To</b>

<tr>
<td><?php echo $contact_info["name"]; ?>
<td>    Name: 
<td>    <form name="name_change" style="display:inline;" action = /logbook/index.php?page=contact_action method="POST">
        <input type="text" name="name_change">

<tr><td><?php echo $contact_info["email"]; ?>
<td>    E-Mail #1: 
<td>    <input type="text" name="email_change">

<tr><td><?php echo $contact_info["email2"]; ?>
<td>    E-Mail #2:
<td>    <input type="text" name="email2_change">

<tr><td><?php echo $contact_info["phone"]; ?>
<td>    Phone #1:
<td>    <input type="text" name="phone_change">

<tr><td><?php echo $contact_info["phone2"]; ?>
<td>    Phone #2:
<td>    <input type="text" name="phone2_change">
</table><br>
        <input type="hidden" name="name_id_ref" value= <?php echo $_GET["name_id"]; ?> >
        <button type="submit">Submit</button>
        </form>

</form>
</body>
</html>
