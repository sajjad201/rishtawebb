<?php
session_start();
require 'inc/connection/connect.php';

if(!isset($_SESSION["firstPersonId"]))
{
  header("Location: /");
}

$firstPerson=$_SESSION["firstPersonId"];
$emailNotAvailable=$msgSent="";


?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include('inc/pages/links-one.php');?>
</head>
<body style="background-color:#EFEFEF">

<!-- login-navbar -->
<?php include('inc/pages/navbar-login.php');?>

<h1 style="display:none">Send Short Message</h1>


<div class="container-fluid" >
	<div class="row">
		<div class="col-lg-12" style="margin-top:80px; margin-bottom:10px;">
			<div class="col-lg-3"></div>
			
			<div class="col-lg-6" id="lessPadding">
				<span id="lessPaddingText">Send Message to someone with ID number</span><br />
				<span style="font-family:'Segoe UI'; font-size:11px; color:#999999">Enter id for example( 41574 ) with no space or comma etc.</span>
				<div class="col-lg-12" style="height:auto; padding:0px; margin-top:15px">
				<form name="sendShortMessage" method="post" action="">
					<input type="text" name="emailForMessage" id="emailForMessage" class="form-control"  placeholder="Id example: 41574" 
						style="border-radius:3px; margin-bottom:5px" onblur="VarifyEmail()"/>
						<p style="padding-left:2px; color:#C40000; font-size:12px" id="emailNotAvailable"></p>
					<textarea name="shortMessage" id="shortMessage" style="resize:none; border-radius:3px" class="form-control" 
						placeholder="Type Message"rows="3" onblur="CheckEmail()"></textarea>
						<p style="padding-left:2px; color:#C40000; font-size:12px" id="emptyMsgError"></p>
					<input type="button" class="btn btn-primary" value="Send Message" style="border-radius:3px; margin-top:3px" 
						onclick="SendMessage()" id="sendMessage"/><br />
						<a rel="canonical" href="allConversation.php">back</a>
						<p style="padding-left:2px; color:#009966; display:block; background-color:#cce0cc;color:#267d26; border-radius:5px;
						padding:10px;display:none; border:1px solid #85c9a6; margin-top:5px; text-align:center;  font-family:Helvetica;" id="msgSent">
						</p>
				</form>
				
				</div>
			</div>
<script>
var input = document.getElementById("shortMessage");
input.addEventListener("keyup", function(event) {
	event.preventDefault();
	if (event.keyCode === 13) {
		document.getElementById("sendMessage").click();
	}
});


var varifyEmail=0;

function myTrim(x) {
  return x.replace(/^\s+|\s+$/gm,'');
}
	
function VarifyEmail(submitMessage)
{						


	
	var firstPerson=<?php echo $firstPerson;?>;
	var emailForMessage=myTrim(document.getElementById("emailForMessage").value);
	var shortMessage=myTrim(document.getElementById("shortMessage").value);

	if(firstPerson == emailForMessage)
	{
		document.getElementById("emailNotAvailable").innerHTML="You can't sent message to yourself! send to another person";
	}
	else if( emailForMessage == "" )
	{
		document.getElementById("emailNotAvailable").innerHTML="Please Enter Email of a Person";
		document.getElementById("msgSent").innerHTML="";
		document.getElementById("msgSent").style.display="none";
	}
	else if( emailForMessage != "" )
	{
		document.getElementById("emailNotAvailable").innerHTML="";
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() 
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				if( xmlhttp.responseText == 0)
				{
					document.getElementById("emailNotAvailable").innerHTML="This user is not available. Please enter a valid Id";
					varifyEmail="0";
					document.getElementById("msgSent").innerHTML="";
					document.getElementById("msgSent").style.display="none";
				}
				else if( xmlhttp.responseText == 2 )
				{
					document.getElementById("emailNotAvailable").innerHTML="This user is not available on this site.";
					varifyEmail="0";
					document.getElementById("msgSent").innerHTML="";
					document.getElementById("msgSent").style.display="none";
				}
				else if( xmlhttp.responseText == 1 )
				{
					document.getElementById("emailNotAvailable").innerHTML="";
					varifyEmail="1";
				}
			}
		}
		xmlhttp.open('GET','inc/routes/sendShortMessagePHP.php?emailForMessage='+emailForMessage, true);
		xmlhttp.send();
		return true;
	}
	
}

