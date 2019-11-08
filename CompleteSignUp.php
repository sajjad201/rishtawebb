<?php
session_start();
require 'inc/connection/connect.php';

if(isset($_SESSION["firstPersonId"]))
{
  header("Location: searchProfiles.php");
}


$insertId = $firstName= $lastName= $gender= $email= $password= $mobile= 0;
$profileCreatedBy= $country=$province= $district= $city= $dob= $language= $education= $profession= $salary= $maritalStatus= $clan= $caste= $religion=  0;
$height= $complexion= $bodyType= $hobby= $disability=  0;
$fatherStatus= $motherStatus= $noOfBrothers= $noOfSisters= $familyType= $familyValues= $familyAffluence= $partnerMaritalStatus= $partnerAge= $partnerHeight=  0;
$partnerReligion= $partnerLanguage= $partnerEducation= $partnerComplexion= $partnerClan= $partnerFamilyAffluence= $partnerLocation= $partnerAbout= 	 0;
$aboutYourself= $uploadProfilePicture= $publicProfile= $makeMeHide= $date= $time= $approve = 0;


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
	
	if( $errorOccurred == true )
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
<!DOCTYPE html>
<html>
<head>
    
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-1248017537402931",
    enable_page_level_ads: true
  });
</script> 

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="RISHTAWEB is a rishta portal working with the aim to facilitate people in pakistan to find their life partner. Create your free account, 
search rishta according to your choice and send them marriage proposals. If your are single and worry about your rishta or marriage than your problem will be solved here in 
finding rishta. There are very simple and easy steps to use this portal. It is user freindly and even a person who dont know more about technology, can use and understand this 
portal easily and quickly." />
<meta name="keywords" content="rishtaweb.com, rishtaweb, pakistani rishta free, online rishta pakistan, find rishta in pakistan, zaroorat rishta, rishta in lahore, rishta in islamabad, rishta in karachi, rishta online, rishta in pakistan, top pakistani matrimonial sites, pakistani matrimony, pakistani matrimonial, Marriage, rishtay, shaadi,
shaadi in pakistan, pakistan marriage site, top marriage site in pakistan, create account rishtaweb" />
<meta name="Author" content="RISHTAWEB.com" />
<meta name="copyright" content="RISHTAWEB.com" />
<meta name="Distribution" content="general" />
<meta name="robots" content="index, follow">
<title>Create Account - RISHTAWEB</title>

<meta name="robots" content="index, follow">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-133484988-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-133484988-1');
</script>
<link rel="shortcut icon" href="rw8.png">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="MessageScript.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">

<style>

.tooltip {
  font-family: 'Noto Nastaliq Urdu Draft', serif;
  font-size: 12px;
  font-weight: normal;
  padding:2px;
  margin-top:-5px;
  margin-bottom:5px;

  /* ... */
}
.tooltip-inner {
  padding: 5px;
  padding-bottom:10px;
  color: #fff;
  text-align: center;
  background-color: #000;
  border-radius: 4px;
}



