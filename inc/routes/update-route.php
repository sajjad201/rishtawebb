<?php
session_start();
require '../connection/connect.php';

if (!isset($_SESSION["firstPersonId"]))
{
  header("location: /");
}

$firstPerson=$_SESSION["firstPersonId"];



$publicProfileErr="";
$firstNameErr = $lastNameErr = $genderErr = $emailErr = $passwordErr = $mobileErr = $countryErr = $provinceErr = $districtErr = "";
$cityErr = $dateOfBirthErr = $languageErr = $educationErr = $professionErr = $salaryErr = $maritalStatusErr = $clanErr = $casteErr = "";
$religionErr = $heightErr = $complexionErr = $bodyTypeErr = $hobbyErr = $disabilityErr = "";
$fatherStatusErr = $motherStatusErr = $noOfBrothersErr = $noOfSistersErr = $familyTypeErr = $familyValuesErr = $familyAffluenceErr = "";
$partnerMaritalStatusErr = $partnerAgeErr = $partnerHeightErr = $partnerReligionErr = $partnerLanguageErr	= $partnerEducationErr = $partnerComplexionErr = "";
$partnerClanErr = $partnerFamilyAffluenceErr = $partnerLocationErr = $partnerAboutErr = "";	
$explainYourSelfErr = $allErrorsOfPhp = $imageIssues = "";

$errorList=array(); 

$errorList["publicProfileErr"] = $errorList["firstNameErr"] = $errorList["lastNameErr"] = "";
$errorList["profileCreatedByErr"] = $errorList["languageErr"] = $errorList["educationErr"] = $errorList["professionErr"] = $errorList["salaryErr"] = "";
$errorList["casteErr"] = $errorList["religionErr"] = $errorList["maritalStatusErr"] = $errorList["clanErr"] = $errorList["heightErr"] = "";
$errorList["complexionErr"] = $errorList["bodyTypeErr"] = $errorList["hobbyErr"] = $errorList["disabilityErr"] = "";
$errorList["countryErr"] = $errorList["provinceErr"] = $errorList["districtErr"] = $errorList["cityErr"] ="";
$errorList["fatherStatusErr"] = $errorList["motherStatusErr"] = $errorList["noOfBrothersErr"] = $errorList["noOfSistersErr"] = "";
$errorList["familyTypeErr"] = $errorList["familyValuesErr"]	= $errorList["familyAffluenceErr"] = "";	
$errorList["partnerMaritalStatusErr"]	= $errorList["partnerAgeErr"] = $errorList["partnerHeightErr"] = $errorList["partnerReligionErr"] = $errorList["partnerLanguageErr"] = "";		
$errorList["partnerEducationErr"] = $errorList["partnerComplexionErr"] = $errorList["partnerClanErr"]= $errorList["partnerFamilyAffluenceErr"] = "";
$errorList["partnerLocationErr"] = $errorList["partnerAboutErr"] = 	"";	
$errorList["explainYourSelfErr"] = "";

$errorOccurred=false;





