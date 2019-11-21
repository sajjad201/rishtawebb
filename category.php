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

<?php include('inc/pages/links-one.php');

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
                                    
                                    <a href="../../profile/<?php echo $array2['id']?>" class="all-div-link">
                                        <div class="all-main-prof">
                                            <div class="container-fluid p-0">
                                                <div class="col-md-2 col-xs-12">
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
                                                <div class="col-md-4 col-xs-6">
                                                    <div class="all-main-profile-detail">
                                                        <div>
                                                            <div class="all-main-prof-bold">
                                                                Id
                                                            </div>
                                                            <div class="all-main-prof-bold">
                                                                Name
                                                            </div>
                                                            <div class="all-main-prof-bold">
                                                                Education
                                                            </div>
                                                            <div class="all-main-prof-bold">
                                                                Profession
                                                            </div>
                                                            <div class="all-main-prof-bold">
                                                                Religion
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="all-main-prof-normal">
                                                            <?php echo $array2['id']; ?>
                                                            </div>
                                                            <div class="all-main-prof-normal">
                                                            <?php echo $array2['firstName']." ".$array2['lastName']; ?>
                                                            </div>
                                                            <div class="all-main-prof-normal">
                                                            <?php echo $array2['education']; ?>
                                                            </div>
                                                            <div class="all-main-prof-normal">
                                                            <?php echo $array2['profession']; ?>
                                                            </div>
                                                            <div class="all-main-prof-normal">
                                                            <?php echo $array2['religion']; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-xs-6">
                                                    <div class="all-main-profile-detail">
                                                        <div class="all-main-profile-detail-div-2">
                                                            <div class="all-main-prof-bold">
                                                                Location
                                                            </div>
                                                            <div class="all-main-prof-bold">
                                                                Caste
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
                                                            <?php echo $array2['city']; ?>
                                                            </div>
                                                            <div class="all-main-prof-normal">
                                                            <?php echo $array2['caste']; ?>
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
                                                <div class="col-md-3">
                                                    <div class="all-main-profile-right">
                                                        <div class="all-main-profile-right-in">
                                                            <span class="all-main-profile-right-btn">
                                                                <i class="fas fa-envelope" style="margin-right:10px;"></i>Send Message
                                                            </span>
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
                                                <a href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $previous; ?> ">
                                                    <div class="col-lg-3 col-xs-12" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            <span style="margin-right:15px; font-size:16px" class="glyphicon glyphicon-chevron-left"></span>
                                                            Pervious
                                                        </button>
                                                    </div>
                                                </a>
                                                <?php if($firstOne != 1){?>
                                                <a href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $firstOne-1;?>">
                                                    <div class="col-lg-1 col-xs-2" style="padding:0px">
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
                                                                <a href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $arrayOfIndexes[$row][$thisRow];?>">
                                                                    <div class="col-lg-1 col-xs-2" style="padding:0px">
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
                                                <a href="#">
                                                    <div class="col-lg-3 col-xs-12" style="padding:0px">
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
                                                                <a href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $arrayOfIndexes[$row][$thisRow];?>">
                                                                    <div class="col-lg-1 col-xs-2" style="padding:0px">
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
                                                <a href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $lastOne;?>">
                                                    <div class="col-lg-1 col-xs-2" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            <span style="margin-left:-3px;"><?php echo $lastOne;?>
                                                            <span style="font-size:12px; margin-left:-3px" class="glyphicon glyphicon-menu-right"></span>
                                                        </button>
                                                    </div>
                                                </a>
                                                <?php }?>
                                                <a href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $page+1; ?>  ">
                                                    <div class="col-lg-3 col-xs-12" style="padding:0px">
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
                                                                <a href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $arrayOfIndexes[$row][$thisRow];?>">
                                                                    <div class="col-lg-1 col-xs-2" style="padding:0px">
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
                                                <a href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $lastOne;?>">
                                                    <div class="col-lg-1 col-xs-2" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            <span style="margin-left:-3px;"><?php echo $lastOne;?></span>
                                                            <span style="font-size:12px; margin-left:-3px" class="glyphicon glyphicon-menu-right"></span>
                                                        </button>
                                                    </div>
                                                </a>
                                                <?php }?>
                                                <a href="<?php echo "../../".$category_name."/".$url."/"?><?php echo $page+1; ?>  ">
                                                    <div class="col-lg-3 col-xs-12" style="padding:0px">
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
                                    <div class="container-fluid" style="background-color:white; font-size:40px; padding:20px;  text-align:center; 
                                    border:1px solid lightgray; color #333333; border-radius:4px;">
                                        No Profile found for <?php echo $category; ?>!<br>
                                        <h5>Select input fields from above and search for more/different results.</h5>
                                    </div>
                                <?php }?>
                                </div>
                                
                                
                                <div id="RightSideBar" class="col-lg-3 col-md-2 col-sm-12 col-xs-12 cat-right-side-bar">
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
                                                            <a href="../../check-category/gender/<?php echo $r['url'];?>" class="rishta-div-body-link" >
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
                                            Rishty by Clan
                                        </div>
                                        <?php
                                            $result=mysqli_query($conn, "select * from clan");
                                            if(mysqli_num_rows($result) > 0){
                                                while($r=mysqli_fetch_array($result)){?>
                                                    <div class="rishta-div-body">
                                                        <a href="../../check-category/clan/<?php echo $r['url'];?>" class="rishta-div-body-link" >
                                                            <?php echo ucwords(str_replace('-', ' ', $r['url']));?>
                                                        </a>
                                                    </div>
                                                <?php }
                                            }
                                        ?>
                                    </div>
                                    <div class="right-div">
                                        <div class="rishta-div-head">
                                            Rishty by City
                                        </div>
                                        <?php
                                            $result=mysqli_query($conn, "select * from city limit 10");
                                            if(mysqli_num_rows($result) > 0){
                                                while($r=mysqli_fetch_array($result)){?>
                                                    <div class="rishta-div-body">
                                                        <a href="../../check-category/city/<?php echo $r['url'];?>" class="rishta-div-body-link" >
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
                                                        <a href="../../check-category/familyaffluence/<?php echo $r['url'];?>" class="rishta-div-body-link" >
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
                                                        <a href="../../check-category/familytype/<?php echo $r['url'];?>" class="rishta-div-body-link" >
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
                                                        <a href="../../check-category/familyvalues/<?php echo $r['url'];?>" class="rishta-div-body-link" >
                                                            <?php echo ucwords(str_replace('-', ' ', $r['url']));?>
                                                        </a>
                                                    </div>
                                                <?php }
                                            }
                                        ?>
                                    </div>
                        
					            </div>
                                <div class="col-md-9" style="margin:50px 0px">
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