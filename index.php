<?php
session_start();
require 'inc/connection/connect.php';


if(isset($_SESSION["firstPersonId"])){
  header("Location: searchProfiles.php");
}



$varify="false";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$enterUsername=$_POST['username'];
	$enterpassword=$_POST['password'];
	
	$qry="select * from tbl_name";
	$res=mysqli_query($conn, $qry) or die("cannot make connection".mysqli_error());
	
	while($r=mysqli_fetch_array($res))
	{
		$name=$r['userName'];
		$password=$r['password'];
		
		
			
		if( $name == $enterUsername && $enterpassword == $password)
		{
			$_SESSION["firstPersonUserName"]=$name;
			$_SESSION["firstPersonId"]=$r['id'];
			
			echo "you are logged in successfully <br>";
			header("location: myprofile.php");
			
			$varify="true";
			
		}
		

	}
	if($varify != "true")
	{
		echo "invalid username or password";	
	}
	
	
	
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
	
</head>

<body>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
function OpenMessenger(){
	  window.fbAsyncInit = function() {
		FB.init({
		  xfbml            : true,
		  version          : 'v3.2'
		});
	  };
	
	  (function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
}	
</script>

<!-- Your customer chat code -->
<div class="fb-customerchat" attribution=setup_tool page_id="415465259225045" theme_color="#20cef5" logged_in_greeting="​​کسی بھی قسم کی رہنمائی کے لیے ابھی رابطہ کریں۔"
  logged_out_greeting="​​کسی بھی قسم کی رہنمائی کے لیے ابھی رابطہ کریں۔">
</div>



<div class="modal fade" id="updateModal" role="dialog"  >
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius:3px;">
			<div class="modal-header" id="modalHeaderPadding" style="border-bottom:2px solid #1a2e4c">
				<h3 class="modal-title modal-title-text">
					<i class="fas fa-bolt" style="margin-right:15px; color:#FFFFFF"></i><span style="color:#FFFFFF">INSTANT RISHTA</span>
					<button type="button" class="close" data-dismiss="modal" style="color:#000000; font-weight:bolder; font-size:36px;  ">&times;</button>
				</h3>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
				
				
					<div class="modal fade" id="updateModal2" role="dialog" style="padding:30xp; margin-top:-30px;">
						<div class="modal-dialog" style="border-radius:0px; box-shadow:0px 0px 0px; border-bottom:0px">
							<div class="modal-content" style="border-radius:0px; box-shadow:0px 0px 0px; border-bottom:0px">
								<div class="modal-body">
									<div class="container-fluid">
										<h1 style="font-family:'Segoe UI'; color:#92B558">Thanks for Connecting us!</h1>
										<p style="font-size:20px; font-family:'Segoe UI'; color:#92B558">
											Request submitted successfully. Our team will connect you shortly.
										</p><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
										<button class="btn btn-success btn-block btn-lg" style="border-radius:0px" data-dismiss="modal">DONE</button>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				
					

					<div class="row" id="modalFontSize">
					<span id="hidebutton">
						<div id="urduLineHeight" style="font-family:'Noto Nastaliq Urdu Draft', serif; text-align:right; 
						background: linear-gradient(to bottom, #f96714 0%, #fcaf83 100%); 
							 padding:20px; padding-top:30px; padding-bottom:50px">
							 <span style="color:#FFFFFF">
							​فوری رشتے کیلئے ابھی رابطہ کریں۔
							</span>
							<div style="text-align:center; margin-top:25px">
								<span style="font-size:24px; color:#F1EA7F; font-weight:700; font-family:'Segoe UI'">
									<div><i class="fas fa-phone" style="margin-right:15px"></i>051-4107478<br /></div>
									<div style="margin-top:8px"><i class="fas fa-mobile-alt" style=" margin-right:15px"></i>+92-347-6538679</div>
									<div style="margin-top:8px; font-family:'Segoe UI'; ">
										<i class="far fa-envelope-open" style=" margin-right:15px;"></i>Info@rishtaweb.com
									</div>
								</span>
								
							</div>
						</div><br>
						<div class="col-lg-12" style="text-align:center; margin-bottom:20px">
							<span id="hide_or" style="font-weight:600; color:#CCCCCC; font-size:16px; font-family:'Segoe UI'">OR</span>
						</div>
						
						<div class="col-lg-12" id="hidebutton">
							<div class="col-lg-2 col-md-1"></div>
							<div class="col-lg-8 col-md-10" style="text-align:center">
								<button type="button" class="btn btn-primary btn-lg" onclick="HideButton()" style="font-weight:500; border-radius:3px">
									<i class="fas fa-phone-square" style="margin-right:15px"></i>REQUEST CALLBACK
								</button>
							</div>
						</div>
					</span>
						<script>
							function HideButton(){
								document.getElementById("hidebutton").style.display="none";
								document.getElementById("show_form").style.display="block";
							}
							function ShowButton(){
								document.getElementById("hidebutton").style.display="block";
								document.getElementById("show_form").style.display="none";
							}
						</script>
						
						<div class="col-lg-2 col-md-1"></div>
						<div class="col-lg-8 col-md-10" id="show_form" style="display:none">
						<a href="#" style="text-decoration:none; font-family:'Segoe UI';" onclick="ShowButton()">
							<i class="fas fa-arrow-left" style="margin-right:10px"></i>back
						</a>
							<form class="form-horizontal" action="" method="post" name="customer_contact_form">
								<div class="form-group">
									<div class="col-sm-12" style="margin-top:25px; font-size:16px; font-weight:700">
										 Submit request, We will connect you shortly.
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12" style="margin-top:0px">
										<input type="text" class="form-control" name="name" id="name" placeholder="Full Name" onBlur="Name()" autofocus>
										<div id="nameError" style="font-size:12px; color:#BF0000;"></div>
									</div>
								</div>
								<div class="form-group">
										<div class="col-sm-6 col-xs-6">
											<input type="radio" name="gender" id="male" onBlur="Gender()" value="male">
											<label for="male">Male</label>
										</div>
										<div class="col-sm-6 col-xs-6">
											<input type="radio" name="gender" id="female" onBlur="Gender()" value="female">
											<label for="female">Female</label>
										</div>
										<div class="col-lg-12 col-xs-12" id="genderError" style="font-size:12px; color:#BF0000;"></div>
									</div>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="email" class="form-control" name="email" id="email" placeholder="Email" onBlur="Email()">
										<div id="emailError" style="font-size:12px; color:#BF0000;"></div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="password" class="form-control" name="mobile" id="mobile" placeholder="Mobile" onBlur="Mobile()">
										<div id="mobileError" style="font-size:12px; color:#BF0000;"></div>
										<p id="allPhpErrors" style="color:#BF0000; text-align:center; font-family:Verdana"></p>
									</div>
								</div>
								
<script type="text/javascript">	
		  	
var input = document.getElementById("password");
input.addEventListener("keyup", function(event) {
	event.preventDefault();
	if (event.keyCode === 13) {
		document.getElementById("loginClick").click();
	}
});
									
function Name(){	
	var nameVar=document.customer_contact_form.name.value;
	var nameLengthVar=nameVar.length;
	
	if(nameVar==""){
		document.getElementById("name").style.borderColor="red";
		document.getElementById("nameError").innerHTML="please enter first name";
	}
	else if(!/^[a-zA-Z ]*$/g.test(nameVar))						{document.getElementById("nameError").innerHTML="Invalid name.";
																document.getElementById("name").focus();}
	else if(nameLengthVar>15)									{document.getElementById("nameError").innerHTML="Name is too much long";
																 document.getElementById("name").focus();}
	else if(nameLengthVar<2)									{document.getElementById("nameError").innerHTML="Name is too much short";}
	else														{document.getElementById("name").style.borderColor="#E5E5E5";
																 document.getElementById("nameError").innerHTML=""; return true;}
}
function Gender(){
	if(document.customer_contact_form.gender.value==0){
		document.getElementById("genderError").innerHTML="Please select gender";
		document.getElementById("genderError").innerHTML="Please select gender";
	}	
	else {
		document.getElementById("genderError").innerHTML=""; return true;
	}
}

var emailVarify="ok";
function Email(){
	var email=document.customer_contact_form.email.value;
	var emailVar=document.customer_contact_form.email.value;
	var emailLengthVar=emailVar.length;
	var varifyEmail = /^(([^<>()[\]\\.,;:\s@\']+(\.[^<>()[\]\\.,;:\s@\']+)*)|(\'.+\ '))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
	if(email==""){
		document.getElementById("email").style.borderColor="red";
		document.getElementById("emailError").innerHTML="Please enter email address";
	}
	else if(emailLengthVar>40)									{document.getElementById("emailError").innerHTML="email address is too lengthy!";
																 document.getElementById("email").focus();}
	else if(emailLengthVar<2)									{document.getElementById("emailError").innerHTML="email adressis too much short";}
	else if(varifyEmail.test(email) == false) 					{document.getElementById("emailError").innerHTML="Please enter correct email";
																document.getElementById("email").focus(); return false;}
	else if( email != "" )
	{
		document.getElementById("emailError").innerHTML="";
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() 
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				if( xmlhttp.responseText == 1){
					document.getElementById("emailError").innerHTML="You already sent a request!";
					document.getElementById("email").style.borderColor="red";
					emailVarify="notoky";
					return false;
				}
				else{
					document.getElementById("emailError").innerHTML="";
					document.getElementById("email").style.borderColor="#E5E5E5";
					emailVarify="ok";
				}
			}
		}
		xmlhttp.open('GET','customer_email.php?email='+email, true);
		xmlhttp.send();
		return true;
	}
}

function Mobile(){
	var mobileVar=document.customer_contact_form.mobile.value;
	var mobileLengthVar=mobileVar.length;
	
	if(mobileVar==""){
		document.getElementById("mobile").style.borderColor="red";
		document.getElementById("mobileError").innerHTML="Please enter correct mobile number";
	}
	else if(!/^[0-9., ]*$/g.test(mobileVar))						{document.getElementById("mobileError").innerHTML="Invalid mobile number format.";
																	 document.getElementById("mobile").focus();}
	else if(mobileLengthVar < 10)									{document.getElementById("mobileError").innerHTML="invalid mobile number!";}
	else if(mobileLengthVar > 13)									{document.getElementById("mobileError").innerHTML="invalid mobile number!";
																	 document.getElementById("mobile").focus();}
	else															{document.getElementById("mobile").style.borderColor="#E5E5E5";
																	document.getElementById("mobileError").innerHTML=""; return true;}
}

function Form1Script(){
	var name=document.customer_contact_form.name.value;
	var gender=document.customer_contact_form.gender.value;
	var email=document.customer_contact_form.email.value;
	var contact=document.customer_contact_form.mobile.value;
	if( Name() == true && Gender() == true && Email() == true && emailVarify=='ok' && Mobile() == true  ){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				if(xmlhttp.responseText==1){
					$('#updateModal2').modal('toggle');
					OpenMessenger();
				}
				else{
					document.getElementById("allPhpErrors").innerHTML="Error Occured! Please enter correct data.";
				}
			}
		}
		xmlhttp.open('GET','customer_contact.php?name='+name+'&gender='+gender+'&email='+email+'&contact='+contact, true);
		xmlhttp.send();
	}
		
}

