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
<div class="container-fluid" style=" padding:0px; padding-bottom:10px; position:fixed; overflow:hidden; width:100%; z-index:1; top:0">
	<div class="col-lg-12" style="box-shadow:0px 0px 10px gray; background-color:#A00000; color:#FFFFFF;">
		<div id="logoTextMargin">
			<a href="/" style="text-decoration:none;">
				<span id="logoText1">RISHTA<span id="logoText2">WEB</span></span>
			</a>
		</div>
	</div>
</div>
<br /><br />
<h1 style="display:none">Contact Us</h1>

<?php } else{?>


<!-- login-navbar -->
<?php include('inc/pages/navbar-login.php');?>

<?php }?>


<div class="container" style="margin-top:30px">
	<div class="row">
		<div class="col-lg-12" style="padding:0px">
			<div class="col-lg-12" style="padding-top:12px; padding-bottom:80px; background-color:#FFFFFF; border-left:15px solid #98ddde; 
			border-right:15px solid #98ddde; border-radius:12px;  margin-bottom:100px; margin-top:15px">
				<div class="col-lg-1"></div>
				<div class="col-lg-10" style="padding:0px;">
				
				<p style="font-size:24px; font-family:'Calibri Light'; font-weight:bolder; text-decoration:underline">Terms & Conditions</p>
				<ul>
					<li style="list-style-type:none; margin-left:-15px; color:#333333; font:'Calibri Light'">
						Wellcome to RISHTAWEB.com<br>Dear Member, Please read the Terms of Service carefully before you start to use the Site. 
						The following terms and conditions, govern your access to and use of this website. We may change these terms and conditions 
						at any time, so please be updated by the 'Terms & Conditions' of this site from time to time to stay abreast of any changes 
						that we may introduce.<br /><br />
						This Agreement is an electronic contract that establishes the legally binding terms you must accept to use the Site and to become a "Member."
						This Agreement will be effective, valid and subsisting as long as you use our Site.
						By using the Site, you agree to be bound by these Terms of Use ("Agreement").<br />
						To withdraw this consent, you must discontinue using our Service and delete your account.

					</li>
				</ul>
				<ul style="font-family:'Calibri Light'; color:#333333; margin-top:15px">
					<li>
						You can use all RISHTAWEB.com services only if you are a member of this site.
					</li>
					<li>
						Your minimum age must be 18(for female) or 21(for male).
					</li>
					<li>
						Multiple profiles of the same person are not allowed on this site.
					</li>
					<li>
						You confirm that you are here only to find the ritha not a "girl-friend" or for dating purposes.
					</li>
					<li>
						You are responsible for maintaining the confidentiality of your login credentials.
					</li>
					<li>
						You agree that use of the RISHTAWEB.com services is at the Member's sole risk.
					</li>
					<li>
						You confirm that as on date of this registration, you do not have any objection to receive emails, messages and calls from RISHTAWEB.com.
					</li>
					<li>
						You confirm that the information provided by you is correct and accurate.
					</li>
					<li>
						RISHTAWEB.com reserves the right to take appropriate steps to protect RISHTAWEB.com and/or its Members from any abuse/misuse as it deems 
						appropriate in its sole discretion.
					</li>
					<li>
						RISHTAWEB.com has authority to share your provided information with other media platforms to help you out in findind rishta.
					</li>
					<li>
						You cannot post, distribute, or reproduce in any way any copyrighted material, photo, trademarks, or other proprietary information without 
						the permission of RISHTAWEB's owner.
					</li>
					<li>
						Under no circumstances will RISHTAWEB.com be responsible for any loss or damage resulting from anyone's use of the Site or the 
						Service and/or any Content posted on the RISHTAWEB.com Site or transmitted to RISHTAWEB.com Members.
					</li>
					<li>
						This website may be temporarily unavalable from time to time due to required maintenance.
					</li>
					<li>
						RISHTAWEB.com does not assume any responsibility or liability for any illegal Content posted on the Site by any Members, users or any third party.
					</li>
					<li>
						RISHTAWEB.com is not responsible for any error in operation.
					</li>
					<li>
						RISHTAWEB.com has authority review or suspend any account at any time without any reason.
					</li>
					<li>
						Illegal & prohibitive Content: Content that promotes racism, bigotry, hatred, harasses, threatening, obscene, defamatory, pornographic,
						libelous or physical harm.
					</li>
					<li>
						Please read and comprehend our Privacy Policy, which also governs your visit to RISHTAWEB.com, to understand our practices. 
					</li>
					<li>
						By using this Site, you warrant that you have the right to enter into this Agreement; submit relevant information to us; and that you are not prohibited any
						applicable law for the time being in force from any court or any such competent authority restraining you from entering into matrimony.

					</li>
					<li>
						If there is any dispute about or involving the Site and/or the Service, by using the Site, you unconditionally agree that all such 
						disputes and/or differences will be governed by the laws of India and shall be subject to the exclusive jurisdiction of the Competent 
						Courts in Islamabad, Pakistan only.

					</li>
					<li>
						RISHTAWEB.com reserves the right to change this Agreement at any time
					</li>
					<li>
						The terms of this contract are exclusively based on and subject to law. You hereby consent to the exclusive jurisdiction and venue of 
						courts will be decided in all disputes arising out of or relating to the use of this website. Use of this website is unauthorised in any 
						jurisdiction that does not give effect to all provisions of these terms and conditions, including without limitation this paragraph.


					</li>
					<li>
						If still you want to ask something about this website, just <a href="contact.php">contact us</a>, we will respond as soon as possible. 
					</li>
					<p style="border-top:1px solid #CCCCCC; margin-top:35px; text-align:center">...</p>
				</ul>	
				<p style="font-size:24px; font-family:'Calibri Light'; font-weight:bolder; text-decoration:underline">Disclaimers</p>
				<ul>
					<li>
						RISHTAWEB.com is not responsible for any lose or damage for any anyone who use this site.
					</li>
					<li>
						All liability including civil or criminal arising out of this Site will be of that Member who posted the profile.
					</li>
					<li>
						RISHTAWEB.com is not resposible for incorrect or false information.
					</li>
					<li>
						 RISHTAWEB.com assumes no responsibility for any error, omission, interruption, deletion, defect, delay in operation or transmission, communications
						 line failure, theft or destruction or unauthorized access to, or alteration of, User and/or Member communications or any communications 
						 by RISHTAWEB.com to its Members.
					</li>
					<li>
						RISHTAWEB.com does not assume any responsibility or liability for any illegal Content posted on the Site by any Members, users or any third party. 
					</li>
					<li>
						Under no circumstances will RISHTAWEB.com be responsible for any loss or damage resulting from anyone's use of the Site or the Service 
						and/or any Content posted on the RISHTAWEB.com Site or transmitted to RISHTAWEB.com Members.
					</li>
					<li>
						RISHTAWEB.com does not have any obligation to verify the identity of the persons subscribing to its services, nor does it have 
						any obligation to monitor the use of its services by other users of the community; therefore, RISHTAWEB.com disclaims all 
						liability for identity theft or any other misuse of your identity or information.
					</li>
					<li>
						RISHTAWEB.com disclaims all liability for any malfunctioning, impossibility of access, or poor use conditions of the RISHTAWEB.com 
						site due to inappropriate equipment, disturbances related to internet service providers, to the saturation of the internet network, 
						and for any other reason.
					</li>
					<li>
						This website may be temporarily unavailable from time to time due to required maintenance, telecommunications interruptions, or other 
						disruptions. RISHTAWEB.com (and its owners, suppliers, consultants, advertisers, affiliates, partners, employees or any other 
						associated entities, all collectively referred to as associated entities hereafter) shall not be liable to user or member or any third 
						party should RISHTAWEB.com exercise its right to modify or discontinue any or all of the contents, information, software, products, 
						features and services published on this website.
					</li>
					<li>
						In no event shall RISHTAWEB.com and/or its associated entities be liable for any direct, indirect, punitive, incidental, 
						special or consequential damages arising out of or in any way connected with the use of this website or with the delay or inability to
						 use this website, or for any contents, information, software, products, features and services obtained through this website, or otherwise  
						 arising out of the use of this website, whether based on contract, tort, strict liability or otherwise, even if RISHTAWEB.com or
						 any of its associated entities has been advised of the possibility of damages.
					</li>
					<hr />
					
				</ul>
				<p style="font-size:24px; font-family:'Calibri Light'; font-weight:bolder; text-decoration:underline">Laws</p>
				<ul>
					<li>
						The terms of this contract are exclusively based on and subject to law. You hereby consent to the exclusive jurisdiction and venue 
						of courts will be decided in all disputes arising out of or relating to the use of this website. Use of this website is unauthorised 
						in any jurisdiction that does not give effect to all provisions of these terms and conditions, including without limitation this paragraph.
					</li><hr />
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
