<?php
session_start();
require 'connect.php';

echo $id=$_POST['id'];

if(isset($_POST["approve_button"])){
	echo $approve="approved";
	mysqli_query($con, "UPDATE signup SET approve = '$approve' WHERE id ='$id' ");
}
else{
	echo $declined="declined";
	mysqli_query($con, "UPDATE signup SET approve = '$declined' WHERE id ='$id' ");
}
header("Location: admin.php");
?>