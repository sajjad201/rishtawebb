<?php
session_start();
require 'inc/connection/connect.php';
$firstPerson=$_SESSION["firstPersonId"];

if (!isset($_SESSION["firstPersonId"]))
{
  header("location: /");
}

$firstPerson=$_SESSION["firstPersonId"];

date_default_timezone_set("Asia/Karachi");
$timestamp = date('d/m/Y-h:i:s a', time());
$splitTimeStamp = explode("-",$timestamp);
$date = $splitTimeStamp[0];
$time = $splitTimeStamp[1];


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include('inc/pages/links-one.php');?>
</head>

<body style="background-color:#FFFFFF">


<!-- login-navbar -->
<?php include('inc/pages/navbar-login.php');?>










<h1 style="display:none">Messages</h1>

<div class="container-fluid" style="margin-top:20px">
	<div class="col-lg-12 col-xs-12" style="margin-top:16px; margin-top:20px;   border:1px solid #CCCCCC; background-color:#FFFFFF; padding:0px; border-radius:5px;">
	
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="rightBorder">
		
			<div class="col-lg-12 col-xs-12" style="padding:10px; ">
				<div class="col-lg-12" style="padding:0px; ">
					<div style="font-size:26px; font-family:Helvetica; font-weight:600; padding:5px; text-align:left;padding-left:10px; text-align:center; color:#006e6d;">
							All Conversations
						<br>
						<span style="font-size:12px; font-weight:500; padding:15px">
							<a href="sendShortMessage.php" style="text-decoration:none; color:#BEBEBE; ">
							Send Message to a Specific Person</a>
						</span>
					</div>
				</div>
			</div>
		
			<span id="showResponceText">
			    
			     <span class="col-lg-12 col-xs-12 progress" style="padding:0px; border-radius:0px; height:30px; border-top:1px solid lightgray; border-bottom:1px solid lightgray; padding:3px; background-color:white">
                     <span class="col-lg-12 col-xs-12 progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" 
                     style="width:100%; text-align:center; border-radius:0px; font-family:'Segoe UI'; height:22px; ">
                        Loading Your Messages. Please Wait...
                     </span>
                </span>     
			    
			</span>
		
			<script>
			function addNewMsg(type, newMsg)	{	document.getElementById("showResponceText").innerHTML=newMsg;	}
			function waitForNewMsg()
			{ 
				$.ajax
				({
					type: "GET",
					url: "inc/routes/allConversationUpdate.php",
					async: true,
					cache: false,
					timeout:50000,
					 
			success: function(data){	addNewMsg("new", data);	setTimeout( waitForNewMsg,10000 );	},
			error: function(XMLHttpRequest, textStatus, errorThrown){addNewMsg("error", textStatus + " (" + errorThrown + ")");	setTimeout(	waitForNewMsg,	10000	);	}
				});
			}
			$(document).ready(function(){ waitForNewMsg();	});
			</script>
				
			</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="hideRightSide">
			<i class="fas fa-comments" style="font-size:55px; color:#006e6d;"></i>
			<p id="startConversationText1">Select a Conversation</p> 
			<p id="startConversationText2" >If no conversation found, visit user profile, send message<br> to them to start conversation</p> 
		</div>
		
	</div>
</div>

<?php include('inc/pages/footer.php');?>


</body>
</html>







