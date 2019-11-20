<?php
session_start();
require 'inc/connection/connect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Free rishta in pakistan - Category: <?php echo $_GET['name']?></title>
    <meta name="description" content="Find rishta in category <?php echo $_GET['name']?>. Rishtaweb is free online website in pakistan to search rishta in your desired city, caste and religion and connect.">

    <?php include('inc/pages/links-one.php');?>


</head>
<body id="body">

<!-- navbar -->
<?php 
    if(isset($_SESSION["firstPersonId"])) {
        include('inc/pages/navbar-login.php');          // login navbar
    }
    else{
        include('inc/pages/navbar-index.php');         // guest navbar
    }
?>


<section class="all-cat all-cat">
    <div class="container">
        <div class="all-cat-div-main">
            <h1 class="all-cat-div-title single-cat-div-title ">
                find rishta by <b><?php echo $_GET['name']?> </b>in pakistan
            </h1>
            <div class="container-fluid">
                <div class="row">
                    <?php $name=$_GET['name'];
                    
                    $sql="select * from $name ";
                    $result=mysqli_query($conn, $sql);
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="../check-category/<?php echo $name?>/<?php echo $queryArray['url'];?>">
                                <div class="col-md-4 all-md-2 single-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}else{echo 'This category is not available. '; echo "<br><a href='../all-categories.php'>go back</a>";}?>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- footer -->
<?php include('inc/pages/footer.php');?>

</body>
</html>