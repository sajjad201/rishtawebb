<?php
session_start();
require 'inc/connection/connect.php';

if(isset($_SESSION["firstPersonId"])) {
	$firstPerson=$_SESSION["firstPersonId"];
}
if(isset($_GET["viewProfileId"])){
	$_SESSION["viewProfileId"]=$_GET["viewProfileId"];
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


?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		<?php
			$city = $caste = $familyaffluence ="";
			$country ="";
			$result=mysqli_query($conn, "select * from signup where id=$viewProfileId AND makeMeHide='show' limit 1");
			if(@mysqli_num_rows( $result) > 0 ){
				while($r=mysqli_fetch_array($result)){
					$title=$r['gender'].", ".$r['caste'].", ".$r['city'].", ".$r['familyAffluence']." rishta profile - ".$r['id'];
					echo ucwords($title);
				}
			}
		?>
	</title>
	<meta name="description" content="<?php
			$city = $caste = $familyaffluence ="";
			$country ="";
			$result=mysqli_query($conn, "select * from signup where id=$viewProfileId AND makeMeHide='show' limit 1");
			if(@mysqli_num_rows( $result) > 0 ){
				while($r=mysqli_fetch_array($result)){
					$description="Find ".$r['gender']." ".$r['caste']." rishta in ".$r['city'].", ".$r['country'].". ".$r['firstName']. " is ".$r['caste']." professionally ".$r['profession']." having education ".$r['education']." looking for rishta in ".$r['city'].", ".$r['country'];
					echo $description;
				}
			}
		?>">
	
	<meta name="keywords" content="online female rishta in pakistan, online male rishta in pakista, matrimonial website in pakista, free matrimonial webstie">
	<?php include('inc/pages/links-one.php');?>
<style>
#modalPaddingInner {
margin: 0px 15px;
border-radius: 5px;
padding: 10px;
}
.vp-modal-flex{
    display: flex;
    justify-content: center;
}
.vp-modal-flex > div{
    padding: 5px;
    margin: 0px 5px;
}
.vp-login-btn{
    padding: 12px 40px;
    font-size: 14px;
}
.vp-modal-flex{
    font-size: 30px;
    color: #4c8bf5;
}
.modal-body {
    position: relative;
    padding: 15px;
    height: 145px;
    top: 0px;
	bottom: 0px;
	margin-top: -18px;
}
#modalPaddingInner{
	padding: 10px 0px;
}

.modal-content {
    min-height: auto;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
}
.form-control:focus{
	box-shadow: 0px 0px 0px !important;
}
#modalMargin{
	padding-bottom:0px;
}

.md-msg-sent-p{
	font-size: 20px;
    padding: 20px 0px;
    color: #88B04B;
}
.md-msg-sent-title{
	font-size: 28px;
    color: #6e8f3d;
}

</style>

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
<!---center--->
<?php

