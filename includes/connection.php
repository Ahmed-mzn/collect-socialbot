<?php

$servername = "localhost";
$db = "boot";
$username = "root";
$password = "1234";

try {
	$connect = new PDO("mysql:host=$servername;dbname=$db", $username, $password);

  	// set the PDO error mode to exception
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}
?>