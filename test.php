<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rishtawebchat";
$conn = new mysqli($servername, $username, $password, $dbname);
$result=mysqli_query($conn, 'select * from caste');
while($r=mysqli_fetch_array($result)){
    $get=$r['name']." rishta in pakistan";
    $get=strtolower($get);
    $get=str_replace(' ', '-', $get);
    $sql="update caste set url= '".$get."' where name='".$r['name']."' ";
    mysqli_query($conn, $sql);
    
}
?>