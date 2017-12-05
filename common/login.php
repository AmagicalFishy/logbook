<?php
session_start();

if (isset($_POST['password'])) {
    if ($_POST['password'] == "logbook") {
	    // Authentication successful - Set session
        $_SESSION['authenticated'] = 1;
        header('Location: /logbook/index.php?page=home');
        echo "Access granted!";
    }
    else {
        echo "ERROR: Incorrect or password!";
    }
}
?>

<!-- Password Form -->
<html>
<body>
<center>
<br><br><br><br><br><br><br>
Please enter the logbook password for your lab:
<br><br>
<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
Password: <input type="password" name="password"> 
<button type="submit">Submit Password</value> <br>
</form>
</html>