$city = $caste = $familyaffluence ="";
$country ="";
$result=mysqli_query($conn, "select * from signup where id=$viewProfileId AND makeMeHide='show' limit 1");
if(@mysqli_num_rows( $result) > 0 ){
while($queryArray=mysqli_fetch_array($result)){
	$city = $queryArray["city"];
	$caste =$queryArray["caste"];
	$familyAffluence =$queryArray["familyAffluence"];
	$country=$queryArray["country"];
?>
<div class="container-fluid" id="whitePageMargin">
	<div class="row">
		<div class="col-lg-12" style="padding:0px; margin-top:100px;">
			<div class="col-lg-1"></div>
			<div class="col-lg-8 col-xs-12" style="padding:0px; border-radius:15px;">
				<div class="col-lg-12 col-xs-12" id="whitePage">
					<div class="row">
						<h1 class="vp-white-head">
							<?php echo $queryArray["caste"]." ".$queryArray['gender'];?> 
							<?php $row11 = array('dob'=>$queryArray['dob']);	echo ageCalculator($row11['dob']);	?> old
							<?php echo ", professionally ".$queryArray['profession']." rishta in ".$queryArray["city"].", ".$queryArray['country']." - ID:".$queryArray['id'];?> 
						</h1>
					</div>
			
					<div class="col-lg-3" id="imagePaddingBottom">
						<div id="imageDimensions">
						<a rel="nofollow" href="#">
						
							<?php
							if (!isset($_SESSION["firstPersonId"])){?>
								<?php if($queryArray["gender"]=="male"){?><img data-toggle="modal" data-target="#loginmodel" src="<?php echo $base_url?>assets/allpics/mlogin.png" height="100%" width="100%" alt="User Image"/><?php }
								else{?><img data-toggle="modal" data-target="#loginmodel" src="<?php echo $base_url?>assets/allpics/flogin.png" height="100%" width="100%" alt="User Image"/><?php } ?>
							<?php }
							else{?>
							<?php if($queryArray["publicProfile"]!="Private"){?>
							<img data-toggle="modal" data-target="#showImage" src="<?php echo $base_url?><?php echo $queryArray['uploadProfilePicture']; ?>" height="100%" width="100%" style="border-radius:2px;" alt="View User Image">
							<?php }
							else if($queryArray["gender"]=="male"){?><img src="<?php echo $base_url?>allpics/male4.png" height="100%" width="100%" alt="User Image"/><?php }
							else{?><img data-toggle="modal" data-target="#showImage" src="<?php echo $base_url?>allpics/female4.png" height="100%" width="100%" alt="User's Profile Picture"/><?php } }?>
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
								<?php
								if (!isset($_SESSION["firstPersonId"])){?>
									<?php if($queryArray["gender"]=="male"){?><img src="<?php echo $base_url?>assets/allpics/mlogin.png" height="40%" width="30%" alt="User Image"/><?php }
									else{?><img src="<?php echo $base_url?>assets/allpics/flogin.png" height="40%" width="30%" alt="User Image"/><?php } ?>
								<?php }
								else{?>
									<?php if($queryArray["publicProfile"]!="Private"){?> 
									<img src="<?php echo $base_url?><?php echo $queryArray['uploadProfilePicture']; ?>" style="border-radius:2px; max-height:100%; max-width:100%" alt="View Full Size">
									<?php }
									else if($queryArray["gender"]=="male"){?><img src="<?php echo $base_url?>allpics/male4.png" height="300px" width="300px" alt="Image in Full Size"/><?php } 
									else{?><img src="<?php echo $base_url?>allpics/female4.png" height="300px" width="300px" alt="Show Image"/><?php } 
								}?>
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
													Status: <?php echo $queryArray["profession"];?>
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
									</div>
									<div class="col-lg-12" style="padding:0px;">
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											Father's<span style="word-spacing:0.2cm;">Status: </span><span style="font-weight:600">
														<?php if($queryArray["fatherStatus"] != '0'){echo $queryArray["fatherStatus"];} else{ echo 'not avaialbe'; } ?>
													</span>
										</div>
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											Mother's<span style="word-spacing:0.2cm;">Status: </span><span style="font-weight:600">
														<?php if($queryArray["motherStatus"] != '0'){echo $queryArray["motherStatus"];} else{ echo 'not avaialbe'; } ?>
													</span>
										</div>
									</div>
									<div class="col-lg-12" style="padding:0px; ">
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											No of<span style="word-spacing:0.2cm;">Brothers: </span><span style="font-weight:600">
													<?php if($queryArray["noOfBrothers"] != '0'){echo $queryArray["noOfBrothers"];} else{ echo 'not avaialbe'; } ?>
												</span>
										</div>
										<div class="col-lg-6" style="padding:0px; margin-top:8px;">
											No of<span style="word-spacing:0.2cm;">Sisters: </span><span style="font-weight:600">
													<?php if($queryArray["noOfSisters"] != '0'){echo $queryArray["noOfSisters"];} else{ echo 'not avaialbe'; } ?>
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
													 <span style="word-spacing:0.2cm;">Height: </span>
													 <?php if($queryArray["pHeight"] != '0'){echo $queryArray["pHeight"];} else{ echo 'not avaialbe'; } ?>
												</div>
												<div class="col-lg-6" style="padding:0px; ">
													<span style="word-spacing:0.2cm;">Age: </span>
													<?php if($queryArray["pAge"] != '0'){echo $queryArray["pAge"];} else{ echo 'not avaialbe'; } ?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;">
												<div class="col-lg-6" style="padding:0px; ">
													<span style="word-spacing:0.2cm;">Religion: </span>
													<?php if($queryArray["pReligion"] != '0'){echo $queryArray["pReligion"];} else{ echo 'not avaialbe'; } ?>
												</div>
												<div class="col-lg-6" style="padding:0px; ">
													Marital <span style="word-spacing:0.2cm;">Status: </span>
													<?php if($queryArray["pMaritalStatus"] != '0'){echo $queryArray["pMaritalStatus"];} else{ echo 'not avaialbe'; } ?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;  padding-bottom:0px;">
												<div class="col-lg-6" style="padding:0px">
													<span style="word-spacing:0.2cm;">Education: </span>
													<?php if($queryArray["pEducation"] != '0'){echo $queryArray["pEducation"];} else{ echo 'not avaialbe'; } ?>
												</div>
												<div class="col-lg-6" style="padding:0px; word-wrap:break-word">
													<span style="word-spacing:0.2cm;">Location: </span>
													<?php if($queryArray["pLocation"] != '0'){echo $queryArray["pLocation"];} else{ echo 'not avaialbe'; } ?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;  padding-bottom:0px;">
												<div class="col-lg-6" style="padding:0px">
													<span style="word-spacing:0.2cm;">Language: </span>
													<?php if($queryArray["pLanguage"] != '0'){echo $queryArray["pLanguage"];} else{ echo 'not avaialbe'; } ?>
												</div>
												<div class="col-lg-6" style="padding:0px; ">
													Skin <span style="word-spacing:0.2cm;">Tone: </span>
													<?php if($queryArray["pComplexion"] != '0'){echo $queryArray["pComplexion"];} else{ echo 'not avaialbe'; } ?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;  padding-bottom:0px;">
												<div class="col-lg-6" style="padding:0px">
													<span style="word-spacing:0.2cm;">Clan: </span>
													<?php if($queryArray["pClan"] != '0'){echo $queryArray["pClan"];} else{ echo 'not avaialbe'; } ?>
												</div>
												<div class="col-lg-6" style="padding:0px; ">
													Family <span style="word-spacing:0.2cm;">Affluence: </span>
													<?php if($queryArray["pFamilyAffluence"] != '0'){echo $queryArray["pFamilyAffluence"];} else{ echo 'not avaialbe'; } ?>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px;  padding-bottom:0px; margin-top:5px; ">
												<div class="col-lg-12" style="padding:0px; word-wrap:break-word;">
													About <span style="word-spacing:0.2cm;">Partner: </span>
													<?php if($queryArray["pAbout"] != '0'){echo $queryArray["pAbout"];} else{ echo 'not avaialbe'; } ?>
												</div>
											</div>
										</div>
									</div>	
								</div>	
								
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
					<div class="col-lg-12" style="padding-left:20px; padding-right:20px; margin-bottom:20px">
						<div class="col-lg-12 col-xs-12" id="startConversation">
							<div class="col-lg-12 col-xs-12" style="padding-left:10px; padding-top:2px;  font-family:'Segoe UI'; padding-right:0px;">
								<div class="col-lg-12" style="padding:0px;" >
									<p id="connectWith">
										<i class="far fa-comments" style=" margin-right:15px; margin-left:-20px; font-size:24px"></i>Connect with 
										<?php echo $queryArray["firstName"]." ".$queryArray["lastName"];?>
									</p>
									<?php
										if(isset($_SESSION["firstPersonId"])) {?>
											<button class="btn btn-success" style="margin-top:15px; border-radius:2px;  color:#FFFFFF; font-weight:600; 
											padding:10px; padding-left:40px; padding-right:40px" data-toggle="modal" data-target="#sendMessageModal" 
											onclick="Focus()">
												Send Message
											</button>
										<?php } else{?>
											<button class="btn btn-success" style="margin-top:15px; border-radius:2px;  color:#FFFFFF; font-weight:600; 
												padding:10px; padding-left:40px; padding-right:40px" data-toggle="modal" data-target="#loginmodel">
											Send Message
										</button>
										<?php }
									?>
									<script>function Focus(){document.getElementById("shortMessage").focus();}</script>
								</div>
							</div>	
						</div>
					</div>
					
					<!-- message modal -->
					<div class="modal fade" id="sendMessageModal" role="dialog" style="padding-right:0px !important">
					<div class="modal-dialog" id="modalMarginTop">
					  <div class="modal-content" id="modalMargin">
					  	<div class="modal-header" style="padding-bottom:0px; border:none; margin-bottom:0px">
							<div class="row">
								
							<div class="col-lg-11 col-xs-11" style="padding:0px">
								
								<div class="col-lg-6 col-xs-6">
									<div id="imageName" style="text-align: initial;">
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
							<div class="modal-body" style="padding:0px; margin-top:0px; height:160px">
							
							
							  <form>
								<textarea name="shortMessage" id="shortMessage" style="resize:none; border-radius:4px; margin-top:23px; color:#999999" class="form-control" 
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
											xmlhttp.open('GET','<?php echo $base_url;?>inc/routes/viewprofilePHP.php?fromId='+fromId+'&shortMessage='+shortMessage+'&toId='+toId, true);
											xmlhttp.send();
											
											document.getElementById("shortMessage").innerHTML="";
											document.getElementById("errorShortMessage").style.display="none";
											$('#sendMessageModal').modal('toggle');
											$('#messagesent').modal('toggle');
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
		<!-- message sent modal -->
		<div class="modal fade" id="messagesent" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title md-msg-sent-title">Message Sent</h4>
					</div>
					<div class="modal-body" style="height:158px">
						<p class="md-msg-sent-p">Your Message has been sent successfully!</p>
						<span><a href="<?php echo $base_url;?>allConversation.php">click here</a> to view all messages.</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-xs-12 pr-col3-right" >
			<div class="pr-col3-right-in">						
									<!-- city -->
				<?php 
				$result=mysqli_query($conn, "select * from signup where city='$city'  limit 7");
				if(@mysqli_num_rows( $result) > 0 ){?>
					<div class="vp-div3">
						<div class="vp-div3-head">Other Rishty from <?php echo $city; ?></div>
						<div class="vp-div3-body">
							<?php
							while($queryArray=mysqli_fetch_array($result)){?>
								<a href="../profile/<?php echo $queryArray['id']?>" class="vp-div3-body-row-link">
									<div class="vp-div3-body-row">
										<div class="vp-div3-body-row-title"><?php echo $queryArray['caste']." ".$queryArray['gender']." rishta in ".$queryArray['city'];?></div>
										<div class="vp-div3-body-row-des">
											<?php echo $queryArray['firstName']." ".$queryArray['lastName'];?> 
											<?php $row11 = array('dob'=>$queryArray['dob']);	echo ageCalculator($row11['dob']);	?> old - 
											<?php echo $queryArray['profession'];?>
										</div>
									</div>
								</a>
							<?php }?>
						</div>
					</div>
				<?php }?>
				
				<!-- caste -->
				<?php 
				$result=mysqli_query($conn, "select * from signup where caste='$caste'  limit 7");
				if(@mysqli_num_rows( $result) > 0 ){?>
					<div class="vp-div3">
						<div class="vp-div3-head">Other Rishty from <?php echo $caste; ?></div>
						<div class="vp-div3-body">
							<?php
							while($queryArray=mysqli_fetch_array($result)){?>
								<a href="../profile/<?php echo $queryArray['id']?>" class="vp-div3-body-row-link">
									<div class="vp-div3-body-row">
										<div class="vp-div3-body-row-title"><?php echo $queryArray['caste']." ".$queryArray['gender']." rishta in ".$queryArray['city'];?></div>
										<div class="vp-div3-body-row-des">
											<?php echo $queryArray['firstName']." ".$queryArray['lastName'];?> 
											<?php $row11 = array('dob'=>$queryArray['dob']);	echo ageCalculator($row11['dob']);	?> old - 
											<?php echo $queryArray['profession'];?>
										</div>
									</div>
								</a>
							<?php }?>
						</div>
					</div>
				<?php }?>

				<!-- famyaffluence -->
				<?php 
				$result=mysqli_query($conn, "select * from signup where familyAffluence='$familyAffluence'  limit 7");
				if(@mysqli_num_rows( $result) > 0 ){?>
					<div class="vp-div3">
						<div class="vp-div3-head">Other Rishty from <?php echo $familyaffluence; ?></div>
						<div class="vp-div3-body">
							<?php
							while($queryArray=mysqli_fetch_array($result)){?>
								<a href="../profile/<?php echo $queryArray['id']?>" class="vp-div3-body-row-link">
									<div class="vp-div3-body-row">
										<div class="vp-div3-body-row-title"><?php echo $queryArray['caste']." ".$queryArray['gender']." rishta in ".$queryArray['city'];?></div>
										<div class="vp-div3-body-row-des">
											<?php echo $queryArray['firstName']." ".$queryArray['lastName'];?> 
											<?php $row11 = array('dob'=>$queryArray['dob']);	echo ageCalculator($row11['dob']);	?> old - 
											<?php echo $queryArray['profession'];?>
										</div>
									</div>
								</a>
							<?php }?>
						</div>
					</div>
				<?php } else{echo 'no family';}?>	

				<!-- country -->
				<?php
				if($country != 'pakistan'){
					$result=mysqli_query($conn, "select * from signup where country='$country'  limit 7");
					if(@mysqli_num_rows( $result) > 0 ){?>
						<div class="vp-div3">
							<div class="vp-div3-head">Other Rishty from <?php echo $country; ?></div>
							<div class="vp-div3-body">
								<?php
								while($queryArray=mysqli_fetch_array($result)){?>
									<a href="../profile/<?php echo $queryArray['id']?>" class="vp-div3-body-row-link">
										<div class="vp-div3-body-row">
											<div class="vp-div3-body-row-title"><?php echo $queryArray['caste']." ".$queryArray['gender']." rishta in ".$queryArray['city'];?></div>
											<div class="vp-div3-body-row-des">
												<?php echo $queryArray['firstName']." ".$queryArray['lastName'];?> 
												<?php $row11 = array('dob'=>$queryArray['dob']);	echo ageCalculator($row11['dob']);	?> old - 
												<?php echo $queryArray['profession'];?>
											</div>
										</div>
									</a>
								<?php }?>
							</div>
						</div>
					<?php }else{echo 'no country';}
					}
				?>	

			
			</div>
		</div>
</div>
			
			
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



