<?php
// Start SQL session
if(!isset($_SESSION)) { 
    session_start(); 
} 
date_default_timezone_set("America/New_York");
$dbinfo = "mysql: host=127.0.0.1;dbname=logbook";
$username = "logbook";
$password = "logbook";

// If the logbook password isn't set, redirect to password screen
if ($_SESSION["password"] != "@lab-log@"){
	header("Location: /logbook/common/login.php");

echo "<link rel='icon' type='image/ico' href='/logbook/favicon.ico'>";
}

// Allows proper back-button function
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: post-check=0, pre-check=0",false);
session_cache_limiter("must-revalidate");
?>
