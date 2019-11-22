<?php
session_start();
require 'inc/connection/connect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Rishta in lahore, karachi, islamabad - RISHTAWEB Categories  </title>
    <meta name="description" content="RISHTAWEB Categories - Find free online rishta in pakistan, rishtaweb is free online web based portal to search out rishta in your desired city, caste and religion and connect.">

    <?php include('inc/pages/links-one.php');?>

<!-- select2 -->
<script src="<?php echo $base_url;?>assets/select2/select2popper.js"></script> 
<script src="<?php echo $base_url;?>assets/select2/select2min.js"></script> 
<link rel="stylesheet" href="<?php echo $base_url;?>assets/select2/select2.css"> 
<link rel="stylesheet" href="<?php echo $base_url;?>assets/css/style.css"  />

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
    <div class="container all-cat-con">


        <!-- caste -->
        <div class="all-cat-div-main">

        <div class="all-cat-div-title all-cat-div-title-top all-cat-ser-top">
            Select Single/Multiple Inputs & Search
        </div>
        <div class="row cat-search-div all-search-div all-cat-ser-bot">
            <div class="col-lg-12 index-search cat-index-search">
                <form class="form-inline cat-search-form-width" action="<?php echo $base_url;?>searchguest.php" method="post">
                    <div class="row">
                        <?php 
                        if(!isset($_SESSION['firstPersonId'])){?>
                            <div class="col-md-2 col-xs-4 form-group ind-form-group-search all-form-group-search">
                                <label class="index-search-label" for="gender">Gender</label>
                                <select class="form-control select2 Gender" name="gender" id="gender">
                                        <option value="0">Select</option>
                                    <option value="male">male</option>
                                    <option value="female">female</option>
                                </select>
                            </div>
                            
                        <?php }?>
                        <div class="col-md-2 col-xs-4 form-group ind-form-group-search all-form-group-search">
                            <label class="index-search-label" for="caste">Caste</label>
                            <select class="form-control select2 Caste" name="caste" id="caste">
                                <option value="0">Select</option>
                                <?php
                                    $result=mysqli_query($conn, "select * from caste");
                                    while($r=mysqli_fetch_array($result)){?>
                                        <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                    <?php }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-4 form-group ind-form-group-search all-form-group-search">
                            <label class="index-search-label" for="city">City</label>
                            <select class="form-control select2 City" name="city" id="City">
                                <option value="0">Select</option>
                                <?php
                                    $result=mysqli_query($conn, "select * from city");
                                    while($r=mysqli_fetch_array($result)){?>
                                        <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                    <?php }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-4 form-group ind-form-group-search all-form-group-search">
                            <label class="index-search-label" for="district">District</label>
                            <select class="form-control select2 District" name="district" id="district">
                                <option value="0">Select</option>
                                <?php
                                $result=mysqli_query($conn, "select * from district");
                                if(mysqli_num_rows($result) > 0){
                                    while($r=mysqli_fetch_array($result)){?>
                                        <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-4 form-group ind-form-group-search all-form-group-search">
                            <label class="index-search-label" for="province">Province</label>
                            <select class="form-control select2 Province" name="province" id="province">
                                <option value="0">Select</option>
                                <?php
                                $result=mysqli_query($conn, "select * from province");
                                if(mysqli_num_rows($result) > 0){
                                    while($r=mysqli_fetch_array($result)){?>
                                        <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-4 form-group ind-form-group-search all-form-group-search">
                            <label class="index-search-label" for="country">Country</label>
                            <select class="form-control select2 Country" name="country" id="country">
                                <option value="0">Select</option>
                                <?php
                                $result=mysqli_query($conn, "select * from country");
                                if(mysqli_num_rows($result) > 0){
                                    while($r=mysqli_fetch_array($result)){?>
                                        <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-4 form-group ind-form-group-search all-form-group-search">
                            <label class="index-search-label" for="religion">Religion</label>
                            <select class="form-control select2 Religion" name="religion" id="religion">
                                <option value="0">Select</option>
                                <?php
                                $result=mysqli_query($conn, "select * from religion");
                                if(mysqli_num_rows($result) > 0){
                                    while($r=mysqli_fetch_array($result)){?>
                                        <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-4 form-group ind-form-group-search all-form-group-search">
                            <label class="index-search-label" for="profession">Profession</label>
                            <select class="form-control select2 Profession" name="profession" id="profession">
                                <option value="0">Select</option>
                                <?php
                                $result=mysqli_query($conn, "select * from profession");
                                if(mysqli_num_rows($result) > 0){
                                    while($r=mysqli_fetch_array($result)){?>
                                        <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-4 form-group ind-form-group-search all-form-group-search">
                            <label class="index-search-label" for="language">Language</label>
                            <select class="form-control select2 Language" name="language" id="language">
                                <option value="0">Select</option>
                                <?php
                                $result=mysqli_query($conn, "select * from language");
                                if(mysqli_num_rows($result) > 0){
                                    while($r=mysqli_fetch_array($result)){?>
                                        <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-4 form-group ind-form-group-search all-form-group-search">
                            <label class="index-search-label" for="clan">Clan</label>
                            <select class="form-control select2 Clan" name="clan" id="clan">
                                <option value="0">Select</option>
                                <?php
                                $result=mysqli_query($conn, "select * from clan");
                                if(mysqli_num_rows($result) > 0){
                                    while($r=mysqli_fetch_array($result)){?>
                                        <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-4 form-group ind-form-group-search all-form-group-search">
                            <label class="index-search-label" for="education">Education</label>
                            <select class="form-control select2 Education" name="education" id="education">
                                <option value="0">Select</option>
                                <?php
                                $result=mysqli_query($conn, "select * from education");
                                if(mysqli_num_rows($result) > 0){
                                    while($r=mysqli_fetch_array($result)){?>
                                        <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-4 form-group ind-form-group-search all-form-group-search">
                            <label class="index-search-label" for="hobby">Hobby</label>
                            <select class="form-control select2 Hobby" name="hobby" id="hobby">
                                <option value="0">Select</option>
                                <?php
                                $result=mysqli_query($conn, "select * from hobby");
                                if(mysqli_num_rows($result) > 0){
                                    while($r=mysqli_fetch_array($result)){?>
                                        <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-4 form-group ind-form-group-search all-form-group-search">
                            <label class="index-search-label" for="familyType">Family Type</label>
                            <select class="form-control select2 FamilyType" name="familyType" id="familyType">
                                <option value="0">Select</option>
                                <?php
                                $result=mysqli_query($conn, "select * from familytype");
                                if(mysqli_num_rows($result) > 0){
                                    while($r=mysqli_fetch_array($result)){?>
                                        <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-4 form-group ind-form-group-search all-form-group-search">
                            <label class="index-search-label" for="familyvalues">Family Values</label>
                            <select class="form-control select2 Familyvalues" name="familyvalues" id="familyvalues">
                                <option value="0">Select</option>
                                <?php
                                $result=mysqli_query($conn, "select * from familyvalues");
                                if(mysqli_num_rows($result) > 0){
                                    while($r=mysqli_fetch_array($result)){?>
                                        <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-4 form-group ind-form-group-search all-form-group-search">
                            <label class="index-search-label" for="familyaffluence">Family Affluence</label>
                            <select class="form-control select2 Familyaffluence" name="familyaffluence" id="familyaffluence">
                                <option value="0">Select</option>
                                <?php
                                $result=mysqli_query($conn, "select * from familyaffluence");
                                if(mysqli_num_rows($result) > 0){
                                    while($r=mysqli_fetch_array($result)){?>
                                        <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12 col-xs-12 form-group ind-form-group-search all-form-group-search-btn">
                            <button type="submit" class="btn btn-block btn-info ind-form-group-search all-form-group-search-btn cat-form-group-search-btn all-search-btn" name="indexsearch">
                                <span class="glyphicon glyphicon-search" style=" margin-right:15px; margin-left:-30px"></span> SEARCH RISHTA
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

            
            <div class="all-cat-div-main-head">
                All Categories
            </div>
            <div class="all-cat-div-title">
                find rishta by <b>caste</b> in pakistan
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php $result=mysqli_query($conn, "select * from caste limit 12");
                    if(@mysqli_num_rows( $result) > 0 ){
                        while($queryArray=mysqli_fetch_array($result)){?>
                             <a href="check-category/caste/<?php echo $queryArray['url'];?>">
                                <div class="col-md-4 all-md-2 col-xs-12">
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
                             <a href="check-category/city/<?php echo $queryArray['url'];?>">
                                <div class="col-md-4 all-md-2 col-xs-12">
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
                             <a href="check-category/district/<?php echo $queryArray['url'];?>">
                                <div class="col-md-4 all-md-2 col-xs-12">
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
                             <a href="check-category/province/<?php echo $queryArray['url'];?>">
                                <div class="col-md-4 all-md-2 col-xs-12">
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
                             <a href="check-category/country/<?php echo $queryArray['url'];?>">
                                <div class="col-md-4 all-md-2 col-xs-12">
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
                             <a href="check-category/religion/<?php echo $queryArray['url'];?>">
                                <div class="col-md-4 all-md-2 col-xs-12">
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
                             <a href="check-category/profession/<?php echo $queryArray['url'];?>">
                                <div class="col-md-4 all-md-2 col-xs-12">
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
                             <a href="check-category/language/<?php echo $queryArray['url'];?>">
                                <div class="col-md-4 all-md-2 col-xs-12">
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
                             <a href="check-category/clan/<?php echo $queryArray['url'];?>">
                                <div class="col-md-4 all-md-2 col-xs-12">
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
                             <a href="check-category/education/<?php echo $queryArray['url'];?>">
                                <div class="col-md-4 all-md-2 col-xs-12">
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
                             <a href="check-category/hobby/<?php echo $queryArray['url'];?>">
                                <div class="col-md-4 all-md-2 col-xs-12">
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
                             <a href="check-category/familytype/<?php echo $queryArray['url'];?>">
                                <div class="col-md-4 all-md-2 col-xs-12">
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
                             <a href="check-category/familyvalues/<?php echo $queryArray['url'];?>">
                                <div class="col-md-4 all-md-2 col-xs-12">
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
                             <a href="check-category/familyaffluence/<?php echo $queryArray['url'];?>">
                                <div class="col-md-4 all-md-2 col-xs-12">
                                    <div>find rishta in 
                                        <span class="all-cat-nam-sty"><?php echo $queryArray['name']; ?></span>
                                    </div>
                                </div> 
                            </a> 
                    <?php }}?>
                </div>
            </div>
        </div>

        

        <div class="all-cat-div-main-arti">
        <h1>Rishta in Lahore, Karachi and Islamabad - Check All Categories</h1><br>
            <p>
                Here are all categories, you can find rishta in your clan, caste, country, city and desired profession.
                There are many options to find out rishta on RISHTAWEB, you can search a profile using profile ID or there are 
                a lot of custom search options and usign these options, you can filter out profiles. 
                If you want to do custom advanced search, then visit <a href="searchguest.php">advanced rishta search</a> and filter out results
                according to your need. <br>
                Below are the option that you can directly select and filter out the results. 
                On this page, we tried to display all the possibel rishta categories based on different criteria. 
                Here we showed less number of links of a specific category, If you want to view all links of a single category then you can click 
                the View All button.<br>
                If you filterd out desired profiles and want to connect with people, then simply <a href="login.php">login</a> to connect.
                If you are new to RISHTAWEB, then we will strongly suggest to <a href="CompleteSignUp.php">create account</a> so that you can 
                send free messages.
            </p><br>
        </div>


        

    </div>
</section>

<!-- footer -->
<?php include('inc/pages/footer.php');?>
<script src="<?php echo $base_url;?>assets/js/register.js"></script>

</body>
</html>