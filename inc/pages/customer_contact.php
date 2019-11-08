<?php
session_start();
require 'inc/connection/connect.php';



date_default_timezone_set("Asia/Karachi");
$timestamp = date('d/m/Y-h:i:s a', time());
$splitTimeStamp = explode("-",$timestamp);
$date = $splitTimeStamp[0];
$time = $splitTimeStamp[1];


$name=$_GET['name'];
$gender=$_GET['gender'];
$email=$_GET['email'];
$phone=$_GET['contact'];
$request_status="pending";

$check = $conn->prepare("INSERT INTO customers_contact(name, gender, email, phone, date, time, request_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
$check->bind_param("sssssss", $name, $gender, $email, $phone, $date, $time, $request_status);
$check->execute();

echo "1";

?>