</script>
								
								<div class="form-group">
									<div class="col-sm-12" style="text-align:center">
										<button type="button" id="form1Script" onclick="Form1Script()" class="btn btn-primary btn-block btn-lg" 
											style="border-radius:2px; padding:9px;  font-size:16px; font-weight:600" >
											SEND CALLBACK REQUEST
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>	
				</div>
			</div>
			
		</div>
	</div>
</div>

	
<!---navbar--->
<?php include('inc/pages/navbar-index.php');?>

<h1 style="display:none">Index or Home Page</h1>
<!---body--->
<div class="container-fluid" id="bodyCenter" style="z-index:4; position:relative">

	<div class="col-lg-12" style="padding:0px; background-color:#CC3300; ">
		<div class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="item active" style="position:relative; top:0;">
					<img id="hideImage1" src="assets/allpics/w4.jpg" alt="index" style="width:100%;">
					<img id="hideImage2" src="assets/allpics/ww4.jpg" alt="index" style="width:100%;">
				</div>
				<div class="col-lg-4" style="position:absolute; top:1%; padding:0px; text-align:center; right:0;">
					<span style="background-color:#ff0000;display:block; background:rgba(230, 201, 127,0.4); padding:10px;border-top-left-radius:50px; 
							border-bottom-left-radius:50px;">
					<span id="imageText">Three Simple Steps<br> </span>
					<span id="imageText2">Create Profile, Search Rishta, Send Messages</span><br>
					</span>
				</div>
				<div class="col-lg-5" id="imageCenterText2">
					<span style="display:block; padding:10px; border-radius:5px;">
					<span id="imageText" style=" color:#FFFFFF; font-size:100px; font-family:'Dosis-Bold'; text-shadow: 2px 2px #c48f65;">RISHTAWEB.COM</span><br />
					<div id="imageText2" style="color:#FFFFFF; margin-top:-25px">An Amazing Place to Find Your Life Partner</div><br>
					</span>
				</div>
				<div class="col-lg-8" id="centerLinks">
					<a rel="canonical" href="CompleteSignUp.php" style="text-decoration:none; " id="createAccountNowText">
						<span>
							<span id="createAccountNowTextInner">Create Account Now</span><br />
						</span>
					</a>
					<a rel="canonical" href="login.php" id="logoText3">Login</a>
				</div>
				<div class="col-lg-4" style="position:absolute; bottom:5%; padding:0px; text-align:center; left:0; ">
					<span style="background-color:#ff0000;display:block;background:rgba(255,0,0,0.3); padding:10px;border-top-right-radius:50px; border-bottom-right-radius:50px;">
					<span id="imageText" style="color:#640000">Let's Find Someone Special</span><br>
					<span id="imageText2" style="color:#640000; ">Who Cares for You More than You</span><br>
					</span>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-lg-12 col-xs-12" style="padding:0px; text-align:center; padding:50px; padding-top:0px; background: linear-gradient(to bottom, #f5f5f5 0%, #fdfdfd 100%); ">
		<div class="col-lg-4 col-md-4 col-sm-4" style="padding:0px; padding-top:50px;">
			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="padding:0px">
			<a rel="canonical" href="CompleteSignUp.php" style="text-decoration:none; ">
			<div style="padding:15px; border:1px solid lightgray; box-shadow:0px 0px 2px 0px lightgray; border-radius:4px; color:#f96714; 
			font-family:'Segoe UI'; font-size:24px; font-weight:600">
				<i class="far fa-edit"></i>
				<div style="margin-top:5px; font-size:16px">Create Free Account</div>
				<div style="font-size:12px; font-family:'Segoe UI';">Fill the signup form and login to your RISHTAWEB account </div>
			</div>	
			</a>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-12 "></div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding:0px; margin-top:50px;">
			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="padding:0px">
			<a rel="canonical" href="CompleteSignUp.php" style="text-decoration:none; ">
			<div style="padding:15px; border:1px solid lightgray; box-shadow:0px 0px 2px 0px lightgray; border-radius:4px;  color:#f96714; 
			font-family:'Segoe UI'; font-size:24px; font-weight:600">	
				<i class="fas fa-search"></i>
				<div style="margin-top:5px; font-size:16px">Search Rishta</div>
				<div style="font-size:12px; font-family:'Segoe UI';">Advanced Search Bar enables You to find rishta according to your choice</div>
			</div>
			</a>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-12 "></div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding:0px; margin-top:50px;">
			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="padding:0px">
			<a rel="canonical" href="CompleteSignUp.php" style="text-decoration:none; ">
			<div style="padding:15px; border:1px solid lightgray; box-shadow:0px 0px 2px 0px lightgray; border-radius:4px; color:#f96714; 
			font-family:'Segoe UI'; font-size:24px; font-weight:600">	
				<i class="fas fa-comments"></i><div style="margin-top:5px; font-size:16px">Send Free Messages</div>
				<div style="font-size:12px; font-family:'Segoe UI';">Connect and send unlimited messages for free</div>
			</div>
			</a>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
		</div>
	</div>
	
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-xs-12" style="padding:0px">
			<div class="col-lg-12" style="padding:10px; padding-top:30px; padding-bottom:50px; background-color:#f0ede5;">
				<div class="col-lg-12" style="font-size:26px; color:#C48F65; border-left:4px solid #a00000; padding:5px; margin-bottom:10px; padding-left:10px; padding-top:0px">
					<div style="font-weight:600; font-family:'Segoe UI'; margin-top:-8px;">Recent Profiles</div>
					<span style="font-size:12px; font-weight:500; ">Create your account or login to your profile to connect with people.</span>
				</div>
				<div class="col-lg-1"></div>
				<div class="col-lg-12" style="padding:0px">
					<div class="col-lg-12" style="padding:15px; background-color:#FFFFFF; border-radius:5px;">
						<!-- Set up your HTML -->
						<div class="owl-carousel owl-theme myclass">
							<?php
							$male=mysqli_query($conn, "select * from signup where gender='male' && makeMeHide='Show' order by id desc limit 5");
							$female=mysqli_query($conn, "select * from signup where gender='female' && makeMeHide='Show' order by id desc limit 5");
							while( $maleArray=mysqli_fetch_array($male) ){
							while( $femaleArray=mysqli_fetch_array($female) ){
							
							?><a href="viewprofile.php?viewProfileId=<?php echo $maleArray['id']; ?>" style="text-decoration:none">
								<div class="item col-lg-4" style="border:1px solid #CCCCCC; border-radius:5px; width:99%; padding:0px; margin-right:10px">
									<div class="col-lg-12 col-xs-12" style="padding:0px; background-color:#F5F5F5; border-top-left-radius:5px; border-top-right-radius:5px">
										<div class="col-lg-4 col-md-4 col-sm-12 col-xs-4" style="padding:0px; padding:8px;">
											<div style="height:75px; width:75px; border-radius:50%; border:3px solid #FFFFFF; box-shadow:0px 0px 2px #CCCCCC; padding:0px;">
								<?php if($maleArray["publicProfile"]!="Private"){?>
									<img src="<?php echo $maleArray['uploadProfilePicture']; ?>"  style="height:100%; width:100%; border-radius:50%;" >
								<?php }
								 else if($maleArray["gender"]=="male"){?><img src="assets/allpics/male4.png" style="height:100%; width:100%; border-radius:50%;" /><?php } 
								 else{?><img src="assets/allpics/female4.png" style="height:100%; width:100%; border-radius:50%;" /><?php } ?>											
								 </div>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-12 col-xs-8 location_icon">
											<i class="fas fa-map-marker-alt" style=" color:#385898; font-size:22px"></i>
											<span style="font-family:'Segoe UI'; font-weight:bold; font-size:16px; margin-left:5px; color:#385898">
												<?php if($maleArray["city"]!=""){echo strtoupper($maleArray["city"]);}else{echo strtoupper($maleArray["country"]);}?>
											</span>
										</div>
									</div>
									<div class="col-lg-12" style="padding:5px; ">
										<div class="col-lg-12" style="font-family:'Segoe UI'; padding:0px">
											<div class="col-lg-12" style="padding:5px; word-wrap: break-word; overflow: hidden; text-overflow:ellipsis; white-space: nowrap;">
												<div style="color:#385898; font-weight:bold; font-size:16px">
													<?php echo $maleArray["firstName"];
														$lastName=$maleArray["lastName"];
														$words = explode(" ", $lastName);
														$acronym = "";
														
														foreach ($words as $w) {
														  $acronym .= $w[0];
														}
														echo " ".$acronym[0].".";
													?>
													<span style="font-weight:500; font-size:11px; float:right; "> id: <?php echo $maleArray["id"];?></span>
												</div>
												<span style="margin-top:5px; color:#999999; font-weight:400">
													<div style="font-size:13px">
														<i class="fas fa-male" style="margin-right:20px; margin-left:2px; color:#BC70A4; font-size:12px"></i> 
														<?php echo $maleArray["gender"];?>
													</div>
													<span style="font-size:13px;">
														<i class="fas fa-user-clock" style="margin-right:10px; color:#BC70A4; font-size:12px"></i> 
														<?php $row11 = array('dob'=>$maleArray['dob']);	echo ageCalculator($row11['dob']);	?> Old
													</span><br />
													<span style="font-size:13px">
														<i class="fab fa-delicious" style="margin-right:14px; color:#BC70A4; font-size:12px"></i> 
														<?php echo $maleArray["caste"];?>
													</span><br />
													<span style="font-size:13px">
														<i class="fas fa-user-friends" style="margin-right:10px; color:#BC70A4; font-size:12px"></i> 
														<?php echo $maleArray["maritalStatus"];?>
													</span><br />
													<span style="font-size:13px">
														<i class="fas fa-user-graduate" style="margin-right:14px; color:#BC70A4; font-size:12px"></i> 
														<?php echo $maleArray["education"];?>
													</span><br />
													<span style="font-size:13px">
														<i class="fas fa-briefcase" style="margin-right:13px; color:#BC70A4; font-size:12px"></i>
														<?php echo $maleArray["profession"];?>
													</span><br />
													<span style="font-size:13px">
														<i class="fas fa-mosque" style="margin-right:10px; color:#BC70A4; font-size:12px"></i> 
														<?php echo $maleArray["religion"];?>
													</span><br />
												</span>
											</div><div style="color:#F3F3F3"></div>
											<div class="col-lg-12" style="color:#666666; padding:5px; height:82px; border:1px solid #EBEBEB;  
												padding:8px;  font-size:13px; padding-top:4px; margin-top:10px; border-radius:2px; word-wrap: break-word;
													 overflow: hidden; text-overflow:ellipsis; margin-bottom:5px; font-family:'Segoe UI'">
												<?php echo $maleArray["aboutYourself"];?>
											</div>
										</div>
									</div>
								</div>
								</a>
								<a href="viewprofile.php?viewProfileId=<?php echo $maleArray['id']; ?>">
								<div class="item col-lg-4" style="border:1px solid #CCCCCC; border-radius:5px; width:99%; padding:0px; margin-right:10px">
									<div class="col-lg-12 col-xs-12" style="padding:0px; background-color:#F5F5F5; border-top-left-radius:5px; border-top-right-radius:5px">
										<div class="col-lg-4 col-md-4 col-sm-12 col-xs-4" style="padding:0px; padding:8px;">
											<div style="height:75px; width:75px; border-radius:50%; border:3px solid #FFFFFF; box-shadow:0px 0px 2px #CCCCCC; padding:0px;">
								<?php if($femaleArray["publicProfile"]!="Private"){?>
								<img src="<?php echo $femaleArray['uploadProfilePicture']; ?>" style="height:100%; width:100%; border-radius:50%;" ><?php }
								 else if($femaleArray["gender"]=="male"){?><img src="assets/allpics/male4.png" style="height:100%; width:100%; border-radius:50%;" /><?php } 
								 else{?><img src="assets/allpics/female4.png" style="height:100%; width:100%; border-radius:50%;" /><?php } ?>											
								 </div>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-12 col-xs-8 location_icon">
											<i class="fas fa-map-marker-alt" style=" color:#385898; font-size:22px"></i>
											<span style="font-family:'Segoe UI'; font-weight:bold; font-size:14px; margin-left:5px; color:#385898">
												<?php if($femaleArray["city"]!=""){echo strtoupper($femaleArray["city"]);}else{echo strtoupper($femaleArray["country"]);}?>
											</span>
										</div>
									</div>
									<div class="col-lg-12" style="padding:5px; ">
										<div class="col-lg-12" style="font-family:'Segoe UI'; padding:0px">
											<div class="col-lg-12" style="padding:5px; word-wrap: break-word; overflow: hidden; text-overflow:ellipsis; white-space: nowrap;">
												<div style="color:#385898; font-weight:bold; font-size:16px">
													<?php echo $femaleArray["firstName"];
														$lastName=$femaleArray["lastName"];
														$words = explode(" ", $lastName);
														$acronym = "";
														
														foreach ($words as $w) {
														  $acronym .= $w[0];
														}
														echo " ".$acronym[0].".";
													?>
													<span style="font-weight:500; font-size:11px; float:right; "> id: <?php echo $femaleArray["id"];?></span>
												</div>
												<span style="color:#999999; font-weight:400">
													<div style="font-size:13px">
														<i class="fas fa-female" style="margin-right:20px; margin-left:2px; color:#BC70A4; font-size:12px"></i> 
														<?php echo $femaleArray["gender"];?>
													</div>
													<span style="font-size:13px;">
														<i class="fas fa-user-clock" style="margin-right:10px; color:#BC70A4; font-size:12px"></i> 
														<?php $row11 = array('dob'=>$femaleArray['dob']);	echo ageCalculator($row11['dob']);	?> Old
													</span><br />
													<span style="font-size:13px">
														<i class="fab fa-delicious" style="margin-right:14px; color:#BC70A4; font-size:12px"></i> 
														<?php echo $femaleArray["caste"];?>
													</span><br />
													<span style="font-size:13px">
														<i class="fas fa-user-friends" style="margin-right:10px; color:#BC70A4; font-size:12px"></i> 
														<?php echo $femaleArray["maritalStatus"];?>
													</span><br />
													<span style="font-size:13px">
														<i class="fas fa-user-graduate" style="margin-right:14px; color:#BC70A4; font-size:12px"></i> 
														<?php echo $femaleArray["education"];?>
													</span><br />
													<span style="font-size:13px">
														<i class="fas fa-briefcase" style="margin-right:13px; color:#BC70A4; font-size:12px"></i>
														<?php echo $femaleArray["profession"];?>
													</span><br />
													<span style="font-size:13px">
														<i class="fas fa-mosque" style="margin-right:10px; color:#BC70A4; font-size:12px"></i> 
														<?php echo $femaleArray["religion"];?>
													</span><br />
												</span>
											</div><div style="color:#F3F3F3"></div>
											<div class="col-lg-12" style="color:#666666; padding:5px; height:82px; border:1px solid #EBEBEB;  
												padding:8px;  font-size:13px; padding-top:4px; margin-top:10px; border-radius:2px; word-wrap: break-word;
													 overflow: hidden; text-overflow:ellipsis; margin-bottom:5px; font-family:'Segoe UI'">
												<?php echo $femaleArray["aboutYourself"];?>
											</div>
										</div>
									</div>
								</div>
								</a>
							<?php 
								break;
								}
							}?>
						</div>
					</div>
				</div>
				<div class="col-lg-1"></div>
			</div>
		</div>
	</div>
</div>
<script src="assets/owl/docs/assets/owlcarousel/owl.carousel.min.js"></script>
<script type="text/javascript">

	var owl = $('.owl-carousel');
	owl.owlCarousel({
		items:4,
		loop:true,
		margin:10,
		autoplay:true,
		autoplayTimeout:12000,
		autoplayHoverPause:true,
		responsive:{
        0:{
		
            items:1,
			dots:false,
            nav:true,
  			navText:['<i class="fas fa-arrow-left" style="margin-right:5px"></i> Prev</div>','Next <i class="fas fa-arrow-right" style="margin-left:5px"></i>']
        },
        700:{
            items:5,
			dots:false,
           	nav:true,
  			navText:['<i class="fas fa-arrow-left" style="margin-right:5px"></i> Prev</div>','Next <i class="fas fa-arrow-right" style="margin-left:5px"></i>']
        },
		1400:{
            items:5,
			dots:false,
			loop:true,
			nav:true,
  			navText:['<i class="fas fa-arrow-left" style="margin-right:5px"></i> Prev</div>','Next <i class="fas fa-arrow-right" style="margin-left:5px"></i>']
        }
    }
	});
	
</script>
	
	
	<div class="col-lg-12 col-xs-12" style="padding:0px; height:auto; z-index:2; position:relative">
		<img src="assets/allpics/x4.jpg" width="100%" height="208" style="position:relative; top:0; opacity:0.2"/>
		<span id="gatewayText">A Gateway is Here<br>	
			<span id="gatewayText2">Find Rishta in Your Religion, Caste, City or Anywhere You Want</span><br />
			<span id="gatewayText2">Just Create Your Account, Search Your Dream Partner & Send Rishta to Them</span><br />
			<span id="gatewayText2">RishtaWeb is a platform which facilitates people to find their suitable matches for free</span>
		</span>
	</div>
</div>

<!---//body--->

<?php include('inc/pages/footer.php');?>

</body>
</html>


<!-- 
<script type="text/javascript">
$( document ).ready(function() {
   $('#updateModal').modal('toggle');
   $("#updateModal").modal({backdrop: "static"});
   $('#updateModal').on('hidden.bs.modal', function () {
	 OpenMessenger();
	});
});
</script> -->









