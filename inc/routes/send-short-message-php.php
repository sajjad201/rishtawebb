<?php
session_start();
require '../connection/connect.php';

if(!isset($_SESSION["firstPersonId"]))
{
  header("Location: ../../");
}

$firstPerson=$_SESSION["firstPersonId"];
$emailNotAvailable=$msgSent="";

date_default_timezone_set("Asia/Karachi");
$timestamp = date('d/m/Y-h:i:s a', time());
$splitTimeStamp = explode("-",$timestamp);
$date = $splitTimeStamp[0];
$time = $splitTimeStamp[1];


if(isset($_GET["emailForMessage"]))
{
	$shortMessage=$_GET["shortMessage"];
	$chkThisMail=$_GET["emailForMessage"];
	
	$check = $conn->prepare("SELECT gender FROM signup WHERE id=?");
	$check->bind_param("s", $firstPerson);
	$check->execute();
	$check->bind_result($gender1);
	$check->fetch();
	$check->close();
	
	$check = $conn->prepare("SELECT gender FROM signup WHERE id=?");
	$check->bind_param("s", $chkThisMail);
	$check->execute();
	$check->bind_result($gender2);
	$check->fetch();
	$check->close();
	
	if($gender1  != $gender2)
	{
		$nullID=NULL;
		$unread='unread';
		$check = $conn->prepare("insert into chatdetails values (?, ?, ?, ?, ?, ?, ?)");
		$check->bind_param("sssssss", $nullID, $firstPerson, $shortMessage, $chkThisMail, $unread, $date, $time);
		$check->execute();
		$check->close();
	}
	else{echo "gender clash";}
	
	
	
}



?>
