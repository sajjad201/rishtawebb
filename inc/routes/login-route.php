<?php
session_start();
require '../connection/connect.php';





if(isset($_SESSION["firstPersonId"]))
{
  header("Location: ../../searchProfiles.php");
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
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		$data=mysqli_real_escape_string(mysqli_connect("localhost","root","","rishtawebchat"), $data);
		$data=str_replace("'", "", $data);
		$data=str_replace("`", "", $data);
		$data=str_replace("''", "", $data);
		$data=str_replace(";", "", $data);
		$data=str_replace(" ", "", $data);
		return $data;
	}
	
	if(empty($_POST['email']))
	{
		$errorList["emailErr"]="please enter email address";
		$_SESSION['login_email_error']=$errorList["emailErr"];
		$errorOccurred=true;
	}
	else
	{
		$email=test_input($_POST['email']);
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$errorList["emailErr"]="invalid email format";
			$_SESSION['login_email_error']=$errorList["emailErr"];

			$errorOccurred=true;
		}
	}
	
	if(empty($_POST['password']))
	{	
		$errorList["passwordErr"]="Enter Password";
		$_SESSION['login_password_error']=$errorList["passwordErr"];
		$errorOccurred=true;
	}
	else
	{
		$password=test_input($_POST['password']);
		if(strlen($_POST["password"]) < 8)
		{
			$errorList["passwordErr"]="your password is too small(min 8 char require)";
			$_SESSION['login_password_error']=$errorList["passwordErr"];
			$errorOccurred=true;
		}
	}
	
	if( $errorOccurred == false )
	{
		
		$check = $conn->prepare("SELECT id,userName FROM login WHERE userName=? && password=?");
		$check->bind_param("ss", $email, $password);
		$check->execute();
		$check->bind_result($id, $user);
		$print = $check->fetch();
		
		 if($print) 
		 {
		 	$_SESSION['firstPersonId'] =$id;
            $_SESSION['username'] = $user;
			header('Location: ../../searchProfiles.php');
		 }
		 else
		 {
			header('Location: ../../login.php');
			$allErrorsOfPhp="Invalid User Name or Password!";
			$_SESSION['login_error']=$allErrorsOfPhp;
			 
		 }
	}
	else
	{
		$allErrorsOfPhp="Still some errors exists, please provide correct information";
		$_SESSION['login_error']=$allErrorsOfPhp;
	}
	
}	


?>