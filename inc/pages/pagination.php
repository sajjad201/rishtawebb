<?php
session_start();
require 'inc/connection/connect.php';

?>







<!---EndPagination--->
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


//break integers into chunks and put into two dimessional array
$rowIndex=1;
$colIndex=1;
$chunk=4;						// Change number of indexes you want to show 5:1,2,3,4,5 will show 1 to five on first page
$arrayOfIndexes = array();
for($index=1; $index<=$pages; $index++)//get all integers from all "$pages": eg: pages=18; make chunks of 5 and put in array
{
	$arrayOfIndexes[$rowIndex][$colIndex]=$index;
	$colIndex++;
	if($index == $chunk)
	{
		$rowIndex=$rowIndex+1;
		$chunk=$chunk+4;		// Change also here number of indexes you want to show 5:1,2,3,4,5 will show 1 to five on first page
		$colIndex=1;
	}
}


//show and match integer chunk with pageValue eg:-pageValue=3:chunk == 12345 | pageValue=8:chunk=678910 
for($row=1; $row<=$pages; $row++)
{	
	@$lengthOfRow=count($arrayOfIndexes[$row]);
	
	for($col=1; $col<=$lengthOfRow; $col++)
	{
		if($arrayOfIndexes[$row][$col] == $page)//match or compare integers with pageValue
		{
			for($thisRow=1; $thisRow<=$lengthOfRow; $thisRow++)
			{
				$lastOne=$arrayOfIndexes[$row][$thisRow];	//show specific chunk here:[12345] or [678910]	
				if($thisRow==1)
				{
					$firstOne=$arrayOfIndexes[$row][$thisRow];
				}
			}
		}
	}
}

?><!---EndPagination--->







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="rishtaWebChat/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>pagination</title>
</head>

<body>




<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12" style="margin-top:10px;">
			<div class="col-lg-12"> </div>
			
			
			
			
		
