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

<title><?php echo $tit=str_replace('-', ' ', $_GET['url']);?> - RISHTAWEB</title>
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

$sql="select * from $category_name where url='$url' ";
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
    <div class="container">
        <div class="row"> 
            <div class="col-md-12 p-0">
                <div class="all-main-div">
                    <div class="row">
                        <div class="col-md-9"> 
                        

                            <div class="cat-text-div">
                                <h1 class="h1-title">
                                    <?php echo $tit=str_replace('-', ' ', $_GET['url']);?>
                                </h1>
                                    <?php
                                    $result=mysqli_query($conn, "select * from articles where name='forall' ");
                                    while($r=mysqli_fetch_array($result)){
                                        echo $r['section'];
                                    }
                                    ?>
                                
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
                                                            <span class="all-main-profile-right-btn">Send Message</span>
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
                                    <div class="container-fluid" style="background-color:#CCCCCC; font-size:40px; padding:20px;  text-align:center">
                                        No record Found
                                    </div>
                                <?php }?>
                                </div>
                                
                                
                                <div class="col-lg-3 col-md-2 col-sm-12 col-xs-12" id="RightSideBar">
                                    <?php
                                    if(!isset($_SESSION['firstPersonId'])){?>
                                        <div class="right-div">
                                            <div class="rishta-div-head">
                                                Rishta by Gender
                                            </div>
                                            <div class="rishta-div-body">
                                                <a href="../../check-category/gender/male-rishta-in-pakistan" class="rishta-div-body-link">Female Rishta</a>
                                            </div>
                                            <div class="rishta-div-body">
                                                <a href="../../check-category/gender/female-rishta-in-pakistan" class="rishta-div-body-link" >Male Rishta</a>
                                            </div>
                                        </div>
                                    <?php }?>
                                    <div class="right-div">
                                        <div class="rishta-div-head">
                                            Rishty by Clan
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/clan/punjabi-rishta-in-pakistan" class="rishta-div-body-link" >Rishta in Punjabi Family</a>
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/clan/sindhi-rishta-in-pakistan" class="rishta-div-body-link" >Rishta in sindhi Family</a>
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/clan/baloch-rishta-in-pakistan" class="rishta-div-body-link" >Rishta in baloch Family</a>
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/clan/pashtun-rishta-in-pakistan" class="rishta-div-body-link" >Rishta in pashtun Family</a>
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/clan/saraiki-rishta-in-pakistan" class="rishta-div-body-link" >Rishta in saraiki Family</a>
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/clan/brouhi-rishta-in-pakistan" class="rishta-div-body-link" >Rishta in brouhi Family</a>
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/clan/irani-rishta-in-pakistan" class="rishta-div-body-link" >Rishta in irani Family</a>
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/clan/arab-rishta-in-pakistan" class="rishta-div-body-link" >Rishta in arab Family</a>
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/clan/turk-rishta-in-pakistan" class="rishta-div-body-link" >Rishta in turk Family</a>
                                        </div>
                                    </div>
                                    <div class="right-div">
                                        <div class="rishta-div-head">
                                            Rishty by Family Affluence
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/familyaffluence/rishta-in-upper-middle-class-family" class="rishta-div-body-link">upper middle class</a>
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/familyaffluence/rishta-in-middle-class-family" class="rishta-div-body-link">middle class</a>
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/familyaffluence/rishta-in-lower-class-family" class="rishta-div-body-link">lower class</a>
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/familyaffluence/rishta-in-affluent-family" class="rishta-div-body-link">Affluent</a>
                                        </div>
                                    </div>
                                    <div class="right-div">
                                        <div class="rishta-div-head">
                                            Rishty by Family Type
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/familytype/rishta-in-joint-family" class="rishta-div-body-link">joint family</a>
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/familytype/rishta-in-nuclear-family" class="rishta-div-body-link">nuclear family</a>
                                        </div>
                                    </div>
                                    <div class="right-div">
                                        <div class="rishta-div-head">
                                            Rishty by Family Values
                                        </div>
                                    <div class="rishta-div-body">
                                            <a href="../../check-category/familyvalues/rishta-in-traditional-family" class="rishta-div-body-link">traditional family</a>
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/familyvalues/rishta-in-moderate--family" class="rishta-div-body-link">moderan family</a>
                                        </div>
                                        <div class="rishta-div-body">
                                            <a href="../../check-category/familyvalues/rishta-in-liberal-family" class="rishta-div-body-link">liberal family</a>
                                        </div>	
                                    </div>
                        
					            </div>
                                <div class="col-md-9" style="margin:50px 0px">
                                    <div class="cat-above-foot-sec">
                                        <div class="cat-text-div">
                                            <h1>Arain Rishta in pakistan</h1>
                                            <?php
                                            $result=mysqli_query($conn, "select * from articles where name='forall' ");
                                            while($r=mysqli_fetch_array($result)){
                                                echo $r['section2'];
                                            }
                                            ?>
                                        </div>
                                        <div class="cat-text-div">
                                            <h1>Arain Rishta in pakistan</h1>
                                            <?php
                                            $result=mysqli_query($conn, "select * from articles where name='forall' ");
                                            while($r=mysqli_fetch_array($result)){
                                                echo $r['section3'];
                                            }
                                            ?>
                                        </div>
                                    </div>
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

</body>
</html>