if($_SERVER['REQUEST_METHOD']=="POST")
{		

	function test_input($data){
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
	
	if(empty($_POST['publicProfile']))
	{
		$errorList["publicProfileErr"]="please select your picture privacy ";
		$errorOccurred=true;
	}
	else
	{	
		$publicProfile=test_input($_POST['publicProfile']);
	}
	
	if(empty($_POST['firstName']))
	{
		$errorList["firstName"]="please enter first name";
		$errorOccurred=true;
	}
	else
	{	
		$firstName=test_input($_POST['firstName']);
	}
	if(empty($_POST['lastName']))
	{
		$errorList["lastName"]="please enter last name";
		$errorOccurred=true;
	}
	else
	{	
		$lastName=test_input($_POST['lastName']);
	}
	
	if(empty($_POST['profileCreatedBy']))
	{
		$errorList["profileCreatedByErr"]="please select your disability ";
		$errorOccurred=true;
	}
	else
	{	
		$profileCreatedBy=test_input($_POST['profileCreatedBy']);
	}
	
	if(empty($_POST['language']))
	{
		$errorList["languageErr"]="please select your language ";
		$errorOccurred=true;
	}
	else
	{	
		$language=test_input($_POST['language']);
	}
	
	if(empty($_POST['education']))
	{
		$errorList["educationErr"]="please select your education ";
		$errorOccurred=true;
	}
	else
	{	
		$education=test_input($_POST['education']);
	}
	
	if(empty($_POST['profession']))
	{
		$errorList["professionErr"]="please select your profession ";
		$errorOccurred=true;
	}
	else
	{	
		$profession=test_input($_POST['profession']);
	}
	
	
		
	if(empty($_POST['salary']))
	{								
		$errorList["salaryErr"]="please select your salary ";
		$errorOccurred=true;
	}
	else
	{	
		$salary=test_input($_POST['salary']);
	}
	
	if(empty($_POST['maritalStatus']))
	{
		$errorList["maritalStatusErr"]="please select your marital status ";
		$errorOccurred=true;
	}
	else
	{	
		$maritalStatus=test_input($_POST['maritalStatus']);
	}
	
	if(empty($_POST['clan']))
	{
		$errorList["clanErr"]="please select your clan ";
		$errorOccurred=true;
	}
	else
	{	
		$clan=test_input($_POST['clan']);
	}
	if(empty($_POST['caste']))
	{
		$errorList["casteErr"]="please select your caste ";
		$errorOccurred=true;
	}
	else
	{	
		$caste=test_input($_POST['caste']);
	}
	
	if(empty($_POST['religion']))
	{
		$errorList["religionErr"]="please select your religion ";
		$errorOccurred=true;
	}
	else
	{	
		$religion=test_input($_POST['religion']);
	}
	
	if(empty($_POST['height']))
	{
		$errorList["heightErr"]="please select your height ";
		$errorOccurred=true;
	}
	else
	{	
		$height=test_input($_POST['height']);
	}
	
	if(empty($_POST['complexion']))
	{
		$errorList["complexionErr"]="please select your complexion ";
		$errorOccurred=true;
	}
	else
	{	
		$complexion=test_input($_POST['complexion']);
	}
	
	if(empty($_POST['bodyType']))
	{
		$errorList["bodyTypeErr"]="please select your bodyType ";
		$errorOccurred=true;
	}
	else
	{	
		$bodyType=test_input($_POST['bodyType']);
	}
	
	if(empty($_POST['hobby']))
	{
		$errorList["hobbyErr"]="please select your hobby ";
		$errorOccurred=true;
	}
	else
	{	
		$hobby=test_input($_POST['hobby']);
	}
	
	if(empty($_POST['disability']))
	{
		$errorList["disabilityErr"]="please select your disability ";
		$errorOccurred=true;
	}
	else
	{	
		$disability=test_input($_POST['disability']);
	}
	if(empty($_POST['country']))
	{
		$errorList["countryErr"]="please select your country ";
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
				$errorOccurred=true;
			}
			else
			{	
				$province=test_input($_POST['province']);
			}
			
			if(empty($_POST['district']))
			{
				$errorList["districtErr"]="please select your district";
				$errorOccurred=true;
			}
			else
			{	
				$district=test_input($_POST['district']);
			}
			
			if(empty($_POST['city']))
			{
				$errorList["cityErr"]="please select your city ";
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
	
	if(empty($_POST['fatherStatus']))
	{
		$errorList["fatherStatusErr"]="please select father status ";
		$errorOccurred=true;
	}
	else
	{	
		$fatherStatus=test_input($_POST['fatherStatus']);
	}
	
	if(empty($_POST['motherStatus']))
	{
		$errorList["motherStatusErr"]="please select mother status ";
		$errorOccurred=true;
	}
	else
	{	
		$motherStatus=test_input($_POST['motherStatus']);
	}
	
	if(empty($_POST['noOfBrothers']))
	{
		$errorList["noOfBrothersErr"]="please select no of brothers ";
		$errorOccurred=true;
	}
	else
	{	
		$noOfBrothers=test_input($_POST['noOfBrothers']);
	}
	
	if(empty($_POST['noOfSisters']))
	{
		$errorList["noOfSistersErr"]="please select no of sisters ";
		$errorOccurred=true;
	}
	else
	{	
		$noOfSisters=test_input($_POST['noOfSisters']);
	}
	
	if(empty($_POST['familyType']))
	{
		$errorList["familyTypeErr"]="please select family type ";
		$errorOccurred=true;
	}
	else
	{	
		$familyType=test_input($_POST['familyType']);
	}
	
	if(empty($_POST['familyValues']))
	{
		$errorList["familyValuesErr"]="please select your family values ";
		$errorOccurred=true;
	}
	else
	{	
		$familyValues=test_input($_POST['familyValues']);
	}
	
	if(empty($_POST['familyAffluence']))
	{
		$errorList["familyAffluenceErr"]="please select your family affluence ";
		$errorOccurred=true;
	}
	else
	{	
		$familyAffluence=test_input($_POST['familyAffluence']);
	}
		
	if(empty($_POST['partnerMaritalStatus']))
	{
		$errorList["partnerMaritalStatusErr"]="select marital status ";
		$errorOccurred=true;
	}
	else
	{	
		$partnerMaritalStatus=test_input($_POST['partnerMaritalStatus']);
	}
	
	if(empty($_POST['partnerAge']))
	{
		$errorList["partnerAgeErr"]="select age ";
		$errorOccurred=true;
	}
	else
	{	
		$partnerAge=test_input($_POST['partnerAge']);
	}
	
	if(empty($_POST['partnerHeight']))
	{
		$errorList["partnerHeightErr"]="select height ";
		$errorOccurred=true;
	}
	else
	{	
		$partnerHeight=test_input($_POST['partnerHeight']);
	}	

	if(empty($_POST['partnerReligion']))
	{
		$errorList["partnerReligionErr"]="select religion ";
		$errorOccurred=true;
	}
	else
	{	
		$partnerReligion=test_input($_POST['partnerReligion']);
	}
	
		
	if(empty($_POST['partnerLanguage']))
	{
		$errorList["partnerLanguageErr"]="select language ";
		$errorOccurred=true;
	}
	else
	{	
		$partnerLanguage=test_input($_POST['partnerLanguage']);
	}
	
	if(empty($_POST['partnerEducation']))
	{
		$errorList["partnerEducationErr"]="select education ";
		$errorOccurred=true;
	}
	else
	{	
		$partnerEducation=test_input($_POST['partnerEducation']);
	}
	
	if(empty($_POST['partnerComplexion']))
	{
		$errorList["partnerComplexionErr"]="select complexion ";
		$errorOccurred=true;
	}
	else
	{	
		$partnerComplexion=test_input($_POST['partnerComplexion']);
	}
	
	if(empty($_POST['partnerClan']))
	{
		$errorList["partnerClanErr"]="select clan ";
		$errorOccurred=true;
	}
	else
	{	
		$partnerClan=test_input($_POST['partnerClan']);
	}
	
	if(empty($_POST['partnerFamilyAffluence']))
	{
		$errorList["partnerFamilyAffluenceErr"]="select partner family affluence ";
		$errorOccurred=true;
	}
	else
	{	
		$partnerFamilyAffluence=test_input($_POST['partnerFamilyAffluence']);
	}
	
	if(empty($_POST['partnerLocation']))
	{
		$errorList["partnerLocationErr"]="select location ";
		$errorOccurred=true;
	}
	else
	{	
		$partnerLocation=test_input($_POST['partnerLocation']);
	}
	
	if(empty($_POST['partnerAbout']))
	{
		$errorList["partnerAboutErr"]="please write something  ";
		$errorOccurred=true;
	}
	else
	{	
		$partnerAbout=test_input($_POST['partnerAbout']);
	}
	
	if(empty($_POST['aboutYourself']))
	{
		$errorList["explainYourSelfErr"]="please select explain yourself ";
		$errorOccurred=true;
	}
	else
	{	
		$aboutYourself=test_input($_POST['aboutYourself']);
	}
	
	
	
	
	
	
	
	if( $errorOccurred == false )
	{
		$stmt = $conn->prepare("UPDATE signup SET publicProfile=?, firstName=?, lastName=?,	profileCreatedBy=?, language=?, education=?, profession=?, salary=?, 
		maritalStatus=?, clan=?, caste=?, religion=?, 
		height=?, complexion=?, bodyType=?, hobby=?, disability=?, country=?, province=?, district=?, city=?, fatherStatus=?, motherStatus=?, 
		noOfBrothers=?, noOfSisters=?, familyType=?, familyValues=?, familyAffluence=?, pMaritalStatus=?, pAge=?, pHeight=?, pReligion=?, pLanguage=?, 
		pEducation=?, pComplexion=?, pClan=?, pFamilyAffluence=?, pLocation=?, pAbout=?, aboutYourself=?
		WHERE id=? ");
		
		$stmt->bind_param("sssssssssssssssssssssssssssssssssssssssss", $publicProfile, $firstName, $lastName,  $profileCreatedBy, $language, 
		$education, $profession, $salary, $maritalStatus, 
		$clan, $caste, $religion, $height, $complexion, $bodyType, $hobby, $disability, $country, $province, $district, $city, $fatherStatus, $motherStatus, 
		$noOfBrothers, $noOfSisters, $familyType, $familyValues, $familyAffluence, $partnerMaritalStatus, $partnerAge, $partnerHeight, $partnerReligion, 
		$partnerLanguage,$partnerEducation, $partnerComplexion, $partnerClan, $partnerFamilyAffluence, $partnerLocation, $partnerAbout, $aboutYourself, $firstPerson);
		
		$stmt->execute();
		$stmt->close();
		header('Location: myprofile.php');
	}
	else
	{
		$allErrorsOfPhp="please provide correct information because some errors still exists, check the form again and submit it.";
	}
	
	
	
}

?>