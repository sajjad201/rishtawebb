<?php @session_start(); 

header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + (60 * 60 * 24))); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rishtawebchat";
global $conn;
$conn = new mysqli($servername, $username, $password, $dbname);
global $con;
$con = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

$base_url="http://localhost/rishtawebb/"; 

?>
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-133484988-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-133484988-1');
</script>



<!-- meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="If you already have an account, login here and if don't just create your RISHATWEB Account and then login." />
<meta name="keywords" content="rishtaweb.com, rishtaweb, pakistani rishta free" />
<meta name="Author" content="RISHTAWEB.com" />
<meta name="copyright" content="RISHTAWEB.com" />
<meta name="Distribution" content="general" />
<meta name="robots" content="index, follow">

<!-- icon -->
<link rel="shortcut icon" href="../assets/allpics/rw8.png">

<!-- bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- fonts -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
<link href="https://fonts.googleapis.com/css?family=Raleway:500&display=swap" rel="stylesheet">
<!-- font-family: 'Raleway', sans-serif; -->

<!-- select2 -->
<script src="http://localhost/rishtawebb/assets/select2/select2popper.js"></script> 
<script src="http://localhost/rishtawebb/assets/select2/select2min.js"></script> 
<link rel="stylesheet" href="http://localhost/rishtawebb/assets/select2/select2.css"> 

<!-- local -->
<link rel="stylesheet" href="http://localhost/rishtawebb/assets/owl/docs/assets/owlcarousel/assets/owl.theme.default.css">
<link rel="stylesheet" href="http://localhost/rishtawebb/assets/owl/docs/assets/owlcarousel/assets/owl.carousel.min.css">
<link href="http://localhost/rishtawebb/assets/css/old.css" rel="stylesheet" />
<link href="http://localhost/rishtawebb/assets/css/style.css" rel="stylesheet" />



