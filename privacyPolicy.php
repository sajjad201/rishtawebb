<?php
session_start();
require 'inc/connection/connect.php';
$firstPerson=@$_SESSION["firstPersonId"];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include('inc/pages/links-one.php');?>
</head>

<body style="background-color:#F2F2F2">

<?php if (!isset($_SESSION["firstPersonId"])){?>
<div class="container-fluid" style=" padding:0px; padding-bottom:10px; position:fixed; overflow:hidden; width:100%; z-index:1; top:0;">
	<div class="col-lg-12" style="box-shadow:0px 0px 10px gray; background-color:#A00000; color:#FFFFFF; ">
		<div id="logoTextMargin">
			<a href="/" style="text-decoration:none;">
				<span id="logoText1">RISHTA<span id="logoText2">WEB</span></span>
			</a>
		</div>
	</div>
</div>
<h1 style="display:none">Contact Us</h1>
<br /><br />

<?php } else{?>

<!-- login-navbar -->
<?php include('inc/pages/navbar-login.php');?>

<?php }?>


<div class="container" style="margin-top:20px">
	<div class="row">
		<div class="col-lg-12 col-xs-12" style="padding:0px">
			<div class="col-lg-12 col-xs-12" style="padding-top:12px; padding-bottom:80px; background-color:#FFFFFF; border-left:15px solid #616247; 
			border-right:15px solid #616247; border-radius:12px;  margin-bottom:100px; margin-top:20px">
				<div class="col-lg-1"></div>
				<div class="col-lg-10" style="padding:0px;">
				
				<p style="font-size:24px; font-family:'Calibri Light'; font-weight:bolder; text-decoration:underline">Privacy Policy of RISHTAWEB</p>
				<ul>
					<li style="list-style-type:none; margin-left:-15px; color:#333333; font:'Calibri Light'">
						RISHTAWEB.com is fully committed towards protecting your privacy.
						As we are committed to your right to privacy, so we drawn out our privacy policy, read it carefully before using the services of this site.
						In order to provide the services, we ask for certain personal information which is displayed on the site on behalf of you.
					</li>
				</ul>
				<ul style="font-size:14px; font-family:'Calibri Light'; color:#666666; margin-top:-5px">
					<li>
						RISHTAWEB is specially designed and developed for people living in pakistan to help them out to search rishta online.
					</li>
					<li>
						All services(signup, send marriage proposals and messages) on this portal are totally free.
					</li>
					<li>
						RISHTAWEB ensures privacy of individual member who visits or create an account on this matrimonial portal. 
					</li>
					<li>
						This portal collects all information regarding personal life, career and basic information with your aggrement. 
					</li>
					<li>
						This portal uses strong algorithams that ensure security for your privacy.
					</li>
					<li>
						You have the authority to create/not-create account, update provided information or delete account at any instance.
					</li>
					<li>
						Our website uses cookies to help you with best experience we can.
					</li>
					<li>
						We may collect information not only from account creation process but also from client's location address, type of devices used to visit this portal.
					</li>
					<li>
						We and our third-party partners, uses cookies and web beacons etc, to identify you and your user behaviour.
					</li>
					<li>
						We collects this information for data analysis, identifying usage trends to evaluate and improve our websites and services.
					</li>
					<li>
						We may share such identifiable informationwith our associates/affiliates and such associates/affiliates may market to you as a result of such sharing. 
					</li>
					<li>
						Sensitive information(like phone number, email address and location) will not be shared with any third party for any reason. 
					</li>
					<li>
						We keep your personal information only as long as you use our service and also as permitted/required by applicable law.
					</li>
					<li>
						We assume information provided by you is correct and accurate.
					</li>
					<li>
						RISHTAWEB Team will scan your application for account creation, if find any suspicious activity by you, you will be banned permanetly.
					</li>
					<li>
						We may suspend your account at any time without informing you.
					</li>
					<li>
						We may update our privacy policy with time so in order to get updated, visit this page regularly.
					</li>
					<li>
						If you are not aggree with these policies, please dont use this site for any purpose.
					</li>
					<li>
						RISHTAWEB.com respect your personal data and confidential information. However, 
						in any case, if your data is leaked due to any intervention, you agree to hold us blameless.
					</li>
					<li>
						For any query, <a rel="canonical" href="contact.php">contact us</a>.
					</li>
					
					<p style="border-top:1px solid #CCCCCC; margin-top:35px; text-align:center">...</p>
				</ul>
					
				</div>
				<div class="col-lg-1"></div>
			</div>
		</div>
	</div>
</div>

<?php include('inc/pages/footer.php');?>

</body>
</html>
