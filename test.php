<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rishtawebchat";
$conn = new mysqli($servername, $username, $password, $dbname);

$arr = array(


'Punjab',
'Khyber Pakhtunkhwa', 'Sindh',
'Balochistan', 'Gilgit Baltistan',
'Azad Jammu and Kashmir', 'Fata'

);

foreach($arr as $ar){

    $nullID=NULL;
    $value=$ar;
    $check = $conn->prepare("insert into province values (?, ?)");
    $check->bind_param("ss", $nullID, $value);
    $check->execute();
    $check->close();   
}


?>