<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rishtawebchat";
$conn = new mysqli($servername, $username, $password, $dbname);

$result=mysqli_query($conn, 'select * from skincolor');
while($r=mysqli_fetch_array($result)){
    $get="skin color ".$r['name']." rishta in pakistan";
    $get=strtolower($get);
    $get=str_replace(' ', '-', $get);
    $sql="update skincolor set url= '".$get."' where name='".$r['name']."' ";
    mysqli_query($conn, $sql);
    
}


?>