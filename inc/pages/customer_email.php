<?php
session_start();
require 'inc/connection/connect.php';

$checkEmail=$_GET["email"];
$emailQuery=mysqli_query($conn, "select *  from customers_contact where email='$checkEmail' ");
if(mysqli_num_rows($emailQuery) == 0 )
{
	echo "0";
}
else if( mysqli_num_rows($emailQuery) >= 1 )
{	
	echo "1";
}
	
?>

