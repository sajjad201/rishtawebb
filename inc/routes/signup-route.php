<?php
session_start();
require '../connection/connect.php';

if(isset($_SESSION["firstPersonId"]))
{
  header("Location: ../../searchProfiles.php");
}




$firstNameErr = $lastNameErr = $genderErr = $emailErr = $passwordErr = $mobileErr = $countryErr = $provinceErr = $districtErr = "";
$cityErr = $dateOfBirthErr = $languageErr = $educationErr = $professionErr = $salaryErr = $maritalStatusErr = $clanErr = $casteErr = "";
$religionErr = $heightErr = $complexionErr = $bodyTypeErr = $hobbyErr = $disabilityErr = "";
$fatherStatusErr = $motherStatusErr = $noOfBrothersErr = $noOfSistersErr = $familyTypeErr = $familyValuesErr = $familyAffluenceErr = "";
$partnerMaritalStatusErr = $partnerAgeErr = $partnerHeightErr = $partnerReligionErr = $partnerLanguageErr	= $partnerEducationErr = $partnerComplexionErr = "";
$partnerClanErr = $partnerFamilyAffluenceErr = $partnerLocationErr = $partnerAboutErr = "";	
$explainYourSelfErr = $allErrorsOfPhp = $imageIssues = "";

$errorList=array(); 

$errorList["firstNameErr"] = $errorList["lastNameErr"] = $errorList["genderErr"] = $errorList["emailErr"] = $errorList["passwordErr"]  = "";
$errorList["mobileErr"] = $errorList["profileCreatedByErr"] =  $errorList["countryErr"] = $errorList["provinceErr"] = $errorList["districtErr"] = "";
$errorList["cityErr"] = $errorList["dateOfBirthErr"] = $errorList["languageErr"] = $errorList["educationErr"] = $errorList["professionErr"] = $errorList["salaryErr"] = "";$errorList["casteErr"] = $errorList["religionErr"] = $errorList["maritalStatusErr"] = $errorList["clanErr"] = $errorList["heightErr"] = "";
$errorList["complexionErr"] = $errorList["bodyTypeErr"] = $errorList["hobbyErr"] = $errorList["disabilityErr"] = "";
$errorList["fatherStatusErr"] = $errorList["motherStatusErr"] = $errorList["noOfBrothersErr"] = $errorList["noOfSistersErr"] = "";
$errorList["familyTypeErr"] = $errorList["familyValuesErr"]	= $errorList["familyAffluenceErr"] = "";	
$errorList["partnerMaritalStatusErr"]	= $errorList["partnerAgeErr"] = $errorList["partnerHeightErr"] = $errorList["partnerReligionErr"] = $errorList["partnerLanguageErr"] = "";		
$errorList["partnerEducationErr"] = $errorList["partnerComplexionErr"] = $errorList["partnerClanErr"]= $errorList["partnerFamilyAffluenceErr"] = "";
$errorList["partnerLocationErr"] = $errorList["partnerAboutErr"] = 	"";	
$errorList["explainYourSelfErr"] = $errorList["uploadProfilePictureErr"] = "";

