<?php
session_start();
require 'inc/connection/connect.php';

$firstPerson=@$_SESSION["firstPersonId"];

function test_input($data)
{
	return $data;
}


$errorList=array(); 
$errorList["emailErr"] = $errorList["subjectErr"] = $errorList["messageErr"] =
$emailErr = $subjectErr = $messageErr ="";
$allErrorsOfPhp = $emailSent = $emailNotSent = "";
$errorOccurred=false;

if($_SERVER['REQUEST_METHOD']=="POST")
{
	if(empty($_POST['email']))
	{
		$errorList["emailErr"]="please enter email address";
		$errorOccurred=true;
	}
	else
	{
		$email=test_input($_POST['email']);
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$errorList["emailErr"]="invalid email format";
			$errorOccurred=true;
		}
	}
	if(empty($_POST['subject']))
	{
		$errorList["subjectErr"]="please select your subject ";
		$errorOccurred=true;
	}
	else
	{	
		$subject=test_input($_POST['subject']);
	}
	if(empty($_POST['aboutYourself']))
	{
		$errorList["explainYourSelfErr"]="please enter some message ";
		$errorOccurred=true;
	}
	else
	{	
		$aboutYourself=test_input($_POST['aboutYourself']);
	}
	
	if( $errorOccurred == false )
	{
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "From: " . $email . "\r\n" .
		"Reply-To: " . $email . "\r\n" .
		"X-Mailer: PHP/" . phpversion();
		
           
		if(	mail("rishtawebteam@gmail.com", $subject, $aboutYourself, $headers  )	)
		{$emailSent="Thankx for Contacting Us.";}else{$emailNotSent="Email could not Sent. Try Again.";}
	}
	else
	{
		$allErrorsOfPhp="Still some errors exists, please provide correct information";
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<?php include('inc/pages/links-one.php');?>
</head>
<body style="background-color:#EFEFEF">

<?php if (!isset($_SESSION["firstPersonId"])){?>
<div class="container-fluid" style=" padding:0px; padding-bottom:10px; position:fixed; overflow:hidden; width:100%; z-index:1; top:0">
	<div class="col-lg-12" style="box-shadow:0px 0px 10px gray; background-color:#A00000; color:#FFFFFF;">
		<div id="logoTextMargin">
			<a href="index.php" style="text-decoration:none;">
				<span id="logoText1">RISHTA<span id="logoText2">WEB</span></span>
			</a>
		</div>
	</div>
</div>
<h1 style="display:none">Contact Us</h1>
<br><br>

<?php } else{?>

<!-- login-navbar -->
<?php include('inc/pages/navbar-login.php');?>

<?php }?>

<div class="container-fluid" style="margin-top:20px; margin-bottom:40px">
	<div class="row">
		<div class="col-lg-12" style="margin-top:20px; margin-bottom:0px; padding:0px;">
			<div class="col-lg-3"></div>
			<div class="col-lg-6" style="padding:0px;">
				<div class="col-lg-12" >
					<div class="col-lg-12" id="whitePage">

						<div class="col-lg-2"></div>
						<div class="col-lg-8" style="padding:0px; margin-top:30px">
							<p id="whitePageChild1">Contact Us</p>
							<p id="whitePageChild2">Need Any Assistance? Just 
							Drop Your Message Direct to the Administrator and Will Respond as soon as Possible through Email You provided.</p>
							<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="contactForm">
						
							<div>
								<div class="col-lg-12 col-sm-12">
									<input type="text" class="form-control" name="email" id="email" value="@gmail.com" onBlur="Email()" autofocus>
									<div id="emailError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["emailErr"];?></div>
								</div>
							</div>
							<div>
								<div class="col-lg-12 col-sm-12" style="margin-top:10px">
									<select class="form-control" name="subject" id="subject" onBlur="Subject()">
										<option value="0">Select Subject</option>
										<option value="Feedback">Feedback</option>
										<option value="Comment">Comment</option>
										<option value="AboutPrivacy">About Privacy</option>
										<option value="General">General</option>
									</select>
									<div id="subjectError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["subjectErr"]; ?></div>
								</div>
							</div>
							
							<div>
								<div class="col-lg-12 col-sm-12" style="margin-top:10px">
									<textarea class="form-control" id="aboutYourself" name="aboutYourself" 
									style="resize:vertical" rows="6" onBlur="AboutYourself()"
									placeholder="write about what you want to ask..."></textarea>
									<div id="explainYourselfError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["messageErr"]; ?></div>
								</div>
							</div>
							<div style="margin-top:-10px">
								<div class="col-lg-12 col-sm-12">
									<p id="fillFormErrors" style="padding:3px; border:1px solid #800000; border-radius:3px; font-family:'Segoe UI'; color:#333333; color:#F7F7F7 
									background-color:#FFF0F0; display:none; text-align:center"><?php //echo $allErrorsOfPhp;?></p>
								</div>
								<div class="col-lg-12 col-sm-12">
									<p style="border-radius:3px; font-family:'Segoe UI'; color:#333333; color:#00CC33; font-size:18px; 
									text-align:center"><?php echo $emailSent; ?></p>
								</div>
								<div class="col-lg-12 col-sm-12">
									<p style="border-radius:3px; font-family:'Segoe UI'; color:red; color:#FF0000; font-size:18px; 
									text-align:center"><?php echo $emailNotSent;?></p>
								</div>
							</div>
							<div style="margin-top:-5px">
								<div class="col-lg-12 col-sm-12">
									<button type="button" class="btn btn-primary btn-block btn-lg" style="border-radius:2px; padding-left:30px; padding-right:30px; outline:none;
									background-color:#009996; border:none" onClick="SubmitContactForm()">Send</button>
								</div>
							</div>
							</form>
							<div class="col-lg-12" style="background-color:#DFDFDF; padding:30px; padding-top:25px; margin-top:50px; border-radius:10px; text-align:center">
								<span style="font-family:'Segoe UI';  color:#666666; font-size:18px">Find Us on Social Media</span><br>
								<a href="https://www.facebook.com/rishtawebpk/" target="_blank"><i class="fa fa-facebook-square" style="font-size:48px;color:#1D3C78"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>
	</div>
</div>

<?php include('inc/pages/footer.php');?>

</body>
</html>




















<!--formScript-->
<script type="text/javascript">

function Email()
{
	document.getElementById("fillFormErrors").style.display="none";
	var email=document.contactForm.email.value;
	var varifyEmail = /^(([^<>()[\]\\.,;:\s@\']+(\.[^<>()[\]\\.,;:\s@\']+)*)|(\'.+\ '))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
	if(email=="")													
	{
														document.getElementById("email").style.borderColor="red";
														document.getElementById("emailError").innerHTML="Please enter email address";
	}
	else if(varifyEmail.test(email) == false) 			{document.getElementById("emailError").innerHTML="Please enter correct email";return false;}
	else if(email!="")									{document.getElementById("email").style.borderColor="#E5E5E5";
														 document.getElementById("emailError").innerHTML="";return true; }
}
function Subject()
{
	document.getElementById("fillFormErrors").style.display="none";
	if(document.contactForm.subject.value==0)			{document.getElementById("subjectError").innerHTML="please select your subject";
														 document.getElementById("subject").style.borderColor="red";}
	else												{document.getElementById("subjectError").innerHTML="";
														 document.getElementById("subject").style.borderColor="#E5E5E5";return true;}
}
function AboutYourself()
{
	var countExplainYourself = document.contactForm.aboutYourself.value.length;
	document.getElementById("fillFormErrors").style.display="none";

	if(document.contactForm.aboutYourself.value== 0)	{document.getElementById("explainYourselfError").innerHTML="please explain yourself";
														 document.getElementById("aboutYourself").style.borderColor="red";}
	else if(countExplainYourself < 10)					{document.getElementById("explainYourselfError").innerHTML="minimum 10 char required";
														document.getElementById("aboutYourself").style.borderColor="red";}
	else if(countExplainYourself > 500)					{document.getElementById("explainYourselfError").innerHTML="Max 500 char are allowed";
														document.getElementById("aboutYourself").style.borderColor="red";}
	else												{document.getElementById("explainYourselfError").innerHTML="";
														 document.getElementById("aboutYourself").style.borderColor="#E5E5E5";return true;}
}

function SubmitContactForm()
{
	if(Email()==true && Subject()==true && AboutYourself()==true  )
	{
		document.contactForm.submit();
	}
	else
	{
		document.getElementById("fillFormErrors").style.display="block";
		document.getElementById("fillFormErrors").innerHTML="please fill the form, then send.";
	}
}
</script>
<!--//formScript-->

