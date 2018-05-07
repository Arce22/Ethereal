<?php

session_start();
require 'database.php';

?>

<!DOCTYPE html>
<html>
<style>
body {
    background-color: lightblue;
}

h1 {
    color: white;
    text-align: center;
}
p {
    font-family: verdana;
    font-size: 20px;
}
th,td {
    border: 1px solid black;
	   padding: 15px;
}
.btn_name{
    margin-right:10px;
	margin-left:10px;
}
</style>
<head>
	<title>Ethereal</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>
	<h1>Welcome to Ethereal</h1>
	<h1>CS 353 Project</h1>
	<td><a href="company.php"><button type="button" style="float: right;" class="btn_name">Company</button></td>
	<td><a href="player.php"><button type="button" style="float: right;" class="btn_name">Player</button></td>
	<td><a href="admin.php"><button type="button" style="float: right;" class="btn_name">Admin</button></td>
</body>
</html>