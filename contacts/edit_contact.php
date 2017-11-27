<html>
<head>
<title>Edit Contact</title>
<link rel="stylesheet" href="../common/style.css">
<?php
include "../common/navigation.html";
include "../common/info.inc";
?>
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
<tr><td><b>Current</b> <td><b>Change To</b>

<tr>
<td><?php echo $contact_info["name"]; ?>
<td>    <form name="name_change" style="display:inline;" action = edit_process.php method="POST">
        <input type="text" name="name_change"> : Name

<tr><td><?php echo $contact_info["email"]; ?>
<td>    <input type="text" name="email_change"> : E-Mail

<tr><td><?php echo $contact_info["email2"]; ?>
<td>    <input type="text" name="email2_change"> : E-Mail #2

<tr><td><?php echo $contact_info["phone"]; ?>
<td>    <input type="text" name="phone_change"> : Phone

<tr><td><?php echo $contact_info["phone2"]; ?>
<td>    <input type="text" name="phone2_change"> : Phone #2
</table><br>
        <input type="hidden" name="name_id_ref" value= <?php echo $_GET["name_id"]; ?> >
        <button type="submit">Submit</button>
        </form>

</form>
</body>
</html>