#target a{color:#FFFFFF; font-weight:bolder; font-size:15px; padding:10px} li{margin:7px; margin-left:5px;}
#target a:hover{background-color:#800000;color:#FFFFFF; border-radius:3px;}	
#logoMargin{ margin-top:0px;}
@media only screen and (max-width: 767px)
{
	#logoMargin{ margin-top:0px}
	#navbarToggleButtonTop{color:#FFFFFF; font-size:24px; border:none; padding:10px; margin-top:5px; margin-bottom:5px; cursor:pointer; border-radius:2px; border-radius:4px;}
	#navbarToggleButtonTop:hover{background-color:#A00000; color:#FFFFFF; border-radius:3px;}	
}
@font-face 
{
    font-family: 'QanelasSoftDEMO-ExtraBold';
    src: url('QanelasSoftDEMO-ExtraBold.otf');
}
#logoText1{font-size:39px; color:#FFFFFF; font-family: 'QanelasSoftDEMO-ExtraBold';}
#logoText2{color:#c48f65}
@media only screen and (max-width: 767px) {#logoText1{ font-size:32px; margin-left:-4px; padding-bottom:1px }#logoTextMargin{margin-left:4px; padding-top:4px; padding-bottom:4px;}}



#createAccountNow a:hover{ background-color:#FFFFFF; color:#A00000}	
@media only screen and (max-width: 767px) {#fadeshow1 {display: none;}}
#searchIcon{ color:#FFFFFF; font-size:16px; border:none; cursor:pointer; margin-top:10px; border-radius:2px;}
#searchIcon:hover{ background-color:#FFFFFF; color:#A00000}
#navbarToggleButton{ color:#FFFFFF; font-size:16px; border:none; cursor:pointer; margin-top:10px; border-radius:2px; padding-top:10px; padding-bottom:10px; border-radius:4px;}
#navbarToggleButton:hover{background-color:#800000; color:#FFFFFF;}



#whitePage
{
	background-color:#eae6da; border-radius:4px; padding-bottom:15px; border:10px solid #eae6da; box-shadow:0px 0px 8px gray;
}
#createYourAccount{text-align:center; background-color:#ece9df; padding:15px; border-radius:5px; padding-top:18px;}
#createYourRishtawebAccount{font-size:25px; font-weight:700; color:#00539c; font-family:"Segoe UI"}
#backPadding{ margin-top:-15px;}
#day{width:100%; height:30px; border-radius:3px; color:#666666}
#month{width:100%; height:30px; border-radius:3px; color:#666666}
#year{width:100%; height:30px; border-radius:3px; color:#666666}
#signUpButton{ padding:0px;}
#signUpButtonBack{ padding:0px;}
#partnerPreferenceFontSize{color:#999999; text-align:center; font-family:Rubik; font-size:22px; font-weight:600}
#arrowPadding{padding-top:60px; padding-left:30px; text-align:center; padding-bottom:60px}
.block8Padding{display:none; color:#999999; border-radius:5px; padding-top:20px; 
								padding-bottom:20px; margin-bottom:40px; margin-top:20px;}
#modalFontSize{margin-top:10px; margin-bottom:20px; font-family:'Segoe UI'; font-size:16px}	
#urduLineHeight{line-height:35px}	
#iconMargin{margin-left:10px; float:right; margin-top:13px}	
#modalHeaderPadding{background-color:#F7F7F7; color:#004b8d; border-radius:3px;}	
@media only screen and (max-width: 767px) 
{
	#whitePage {border-radius:8px; border:0px solid #eae6da; box-shadow:0px 0px 16px gray;}
	#createYourRishtawebAccount{font-size:21px; font-weight:700}
	#backPadding{ padding:0px}
	.form-control{ height:40px}
	#nextPadding{padding-right:15px}
	#day{height:40px;}
	#month{height:40px;}
	#year{height:40px;}
	#signUpButton{ padding:10px}
	#signUpButtonBack{ padding:0px; margin-top:-10px; margin-left:10px}
	#setFonts{ font-family:"Segoe UI"; font-size:12px; font-weight:normal}
	#partnerPreferenceFontSize{font-size:16px;}
	#arrowRight{ display:none}
	#arrowPadding{padding-top:20px; padding-left:30px; text-align:center; padding-bottom:20px}
	.block8Padding{ padding:16px; margin-bottom:0px; background-color:#E2E2E2}
    #modalFontSize{ font-size:13px; margin-top:0px}
	#urduLineHeight{line-height:25px}	
	#iconMargin{margin-top:7px}
	#modalHeaderPadding{ padding:8px}	
}
@media only screen and (min-width: 767px)
{
	#arrowDown{ display:none}
}
@media only screen and (max-width: 1200px) 
{
	#signUpButton{ padding:10px}
	#signUpButtonBack{ padding:0px; margin-top:-10px; margin-left:10px}
}

.mainBody 
{
	background-color:#FFFFFF;
}

.form-control:focus 
{
  box-shadow: 0 0 0 0;
  border:2px solid #3e81f4;
}
 .form-control
{
	border:2px solid #EBEBEB;
	box-shadow: 0 0 0 0 ;
	padding:17px 12px;;
}
.pp
{
	border:2px solid #EBEBEB;
	box-shadow: 0 0 0 0 ;
}


.form-control-static
{
	border:2px solid #EBEBEB;
	box-shadow: 0 0 0 0 ;
}
.form-control-static:focus 
{
  box-shadow: 0 0 0 0;
  border:2px solid #00539c;
}

option{ cursor:pointer}

#day, #month, #year {border:2px solid #EBEBEB;} 
#day:focus {border:2px solid #00539c;}
#month:focus {border:2px solid #00539c;}
#year:focus {border:2px solid #00539c;}

@font-face 
{
    font-family: 'QanelasSoftDEMO-ExtraBold';
    src: url('assets/fonts/QanelasSoftDEMO-ExtraBold.otf');
}


</style>
<script src="assets/select2/select2popper.js"></script> 
<script src="assets/select2/select2min.js"></script> 
<link rel="stylesheet" href="assets/select2/select2.css"> 
<link href="assets/css/style.css" rel="stylesheet" />
</head>


<body style="background-color:#E4E4E4;">


<script type="text/javascript">
$( document ).ready(function() {
   $('#updateModal').modal('toggle');
});
$('#updateModal').modal({
    backdrop: 'static',
    keyboard: false
})
</script>
<div class="modal fade" id="updateModal" role="dialog" data-backdrop="static" >
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius:2px;">
			<div class="modal-header" id="modalHeaderPadding" style="border-bottom:2px solid #CCCCCC; background-color:#F7F7F7; color:#004b8d">
				<h3 class="modal-title" style="text-align:center; font-weight:700; font-family:'Segoe UI'; font-size:30px;">INSTRUCTIONS</h3>
			</div>
			<div class="modal-body" style="padding:0px 10px">
				<div class="container-fluid">
					<div class="row" id="modalFontSize">
						Please fill the form carefully with correct data, your email address & mobile number will NOT be published publically.
						You can HIDE your account & profile picture as well.<br>
						All services on this site are FREE of cost.<br>
						<span style="color:#D69C2F">
							<i class="fas fa-exclamation-triangle" style="margin-right:10px"></i>
							Note: In case of violation of our <a href="terms.php" style="text-decoration:none; color:#D69C2F;"><strong>Terms & Conditions</strong></a>, 
							Your Account will be Deleted Permanently.<br><br><br>
						</span>
						<div id="urduLineHeight" style="font-family:'Noto Nastaliq Urdu Draft', serif; text-align:right;">
							فارم احتیاط سے پر کیجئے۔ آپ کا ای میل ایڈریس اور موبائل نمبر ویب سائیٹ پر ظاہر نہیں کیا جائے گا۔ آپ اپنا اکاؤنٹ اور تصویر خفیہ رکھ سکتے ہیں۔<br> 
							ویب سائیٹ پر تمام سروسز بلکل مفت ہیں۔<br>
							<div style="color:#D69C2F;">
								<i class="fas fa-exclamation-triangle" id="iconMargin"></i>
								نوٹ: ہماری<a href="terms.php" style="text-decoration:none; color:#D69C2F"><strong>  ٹرمز اینڈ کنڈیشنز </strong> </a> 
								پر پورا نہ اترنے پر آپ کا اکاؤنٹ ڈیلیٹ کر دیا جائے گا۔
							</div>
						</div><br><br>
						<div class="col-lg-12 col-xs-12" style="padding:0px">
							<button type="button" class="btn btn-lg btn-block" data-dismiss="modal" style="border-radius:2px; color:#FFFFFF; 
							outline:none; background-color:#92b558; margin-bottom:-15px" onClick="FocusFirstName()">
								<i class="fas fa-check" style="margin-right:15px;"></i>I Understand
							</button>
						</div>
					</div>	
				</div>
			</div>
			
		</div>
	</div>
</div>

<div class="container-fluid" style=" padding:0px; padding-bottom:10px;">
	<div class="col-lg-12" style=" box-shadow:0px 0px 10px gray; background-color:#A00000; color:#FFFFFF;">
		<div id="logoTextMargin">
			<a href="index.php" style="text-decoration:none;">
				<span id="logoText1">RISHTA<span id="logoText2">WEB</span></span>
			</a>
		</div>
	</div>
</div>

<h1 style="display:none">Create Account</h1>

<div class="container-fluid mainBody" style=" background-color:#E4E4E4;">
	<div class="row">
		<div class="col-lg-12" style="height:auto; padding-bottom:10px;  margin-top:10px">
			<div class="row" style="padding:10px">
				<div class="col-lg-2"></div>
				
				<!---whitePage--->
				<div class="col-lg-8" id="whitePage">
				 
				<div class="row"  >
					<div class="col-lg-12" id="createYourAccount">
						<p id="createYourRishtawebAccount"><i class="fas fa-user-edit" style="margin-right:15px"></i>
							Create Rishtaweb Account
							
						</p>
					</div>
					<div class="col-lg-12" style="background-color:#eae6da; padding:0px;">
						<div style="font-size:13px; color:#BF0000; background-color:#FFFFE8; text-align:center; ">
							<?php if($_SERVER['REQUEST_METHOD']=="POST"){
									if(isset($_SESSION['signup-all-errors'])){ echo $_SESSION['signup-email-error']; unset($_SESSION['signup-email-error']);} 
									if(isset($_SESSION['signup-imageIssues'])){ echo $_SESSION['signup-email-error']; unset($_SESSION['signup-email-error']);} 
								 }
							?>
						</div>
					</div>
				</div>

					<div class="row" style="background-color:#FFFFFF; padding-top:10px" id="whitePageCenter">
						<div class="col-lg-2"></div>
						
						<!---CompleteForm--->
						<div class="col-lg-8"  >
							<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="signupForm" autocomplete="off">
		
								<!---block1--->
								<div id="block1" style="color:#999999;">
									<div class="col-lg-12" style="padding:5px; margin-bottom:10px;">
										<div style="color:#999999; text-align:center; font-family:Rubik; font-size:16px; font-weight:600">
											<i class='far fa-user' style=" margin-right:5px; "></i>
											Basic Profile Info 
										</div>	
									</div>
									<div class="form-group">
										<label for="firstName" class="col-sm-4 col-xs-12 control-label" id="setFonts">First Name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="firstName" id="firstName" placeholder="enter first name" 
										 	 onBlur="FirstName()" value="<?php if(!empty($_POST['firstName'])){echo $_POST['firstName'];}?>">
											 <span></span>
											<div id="firstNameError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-firstname-error'])){ echo $_SESSION['signup-firstname-error']; unset($_SESSION['signup-firstname-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="lastName" class="col-sm-4 col-xs-12 control-label" id="setFonts">Last Name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="lastName" id="lastName" placeholder="enter last name" 
											value="<?php if(!empty($_POST['lastName'])){echo $_POST['lastName'];}?>" onBlur="LastName()">
											<div id="lastNameError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-lastname-error'])){ echo $_SESSION['signup-lastname-error']; unset($_SESSION['signup-lastname-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="gender" class="col-sm-4 col-xs-12 control-label" id="setFonts">Select Gender</label>
										<div class="col-sm-2 col-xs-4">
											<input type="radio" name="gender" id="male" onBlur="Gender()" value="male">
											<label for="male">Male</label>
										</div>
										<div class="col-sm-4 col-xs-6">
											<input type="radio" name="gender" id="female" onBlur="Gender()" value="female">
											<label for="female">Female</label>
										</div>
										<div class="col-lg-4"></div>
										<div class="col-lg-8 col-xs-12" id="genderError" style="font-size:12px; color:#BF0000;">
											<?php if(isset($_SESSION['signup-gender-error'])){ echo $_SESSION['signup-gender-error']; unset($_SESSION['signup-gender-error']);} ?>
										</div>
									</div>
									<div class="form-group">
										<label for="email" class="col-sm-4 col-xs-12 control-label" id="setFonts">Email</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="email" id="email" placeholder="Enter Email Address" 
											value="<?php if(!empty($_POST['email'])){echo $_POST['email'];} else{echo "@gmail.com";}?>" onBlur="Email()">
											<div id="emailError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-email-error'])){ echo $_SESSION['signup-email-error']; unset($_SESSION['signup-email-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="password" class="col-sm-4 col-xs-12 control-label" id="setFonts">Password</label>
										<div class="col-sm-6">
											<input type="password" class="form-control" name="password" id="password" placeholder="enter password" 
											value="<?php if(!empty($_POST['password'])){echo $_POST['password'];}?>" onBlur="Password()">
											<div id="passwordError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-password-error'])){ echo $_SESSION['signup-password-error']; unset($_SESSION['signup-password-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="mobile" class="col-sm-4 col-xs-12 control-label" id="setFonts">Mobile</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="mobile" id="mobile" placeholder="0310xxxxxxx" 
											value="<?php if(!empty($_POST['mobile'])){echo $_POST['mobile'];}?>" onBlur="Mobile()">
											<div id="mobileError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-mobile-error'])){ echo $_SESSION['signup-mobile-error']; unset($_SESSION['signup-mobile-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="profileCreatedBy" class="col-sm-4 col-xs-12 control-label" id="setFonts">Account Created By</label>
										<div class="col-sm-6">
											<select class="form-control select2  form-select ProfileCreatedBy" name="profileCreatedBy" id="ProfileCreatedBy">
												<option value="0">Profile Created By</option>
												<option value="Myself">Myself</option>
												<option value="Parent">Parent</option>
												<option value="Guardian">Guardian</option>
												<option value="Sister">Sister</option>
												<option value="Brother">Brother </option>
												<option value="Friend">Friend</option>
											</select>
											<div id="profileCreatedByError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-profilecreatedby-error'])){ echo $_SESSION['signup-profilecreatedby-error']; unset($_SESSION['signup-profilecreatedby-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"></label>
										<div class="col-sm-6 col-xs-12" id="nextPadding">
											<button type="button" class="button button-ripple btn-block" style="border-radius:3px;" 
											name="form1" id="form1" onClick="form1Script()">
											<span class="button-text-white">Next</span>
											<i class="fa fa-angle-right" style="margin-left:15px"></i></button>
										</div>
										<div class="col-sm-4"></div>
									</div>
									<div class="form-group">
										<div class="col-sm-4"></div>
										<div class="col-sm-6" style="text-align:center; font-family:Rubik; font-size:13px">Already have Account? <br> 
											<a href="login.php" data-toggle="model" data-target="login">Login Here</a>
										</div>
										<div class="col-sm-4"></div>
									</div>
								</div>
							
								<!---Block2--->
								<div id="block2" style="display:none; color:#999999">
								 	<div class="reg-back">
										<div>
										<div class="col-sm-6" id="backPadding">
											<div  class="back-button" onClick="backToPage1()">
												<i class="fas fa-arrow-left" style="margin-right:8px; font-size:20px"></i>
											</div>
										</div>
										</div>
									</div>
									<div class="col-lg-12" style="padding:5px; margin-bottom:10px;">
										<div style="color:#999999; text-align:center; font-family:Rubik; font-size:16px; font-weight:600">
										<i class="fas fa-map-marker-alt" style="margin-right:10px; color:#408080; margin-left:1px"></i>
										Your Residential Info</div>
									</div>
									<div class="form-group">
										<label for="country" class="col-sm-4 control-label" id="setFonts">Country</label>
										<div class="col-sm-6">
											<select class="form-control select2 Country" name="country" id="Country">
												<option value="0">Your Country</option>
												<option value="Pakistan">Pakistan</option>
												<option value="United Arab Emirates">United Arab Emirates</option>
												<option value="Saudi arabia ">Saudi arabia </option>
												<option value="Oman">Oman</option>
												<option value="Qatar">Qatar</option>
												<option value="India">India</option>
												<option value="Afghanistan">Afghanistan</option>
												<option value="iran">iran</option>
												<option value="Kuwait">Kuwait </option>
												<option value="Canada">Canada </option>
												<option value="Germany">Germany </option>
												<option value="France">France </option>
												<option value="United States of America">United States of America</option>
												<option value="United Kingdom">United Kingdom </option>
												<option value="Other">Other</option>
											</select>
											<div id="countryError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-country-error'])){ echo $_SESSION['signup-country-error']; unset($_SESSION['signup-country-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group" id="showProvince">
										<label for="province" class="col-sm-4 control-label" id="setFonts">Province</label>
										<div class="col-sm-6">
											<select class="form-control select2 Province" name="province" id="Province"></select>
											<div id="provinceError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-province-error'])){ echo $_SESSION['signup-province-error']; unset($_SESSION['signup-province-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group" id="showDistrict">
										<label for="district" class="col-sm-4 control-label" id="setFonts">District</label>
										<div class="col-sm-6">
											<select class="form-control select2 District" name="district" id="District"></select>
											<div id="districtError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-district-error'])){ echo $_SESSION['signup-district-error']; unset($_SESSION['signup-district-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group" id="showCity">
										<label for="city" class="col-sm-4 col-xs-12 control-label" id="setFonts">City</label>
										<div class="col-sm-6">
											<select class="form-control select2 City" name="city" id="City">
												<option value="0">Your City</option>
												<option value="Islamabad">Islamabad</option>
												<option value="Karachi">Karachi</option>
												<option value="Lahore">Lahore</option>
												<option value="Sehwan">Sehwan</option>
												<option value="Abbaspur">Abbaspur</option>
												<option value="Abbottabad">Abbottabad</option>
												<option value="Abdul Hakim">Abdul Hakim</option>
												<option value="Adda Jahan Khan">Adda Jahan Khan</option>
												<option value="Adda Shaiwala">Adda Shaiwala</option>
												<option value="Ahmadpur East">Ahmadpur East</option>
												<option value="Akhora Khattak">Akhora Khattak</option>
												<option value="Ali Chak">Ali Chak</option>
												<option value="Ali pur">Ali pur</option>
												<option value="Allahabad">Allahabad</option>
												<option value="Amangarh">Amangarh</option>
												<option value="Ambela">Ambela</option>
												<option value="Arifwala">Arifwala</option>
												<option value="Astore">Astore</option>
												<option value="Attock">Attock</option>
												<option value="Babri Banda">Babri Banda</option>
												<option value="Badin">Badin</option>
												<option value="Bagh">Bagh</option>
												<option value="Bahawalnagar">Bahawalnagar</option>
												<option value="Bahawalpur">Bahawalpur</option>
												<option value="Bajaur">Bajaur</option>
												<option value="Balakot">Balakot</option>
												<option value="Bannu">Bannu</option>
												<option value="Barbar Loi">Barbar Loi</option>
												<option value="Barkhan">Barkhan</option>
												<option value="Baroute">Baroute</option>
												<option value="Bat Khela">Bat Khela</option>
												<option value="Battagram">Battagram</option>
												<option value="Besham">Besham</option>
												<option value="Bewal">Bewal</option>
												<option value="Bhakkar">Bhakkar</option>
												<option value="Bhalwal">Bhalwal</option>
												<option value="Bhan Saeedabad">Bhan Saeedabad</option>
												<option value="Bhara Kahu">Bhara Kahu</option>
												<option value="Bhera">Bhera</option>
												<option value="Bhimbar">Bhimbar</option>
												<option value="Bhirya Road">Bhirya Road</option>
												<option value="Bhuawana">Bhuawana</option>
												<option value="Bisham">Bisham</option>
												<option value="Blitang">Blitang</option>
												<option value="Bolan">Bolan</option>
												<option value="Buchay Key">Buchay Key</option>
												<option value="Bunner">Bunner</option>
												<option value="Burewala">Burewala</option>
												<option value="Chacklala">Chacklala</option>
												<option value="Chaghi">Chaghi</option>
												<option value="Chaininda">Chaininda</option>
												<option value="Chak 4 b c">Chak 4 b c</option>
												<option value="Chak 46">Chak 46</option>
												<option value="Chak Jamal">Chak Jamal</option>
												<option value="Chak Jhumra">Chak Jhumra</option>
												<option value="Chak Sawara">Chak Sawara</option>
												<option value="Chak Sheza">Chak Sheza</option>
												<option value="Chakwal">Chakwal</option>
												<option value="Chaman">Chaman</option>
												<option value="Charsada">Charsada</option>
												<option value="Chashma">Chashma</option>
												<option value="Chawinda">Chawinda</option>
												<option value="Cherat">Cherat</option>
												<option value="Chicha watni">Chicha watni</option>
												<option value="Chilas">Chilas</option>
												<option value="Chiniot">Chiniot</option>
												<option value="Chishtian">Chishtian</option>
												<option value="Chitral">Chitral</option>
												<option value="Choa Saiden Shah">Choa Saiden Shah</option>
												<option value="Chohar Jamali">Chohar Jamali</option>
												<option value="Choppar Hatta">Choppar Hatta</option>
												<option value="Chowk Azam">Chowk Azam</option>
												<option value="Chowk Maitla">Chowk Maitla</option>
												<option value="Chowk Munda">Chowk Munda</option>
												<option value="Chunian">Chunian</option>
												<option value="Dadakhel">Dadakhel</option>
												<option value="Dadu">Dadu</option>
												<option value="Daharki">Daharki</option>
												<option value="Dandot">Dandot</option>
												<option value="Dargai">Dargai</option>
												<option value="Darya Khan">Darya Khan</option>
												<option value="Daska">Daska</option>
												<option value="Daud Khel">Daud Khel</option>
												<option value="Daulat Pur">Daulat Pur</option>
												<option value="Daur">Daur</option>
												<option value="Deh Pathaan">Deh Pathaan</option>
												<option value="Depal Pur">Depal Pur</option>
												<option value="Dera Bugti">Dera Bugti</option>
												<option value="Dera Ghazi Khan">Dera Ghazi Khan</option>
												<option value="Dera Ismail Khan">Dera Ismail Khan</option>
												<option value="Dera Murad Jamali">Dera Murad Jamali</option>
												<option value="Dera Nawab Sahib">Dera Nawab Sahib</option>
												<option value="Dhatmal">Dhatmal</option>
												<option value="Dhirkot">Dhirkot</option>
												<option value="Dhoun Kal">Dhoun Kal</option>
												<option value="Diamer">Diamer</option>
												<option value="Digri">Digri</option>
												<option value="Dijkot">Dijkot</option>
												<option value="Dina">Dina</option>
												<option value="Dinga">Dinga</option>
												<option value="Dir">Dir</option>
												<option value="Doaaba">Doaaba</option>
												<option value="Doltala">Doltala</option>
												<option value="Domeli">Domeli</option>
												<option value="Dudial">Dudial</option>
												<option value="Dunyapur">Dunyapur</option>
												<option value="Eminabad">Eminabad</option>
												<option value="Faisalabad">Faisalabad</option>
												<option value="Farooqabad">Farooqabad</option>
												<option value="Fateh Jang">Fateh Jang</option>
												<option value="Fateh Pur">Fateh Pur</option>
												<option value="Feroz Walla">Feroz Walla</option>
												<option value="Feroz Watan">Feroz Watan</option>
												<option value="Fizagat">Fizagat</option>
												<option value="Fort Abbas">Fort Abbas</option>
												<option value="FR Bannu">FR Bannu</option>
												<option value="FR Bannu / Lakki">FR Bannu / Lakki</option>
												<option value="FR DI Khan">FR DI Khan</option>
												<option value="FR Kohat">FR Kohat</option>
												<option value="FR Peshawar">FR Peshawar</option>
												<option value="FR Peshawar / Kohat">FR Peshawar / Kohat</option>
												<option value="FR Tank / DI Khan">FR Tank / DI Khan</option>
												<option value="Gadoon Amazai">Gadoon Amazai</option>
												<option value="Gaggo Mandi">Gaggo Mandi</option>
												<option value="Gakhar Mandi">Gakhar Mandi</option>
												<option value="Gambet">Gambet</option>
												<option value="Garh Maharaja">Garh Maharaja</option>
												<option value="Garh More">Garh More</option>
												<option value="Gari Habibullah">Gari Habibullah</option>
												<option value="Gari Mori">Gari Mori</option>
												<option value="Gawadar">Gawadar</option>
												<option value="Ghari Dupatta">Ghari Dupatta</option>
												<option value="Gharo">Gharo</option>
												<option value="Ghazi">Ghazi</option>
												<option value="Ghizer">Ghizer</option>
												<option value="Ghotki">Ghotki</option>
												<option value="Ghuzdar">Ghuzdar</option>
												<option value="Gilgit">Gilgit</option>
												<option value="Gohar Ghoushti">Gohar Ghoushti</option>
												<option value="Gojra">Gojra</option>
												<option value="Goular Khel">Goular Khel</option>
												<option value="Guddu">Guddu</option>
												<option value="Gujar Khan">Gujar Khan</option>
												<option value="Gujranwala">Gujranwala</option>
												<option value="Gujrat">Gujrat</option>
												<option value="Hafizabad">Hafizabad</option>
												<option value="Hala">Hala</option>
												<option value="Hangu">Hangu</option>
												<option value="Hari Pur">Hari Pur</option>
												<option value="Hariwala">Hariwala</option>
												<option value="Harnai">Harnai</option>
												<option value="Haroonabad">Haroonabad</option>
												<option value="Hasilpur">Hasilpur</option>
												<option value="Hassan Abdal">Hassan Abdal</option>
												<option value="Hattar">Hattar</option>
												<option value="Hattian">Hattian</option>
												<option value="Haveli Kahuta">Haveli Kahuta</option>
												<option value="Haveli Lakha">Haveli Lakha</option>
												<option value="Havelian">Havelian</option>
												<option value="Hayatabad">Hayatabad</option>
												<option value="Hazro">Hazro</option>
												<option value="Head Marala">Head Marala</option>
												<option value="Hub Chowki">Hub Chowki</option>
												<option value="Hub Inds Estate">Hub Inds Estate</option>
												<option value="Hujra Shah Muqeem">Hujra Shah Muqeem</option>
												<option value="Hunza Nagar">Hunza Nagar</option>
												<option value="Hyderabad">Hyderabad</option>
												<option value="Issa Khel">Issa Khel</option>
												<option value="Jacobabad">Jacobabad</option>
												<option value="Jaffarabad">Jaffarabad</option>
												<option value="Jaja Abasian">Jaja Abasian</option>
												<option value="Jalal Pur Jatan">Jalal Pur Jatan</option>
												<option value="Jalal Pur Priwala">Jalal Pur Priwala</option>
												<option value="Jalozai">Jalozai</option>
												<option value="Jampur">Jampur</option>
												<option value="Jamrud Road">Jamrud Road</option>
												<option value="Jamshoro">Jamshoro</option>
												<option value="Jandanwala">Jandanwala</option>
												<option value="Jaranwala">Jaranwala</option>
												<option value="Jatoi">Jatoi</option>
												<option value="Jauharabad">Jauharabad</option>
												<option value="Jehangira">Jehangira</option>
												<option value="Jehanian">Jehanian</option>
												<option value="Jehlum">Jehlum</option>
												<option value="Jhal Magsi">Jhal Magsi</option>
												<option value="Jhand">Jhand</option>
												<option value="Jhang">Jhang</option>
												<option value="Jetta Bhutta">Jetta Bhutta</option>
												<option value="Judo">Judo</option>
												<option value="Kabir Wala">Kabir Wala</option>
												<option value="Kacha Khooh">Kacha Khooh</option>
												<option value="Kachhi/Bolan">Kachhi/Bolan</option>
												<option value="Kahror Pacca">Kahror Pacca</option>
												<option value="Kahuta">Kahuta</option>
												<option value="Kakul">Kakul</option>
												<option value="Kakur Town">Kakur Town</option>
												<option value="Kala Bagh">Kala Bagh</option>
												<option value="Kala Shah Kaku">Kala Shah Kaku</option>
												<option value="Kalam">Kalam</option>
												<option value="Kalar Syedian">Kalar Syedian</option>
												<option value="Kalaswala">Kalaswala</option>
												<option value="Kallat">Kallat</option>
												<option value="Kallur Kot">Kallur Kot</option>
												<option value="Kamalia">Kamalia</option>
												<option value="Kamalia Musa">Kamalia Musa</option>
												<option value="Kamber Ali Khan">Kamber Ali Khan</option>
												<option value="Kamokey">Kamokey</option>
												<option value="Kamra">Kamra</option>
												<option value="Kandhkot">Kandhkot</option>
												<option value="Kandiaro">Kandiaro</option>
												<option value="Karak">Karak</option>
												<option value="Karore Lalisan">Karore Lalisan</option>
												<option value="Kashmir">Kashmir</option>
												<option value="Kashmore">Kashmore</option>
												<option value="Kasur">Kasur</option>
												<option value="Kazi Ahmed">Kazi Ahmed</option>
												<option value="Kech">Kech</option>
												<option value="Khair Pur">Khair Pur</option>
												<option value="Khair Pur Mir">Khair Pur Mir</option>
												<option value="Khairpur Nathan Shah">Khairpur Nathan Shah</option>
												<option value="Khanbel">Khanbel</option>
												<option value="Khandabad">Khandabad</option>
												<option value="Khanewal">Khanewal</option>
												<option value="Khangah Sharif">Khangah Sharif</option>
												<option value="Khangarh">Khangarh</option>
												<option value="Khanpur">Khanpur</option>
												<option value="Khanqah Dogran">Khanqah Dogran</option>
												<option value="Khanqah Sharif">Khanqah Sharif</option>
												<option value="Kharan">Kharan</option>
												<option value="Kharian">Kharian</option>
												<option value="Khewra">Khewra</option>
												<option value="Khoski">Khoski</option>
												<option value="Khuiratta">Khuiratta</option>
												<option value="Khurian wala">Khurian wala</option>
												<option value="Khushab">Khushab</option>
												<option value="Khushal Kot">Khushal Kot</option>
												<option value="Khuzdar">Khuzdar</option>
												<option value="Khyber Agency">Khyber Agency</option>
												<option value="Killa Abdullah">Killa Abdullah</option>
												<option value="Killa Saifullah">Killa Saifullah</option>
												<option value="Kohat">Kohat</option>
												<option value="Kohistan">Kohistan</option>
												<option value="Kohlu">Kohlu</option>
												<option value="Kot Addu">Kot Addu</option>
												<option value="Kot Bunglow">Kot Bunglow</option>
												<option value="Kot Ghulam Mohd">Kot Ghulam Mohd</option>
												<option value="Kot Mithan">Kot Mithan</option>
												<option value="Kot Radha Kishan">Kot Radha Kishan</option>
												<option value="Kot Sabzal">Kot Sabzal</option>
												<option value="Kotla">Kotla</option>
												<option value="Kotla Arab Ali Khan">Kotla Arab Ali Khan</option>
												<option value="Kotla Jam">Kotla Jam</option>
												<option value="Kotla Pathan">Kotla Pathan</option>
												<option value="Kotli">Kotli</option>
												<option value="Kotli Loharan">Kotli Loharan</option>
												<option value="Kotmomin">Kotmomin</option>
												<option value="Kotri">Kotri</option>
												<option value="Kumbh">Kumbh</option>
												<option value="Kundina">Kundina</option>
												<option value="Kunjah">Kunjah</option>
												<option value="Kunri">Kunri</option>
												<option value="Kurram">Kurram</option>
												<option value="Kurram Agency">Kurram Agency</option>
												<option value="Lakimarwat">Lakimarwat</option>
												<option value="Lakki Marwat">Lakki Marwat</option>
												<option value="Lala rukh">Lala rukh</option>
												<option value="Lalamusa">Lalamusa</option>
												<option value="Laliah">Laliah</option>
												<option value="Lalshanra">Lalshanra</option>
												<option value="Landi Kotal">Landi Kotal</option>
												<option value="Larkana">Larkana</option>
												<option value="Lasbela">Lasbela</option>
												<option value="Lawrence pur">Lawrence pur</option>
												<option value="Layyah">Layyah</option>
												<option value="Leepa">Leepa</option>
												<option value="Liaquat Pur">Liaquat Pur</option>
												<option value="Lodhran">Lodhran</option>
												<option value="Loralai">Loralai</option>
												<option value="Lower Dir">Lower Dir</option>
												<option value="Ludhan">Ludhan</option>
												<option value="Machh">Machh</option>
												<option value="Machi Goth">Machi Goth</option>
												<option value="Madinah">Madinah</option>
												<option value="Mailsi">Mailsi</option>
												<option value="Makli">Makli</option>
												<option value="Makran">Makran</option>
												<option value="Malakand">Malakand</option>
												<option value="Malakwal">Malakwal</option>
												<option value="Mamu kunjan">Mamu kunjan</option>
												<option value="Mandi Bahauddin">Mandi Bahauddin</option>
												<option value="Mandi Faizabad">Mandi Faizabad</option>
												<option value="Mandra">Mandra</option>
												<option value="Manga Mandi">Manga Mandi</option>
												<option value="Mangal Sada">Mangal Sada</option>
												<option value="Mangi">Mangi</option>
												<option value="Mangla">Mangla</option>
												<option value="Mangowal">Mangowal</option>
												<option value="Manoabad">Manoabad</option>
												<option value="Mansehra">Mansehra</option>
												<option value="Mardan">Mardan</option>
												<option value="Mari Indus">Mari Indus</option>
												<option value="Mastoi">Mastoi</option>
												<option value="Matiari">Matiari</option>
												<option value="Matli">Matli</option>
												<option value="Mehar">Mehar</option>
												<option value="Mehmood Kot">Mehmood Kot</option>
												<option value="Mehrab Pur">Mehrab Pur</option>
												<option value="Mian Chunnu">Mian Chunnu</option>
												<option value="Mian Walli">Mian Walli</option>
												<option value="Minchanabad">Minchanabad</option>
												<option value="Mingora">Mingora</option>
												<option value="Mir Ali">Mir Ali</option>
												<option value="Miran Shah">Miran Shah</option>
												<option value="Mirpur  (AJK)">Mirpur  (AJK)</option>
												<option value="Mirpur Khas">Mirpur Khas</option>
												<option value="Mirpur Mathelo">Mirpur Mathelo</option>
												<option value="Mithi">Mithi</option>
												<option value="Mohen Jo Daro">Mohen Jo Daro</option>
												<option value="Mohmand">Mohmand</option>
												<option value="More kunda">More kunda</option>
												<option value="Morgah">Morgah</option>
												<option value="Moro">Moro</option>
												<option value="Mubarik Pur">Mubarik Pur</option>
												<option value="Multan">Multan</option>
												<option value="Muridkay">Muridkay</option>
												<option value="Murree">Murree</option>
												<option value="Musafir Khana">Musafir Khana</option>
												<option value="Musakhel">Musakhel</option>
												<option value="Mustang">Mustang</option>
												<option value="Muzaffarabad">Muzaffarabad</option>
												<option value="Muzaffargarh">Muzaffargarh</option>
												<option value="Nankana Sahib">Nankana Sahib</option>
												<option value="Narang Mandi">Narang Mandi</option>
												<option value="Narowal">Narowal</option>
												<option value="Naseerabad">Naseerabad</option>
												<option value="Naudero">Naudero</option>
												<option value="Naukot">Naukot</option>
												<option value="Naukundi">Naukundi</option>
												<option value="Nawab Shah">Nawab Shah</option>
												<option value="Neelam">Neelam</option>
												<option value="New Saeedabad">New Saeedabad</option>
												<option value="Nilam">Nilam</option>
												<option value="Nilore">Nilore</option>
												<option value="Noor kot">Noor kot</option>
												<option value="Nooriabad">Nooriabad</option>
												<option value="Noorpur nooranga">Noorpur nooranga</option>
												<option value="North Wazirstan">North Wazirstan</option>
												<option value="Noshki">Noshki</option>
												<option value="Nowshera">Nowshera</option>
												<option value="Nowshera Cantt">Nowshera Cantt</option>
												<option value="Nowshero Feroz">Nowshero Feroz</option>
												<option value="Okara">Okara</option>
												<option value="Orakzai">Orakzai</option>
												<option value="Padidan">Padidan</option>
												<option value="Pak Pattan Sharif">Pak Pattan Sharif</option>
												<option value="Panjan Kisan">Panjan Kisan</option>
												<option value="Panjgur">Panjgur</option>
												<option value="Pannu aqil">Pannu aqil</option>
												<option value="Parachinar">Parachinar</option>
												<option value="Pasni">Pasni</option>
												<option value="Pasroor">Pasroor</option>
												<option value="Patika">Patika</option>
												<option value="Patoki">Patoki</option>
												<option value="Peshawar">Peshawar</option>
												<option value="Phagwar">Phagwar</option>
												<option value="Phalia">Phalia</option>
												<option value="Phool nagar">Phool nagar</option>
												<option value="Phoolnagar (Bhai Pheru)">Phoolnagar (Bhai Pheru)</option>
												<option value="Piaro goth">Piaro goth</option>
												<option value="Pind Dadan Khan">Pind Dadan Khan</option>
												<option value="Pindi Bhattian">Pindi Bhattian</option>
												<option value="Pindi bhohri">Pindi bhohri</option>
												<option value="Pindi gheb">Pindi gheb</option>
												<option value="Piplan">Piplan</option>
												<option value="Pir Mahal">Pir Mahal</option>
												<option value="Pirpai">Pirpai</option>
												<option value="Pishin">Pishin</option>
												<option value="Poonch">Poonch</option>
												<option value="Punch">Punch</option>
												<option value="Qalandarabad">Qalandarabad</option>
												<option value="Qambar">Qambar</option>
												<option value="Qambar Shahdatkot">Qambar Shahdatkot</option>
												<option value="Qasba Gujrat">Qasba Gujrat</option>
												<option value="Qazi Ahmed">Qazi Ahmed</option>
												<option value="Quaidabad">Quaidabad</option>
												<option value="Quetta">Quetta</option>
												<option value="Rabwah">Rabwah</option>
												<option value="Rahimyar Khan">Rahimyar Khan</option>
												<option value="Rahwali">Rahwali</option>
												<option value="Raiwind">Raiwind</option>
												<option value="Rajana">Rajana</option>
												<option value="Rajanpur">Rajanpur</option>
												<option value="Rangoo">Rangoo</option>
												<option value="Ranipur">Ranipur</option>
												<option value="Rashidabad">Rashidabad</option>
												<option value="Ratto Dero">Ratto Dero</option>
												<option value="Rawala Kot">Rawala Kot</option>
												<option value="Rawalpindi">Rawalpindi</option>
												<option value="Rawat">Rawat</option>
												<option value="Renala Khurd">Renala Khurd</option>
												<option value="Risalpur">Risalpur</option>
												<option value="Rohri">Rohri</option>
												<option value="Sadiqabad">Sadiqabad</option>
												<option value="Sagri">Sagri</option>
												<option value="Sahiwal">Sahiwal</option>
												<option value="Saidu Sharif">Saidu Sharif</option>
												<option value="Sajawal">Sajawal</option>
												<option value="Sakardu">Sakardu</option>
												<option value="Sakrand">Sakrand</option>
												<option value="Sambrial">Sambrial</option>
												<option value="Samma Satta">Samma Satta</option>
												<option value="Samundri">Samundri</option>
												<option value="Sanghar">Sanghar</option>
												<option value="Sanghi">Sanghi</option>
												<option value="Sangla Hill">Sangla Hill</option>
												<option value="Sangote">Sangote</option>
												<option value="Sanjwal">Sanjwal</option>
												<option value="Sara e Naurang">Sara e Naurang</option>
												<option value="Sarai Alamgir">Sarai Alamgir</option>
												<option value="Sargodha">Sargodha</option>
												<option value="Satyana Bangla">Satyana Bangla</option>
												<option value="Sehar Baqlas">Sehar Baqlas</option>
												<option value="Shadiwal">Shadiwal</option>
												<option value="Shahdad Kot">Shahdad Kot</option>
												<option value="Shahdad Pur">Shahdad Pur</option>
												<option value="Shaheed Benazirabad">Shaheed Benazirabad</option>
												<option value="Shahkot">Shahkot</option>
												<option value="Shahpur Chakar">Shahpur Chakar</option>
												<option value="Shakargarh">Shakargarh</option>
												<option value="Shamsabad">Shamsabad</option>
												<option value="Shangla">Shangla</option>
												<option value="Shankiari">Shankiari</option>
												<option value="Shedani sharif">Shedani sharif</option>
												<option value="Sheikhupura">Sheikhupura</option>
												<option value="Shemier">Shemier</option>
												<option value="Sherani">Sherani</option>
												<option value="Shikarpur">Shikarpur</option>
												<option value="Shogram">Shogram</option>
												<option value="Shorkot">Shorkot</option>
												<option value="Shujabad">Shujabad</option>
												<option value="Sialkot">Sialkot</option>
												<option value="Sibi">Sibi</option>
												<option value="Sidhnoti">Sidhnoti</option>
												<option value="Sihala">Sihala</option>
												<option value="Sikandarabad">Sikandarabad</option>
												<option value="Silanwala">Silanwala</option>
												<option value="Sita Road">Sita Road</option>
												<option value="Skardu">Skardu</option>
												<option value="Sohawa District Daska">Sohawa District Daska</option>
												<option value="Sohawa District Jelum">Sohawa District Jelum</option>
												<option value="South Wazirstan">South Wazirstan</option>
												<option value="Sudhnoti">Sudhnoti</option>
												<option value="Sukkur">Sukkur</option>
												<option value="Swabi">Swabi</option>
												<option value="Swat">Swat</option>
												<option value="Swatmingora">Swatmingora</option>
												<option value="Takhtbai">Takhtbai</option>
												<option value="Talagang">Talagang</option>
												<option value="Talamba">Talamba</option>
												<option value="Talhur">Talhur</option>
												<option value="Tall">Tall</option>
												<option value="Tando Adam">Tando Adam</option>
												<option value="Tando Allahyar">Tando Allahyar</option>
												<option value="Tando Jam">Tando Jam</option>
												<option value="Tando Mohd Khan">Tando Mohd Khan</option>
												<option value="Tank">Tank</option>
												<option value="Tarbela">Tarbela</option>
												<option value="Tarmatan">Tarmatan</option>
												<option value="Tarnol">Tarnol</option>
												<option value="Taunsa sharif">Taunsa sharif</option>
												<option value="Taxila">Taxila</option>
												<option value="Thana Bula Khan">Thana Bula Khan</option>
												<option value="Thari Mirwah">Thari Mirwah</option>
												<option value="Tharo Shah">Tharo Shah</option>
												<option value="Tharparkar">Tharparkar</option>
												<option value="Thatta">Thatta</option>
												<option value="Theing Jattan More">Theing Jattan More</option>
												<option value="Thul">Thul</option>
												<option value="Tibba Sultanpur">Tibba Sultanpur</option>
												<option value="Timergara">Timergara</option>
												<option value="Tobatek Singh">Tobatek Singh</option>
												<option value="Topi">Topi</option>
												<option value="Toru">Toru</option>
												<option value="Trinda Mohd Pannah">Trinda Mohd Pannah</option>
												<option value="Turbat">Turbat</option>
												<option value="Ubaro">Ubaro</option>
												<option value="Ugoki">Ugoki</option>
												<option value="Ukba">Ukba</option>
												<option value="Umer Kot">Umer Kot</option>
												<option value="Upper Deval">Upper Deval</option>
												<option value="Upper Dir">Upper Dir</option>
												<option value="Usta Mohammad">Usta Mohammad</option>
												<option value="Utror">Utror</option>
												<option value="Vehari">Vehari</option>
												<option value="Village Sunder">Village Sunder</option>
												<option value="Wah Cantt">Wah Cantt</option>
												<option value="Wahi hassain">Wahi hassain</option>
												<option value="Wan Radha Ram">Wan Radha Ram</option>
												<option value="Wana">Wana</option>
												<option value="Warah">Warah</option>
												<option value="Warburton">Warburton</option>
												<option value="Washuk">Washuk</option>
												<option value="Wazirabad">Wazirabad</option>
												<option value="Yazman Mandi">Yazman Mandi</option>
												<option value="Zahir Pir">Zahir Pir</option>
												<option value="Zhob">Zhob</option>
												<option value="Ziarat">Ziarat</option>
											</select>
											<div id="cityError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-city-error'])){ echo $_SESSION['signup-city-error']; unset($_SESSION['signup-city-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="day" class="col-sm-4 col-xs-12 control-label" id="setFonts">Date of Birth</label>
										<div class="col-sm-2 col-xs-4" style="padding-right:0px">
											<select class="day select2 Day" name="day" id="Day">
												<option value="0">Day</option>
												<option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option>
												<option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option>
												<option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
												<option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option>
												<option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
												<option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option>
												<option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option>
												<option value="29">29</option><option value="30">30</option><option value="31">31</option>
											</select>
										</div>
										<div class="col-sm-2 col-xs-4" style=" padding:0px">
											<select class="select2 Month" name="month" id="Month">
												<option value="0">Month</option>
												<option value="1">01</option><option value="2">02</option><option value="3">03</option>
												<option value="4">04</option><option value="5">05</option><option value="6">06</option>
												<option value="7">07</option><option value="8">08</option><option value="9">09</option>
												<option value="10">10</option><option value="11">11</option><option value="12">12</option>
											</select>
										</div>
										<div class="col-sm-2 col-xs-4" style="padding-left:0px">
											<select class="select2 Year" name="year" id="Year">
												<option value="0">Year</option><option value="2001">2001</option><option value="2000">2000</option>
												<option value="1999">1999</option><option value="1998">1998</option>
												<option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option>
												<option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option>
												<option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option>
												<option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option>
												<option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option>
												<option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option>
												<option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option>
												<option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option>
												<option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option>
												<option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option>
												<option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option>
												<option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option>
												<option value="1961">1961</option><option value="1960">1960</option>
											</select>
										</div>
										<div class="col-lg-4"></div>
										<div class="col-lg-8 col-xs-12" id="dateOfBirthError" style="font-size:12px; color:#BF0000;">
											<?php if(isset($_SESSION['signup-dob-error'])){ echo $_SESSION['signup-dob-error']; unset($_SESSION['signup-dob-error']);} ?>
										</div>
									</div>
									<div class="form-group">
										<label for="language" class="col-sm-4 control-label" id="setFonts">Language</label>
										<div class="col-sm-6">
											<select class="form-control select2 Language" name="language" id="Language">
												<option value="0">Your Language</option>
												<option value="Punjabi" label="Urdu">Urdu</option>
												<option value="Punjabi" label="Punjabi">Punjabi</option>
                                                <option value="Pashto" label="Pashto">Pashto</option>
                                                <option value="Sindhi" label="Sindhi">Sindhi</option>
                                                <option value="Saraiki" label="Saraiki">Saraiki</option>
                                                <option value="Balochi" label="Balochi">Balochi</option>
                                                <option value="Hindko" label="Hindko">Hindko</option>
                                                <option value="English" label="English">English</option>
                                                <option value="Arabic" label="Arabic">Arabic</option>
                                                <option value="Kashmiri" label="Kashmiri">Kashmiri</option>
                                                <option value="Shina" label="Shina">Shina</option>
                                                <option value="Bengali" label="Bengali">Bengali</option>
                                                <option value="Hindi" label="Hindi">Hindi</option>
                                                <option value="Persian" label="Persian">Persian</option>
                                                <option value="Chinese" label="Chinese">Chinese</option>
                                                <option value="Spanish" label="Spanish">Spanish</option>
                                                <option value="French" label="French">French</option>
                                                <option value="Sundanese" label="Sundanese">Sundanese</option>
                                                <option value="Russian" label="Russian">Russian</option>
                                                <option value="Turkish" label="Turkish">Turkish</option>
                                                <option value="Telugu" label="Telugu">Telugu</option>
                                                <option value="Marathi" label="Marathi">Marathi</option>
                                                <option value="Tamil" label="Tamil">Tamil</option>
                                                <option value="Other" label="Other">Other</option>		
											</select>
											<div id="languageError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-language-error'])){ echo $_SESSION['signup-language-error']; unset($_SESSION['signup-language-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"></label>
										<div class="col-sm-6 col-xs-12" id="nextPadding">
											<button type="button" class="button button-ripple btn-block" style="border-radius:3px;"  onClick="form2Script()">
											<span class="button-text-white">Next</span>
											<i class="fa fa-angle-right" style="margin-left:15px"></i></button>
										</div>
										<div class="col-sm-4"></div>
									</div>
									
									<div class="form-group">
										<div class="col-sm-4"></div>
										<div class="col-sm-6" style="text-align:center; font-family:Rubik; font-size:13px">If Already have Account, Then <br> 
											<a rel="canonical" href="login.php">Login Here</a>
										</div>
										<div class="col-sm-4"></div>
									</div>
								</div>

								<!---Block3--->
								<div id="block3" style="display:none; color:#999999">
								<div class="reg-back">
									<div>
									<div class="col-sm-6" id="backPadding">
										<div  class="back-button" onClick="backToPage2()">
											<i class="fas fa-arrow-left" style="margin-right:8px; font-size:20px"></i>
										</div>
									</div>
									</div>
								</div>
								<div class="col-lg-12" style="padding:5px; margin-bottom:10px;">
									<div style="color:#999999; text-align:center; font-family:Rubik; font-size:16px; font-weight:600 ">
									<i class="fas fa-user-graduate" style="margin-right:10px;"></i>
									Your Educational Info</div>
								</div>
									<div class="form-group">
										<label for="education" class="col-sm-4 control-label" id="setFonts">Education</label>
										<div class="col-sm-6">
											<select class="form-control select2 Education" name="education" id="Education">
												<option value="0">Your Education</option>
												<option value="High school" label="High school">High school</option>
												<option value="Diploma" label="Intermediate">Intermediate</option>
												<option value="Diploma" label="Diploma">Diploma</option>
												<option value="Bachelors" label="Bachelors">Bachelors</option>
												<option value="Masters" label="Masters">Masters</option>
												<option value="Doctorate" label="Doctorate">Doctorate</option>
												<option value="Less than high school" label="Less than high school">Less than high school</option>
											</select>
											<div id="educationError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-education-error'])){ echo $_SESSION['signup-education-error']; unset($_SESSION['signup-education-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="profession" class="col-sm-4 control-label" id="setFonts">Profession</label>
										<div class="col-sm-6">
											<select class="form-control select2 Profession" name="profession" id="Profession">
												<option value="0">Your Profession</option>
												<option value="Not Working Yet">Not Working Yet</option>
												<option value="Administrator">Administrator</option>
												<option value="Air Force - Non Officer">Air Force - Non Officer</option>
												<option value="Air Force - Officer" >Air Force - Officer</option>
												<option value="Airline Professional" >Airline Professional</option>
												<option value="Army - Non-officer" >Army - Non-officer</option>
												<option value="Army - Officer" >Army - Officer</option>
												<option value="Artist" >Artist </option>
												<option value="Auditor" >Auditor</option>
												<option value="Author" >Author </option>
												<option value="Automobiles" >Automobiles</option>
												<option value="Banking Service Professional" >Banking Service Professional</option>
												<option value="Beautician" >Beautician</option>
												<option value="Builder" >Builder</option>
												<option value="Chairman" >Chairman</option>
												<option value="Chartered Accountant" >Chartered Accountant</option>
												<option value="Clerk" >Clerk</option>
												<option value="Clothing" >Clothing</option>
												<option value="Company Secretary" >Company Secretary</option>
												<option value="Computers & Electronics" >Computers & Electronics</option>
												<option value="Constructions" >Constructions</option>
												<option value="CXO" >CXO</option>
												<option value="Dawah Activist" >Dawah Activist</option>
												<option value="Director" >Director</option>
												<option value="Doctor - Acupuncture" >Doctor - Acupuncture</option>
												<option value="Doctor - Anesthesiologist" >Doctor - Anesthesiologist</option>
												<option value="Doctor - Cardiologist" >Doctor - Cardiologist</option>
												<option value="Doctor - Dentistry" >Doctor - Dentistry </option>
												<option value="Doctor - Dermatologist" >Doctor - Dermatologist</option>
												<option value="Doctor - General Practice" >Doctor - General Practice </option>
												<option value="Doctor - Gynecologist" >Doctor - Gynecologist </option>
												<option value="Doctor - Herbs" >Doctor - Herbs</option>
												<option value="Doctor - Homeopathy" >Doctor - Homeopathy</option>
												<option value="Doctor - Neurologist" >Doctor - Neurologist</option>
												<option value="Doctor - Obstetrician" >Doctor - Obstetrician </option>
												<option value="Doctor - Ophthalmologist" >Doctor - Ophthalmologist </option>
												<option value="Doctor - Ornithologist" >Doctor - Ornithologist </option>
												<option value="Doctor - Orthodontist" >Doctor - Orthodontist </option>
												<option value="Doctor - Pathologist" >Doctor - Pathologist</option>
												<option value="Doctor - Pediatrician" >Doctor - Pediatrician </option>
												<option value="Doctor - Physiotherapist" >Doctor - Physiotherapist</option>
												<option value="Doctor - Psychiatric" >Doctor - Psychiatric</option>
												<option value="Doctor - Rheumatologist" >Doctor - Rheumatologist</option>
												<option value="Doctor - Surgeon" >Doctor - Surgeon</option>
												<option value="Doctor - Toxicologist" >Doctor - Toxicologist</option>
												<option value="Doctor - Veterinary" >Doctor - Veterinary</option>
												<option value="Driver" >Driver</option>
												<option value="Education" >Education</option>
												<option value="Education Professional" >Education Professional</option>
												<option value="Engineer - Aerospace" >Engineer - Aerospace </option>
												<option value="Engineer - Agricultural" >Engineer - Agricultural</option>
												<option value="Engineer - Architectural" >Engineer - Architectural </option>
												<option value="Engineer - Chemical" >Engineer - Chemical</option>
												<option value="Engineer - Civil" >Engineer - Civil</option>
												<option value="Engineer - Electrical" >Engineer - Electrical</option>
												<option value="Engineer - Electronics" >Engineer - Electronics</option>
												<option value="Engineer - Hardware" >Engineer - Hardware </option>
												<option value="Engineer - Industrial" >Engineer - Industrial</option>
												<option value="Engineer - Materials" >Engineer - Materials</option>
												<option value="Engineer - Mechanical" >Engineer - Mechanical</option>
												<option value="Engineer - Metallurgical" >Engineer - Metallurgical </option>
												<option value="Engineer - Others" >Engineer - Others</option>
												<option value="Engineer - Software" >Engineer - Software</option>
												<option value="Engineer - Structural" >Engineer - Structural </option>
												<option value="Entertainment" >Entertainment</option>
												<option value="Entertainment Professional" >Entertainment Professional</option>
												<option value="Export & Import" >Export & Import</option>
												<option value="Farmer" >Farmer</option>
												<option value="Fashion Designer" >Fashion Designer</option>
												<option value="Financial Services" >Financial Services</option>
												<option value="Fire officer" >Fire officer </option>
												<option value="Flight Attendant" >Flight Attendant</option>
												<option value="Food Sector" >Food Sector</option>
												<option value="Hairdesser" >Hairdesser</option>
												<option value="Health Care Professional" >Health Care Professional</option>
												<option value="Health Sector" >Health Sector</option>
												<option value="Home Maker" >Home Maker</option>
												<option value="Imaam" >Imaam</option>
												<option value="Interior Designer" >Interior Designer</option>
												<option value="Journalist" >Journalist</option>
												<option value="Lawyer" >Lawyer </option>
												<option value="Legal Professional" >Legal Professional</option>
												<option value="Librarian" >Librarian</option>
												<option value="Magistrate" >Magistrate </option>
												<option value="Maid" >Maid </option>
												<option value="Manager" >Manager</option>
												<option value="Mariner / Merchant Navy" >Mariner / Merchant Navy</option>
												<option value="Marketing Professional" >Marketing Professional</option>
												<option value="Media Professional" >Media Professional</option>
												<option value="Merchants" >Merchants</option>
												<option value="Militaryman" >Militaryman</option>
												<option value="Navy - Non Officer" >Navy - Non Officer</option>
												<option value="Navy - Officer" >Navy - Officer</option>
												<option value="Not Working" >Not Working</option>
												<option value="Nurse" >Nurse</option>
												<option value="Office Executive" >Office Executive</option>
												<option value="Others" >Others</option>
												<option value="Paramedical Professional" >Paramedical Professional</option>
												<option value="Pharmacist" >Pharmacist </option>
												<option value="Physician Assistant" >Physician Assistant</option>
												<option value="Pilot" >Pilot</option>
												<option value="Police officer" >Police officer </option>
												<option value="Politician" >Politician</option>
												<option value="President" >President</option>
												<option value="Production Sector" >Production Sector</option>
												<option value="Professor" >Professor </option>
												<option value="Real Estate" >Real Estate</option>
												<option value="Retired" >Retired</option>
												<option value="Sales" >Sales</option>
												<option value="Sales Professional" >Sales Professional</option>
												<option value="Scientist / Researcher" >Scientist / Researcher</option>
												<option value="Security Professional" >Security Professional</option>
												<option value="Self Employed" >Self Employed</option>
												<option value="Service Sector" >Service Sector</option>
												<option value="Singer" >Singer  </option>
												<option value="Social Worker" >Social Worker</option>
												<option value="Software Programmer" >Software Programmer </option>
												<option value="Sportsman" >Sportsman</option>
												<option value="Student" >Student</option>
												<option value="Supervisor" >Supervisor</option>
												<option value="System Administrator" >System Administrator </option>
												<option value="Teacher" >Teacher</option>
												<option value="Technician" >Technician</option>
												<option value="Travel Agent" >Travel Agent</option>
												<option value="Travels" >Travels</option>
												<option value="Other" >Other</option>
											</select>
											<div id="professionError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-profession-error'])){ echo $_SESSION['signup-profession-error']; unset($_SESSION['signup-profession-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="salary" class="col-sm-4 control-label" id="setFonts">Salary</label>
										<div class="col-sm-6">
											<select class="form-control select2 Salary" name="salary" id="Salary">
												<option value="0">Your Salary(per month)</option>
												<option value="15000-30000">PKR 15,000-30,000</option>
												<option value="31000-60000">PKR 31,000-60,000</option>
												<option value="61000-100000">PKR 61,000-100,000</option>
												<option value="100000-200000">PKR 100,000-200,000</option>
												<option value="200000-300000">PKR 200,000-300,000</option>
												<option value="300000-500000">PKR 300,000-500,000</option>
												<option value="600000">PKR above than 500,000</option>
												<option value="Not Earning Yet">Not Earning Yet</option>
												<option value="Not Want to Mention">Not Want to Mention</option>
											</select>
											<div id="salaryError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-salary-error'])){ echo $_SESSION['signup-salary-error']; unset($_SESSION['signup-salary-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="familyType" class="col-sm-4 control-label" id="setFonts">Family Type</label>
										<div class="col-sm-6">
											<select class="form-control select2 FamilyType" name="familyType" id="FamilyType">
												<option value="0">Family Type</option>
												<option value="Joint">Joint</option><option value="Nuclear">Nuclear</option>
											</select>
											<div id="familyTypeError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-familytype-error'])){ echo $_SESSION['signup-familytype-error']; unset($_SESSION['signup-familytype-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="familyValues" class="col-sm-4 control-label" id="setFonts">Family Values</label>
										<div class="col-sm-6">
											<select class="form-control select2 FamilyValues" name="familyValues" id="FamilyValues">
												<option value="0">Family Values</option>
												<option value="Traditional">Traditional</option><option value="Moderate">Moderate </option>
												<option value="Liberal">Liberal</option>
											</select>
											<div id="familyValuesError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-familyvalues-error'])){ echo $_SESSION['signup-familyvalues-error']; unset($_SESSION['signup-familyvalues-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="familyAffluence" class="col-sm-4 control-label" id="setFonts" >Family Class </label>
										<div class="col-sm-6">
											<select class="form-control select2 FamilyAffluence" name="familyAffluence" id="FamilyAffluence">
												<option value="0">Family Affluence</option>
												<option value="Affluent">Affluent</option><option value="Upper Middle Class">Upper Middle Class</option>
												<option value="Middle Class">Middle Class</option><option value="Lower Class">Lower Class</option>
											</select>
											<div id="familyAffluenceError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-familyaffluence-error'])){ echo $_SESSION['signup-familyaffluence-error']; unset($_SESSION['signup-familyaffluence-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"></label>
										<div class="col-sm-6 col-xs-12" id="nextPadding">
											<button type="button" class="button button-ripple btn-block" style="border-radius:3px;"  onClick="form3Script()">
											<span class="button-text-white">Next</span>
											<i class="fa fa-angle-right" style="margin-left:15px"></i></button>
											
										</div>
										<div class="col-sm-4"></div>
									</div>
									
									<div class="form-group">
										<div class="col-sm-4"></div>
										<div class="col-sm-6" style="text-align:center; font-family:Rubik; font-size:13px">If Already have Account, Then <br> 
											<a rel="canonical" href="login.php">Login Here</a>
										</div>
										<div class="col-sm-4"></div>
									</div>
								</div>
								
								<!---Block3_3--->
								<div id="block3_3" style="display:none; color:#999999">
								<div class="reg-back">
										<div>
										<div class="col-sm-6" id="backPadding">
											<div  class="back-button" onClick="backToPage3()">
												<i class="fas fa-arrow-left" style="margin-right:8px; font-size:20px"></i>
											</div>
										</div>
										</div>
									</div>
								<div class="col-lg-12" style="padding:5px; margin-bottom:10px;">
									<div style="color:#999999; text-align:center; font-family:Rubik; font-size:16px; font-weight:600">
									<i class="far fa-user-circle" style="margin-right:10px"></i>Your Religion & clan</div>
								</div>
									<div class="form-group">
										<label for="maritalStatus" class="col-sm-4 col-xs-12 control-label" id="setFonts" >Marital Status</label>
										<div class="col-sm-6">
											<select class="form-control select2 MaritalStatus" name="maritalStatus" id="MaritalStatus">
												<option value="0">Your Marital Status</option>
												<option value="Never Married">Never Married</option><option value="Divorcee">Divorcee</option>
												<option value="Separated">Separated</option><option value="Widow/Widower">Widow/Widower</option>
												<option value="Married">Married</option>
											</select>
											<div id="maritalStatusError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-maritalstatus-error'])){ echo $_SESSION['signup-maritalstatus-error']; unset($_SESSION['signup-maritalstatus-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="clan" class="col-sm-4 col-xs-12 control-label" id="setFonts">Clan</label>
										<div class="col-sm-6">
											<select class="form-control select2 Clan" name="clan" id="Clan">
												<option value="0">Your Clan</option>
												<option value="Punjabi">Punjabi</option>
												<option value="Sindhi">Sindhi</option>
												<option value="Pashtun">Pashtun</option>
												<option value="Baloch">Baloch</option>
												<option value="Saraiki">Saraiki</option>
												<option value="Kashmiri">Kashmiri</option>
												<option value="Gujrati">Gujrati</option>
												<option value="Brohui">Brohui</option>
												<option value="Irani">Irani</option>
												<option value="Irani">Arab</option>
												<option value="Turk">Turk</option>
											</select>
											<div id="clanError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-clan-error'])){ echo $_SESSION['signup-clan-error']; unset($_SESSION['signup-clan-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="caste" class="col-sm-4 control-label" id="setFonts">Caste</label>
										<div class="col-sm-6">
											<select class="form-control select2 Caste" name="caste" id="Caste">
												<option value="0">Your Caste</option>
												<option value="Arain" >Arain</option>
												<option value="Awan" >Awan</option>
												<option value="Bahmani" >Bahmani</option>
												<option value="Bajwa" >Bajwa</option>
												<option value="Bangial" >Bangial</option>
												<option value="Basra" >Basra</option>
												<option value="Baig" >Baig</option>
												<option value="Arain" >Arain</option>
												<option value="Bhabra" >Bhabra</option>
												<option value="Batwal" >Batwal</option>
												<option value="Bhatti" >Bhatti</option>
												<option value="Bhutta" >Bhutta</option>
												<option value="Barsar" >Barsar</option>
												<option value="Buttar" >Buttar</option>
												<option value="Chaudhry" >Chaudhry</option>
												<option value="Chauhan" >Chauhan</option>
												<option value="Chughtai" >Chughtai</option>
												<option value="Derawal" >Derawal</option>
												<option value="Dhariwal" >Dhariwal</option>
												<option value="Dogar" >Dogar</option>
												<option value="Duggal" >Duggal</option>
												<option value="Gakhar" >Gakhar</option>
												<option value="Gill" >Gill</option>
												<option value="Gujjar" >Gujjar</option>
												<option value="Gurmani" >Gurmani</option>
												<option value="Ibrahim" >Ibrahim</option>
												<option value="Jutt" >Jutt</option>
												<option value="Indra" >Indra</option>
												<option value="Jarral" >Jarral</option>
												<option value="Johiya" >Johiya</option>
												<option value="Kathia" >Kathia</option>
												<option value="Kahloon" >Kahloon</option>
												<option value="Kayani" >Kayani</option>
												<option value="Khara" >Khara</option>
												<option value="Khan" >Khan</option>
												<option value="Kharal" >Kharal</option>
												<option value="Khokhar" >Khokhar</option>
												<option value="Kamboh" >Kamboh</option>
												<option value="Kirmani" >Kirmani</option>
												<option value="Sahni" >Sahni</option>
												<option value="Langah" >Langah</option>
												<option value="langra" >langra</option>
												<option value="langrial" >langrial</option>
												<option value="Lau" >Lau</option>
												<option value="Leel" >Leel</option>
												<option value="Lodhra" >Lodhra</option>
												<option value="Longi" >Longi</option>
												<option value="Machi" >Machi</option>
												<option value="Mahar" >Mahar</option>
												<option value="Mahtam" >Mahtam</option>
												<option value="Makhdoom" >Makhdoom</option>
												<option value="Malik" >Malik</option>
												<option value="Meghwar" >Meghwar</option>
												<option value="Meo" >Meo</option>
												<option value="Mian" >Mian</option>
												<option value="Mighiana" >Mighiana</option>
												<option value="Minhas" >Minhas</option>
												<option value="Mughal" >Mughal</option>
												<option value="Muslim Khatris" >Muslim Khatris</option>
												<option value="Rajput" >Rajput</option>
												<option value="Nanda" >Nanda</option>
												<option value="Naqvi" >Naqvi</option>
												<option value="Paracha" >Paracha</option>
												<option value="Parihar" >Parihar</option>
												<option value="Patel" >Patel</option>
												<option value="Passi" >Passi</option>
												<option value="Sheikh (Punjabi)" >Sheikh (Punjabi)</option>
												<option value="Qaimkhani" >Qaimkhani</option>
												<option value="Qureshi" >Qureshi</option>
												<option value="Qazi" >Qazi</option>
												<option value="Rafiq" >Rafiq</option>
												<option value="Rajput" >Rajput</option>
												<option value="Ramay" >Ramay</option>
												<option value="Rana" >Rana</option>
												<option value="Ranjha" >Ranjha</option>
												<option value="Rathore" >Rathore</option>
												<option value="Ranghar" >Ranghar</option>
												<option value="Roy" >Roy</option>
												<option value="Raja" >Raja</option>
												<option value="Sahi clan" >Sahi clan</option>
												<option value="Sangha" >Sangha</option>
												<option value="Satti" >Satti</option>
												<option value="sehgal" >sehgal</option>
												<option value="sukhera" >sukhera</option>
												<option value="Sethi" >Sethi</option>
												<option value="Sirki" >Sirki</option>
												<option value="Sangha" >Sangha</option>
												<option value="sheikh" >sheikh</option>
												<option value="Shanzay" >Shanzay</option>
												<option value="Sial" >Sial</option>
												<option value="Siddiqui" >Siddiqui</option>
												<option value="Singh" >Singh</option>
												<option value="Sidhu" >Sidhu</option>
												<option value="Sandhu" >Sandhu</option>
												<option value="Shah" >Shah</option>
												<option value="Tiwana" >Tiwana</option>
												<option value="Tarar" >Tarar</option>
												<option value="Uzair" >Uzair</option>
												<option value="Virk" >Virk</option>
												<option value="Warraich" >Warraich</option>
												<option value="Bhan" >Bhan</option>
												<option value="Bhatti" >Bhatti</option>
												<option value="Buriro" >Buriro</option>
												<option value="Chachar" >Chachar</option>
												<option value="Chandio" >Chandio</option>
												<option value="Daudpota" >Daudpota</option>
												<option value="Hingora" >Hingora</option>
												<option value="Hingorja" >Hingorja</option>
												<option value="Jogi" >Jogi</option>
												<option value="Junejo" >Junejo</option>
												<option value="Kalhoro" >Kalhoro</option>
												<option value="Kalwar" >Kalwar</option>
												<option value="Khaskheli" >Khaskheli</option>
												<option value="Khuhro" >Khuhro</option>
												<option value="Khushk" >Khushk</option>
												<option value="Kumbhar" >Kumbhar</option>
												<option value="Lakhani" >Lakhani</option>
												<option value="Malak" >Malak</option>
												<option value="Mahesar" >Mahesar</option>
												<option value="Memon" >Memon</option>
												<option value="Mirani" >Mirani</option>
												<option value="Mirbahar" >Mirbahar</option>
												<option value="Mugheri" >Mugheri</option>
												<option value="Nizamani" >Nizamani</option>
												<option value="Panhwar" >Panhwar</option>
												<option value="Rind" >Rind</option>
												<option value="Samejo" >Samejo</option>
												<option value="Samma" >Samma</option>
												<option value="Shah" >Shah</option>
												<option value="Shar" >Shar</option>
												<option value="Sheedi" >Sheedi</option>
												<option value="Siyal" >Siyal</option>
												<option value="Soomro" >Soomro</option>
												<option value="Wagan" >Wagan</option>
												<option value="Achakzai" >Achakzai</option>
												<option value="Afridi" >Afridi</option>
												<option value="Alizai" >Alizai</option>
												<option value="Akakhel" >Akakhel</option>
												<option value="Babar" >Babar</option>
												<option value="Badrashi" >Badrashi</option>
												<option value="Bangash" >Bangash</option>
												<option value="Banuchi" >Banuchi</option>
												<option value="Bettani" >Bettani</option>
												<option value="Burki" >Burki</option>
												<option value="Chamkanni" >Chamkanni</option>
												<option value="Daulat " >Daulat </option>
												<option value="Davi" >Davi</option>
												<option value="Dawar" >Dawar</option>
												<option value="Dilazak" >Dilazak</option>
												<option value="Durrani" >Durrani</option>
												<option value="Ehsan" >Ehsan</option>
												<option value="Gandapur" >Gandapur</option>
												<option value="Isa Khel" >Isa Khel</option>
												<option value="Jadoon" >Jadoon</option>
												<option value="Kakakhel" >Kakakhel</option>
												<option value="Kakar" >Kakar</option>
												<option value="Kakazai" >Kakazai</option>
												<option value="Khalil " >Khalil </option>
												<option value="Kharoti" >Kharoti</option>
												<option value="Khattak" >Khattak</option>
												<option value="Khizarkhel" >Khizarkhel</option>
												<option value="Khakwani" >Khakwani</option>
												<option value="Khudiadadzai" >Khudiadadzai</option>
												<option value="Khulozai" >Khulozai</option>
												<option value="Kuchis" >Kuchis</option>
												<option value="Kundi" >Kundi</option>
												<option value="Loharani" >Loharani</option>
												<option value="Lohani" >Lohani</option>
												<option value="Lodhi" >Lodhi</option>
												<option value="Maghdud Khel" >Maghdud Khel</option>
												<option value="Mahmud Khel" >Mahmud Khel</option>
												<option value="Mahsud" >Mahsud</option>
												<option value="Mamund" >Mamund</option>
												<option value="Marwat" >Marwat</option>
												<option value="Mashwanis" >Mashwanis</option>
												<option value="Musakhel" >Musakhel</option>
												<option value="Miani" >Miani</option>
												<option value="Mandokhel" >Mandokhel</option>
												<option value="Niazi" >Niazi</option>
												<option value="Noorzai" >Noorzai</option>
												<option value="Orakzai" >Orakzai</option>
												<option value="Popalzai" >Popalzai</option>
												<option value="Panni" >Panni</option>
												<option value="Qazi" >Qazi</option>
												<option value="Rouhani" >Rouhani</option>
												<option value="Swati" >Swati</option>
												<option value="Sadduzai" >Sadduzai</option>
												<option value="Salarzai" >Salarzai</option>
												<option value="Sarbani" >Sarbani</option>
												<option value="Shilmani" >Shilmani</option>
												<option value="Kasi" >Kasi</option>
												<option value="Sheikh" >Sheikh</option>
												<option value="Sulemani" >Sulemani</option>
												<option value="Sulemankhel" >Sulemankhel</option>
												<option value="Tareen" >Tareen</option>
												<option value="Tarkani" >Tarkani</option>
												<option value="Tanoli" >Tanoli</option>
												<option value="Tokhi" >Tokhi</option>
												<option value="Turkhel" >Turkhel</option>
												<option value="Umarzai" >Umarzai</option>
												<option value="Uthman khel" >Uthman khel</option>
												<option value="Wazir" >Wazir</option>
												<option value="Wur" >Wur</option>
												<option value="Yousafzai" >Yousafzai</option>
												<option value="Yusaf Khel" >Yusaf Khel</option>
												<option value="Zimri" >Zimri</option>
												<option value="Lashari">Lashari </option>
												<option value="Ashkani" >Ashkani</option>
												<option value="Bahawalanzai" >Bahawalanzai</option>
												<option value="Barazani" >Barazani</option>
												<option value="Barr" >Barr</option>
												<option value="Bijarani" >Bijarani</option>
												<option value="Bugti" >Bugti</option>
												<option value="Buledi" >Buledi</option>
												<option value="Bulfati" >Bulfati</option>
												<option value="Buzdar" >Buzdar</option>
												<option value="Chandio" >Chandio</option>
												<option value="Chhalgari" >Chhalgari</option>
												<option value="Damanis" >Damanis</option>
												<option value="Darzada" >Darzada</option>
												<option value="Dehwar" >Dehwar</option>
												<option value="Domki" >Domki</option>
												<option value="Gujjar" >Gujjar</option>
												<option value="Gabol" >Gabol</option>
												<option value="Gadhi" >Gadhi</option>
												<option value="Gashkori" >Gashkori</option>
												<option value="Ghazini" >Ghazini</option>
												<option value="Gurmani" >Gurmani</option>
												<option value="Jagirani" >Jagirani</option>
												<option value="Jalbani" >Jalbani</option>
												<option value="Jamali" >Jamali</option>
												<option value="Jarwar" >Jarwar</option>
												<option value="Jatoi" >Jatoi</option>
												<option value="Jiskani" >Jiskani</option>
												<option value="Kalmati" >Kalmati</option>
												<option value="Kalpar" >Kalpar</option>
												<option value="Kambarzahi" >Kambarzahi</option>
												<option value="Kashani" >Kashani</option>
												<option value="Kenagzai" >Kenagzai</option>
												<option value="Khalol" >Khalol</option>
												<option value="Khetran" >Khetran</option>
												<option value="Khushk" >Khushk</option>
												<option value="Korai" >Korai</option>
												<option value="Khara" >Khara</option>
												<option value="Langhani" >Langhani</option>
												<option value="Lanjwani" >Lanjwani</option>
												<option value="Loharani" >Loharani</option>
												<option value="Arain" >Lund</option>
												<option value="Marri" >Marri</option>
												<option value="Mazari" >Mazari</option>
												<option value="Magsi" >Magsi</option>
												<option value="Mugheri" >Mugheri</option>
												<option value="Nizamani" >Nizamani</option>
												<option value="Nothazai" >Nothazai</option>
												<option value="Pitafi" >Pitafi</option>
												<option value="Qaisrani" >Qaisrani</option>
												<option value="Qalat" >Qalat</option>
												<option value="Rahija" >Rahija</option>
												<option value="Rahmanzai" >Rahmanzai</option>
												<option value="Rind" >Rind</option>
												<option value="Ravani" >Ravani</option>
												<option value="Sadozai" >Sadozai</option>
												<option value="Saifi" >Saifi</option>
												<option value="Sanjrani" >Sanjrani</option>
												<option value="Sethwi" >Sethwi</option>
												<option value="Shambhani" >Shambhani</option>
												<option value="Sherzai" >Sherzai</option>
												<option value="Shirani" >Shirani</option>
												<option value="Talpur" >Talpur</option>
												<option value="Umrani" >Umrani</option>
												<option value="Wadeyla" >Wadeyla</option>
												<option value="Zardari" >Zardari</option>
												<option value="Ansari" >Ansari</option>
												<option value="Arain" >Arain</option>
												<option value="Bhait" >Bhait</option>
												<option value="Bhait" >Bhait</option>
												<option value="Bhangar" >Bhangar</option>
												<option value="Bukhari" >Bukhari</option>
												<option value="Chandio" >Chandio</option>
												<option value="Chughtai" >Chughtai</option>
												<option value="Hashmi" >Hashmi</option>
												<option value="Kalwar" >Kalwar</option>
												<option value="Khokhar" >Khokhar</option>
												<option value="Khoso" >Khoso</option>
												<option value="Laar" >Laar</option>
												<option value="Langah" >Langah</option>
												<option value="Lodhra" >Lodhra</option>
												<option value="Makhdoom" >Makhdoom</option>
												<option value="Noon" >Noon</option>
												<option value="Panwar" >Panwar</option>
												<option value="Qureshi" >Qureshi</option>
												<option value="Rind" >Rind</option>
												<option value="Ravani" >Ravani</option>
												<option value="Raronjah" >Raronjah</option>
												<option value="Sipra" >Sipra</option>
												<option value="Soomro" >Soomro</option>
												<option value="Mir " >Mir </option>
												<option value="Dar" >Dar</option>
												<option value="Kashmiri Shaikh" >Kashmiri Shaikh</option>
												<option value="Khan" >Khan</option>
												<option value="Lone" >Lone</option>
												<option value="Butt" >Butt</option>
												<option value="Malik clan (Kashmir)" >Malik clan (Kashmir)</option>
												<option value="Wani" >Wani</option>
												<option value="Alpial" >Alpial</option>
												<option value="Bhatia" >Bhatia</option>
												<option value="Gabol" >Gabol</option>
												<option value="Goraya" >Goraya</option>
												<option value="Hiraj" >Hiraj</option>
												<option value="Karlal" >Karlal</option>
												<option value="Kathia" >Kathia</option>
												<option value="Khatana" >Khatana</option>
												<option value="Khloro" >Khloro</option>
												<option value="Kohli" >Kohli</option>
												<option value="Malhotra" >Malhotra</option>
												<option value="Memon" >Memon</option>
												<option value="Patel" >Patel</option>
												<option value="Wassan" >Wassan</option>
												<option value="Bangulzai" >Bangulzai</option>
												<option value="Bizenjo" >Bizenjo</option>
												<option value="Bahrani" >Bahrani</option>
												<option value="Hasni" >Hasni</option>
												<option value="Jhalawan" >Jhalawan</option>
												<option value="Khan-e-Qalat" >Khan-e-Qalat</option>
												<option value="Kharal" >Kharal</option>
												<option value="Kurd" >Kurd</option>
												<option value="Lango" >Lango</option>
												<option value="Lehri" >Lehri</option>
												<option value="Mirwani" >Mirwani</option>
												<option value="Mengal" >Mengal</option>
												<option value="Muhammad Shahi" >Muhammad Shahi</option>
												<option value="Raisani" >Raisani</option>
												<option value="Rodini" >Rodini</option>
												<option value="Sarpara" >Sarpara</option>
												<option value="Sasooli" >Sasooli</option>
												<option value="Shahwani" >Shahwani</option>
												<option value="Sumalani" >Sumalani</option>
												<option value="Sudhan" >Sudhan</option>
												<option value="Gujjar" >Gujjar</option>
												<option value="Rajput" >Rajput</option>
												<option value="Syed" >Syed</option>
												<option value="Khawaja" >Khawaja</option>
												<option value="Baig" >Baig</option>
												<option value="Maldyal" >Maldyal</option>
												<option value="Ansari" >Ansari</option>
												<option value="Bukhari" >Bukhari</option>
												<option value="Chishti" >Chishti</option>
												<option value="Fareedi" >Fareedi</option>
												<option value="Firdausi" >Firdausi</option>
												<option value="Gardezi" >Gardezi</option>
												<option value="Ghazali" >Ghazali</option>
												<option value="Gilani" >Gilani</option>
												<option value="Hamadani" >Hamadani</option>
												<option value="Hameed" >Hameed</option>
												<option value="Isfahani" >Isfahani</option>
												<option value="Jadgal" >Jadgal</option>
												<option value="Jafari" >Jafari</option>
												<option value="Jalali" >Jalali</option>
												<option value="Jamshidi" >Jamshidi</option>
												<option value="Kashani" >Kashani</option>
												<option value="Khorasani" >Khorasani</option>
												<option value="Kermani" >Kermani</option>
												<option value="Askari" >Askari</option>
												<option value="Mirza" >Mirza</option>
												<option value="Montazeri" >Montazeri</option>
												<option value="Muker" >Muker</option>
												<option value="Nishapuri" >Nishapuri</option>
												<option value="Noorani" >Noorani</option>
												<option value="Pirzada" >Pirzada</option>
												<option value="Qadiri" >Qadiri</option>
												<option value="Qizilbash" >Qizilbash</option>
												<option value="Razavi" >Razavi</option>
												<option value="Reza" >Reza</option>
												<option value="Rizvi" >Rizvi</option>
												<option value="Shirazi" >Shirazi</option>
												<option value="Sistani" >Sistani</option>
												<option value="Yazdani" >Yazdani</option>
												<option value="Zain" >Zain</option>
												<option value="Zand" >Zand</option>
												<option value="Abidi" >Abidi</option>
												<option value="Alvi" >Alvi</option>
												<option value="Barelvi" >Barelvi</option>
												<option value="Bukhari" >Bukhari</option>
												<option value="Baqri" >Baqri</option>
												<option value="Dhanial" >Dhanial</option>
												<option value="Farooqi" >Farooqi</option>
												<option value="Ghazali" >Ghazali</option>
												<option value="Hashmi" >Hashmi</option>
												<option value="Hassan" >Hassan</option>
												<option value="Hussain" >Hussain</option>
												<option value="Hussaini" >Hussaini</option>
												<option value="Hyderi" >Hyderi</option>
												<option value="Idrisi" >Idrisi</option>
												<option value="Kazmi" >Kazmi</option>
												<option value="Khagga" >Khagga</option>
												<option value="Makhdoom" >Makhdoom</option>
												<option value="Mousavi" >Mousavi</option>
												<option value="Masood" >Masood</option>
												<option value="Naqvi" >Naqvi</option>
												<option value="Najafi" >Najafi</option>
												<option value="Osmani" >Osmani</option>
												<option value="Sadat" >Sadat</option>
												<option value="Saifi" >Saifi</option>
												<option value="Sajjadi" >Sajjadi</option>
												<option value="Salehi" >Salehi</option>
												<option value="Sayyid" >Sayyid</option>
												<option value="Shaikh" >Shaikh</option>
												<option value="Siddiqui" >Siddiqui</option>
												<option value="Taqvi" >Taqvi</option>
												<option value="Tirmizi" >Tirmizi</option>
												<option value="Turabi" >Turabi</option>
												<option value="Usmani" >Usmani</option>
												<option value="Wasti" >Wasti</option>
												<option value="Zubairi" >Zubairi</option>
												<option value="Zaidi" >Zaidi</option>
												<option value="Agha" >Agha</option>
												<option value="Baig" >Baig</option>
												<option value="Barlas" >Barlas</option>
												<option value="Chagatai" >Chagatai</option>
												<option value="Dogar" >Dogar</option>
												<option value="Effendi" >Effendi</option>
												<option value="Gul" >Gul</option>
												<option value="Mirza" >Mirza</option>
												<option value="Pasha" >Pasha</option>
												<option value="Saadi" >Saadi</option>
											</select>
											<div id="casteError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-caste-error'])){ echo $_SESSION['signup-caste-error']; unset($_SESSION['signup-caste-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="religion" class="col-sm-4 control-label" id="setFonts">Religion</label>
										<div class="col-sm-6">
											<select class="form-control select2 Religion" name="religion" id="Religion">
												<option value="0">Your Religion</option>
												<option value="Just a muslim" label="Just a Muslim">Just a Muslim</option>
												<option value="Brailvi" label="Brailvi">Brailvi</option>
												<option value="Deobandi" label="Deobandi">Deobandi</option>
												<option value="Wahabi" label="Wahabi">Wahabi</option>
												<option value="Abbasi" label="Abbasi">Abbasi</option>
												<option value="Shia" label="Shia">Shia</option>
												<option value="Hindu" label="Hindu">Hindu</option>
												<option value="Parsi" label="Parsi">Parsi</option>
											</select>
											<div id="religionError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-religion-error'])){ echo $_SESSION['signup-religion-error']; unset($_SESSION['signup-religion-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"></label>
										<div class="col-sm-6 col-xs-12" id="nextPadding">
											<button type="button" class="button button-ripple btn-block" style="border-radius:3px;"  onClick="form3_3Script()">
											<span class="button-text-white">Next</span>
											<i class="fa fa-angle-right" style="margin-left:15px"></i></button>
										</div>
										<div class="col-sm-4"></div>
									</div>
									
									<div class="form-group">
										<div class="col-sm-4"></div>
										<div class="col-sm-6" style="text-align:center; font-family:Rubik; font-size:13px">If Already have Account, Then <br> 
											<a rel="canonical" href="login.php">Login Here</a>
										</div>
										<div class="col-sm-4"></div>
									</div>
								</div>
						
								<!---Block4--->
								<div id="block4" style="display:none; color:#999999">
								<div class="reg-back">
									<div>
									<div class="col-sm-6" id="backPadding">
										<div  class="back-button" onClick="backToPage3_3()">
											<i class="fas fa-arrow-left" style="margin-right:8px; font-size:20px"></i>
										</div>
									</div>
									</div>
								</div>
								<div class="col-lg-12" style="padding:5px; margin-bottom:10px;">
									<div style="color:#999999; text-align:center; font-family:Rubik; font-size:16px; font-weight:600">
										<i class="fas fa-male" style="margin-right:10px; "></i>
										Your Personaility Info
									</div>
								</div>
									<div class="form-group">
										<label for="height" class="col-sm-4 control-label" id="setFonts">Height</label>
										<div class="col-sm-6">
											<select class="form-control select2 Height" name="height" id="Height">
												<option value="0">Height (in feet)</option>
												<option value="4.5">4.5 ft</option>
												<option value="4.6">4.6 ft</option>
												<option value="4.7">4.7 ft</option>
												<option value="4.8">4.8 ft</option>
												<option value="4.9">4.9 ft</option>
												<option value="4.10">4.10 ft</option>
												<option value="4.11">4.11 ft</option>
												<option value="5.0">5.0 ft</option>
												<option value="5.1">5.1 ft</option>
												<option value="5.2">5.2 ft</option>
												<option value="5.3">5.3 ft</option>
												<option value="5.4">5.4 ft</option>
												<option value="5.5">5.5 ft</option>
												<option value="5.6">5.6 ft</option>
												<option value="5.7">5.7 ft</option>
												<option value="6.8">6.8 ft</option>
												<option value="5.9">5.9 ft</option>
												<option value="5.10">5.10 ft</option>
												<option value="5.11">5.11 ft</option>
												<option value="6.0">6.0 ft</option>
												<option value="6.1">6.1 ft</option>
												<option value="6.2">6.2 ft</option>
												<option value="6.3">6.3 ft</option>
												<option value="6.4">6.4 ft</option>
												<option value="6.5">6.5 ft</option>
												<option value="6.6">6.6 ft</option>
												<option value="6.7">6.7 ft</option>
												<option value="6.8">6.8 ft</option>
												<option value="6.9">6.9 ft</option>
												<option value="6.10">6.10 ft</option>
												<option value="6.11">6.11 ft</option>
												<option value="7.0">7.0 ft</option>
											</select>
											<div id="heightError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-height-error'])){ echo $_SESSION['signup-height-error']; unset($_SESSION['signup-height-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="complexion" class="col-sm-4 control-label" id="setFonts">Skin Color</label>
										<div class="col-sm-6">
											<select class="form-control select2 Complexion" name="complexion" id="Complexion">
												<option value="0">Your Skin Color</option>
												<option value="Brown">Brown</option><option value="White">White</option>
												<option value="Dark">Dark</option>
											</select>
											<div id="complexionError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-complexion-error'])){ echo $_SESSION['signup-complexion-error']; unset($_SESSION['signup-complexion-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="bodyType" class="col-sm-4 control-label" id="setFonts">Body Type</label>
										<div class="col-sm-6">
											<select class="form-control select2 BodyType" name="bodyType" id="BodyType">
												<option value="0">Your Body Type</option>
												<option value="Aethlit">Aethlit</option>
												<option value="Slim">Slim</option>
												<option value="Avarage">Avarage</option>
												<option value="Heavy">Heavy</option>
											</select>
											<div id="bodyTypeError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-bodytype-error'])){ echo $_SESSION['signup-bodytype-error']; unset($_SESSION['signup-bodytype-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="hobby" class="col-sm-4 control-label" id="setFonts">Hobby</label>
										<div class="col-sm-6">
											<select class="form-control select2 Hobby" name="hobby" id="Hobby">
												<option value="0">Your Hobby</option>
												<option value="Acting" >Acting</option>
												<option value="Astronomy" >Astronomy</option>
												<option value="Astrology" >Astrology</option>
												<option value="Art / handicraft" >Art / handicraft</option>
												<option value="Collectibles" >Collectibles</option>
												<option value="Cooking" >Cooking</option>
												<option value="Crosswords" >Crosswords</option>
												<option value="Dancing" >Dancing</option>
												<option value="Film-making" >Film-making</option>
												<option value="Fishing" >Fishing</option>
												<option value="Gardening/ landscaping" >Gardening/ landscaping</option>
												<option value="Graphology" >Graphology</option>
												<option value="Nature" >Nature</option>
												<option value="Numerology" >Numerology</option>
												<option value="Painting" >Painting</option>
												<option value="Palmistry" >Palmistry</option>
												<option value="Pets" >Pets</option>
												<option value="Photography" >Photography</option>
												<option value="Playing musical instruments" >Playing musical instruments</option>
												<option value="Puzzles" >Puzzles</option>
												<option value="Sports" >Sports</option>
												<option value="Adventure sports" >Adventure sports</option>
												<option value="Book clubs" >Book clubs</option>
												<option value="Computer games" >Computer games</option>
												<option value="Health & fitness" >Health & fitness</option>
												<option value="Internet" >Internet</option>
												<option value="Learning new languages" >Learning new languages</option>
												<option value="Movies" >Movies</option>
												<option value="Music" >Music</option>
												<option value="Politics" >Politics</option>
												<option value="Reading" >Reading</option>
												<option value="Social service" >Social service</option>
												<option value="Sports" >Sports</option>
												<option value="Television" >Television</option>
												<option value="Theatre" >Theatre</option>
												<option value="Travel" >Travel</option>
												<option value="Writing" >Writing</option>
												<option value="Yoga" >Yoga</option>
												<option value="Alternative healing / medicine" >Alternative Healing / Medicine</option>
											</select>
											<div id="hobbyError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-hobby-error'])){ echo $_SESSION['signup-hobby-error']; unset($_SESSION['signup-hobby-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="disability" class="col-sm-4 control-label" id="setFonts">Physical Disability</label>
										<div class="col-sm-6">
											<select class="form-control select2 Disability" name="disability" id="Disability">
												<option>No</option><option>Yes. Physically Disabled</option>
											</select>
											<div id="disabilityError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-disability-error'])){ echo $_SESSION['signup-disability-error']; unset($_SESSION['signup-disability-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Write About Youself</label>
										<div class="col-sm-6">
											<textarea class="form-control" id="aboutYourself" name="aboutYourself" title="write about yourself"
											style="resize:vertical" rows="2" onBlur="AboutYourself()" onKeyUp="countChar()" placeholder="write something about yourself"></textarea>
											<div id="explainYourselfError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-about-error'])){ echo $_SESSION['signup-about-error']; unset($_SESSION['signup-about-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"></label>
										<div class="col-sm-6 col-xs-12" id="nextPadding">
											<button type="button" class="button button-ripple btn-block" style="border-radius:3px;"  onClick="form4Script()">
											<span class="button-text-white">Next</span>
											<i class="fa fa-angle-right" style="margin-left:15px"></i></button>
										</div>
										<div class="col-sm-4"></div>
									</div>
									
									<div class="form-group">
										<div class="col-sm-4"></div>
										<div class="col-sm-6" style="text-align:center; font-family:Rubik; font-size:13px">If Already have Account, Then <br> 
											<a rel="canonical" href="login.php">Login Here</a>
										</div>
										<div class="col-sm-4"></div>
									</div>
								</div>
								
								<!---BLock5--->
								<div id="block5" style="display:none; color:#999999">
								<div class="reg-back">
									<div>
										<div class="col-sm-6" id="backPadding">
											<div  class="back-button skip-form1" onClick="backToPage4()">
												<i class="fas fa-arrow-left" style="margin-right:8px; font-size:20px"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12" style="padding:5px; margin-bottom:10px;">
									<div style="color:#999999; text-align:center; font-family:Rubik; font-size:16px; font-weight:600">
									<i class="far fa-images" style="margin-right:10px"></i>One Last Thing </div>
								</div>
									<div class="row">
										<div class="col-lg-3"></div>
										<div class="col-lg-6">
											<p style="text-align:center; font-weight:bold; font-size:16px">
												Upload Your Profile Picture<br>
												<span style="font-size:11px; font-weight:normal">You can set privacy on image (public / private)</span>
											</p>
										</div>
										<div class="col-lg-3"></div>
									</div>
									<div class="form-group" style="margin-top:10px;">
										<div class="col-lg-4 col-sm-4 col-xs-12" style="padding:10px; text-align:center">
											<label for="uploadProfilePicture" class="btn btn-default">
												<div class="thumbnail" style="height:165px; width:150px; margin-left:auto; margin-right:auto; ">
														<img src="assets/allpics/male4.jpg" style="height:155px; width:140px; border-radius:2px" id="imageChanged" alt="Male">
														<input type="file" style="display:none" id="uploadProfilePicture" 
														name="uploadProfilePicture" onChange="imageDetails(this)">
												</div>
												<p style="font-size:14px; font-family:'Segoe UI'; font-weight:600; margin-top:-10px">Upload Picture</p>
											</label><p style="font-size:12px; font-family:'Segoe UI'; color:#999999; margin-top:4px">
											Max size limit: 3 MB<br>Formats: JPG, PNG & JPEG</p>
										</div>
										<div class="col-lg-4 col-sm-4 col-xs-12" id="arrowPadding">
											<img id="arrowRight" src="assets/allpics/white-arrow-transparent-png-22.png" style="height:100px; width:100px; " alt="Arrow">
											<img id="arrowDown" src="assets/allpics/white-arrow-down.png" style="height:100px; width:100px;" alt="Arrow">
										</div>
										<div class="col-lg-4 col-sm-4 col-xs-12" style="padding:10px;">
											<div style="border:1px solid #CCCCCC; border-radius:5px; padding-left:14px; padding-top:10px; height:220px; width:180px; 
														margin-left:auto; margin-right:auto;text-align:center">
												<div class="thumbnail" style="height:150px; width:150px">
														<img src="assets/allpics/transparent-background.jpg" style="height:140px; width:140px;" id="hidePng" alt="Tranparent">
												</div>
												<div style="font-size:12px; color:#408080; text-align:center; margin-bottom:15px; padding-right:15px">
													<select name="publicProfile" id="publicProfile" class="form-control-img" > 
														<option value="Public">Public Image</option><option value="Private">Private Image</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<div id="detailsOfProfile" style="color:#92b558"></div>
											<div id="ImageLarger" style="color:#FF0000"></div>
										</div>
									</div>
									<div class="col-lg-12">
											<p id="uploadProfilePictureError" style="font-size:12px; color:#BF0000; text-align:center; font-weight:600; font-family:'Segoe UI'">
												<?php if(isset($_SESSION['signup-profilepicture-error'])){ echo $_SESSION['signup-profilepicture-error']; unset($_SESSION['signup-profilepicture-error']);} ?>
											</p>
										</div>
									<div class="form-group" style="padding:0px">
										<div class="col-sm-12" id="signUpButton">
											<button type="button" class="button button-ripple btn-block" onClick="form5Script()" style="border-radius:3px;">
											<span class="button-text-white">Create Account</span>
											</button>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-sm-12" style="text-align:center; font-family:Rubik; font-size:13px">If Already have Account, Then <br> 
											<a rel="canonical" href="login.php">Login Here</a>
										</div>
									</div>
								</div>

								
								<!---Block7--->
								<div id="block7" style="display:none; color:#999999">
								<div class="reg-back">
									<div>
										<div class="col-sm-6" id="backPadding">
											<div  class="back-button skip-form1" onClick="backToPage7()">
												<i class="fas fa-arrow-left" style="margin-right:8px; font-size:20px"></i>
											</div>
										</div>
									</div>
									<div>
										<div class="skip-form2"  onClick="SkipFamily()">
											Skip This step
										</div>
									</div>
								</div>
								<div class="col-lg-12" style="padding:5px; margin-bottom:10px;">
									<div style="color:#999999; text-align:center; font-family:Rubik; font-size:16px; font-weight:600">
									<i class='fas fa-users' style=" margin-right:10px;"></i>
									Your Family Values</div>
								</div>			
									<div class="form-group">
										<label for="fatherStatus" class="col-sm-4 control-label" id="setFonts">Father Status</label>
										<div class="col-sm-6">
											<select class="form-control select2 FatherStatus" name="fatherStatus" id="FatherStatus">
												<option value="0">Father Status</option>
												<option value="Employed">Employed</option>
												<option value="Bussiness">Bussiness</option>
												<option value="Retired">Retired</option>
												<option value="Not Employed">Not Employed</option>
												<option value="Passed Away">Passed Away</option>
											</select>
											<div id="fatherStatusError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-fatherstatus-error'])){ echo $_SESSION['signup-fatherstatus-error']; unset($_SESSION['signup-fatherstatus-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="motherStatus" class="col-sm-4 control-label" id="setFonts">Mother Status</label>
										<div class="col-sm-6">
											<select class="form-control select2 MotherStatus" name="motherStatus" id="MotherStatus">
												<option value="0">Mother Status</option>
												<option value="Homemaker">Homemaker</option><option value="Employed">Employed</option>
												<option value="Bussiness">Bussiness</option><option value="Retired">Retired</option>
												<option value="Passed Away">Passed Away</option>
											</select>
											<div id="motherStatusError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-motherstatus-error'])){ echo $_SESSION['signup-motherstatus-error']; unset($_SESSION['signup-motherstatus-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="noOfBrothers" class="col-sm-4 control-label" id="setFonts">No of Brothers</label>
										<div class="col-sm-6">
											<select class="form-control select2 NoOfBrothers" name="noOfBrothers" id="NoOfBrothers">
												<option value="0">No of Brothers</option>
												<option value="no">0</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="5">5+</option>
											</select>
											<div id="noOfBrothersError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-noofbrothers-error'])){ echo $_SESSION['signup-noofbrothers-error']; unset($_SESSION['signup-noofbrothers-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="noOfSisters" class="col-sm-4 control-label" id="setFonts">No of Sisters</label>
										<div class="col-sm-6">
											<select class="form-control select2 NoOfSisters" name="noOfSisters" id="NoOfSisters">
												<option value="0">No of Sisters</option>
												<option value="no" >0</option>
												<option value="1" >1</option>
												<option value="2" >2</option>
												<option value="3" >3</option>
												<option value="4" >4</option>
												<option value="5" >5</option>
												<option value="5+" >5+</option>
											</select>
											<div id="noOfSistersError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-noofsisters-error'])){ echo $_SESSION['signup-noofsisters-error']; unset($_SESSION['signup-noofsisters-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"></label>
										<div class="col-sm-6 col-xs-12" id="nextPadding">
											<button type="button" class="button button-ripple btn-block" style="border-radius:3px;"  onClick="form7Script()">
											<span class="button-text-white">Next</span>
											<i class="fa fa-angle-right" style="margin-left:15px"></i></button>
											
										</div>
										<div class="col-sm-4"></div>
									</div>
									
									<div class="form-group">
										<div class="col-sm-4"></div>
										<div class="col-sm-6" style="text-align:center; font-family:Rubik; font-size:13px">If Already have Account, Then <br> 
											<a rel="canonical" href="login.php">Login Here</a>
										</div>
										<div class="col-sm-4"></div>
									</div>
								</div>

								<!---Block8--->
								<div id="block8" class="block8Padding">
								<div class="reg-back">
									<div>
										<div class="col-sm-6" id="backPadding">
											<div  class="back-button skip-form1" onClick="backToPage8()">
												<i class="fas fa-arrow-left" style="margin-right:8px; font-size:20px"></i>
											</div>
										</div>
									</div>
									<div>
										<div class="skip-form2"  onClick="SkipPartner()">
											Skip This step
										</div>
									</div>
								</div>
								<div class="col-lg-12" style="padding:5px; margin-bottom:20px;">
									<div id="partnerPreferenceFontSize">
										<i class='fas fa-user-friends' style=" margin-right:10px; ">
										</i>
									<span data-toggle="tooltip" data-placement="bottom" 
										title="What's in your mind about your dream partner?&#013;Tell what type of rishta you are looking for?&#013;Choose from the followings and write something!">
										Your Partner Prefrences
										<br>
									</span>
									</div>
								</div>
									<div class="form-group">
										<label for="partnerMaritalStatus" class="col-sm-4 control-label" id="setFonts">M-Status</label>
										<div class="col-sm-6">
											<select class="form-control select2  pp PartnerMaritalStatus" name="partnerMaritalStatus" id="PartnerMaritalStatus">
												<option value="0">select marital status</option>
												<option value="Never Married">Never Married</option><option value="Divorcee">Divorcee</option>
												<option value="Separated">Separated</option><option value="Widow/Widower">Widow/Widower</option>
												<option value="Does Not Matters">Does Not Matters</option>
											</select>
											<div id="partnerMaritalStatusError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-pmaritalstatus-error'])){ echo $_SESSION['signup-pmaritalstatus-error']; unset($_SESSION['signup-pmaritalstatus-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="partnerAge" class="col-sm-4 col-xs-12 control-label" id="setFonts">Age</label>
										<div class="col-sm-6">
											<select class="form-control select2  pp PartnerAge" name="partnerAge" id="PartnerAge">
												<option value="0">select age group</option>
												<option value="18-24 Years">18-24 years</option><option value="25-30 Years">25-30 years</option>
												<option value="31-40 Years">31-40 years</option><option value="41-50 Years">41-50 years</option>
												<option value="51-60 Years">51-60 years</option><option value="60+ Years">60+ years</option>
												<option value="Does Not Matters">Does Not Matters</option>
											</select>
											<div id="partnerAgeError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-page-error'])){ echo $_SESSION['signup-page-error']; unset($_SESSION['signup-page-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="partnerHeight" class="col-sm-4 col-xs-12 control-label" id="setFonts">Height</label>
										<div class="col-sm-6">
											<select class="form-control select2  pp PartnerHeight" name="partnerHeight" id="PartnerHeight">
												<option value="0">select height range(in feet)</option>
												<option value="4.1ft - 4.5ft">4.1ft - 4.5ft</option>
												<option value="4.6ft - 5.0ft">4.6ft - 5.0ft</option>
												<option value="5.1ft - 5.5ft">5.1ft - 5.5ft</option>
												<option value="5.6ft - 6.0ft">5.6ft - 6.0ft</option>
												<option value="6.1ft or above">6.1ft or above</option>
												<option value="Does Not Matters">Does Not Matters</option>
											</select>
											<div id="partnerHeightError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-pheight-error'])){ echo $_SESSION['signup-pheight-error']; unset($_SESSION['signup-pheight-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="partnerReligion" class="col-sm-4 col-xs-12 control-label" id="setFonts">Religion</label>
										<div class="col-sm-6">
											<select class="form-control select2  pp PartnerReligion" name="partnerReligion" id="PartnerReligion">
												<option value="0">select religion preference</option>
												<option value="Just a muslim" label="Just a Muslim">Just a Muslim</option>
												<option value="Brailvi" label="Brailvi">Brailvi</option>
												<option value="Deobandi" label="Deobandi">Deobandi</option>
												<option value="Wahabi" label="Wahabi">Wahabi</option>
												<option value="Abbasi" label="Abbasi">Abbasi</option>
												<option value="Shia" label="Shia">Shia</option>
												<option value="Hindu" label="Hindu">Hindu</option>
												<option value="Parsi" label="Parsi">Parsi</option>
												<option value="Does Not Matters" label="Does Not Matters">Does not Matters</option>
											</select>
											<div id="partnerReligionError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-preligion-error'])){ echo $_SESSION['signup-preligion-error']; unset($_SESSION['signup-preligion-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="partnerLanguage" class="col-sm-4 col-xs-12 control-label" id="setFonts">Language</label>
										<div class="col-sm-6">
											<select class="form-control select2  pp PartnerLanguage" name="partnerLanguage" id="PartnerLanguage">
												<option value="0">select language preference</option>
												<option value="Urdu" label="Urdu">Urdu</option>
												<option value="Punjabi" label="Punjabi">Punjabi</option>
                                                <option value="Pashto" label="Pashto">Pashto</option>
                                                <option value="Sindhi" label="Sindhi">Sindhi</option>
                                                <option value="Saraiki" label="Saraiki">Saraiki</option>
                                                <option value="Balochi" label="Balochi">Balochi</option>
                                                <option value="Hindko" label="Hindko">Hindko</option>
                                                <option value="English" label="English">English</option>
                                                <option value="Arabic" label="Arabic">Arabic</option>
                                                <option value="Kashmiri" label="Kashmiri">Kashmiri</option>
                                                <option value="Shina" label="Shina">Shina</option>
                                                <option value="Bengali" label="Bengali">Bengali</option>
                                                <option value="Hindi" label="Hindi">Hindi</option>
                                                <option value="Persian" label="Persian">Persian</option>
                                                <option value="Chinese" label="Chinese">Chinese</option>
                                                <option value="Spanish" label="Spanish">Spanish</option>
                                                <option value="French" label="French">French</option>
                                                <option value="Sundanese" label="Sundanese">Sundanese</option>
                                                <option value="Russian" label="Russian">Russian</option>
                                                <option value="Turkish" label="Turkish">Turkish</option>
                                                <option value="Telugu" label="Telugu">Telugu</option>
                                                <option value="Marathi" label="Marathi">Marathi</option>
                                                <option value="Tamil" label="Tamil">Tamil</option>
                                                <option value="Other" label="Other">Other</option>	
												<option value="Does Not Matters" label="Does Not Matters">Does Not Matters</option>	
											</select>
											<div id="partnerLanguageError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-planguage-error'])){ echo $_SESSION['signup-planguage-error']; unset($_SESSION['signup-planguage-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="partnerEducation" class="col-sm-4 col-xs-12 control-label" id="setFonts">Education</label>
										<div class="col-sm-6">
											<select class="form-control select2  pp PartnerEducation" name="partnerEducation" id="PartnerEducation">
												<option value="0">select education preference</option>
												<option value="Matric or Less" label="Matric or Less">Matric or Less</option>
												<option value="Intermediate" label="Intermediate">Intermediate (12 years)</option>
												<option value="Diploma (13 Years)" label="Diploma (13 Years)">Diploma (13 Years)</option>
												<option value="Bachelors (14 years)" label="Bachelors (14 years)">Bachelors (14 years)</option>
												<option value="Bachelors (16 years)" label="Bachelors (16 years)">Bachelors (16 years)</option>
												<option value="Masters" label="Masters">Masters</option>
												<option value="Doctorate" label="Doctorate">Doctorate</option>
												<option value="Does Not Matters">Does Not Matters</option>	
											</select>
											<div id="partnerEducationError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-peducation-error'])){ echo $_SESSION['signup-peducation-error']; unset($_SESSION['signup-peducation-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="partnerComplexion" class="col-sm-4 col-xs-12 control-label" id="setFonts">Skin Tone</label>
										<div class="col-sm-6">
											<select class="form-control select2  pp PartnerComplexion" name="partnerComplexion" id="PartnerComplexion">
												<option value="0">select skin-color preference</option>
												<option value="Brown">Brown</option><option value="White">White</option>
												<option value="Dark">Dark</option>
												<option value="Does Not Matters" label="Does Not Matters">Does Not Matters</option>	
											</select>
											<div id="partnerComplexionError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-pcomlexion-error'])){ echo $_SESSION['signup-pcomlexion-error']; unset($_SESSION['signup-pcomlexion-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="partnerClan" class="col-sm-4 col-xs-12 control-label" id="setFonts">Clan</label>
										<div class="col-sm-6">
											<select class="form-control select2  pp PartnerClan" name="partnerClan" id="PartnerClan">
												<option value="0">select clan preference</option>
												<option value="Punjabi">Punjabi</option>
												<option value="Sindhi">Sindhi</option>
												<option value="Pashtun">Pashtun</option>
												<option value="Baloch">Baloch</option>
												<option value="Saraiki">Saraiki</option>
												<option value="Kashmiri">Kashmiri</option>
												<option value="Gujrati">Gujrati</option>
												<option value="Brohui">Brohui</option>
												<option value="Irani">Irani</option>
												<option value="Irani">Arab</option>
												<option value="Turk">Turk</option>
												<option value="Does Not Matters" label="Does Not Matters">Does Not Matters</option>	
											</select>
											<div id="partnerClanError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-pclan-error'])){ echo $_SESSION['signup-pclan-error']; unset($_SESSION['signup-pclan-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="partnerFamilyAffluence" class="col-sm-4 col-xs-12 control-label" id="setFonts">Family Class</label>
										<div class="col-sm-6">
											<select class="form-control select2  pp PartnerFamilyAffluence" name="partnerFamilyAffluence" id="PartnerFamilyAffluence">
												<option value="0">select family class</option>
												<option value="Affluent">Affluent</option><option value="Upper Middle Class">Upper Middle Class</option>
												<option value="Middle Class">Middle Class</option><option value="Lower Class">Lower Class</option>
												<option value="Does Not Matters" label="Does Not Matters">Does Not Matters</option>	
											</select>
											<div id="partnerFamilyAffluenceError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-pfamilyaffluence-error'])){ echo $_SESSION['signup-pfamilyaffluence-error']; unset($_SESSION['signup-pfamilyaffluence-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="partnerLocation" class="col-sm-4 col-xs-12 control-label" id="setFonts">Location</label>
										<div class="col-sm-6">
											<input type="text" class="form-control pp" name="partnerLocation" id="partnerLocation" 
											title="city, province, country&#013; you can write multiple locations" placeholder="City, District, Province" 
											value="<?php if(!empty($_POST['partnerLocation'])){echo $_POST['partnerLocation'];}?>" onBlur="PartnerLocation()">
											<div id="partnerLocationError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-plocation-error'])){ echo $_SESSION['signup-plocation-error']; unset($_SESSION['signup-plocation-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="partnerAbout" class="col-sm-4 col-xs-12 control-label" id="setFonts">Write About Partner</label>
										<div class="col-sm-6">
											<textarea class="form-control pp" id="partnerAbout" name="partnerAbout" 
						title="if you are missing something about partner&#013;then write here in details&#013;eg:- add more languages, religion or age group"
											style="resize:vertical" rows="4" onKeyUp="countChar()" 
											placeholder="He/She should be pakistani citizen and should belongs to a religious family." 
											onBlur="PartnerAbout()" ><?php if(!empty($_POST['partnerAbout'])){echo $_POST['partnerAbout'];}?></textarea>
											<div id="partnerAboutError" style="font-size:12px; color:#BF0000;">
												<?php if(isset($_SESSION['signup-pabout-error'])){ echo $_SESSION['signup-pabout-error']; unset($_SESSION['signup-pabout-error']);} ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 col-xs-12 control-label"></label>
										<div class="col-sm-6 col-xs-12" id="nextPadding">
											<button type="button" class="button button-ripple btn-block" style="border-radius:3px;"  onClick="form8Script()">
											<span class="button-text-white">Next</span>
											<i class="fa fa-angle-right" style="margin-left:15px"></i></button>
											
										</div>
										<div class="col-sm-4"></div>
									</div>
									
									
									<div class="form-group">
										<div class="col-sm-4"></div>
										<div class="col-sm-6" style="text-align:center; font-family:Rubik; font-size:13px">If Already have Account, Then <br> 
											<a rel="canonical" href="login.php">Login Here</a>
										</div>
										<div class="col-sm-4"></div>
									</div>
								</div>

							</form>
						</div>
						<!---EndedCompleteForm--->
						<div class="col-lg-2" style="text-align:center; padding:35px;"><!--rightSideOfForm --></div>
					</div>
				<div class="row" style="">
					<div class="col-lg-12" style="text-align:center; padding:2px; background-color: #4c6a92; margin-top:20px; margin-bottom:-5px" >
						<span style="font-size:10px;"></span>
					</div>
				</div>
				</div>
				<!---whitePage--->
				<div class="col-lg-2" ></div>
			</div>
		</div>
	</div>
</div>
<?php include('inc/pages/footer.php');?>
<script src="assets/js/register.js"></script>
</body>
</html>





