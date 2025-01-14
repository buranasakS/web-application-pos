<?php
 
//MySQLi Procedural
$db = mysqli_connect('localhost', 'root', '', 'hardware_store');
if (!$db) {
	die("Connection failed: " . mysqli_connect_error());
}
 
?>