<?php
session_start();
require '../connection/connect.php';

if (!isset($_SESSION["firstPersonId"]))
{
  header("location: ../../");
}


function test_input($data){
	global $conn;
	$data=trim($data);
	$data=stripslashes($data);
	$data=htmlspecialchars($data);
	$data=mysqli_real_escape_string($conn, $data);
	$data=str_replace("'", "", $data);
	$data=str_replace("`", "", $data);
	$data=str_replace("''", "", $data);
	$data=str_replace(";", "", $data);
	return $data;
}

$firstPerson=test_input($_SESSION["firstPersonId"]);
$secondPerson=test_input(@$_SESSION["secondPerson"]);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include('../pages/links-one.php');?>
</head>


<body>


<?php
			
			$newMembers=array();
			$i=0;
			
			$messageQuery=mysqli_query($conn, "select * from chatdetails where  fromID='$firstPerson' or toID='$firstPerson' order by id desc");
			while($messageArray=mysqli_fetch_array($messageQuery))
			{
				if(	$messageArray["fromID"] == $firstPerson )		{	$newMembers[$i]=$messageArray["toID"];	}
				else if( $messageArray["toID"] == $firstPerson )	{	$newMembers[$i]=$messageArray["fromID"];	}
				$i++;
			}
			$ready=array_filter(array_unique($newMembers));
			if(empty($ready))
			{?>
				<div class="container-fluid" style="  font-family:'Segoe UI'; border-radius:3px; background-color:#F9F9F9;
					font-size:16px; margin-top:90px; padding:10px; height:auto;  margin-bottom:30px; font-weight:600">No Conversation Found! 
					<p style=" font-size:12px; font-weight:400">Send message to someone by visiting their profile.</p>
				</div>
			<?php }
			
			
			foreach($ready as $value)	
			{
				$allOtherMembers=test_input($value);
				
				$result=mysqli_query($conn, "select * from signup where makeMeHide='Show' and id='$allOtherMembers' ");
				if(@mysqli_num_rows( $result) > 0 )
				{
				
			?>

				<a rel="nofollow" onclick = "removeNotification()" href="singleChat.php?allOtherMembers=<?php echo $allOtherMembers; ?>" style="color:#000000; 
								text-decoration:none; " id="singleChat">
					<div class="col-lg-12 col-xs-12" style="height:auto; padding:10px; padding-left:15px; padding-right:15px; border-top:1px solid #F0F0F0; 
					background-color:#FFFFFF;" >
					
	
						<div class="col-lg-1 col-md-1 col-sm-2 col-xs-2" style="padding:0px">
							<?php
							$result=mysqli_query($conn, "select * from signup where id=$allOtherMembers AND makeMeHide='show' limit 1");
							while($imageArray=mysqli_fetch_array($result))
							{
								if($imageArray["publicProfile"]!="Private")
								{?>
									<img src="<?php echo $imageArray["uploadProfilePicture"];?>"  
									style="border-radius:2px; height:40px; width:40px; border-radius:50%;" alt="View User Image">
								<?php 
								}
								else if($imageArray["gender"]=="male")
								{
									?><img src="assets/allpics/male4.png" style="height:40px; width:40px; border-radius:50%;" alt="User Image"/><?php 
								}
								else
								{
									?><img src="assets/allpics/female4.png" style="height:40px; width:40px; border-radius:50%;" alt="User's Profile Picture"/><?php 
								}
							}			
							?>
						</div>
						<div class="col-lg-11 col-md-11 col-sm-10 col-xs-10" id="imagePadding">
							<div class="col-lg-12" style="font-size:14px; font-family:Helvetica; font-weight:600; padding:0px;
										text-overflow: ellipsis; white-space: nowrap; overflow: hidden; color:#00539c">
							
								<?php
								
								
								$result2=mysqli_query($conn, "select * from signup where id='$allOtherMembers' ");
								while($array2=mysqli_fetch_array($result2))
								{
								    echo "<div style='font-weight:400; color:#999999; margin-bottom:-4px; font-size:9px'>ID: ".$array2['id']."</div>";
									echo $firstName=$array2['firstName']." ".$lastName=$array2['lastName'];
									$sql1 = "select * from chatdetails where status = 'unread' and fromID=$firstPerson and toID=$allOtherMembers ";
									$result1 = $conn->query($sql1);
									$row1 = $result1->fetch_assoc();
									$count1 = $result1->num_rows;
								?>	
									<span style="text-align:right; font-size:14px; font-weight:500; float:right; color:#79c753; padding-right:15px">
										<?php if($count1 == 0){echo "<i class='fas fa-check-double'></i>";}
										else {?><span style="color:#CCCCCC"><?php echo "<i class='fas fa-check'></i>";}?></span>
									</span>	
								<?php 
									}
								?>	
								
								
							</div>
							<div style="font-size:12px; font-family:Helvetica; margin-top:5px; ">
						
								<?php
								$result3=mysqli_query($conn, "select * from chatdetails where ( fromID='$firstPerson' or toID='$firstPerson' ) AND
								( fromID='$allOtherMembers' or toID='$allOtherMembers' ) ORDER BY id DESC   LIMIT 1 ");
								
								while($array3=mysqli_fetch_array($result3))
								{
									echo "<div class='col-lg-10 col-xs-9' style='padding:0px;text-overflow:ellipsis; 
										  white-space:nowrap; overflow: hidden;'>".$array3['message']."</div>";
									echo "<div class='col-lg-2 col-xs-3' style='text-align:right; font-size:11px; color:#666666'>".$array3['date']."</div>";
								}
								?>					
						
							</div>
						</div>
						
						
					</div>
				</a>
	

			<?php
			}} //endForeach
			?>
							



</body>
</html>

















