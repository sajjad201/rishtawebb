<?php 
session_start();
if (!isset($_SESSION["firstPersonId"]))
{
  echo "logout";
}
else
{
	$firstPerson=@$_SESSION["firstPersonId"];
	require $_SERVER['DOCUMENT_ROOT'].'/rishtawebb/inc/connection/connect.php'; 
	
	$sql1 = "select * from chatdetails where status = 'unread' and (fromID!='$firstPerson' && toID='$firstPerson') ";
	$result = $conn->query($sql1);
	$row = $result->fetch_assoc();
	$count = $result->num_rows;
	echo $count;
	$conn->close();
}

?>