function CheckEmail()
{
	var shortMessage=document.getElementById("shortMessage").value;
	if(shortMessage == "")
	{
		document.getElementById("emptyMsgError").innerHTML="Please Type a Message";
		document.getElementById("msgSent").innerHTML="";
		document.getElementById("msgSent").style.display="none";
	}
	if(shortMessage != "")
	{
		document.getElementById("emptyMsgError").innerHTML="";
		document.getElementById("msgSent").innerHTML="";
		document.getElementById("msgSent").style.display="none";
	}
}

function SendMessage()
{
	var emailForMessage=myTrim(document.getElementById("emailForMessage").value);
	var shortMessage=myTrim(document.getElementById("shortMessage").value);
	
	VarifyEmail();
	if( varifyEmail == 0)
	{
		document.getElementById("emailNotAvailable").innerHTML="This User is not Registered on this Site. Please Enter a Valid Email";
		document.getElementById("msgSent").innerHTML="";
		document.getElementById("msgSent").style.display="none";
	}
	if( varifyEmail == 1 )
	{
		document.getElementById("emailNotAvailable").innerHTML="";
		document.getElementById("msgSent").innerHTML="";
		document.getElementById("msgSent").style.display="none";
	}
	if(shortMessage == "")
	{
		document.getElementById("emptyMsgError").innerHTML="Please Type a Message";
		document.getElementById("msgSent").innerHTML="";
		document.getElementById("msgSent").style.display="none";
	}
	if(shortMessage != "")
	{
		document.getElementById("emptyMsgError").innerHTML="";
		document.getElementById("msgSent").innerHTML="";
		document.getElementById("msgSent").style.display="none";
	}
	
	if(!/^[a-zA-Z0-9 ]*$/g.test(shortMessage)){document.getElementById("emptyMsgError").innerHTML="Invalid Message Format (only A-Z & 0-9 allowed)";}
	else if( varifyEmail != 0 && shortMessage != "" )
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() 
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				if( xmlhttp.responseText == "male")
				{
					document.getElementById("msgSent").style.display="block";
					document.getElementById("msgSent").style.background="#800000";
					document.getElementById("msgSent").style.borderColor="black";
					document.getElementById("msgSent").style.color="white";
					document.getElementById("msgSent").innerHTML="It's a male id. You can't chat with any male.";
					
				}
				else if( xmlhttp.responseText == "female" )
				{
					document.getElementById("msgSent").style.display="block";
					document.getElementById("msgSent").style.background="#800000";
					document.getElementById("msgSent").style.borderColor="black";
					document.getElementById("msgSent").style.color="white";
					document.getElementById("msgSent").innerHTML="it's a female id. You can't chat with any female.";
				}
				else
				{
					document.getElementById("msgSent").style.background="#cce0cc";
					document.getElementById("msgSent").style.borderColor="#85c9a6";
					document.getElementById("msgSent").style.color="#267d26";
					document.getElementById("msgSent").style.display="block";
					document.getElementById("msgSent").innerHTML="Your Message has been sent successfully!";
				}
			}
		}
		xmlhttp.open('GET','inc/routes/sendShortMessagePHP02.php?emailForMessage='+emailForMessage+'&shortMessage='+shortMessage, true);
		xmlhttp.send();
	}
}

</script>
			
			<div class="col-lg-3"></div>
		</div>
	</div>
</div>
<br /><br /><br /><br /><br /><br /><br />


<?php include('inc/pages/footer.php');?>


</body>
</html>




