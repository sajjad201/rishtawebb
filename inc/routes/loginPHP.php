<?php
session_start();
require '../connection/connect.php';

$checkEmail=$_GET["email"];
$emailQuery=mysqli_query($conn, " select *  from login where userName='$checkEmail' ");
if(mysqli_num_rows($emailQuery) == 0 )
{
	echo "0";
}
else if( mysqli_num_rows($emailQuery) == 1 )
{	
	echo "1";
}
	
?>

