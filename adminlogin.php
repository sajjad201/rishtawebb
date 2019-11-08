<?php
session_start();
require 'inc/connection/connect.php';

if(isset($_SESSION["adminlogin"])){
  header("Location: admin.php");
}





/*allVariables*/
$errorOccurred=false;
$errorList=array(); 
$errorList["emailErr"] = $errorList["passwordErr"]  = "";
$emailErr = $passwordErr  = $allErrorsOfPhp = "";


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
	
	if(empty($_POST['password']))
	{	
		$errorList["passwordErr"]="Enter Password";
		$errorOccurred=true;
	}
	else
	{
		$password=test_input($_POST['password']);
		if(strlen($_POST["password"]) < 8)
		{
			$errorList["passwordErr"]="your password is too small(min 8 char require)";
			$errorOccurred=true;
		}
	}
	
	if( $errorOccurred == false )
	{
		
		
		
		 if($email=="sajjadali@gmail.com" && $password=="sajjadali12345") 
		 {
		 	$_SESSION['adminlogin'] ="yes";
			header('Location: admin.php');
		 }
		 else
		 {
		 	$allErrorsOfPhp="Invalid User Name or Password!";
		 }
	}
	else
	{
		$allErrorsOfPhp="Still some errors exists, please provide correct information";
	}
	
}	


?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('inc/pages/links-one.php');?>
</head>
<body style="background-color:#F0F0F0">


<div class="container-fluid" style=" padding:0px; padding-bottom:10px; position:fixed; overflow:hidden; width:100%; z-index:1; top:0">
	<div class="col-lg-12" style="box-shadow:0px 0px 10px gray; background-color:#A00000; color:#FFFFFF;">
		<div id="logoTextMargin">
			<a href="index.php" style="text-decoration:none;">
				<span id="logoText1">RISHTA<span id="logoText2">WEB</span></span>
			</a>
		</div>
	</div>
</div>

<h1 style="display:none">Login</h1>

<div class="container-fluid" id="loginDivMargin">
<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-4"></div>
		
		<div class="col-lg-4" id="loginDiv">
			<div class="col-lg-12" id="innerDiv" >
				<p style="font-size:24px; font-family:'Trebuchet MS'; text-align:center; font-weight:700; color:#00539c; text-decoration:underline">
				      Admin Login
				</p>
				<form class="form-horizontal" action="" method="post" name="login">
					<div class="form-group">
						<div class="col-sm-12" style="margin-top:10px">
							<input type="text" class="form-control" name="email" id="email" placeholder="Enter Your Email" onBlur="Email()" autofocus>
							<div id="emailError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["emailErr"]; ?></div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Password" onBlur="Password()">
							<div id="passwordError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["passwordErr"]; ?></div>
							<p id="allPhpErrors" style="color:#BF0000; text-align:center; font-family:Verdana"><?php echo $allErrorsOfPhp; ?></p>
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
								padding-left:80px; padding-right:80px; font-size:16px; " ><i class="fas fa-sign-in-alt" style="margin-right:15px"></i>  Login</button>
						</div>
					</div>
					<br /><br />
				</form>
			</div>
			
			
		</div>
		
		<div class="col-lg-4"></div>
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
















