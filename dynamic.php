<?php
if(isset($_GET['menu'])){
    $page = $_GET['menu'];
}


switch($page){
    case 'index':
        $title = ' welcome to myco.ltd------------';
        $content = 'index.php';
        break;
    case 'Awan-Rishta-In-Pakistan':
        $title = 'Awan Rishta In Pakistan';
        $content = 'category.php';
        break;
    case 'about':
        $title = 'get in touch-----------';
        $content = 'about.php';
        break;
}
?>
<html>
<head>
    <title><?php echo $title;?></title>
</head>
<body>

<?php include $content;?>

</body>
</html>