<?php
session_start();
require '../connection/connect.php';

function test_input($data){
	global $conn;
	$data=trim($data);
	$data=stripslashes($data);
	$data=htmlspecialchars($data);
	$data=mysqli_real_escape_string($conn, $data);
	$data=str_replace("'", "", $data);
	$data=str_replace("`", "", $data);
	$data=str_replace("''", "", $data);
	$data=str_replace(";", "", $data);
	return $data;
}

date_default_timezone_set("Asia/Karachi");
$timestamp = date('d/m/Y-h:i:s a', time());
$splitTimeStamp = explode("-",$timestamp);
$date = $splitTimeStamp[0];
$time = $splitTimeStamp[1];


if(isset($_GET["fromId"]))
{
	$nullID=NULL;
	$unread='unread';
	$fromId=test_input($_GET["fromId"]);
	$shortMessage=test_input($_GET["shortMessage"]);
	$toId=test_input($_GET["toId"]);
	$check = $conn->prepare("insert into chatdetails values (?, ?, ?, ?, ?, ?, ?)");
	$check->bind_param("sssssss", $nullID, $fromId, $shortMessage, $toId, $unread, $date, $time);
	$check->execute();
	$check->close();
	
	$result1=mysqli_query($conn, "select * from signup where id=$fromId ");
	$fromRow = mysqli_fetch_assoc($result1);
	$id=$fromRow['id'];
	$firstName=$fromRow['firstName'];
	$lastName=$fromRow['lastName'];
	
	$result2=mysqli_query($conn, "select * from signup where id=$toId ");
	$toRow = mysqli_fetch_assoc($result2);
	$getToEmail=$toRow['email'];
	
	$fromEmail="rishtawebteam@gmail.com";
	$shortMessage='You Recieved New Message From: <strong style="font-size:16px"> '.$firstName.' '.$lastName.'</strong> <br> Profile ID: <strong style="font-size:16px"> "'.$id.'" </strong> Please Visit RISHTAWEB.COM & Connect with Profile: <strong style="font-size:16px"> "'.$id.'" </strong>	';
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
	$headers .= "From: " . $fromEmail . "\r\n" .
	"Reply-To: " . $fromEmail . "\r\n" .
	"X-Mailer: PHP/" . phpversion();
	
	mail($getToEmail, "New Message | RISHTAWEB", $shortMessage, $headers  ); 
}						  	
?>

<a href=""></a>
