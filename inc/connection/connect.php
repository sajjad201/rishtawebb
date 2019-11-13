<?php
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + (60 * 60 * 24))); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rishtawebchat";
global $conn;
$conn = new mysqli($servername, $username, $password, $dbname);
global $con;
$con = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

?>