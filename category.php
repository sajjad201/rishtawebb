<?php
session_start();
require 'inc/connection/connect.php';
if(isset($_GET['name'])){
    $name = $_GET['name'];
}


function ageCalculator($dob){
    if(!empty($dob)){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $ag = $birthdate->diff($today)->y;
        $mn = $birthdate->diff($today)->m;
        $dy = $birthdate->diff($today)->d;
        return "$ag Years";
    }else{
        return 0;
    }
}

$category_name=$_GET['name'];
$url=$_GET['url'];	
$sql="select * from $category_name where url='$url' ";
$result=mysqli_query($conn, $sql);
while($r=mysqli_fetch_array($result)){
    $category=$r['name'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php 
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (strpos($actual_link, 'http://localhost/rishtawebb/find/') === false) {
    $arr="http://localhost/rishtawebb/find/";
    $arr1=explode("http://localhost/rishtawebb/",$actual_link);
    $arr2=explode("/", $arr1[1]);
    $can=$arr."".$arr2[0]."/".$arr2[1];?>
    <link rel="canonical" href="<?php echo $can;?>"/>
<?Php }?>

<title><?php echo ucwords(str_replace('-', ' ', $_GET['url']));?> - RISHTAWEB</title>
<meta name="description" content="Find online rishta in <?php echo $category; 
if($_GET['name']=='caste' || $_GET['name']=='familytype' || $_GET['name']=='familyvalues' || $_GET['name']=='familyaffluence'
|| $_GET['name']=='caste' || $_GET['name']=='clan' || $_GET['name']=='religion' || $_GET['name']=='language'){
    echo ' family ';
}
?>. Rishtaweb offers many rishty in <?php echo $category; 
if($_GET['name']=='caste' || $_GET['name']=='familytype' || $_GET['name']=='familyvalues' || $_GET['name']=='familyaffluence'
|| $_GET['name']=='caste' || $_GET['name']=='clan' || $_GET['name']=='religion' || $_GET['name']=='language'){
    echo ' family ';
}
?>. You can also find rishta in your desired cast, religion. profession and within your city or country">
<meta name="keywords" content="Find <?php echo $category; ?> girls rishta in pakistan. Find <?php echo $category; ?> boys rishta in pakistan. <?php echo $category; ?> female rishta in pakistan. <?php echo $category; ?> male rishta in pakistan.">

<?php

include('inc/pages/links-one.php');

$sql="select * from $category_name where url='$url' limit 1";
$result=mysqli_query($conn, $sql);
while($r=mysqli_fetch_array($result)){
    $category=$r['name'];
}

if(!isset($_GET['page'])){
    $_GET['page']=1;
}


if(isset($_SESSION['firstPersonId'])){
    $id=$_SESSION['firstPersonId'];
    $sql="SELECT gender FROM signup where id=$id";	
    $result=mysqli_query($conn, $sql);	
    while($r=mysqli_fetch_array($result)){
        $gender=$r['gender'];
    }
    $sql="SELECT * FROM signup where $category_name='$category' && gender!='$gender' ";	
}
else{
    $sql="SELECT * FROM signup where $category_name='$category' ";	
}

$query_count=mysqli_query($conn, $sql);				
$per_page =10;					//Change number of items on one page
$count = mysqli_num_rows($query_count);
$pages = ceil($count/$per_page);
if(@$_GET['page']==""){		$page="10";}
else{	$page=$_GET['page'];	}
$start = ($page - 1) * $per_page;
$sql   = $sql." LIMIT $start,$per_page ";
$query2=mysqli_query($conn, $sql);
$rowIndex=1; $colIndex=1; $chunk=4;						
$arrayOfIndexes = array();
for($index=1; $index<=$pages; $index++){ 
	$arrayOfIndexes[$rowIndex][$colIndex]=$index;
	$colIndex++;
	if($index == $chunk){
		$rowIndex=$rowIndex+1;
		$chunk=$chunk+4;	
		$colIndex=1;
	}
}
for($row=1; $row<=$pages; $row++){	
	@$lengthOfRow=count($arrayOfIndexes[$row]);
	for($col=1; $col<=$lengthOfRow; $col++){
		if($arrayOfIndexes[$row][$col] == $page){
			for($thisRow=1; $thisRow<=$lengthOfRow; $thisRow++){
				$lastOne=$arrayOfIndexes[$row][$thisRow];
				if($thisRow==1){
					$firstOne=$arrayOfIndexes[$row][$thisRow];
				}
			}
		}
	}
}
?>

<link href="https://fonts.googleapis.com/css?family=Lato|Roboto:300&display=swap" rel="stylesheet">
<!-- font-family: 'Roboto', sans-serif;
font-family: 'Lato', sans-serif; -->


<!-- select2 -->
<script src="<?php echo $base_url;?>assets/select2/select2popper.js"></script> 
<script src="<?php echo $base_url;?>assets/select2/select2min.js"></script> 
<link rel="stylesheet" href="<?php echo $base_url;?>assets/select2/select2.css"> 
<link rel="stylesheet" href="<?php echo $base_url;?>assets/css/style.css"  />

</head>
<body class="cat-body">
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
  FB.init({
    xfbml            : true,
    version          : 'v5.0'
  });
};

(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
attribution=setup_tool
page_id="415465259225045"
theme_color="#0084ff">
</div>

    
<!-- navbar -->
<?php 
    if(isset($_SESSION["firstPersonId"])) {
        include('inc/pages/navbar-login.php');          // login navbar
    }
    else{
        include('inc/pages/navbar-index.php');         // guest navbar
    }
?>

<!-- body -->
<section class="all-sec">
    <div class="container-fluid">
        <div class="row"> 
            <div class="col-md-1"></div>
            <div class="col-md-11 p-0">
                <div class="all-main-div">
                    <div class="row">
                        <div class="col-md-9 all-main-div-col-9"> 
  
                    
                            <?php 
                                $result=mysqli_query($conn, "select * from articles where name='$category' ");
                                if(mysqli_num_rows($result) > 0){?>
                                    <div class="cat-head-txt-title">
                                        <h1 class="cat-h1-title">
                                            <?php echo $tit=str_replace('-', ' ', $_GET['url']);?>
                                        </h1>
                                    </div>
                                    <?php while($r=mysqli_fetch_array($result)){?>
                                        <div class="cat-h1-body">
                                            <?php echo $r['section1']; ?>
                                        </div>    
                                    <?php }
                                }else{?>
                                    <div class="cat-head-txt-title-no">
                                        <h1 class="cat-h1-title">
                                            <?php echo $tit=str_replace('-', ' ', $_GET['url']);?>
                                        </h1>
                                    </div>
                               <?php }
                            ?>
                            
                            <div class="row cat-search-div">
                                <div class="col-lg-12 index-search cat-index-search cat-index-search-rad">
                                    <form class="form-inline cat-search-form-width" action="<?php echo $base_url;?>searchguest.php" method="post">
                                        <div class="row">
                                            <?php 
                                            if(isset($_SESSION['firstPersonId'])){?>
                                                <div class="col-md-3 col-xs-4 form-group ind-form-group-search">
                                                    <label class="index-search-label" for="caste">Caste</label>
                                                    <select class="form-control select2 Caste" name="caste" id="caste">
                                                        <option value="0">Select Caste</option>
                                                        <?php
                                                            $result=mysqli_query($conn, "select * from caste");
                                                            while($r=mysqli_fetch_array($result)){?>
                                                                <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                                            <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            <?php }else{?>
                                                <div class="col-md-3 col-xs-4 form-group ind-form-group-search">
                                                    <label class="index-search-label" for="gender">Gender</label>
                                                    <select class="form-control select2 Gender" name="gender" id="gender">
                                                        <option value="male">male</option>
                                                        <option value="female">female</option>
                                                    </select>
                                                </div>
                                            <?php }
                                            ?>
                                            <div class="col-md-3 col-xs-4 form-group ind-form-group-search">
                                                <label class="index-search-label" for="city">City</label>
                                                <select class="form-control select2 City" name="city" id="City">
                                                    <option value="0">Select City</option>
                                                    <option value="Islamabad">Islamabad</option>
                                                    <option value="Karachi">Karachi</option>
                                                    <option value="Lahore">Lahore</option>
                                                    <option value="Peshawar">Peshawar</option>
                                                    <option value="Quetta">Quetta</option>
                                                    <option value="Gilgit">Gilgit</option>
                                                    <?php
                                                    $result=mysqli_query($conn, "select * from city");
                                                    if(mysqli_num_rows($result) > 0){
                                                        while($r=mysqli_fetch_array($result)){
                                                            if( $r['name'] != 'Islamabad' &&
                                                                $r['name'] != 'Karachi' &&
                                                                $r['name'] != 'Lahore' &&
                                                                $r['name'] != 'Peshawar' &&
                                                                $r['name'] != 'Quetta' &&
                                                                $r['name'] != 'Gilgit'
                                                            ){?>
                                                                <option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
                                                            <?php }
                                                                ?>
                                                            
                                                        <?php }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-xs-4 form-group ind-form-group-search">
                                                <label class="index-search-label" for="profession">Profession</label>
                                                <select class="form-control select2 Profession" name="profession" id="profession">
                                                    <option value="0">Select Profession</option>
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
                                            <div class="col-md-3 col-xs-12 form-group ind-form-group-search">
                                                <label class="index-search-label index-search-label-s" for="search">Select one/multiple inputs</label>
                                                <button type="submit" class="btn btn-block btn-info ind-form-group-search-btn cat-form-group-search-btn" name="indexsearch">
                                                    <span class="glyphicon glyphicon-search" style=" margin-right:15px; margin-left:-30px"></span>SEARCH RISHTA
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="cat-tot">
                                <?php 
                                if(@mysqli_num_rows($query2) > 0){
                                    echo 'showing 10 of total: '.$count;
                                }
                                ?>
                            </div>
                            <?php
                            
                            if(@mysqli_num_rows($query2) > 0){
                                while($array2=mysqli_fetch_array($query2)){?>
                                    
                                    <a href="../../profile/<?php echo $array2['id']?>" class="all-div-link" rel="canonical">
                                        <div class="all-main-prof">
                                            <div class="container-fluid p-0">
                                                <div class="col-md-2 col-xs-12">
                                                    <div class="all-main-prof-id">id: <?php echo $array2['id']; ?></div>
                                                    <div class="all-main-div1">
                                                        <div class="all-main-div-img">
                                                        
                                                            <?php
                                                            if (!isset($_SESSION["firstPersonId"])){?>
                                                                <?php if($array2["gender"]=="male"){?><img src="<?php echo $base_url?>assets/allpics/mlogin.png" height="100%" width="100%" alt="User Image"/><?php }
                                                                else{?><img src="<?php echo $base_url?>assets/allpics/flogin.png" height="100%" width="100%" alt="User Image"/><?php } ?>
                                                            <?php }
                                                            else{?>
                                                                <?php if($array2["publicProfile"]!="Private"){?>
                                                                <img src="<?php echo $base_url?><?php echo $array2['uploadProfilePicture']; ?>"	height="100%" width="100%" style="border-radius:2px;" alt="User Image"> 
                                                                <?php }else if($array2["gender"]=="male"){?><img src="<?php echo $base_url?>assets/allpics/male4.png" height="100%" width="100%" alt="User Image"/><?php }
                                                                else{?><img src="<?php echo $base_url?>assets/allpics/female4.png" height="100%" width="100%" alt="User Image"/><?php } ?>
                                                            <?php } ?>
                                                        
                                                        </div>
                                                        <div class="all-main-div-btn">
                                                            <button class="button button-ripple auto-center all-main-div-btn-pa">
                                                                <span class="button-text-white"> View Profile </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-xs-12 all-main-profile-detail-col5-1">
                                                    <div class="all-main-profile-detail">
                                                        <div>
                                                            <div class="all-main-prof-bold">
                                                                <i class="fas fa-male all-main-prof-icon" style="margin-right:17px; font-size:13px;"></i>Name
                                                            </div>
                                                            <div class="all-main-prof-bold">
                                                                <i class="fas fa-user-clock all-main-prof-icon" style="margin-right:8px; font-size:13px;"></i>Caste
                                                            </div>
                                                            <div class="all-main-prof-bold">
                                                                <i class="fas fa-map-marker-alt all-main-prof-icon" style="margin-right:12px; font-size:14px"></i>Location
                                                            </div>
                                                            <div class="all-main-prof-bold">
                                                                <i class="fas fa-user-graduate all-main-prof-icon" style="margin-right:12px; font-size:13px"></i>Education
                                                            </div>
                                                            <div class="all-main-prof-bold">
                                                                <i class="fas fa-chalkboard-teacher all-main-prof-icon" style="margin-right:8px; font-size:13px"></i>Profession
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="all-main-prof-normal">
                                                            <?php echo $array2['firstName']." ".$array2['lastName']; ?>
                                                            </div>
                                                            <div class="all-main-prof-normal">
                                                            <?php echo $array2['caste']; ?>
                                                            </div>
                                                            <div class="all-main-prof-normal">
                                                            <?php if($array2['city']=='0' OR $array2['city'] == ''){echo $array2['city'];}else{echo $array2['country'];} ?>
                                                            </div>
                                                            <div class="all-main-prof-normal">
                                                            <?php echo $array2['education']; ?>
                                                            </div>
                                                            <div class="all-main-prof-normal">
                                                            <?php echo $array2['profession']; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-xs-12 all-main-profile-detail-col5-2">
                                                    <div class="all-main-profile-detail">
                                                        <div class="all-main-profile-detail-div-2">
                                                            <div class="all-main-prof-bold">
                                                                Religion
                                                            </div>
                                                            <div class="all-main-prof-bold">
                                                                Marital Status
                                                            </div>
                                                            <div class="all-main-prof-bold">
                                                                Height
                                                            </div>
                                                            <div class="all-main-prof-bold">
                                                                Age
                                                            </div>
                                                            <div class="all-main-prof-bold">
                                                                Family Class
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="all-main-prof-normal">
                                                            <?php echo $array2['religion']; ?>
                                                            </div>
                                                            <div class="all-main-prof-normal">
                                                            <?php echo $array2['maritalStatus']; ?>
                                                            </div>
                                                            <div class="all-main-prof-normal">
                                                            <?php echo $array2['height']; ?>
                                                            </div>
                                                            <div class="all-main-prof-normal">
                                                            <?php $row11 = array('dob'=>$array2['dob']);	echo ageCalculator($row11['dob']);	?>
                                                            </div>
                                                            <div class="all-main-prof-normal">
                                                            <?php echo $array2['familyAffluence']; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </a>

                            <?php
                             } }
                            else{
                                echo '0 record found';
                            }
                            ?>
                            <!-- pagination -->
                            <?php if($page <= $pages && $page>0 ){?>	
                                <div class="col-lg-12 col-xs-12 cat-pagi-pad">
                                    <div class="col-lg-12 col-xs-12" style=" height:auto; padding:0px">
                                        <?php	if( $page>1 ){	$previous=$page-1; ?>
                                                <a rel="canonical" href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $previous; ?> ">
                                                    <div class="col-lg-3 col-xs-3" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            <span style="margin-right:15px; font-size:16px" class="glyphicon glyphicon-chevron-left"></span>
                                                            Back
                                                        </button>
                                                    </div>
                                                </a>
                                                <?php if($firstOne != 1){?>
                                                <a rel="canonical" href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $firstOne-1;?>">
                                                    <div class="col-lg-1 col-xs-1" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                        <span style="font-size:12px; margin-left:-10px;" class="glyphicon glyphicon-menu-left"></span>
                                                            <span style="margin-left:-4px;"><?php echo $firstOne-1;?></span>
                                                        </button>
                                                    </div>
                                                </a>
                                            <?php }?>									
                                        <?php }	if($page >= $pages){
                                                for($row=1; $row<=$pages; $row++){
                                                    @$lengthOfRow=count($arrayOfIndexes[$row]);
                                                    for($col=1; $col<=$lengthOfRow; $col++){
                                                        if($arrayOfIndexes[$row][$col] == $page){
                                                            for($thisRow=1; $thisRow<=$lengthOfRow; $thisRow++){?>
                                                                <a rel="canonical" href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $arrayOfIndexes[$row][$thisRow];?>">
                                                                    <div class="col-lg-1 col-xs-1" style="padding:0px">
                                                                        <?php if( $page == $arrayOfIndexes[$row][$thisRow] ){?>
                                                                            <button type="button" class="btn btn-primary btn-block pagination-btn">
                                                                                <?php echo $arrayOfIndexes[$row][$thisRow];?>
                                                                            </button>
                                                                        <?php }else{?>
                                                                            <button type="button" class="btn btn-default btn-block pagination-btn">
                                                                                <?php echo $arrayOfIndexes[$row][$thisRow];?>
                                                                            </button>
                                                                        <?php }?>
                                                                    </div>
                                                                </a>
                                                            <?php	
                                                            }
                                                        }
                                                    }
                                                }?>
                                                <a rel="canonical" href="#">
                                                    <div class="col-lg-3 col-xs-3" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            Next<span style="margin-left:15px; font-size:16px" class="glyphicon glyphicon-chevron-right"></span>
                                                        </button>
                                                    </div>
                                                </a>
                                                <span class="col-lg-12 col-xs-12" style="display:block;color:#666666; font-family:Helvetica; font-size:12px; padding:0px;">
                                                    End of Results
                                                </span>
                                            <?php }	else if($page==1){	
                                                for($row=1; $row<=$pages; $row++){
                                                    @$lengthOfRow=count($arrayOfIndexes[$row]);
                                                    for($col=1; $col<=$lengthOfRow; $col++){
                                                        if($arrayOfIndexes[$row][$col] == $page){
                                                            for($thisRow=1; $thisRow<=$lengthOfRow; $thisRow++){?>
                                                                <a rel="canonical" href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $arrayOfIndexes[$row][$thisRow];?>">
                                                                    <div class="col-lg-1 col-xs-1" style="padding:0px">
                                                                        <?php if($page == $arrayOfIndexes[$row][$thisRow]){?>
                                                                            <button type="button" class="btn btn-primary btn-block pagination-btn">
                                                                                <?php echo $lastOne=$arrayOfIndexes[$row][$thisRow];?>
                                                                            </button>
                                                                        <?php }else{?>
                                                                            <button type="button" class="btn btn-default btn-block pagination-btn">
                                                                                <?php echo $lastOne=$arrayOfIndexes[$row][$thisRow];?>
                                                                            </button>
                                                                            <?php }?>
                                                                    </div>
                                                                </a>
                                                            <?php	
                                                            }
                                                        }
                                                    }
                                                }
                                                $lastOne=$lastOne+1;
                                                if($pages >= $lastOne){?>
                                                <a rel="canonical" href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $lastOne;?>">
                                                    <div class="col-lg-1 col-xs-1" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            <span style="margin-left:-3px;"><?php echo $lastOne;?>
                                                            <span style="font-size:12px; margin-left:-3px" class="glyphicon glyphicon-menu-right"></span>
                                                        </button>
                                                    </div>
                                                </a>
                                                <?php }?>
                                                <a rel="canonical" href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $page+1; ?>  ">
                                                    <div class="col-lg-3 col-xs-3" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            Next<span style="margin-left:15px; font-size:16px" class="glyphicon glyphicon-chevron-right"></span>
                                                        </button>
                                                    </div>
                                                </a>
                                                <?php }	else{	
                                                for($row=1;$row<=$pages;$row++){
                                                    @$lengthOfRow=count($arrayOfIndexes[$row]);
                                                    for($col=1;$col<=$lengthOfRow;$col++){
                                                        if($arrayOfIndexes[$row][$col] == $page){
                                                            for($thisRow=1;$thisRow<=$lengthOfRow;$thisRow++){?>
                                                                <a rel="canonical" href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $arrayOfIndexes[$row][$thisRow];?>">
                                                                    <div class="col-lg-1 col-xs-1" style="padding:0px">
                                                                        <?php if( $page == $arrayOfIndexes[$row][$thisRow] ){?>
                                                                            <button type="button" class="btn btn-primary btn-block pagination-btn">
                                                                                <?php echo $lastOne=$arrayOfIndexes[$row][$thisRow];?>
                                                                            </button>
                                                                        <?php }else{?>
                                                                            <button type="button" class="btn btn-default btn-block pagination-btn">
                                                                                <?php echo $lastOne=$arrayOfIndexes[$row][$thisRow];?>
                                                                            </button>
                                                                            <?php } ?>
                                                                    </div>
                                                                </a>
                                                            <?php	
                                                            }
                                                        }
                                                    }
                                                }
                                                $lastOne=$lastOne+1;
                                                if($pages >= $lastOne){?>
                                                <a rel="canonical" href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $lastOne;?>">
                                                    <div class="col-lg-1 col-xs-1" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            <span style="margin-left:-3px;"><?php echo $lastOne;?></span>
                                                            <span style="font-size:12px; margin-left:-3px" class="glyphicon glyphicon-menu-right"></span>
                                                        </button>
                                                    </div>
                                                </a>
                                                <?php }?>
                                                <a rel="canonical" href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $page+1; ?>  ">
                                                    <div class="col-lg-3 col-xs-3" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            Next<span style="margin-left:15px; font-size:16px" class="glyphicon glyphicon-chevron-right"></span>
                                                        </button>
                                                    </div>
                                                </a>
                                        <?php }	?>					
                                    </div>
                                </div>
                                <?php }	
                                else{ ?>
                                    <div class="container-fluid cat-no-prof-container">
                                        No Profile found for <?php echo $category; ?>!<br>
                                        <h5>Select input fields from above and search for more/different results.</h5>
                                    </div>
                                <?php }?>
                                </div>
                                
                                
                                <div id="RightSideBar" class="col-lg-3 col-md-2 col-sm-12 col-xs-12 cat-right-side-bar">
                                    <?php if(@mysqli_num_rows($query2) < 1){?>

                                        <?php
                                        if(!isset($_SESSION['firstPersonId'])){?>
                                            <div class="right-div">
                                                <div class="rishta-div-head">
                                                    Rishta by Gender
                                                </div>
                                                <?php
                                                    $result=mysqli_query($conn, "select * from gender");
                                                    if(mysqli_num_rows($result) > 0){
                                                        while($r=mysqli_fetch_array($result)){?>
                                                            <div class="rishta-div-body">
                                                                <a href="../../find/gender/<?php echo $r['url'];?>" class="rishta-div-body-link" >
                                                                    <?php echo ucwords(str_replace('-', ' ', $r['url']));?>
                                                                </a>
                                                            </div>
                                                        <?php }
                                                    }
                                                ?>
                                            </div>
                                        <?php }?>
                                        <div class="right-div">
                                            <div class="rishta-div-head">
                                                Rishty by City
                                            </div>
                                            <?php
                                                $result=mysqli_query($conn, "select * from city limit 10");
                                                if(mysqli_num_rows($result) > 0){
                                                    while($r=mysqli_fetch_array($result)){?>
                                                        <div class="rishta-div-body">
                                                            <a href="../../find/city/<?php echo $r['url'];?>" class="rishta-div-body-link" >
                                                                <?php echo ucwords(str_replace('-', ' ', $r['url']));?>
                                                            </a>
                                                        </div>
                                                    <?php }
                                                }
                                            ?>
                                        </div>
                                        <div class="right-div">
                                            <div class="rishta-div-head">
                                                Rishty by Family Affluence
                                            </div>
                                            <?php
                                                $result=mysqli_query($conn, "select * from familyaffluence");
                                                if(mysqli_num_rows($result) > 0){
                                                    while($r=mysqli_fetch_array($result)){?>
                                                        <div class="rishta-div-body">
                                                            <a href="../../find/familyaffluence/<?php echo $r['url'];?>" class="rishta-div-body-link" >
                                                                <?php echo ucwords(str_replace('-', ' ', $r['url']));?>
                                                            </a>
                                                        </div>
                                                    <?php }
                                                }
                                            ?>
                                        </div>
                                        <div class="right-div">
                                            <div class="rishta-div-head">
                                                Rishty by Family Type
                                            </div>
                                            <?php
                                                $result=mysqli_query($conn, "select * from familytype");
                                                if(mysqli_num_rows($result) > 0){
                                                    while($r=mysqli_fetch_array($result)){?>
                                                        <div class="rishta-div-body">
                                                            <a href="../../find/familytype/<?php echo $r['url'];?>" class="rishta-div-body-link" >
                                                                <?php echo ucwords(str_replace('-', ' ', $r['url']));?>
                                                            </a>
                                                        </div>
                                                    <?php }
                                                }
                                            ?>
                                        </div>
                                        <div class="right-div">
                                            <div class="rishta-div-head">
                                                Rishty by Family Values
                                            </div>
                                            <?php
                                                $result=mysqli_query($conn, "select * from familyvalues");
                                                if(mysqli_num_rows($result) > 0){
                                                    while($r=mysqli_fetch_array($result)){?>
                                                        <div class="rishta-div-body">
                                                            <a href="../../find/familyvalues/<?php echo $r['url'];?>" class="rishta-div-body-link" >
                                                                <?php echo ucwords(str_replace('-', ' ', $r['url']));?>
                                                            </a>
                                                        </div>
                                                    <?php }
                                                }
                                            ?>
                                        </div>

                                    <?php } else{?>    
                                         <?php if(!isset($_SESSION['firstPersonId'])){?>

                                            
                                                <?php 
                                                    if($category_name == 'caste'){$result=mysqli_query($conn, "select * from signup where gender='male' && caste='$category' order by id desc limit 10");}
                                                    else if($category_name == 'city'){$result=mysqli_query($conn, "select * from signup where gender='male' && city='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'district'){$result=mysqli_query($conn, "select * from signup where gender='male' && district='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'province'){$result=mysqli_query($conn, "select * from signup where gender='male' && province='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'country'){$result=mysqli_query($conn, "select * from signup where gender='male' && country='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'religion'){$result=mysqli_query($conn, "select * from signup where gender='male' && religion='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'profession'){$result=mysqli_query($conn, "select * from signup where gender='male' && profession='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'language'){$result=mysqli_query($conn, "select * from signup where gender='male' && language='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'clan'){$result=mysqli_query($conn, "select * from signup where gender='male' && clan='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'education'){$result=mysqli_query($conn, "select * from signup where gender='male' && education='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'hobby'){$result=mysqli_query($conn, "select * from signup where gender='male' && hobby='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'familyType'){$result=mysqli_query($conn, "select * from signup where gender='male' && familyType='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'familyValues'){$result=mysqli_query($conn, "select * from signup where gender='male' && familyValues='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'familyAffluence'){$result=mysqli_query($conn, "select * from signup where gender='male' && familyAffluence='$category' order by id desc limit 10 ");}
                                                    else {$result=mysqli_query($conn, "select * from signup where gender='male' "); }

                                                    if(mysqli_num_rows($result) > 0){?>
                                                        <div class="right-div">
                                                            <div class="rishta-div-head">
                                                                <?php echo $category?> Male Rishta
                                                            </div>
                                                            <?php while($r=mysqli_fetch_array($result)){?>
                                                            <div class="rishta-div-body">
                                                                <a href="../../profile/<?php echo $r['id']?>" class="rishta-div-body-link" >
                                                                    <div>
                                                                        <?php
                                                                            if($category_name == 'city'){
                                                                                echo $r['caste'].", ".$r['familyAffluence']." family Rishta in ";
                                                                                if($r['city'] == "" || $r['city'] == "0"){
                                                                                    echo $r['country'];
                                                                                }else{
                                                                                    echo $r['city'];
                                                                                }
                                                                            }else{
                                                                                echo $category." ".$r['familyAffluence']." family Rishta in ";
                                                                                if($r['city'] == "" || $r['city'] == "0"){
                                                                                    echo $r['country'];
                                                                                }else{
                                                                                    echo $r['city'];
                                                                                }
                                                                            }
                                                                        ?>

                                                                        <div class="rishta-div-body-txt">
                                                                            <?php 
                                                                                echo $r['maritalStatus'].", ".$r['religion']." ";
                                                                                $row11 = array('dob'=>$r['dob']);	echo ageCalculator($row11['dob'])." old, ";	
                                                                                echo "boy rishta";
                                                                            ?> 
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        <?php } ?>
                                                        </div>
                                                    <?php }
                                                ?>
                                            

                                            
                                                <?php 
                                                    if($category_name == 'caste'){$result=mysqli_query($conn, "select * from signup where gender='female' && caste='$category' order by id desc limit 10");}
                                                    else if($category_name == 'city'){$result=mysqli_query($conn, "select * from signup where gender='female' && city='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'district'){$result=mysqli_query($conn, "select * from signup where gender='female' && district='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'province'){$result=mysqli_query($conn, "select * from signup where gender='female' && province='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'country'){$result=mysqli_query($conn, "select * from signup where gender='female' && country='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'religion'){$result=mysqli_query($conn, "select * from signup where gender='female' && religion='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'profession'){$result=mysqli_query($conn, "select * from signup where gender='female' && profession='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'language'){$result=mysqli_query($conn, "select * from signup where gender='female' && language='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'clan'){$result=mysqli_query($conn, "select * from signup where gender='female' && clan='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'education'){$result=mysqli_query($conn, "select * from signup where gender='female' && education='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'hobby'){$result=mysqli_query($conn, "select * from signup where gender='female' && hobby='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'familyType'){$result=mysqli_query($conn, "select * from signup where gender='female' && familyType='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'familyValues'){$result=mysqli_query($conn, "select * from signup where gender='female' && familyValues='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'familyAffluence'){$result=mysqli_query($conn, "select * from signup where gender='female' && familyAffluence='$category' order by id desc limit 10 ");}
                                                    else {$result=mysqli_query($conn, "select * from signup where gender='female' "); }

                                                    if(mysqli_num_rows($result) > 0){?>
                                                        <div class="right-div">
                                                            <div class="rishta-div-head">
                                                                <?php echo $category?> Female Rishta
                                                            </div>
                                                            <?php while($r=mysqli_fetch_array($result)){?>
                                                            <div class="rishta-div-body">
                                                                <a href="../../profile/<?php echo $r['id']?>" class="rishta-div-body-link" >
                                                                    <div>
                                                                        <?php
                                                                            if($category_name == 'city'){
                                                                                echo $r['caste'].", ".$r['familyAffluence']." family Rishta in ";
                                                                                if($r['city'] == "" || $r['city'] == "0"){
                                                                                    echo $r['country'];
                                                                                }else{
                                                                                    echo $r['city'];
                                                                                }
                                                                            }else{
                                                                                echo $category." ".$r['familyAffluence']." family Rishta in ";
                                                                                if($r['city'] == "" || $r['city'] == "0"){
                                                                                    echo $r['country'];
                                                                                }else{
                                                                                    echo $r['city'];
                                                                                }
                                                                            }
                                                                        ?>

                                                                        <div class="rishta-div-body-txt">
                                                                            <?php 
                                                                                echo $r['maritalStatus'].", ".$r['religion']." ";
                                                                                $row11 = array('dob'=>$r['dob']);	echo ageCalculator($row11['dob'])." old, ";	
                                                                                echo "boy rishta";
                                                                            ?> 
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <?php }
                                                ?>
                                            
                                        <?php } else{ 
                                            
                                            $id=$_SESSION['firstPersonId'];
                                            $result=mysqli_query($conn, "select gender from signup where id='$id' ");
                                            while($r=mysqli_fetch_array($result)){$gender=$r['gender'];}
                                            if($gender == "male"){$gender='female';}
                                            ?>
                                            
                                                <?php 
                                                    if($category_name == 'caste'){$result=mysqli_query($conn, "select * from signup where gender='$gender' && caste='$category' order by id desc limit 10");}
                                                    else if($category_name == 'city'){$result=mysqli_query($conn, "select * from signup where gender='$gender' && city='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'district'){$result=mysqli_query($conn, "select * from signup where gender='$gender' && district='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'province'){$result=mysqli_query($conn, "select * from signup where gender='$gender' && province='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'country'){$result=mysqli_query($conn, "select * from signup where gender='$gender' && country='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'religion'){$result=mysqli_query($conn, "select * from signup where gender='$gender' && religion='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'profession'){$result=mysqli_query($conn, "select * from signup where gender='$gender' && profession='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'language'){$result=mysqli_query($conn, "select * from signup where gender='$gender' && language='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'clan'){$result=mysqli_query($conn, "select * from signup where gender='$gender' && clan='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'education'){$result=mysqli_query($conn, "select * from signup where gender='$gender' && education='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'hobby'){$result=mysqli_query($conn, "select * from signup where gender='$gender' && hobby='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'familyType'){$result=mysqli_query($conn, "select * from signup where gender='$gender' && familyType='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'familyValues'){$result=mysqli_query($conn, "select * from signup where gender='$gender' && familyValues='$category' order by id desc limit 10 ");}
                                                    else if($category_name == 'familyAffluence'){$result=mysqli_query($conn, "select * from signup where gender='$gender' && familyAffluence='$category' order by id desc limit 10 ");}
                                                    else {$result=mysqli_query($conn, "select * from signup where gender='$gender' "); }

                                                    if(mysqli_num_rows($result) > 0){?>
                                                        <div class="right-div">
                                                            <div class="rishta-div-head">
                                                                <?php echo $category." ".$gender?> Rishta
                                                            </div>
                                                        <?php while($r=mysqli_fetch_array($result)){?>
                                                            <div class="rishta-div-body">
                                                                <a href="../../profile/<?php echo $r['id']?>" class="rishta-div-body-link" >
                                                                    <div>
                                                                        <?php
                                                                            if($category_name == 'city'){
                                                                                echo $r['caste'].", ".$r['familyAffluence']." family Rishta in ";
                                                                                if($r['city'] == "" || $r['city'] == "0"){
                                                                                    echo $r['country'];
                                                                                }else{
                                                                                    echo $r['city'];
                                                                                }
                                                                            }else{
                                                                                echo $category.", ".$r['familyAffluence']." family Rishta in ";
                                                                                if($r['city'] == "" || $r['city'] == "0"){
                                                                                    echo $r['country'];
                                                                                }else{
                                                                                    echo $r['city'];
                                                                                }
                                                                            }
                                                                        ?>

                                                                        <div class="rishta-div-body-txt">
                                                                            <?php 
                                                                                echo $r['maritalStatus'].", ".$r['religion']." ";
                                                                                $row11 = array('dob'=>$r['dob']);	echo ageCalculator($row11['dob'])." old, ";	
                                                                                echo "boy rishta";
                                                                            ?> 
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        <?php }?>
                                                    </div>
                                                <?php }
                                                ?>
                                            
                                        
                                        <?php }?>        
                                    <?php }?>    

                        
					            </div>
                                <div class="col-md-9 cat-art-two-col9">
                                    <?php
                                        $result=mysqli_query($conn, "select * from articles where name='$category' ");
                                        if(mysqli_num_rows($result) > 0){
                                            while($r=mysqli_fetch_array($result)){?>
                                                <div class="cat-txt-div-bot">
                                                    <?php echo $r['section2'];?>
                                                </div>
                                            <?php }
                                        }
                                    ?>
                                </div>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- footer -->
<?php include('inc/pages/footer.php');?>
<script src="<?php echo $base_url;?>assets/js/register.js"></script>

</body>
</html>