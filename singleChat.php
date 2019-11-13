<?php
session_start();
require 'inc/connection/connect.php';



if (!isset($_SESSION["firstPersonId"]))
{
  header("location: /");
}


$firstPerson=test_input($_SESSION["firstPersonId"]);
@$_SESSION["secondPerson"]=test_input($_GET["allOtherMembers"]);
@$secondPerson=test_input($_GET["allOtherMembers"]);



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
<body style="background-color:#F0F0F0">

<!-- login-navbar -->
<?php include('inc/pages/navbar-login.php');?>

<style>
.single-sticky {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    z-index: 2;
}
.navbar-login-fixed{
	position: relative !important;
}
</style>
<?php
	
$newMembers=array();
$i=0;
$messageQuery=mysqli_query($conn, " select * from chatdetails where  fromID='$firstPerson' or toID='$firstPerson' order by id desc ");
while($messageArray=mysqli_fetch_array($messageQuery))
{
	if(	$messageArray["fromID"] == $firstPerson )		{	$newMembers[$i]=$messageArray["toID"];	}
	else if( $messageArray["toID"] == $firstPerson )	{	$newMembers[$i]=$messageArray["fromID"];	}
	$i++;
}
$ready=array_filter(array_unique($newMembers));


$result=mysqli_query($conn, "select * from signup where makeMeHide!='Show' and id='$secondPerson' ");
if(@mysqli_num_rows( $result) > 0 ){?>

	<div class="col-lg-12" style="padding:50px; margin-top:15px">
		<p style="font-size:24px; font-family:'Segoe UI'; border:2px solid #999999; margin-top:10px; margin-bottom:10px; color:#999999; 
		text-align:center; font-weight:600; border-radius:5px; padding:10px">
			This user is not availalbe at the moment!
		</p>
	</div>
<?php }else if(!in_array($secondPerson,$ready)){?>
	
	<div class="col-lg-12" style="padding-top:100px; margin-top:15px; padding-bottom:220px">
		<p style="font-size:24px; font-family:'Segoe UI'; border:2px solid #CCCCCC; margin-top:10px; margin-bottom:10px;  background-color:#FFFFFF;
		text-align:center; font-weight:600; border-radius:0px; padding-top:50px; padding-bottom:50px">
			<a href="allConversation" rel="canonical" style="text-decoration:none">Visit Messenger and Select a Conversation</a>
		</p>
	</div>
	
<?php }
else
{	
$secondPersonNameQuery=mysqli_query($conn, "select firstName,lastName from signup where id=$secondPerson limit 1");
while($secondPersonNameResult=@mysqli_fetch_array($secondPersonNameQuery))
{
	$person2Fname=$secondPersonNameResult["firstName"];
	$person2Lname=$secondPersonNameResult["lastName"];
}

?>

<div class="container-fluid" >
	<div class="row" style="margin-top:50px; margin-bottom:50px">
		<div class="col-lg-3"></div>
		<div class="col-lg-6 col-xs-12" style=" height:auto; padding:10px;  border:1px solid #CCCCCC; background-color:#FFFFFF">
			<div class="col-lg-12 col-xs-12 single-sticky" style="background-color:#f0ede5; color:#00539c;
			font-size:20px; font-family:Helvetica; font-weight:600; padding:10px; z-index:1" >
				<div class="col-lg-1 col-xs-2" style="height:40px; width:40px; border-radius:50%;  background-color:#FFFFFF;  padding:0px">
				
					<?php
					$result=mysqli_query($conn, "select * from signup where id=$secondPerson AND makeMeHide='show' limit 1");
			
					while($imageArray=mysqli_fetch_array($result))
					{
						if($imageArray["publicProfile"]!="Private")
						{?>
						<img src="<?php echo $imageArray['uploadProfilePicture']; ?>"  style="border-radius:2px; height:100%; width:100%; border-radius:50%;" alt="View User Image">
						<?php }
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
				<div class="col-lg-11 col-xs-10" style="padding-left:6px; padding-top:5px;">
					<a target="_blank" href="viewprofile.php?viewProfileId=<?php echo $secondPerson;?>" style="text-decoration:none">
						<?php echo $person2Fname." ".$person2Lname;?>
					</a>
					<span style="color:#000000; font-size:9px; font-weight:normal;">Id:<?php echo $secondPerson?></span>
				</div>
			</div>
				<div class="col-lg-12 col-xs-12" style="height:auto; padding:10px; border:1px solid #F0F0F0; border-top:0px; background-color:#FFFFFF; z-index:0">
						
					<p id="showResponceText"></p>
					
					<div class="col-lg-12 col-xs-12" style="height:auto; padding:0px; margin-top:10px; background-color:#FFFFFF" >
						<form name="sendMessage" method="post" action="">
								<textarea style="resize:none; border-radius:1px; height:40px; color:#000000; font-size:15px" class="form-control" 
									placeholder="Type Message..." rows="1" id="messageText"></textarea>
								<span id="messageErrors" style="color:#FF0000; display:none"></span>
								<input type="button" class="btn btn-primary" value="Send"  onclick="sendMessageNow()" id="sendMessage"
								style="border-radius:2px; padding:10px; margin-top:3px; padding-left:25px; padding-right:25px; float:right"/>
						</form>
					</div>
								
								
								
					<script>
					
					window.onload = function() {
					  document.getElementById("messageText").focus();
					};
					
					$('#showResponceText').load('inc/pages/sendMessagePage.php');
					
					function sendMessageNow()
					{
						var messageText=document.getElementById("messageText").value;
						messageText=messageText.trim();
						var messageTextLen=messageText.length;
						
						document.getElementById("messageErrors").style.display="block";
						if(messageText ==""){document.getElementById("messageErrors").innerHTML="Type Something!";}
						else if(!/^[a-zA-Z0-9 ]*$/g.test(messageText))	{document.getElementById("messageErrors").innerHTML="only charcters(A to Z and 1 to 9) allowed";}
						else if(messageTextLen>1000){document.getElementById("messageErrors").innerHTML="Make Your Message Short!";}
						else
						{
							var xmlhttp = new XMLHttpRequest();
							xmlhttp.onreadystatechange = function() 
							{
								if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
								{
									document.getElementById("showResponceText").innerHTML=xmlhttp.responseText;
								}
							}
							xmlhttp.open('GET','inc/pages/sendMessagePage.php?fromID=<?php echo $firstPerson; ?>'+'&messageText='+messageText+'&toID=<?php echo $secondPerson; ?>', true);
							xmlhttp.send();
							document.getElementById("messageText").value="";
							document.getElementById("messageErrors").style.display="none";
						}
						
					}
				
					var input = document.getElementById("messageText");
					input.addEventListener("keyup", function(event) {
						event.preventDefault();
						if (event.keyCode === 13) {
							document.getElementById("sendMessage").click();
						}
					});
					
					
					
					
					function addmsg1(type, msg)	{	document.getElementById("showResponceText").innerHTML=msg;	}
					function waitForMsg1()
					{ 
						$.ajax
						({
							type: "GET",
							url: "inc/pages/sendMessagePage.php",
							async: true,
							cache: false,
							timeout:10000,
							 
					success: function(data){	addmsg1("new", data);	setTimeout( waitForMsg1,10000 );	},
			        error: function(	XMLHttpRequest, textStatus, errorThrown){addmsg1("error", textStatus + " (" + errorThrown + ")");	setTimeout(	waitForMsg1,10000	);	}
						});
					}
					$(document).ready(function(){ waitForMsg1();	});
					 
					
					
					
					</script>


					
				</div>
			</div>
		<div class="col-lg-3"></div>
	</div>
</div>

<?php }?>
<br /><br /><br /><br />


<?php include('inc/pages/footer.php');?>


</body>
</html>




