<?php
session_start();
?>

<!-- Password Form -->
<html>
<body>
<center>
<br><br><br><br><br><br><br>
Please enter the logbook password for your lab:
<br><br>
<form method=POST action="/logbook/index.php?page=home">
Password: <input type="password" name="password"> 
<button type="submit">Submit Password</value> <br>
</form>
</html>
