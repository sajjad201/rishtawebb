<?php
session_start();
require 'inc/connection/connect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('inc/pages/links-one.php');?>

</head>
<body id="body">
    
<!-- navbar -->
<?php 
    if(isset($_SESSION["firstPersonId"])) {
        include('inc/pages/navbar-login.php');          // login navbar
    }
    else{
        include('inc/pages/navbar-index.php');         // guest navbar
    }
?>

<!-- body -->
<section class="vg">
    <div class="container-fluid vg-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="vg-pro">
                    <div class="vg-head">
                        Pashtun/Pakhtoon Female Intermediate/A-Level Rishta In Lahore Pakistan (NS5863270)
                    </div>
                    <div class="row vg-bottom">
                        <div class="col-md-3 vg-bottom-3">
                            <div class="vg-bottom-img">
                                <img class="vg-bottom-image" src="images/1451.jpg" alt="">
                            </div>
                            <div class="vg-bottom-con">
                                <div class="vg-bottom-img-id">
                                    <div class="vg-bottom-img-id-font1">Profile Id: 1500</div>
                                    <div class="vg-bottom-img-id-font2">Sajjad Ali</div>
                                </div>
                                <button class="button button-ripple vg-bottom-img-id-btn">
                                    <span class="button-text-white">
                                        Contact
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-5 col-xs-6">
                            <div class="vg-bottom-5">
                                <div class="vg-bottom-5-icon">
                                    <i class="fas fa-map-marker-alt vg-bottom-5-icon-style"></i>
                                </div>
                                <div class="vg-bottom-5-text">
                                    Pakistan
                                </div>
                            </div>
                            <div class="vg-bottom-5">
                                <div class="vg-bottom-5-icon">
                                    <i class="fas fa-user-clock vg-bottom-5-icon-style"></i>
                                </div>
                                <div class="vg-bottom-5-text">
                                    25 year
                                </div>
                            </div>
                            <div class="vg-bottom-5">
                                <div class="vg-bottom-5-icon">
                                <i class="fas fa-male vg-bottom-5-icon-style"></i>
                                </div>
                                <div class="vg-bottom-5-text">
                                    Male
                                </div>
                            </div>
                            <div class="vg-bottom-5">
                                <div class="vg-bottom-5-icon">
                                    <i class="fab fa-delicious vg-bottom-5-icon-style"></i>
                                </div>
                                <div class="vg-bottom-5-text">
                                    Arian
                                </div>
                            </div>
                            <div class="vg-bottom-5">
                                <div class="vg-bottom-5-icon">
                                    <i class="fas fa-user-graduate vg-bottom-5-icon-style"></i>
                                </div>
                                <div class="vg-bottom-5-text">
                                    Intermediate
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-6">
                            <div class="vg-bottom-5">
                                <div class="vg-bottom-5-icon">
                                    <i class="fas fa-mosque vg-bottom-5-icon-style"></i>
                                </div>
                                <div class="vg-bottom-5-text">
                                    Muslim
                                </div>
                            </div>
                            <div class="vg-bottom-5">
                                <div class="vg-bottom-5-icon">
                                    <i class="fas fa-user-circle vg-bottom-5-icon-style"></i>
                                </div>
                                <div class="vg-bottom-5-text">
                                    Married
                                </div>
                            </div>
                            <div class="vg-bottom-5">
                                <div class="vg-bottom-5-icon">
                                    <i class="far fa-user vg-bottom-5-icon-style"></i>
                                </div>
                                <div class="vg-bottom-5-text">
                                    Language
                                </div>
                            </div>
                            <div class="vg-bottom-5">
                                <div class="vg-bottom-5-icon">
                                    <i class="fas fa-user-edit vg-bottom-5-icon-style"></i>
                                </div>
                                <div class="vg-bottom-5-text">
                                    Created By:Father
                                </div>
                            </div>
                            <div class="vg-bottom-5">
                                <div class="vg-bottom-5-icon">
                                    <i class="fas fa-chalkboard-teacher vg-bottom-5-icon-style"></i>
                                </div>
                                <div class="vg-bottom-5-text">
                                    Teacher
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="vg-bottom-details">
                    <div class="vg-bottom-details-icon">
                    <div class="vg-bottom-details-icon-style">
                        <i class="fas fa-quote-left" style=" margin-right:5px; color:#FFFFFF; font-size:10px"></i>								
                    </div>
                    </div>
                    <div class="vg-bottom-details-text">
                        <div class="vg-bottom-details-text-head">
                            Basic Detail
                        </div>
                        <div class="vg-bottom-details-text-bot">
                            <div class="vg-bottom-details-text-bot-one">
                                Name
                            </div>
                            <div class="vg-bottom-details-text-bot-two">
                                Sajjad ALi
                            </div>
                        </div>
                    </div>
                </div>
                <div class="vg-bottom-details">
                    <div class="vg-bottom-details-icon">
                    <div class="vg-bottom-details-icon-style-two">
						<i class="far fa-user" style="margin-right:5px; color:#FFFFFF; font-size:14px"></i>	
                    </div>
                    </div>
                    <div class="vg-bottom-details-text">
                        <div class="vg-bottom-details-text-head">
                            Life Style and personality
                        </div>
                        <div class="vg-bottom-details-text-bot">
                            <div class="vg-bottom-details-text-bot-one">
                                Caste
                            </div>
                            <div class="vg-bottom-details-text-bot-two">
                                Sajjad ALi
                            </div>
                        </div>
                        <div class="vg-bottom-details-text-bot">
                            <div class="vg-bottom-details-text-bot-one">
                                Clan
                            </div>
                            <div class="vg-bottom-details-text-bot-two">
                                Sajjad ALi
                            </div>
                        </div>
                        <div class="vg-bottom-details-text-bot">
                            <div class="vg-bottom-details-text-bot-one">
                                Marital Status
                            </div>
                            <div class="vg-bottom-details-text-bot-two">
                                Sajjad ALi
                            </div>
                        </div>
                        <div class="vg-bottom-details-text-bot">
                            <div class="vg-bottom-details-text-bot-one">
                                Language
                            </div>
                            <div class="vg-bottom-details-text-bot-two">
                                Sajjad ALi
                            </div>
                        </div>
                        <div class="vg-bottom-details-text-bot">
                            <div class="vg-bottom-details-text-bot-one">
                                Religion
                            </div>
                            <div class="vg-bottom-details-text-bot-two">
                                Sajjad ALi
                            </div>
                        </div>
                        <div class="vg-bottom-details-text-bot">
                            <div class="vg-bottom-details-text-bot-one">
                                Disability
                            </div>
                            <div class="vg-bottom-details-text-bot-two">
                                Sajjad ALi
                            </div>
                        </div>
                        <div class="vg-bottom-details-text-bot">
                            <div class="vg-bottom-details-text-bot-one">
                                Skin Tone
                            </div>
                            <div class="vg-bottom-details-text-bot-two">
                                Sajjad ALi
                            </div>
                        </div>
                    </div>
                </div>
                <div class="vg-bottom-details">
                    <div class="vg-bottom-details-icon">
                    <div class="vg-bottom-details-icon-style-three">
					    <i class="fas fa-users" style=" margin-right:5px; color:#FFFFFF; font-size:14px"></i>
                    </div>
                    </div>
                    <div class="vg-bottom-details-text">
                        <div class="vg-bottom-details-text-head">
                            Basic Detail
                        </div>
                        <div class="vg-bottom-details-text-bot">
                            <div class="vg-bottom-details-text-bot-one">
                                Family Type
                            </div>
                            <div class="vg-bottom-details-text-bot-two">
                                Sajjad ALi
                            </div>
                        </div>
                        <div class="vg-bottom-details-text-bot">
                            <div class="vg-bottom-details-text-bot-one">
                                Family Values
                            </div>
                            <div class="vg-bottom-details-text-bot-two">
                                Sajjad ALi
                            </div>
                        </div>
                        <div class="vg-bottom-details-text-bot">
                            <div class="vg-bottom-details-text-bot-one">
                                Family Affluences
                            </div>
                            <div class="vg-bottom-details-text-bot-two">
                                Sajjad ALi
                            </div>
                        </div>
                        <div class="vg-bottom-details-text-bot">
                            <div class="vg-bottom-details-text-bot-one">
                                Father's Status
                            </div>
                            <div class="vg-bottom-details-text-bot-two">
                                Sajjad ALi
                            </div>
                        </div>
                        <div class="vg-bottom-details-text-bot">
                            <div class="vg-bottom-details-text-bot-one">
                                Mother's Status
                            </div>
                            <div class="vg-bottom-details-text-bot-two">
                                Sajjad ALi
                            </div>
                        </div>
                        <div class="vg-bottom-details-text-bot">
                            <div class="vg-bottom-details-text-bot-one">
                                No of Brothers
                            </div>
                            <div class="vg-bottom-details-text-bot-two">
                                Sajjad ALi
                            </div>
                        </div>
                        <div class="vg-bottom-details-text-bot">
                            <div class="vg-bottom-details-text-bot-one">
                                No of Sisters
                            </div>
                            <div class="vg-bottom-details-text-bot-two">
                                Sajjad ALi
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>
                            
<!-- footer -->
<?php include('inc/pages/footer.php');?>

</body>
</html>