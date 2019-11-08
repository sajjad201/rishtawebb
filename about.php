<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
require 'inc/connection/connect.php';
$firstPerson=@$_SESSION["firstPersonId"];
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php include('inc/pages/links-one.php');?>
</head>
<body style="background-color:#F2F2F2">
<h1 style="display:none">Contact Us</h1>

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
<br /><br />

<?php } else{?>
	<!-- login-navbar -->
	<?php include('inc/pages/navbar-login.php');?>
<?php }?>



<div class="container" style="margin-top:30px">
	<div class="row">
		<div class="col-lg-12 col-xs-12" style="padding:0px">
			<div class="col-lg-12 col-xs-12" style="padding-top:12px; padding-bottom:40px; background-color:#FFFFFF; border-left:15px solid #eadedb; 
			border-right:15px solid #eadedb; border-radius:10px;  margin-bottom:100px; margin-top:20px">
				<div class="col-lg-1 col-xs-12"></div>
				<div class="col-lg-10 col-xs-12">
				
				<p style="font-size:24px; font-family:'Calibri Light'; font-weight:bolder; text-decoration:underline">About Us</p>
				<ul class="list-group">
					<li style="list-style-type:none; margin-left:-15px; color:#333333; font-family:'Segoe UI'">
						RISHTAWEB is an online rishta portal which is developed and designed specially for the people living in pakistan to find out life partner 
						for your siblings, childerns, friends or for yourself. The main objective of this site is to help out the people in finding the 
						suitable rishta within the range of their family status, city, clan & religion. The portal offers several benefits to its members,
						 primary being the pleasure of searching for a life partner within one's own community from across the globe at the click of a mouse. 
						 RISHTAWEB.com is powered by innovative tools and cutting-edge technologies to provide the best search experience for its users.
						 <br />
						If you want to ask something about team-rishtaweb or this website, just <a rel="nofollow" href="contact.php">contact us</a>, 
						we will respond as soon as possible.  
					</li>
					<p style="border-top:1px solid #CCCCCC; margin-top:35px; text-align:center">...</p>
				</ul>
				</div>
				<div class="col-lg-1 col-xs-12"></div>
			</div>
		</div>
	</div>
</div>


<?php include('inc/pages/footer.php');?>

</body>
</html>
