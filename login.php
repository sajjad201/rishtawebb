<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include('inc/pages/links-one.php');?>
</head>
<body style="background-color:#F0F0F0">


<?php include('inc/pages/navbar-index.php');?>


<h1 style="display:none">Login</h1>

<div class="container-fluid" id="loginDivMargin">
<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-4"></div>
		
		<div class="col-lg-4" id="loginDiv">
			<div class="col-lg-12" id="innerDiv" >
				<p style="font-size:24px; font-family:'Trebuchet MS'; text-align:center; font-weight:700; color:#00539c">
				<i class="fas fa-sign-in-alt" style="margin-right:15px"></i>        Login to Your Account
				</p>
				<form class="form-horizontal" action="inc/routes/login-route.php" method="post" name="login">
					<div class="form-group">
						<div class="col-sm-12" style="margin-top:10px">
							<input type="text" class="form-control" name="email" id="email" placeholder="Enter Your Email" onBlur="Email()" autofocus>
							<div id="emailError" style="font-size:12px; color:#BF0000;">
								<?php if(isset($_SESSION['login_email_error'])){ echo $_SESSION['login_email_error']; unset($_SESSION['login_email_error']); }?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="text" class="form-control" name="password" id="password" placeholder="Enter Your Password" onBlur="Password()">
							<div id="passwordError" style="font-size:12px; color:#BF0000;">
								<?php if(isset($_SESSION['login_password_error'])){ echo $_SESSION['login_password_error']; unset($_SESSION['login_password_error']); }?>
							</div>
							<p id="allPhpErrors" style="color:#BF0000; text-align:center; font-family:Verdana">
								<?php if(isset($_SESSION['login_error'])){ echo $_SESSION['login_error']; unset($_SESSION['login_error']); }?>
							</p>
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
					 </script>
					
					<div class="form-group">
						<div class="col-sm-12" style="text-align:center">
							<button type="button" id="loginClick" onclick="loginFormSubmit()" class="btn btn-primary" style="border-radius:2px; padding:9px; 
								padding-left:80px; padding-right:80px; font-size:16px; " >Login</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-lg-12" style=" background-color:#F0F0F0; padding:5px; padding-bottom:35px; text-align:center; 
			border-top:2px solid #CCCCCC; border-bottom-left-radius:5px; border-bottom-right-radius:5px;">
				<p style="font-size:14px; color:#666666; font-family:'Segoe UI'; font-weight:600; margin-top:10px">OR</p>
				<a href="CompleteSignUp.php" style="font-family:'Segoe UI'">
			     <i class="fas fa-user-edit" style="margin-right:3px;"></i>   Create Account Now
				</a>
			</div>
			
		</div>
		
		<div class="col-lg-4">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- horizontal_ad_one -->
			<ins class="adsbygoogle"
				 style="display:block"
				 data-ad-client="ca-pub-1248017537402931"
				 data-ad-slot="7486389697"
				 data-ad-format="auto"
				 data-full-width-responsive="true"></ins>
			<script>
				 (adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
		<div class="col-lg-12">
		</div>
	</div>
</div>
</div>

<?php include('inc/pages/footer.php');?>

</body>
</html>



<script>
function Email()
{
	var email=document.login.email.value;
	var varifyEmail = /^(([^<>()[\]\\.,;:\s@\']+(\.[^<>()[\]\\.,;:\s@\']+)*)|(\'.+\ '))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
	if(email=="")													
	{
		document.getElementById("email").style.borderColor="red";
		document.getElementById("emailError").innerHTML="Please enter email address";
	}
	else if(varifyEmail.test(email) == false) {document.getElementById("emailError").innerHTML="Please enter correct email";return false;}
	else if( email != "" )
	{
		document.getElementById("emailError").innerHTML="";
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() 
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				if( xmlhttp.responseText == "0")
				{
					document.getElementById("emailError").innerHTML="Invalid Email Address!";
					document.getElementById("email").style.borderColor="red";
					return false;
				}
				else if( xmlhttp.responseText == "1" )
				{
					document.getElementById("emailError").innerHTML="";
					document.getElementById("allPhpErrors").innerHTML="";
					document.getElementById("email").style.borderColor="#E5E5E5";
					return true;
				}
			}
		}
		xmlhttp.open('GET','loginPHP.php?email='+email, true);
		xmlhttp.send();
		return true;
	}
}

function Password()
{
	var passwordVar=document.login.password.value;
	var passwordLengthVar=passwordVar.length;
	
	if(passwordVar=="")												
	{
		document.getElementById("password").style.borderColor="red";
		document.getElementById("passwordError").innerHTML="Please enter password";
	}
	else if(passwordLengthVar<8)									{document.getElementById("passwordError").innerHTML="Please enter correct password(min 8 char)";}
	else															{document.getElementById("password").style.borderColor="#E5E5E5";
																	document.getElementById("passwordError").innerHTML=""; return true;}
}
function loginFormSubmit()
{
	if(  Email() == true && Password() == true  )
	{
		document.login.submit();
	}
		
}

</script>
