<!---paginationStart--->
<?php if($page <= $pages && $page>0 ){?>	

			<div class="col-lg-12 col-xs-12" style="border:1px solid #CCCCCC; padding:10px">
				<div class="col-lg-12 col-xs-12" style=" height:auto; padding:0px">
					
					<?php	if( $page>1 ){	$previous=$page-1; ?>
					
							<a href="pagination.php?page=<?php echo $previous; ?> ">
								<div class="col-lg-3 col-xs-12" style="padding:0px">
									<button type="button" class="btn btn-default btn-block">
										<span style="margin-right:15px; font-size:16px" class="glyphicon glyphicon-chevron-left"></span>
										Pervious
									</button>
								</div>
							</a>
							
											<?php
							
											if($firstOne != 1)
											{
											?>
											
											<a href="pagination.php?page=<?php echo $firstOne-1;?>">
												<div class="col-lg-1 col-xs-2" style="padding:0px">
													<button type="button" class="btn btn-default btn-block">
													<span style="font-size:12px; margin-left:-10px;" class="glyphicon glyphicon-menu-left"></span>
														<span style="margin-left:-4px;"><?php echo $firstOne-1;?></span>
													</button>
												</div>
											</a>
											
										<?php }?>
							
						
							
									
					<?php }	if($page >= $pages){
					
							for($row=1; $row<=$pages; $row++)
							{
								@$lengthOfRow=count($arrayOfIndexes[$row]);
								for($col=1; $col<=$lengthOfRow; $col++)
								{
									if($arrayOfIndexes[$row][$col] == $page)
									{
										for($thisRow=1; $thisRow<=$lengthOfRow; $thisRow++)
										{
												
										?>
											<a href="pagination.php?page=<?php echo $arrayOfIndexes[$row][$thisRow];?>">
												<div class="col-lg-1 col-xs-2" style="padding:0px">
												
													<?php if( $page == $arrayOfIndexes[$row][$thisRow] ){?>
														<button type="button" class="btn btn-primary btn-block">
															<?php echo $arrayOfIndexes[$row][$thisRow];?>
														</button>
													<?php }else{?>
														<button type="button" class="btn btn-default btn-block">
															<?php echo $arrayOfIndexes[$row][$thisRow];?>
														</button>
															<?php }?>
													
												</div>
											</a>
										<?php	
										}
									}
								}
							}
							?>
					
							
							<a href="#">
								<div class="col-lg-3 col-xs-12" style="padding:0px">
									<button type="button" class="btn btn-default btn-block">
										Next<span style="margin-left:15px; font-size:16px" class="glyphicon glyphicon-chevron-right"></span>
									</button>
								</div>
							</a>
							<span class="col-lg-12 col-xs-12" style="display:block;color:#666666; font-family:Helvetica; font-size:12px; padding:0px;">
								End of Results
							</span>
							
						
						
					<?php }	else if($page==1){	
					
							for($row=1; $row<=$pages; $row++)
							{
								@$lengthOfRow=count($arrayOfIndexes[$row]);
								for($col=1; $col<=$lengthOfRow; $col++)
								{
									if($arrayOfIndexes[$row][$col] == $page)
									{
										for($thisRow=1; $thisRow<=$lengthOfRow; $thisRow++)
										{
												
										?>
											<a href="pagination.php?page=<?php echo $arrayOfIndexes[$row][$thisRow];?>">
												<div class="col-lg-1 col-xs-2" style="padding:0px">
													
													<?php if($page == $arrayOfIndexes[$row][$thisRow]){?>
														<button type="button" class="btn btn-primary btn-block">
															<?php echo $lastOne=$arrayOfIndexes[$row][$thisRow];?>
														</button>
													<?php }else{?>
															
														<button type="button" class="btn btn-default btn-block">
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
							if($pages >= $lastOne){
							?>
							
							
							<a href="pagination.php?page=<?php echo $lastOne;?>">
								<div class="col-lg-1 col-xs-2" style="padding:0px">
									<button type="button" class="btn btn-default btn-block">
										<span style="margin-left:-3px;"><?php echo $lastOne;?>
										<span style="font-size:12px; margin-left:-3px" class="glyphicon glyphicon-menu-right"></span>
									</button>
								</div>
							</a>
							
							<?php }?>
							
							
							<a href="pagination.php?page=<?php echo $page+1; ?>  ">
								<div class="col-lg-3 col-xs-12" style="padding:0px">
									<button type="button" class="btn btn-default btn-block">
										Next<span style="margin-left:15px; font-size:16px" class="glyphicon glyphicon-chevron-right"></span>
									</button>
								</div>
							</a>
							
							<?php }	else{	
							
							for($row=1;$row<=$pages;$row++)
							{
								@$lengthOfRow=count($arrayOfIndexes[$row]);
								for($col=1;$col<=$lengthOfRow;$col++)
								{
									if($arrayOfIndexes[$row][$col] == $page)
									{
										for($thisRow=1;$thisRow<=$lengthOfRow;$thisRow++)
										{
												
										?>
											<a href="pagination.php?page=<?php echo $arrayOfIndexes[$row][$thisRow];?>">
												<div class="col-lg-1 col-xs-2" style="padding:0px">
												
													<?php if( $page == $arrayOfIndexes[$row][$thisRow] ){?>
														<button type="button" class="btn btn-primary btn-block">
															<?php echo $lastOne=$arrayOfIndexes[$row][$thisRow];?>
														</button>
													<?php }else{?>
														<button type="button" class="btn btn-default btn-block">
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
							if($pages >= $lastOne){
							?>
							
							<a href="pagination.php?page=<?php echo $lastOne;?>">
								<div class="col-lg-1 col-xs-2" style="padding:0px">
									<button type="button" class="btn btn-default btn-block">
										<span style="margin-left:-3px;"><?php echo $lastOne;?></span>
										<span style="font-size:12px; margin-left:-3px" class="glyphicon glyphicon-menu-right"></span>
									</button>
								</div>
							</a>
							<?php }?>
							
							<a href="pagination.php?page=<?php echo $page+1; ?>  ">
								<div class="col-lg-3 col-xs-12" style="padding:0px">
									<button type="button" class="btn btn-default btn-block">
										Next<span style="margin-left:15px; font-size:16px" class="glyphicon glyphicon-chevron-right"></span>
									</button>
								</div>
							</a>
							
					<?php }	?>
					
					
				</div>
			</div>
			
			
			
			
			
<?php	}	else{ ?>
<div class="container-fluid" style="background-color:#CCCCCC; font-size:40px; padding:20px; height:450px; text-align:center">
	<?php echo "Error:This Page is Not Available!"; }?>
</div>			
<!---paginationEnded--->



			
			
			
			
			<div class="col-lg-3"></div>
		</div>
	</div>
</div>

</body>
</html>
