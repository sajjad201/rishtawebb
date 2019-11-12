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
                find rishta by <b>caste</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from caste limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/<?php echo $queryArray['url'];?>"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
                <div class="all-cat-div-view-al">
                    <a href="singlecategory/caste">View All Castes</a>
                </div>
            </div>
        </div>
        
        <!-- city -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by <b>city</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from city limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/<?php echo $queryArray['url'];?>"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
                <div class="all-cat-div-view-al">
                    <a href="singlecategory/city">View All City</a>
                </div>
            </div>
        </div>

        <!-- district -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by <b>district</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from district limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/<?php echo $queryArray['url'];?>"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
                <div class="all-cat-div-view-al">
                    <a href="singlecategory/district">View All district</a>
                </div>
            </div>
        </div>

        <!-- province -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by <b>province</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from province limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/<?php echo $queryArray['url'];?>"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
            </div>
        </div>

        <!-- country -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by <b>country</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from country limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/<?php echo $queryArray['url'];?>"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
                <div class="all-cat-div-view-al">
                    <a href="singlecategory/country">View All country</a>
                </div>
            </div>
        </div>

        <!-- religion -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by <b>religion</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from religion limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/<?php echo $queryArray['url'];?>"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
            </div>
        </div>

        <!-- profession -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by <b>profession</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from profession limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/<?php echo $queryArray['url'];?>"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
                <div class="all-cat-div-view-al">
                    <a href="singlecategory/profession">View All Profession</a>
                </div>
            </div>
        </div>

        <!-- language -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by <b>language</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from language limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/<?php echo $queryArray['url'];?>"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
                <div class="all-cat-div-view-al">
                    <a href="singlecategory/language">View All language</a>
                </div>
            </div>
        </div>

        <!-- clan -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by <b>clan</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from clan limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/<?php echo $queryArray['url'];?>"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
            </div>
        </div>

        <!-- education -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by <b>education</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from education limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/<?php echo $queryArray['url'];?>"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
            </div>
        </div>

        <!-- hobby -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by <b>hobby</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from hobby limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/<?php echo $queryArray['url'];?>"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
                <div class="all-cat-div-view-al">
                    <a href="singlecategory/hobby">View All hobby</a>
                </div>
            </div>
        </div>

        <!-- family type -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by <b>family type</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from familytype limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/<?php echo $queryArray['url'];?>"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
            </div>
        </div>

        <!-- family values -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by <b>family values</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from familyvalues limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/<?php echo $queryArray['url'];?>"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
            </div>
        </div>

        <!-- family affluence -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by <b>family affluence</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from familyaffluence limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/<?php echo $queryArray['url'];?>"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
            </div>
        </div>

        <!-- gender -->
        <div class="all-cat-div-main">
            <div class="all-cat-div-title">
                find rishta by <b>gender</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from gender limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/<?php echo $queryArray['url'];?>"> <!--- html --->
                                <div class="col-md-4 all-md-2 col-xs-6">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
            </div>
        </div>
        
        
        
    </div>
</section>

<!-- footer -->
<?php include('inc/pages/footer.php');?>

</body>
</html>