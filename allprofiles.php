<?php
session_start();
require 'inc/connection/connect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('inc/pages/links-one.php');?>


<!---Pagination--->
<?php					
$sql="SELECT id FROM signup";	//Change your table name and colunm
$query_count=mysqli_query($conn, $sql);				
$per_page =1;					//Change number of items on one page
$count = mysqli_num_rows($query_count);
$pages = ceil($count/$per_page);
if(@$_GET['page']==""){		$page="1";	}
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

<!-- body -->
<section class="all-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="all-main-div">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <?php for($i=0; $i<3; $i++){ ?>
                            <a href="#" class="all-div-link">
                                <div class="all-main-prof">
                                    <div class="container-fluid">
                                        <div class="col-md-3 col-xs-12">
                                            <div class="all-main-div-img">
                                                <img class="all-main-div-image" src="images/1132.jpg" alt="">
                                            </div>
                                            <div class="all-main-div-btn">
                                                <button class="btn btn-primary auto-center all-main-div-btn-pa">
                                                        Send Message
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-6">
                                            <div class="all-main-profile-detail">
                                                <div>
                                                    <div class="all-main-prof-bold">
                                                        Name
                                                    </div>
                                                    <div class="all-main-prof-bold">
                                                        Age
                                                    </div>
                                                    <div class="all-main-prof-bold">
                                                        City
                                                    </div>
                                                    <div class="all-main-prof-bold">
                                                        Gender
                                                    </div>
                                                    <div class="all-main-prof-bold">
                                                        Education
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="all-main-prof-normal">
                                                    Sajjad Ali
                                                    </div>
                                                    <div class="all-main-prof-normal">
                                                    25
                                                    </div>
                                                    <div class="all-main-prof-normal">
                                                    Lahore
                                                    </div>
                                                    <div class="all-main-prof-normal">
                                                    Male
                                                    </div>
                                                    <div class="all-main-prof-normal">
                                                    Matric
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-6">
                                            <div class="all-main-profile-detail">
                                                <div>
                                                    <div class="all-main-prof-bold">
                                                        Name
                                                    </div>
                                                    <div class="all-main-prof-bold">
                                                        Age
                                                    </div>
                                                    <div class="all-main-prof-bold">
                                                        City
                                                    </div>
                                                    <div class="all-main-prof-bold">
                                                        Religion
                                                    </div>
                                                    <div class="all-main-prof-bold">
                                                        Family Class
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="all-main-prof-normal">
                                                    Sajjad Ali
                                                    </div>
                                                    <div class="all-main-prof-normal">
                                                    25
                                                    </div>
                                                    <div class="all-main-prof-normal">
                                                    Lahore
                                                    </div>
                                                    <div class="all-main-prof-normal">
                                                    Islam
                                                    </div>
                                                    <div class="all-main-prof-normal">
                                                    Middle Class
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <?php }; ?>

                            <!-- pagination -->
                            <?php if($page <= $pages && $page>0 ){?>	
                                <div class="col-lg-12 col-xs-12">
                                    <div class="col-lg-12 col-xs-12" style=" height:auto; padding:0px">
                                        <?php	if( $page>1 ){	$previous=$page-1; ?>
                                                <a href="allprofiles.php?page=<?php echo $previous; ?> ">
                                                    <div class="col-lg-3 col-xs-12" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            <span style="margin-right:15px; font-size:16px" class="glyphicon glyphicon-chevron-left"></span>
                                                            Pervious
                                                        </button>
                                                    </div>
                                                </a>
                                                <?php if($firstOne != 1){?>
                                                <a href="allprofiles.php?page=<?php echo $firstOne-1;?>">
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
                                                                <a href="allprofiles.php?page=<?php echo $arrayOfIndexes[$row][$thisRow];?>">
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
                                                                <a href="allprofiles.php?page=<?php echo $arrayOfIndexes[$row][$thisRow];?>">
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
                                                <a href="allprofiles.php?page=<?php echo $lastOne;?>">
                                                    <div class="col-lg-1 col-xs-2" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            <span style="margin-left:-3px;"><?php echo $lastOne;?>
                                                            <span style="font-size:12px; margin-left:-3px" class="glyphicon glyphicon-menu-right"></span>
                                                        </button>
                                                    </div>
                                                </a>
                                                <?php }?>
                                                <a href="allprofiles.php?page=<?php echo $page+1; ?>  ">
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
                                                                <a href="allprofiles.php?page=<?php echo $arrayOfIndexes[$row][$thisRow];?>">
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
                                                <a href="allprofiles.php?page=<?php echo $lastOne;?>">
                                                    <div class="col-lg-1 col-xs-2" style="padding:0px">
                                                        <button type="button" class="btn btn-default btn-block pagination-btn">
                                                            <span style="margin-left:-3px;"><?php echo $lastOne;?></span>
                                                            <span style="font-size:12px; margin-left:-3px" class="glyphicon glyphicon-menu-right"></span>
                                                        </button>
                                                    </div>
                                                </a>
                                                <?php }?>
                                                <a href="allprofiles.php?page=<?php echo $page+1; ?>  ">
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

<!-- footer -->
<?php include('inc/pages/footer.php');?>

</body>
</html>