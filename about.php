<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
require 'inc/connection/connect.php';
$firstPerson=@$_SESSION["firstPersonId"];
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>About Us - Rishtaweb</title>
	<meta name="description" content="Find rishta in your clan, caste, religion, country or within your city. Rishtaweb is free online matrimonial web based portal which facilitates the people to find out their life partner.">
	<meta name="keywords" content="Online female rishta in pakistan, online male rishta in pakistan, online girl rishta in pakistan, online boys rishta in pakistan, free rishta site in pakistan.">
  <?php include('inc/pages/links-one.php');?>
</head>
<body style="background-color:#F2F2F2">

<?php if (!isset($_SESSION["firstPersonId"])){?>
<?php include('inc/pages/navbar-index.php');?>

<?php } else{?>
	<!-- login-navbar -->
	<?php include('inc/pages/navbar-login.php');?>
<?php }?>



<div class="container" style="margin-top:30px">
	<div class="row">
		<div class="col-lg-12 col-xs-12" style="padding:0px">
			<div class="col-lg-12 col-xs-12" style="padding-top:12px; padding-bottom:40px; background-color:#FFFFFF; border-left:15px solid #eadedb; 
			border-right:15px solid #eadedb; border-radius:10px;  margin-bottom:100px; margin-top:70px">
				<div class="col-lg-1 col-xs-12"></div>
				<div class="col-lg-10 col-xs-12">
				<ul class="list-group">
					<li style="list-style-type:none; margin-left:-15px; color:#333333; font-family:'Segoe UI'">
					<h1>How Rishtaweb portal works</h1>
						RISHTAWEB is an online rishta portal which is developed and designed specially for the people living in pakistan to find out life partner 
						for your siblings, childerns, friends or for yourself. The main objective of this matrimonial portal is to help the people in finding the 
						suitable rishta within the range of their family status, city, caste/clan & religion. The portal offers several benefits to its members,
						primary being the pleasure of searching for a life partner within one's own community from across the globe at the click of a mouse. <br>
						RISHTAWEB is powered by innovative tools and cutting-edge technologies to provide the best search experience for its users.
						<br /><br />
						If you are new to this site, then <a href="CompleteSignUp.php">create rishtaweb account</a>, go for search and send message to one who you think,
						may change your life with pleasure and happiness. If you already have rishtaweb account, then just <a href="login.php">login here</a> and contact
						with people.
						If you are pakistani citizen, then <a href="check-category/country/find-rishta-in-pakistan">view all rishta profiles in pakistan.</a>
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
