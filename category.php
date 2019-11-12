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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('inc/pages/links-one.php');?>



<!---Pagination--->
<?php		
$category_name=$_GET['name'];
$url=$_GET['url'];	
$sql="select * from $category_name where url='$url' ";
$result=mysqli_query($conn, $sql);
while($r=mysqli_fetch_array($result)){
    $category=$r['name'];
}

$sql="SELECT * FROM signup where $category_name='$category' ";	//Change your table name and colunm
$query_count=mysqli_query($conn, $sql);				
$per_page =10;					//Change number of items on one page
$count = mysqli_num_rows($query_count);
$pages = ceil($count/$per_page);
if(@$_GET['page']==""){		$page="1";	}
else{	$page=$_GET['page'];	}
$start = ($page - 1) * $per_page;
echo $sql   = $sql." LIMIT $start,$per_page ";
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

<title><?php echo $title;?></title>

</head>
<body>
    
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
                        <div class="col-md-1"></div>
                        <div class="col-md-10">

                            <div class="cat-text-div">
                                <h1>Arain Rishta in pakistan</h1>
                                <h2><?php echo "category: ".$_GET['name']."<br> url: ".$_GET['url']?></h2>
                            </div>

                            <?php
                            
                            if(@mysqli_num_rows($query2) > 0){
                                while($array2=mysqli_fetch_array($query2)){?>
                                    
                                    <a href="viewprofile.php?id=<?php echo $array2['id'];?>" class="all-div-link">
                                        <div class="all-main-prof">
                                            <div class="container-fluid p-0">
                                                <div class="col-md-2 col-xs-12">
                                                    <div class="all-main-div1">
                                                        <div class="all-main-div-img">
                                                        
                                                            <?php
                                                            if (!isset($_SESSION["firstPersonId"])){?>
                                                                <?php if($array2["gender"]=="male"){?><img src="assets/allpics/mlogin.png" height="100%" width="100%" alt="User Image"/><?php }
                                                                else{?><img src="assets/allpics/flogin.png" height="100%" width="100%" alt="User Image"/><?php } ?>
                                                            <?php }
                                                            else{?>
                                                                <?php if($array2["publicProfile"]!="Private"){?>
                                                                <img src="<?php echo $array2['uploadProfilePicture']; ?>"	height="100%" width="100%" style="border-radius:2px;" alt="User Image"> 
                                                                <?php }else if($array2["gender"]=="male"){?><img src="assets/allpics/male4.png" height="100%" width="100%" alt="User Image"/><?php }
                                                                else{?><img src="assets/allpics/female4.png" height="100%" width="100%" alt="User Image"/><?php } ?>
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
                                                <div class="col-md-4 col-xs-6">
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
                                            </div>
                                        </div>
                                    </a>

                            <?php
                             } }
                            else{
                                echo 'no record found';
                            }
                            ?>


                            <!-- pagination -->
                            <?php if($page <= $pages && $page>0 ){?>	
                                <div class="col-lg-12 col-xs-12">
                                    <div class="col-lg-12 col-xs-12" style=" height:auto; padding:0px">
                                        <?php	if( $page>1 ){	$previous=$page-1; ?>
                                                <a href="category.php?page=<?php echo $previous; ?> ">
                                                    <div class="col-lg-3 col-xs-12" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            <span style="margin-right:15px; font-size:16px" class="glyphicon glyphicon-chevron-left"></span>
                                                            Pervious
                                                        </button>
                                                    </div>
                                                </a>
                                                <?php if($firstOne != 1){?>
                                                <a href="category.php?page=<?php echo $firstOne-1;?>">
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
                                                                <a href="category.php?page=<?php echo $arrayOfIndexes[$row][$thisRow];?>">
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
                                                                <a href="category.php?page=<?php echo $arrayOfIndexes[$row][$thisRow];?>">
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
                                                <a href="category.php?page=<?php echo $lastOne;?>">
                                                    <div class="col-lg-1 col-xs-2" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            <span style="margin-left:-3px;"><?php echo $lastOne;?>
                                                            <span style="font-size:12px; margin-left:-3px" class="glyphicon glyphicon-menu-right"></span>
                                                        </button>
                                                    </div>
                                                </a>
                                                <?php }?>
                                                <a href="category.php?page=<?php echo $page+1; ?>  ">
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
                                                                <a href="category.php?page=<?php echo $arrayOfIndexes[$row][$thisRow];?>">
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
                                                <a href="category.php?page=<?php echo $lastOne;?>">
                                                    <div class="col-lg-1 col-xs-2" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            <span style="margin-left:-3px;"><?php echo $lastOne;?></span>
                                                            <span style="font-size:12px; margin-left:-3px" class="glyphicon glyphicon-menu-right"></span>
                                                        </button>
                                                    </div>
                                                </a>
                                                <?php }?>
                                                <a href="category.php?page=<?php echo $page+1; ?>  ">
                                                    <div class="col-lg-3 col-xs-12" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            Next<span style="margin-left:15px; font-size:16px" class="glyphicon glyphicon-chevron-right"></span>
                                                        </button>
                                                    </div>
                                                </a>
                                        <?php }	?>					
                                    </div>
                                </div>			
                                <?php }	else{ ?>
                                <div class="container-fluid" style="background-color:#CCCCCC; font-size:40px; padding:20px; height:450px; text-align:center">
                                    <?php echo "Error:This Page is Not Available!"; }?>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="cat-above-foot-sec">
            <div class="cat-text-div">
                <h1>Arain Rishta in pakistan</h1>
                <h6>
                This is content for arain 
                </h6>
            </div>
            <div class="cat-text-div">
                <h1>Arain Rishta in pakistan</h1>
                <h5>This is content for arain</h5>
            </div>
            <div class="cat-text-div">
                <h1>Arain Rishta in pakistan</h1>
                <h4>This is content for arain</h4>
            </div>
            

            </div>
        </div>
    </div>
</section>

<!-- footer -->
<?php include('inc/pages/footer.php');?>

</body>
</html>