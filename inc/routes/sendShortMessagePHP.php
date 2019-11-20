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

$emailNotAvailable=$msgSent="";
$chkThisMail=test_input($_GET["emailForMessage"]);

$check = $conn->prepare("select userName  from login where id=? ");
$check->bind_param("s", $chkThisMail);
$check->execute();
$check->store_result();  
$numRows = $check->num_rows;

if($chkThisMail !="" && $numRows > 0)
{
	$result=mysqli_query($conn, "select * from signup where id='$chkThisMail' AND makeMeHide='show' limit 1");
	if(mysqli_num_rows( $result) > 0 )
	{
		echo "1";
	}
	else
	{
		echo "2";
	}
}
else
{	
	echo "0";
}

	
?>



