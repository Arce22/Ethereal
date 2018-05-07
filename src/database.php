<?php
$server = 'mysql7002.site4now.net';
$username = 'lab3ftst';
$password = 'Mehin12345';
$database = 'lab3ftst_ethereal';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}

?>