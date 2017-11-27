<?php
if (!EMPTY($_POST["password"])){
	$_SESSION["password"] = $_POST["password"];
}
?>

<html>
<head>
<link rel="icon"
        href="../logbook/favicon.ico">

<title>Lab Logbook</title>
<link rel="stylesheet" href="../common/style.css">

<style>H1 {font-weight:100}
H1 {font-size:27pt; font-family: Georgia;}
H2 {font-weight:100; font-family: Georgia;}
H2 {font-size:16pt}
H3 {font-weight:600}
H3 {font-size:12pt; font-family: Georgia;}
H4 {font-weight:100}
H4 {font-size:10pt; font-family: Georgia; color: #990000}
H5 {font-weight:100}
H5 {font-size:1; font-family: Courier; color: #000000}
P {text-indent: 2.0em;}
</style>
</head>

<body>
<div id="wrap">
<div id="main" align="center">
<img src="/logbook/main/daily_log/uploads/home_image.jpg" vspace="30"  height="60%" width="45%" ></img>
<h2>Welcome to the Lab Logbook</h2>
<br>

</div>
</body>
</html>
