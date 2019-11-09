<?php
session_start();
require 'inc/connection/connect.php';


$firstPerson=$_SESSION["firstPersonId"];


if (!isset($_SESSION["firstPersonId"]))
{
  header("location: /");
}

if(isset($_GET["viewProfileId"]))
{
	$_SESSION["viewProfileId"]=$_GET["viewProfileId"];
}

if(!isset($_GET["viewProfileId"]))
{
	header("location: searchProfiles.php");
}

$viewProfileId=$_SESSION["viewProfileId"];

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


date_default_timezone_set("Asia/Karachi");
$timestamp = date('d/m/Y-h:i:s a', time());
$splitTimeStamp = explode("-",$timestamp);
$date = $splitTimeStamp[0];
$time = $splitTimeStamp[1];



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


?>









<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include('inc/pages/links-one.php');?>
</head>
<body style="background-color:#E2E2E2">

<!-- login-navbar -->
<?php include('inc/pages/navbar-login.php');?>


<h1 style="display:none">View Profile</h1>
<?php
$result=mysqli_query($conn, "select * from signup where id=$viewProfileId AND makeMeHide='show' limit 1");
if(@mysqli_num_rows( $result) > 0 ){
while($queryArray=mysqli_fetch_array($result)){?>
<!---center--->
<div class="container-fluid" id="whitePageMargin">
	<div class="row">
		<div class="col-lg-12" style="padding:0px">
			<div class="col-lg-2"></div>
			<div class="col-lg-8 col-xs-12" style="padding:0px; border-radius:15px;">
				<div class="col-lg-12 col-xs-12" id="whitePage">
			
					<div class="col-lg-3" id="imagePaddingBottom">
						<div id="imageDimensions">
						<a rel="nofollow" href="#" data-toggle="modal" data-target="#showImage">
							<?php if($queryArray["publicProfile"]!="Private"){?>
							<img src="<?php echo $queryArray['uploadProfilePicture']; ?>" height="100%" width="100%" style="border-radius:2px;" alt="View User Image">
							<?php }
							else if($queryArray["gender"]=="male"){?><img src="allpics/male4.png" height="100%" width="100%" alt="User Image"/><?php }
							else{?><img src="allpics/female4.png" height="100%" width="100%" alt="User's Profile Picture"/><?php } ?>
						</a>
						</div>
					</div>
					
					
					<!---modal--->
					<div class="modal fade" id="showImage" role="dialog">
						<div class="modal-dialog-i">
							<div class="modal-content-i" style="display:inline-block; margin: 0 auto; border-radius:2px; background-color:#000000">
								<div class="modal-header" style="padding:0px; padding-right:5px; padding-top:10px; border:none;">
									<i class="fas fa-times close" data-dismiss="modal" style="font-size:35px; margin-right:10px; margin-top:0px; color:#FFFFFF; opacity: 1;"></i>
								</div>
								<div class="modal-body-i" style="margin-top:10px; ">
									<?php if($queryArray["publicProfile"]!="Private"){?> 
									<img src="<?php echo $queryArray['uploadProfilePicture']; ?>" style="border-radius:2px; max-height:100%; max-width:100%" alt="View Full Size">
								 <?php }
								 else if($queryArray["gender"]=="male"){?><img src="allpics/male4.png" height="300px" width="300px" alt="Image in Full Size"/><?php } 
								 else{?><img src="allpics/female4.png" height="300px" width="300px" alt="Show Image"/><?php } ?>
								</div>
								<div class="modal-footer-i"></div>
							</div>
						</div>
					</div>
					<!---//modal--->
					
					<div class="col-lg-9" id="basicDetailsPadding">
						<div class="col-lg-12 col-xs-12" style="border-radius:3px; height:auto; padding:0px; background-color:#F9F9FF; border:1px solid #E8E8E8; ">
							<div class="col-lg-12 col-xs-12" style="padding-top:0px;  font-family:'Segoe UI'; padding-right:0px; color:#000000; padding-left:0px;">
							
								<div class="col-lg-12" style="padding:0px; border-radius:3px; border-bottom-left-radius:0px; padding:10px; border-bottom:1px solid #E0E0E0;  
														border-bottom-right-radius:0px; padding-left:16px; color:#333333; font-weight:600; font-size:20px; font-family:Calibri">
														<span style="color:#00539c"><?php echo $queryArray["firstName"]." ".$queryArray["lastName"];?></span>
														<span style="font-size:16px; float:right; font-weight:500; font-family:'Times New Roman'; margin-left:5px; color:#8080FF;
														background-color:#FFFFFF; padding:3px; padding-left:12px; border:1px solid #CCCCCC; padding-right:12px; border-radius:2px;">
														<?php echo "id: ".$queryArray["id"];?></span>
								</div>
									<div class="col-lg-12" style="padding:0px; padding-left:20px; color:#333333;">
									
										<div class="col-lg-6" style="padding:0px; font-size:13px; margin-top:17px">
											<i data-toggle="tooltip" data-placement="top" title="age" class="fas fa-user-clock" style="margin-right:10px; color:#88b04b"></i>
											<span>
													I am <?php $row11 = array('dob'=>$queryArray['dob']);	echo ageCalculator($row11['dob']);	?> old
											</span>
										</div>
										<div class="col-lg-6" style="padding:0px; font-size:13px;  margin-bottom:6px; margin-top:17px">
											<i class="fas fa-male" data-toggle="tooltip" data-placement="top" title="height" 
											style="margin-right:10px; color:#97979b; font-size:16px; margin-left:4px"></i>
											 <span style="margin-left:6px">
												My height is <?php echo $queryArray["height"]." ft";?>
											 </span>
										</div>
										<div class="col-lg-6" style="padding:0px; font-size:13px; margin-top:17px">
											<i class="fas fa-user-graduate" data-toggle="tooltip" data-placement="top" title="education" style="margin-right:10px;"></i>
											<span style="margin-left:5px">
												My education: <?php echo $queryArray["education"];?>
											</span>
										</div>
										<div class="col-lg-6" style="padding:0px; font-size:13px; margin-top:17px ">
											<i class="fas fa-map-marker-alt" data-toggle="tooltip" data-placement="top" title="country"
											style="margin-right:10px; color:#e47a2e; margin-left:1px"></i>
											<span style=" margin-left:5px">
											I lives in <?php if($queryArray["city"]!=""){echo $queryArray["city"].", ".$queryArray["country"];}else{echo $queryArray["country"];}?>
											</span>
										</div>
										<div class="col-lg-6" style="padding:0px; font-size:13px; margin-top:17px">
											<i class="fas fa-user-edit" data-toggle="tooltip" data-placement="top" title="profile created by"
											style="margin-right:10px; color:#00539c;" ></i>
											<span style=" margin-left:2px">
												This profile is created by <?php echo $queryArray["profileCreatedBy"];?>
											</span>
										</div>
										<div class="col-lg-6" style="padding:0px; font-family:'Segoe UI'; font-size:14px; margin-top:17px; margin-bottom:15px">
											<i class="fas fa-chalkboard-teacher" data-toggle="tooltip" data-placement="top" title="profession"
											style="margin-right:10px; color:#00a591"></i>
											<span style="font-family:'Segoe UI'" >
													My current status: <?php echo $queryArray["profession"];?>
											</span>
										</div>
										
										
										<!---tooltip--->
										<script>
										$(document).ready(function(){
										  $('[data-toggle="tooltip"]').tooltip();   
										});
										</script>
										<!---tooltip--->
										
										
								</div>
							</div>
						</div>
					</div><!--EndClass="col-lg-9"-->
				
					<div class="col-lg-12 col-xs-12" style="margin-top:30px; padding-left:20px; padding-right:20px;">
						<div class="col-lg-12" style="padding:0px; ">
							<div class="col-lg-1 col-xs-1" id="iconPadding">
								<div style="height:30px; width:30px; border-radius:50%; background-color:#b76ba3; padding-top:10px; padding-left:6px; 
															text-align:center; margin-left:-8px; ">
									<i class='fas fa-quote-left' style=" margin-right:5px; color:#FFFFFF; font-size:10px"></i>								
								</div>
							</div>
							<div class="col-lg-11 col-xs-11" id="iconPaddingRight">
											<span style="color:#b76ba3">About Myself</span>
								<div style="font-weight:normal; font-size:13px; margin-top:5px; word-wrap:break-word"><?php echo $queryArray["aboutYourself"];?></div>
								<div style="padding:0px; border-bottom:1px solid #EFEFEF; margin-top:30px; margin-bottom:30px;"></div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-12 col-xs-12" style="padding-left:20px; padding-right:20px;">
						<div class="col-lg-12" style="padding:0px">
							<div class="col-lg-1 col-xs-1" id="iconPadding">
								<div style="height:30px; width:30px; border-radius:50%; background-color:#00a591; padding-top:8px; padding-left:5px; 
															text-align:center; margin-left:-8px">
									<i class='far fa-user' style="margin-right:5px; color:#FFFFFF; font-size:14px"></i>	
								</div>
								
							</div>
							<div class="col-lg-11 col-xs-10" id="iconPaddingRight">
											<span style="color:#00a591">Life Style and personality</span>
								<div class="col-lg-12" style="padding:0px;  font-weight:normal; font-size:13px; margin-top:5px">
									<div class="col-lg-12" style="padding:0px; margin-top:-4px;">
									    <div class="col-lg-6" style="padding:0px; margin-top:8px;">
											<span style="word-spacing:0.2cm;">Caste: </span><span style="font-weight:600"><?php echo $queryArray["caste"];?></span>
										</div>
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											<span style="word-spacing:0.2cm;">Clan: </span><span style="font-weight:600"><?php echo $queryArray["clan"];?></span>
										</div>
									</div>
									<div class="col-lg-12" style="padding:0px;">
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											<span style="word-spacing:0.2cm;">Salary: </span><span style="font-weight:600"><?php echo $queryArray["salary"];?></span>
										</div>
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											<span style="word-spacing:0.2cm;">Language: </span><span style="font-weight:600"><?php echo $queryArray["language"];?></span>
										</div>
									</div>
									<div class="col-lg-12" style="padding:0px; ">
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											 Body <span style="word-spacing:0.2cm;">Type: </span><span style="font-weight:600"><?php echo $queryArray["bodyType"];?></span>
										</div>
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											<span style="word-spacing:0.2cm;">Disability: </span><span style="font-weight:600"><?php echo $queryArray["disability"];?></span>
										</div>
									</div>
									<div class="col-lg-12" style="padding:0px; ">
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											Skin <span style="word-spacing:0.2cm;">Tone: </span><span style="font-weight:600"><?php echo $queryArray["complexion"];?></span>
										</div>
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											<span style="word-spacing:0.2cm;">Religion: </span><span style="font-weight:600"><?php echo $queryArray["religion"];?></span>
										</div>
									</div>
									<div class="col-lg-12" style="padding:0px; ">
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											Marital <span style="word-spacing:0.2cm;">Status: </span><span style="font-weight:600"><?php echo $queryArray["maritalStatus"];?></span>
										</div>
										<div style="padding:0px; border-bottom:1px solid #EFEFEF; margin-top:40px; margin-bottom:10px"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-12 col-xs-12" style="margin-top:20px; padding-left:20px; padding-right:20px;">
						<div class="col-lg-12" style="padding:0px">
							<div class="col-lg-1 col-xs-1" id="iconPadding">
								<div style="height:30px; width:30px; border-radius:50%; background-color:#5b5ea6; padding-top:8px; padding-left:5px; 
															text-align:center; margin-left:-8px">
									<i class='fas fa-users' style=" margin-right:5px; color:#FFFFFF; font-size:14px"></i>
								</div>
							</div>
							<div class="col-lg-11 col-xs-10" id="iconPaddingRight">
											<span style="color:#5b5ea6">Family Values</span>
								<div class="col-lg-12" style="padding:0px;  font-weight:normal; font-size:13px; margin-top:5px">
									<div class="col-lg-12" style="padding:0px; margin-top:-4px;">
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											Father's <span style="word-spacing:0.2cm;">Status: </span><span style="font-weight:600"><?php echo $queryArray["fatherStatus"];?></span>
										</div>
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											Mother's <span style="word-spacing:0.2cm;">Status: </span><span style="font-weight:600"><?php echo $queryArray["motherStatus"];?></span>
										</div>
									</div>
									<div class="col-lg-12" style="padding:0px; ">
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											No of <span style="word-spacing:0.2cm;">Brothers: </span><span style="font-weight:600"><?php echo $queryArray["noOfBrothers"];?></span>
										</div>
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											No of <span style="word-spacing:0.2cm;">Sisters: </span><span style="font-weight:600"><?php echo $queryArray["noOfSisters"];?></span>
										</div>
									</div>
									<div class="col-lg-12" style="padding:0px; ">
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											Family <span style="word-spacing:0.2cm;">Type: </span><span style="font-weight:600"><?php echo $queryArray["familyType"];?></span>
										</div>
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											Family <span style="word-spacing:0.2cm;">Values: </span><span style="font-weight:600"><?php echo $queryArray["familyValues"];?></span>
										</div>
									</div>
									<div class="col-lg-12" style="padding:0px; ">
										<div class="col-lg-6" style="padding:0px; margin-top:8px; ">
											Family <span style="word-spacing:0.2cm;">Affluences: </span><span style="font-weight:600">
													<?php echo $queryArray["familyAffluence"];?>
													</span>
										</div>
										<div style="padding:0px; border-bottom:1px solid #EFEFEF; margin-top:40px"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
					
					
					<div class="col-lg-12 col-xs-12" style="padding:0px; margin-top:50px; margin-bottom:10px; padding-left:20px; padding-right:20px">
									<div class="col-lg-12 col-xs-12" style="font-family:'Segoe UI'; padding:0px; border-radius:2px; margin-bottom:10px">
										<div class="col-lg-12" id="parterPreferences">
											<i class='fas fa-user-friends' style=" margin-right:10px; color:#5fad38; font-size:19px"></i>
											<span style="color:#5fad38"><?php echo $queryArray["firstName"]."'s "; ?>Partner Preferences</span>
										</div>
										<div class="col-lg-12" style="padding:0px; padding:10px; font-size:13px; line-height:25px; color:#666666; margin-top:10px; 
										margin-bottom:5px; font-family:'Trebuchet MS'; ">
											<div class="col-lg-12" style="padding:0px; margin-top:-10px">
												<div class="col-lg-6" style="padding:0px">
													 <span style="word-spacing:0.2cm;">Height: </span><?php echo $queryArray["pHeight"];?>
												</div>
												<div class="col-lg-6" style="padding:0px; ">
													<span style="word-spacing:0.2cm;">Age: </span><?php echo $queryArray["pAge"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;">
												<div class="col-lg-6" style="padding:0px; ">
													<span style="word-spacing:0.2cm;">Religion: </span><?php echo $queryArray["pReligion"];?>
												</div>
												<div class="col-lg-6" style="padding:0px; ">
													Marital <span style="word-spacing:0.2cm;">Status: </span><?php echo $queryArray["pMaritalStatus"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;  padding-bottom:0px;">
												<div class="col-lg-6" style="padding:0px">
													<span style="word-spacing:0.2cm;">Education: </span><?php echo $queryArray["pEducation"];?>
												</div>
												<div class="col-lg-6" style="padding:0px; word-wrap:break-word">
													<span style="word-spacing:0.2cm;">Location: </span><?php echo $queryArray["pLocation"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;  padding-bottom:0px;">
												<div class="col-lg-6" style="padding:0px">
													<span style="word-spacing:0.2cm;">Language: </span><?php echo $queryArray["pLanguage"];?>
												</div>
												<div class="col-lg-6" style="padding:0px; ">
													Skin <span style="word-spacing:0.2cm;">Tone: </span><?php echo $queryArray["pComplexion"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;  padding-bottom:0px;">
												<div class="col-lg-6" style="padding:0px">
													<span style="word-spacing:0.2cm;">Clan: </span><?php echo $queryArray["pClan"];?>
												</div>
												<div class="col-lg-6" style="padding:0px; ">
													Family <span style="word-spacing:0.2cm;">Affluence: </span><?php echo $queryArray["pFamilyAffluence"];?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;  padding-bottom:0px; margin-top:5px; ">
												<div class="col-lg-12" style="padding:0px; word-wrap:break-word;">
													About <span style="word-spacing:0.2cm;">Partner: </span><?php echo $queryArray["pAbout"];?>
												</div>
											</div>
										</div>
									</div>	
								</div>	
								
					
					<div class="col-lg-12" style="padding-left:20px; padding-right:20px; margin-bottom:20px">
						<div class="col-lg-12 col-xs-12" id="startConversation">
							<div class="col-lg-12 col-xs-12" style="padding-left:10px; padding-top:2px;  font-family:'Segoe UI'; padding-right:0px;">
								<div class="col-lg-12" style="padding:0px;" >
									<p id="connectWith">
										<i class="far fa-comments" style=" margin-right:15px; margin-left:-20px; font-size:24px"></i>Connect with 
										<?php echo $queryArray["firstName"]." ".$queryArray["lastName"];?>
									</p>
									<button class="btn btn-success" style="margin-top:15px; border-radius:2px;  color:#FFFFFF; font-weight:600; 
									padding:10px; padding-left:40px; padding-right:40px" data-toggle="modal" data-target="#sendMessageModal" 
									 onclick="Focus()">
										Send Message
									</button>
									<script type="text/javascript">
										function Focus()
										{
											document.getElementById("shortMessage").focus();
										}
									</script>
								</div>
							</div>	
						</div>
					</div>
					<div class="modal fade" id="sendMessageModal" role="dialog" >
					<div class="modal-dialog" id="modalMarginTop">
					  <div class="modal-content" id="modalMargin">
					  	<div class="modal-header" style="padding-bottom:0px; border:none; margin-bottom:0px">
							<div class="row">
								
							<div class="col-lg-11 col-xs-11" style="padding:0px">
								<div class="col-lg-6 col-xs-6" id="smallImageMargin">
									<?php
									$result=mysqli_query($conn, "select * from signup where id=$viewProfileId AND makeMeHide='show' limit 1");
									while($imageArray=mysqli_fetch_array($result))
									{
										if($imageArray["publicProfile"]!="Private")
										{
											echo '<img src="data:image;base64,'.base64_encode($imageArray['uploadProfilePicture']).'"  
											style="border-radius:2px; height:100%; width:100%; border-radius:50%;" alt="View User Image">';
										}
										else if($imageArray["gender"]=="male")
										{
											?><img src="allpics/male4.png" style="height:100%; width:100%; border-radius:50%;" alt="User Image"/><?php 
										}
										else
										{
											?><img src="allpics/female4.png" style="height:100%; width:100%; border-radius:50%;" alt="User's Profile Picture"/><?php 
										}
									}			
									?>
								</div>	
								<div class="col-lg-6 col-xs-6" style="margin-top:30px">
									<div id="imageName">
										<?php echo $queryArray["firstName"]." ".$queryArray["lastName"];?>
									</div>
								</div>
								
						</div>
						<div class="col-lg-1 col-xs-1" style="padding:0px">
							<button type="button" class="close" data-dismiss="modal" style="float:right; margin-right:15px; opacity:0.9; font-size:36px">
								&times;
							</button>
						</div>
								
							</div>
						</div>
						
						
					
					
						
						 
						 <div id="modalPaddingInner">
							<div class="modal-body" style="padding:0px; margin-top:-30px;">
							
							
							  <form>
								<textarea name="shortMessage" id="shortMessage" style="resize:none; border-radius:4px; margin-top:10px; color:#999999" class="form-control" 
											placeholder="type your message" rows="3" onClick="ShortMessage()" autofocus></textarea>
								<input type="button" class="btn btn-success btn-default" value="Send Message" style=" border-radius:3px; padding:8px; padding-left:40px; 
										padding-right:40px; margin-top:7px; color:#FFFFFF;" 
										onclick="SendMessage()" id="sendMessage"/>
							  </form>
							  
								  <script type="text/javascript">
								  	function myTrim(x) {
									  return x.replace(/^\s+|\s+$/gm,'');
									}
									function SendMessage()
									{
								
										var fromId="<?php echo $_SESSION["firstPersonId"]; ?>";
										var toId="<?php echo $viewProfileId; ?>";
										
										var shortMessage=myTrim(document.getElementById("shortMessage").value);
										var shortMessageLen=shortMessage.length;
										if(shortMessage=="")												
										{
											document.getElementById("errorShortMessage").style.display="block";
											document.getElementById("errorShortMessage").innerHTML="Please enter some message";
											document.getElementById("successMessage").style.display="none";
										}
										else if(shortMessageLen>1000){document.getElementById("errorShortMessage").style.display="block";
																	  document.getElementById("errorShortMessage").innerHTML="Your Message is too much long.";
																	  document.getElementById("successMessage").style.display="none";}
										else if(!/^[a-zA-Z0-9 ]*$/g.test(shortMessage))
										{
											 document.getElementById("errorShortMessage").style.display="block";
											 document.getElementById("errorShortMessage").innerHTML="Invalid Message format (only A-Z allowed). Space is not Allowed";
											 document.getElementById("successMessage").style.display="none";}						   
										else 
										{
											
											var xmlhttp = new XMLHttpRequest();
											xmlhttp.open('GET','inc/routes/viewprofilePHP.php?fromId='+fromId+'&shortMessage='+shortMessage+'&toId='+toId, true);
											xmlhttp.send();
											
											document.getElementById("shortMessage").innerHTML="";
											document.getElementById("successMessage").style.display="block";
											document.getElementById("successMessage").innerHTML="Your Message has been Sent Successfully! To view Chat, visit Message page.";
											document.getElementById("errorShortMessage").style.display="none";
										}
									}
							 	 </script>
							
							  
							  <p id="errorMessage" style="background-color:#F5F5F5; color:#666666; text-align:center; padding:10px; margin-top:5px; border-radius:4px; 
									color:#dd4132; font-family:'Segoe UI'; display:none">Error: only charcters and numbers are allwoed!</p>
							  <p id="successMessage" style="background-color:#F5F5F5; margin-top:5px; border-radius:4px; 
									color:#7da046; font-family:'Segoe UI'; padding:10px; display:none"></p>	
							  <p id="errorShortMessage" style="background-color:#F8F8F8; margin-top:5px; border-radius:4px; 
									color:#FF0000; font-family:'Segoe UI'; padding:10px; display:none"></p>	
							</div>
						 </div>
					  </div>
					</div>
				  </div>

			</div>
		</div>
	</div>
</div>
			
			<div class="col-lg-3" ></div>
		</div>
	</div>
</div>
<!---EndedCenter--->
<?php }?>
<?php 
}
else
{?>
	<div class="container-fluid" style="background-color:#CCCCCC;  font-family:'Segoe UI'; border-radius:3px; border:1px solid #B4B4B4; text-align:center;
		font-size:20px; margin-top:30px; padding:100px; height:auto;  margin-bottom:30px;">This User does not exists on RishtaWeb.com! 
		<p style=" font-size:14px;">search again with valid user id.</p>
	</div>
<?php }
?>
<br /><br />


<?php include('inc/pages/footer.php');?>

</body>
</html>


