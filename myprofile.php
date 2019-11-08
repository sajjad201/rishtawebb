<?php
session_start();
require 'inc/connection/connect.php';

if (!isset($_SESSION["firstPersonId"]))
{
  header("location: /");
}

$firstPerson=$_SESSION["firstPersonId"];
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


if($_SERVER['REQUEST_METHOD']=="POST")
{		
	function test_input($data)
	{
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

	if(isset($_POST["hideOrPublicForm"]))
	{
		$publicProfile=test_input($_POST['makeMeHide']);
		$stmt = $conn->prepare("UPDATE signup SET makeMeHide=? WHERE id=? ");
		$stmt->bind_param("ss", $publicProfile, $firstPerson);
		$stmt->execute();
		$stmt->close();
	}
	
	if(isset($_POST["deleteMyProfile"]))
	{
		$deleteMyProfile=test_input($_POST['deleteMyProfile']);
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "From: $firstPerson" . "\r\n" .
		"Reply-To: $firstPerson" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();
		//mail("rishtawebteam@gmail.com", "DELETED", $deleteMyProfile, $headers  );
		
		mysqli_query($conn,"DELETE FROM login WHERE id=$firstPerson");
		mysqli_query($conn,"DELETE FROM signup WHERE id=$firstPerson");
		unset($_SESSION['firstPersonId']);
		header("location:/");
	}
}	




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include('inc/pages/links-one.php');?>
</head>

<body style=" background-color:#F0F0F0"> 

<!-- login-navbar -->
<?php include('inc/pages/navbar-login.php');?>




<h1 style="display:none">My Profile</h1>

<?php
$result=mysqli_query($conn, "select * from signup where id=$firstPerson limit 1");
while($queryArray=mysqli_fetch_array($result)){?>
<div class="container-fluid" id="pageTop">
	<div class="row">
		<div class="col-lg-12" style="padding:0px">
			<div class="col-lg-12" style="padding:0px">
				<div class="col-lg-1"></div>
				<div class="col-lg-10 col-xs-12" id="whitePage">
				
				<?php if($queryArray["makeMeHide"] != "Show"){?>
					<div class="alert alert-warning" style=" text-align:center; border-radius:2px;">
					  <a rel="nofollow" href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong>
					  	<i class="fas fa-exclamation-triangle" style="margin-right:20px"></i>
					  	<strong style="font-weight:800">YOUR PROFILE IS HIDDEN!</strong><br />
						No one can view or contact with you because your profile is Hidden!<br />
						You can send Messages but these will be recieved by other members only when Your profile is visible to others. 
					</strong>
					</div>
				<?php }?>
				
				<div class="col-lg-12 col-xs-12" id="hideBorder">
		
					<div class="col-lg-12" style="padding:0px">
						<div class="col-lg-2" style="padding:0px; margin-bottom:10px; margin-top:20px">
							<div class="col-lg-12" style="border:3px solid #FFFFFF; box-shadow:0px 0px 2px; height:155px; width:155px; overflow:hidden; 
														border-radius:50%; margin-left:auto; margin-right:auto; padding:0px">
								
								<a rel="nofollow" href="#" data-toggle="modal" data-target="#showMyImage">
									<?php if($queryArray["publicProfile"]!="Private"){?>
									<img src="<?php echo $queryArray['uploadProfilePicture']; ?>" height="100%" width="100%" style="border-radius:2px;" alt="My Profile Picture">
									<?php }
									else if($queryArray["gender"]=="male"){?><img src="allpics/male4.png" height="100%" width="100%" alt="My Profile Picture"/><?php }
									else{?><img src="allpics/female4.png" height="100%" width="100%" alt="My Profile Picture"/><?php } ?>
								</a>
							</div>
							
							<!---modal--->
							<div class="modal fade" id="showMyImage" role="dialog" style="margin-top:-2px">
								<div class="modal-dialog">
									<div class="modal-content" style="display:inline-block; margin: 0 auto; border-radius:2px; background-color:#F2F2F2">
										<div class="modal-header" style="padding:0px; padding-right:14px; padding-bottom:10px; border:none">
											<i class="fas fa-times close" data-dismiss="modal" style="font-size:35px; margin-right:10px; 
												margin-top:10px; color:#008f99; opacity:1"></i>
										</div>
										<div class="modal-body">
										<?php if($queryArray["publicProfile"]!="Private"){?>
										<img src="<?php echo $queryArray['uploadProfilePicture']; ?>"
										 style="border-radius:2px; max-height:100%; max-width:100%; " alt="My Profile Picture">
										 <?php }
										else if($queryArray["gender"]=="male"){?><img src="allpics/male4.png" height="300px" width="300px" alt="My Profile Picture" /><?php }
										else{?><img src="allpics/female4.png" height="300px" width="300px" alt="My Profile Picture" /><?php } ?>
										</div>
										<div class="modal-footer" style="text-align:center; border:none">
											<a href="updateProfilePicture.php" style=" text-decoration:none; padding:10px; margin-top:15px; border:1px solid #00474d; color:#FFFFFF;
											 border-radius:3px; font-weight:600; background-color:#005960; font-family:'Segoe UI'; padding-left:80px; padding-right:80px">
											 	Update Profile Picture
											 </a>
										</div>
									</div>
								</div>
							</div>
							<!---//modal--->
							
							
							<a rel="nofollow" href="#" id="settings" style="cursor:pointer;  font-family:'Segoe UI'; text-decoration:none; display:inline">
								<div class="col-lg-12" id="settingBorder">
									<i class="fas fa-cog" style="margin-right:5px;"></i>Settings
								</div>
							</a>
							<script>
								$(document).ready(function(){
								  $("#settings").click(function(){
									$("#showSettings").toggle();
								  });
								});
							</script>
							
							<div class="col-lg-12" id="showSettings" style="margin-left:auto; margin-right:auto; padding:5px; width:155px; display:none;
								 border-radius:4px; text-align:center; background-color:#FFFFFF; margin-top:5px; padding-top:1px">
								<!--<a rel="nofollow" href="#" style="text-decoration:none; color:#333333">
									<div style="padding:5px; background-color:#F0F0F0; border-radius:3px; margin-bottom:5px; font-size:12px; font-family:Tahoma">
										Change Password
									</div>
								</a>-->
								<a href="update.php" style="text-decoration:none; color:#a9754f">
									<div id="buttonColor">
										<i class="fas fa-user-edit" style=" margin-right:3px"></i>Edit Profile
									</div>
								</a>
								<a rel="nofollow" href="#" style="text-decoration:none; color:#a9754f" data-toggle="modal" data-target="#HideProfile">
									<div id="buttonColor">
										<i class="far fa-eye-slash" style="margin-right:3px"></i>Hide/Show profile
									</div>
								</a>
								<a rel="nofollow" href="#" style="text-decoration:none; color:#a9754f" data-toggle="modal" data-target="#DeleteMyProfile">
									<div id="buttonColor">
										<i class="fas fa-trash" style="margin-right:3px"></i> Delete My Profile
									</div>
								</a>
							</div>
						</div>
											
<!---modal--->
<div class="modal fade" id="HideProfile" role="dialog" style="margin:auto 0; width:100%; margin-top:-2px;">
	<div class="modal-dialog">
		<div class="modal-content" style="display:inline-block; margin: 0 auto; border-radius:2px; background-color:#F0F0F0">
			<div class="modal-header" style="padding:0px; padding-right:14px; padding-top:5px; padding-bottom:10px; border:none">
				<i class="fas fa-times close" data-dismiss="modal" style="font-size:35px; margin-right:5px; color:#4f84c4; margin-top:5px; opacity:1"></i>
			</div>
			<div class="modal-body">
				<div class="container" style="padding:0px">
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-4"></div>
							<div class="col-lg-4" style="background-color:#FFFFFF;  padding-top:20px; padding-bottom:70px; border-radius:4px; box-shadow:0px 0px 10px">
								<div class="col-lg-12">
									<form class="form-horizontal" name="hideOrPublicForm" action="" method="post" enctype="multipart/form-data" >
									<span id="showHideProfile">Show or Hide Your Profile<br /></span>
									<span style="font-size:12px; font-weight:normal; font-family:'Segoe UI'; color:#C0C0C0">
										If profile is hidden, no one can contact/view your profile.<br /><br />
									</span>

									<div class="form-group">
										<div class="col-sm-12">
											<p style="text-align:left; font-family:'Segoe UI'; color:#FF8040; font-weight:600; font-size:18px">
												<?php if($queryArray["makeMeHide"] == "Show"){echo "Currently your profile is <strong>Public</strong>.";}
													 else{echo "Currently your profile is <strong>Hidden</strong>";}
												 ?>
											</p>
											<select class="form-control input-lg" name="makeMeHide" id="makeMeHide">
												<option value="<?php echo $queryArray["makeMeHide"];?>"><?php echo $queryArray["makeMeHide"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["makeMeHide"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="Hide My Profile">Hide My Profile</option>
												<option value="Show">Show</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<button type="submit" class="btn btn-info btn-lg btn-block" name="hideOrPublicForm" style="border-radius:2px;">
											Done</button>
										</div>
									</div>
									</form>
								</div>
							</div>
							<div class="col-lg-4"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!---//modal--->


<!---moda2--->
<div class="modal fade" id="DeleteMyProfile" role="dialog" style="margin:auto 0; width:100%; margin-top:-2px">
	<div class="modal-dialog">
		<div class="modal-content" style="display:inline-block; margin: 0 auto; border-radius:5px; background-color:#CCCCCC">
			<div class="modal-header" style="padding:0px; padding-right:14px; padding-top:5px; border-bottom:1px solid #666666;
				padding-bottom:10px; text-align:center; border:none;">
				<span style="font-size:35px; font-weight:600; color:#dd4132; text-decoration:underline"><i class="fas fa-trash" style="margin-right:20px;"></i>Delete Profile</span>
				<i class="fas fa-times close" data-dismiss="modal" style="font-size:35px; margin-right:5px; margin-top:10px; color:#800000; opacity:1"></i>
			</div>
			<div class="modal-body" style="margin-top:60px">
				<div class="container">
					<div class="row">
						<div class="col-lg-12" style="padding:0px">
							<div class="col-lg-3"></div>
							<div class="col-lg-6" style="background-color:#FFFFFF; padding-top:30px; padding-bottom:70px; border-radius:4px; border:1px solid #999999;">
								<div class="col-lg-12">
									<form class="form-horizontal" name="deleteMyProfileForm" action="" method="post" enctype="multipart/form-data" >
									<p id="writeFewLines">Write few lines why you want to delete your profile </p>
									
									<div class="form-group" style="margin-top:10px">
										<div class="col-lg-12">
										<div class="col-lg-11 col-sm-11 col-xs-10" style="font-size:12px; color:#999999; padding:1px; text-align:left; 
										padding:2px; border-radius:4px; margin-bottom:2px; ">
											min 20 char required!	
										</div>
											<div class="col-lg-1 col-sm-1 col-xs-2" id="countChar" style="font-size:12px; color:#999999; padding:1px; text-align:center; 
												border:1px solid #CCCCCC; padding:2px; border-radius:4px; margin-bottom:2px; float:right">
												0
											</div>
										</div>
										
										<div class="col-sm-12" style="text-align:left">
											<textarea class="form-control" id="deleteMyProfile" name="deleteMyProfile" 
											style="resize:vertical" rows="5" onBlur="DeleteMyProfile()" onKeyUp="countChar()"
											placeholder="tell us why u are deleting your account so that we could improve our features on this site." autofocus></textarea>
											<div id="explainYourselfError" style="font-size:12px; color:#BF0000;"><?php // echo $errorList["explainYourSelfErr"]; ?></div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<button type="button" class="btn btn-primary btn-lg btn-block" name="deleteMyProfileForm" 
											style="border-radius:2px; background-color:#dd4132; outline:none; border:none" onclick="Delete()">
											Delete</button>
										</div>
									</div>
									</form>
								</div>
							</div>
							<div class="col-lg-3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<script type="text/javascript"> 

function DeleteMyProfile()
{
	var countExplainYourself = document.deleteMyProfileForm.deleteMyProfile.value.length;

	if(document.deleteMyProfileForm.deleteMyProfile.value== 0)	    {document.getElementById("explainYourselfError").innerHTML="please explain yourself";
														 document.getElementById("deleteMyProfile").style.borderColor="red";}
	else if(countExplainYourself < 20)					{document.getElementById("explainYourselfError").innerHTML="minimum 20 char required";
														document.getElementById("deleteMyProfile").style.borderColor="red";}
	else if(countExplainYourself > 100)					{document.getElementById("explainYourselfError").innerHTML="Max 100 char are allowed";
														document.getElementById("deleteMyProfile").style.borderColor="red";}
	else												{document.getElementById("explainYourselfError").innerHTML="";
														 document.getElementById("deleteMyProfile").style.borderColor="#E5E5E5";return true;}
}

function Delete()
{
	if( DeleteMyProfile() == true )
	{
		document.deleteMyProfileForm.submit();
	}
}

function countChar()
{
	var countExplainYourself = document.deleteMyProfileForm.deleteMyProfile.value.length;
	
	if( countExplainYourself > 20 )
	{
		document.getElementById("countChar").style.color="green";
		document.getElementById("countChar").style.borderColor="green";
		document.getElementById("countChar").innerHTML=countExplainYourself;
	}
	else
	{	
		document.getElementById("countChar").style.color="#999999";
		document.getElementById("countChar").style.borderColor="#CCCCCC";
		document.getElementById("countChar").innerHTML=countExplainYourself;
	}
	
}

</script>
<!---//modal2--->


						<div class="col-lg-10" style="padding:0px; color:#755139; ">
							<div class="col-lg-12 col-xs-12" id="leftBorder" >
								<div class="col-lg-1 col-xs-12"></div>
								<div class="col-lg-11 col-xs-12" style="padding:0px; margin-left:-25px">
								
								<div class="col-lg-12" style="padding:0px; margin-top:30px">
									<div class="col-lg-1 col-xs-1" style="padding:0px;">
										<div id="firstIcon">
											<i class="fas fa-user-alt" id="firstIconChild"></i>
										</div>
									</div>
									<div class="col-lg-11 col-xs-11" style="padding-left:10px; padding-top:2px;  font-family:'Segoe UI'; padding-right:0px; padding-left:20px">
										<div class="col-lg-12" style="padding:0px;">
											<p style="font-size:17px; font-weight:600; color:#5a7247">My Profile Info</p>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12" style="padding:0px; border-bottom:1px solid #D7D7D7; margin-bottom:20px; 
											padding-bottom:20px; font-size:13px; line-height:25px; color:#000000; margin-top:2px">
											<div class="col-lg-12" style="padding:0px; margin-top:-12px;">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px;">
													<span style="word-spacing:0.2cm; "></span>
													<span style="font-size:14px; color:#000000">
														<?php echo $queryArray["firstName"]." ".$queryArray["lastName"];?>
													</span>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													My Profile <span style="word-spacing:0.2cm;">Id: </span>
													<span style="background-color:#EFEFEF; border-radius:3px; color:#6F9FD8; padding:1px; padding-left:6px; padding-right:6px;
													border:1px solid #CCCCCC; font-weight:600; font-size:16px">
														<?php echo $queryArray["id"];?>
													</span>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													Profile Created <span style="word-spacing:0.2cm;">By: </span>
													<?php echo $queryArray["profileCreatedBy"];?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px"></div>
											</div>
										</div>
									</div>	
								</div>

								<div class="col-lg-12 col-xs-12" style="padding:0px; margin-top:10px">
									<div class="col-lg-1 col-xs-1" style="padding:0px;">
										<div id="secondIcon">
											<i class="fas fa-info" id="secondIconChild"></i>
										</div>
									</div>
									<div class="col-lg-11 col-xs-11" style="padding-left:10px; padding-top:2px;  font-family:'Segoe UI'; padding-right:0px; padding-left:20px">
										<div class="col-lg-12" style="padding:0px;">
											<p style="font-size:17px; font-weight:600; color:#755139">Basic Info</p>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12" style="padding:0px; border-bottom:1px solid #D7D7D7; margin-bottom:20px; 
											padding-bottom:20px; font-size:13px; line-height:25px; color:#000000; margin-top:-4px">
											<div class="col-lg-12" style="padding:0px; margin-top:-10px">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px">
													<span style="word-spacing:0.2cm;">Age: </span>
													<?php $row11 = array('dob'=>$queryArray['dob']);	echo ageCalculator($row11['dob']);	?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													<span style="word-spacing:0.2cm;">Height: </span><?php echo $queryArray["height"]." ft";?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													<span style="word-spacing:0.2cm;">Profession: </span><?php echo $queryArray["profession"];?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													<span style="word-spacing:0.2cm;">Education: </span><?php echo $queryArray["education"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													<span style="word-spacing:0.2cm;">Location: </span>
													<?php if($queryArray["city"]!=""){echo $queryArray["city"].", ".$queryArray["country"];}else{echo $queryArray["country"];}?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px">
													Marital <span style="word-spacing:0.2cm;">Status: </span><?php echo $queryArray["maritalStatus"];?>
												</div>
											</div>
										</div>
									</div>	
								</div>	
								
								<div class="col-lg-12 col-xs-12" style="padding:0px; margin-top:10px">
									<div class="col-lg-1 col-xs-1" style="padding:0px;">
										<div id="thirdIcon">
											<i class="far fa-user" id="thirdIconChild"></i>
										</div>
									</div>
									<div class="col-lg-11 col-xs-11" style="padding-left:10px; padding-top:2px;  font-family:'Segoe UI'; padding-right:0px; padding-left:20px">
										<div class="col-lg-12" style="padding:0px;">
											<p style="font-size:17px; font-weight:600; color:#2E4A62">Life Style and personality</p>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12" style="padding:0px; border-bottom:1px solid #D7D7D7; margin-bottom:20px; 
											padding-bottom:20px; font-size:13px; line-height:25px; color:#000000; margin-top:-10px">
											<div class="col-lg-12" style="padding:0px;">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px">
													<span style="word-spacing:0.2cm;">Clan: </span><?php echo $queryArray["clan"];?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px">
													<span style="word-spacing:0.2cm;">Caste: </span><?php echo $queryArray["caste"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px; ">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													<span style="word-spacing:0.2cm;">Salary: </span><?php echo $queryArray["salary"];?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px">
													<span style="word-spacing:0.2cm;">Language: </span><?php echo $queryArray["language"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													Body <span style="word-spacing:0.2cm;">Type: </span><?php echo $queryArray["bodyType"];?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px">
													<span style="word-spacing:0.2cm;">Disability: </span><?php echo $queryArray["disability"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px; ">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px">
													Skin <span style="word-spacing:0.2cm;">Tone: </span><?php echo $queryArray["complexion"];?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px">
													<span style="word-spacing:0.2cm;">Religion: </span><?php echo $queryArray["religion"];?>
												</div>
											</div>
											
										</div>
									</div>	
								</div>	
							
								<div class="col-lg-12 col-xs-12" style="padding:0px; margin-top:10px">
									<div class="col-lg-1 col-xs-1" style="padding:0px">
										<div id="fourthIcon">
											<i class="fas fa-users" id="fourthIconChild"></i>
										</div>
									</div>
									<div class="col-lg-11 col-xs-11" style="padding-left:10px; padding-top:2px;  font-family:'Segoe UI'; padding-right:0px; padding-left:20px">
										<div class="col-lg-12" style="padding:0px;">
											<p style="font-size:17px; font-weight:600; color:#408080">Family Values</p>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12" style="padding:0px; border-bottom:1px solid #D7D7D7; margin-bottom:20px; 
											padding-bottom:20px; font-size:13px;	line-height:25px; color:#000000; margin-top:-2px">
											
											<div class="col-lg-12" style="padding:0px; margin-top:-10px;">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													Father <span style="word-spacing:0.2cm;">Status: </span><?php echo $queryArray["fatherStatus"];?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px">
													Mother <span style="word-spacing:0.2cm;">Status: </span><?php echo $queryArray["motherStatus"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px; ">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													No of <span style="word-spacing:0.2cm;">Brothers: </span><?php echo $queryArray["noOfBrothers"];?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px">
													No of <span style="word-spacing:0.2cm;">Sisters: </span><?php echo $queryArray["noOfSisters"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px; ">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													Family <span style="word-spacing:0.2cm;">Type: </span><?php echo $queryArray["familyType"];?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px">
													Family <span style="word-spacing:0.2cm;">Values: </span><?php echo $queryArray["familyValues"];?>
												</div>
											</div>						
											<div class="col-lg-12" style="padding:0px; ">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													Family <span style="word-spacing:0.2cm;">Affluence: </span><?php echo $queryArray["familyAffluence"];?>
												</div>
											</div>
											
										</div>
									</div>	
								</div>	
								
								<div class="col-lg-12 col-xs-12" style="padding:0px; margin-top:10px; margin-bottom:10px;">
									<div class="col-lg-1 col-xs-1" style="padding:0px">
										<div id="fifthIcon">
											<i class="fas fa-user-edit" id="fifthIconChild"></i>
										</div>
									</div>
									<div class="col-lg-11 col-xs-11" style="padding-left:10px; padding-top:2px;  font-family:'Segoe UI'; padding-right:0px; padding-left:20px">
										<div class="col-lg-12" style="padding:0px;">
											<p style="font-size:17px; font-weight:600; color:#c48f65">About Me</p>
										</div>
										<div class="col-lg-12" style="padding:0px; border-bottom:1px solid #D7D7D7; margin-bottom:20px; padding-bottom:40px; font-size:13px;">
											<div style="word-wrap:break-word; font-size:14px; margin-top:5px; color:#000000; margin-top:-8px">
												<?php echo $queryArray["aboutYourself"];?>
											</div><br /><br /><br /><br />
										</div>
									</div>	
								</div>	
					
								<div class="col-lg-12 col-xs-12" style="padding:0px; margin-top:10px; margin-bottom:50px;">
									<div class="col-lg-1 col-xs-1" style="padding:0px">
										<div id="sixthIcon">
											<i class="fas fa-user-friends" id="sixthIconChild"></i>
										</div>
									</div>
									<div class="col-lg-11 col-xs-11" style="padding-left:10px; padding-top:2px;  font-family:'Segoe UI'; padding-right:0px; padding-left:20px">
										<div class="col-lg-12" style="padding:0px;">
											<p style="font-size:17px; font-weight:600; color:#6b5b95">My Partner Prefrences</p>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12" style="padding:0px; border-bottom:1px solid #D7D7D7; margin-bottom:20px; 
											padding-bottom:20px; font-size:13px; line-height:25px; color:#000000; margin-top:-2px">
											<div class="col-lg-12" style="padding:0px; margin-top:-10px;">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													Height <span style="word-spacing:0.2cm;">Range: </span><?php echo $queryArray["pHeight"];?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px">
													Age <span style="word-spacing:0.2cm;">Range: </span><?php echo $queryArray["pAge"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px">
													<span style="word-spacing:0.2cm;">Religion: </span><?php echo $queryArray["pReligion"];?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													Marital <span style="word-spacing:0.2cm;">Status: </span><?php echo $queryArray["pMaritalStatus"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px">
													<span style="word-spacing:0.2cm;">Education: </span><?php echo $queryArray["pEducation"];?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; word-wrap:break-word">
													<span style="word-spacing:0.2cm;">Location: </span><?php echo $queryArray["pLocation"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													 <span style="word-spacing:0.2cm;">Language: </span><?php echo $queryArray["pLanguage"];?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													Skin <span style="word-spacing:0.2cm;">Tone: </span><?php echo $queryArray["pComplexion"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													 <span style="word-spacing:0.2cm;">Clan: </span><?php echo $queryArray["pClan"];?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; ">
													Family <span style="word-spacing:0.2cm;">Affluence: </span><?php echo $queryArray["pFamilyAffluence"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;">
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px; word-wrap:break-word">
													About <span style="word-spacing:0.2cm;">Partner: </span><?php echo $queryArray["pAbout"];?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6" style="padding:0px">
													<span style="word-spacing:0.2cm;"> </span><?php //echo $queryArray["pLocation"];?>
												</div>
											</div>
										</div>
									</div>	
								</div>	
								
								
						</div>
								
<?php }?>								
								
							
						</div>		
					</div>
						</div>
						<div class="col-lg-12"></div>
					</div>
					
				</div>
				<div class="col-lg-1"></div>
			</div>
			</div>
		</div>
	</div>
</div>

<?php include('inc/pages/footer.php');?>


</body>
</html>









