<?php
session_start();
require '../connection/connect.php';
     
$firstPerson=$_SESSION["firstPersonId"];

$sql = "update chatdetails SET status = 'read' where status = 'unread' AND toID='$firstPerson'";
$conn->query($sql);

?>