$errorOccurred=false;


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
		return $data;
	}
	
	
	if(empty($_POST['firstName']))
	{
		$errorList["firstNameErr"]="please enter your first name php";
		$_SESSION['signup-firstname-error']=$errorList["firstNameErr"];
		$errorOccurred=true;
	}
	else
	{
		$firstName=test_input($_POST['firstName']);
		$firstName=ucfirst($firstName);
		if(!preg_match("/^[a-zA-Z0-9.,& ]*$/",$firstName))
		{
			$errorList["firstNameErr"]="only letters are allowed";
			$_SESSION['signup-firstname-error']=$errorList["firstNameErr"];
			$errorOccurred=true;
		}
	}
	
	if(empty($_POST['lastName']))
	{
		$errorList["lastNameErr"]="please enter your last name php";
		$_SESSION['signup-lastname-error']=$errorList["lastNameErr"];
		$errorOccurred=true;
	}
	else
	{
		$lastName=test_input($_POST['lastName']);
		$lastName=ucfirst($lastName);
		if(!preg_match("/^[a-zA-Z0-9.,& ]*$/",$lastName))
		{
			$errorList["lastNameErr"]="only letters are allowed";
			$_SESSION['signup-lastname-error']=$errorList["lastNameErr"];
			$errorOccurred=true;
		}
	}
	
	if(empty($_POST['gender']))
	{
		$errorList["genderErr"]="please select gender";
		$_SESSION['signup-gender-error']=$errorList["genderErr"];
		$errorOccurred=true;
	}
	else
	{
		$gender=test_input($_POST['gender']);
	}
	
	if(empty($_POST['email']))
	{
		$errorList["emailErr"]="please enter email address";
		$_SESSION['signup-email-error']=$errorList["emailErr"];
		$errorOccurred=true;
	}
	else
	{
		$email=test_input($_POST['email']);
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$errorList["emailErr"]="invalid email format";
			$_SESSION['signup-email-error']=$errorList["emailErr"];
			$errorOccurred=true;
		}
	}
	
	if(empty($_POST['password']))
	{	
		$errorList["passwordErr"]="Enter Password";
		$_SESSION['signup-password-error']=$errorList["passwordErr"];
		$errorOccurred=true;
	}
	else
	{
		$password=test_input($_POST['password']);
		if(strlen($_POST["password"]) < 8)
		{
			$errorList["passwordErr"]="your password is too small(min 8 char require)";
			$_SESSION['signup-password-error']=$errorList["passwordErr"];
			$errorOccurred=true;
		}
	}
	
	
	if(empty($_POST['mobile']))
	{	
		$errorList["mobileErr"]="please enter mobile number";
		$_SESSION['signup-mobile-error']=$errorList["mobileErr"];
		$errorOccurred=true;
	}
	else
	{
		$mobile=test_input($_POST['mobile']);
		if(!preg_match("/^[0-9., ]*$/",$mobile))
		{
			$errorList["mobileErr"]="only numbers are allowed";
			$_SESSION['signup-mobile-error']=$errorList["mobileErr"];
			$errorOccurred=true;
		}
	}
	
	if(empty($_POST['profileCreatedBy']))
	{
		$errorList["profileCreatedByErr"]="please select your disability ";
		$_SESSION['signup-profilecreatedby-error']=$errorList["profileCreatedByErr"];
		$errorOccurred=true;
	}
	else
	{	
		$profileCreatedBy=test_input($_POST['profileCreatedBy']);
	}
	
	if(empty($_POST['country']))
	{
		$errorList["countryErr"]="please select your country ";
		$_SESSION['signup-country-error']=$errorList["countryErr"];
		$errorOccurred=true;
	}
	else
	{	
		$country=test_input($_POST['country']);
		if($_POST["country"] == "Pakistan")
		{
			if(empty($_POST['province']))
			{
				$errorList["provinceErr"]="please select your province ";
				$_SESSION['signup-province-error']=$errorList["provinceErr"];
				$errorOccurred=true;
			}
			else
			{	
				$province=test_input($_POST['province']);
			}
			
			if(empty($_POST['district']))
			{
				$errorList["districtErr"]="please select your district";
				$_SESSION['signup-district-error']=$errorList["districtErr"];
				$errorOccurred=true;
			}
			else
			{	
				$district=test_input($_POST['district']);
			}
			
			if(empty($_POST['city']))
			{
				$errorList["cityErr"]="please select your city ";
				$_SESSION['signup-city-error']=$errorList["cityErr"];
				$errorOccurred=true;
			}
			else
			{	
				$city=test_input($_POST['city']);
			}
	
		}
		else
		{
			$province = $district = $city ="";
		}
	}
	
	
	if(empty($_POST['day']))
	{
		$errorList["dateOfBirthErr"]="please select your dateOfBirth php";
		$_SESSION['signup-dob-error']=$errorList["dateOfBirthErr"];
		$errorOccurred=true;
	}
	else
	{	
		$day=test_input($_POST['day']);
	}
	
	if(empty($_POST['month']))
	{
		$errorList["dateOfBirthErr"]="please select your dateOfBirth php";
		$_SESSION['signup-day-error']=$errorList["dateOfBirthErr"];
		$errorOccurred=true;
	}
	else
	{	
		$month=test_input($_POST['month']);
	}
	
	if(empty($_POST['year']))
	{
		$errorList["dateOfBirthErr"]="please select your Date Of Birth php";
		$_SESSION['signup-year-error']=$errorList["dateOfBirthErr"];
		$errorOccurred=true;
	}
	else
	{	
		$year=test_input($_POST['year']);
		$dob=$year."-".$month."-".$day;
	}
	if(empty($_POST['language']))
	{
		$errorList["languageErr"]="please select your language ";
		$_SESSION['signup-language-error']=$errorList["languageErr"];
		$errorOccurred=true;
	}
	else
	{	
		$language=test_input($_POST['language']);
	}
	
	if(empty($_POST['education']))
	{
		$errorList["educationErr"]="please select your education ";
		$_SESSION['signup-education-error']=$errorList["educationErr"];
		$errorOccurred=true;
	}
	else
	{	
		$education=test_input($_POST['education']);
	}
	
	if(empty($_POST['profession']))
	{
		$errorList["professionErr"]="please select your profession ";
		$_SESSION['signup-profession-error']=$errorList["professionErr"];
		$errorOccurred=true;
	}
	else
	{	
		$profession=test_input($_POST['profession']);
	}
	
	if(empty($_POST['salary']))
	{
		$errorList["salaryErr"]="please select your salary ";
		$_SESSION['signup-salary-error']=$errorList["salaryErr"];
		$errorOccurred=true;
	}
	else
	{	
		$salary=test_input($_POST['salary']);
	}
	
	if(empty($_POST['maritalStatus']))
	{
		$errorList["maritalStatusErr"]="please select your marital status ";
		$_SESSION['signup-maritalstatus-error']=$errorList["maritalStatusErr"];
		$errorOccurred=true;
	}
	else
	{	
		$maritalStatus=test_input($_POST['maritalStatus']);
	}
	
	if(empty($_POST['clan']))
	{
		$errorList["clanErr"]="please select your clan ";
		$_SESSION['signup-clan-error']=$errorList["clanErr"];
		$errorOccurred=true;
	}
	else
	{	
		$clan=test_input($_POST['clan']);
	}
	if(empty($_POST['caste']))
	{
		$errorList["casteErr"]="please select your caste ";
		$_SESSION['signup-caste-error']=$errorList["casteErr"];
		$errorOccurred=true;
	}
	else
	{	
		$caste=test_input($_POST['caste']);
	}
	if(empty($_POST['religion']))
	{
		$errorList["religionErr"]="please select your religion ";
		$_SESSION['signup-religion-error']=$errorList["religionErr"];
		$errorOccurred=true;
	}
	else
	{	
		$religion=test_input($_POST['religion']);
	}
	
	if(empty($_POST['height']))
	{
		$errorList["heightErr"]="please select your height ";
		$_SESSION['signup-height-error']=$errorList["heightErr"];
		$errorOccurred=true;
	}
	else
	{	
		$height=test_input($_POST['height']);
	}
	
	if(empty($_POST['complexion']))
	{
		$errorList["complexionErr"]="please select your complexion ";
		$_SESSION['signup-complexion-error']=$errorList["complexionErr"];
		$errorOccurred=true;
	}
	else
	{	
		$complexion=test_input($_POST['complexion']);
	}
	
	if(empty($_POST['bodyType']))
	{
		$errorList["bodyTypeErr"]="please select your bodyType ";
		$_SESSION['signup-bodytype-error']=$errorList["bodyTypeErr"];
		$errorOccurred=true;
	}
	else
	{	
		$bodyType=test_input($_POST['bodyType']);
	}
	
	if(empty($_POST['hobby']))
	{
		$errorList["hobbyErr"]="please select your hobby ";
		$_SESSION['signup-hobby-error']=$errorList["hobbyErr"];
		$errorOccurred=true;
	}
	else
	{	
		$hobby=test_input($_POST['hobby']);
	}
	
	if(empty($_POST['disability']))
	{
		$errorList["disabilityErr"]="please select your disability ";
		$_SESSION['signup-disability-error']=$errorList["disabilityErr"];
		$errorOccurred=true;
	}
	else
	{	
		$disability=test_input($_POST['disability']);
	}
	
	if(empty($_POST['fatherStatus']))
	{
		$errorList["fatherStatusErr"]="please select father status ";
		$_SESSION['signup-fatherstatus-error']=$errorList["fatherStatusErr"];
		$errorOccurred=true;
	}
	else
	{	
		$fatherStatus=test_input($_POST['fatherStatus']);
	}
	
	if(empty($_POST['motherStatus']))
	{
		$errorList["motherStatusErr"]="please select mother status ";
		$_SESSION['signup-motherstatus-error']=$errorList["motherStatusErr"];
		$errorOccurred=true;
	}
	else
	{	
		$motherStatus=test_input($_POST['motherStatus']);
	}
	
	if(empty($_POST['noOfBrothers']))
	{
		$errorList["noOfBrothersErr"]="please select no of brothers ";
		$_SESSION['signup-noofbrothers-error']=$errorList["noOfBrothersErr"];
		$errorOccurred=true;
	}
	else
	{	
		$noOfBrothers=test_input($_POST['noOfBrothers']);
	}
	
	if(empty($_POST['noOfSisters']))
	{
		$errorList["noOfSistersErr"]="please select no of sisters ";
		$_SESSION['signup-noofsisters-error']=$errorList["noOfSistersErr"];
		$errorOccurred=true;
	}
	else
	{	
		$noOfSisters=test_input($_POST['noOfSisters']);
	}
	
	if(empty($_POST['familyType']))
	{
		$errorList["familyTypeErr"]="please select family type ";
		$_SESSION['signup-gender-error']=$errorList["familyTypeErr"];
		$errorOccurred=true;
	}
	else
	{	
		$familyType=test_input($_POST['familyType']);
	}
	
	if(empty($_POST['familyValues']))
	{
		$errorList["familyValuesErr"]="please select your family values ";
		$_SESSION['signup-familyvalues-error']=$errorList["familyValuesErr"];
		$errorOccurred=true;
	}
	else
	{	
		$familyValues=test_input($_POST['familyValues']);
	}
	
	if(empty($_POST['familyAffluence']))
	{
		$errorList["familyAffluenceErr"]="please select your family affluence ";
		$_SESSION['signup-familyaffluence-error']=$errorList["familyAffluenceErr"];
		$errorOccurred=true;
	}
	else
	{	
		$familyAffluence=test_input($_POST['familyAffluence']);
	}
		
	if(empty($_POST['partnerMaritalStatus']))
	{
		$errorList["partnerMaritalStatusErr"]="select marital status ";
		$_SESSION['signup-pmaritalstatus-error']=$errorList["partnerMaritalStatusErr"];
		$errorOccurred=true;
	}
	else
	{	
		$partnerMaritalStatus=test_input($_POST['partnerMaritalStatus']);
	}
	
	if(empty($_POST['partnerAge']))
	{
		$errorList["partnerAgeErr"]="select age ";
		$_SESSION['signup-page-error']=$errorList["partnerAgeErr"];
		$errorOccurred=true;
	}
	else
	{	
		$partnerAge=test_input($_POST['partnerAge']);
	}
	
	if(empty($_POST['partnerHeight']))
	{
		$errorList["partnerHeightErr"]="select height ";
		$_SESSION['signup-pheight-error']=$errorList["partnerHeightErr"];
		$errorOccurred=true;
	}
	else
	{	
		$partnerHeight=test_input($_POST['partnerHeight']);
	}	

	if(empty($_POST['partnerReligion']))
	{
		$errorList["partnerReligionErr"]="select religion ";
		$_SESSION['signup-preligion-error']=$errorList["partnerReligionErr"];
		$errorOccurred=true;
	}
	else
	{	
		$partnerReligion=test_input($_POST['partnerReligion']);
	}
	
	if(empty($_POST['partnerLanguage']))
	{
		$errorList["partnerLanguageErr"]="select language ";
		$_SESSION['signup-planguage-error']=$errorList["partnerLanguageErr"];
		$errorOccurred=true;
	}
	else
	{	
		$partnerLanguage=test_input($_POST['partnerLanguage']);
	}
	
	if(empty($_POST['partnerEducation']))
	{
		$errorList["partnerEducationErr"]="select education ";
		$_SESSION['signup-peducation-error']=$errorList["partnerEducationErr"];
		$errorOccurred=true;
	}
	else
	{	
		$partnerEducation=test_input($_POST['partnerEducation']);
	}
	
	if(empty($_POST['partnerComplexion']))
	{
		$errorList["partnerComplexionErr"]="select complexion ";
		$_SESSION['signup-pcomplexion-error']=$errorList["partnerComplexionErr"];
		$errorOccurred=true;
	}
	else
	{	
		$partnerComplexion=test_input($_POST['partnerComplexion']);
	}
	
	if(empty($_POST['partnerClan']))
	{
		$errorList["partnerClanErr"]="select clan ";
		$_SESSION['signup-pclan-error']=$errorList["partnerClanErr"];
		$errorOccurred=true;
	}
	else
	{	
		$partnerClan=test_input($_POST['partnerClan']);
	}
	
	if(empty($_POST['partnerFamilyAffluence']))
	{
		$errorList["partnerFamilyAffluenceErr"]="select partner family affluence ";
		$_SESSION['signup-pfamilyaffluence-error']=$errorList["partnerFamilyAffluenceErr"];
		$errorOccurred=true;
	}
	else
	{	
		$partnerFamilyAffluence=test_input($_POST['partnerFamilyAffluence']);
	}
	
	if(empty($_POST['partnerLocation']))
	{
		$errorList["partnerLocationErr"]="select location ";
		$_SESSION['signup-plocation-error']=$errorList["partnerLocationErr"];
		$errorOccurred=true;
	}
	else
	{	
		$partnerLocation=test_input($_POST['partnerLocation']);
		$partnerLocation=ucfirst($partnerLocation);
	}
	
	if(empty($_POST['partnerAbout']))
	{
		$errorList["partnerAboutErr"]="please write something  ";
		$_SESSION['signup-pabout-error']=$errorList["partnerAboutErr"];
		$errorOccurred=true;
	}
	else
	{	
		$partnerAbout=test_input($_POST['partnerAbout']);
		$partnerAbout=ucfirst($partnerAbout);
	}
	
	if(empty($_POST['aboutYourself']))
	{
		$errorList["explainYourSelfErr"]="please select explain yourself ";
		$_SESSION['signup-explainyourself-error']=$errorList["explainYourSelfErr"];
		$errorOccurred=true;
	}
	else
	{	
		$aboutYourself=test_input($_POST['aboutYourself']);
		$aboutYourself=ucfirst($aboutYourself);
	}
	
	
	if(isset($_FILES['uploadProfilePicture']))
   {
   		$errors=array();
		
		$imgName = $conn->real_escape_string($_FILES['uploadProfilePicture']['name']);
		$imgTmp= $conn->real_escape_string(file_get_contents($_FILES['uploadProfilePicture']['tmp_name']));
		$imgType = $conn->real_escape_string($_FILES['uploadProfilePicture']['type']);
		$imgSize = intval($_FILES['uploadProfilePicture']['size']);
		@$imgExtension=strtolower(end(explode('.',$imgName)));
		
		
		$expensions=array("jpg","jpeg","png");
		
		if(empty($imgName) == true)
		{
			$errorList["uploadProfilePictureErr"]="please select your profile picture ";
			$_SESSION['signup-profilepicture-error']=$errorList["uploadProfilePictureErr"];
			$errorOccurred=true;
			$imageIssues="No image selected";
			$_SESSION['signup-imageIssues']=$imageIssues;
		}
		else if($imgSize > 3000000 )
		{
			$errorList["uploadProfilePictureErr"]="<br>Image size is too larger, Max size is 3 MB. Your file size is: ".round(($imgSize/1048576),2)."MBs<br>";
			$_SESSION['signup-profilepicture-error']=$errorList["uploadProfilePictureErr"];
			$errorOccurred=true;
			$imageIssues="Image size is larger, Select image with small size";
			$_SESSION['signup-imageIssues']=$imageIssues;
		}
		else if(in_array($imgExtension,$expensions) == false)
		{
			$errorList["uploadProfilePictureErr"]="<br>Invalid file format(only jpg,png and jepg allowed)<br>";
			$_SESSION['signup-profilepicture-error']=$errorList["uploadProfilePictureErr"];
			$errorOccurred=true;
			$imageIssues="Please upload valid image. Allowed image formats are (JPG) (JPEG) and (PNG)";
			$_SESSION['signup-imageIssues']=$imageIssues;
		}
		else if( empty($imgName) == false && $imgSize < 9000000 && in_array($imgExtension,$expensions) == true)
		{
			$uploadProfilePicture= "dummy";
		}
   }
	
	if( $errorOccurred == false )
	{
		$checkEmail=$conn->prepare("SELECT email FROM signup WHERE email=?");
		$checkEmail->bind_param("s", $email);
		$checkEmail->execute();
		$checkEmail->bind_result($emailResult); while ($checkEmail->fetch()) {}
		$checkEmail->close();
		if($email != $emailResult)
		{
			date_default_timezone_set("Asia/Karachi");
			$timestamp = date('d/m/Y-h:i:s a', time());
			$splitTimeStamp = explode("-",$timestamp);
			$date = $splitTimeStamp[0];
			$time = $splitTimeStamp[1];
			
			$insertId=NULL;
			$makeMeHide="Show";
			$publicProfile=$_POST["publicProfile"];
			$approve="pending";
			
			
			$stmt = $conn->prepare("INSERT INTO signup VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
			?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssssssssssssssssssssssssssssssssssssssssssssssssss", $insertId , $firstName, $lastName, $gender, $email, $password, $mobile, 
			$profileCreatedBy, $country,$province, $district, $city, $dob, $language, $education, $profession, $salary, $maritalStatus, $clan, $caste, $religion, 
			$height, $complexion, $bodyType, $hobby, $disability, 
			$fatherStatus, $motherStatus, $noOfBrothers, $noOfSisters, $familyType, $familyValues, $familyAffluence, $partnerMaritalStatus, $partnerAge, $partnerHeight, 
			$partnerReligion, $partnerLanguage, $partnerEducation, $partnerComplexion, $partnerClan, $partnerFamilyAffluence, $partnerLocation, $partnerAbout, 	
			$aboutYourself, $uploadProfilePicture, $publicProfile, $makeMeHide, $date, $time, $approve);
			$stmt->execute();
			$image_id=$stmt->insert_id;
			
			$info = pathinfo($_FILES['uploadProfilePicture']['name']);
			$ext = $info['extension']; 
			$newname1 = $image_id.".".$ext; 
			$path = 'images/'.$newname1;	
			$stmt = $conn->prepare("UPDATE signup SET uploadProfilePicture=? WHERE id=? ");
			$stmt->bind_param("si", $path, $image_id );
			$stmt->execute();
			$stmt->close();
			
			
			$backup = $conn->prepare("INSERT INTO signupbackup VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
			?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$backup->bind_param("sssssssssssssssssssssssssssssssssssssssssssssssssss", $insertId , $firstName, $lastName, $gender, $email, $password, $mobile, 
			$profileCreatedBy, $country,$province, $district, $city, $dob, $language, $education, $profession, $salary, $maritalStatus, $clan, $caste, $religion, 
			$height, $complexion, $bodyType, $hobby, $disability, 
			$fatherStatus, $motherStatus, $noOfBrothers, $noOfSisters, $familyType, $familyValues, $familyAffluence, $partnerMaritalStatus, $partnerAge, $partnerHeight, 
			$partnerReligion, $partnerLanguage, $partnerEducation, $partnerComplexion, $partnerClan, $partnerFamilyAffluence, $partnerLocation, $partnerAbout, 	
			$aboutYourself, $uploadProfilePicture, $publicProfile, $makeMeHide, $date, $time, $approve);
			$backup->execute();
			$image_id=$backup->insert_id;
			
			$info = pathinfo($_FILES['uploadProfilePicture']['name']);
			$ext = $info['extension']; 
			$newname2 = $image_id.".".$ext; 
			$path = 'backupimages/'.$newname2;	
			$stmt = $conn->prepare("UPDATE signupbackup SET uploadProfilePicture=? WHERE id=? ");
			$stmt->bind_param("si", $path, $image_id );
			$stmt->execute();
			$stmt->close();
			
			
		   $filesDes = array(
           array('folder'=>'images','name'=>$newname1),
           array('folder'=>'backupimages','name'=>$newname2));
			
			function upload_file($arrayfile){
				$firstfile = null;
				foreach($arrayfile as $val){
					$dest = $val['folder']."/". $val['name'];
					if(!isset($firstfile)){
						$firstfile = $dest;
						$src       = $_FILES['uploadProfilePicture']['tmp_name'];
						if (!move_uploaded_file($src, $dest)) {
						   echo "Error in Image Uploading!";
						}
					}
					else{
						if(!copy ( $firstfile , $dest )){
						   echo "Error in Image Uploading";
						}
					}
				}
				
			}
			upload_file($filesDes);
			
			
			$check=$conn->prepare("SELECT id, email, password FROM signup WHERE email=?");
			$check->bind_param("s", $email);
			$check->execute();
			$check->bind_result($id,$email2,$password2);
			$print=$check->fetch();
			$check->close();
			
			$stmt2=$conn->prepare("INSERT INTO login VALUES (?, ?, ?)");
			$stmt2->bind_param("sss", $id, $email2, $password2);
			$stmt2->execute();
			$stmt2->close();
			
			
			
			
			if($print) 
			{	
				$_SESSION['firstPersonId'] =$id;
				header('Location: ../../searchProfiles.php');
			}
			else
			{
				$allErrorsOfPhp="something went wrong! try again.";
				$_SESSION['signup-all-errors']=$allErrorsOfPhp;
			}	
		
		}
		else
		{
			$allErrorsOfPhp="You already have an account on RISHTAWEB.COM<br>Please Login to your account! ";
			$_SESSION['signup-all-errors']=$allErrorsOfPhp;
		}

		
	}
	else
	{
		$allErrorsOfPhp="please provide correct information because some errors still exists, check the form again and submit it.";
		$_SESSION['signup-all-errors']=$allErrorsOfPhp;
	}
	
	
	
}

?>