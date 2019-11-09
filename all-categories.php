<?php
session_start();
require 'inc/connection/connect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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


        <!-- caste -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by caste in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select name from caste limit 24");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="#"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
                <div class="all-cat-div-view-al">
                    <a href="single-category?name=caste">View All Castes</a>
                </div>
            </div>
        </div>
        
        <!-- city -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by city in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select name from city limit 24");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="#"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
                <div class="all-cat-div-view-al">
                    <a href="single-category?name=city">View All City</a>
                </div>
            </div>
        </div>

        <!-- religion -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by religion in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select name from religion limit 24");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="#"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
                <div class="all-cat-div-view-al">
                    <a href="single-category?name=religion">View All Religion</a>
                </div>
            </div>
        </div>

        <!-- profession -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by profession in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select name from profession limit 24");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="#"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
                <div class="all-cat-div-view-al">
                    <a href="single-category?name=profession">View All Profession</a>
                </div>
            </div>
        </div>

        <!-- country -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by country in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select name from country limit 24");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="#"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
                <div class="all-cat-div-view-al">
                    <a href="single-category?name=country">View All country</a>
                </div>
            </div>
        </div>

        <!-- province -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by province in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select name from province limit 24");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="#"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
                <div class="all-cat-div-view-al">
                    <a href="single-category?name=province">View All province</a>
                </div>
            </div>
        </div>

        <!-- language -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by language in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select name from language limit 24");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="#"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
                <div class="all-cat-div-view-al">
                    <a href="single-category?name=language">View All language</a>
                </div>
            </div>
        </div>

        
        
        
    </div>
</section>

<!-- footer -->
<?php include('inc/pages/footer.php');?>

</body>
</html>