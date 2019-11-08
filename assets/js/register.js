// tooltop
$('[data-toggle="tooltip"]').tooltip();
// helptext
function helpMe(){
    $('#aboutYourself').val('');
    $('#aboutYourself').val('I am mature, well educated and has my own bussiness, I am looking Rishta for myself.');
}   

// form-control focus
$('.form-control').focus(function(){
	$(this).parent().siblings('.control-label').addClass('changeborder');
}).blur(function(){
	$(this).parent().siblings('.control-label').removeClass('changeborder');
});

// Select2 Logicx
$('.select2').select2();
var list = $(".select2").map(function(){return $(this).attr("data-select2-id");}).get();
for (var i = 0; i < list.length; ++i) {
    if(i % 2 === 0){
        var select=list[i];
        var n=$('[aria-labelledby=select2-'+select+'-container]').addClass(select);
        var remfun="RemoveSelect('"+select+"')";
        $('.'+select).attr('onblur', remfun);
        var remfun="ClickMe('"+select+"')";
        $('.'+select).attr('onclick', remfun);
    }
}

var one=1;
var appClick=1;
var approve="no";
function RemoveSelect(select) {
    
    appClick=2; 
    if(approve =="yes"){
        if(one==1){
            $('.'+select).parent().siblings('.control-label').removeClass('changeborder');
            var run=select;
            var fnstring = run;
            var fnparams = [1, 2, 3];
            var fn = window[fnstring];
            if (typeof fn === "function") fn.apply(null, fnparams);
            one=1;
            one++;
            appClick=2; 
        }
        else if(one == 2){
            $('.'+select).parent().siblings('.control-label').removeClass('changeborder');
            var run=select;
            var fnstring = run;
            var fnparams = [1, 2, 3];
            var fn = window[fnstring];
            if (typeof fn === "function") fn.apply(null, fnparams);
            one=1;
            appClick=1; 
        }
    }
    approve="no";
}
function ClickMe(select) {
    $('.'+select).parent().siblings('.control-label').addClass('changeborder');
    if(appClick == 2){
        approve="yes";
        appClick=1;
    }
}
// back-pannels
function backToPage8(){
	document.getElementById("block8").style.display="none";
	document.getElementById("whitePageCenter").style.backgroundColor="white"
	document.getElementById("block7").style.display="block";
}
function backToPage7(){
	document.getElementById("block7").style.display="none";
	document.getElementById("block4").style.display="block";
}
function backToPage6(){
	document.getElementById("block6").style.display="none";
	document.getElementById("block8").style.display="block";
	document.getElementById("whitePageCenter").style.backgroundColor="#FFFFFF"
}
function backToPage4(){
	document.getElementById("block5").style.display="none";
	document.getElementById("block8").style.display="block";
}
function backToPage3_3(){
	document.getElementById("block4").style.display="none";
	document.getElementById("block3_3").style.display="block";
}
function backToPage3(){
	document.getElementById("block3_3").style.display="none";
	document.getElementById("block3").style.display="block";
}
function backToPage2(){
	document.getElementById("block3").style.display="none";
	document.getElementById("block2").style.display="block";
}
function backToPage1(){
	document.getElementById("block2").style.display="none";
	document.getElementById("block1").style.display="block";
}

// skip
function SkipFamily(){
    document.getElementById("block7").style.display="none";
	document.getElementById("block8").style.display="block";
}
function SkipPartner(){
    document.getElementById("block8").style.display="none";
	document.getElementById("block5").style.display="block";
}


// registration methods
// form1
function FirstName(){	
	var firstNameVar=document.signupForm.firstName.value;
	var firstNameLengthVar=firstNameVar.length;
	
	if(firstNameVar=="")											
	{
		document.getElementById("firstNameError").innerHTML="please enter first name";
	}
	else if(!/^[a-zA-Z ]*$/g.test(firstNameVar))					{document.getElementById("firstNameError").innerHTML="Invalid first name. Don't use";
																	 }
	else if(firstNameLengthVar>12)									{document.getElementById("firstNameError").innerHTML="First name is too much long";
																	 }
	else if(firstNameLengthVar<2)									{document.getElementById("firstNameError").innerHTML="First name is too much short";}
	else															{
																	 document.getElementById("firstNameError").innerHTML=""; return true;}
}
function LastName(){
	var lastNameVar=document.signupForm.lastName.value;
	var lastNameLengthVar=lastNameVar.length;
	
	if(lastNameVar=="")												
	{
		document.getElementById("lastNameError").innerHTML="Please enter last name";
	}
	else if(!/^[a-zA-Z ]*$/g.test(lastNameVar))						{document.getElementById("lastNameError").innerHTML="Invalid last name (only A-Z allowed)";
																	 }
	else if(lastNameLengthVar>12)									{document.getElementById("lastNameError").innerHTML="Last name is too much long";
																	 }
	else if(lastNameLengthVar<2)									{document.getElementById("lastNameError").innerHTML="Last name is too much short";}
	else															{
																	document.getElementById("lastNameError").innerHTML=""; return true;	}
}
function Gender(){
	if( document.signupForm.gender.value == "male" )
	{
		document.getElementById("imageChanged").src="assets/allpics/male4.png";
	}
	if( document.signupForm.gender.value == "female" )
	{	
		document.getElementById("imageChanged").src="assets/allpics/female4.png";
	}
	
	if(document.signupForm.gender.value==0)							
	{
		document.getElementById("genderError").innerHTML="Please select gender";
		document.getElementById("genderError").innerHTML="Please select gender";
	}	
	else 
	{
		document.getElementById("genderError").innerHTML=""; return true;
	}
	
	
}
function Email(){
	var email=document.signupForm.email.value;
	var emailVar=document.signupForm.email.value;
	var emailLengthVar=emailVar.length;
	var varifyEmail = /^(([^<>()[\]\\.,;:\s@\']+(\.[^<>()[\]\\.,;:\s@\']+)*)|(\'.+\ '))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
	if(email==""){
		document.getElementById("emailError").innerHTML="Please enter email address";
	}
	else if(emailLengthVar>40)									{document.getElementById("emailError").innerHTML="email address is too lengthy!";}
	else if(emailLengthVar<2)									{document.getElementById("emailError").innerHTML="email adressis too much short";}
	else if(varifyEmail.test(email) == false) 					{document.getElementById("emailError").innerHTML="Please enter correct email"; return false;}
	else if( email != "" )
	{
		document.getElementById("emailError").innerHTML="";
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				if( xmlhttp.responseText == 1){
					document.getElementById("emailError").innerHTML="You already have an account on RISHTAWEB! <br> Login & visit your profile.";
					return false;
				}
				else if( xmlhttp.responseText == 0 ){
					if(  FirstName() == true && LastName() == true && Gender() == true && Password() == true && Mobile() == true && ProfileCreatedBy() == true ){	
						document.getElementById("block1").style.display="none";
						document.getElementById("block2").style.display="block";
						document.getElementById("emailError").innerHTML="";
						document.getElementById("allPhpErrors").innerHTML="";
					}
				}
			}
		}
		xmlhttp.open('GET','inc/routes/CompleteSignUpPHP.php?email='+email, true);
		xmlhttp.send();
		return true;
	}
}
function Password(){
	var passwordVar=document.signupForm.password.value;
	var passwordLengthVar=passwordVar.length;
	
	if(passwordVar=="")												
	{
		document.getElementById("passwordError").innerHTML="Please enter password";
	}
	else if(passwordLengthVar<8)									{document.getElementById("passwordError").innerHTML="Please enter correct password(min 8 char)";
																	 }
	else if(passwordLengthVar>16)									{document.getElementById("passwordError").innerHTML="password is too lengthy!";
	                                                                 }
	else															{
																	document.getElementById("passwordError").innerHTML=""; return true;}
}
function Mobile(){
	var mobileVar=document.signupForm.mobile.value;
	var mobileLengthVar=mobileVar.length;
	
	if(mobileVar=="")												
	{
		document.getElementById("mobileError").innerHTML="Please enter correct mobile number";
	}
	else if(!/^[0-9., ]*$/g.test(mobileVar))							{document.getElementById("mobileError").innerHTML="Invalid mobile number format.";
																	 }
	else if(mobileLengthVar < 10)									{document.getElementById("mobileError").innerHTML="invalid mobile number!";}
	else if(mobileLengthVar > 13)									{document.getElementById("mobileError").innerHTML="invalid mobile number!";
																	 }
	else															{
																	document.getElementById("mobileError").innerHTML=""; return true;}
}
function ProfileCreatedBy(){ 	
	if(document.signupForm.profileCreatedBy.value==0)			{document.getElementById("profileCreatedByError").innerHTML="please select your language";
																}
	else														{document.getElementById("profileCreatedByError").innerHTML="";
														 		return true;}
}
function form1Script(){
	FirstName();
	LastName();
	Gender();
	Email();
	Password();
	Mobile();
	ProfileCreatedBy();
	if(  FirstName() == true && LastName() == true && Gender() == true && Password() == true && Mobile() == true && ProfileCreatedBy() == true )
	{
		Email();
	}
		
}

// Form2Script
var checkErrorForCountry=true;
var chkCountry=1;
var chkPunjab=1;
var chkKhyberPakhtunkhwa=1;
var chkSindh=1;
var chkBalochistan=1;
var chkGilgitBaltistan=1;
var chkAzadJammuandKashmir=1;
var chkFata=1;


function Country()
{
	if( document.signupForm.country.value == "Pakistan" ){	
		if(chkCountry == 1){	chkCountry++;
			document.getElementById("Province").innerHTML="<option value='0'>Your Province</option><option value='Punjab'>Punjab</option><option value='Khyber Pakhtunkhwa'>Khyber Pakhtunkhwa</option><option value='Sindh'>Sindh</option><option value='Balochistan'>Balochistan</option><option value='Gilgit Baltistan'>Gilgit Baltistan</option><option value='Azad Jammu and Kashmir'>Azad Jammu and Kashmir</option><option value='Fata'>Fata</option>";
		}
		checkErrorForCountry=true;
		document.getElementById("showProvince").style.display="block";
    }
    else {
		checkErrorForCountry=false;
		document.getElementById("provinceError").innerHTML="";
		document.getElementById("Province").style.borderColor="#E5E5E5";
		document.getElementById("showProvince").style.display="none";
		document.getElementById("showDistrict").style.display="none";
		document.getElementById("showCity").style.display="none";
	}	
	if(document.signupForm.country.value==0)			{document.getElementById("countryError").innerHTML="please select your country";}
	else												{document.getElementById("countryError").innerHTML="";
														 document.getElementById("Country").style.borderColor="#E5E5E5";return true;}
}


function Province(){	
	if( checkErrorForCountry == true )
	{	
		if(document.signupForm.province.value == "Punjab")					
		{
			document.getElementById("showDistrict").style.display="block";
			if(chkPunjab == 1)
			{	chkPunjab++;
				chkKhyberPakhtunkhwa=1;
				chkSindh=1;
				chkBalochistan=1;
				chkGilgitBaltistan=1;
				chkAzadJammuandKashmir=1;
				chkFata=1;
				document.getElementById("District").innerHTML="<option value='0'>Your District</option><option value='Attock'>Attock</option><option value='Lodhran'>Lodhran</option><option value='Bahawalnagar'>Bahawalnagar</option><option value='Mandi Bahauddin'>Mandi Bahauddin</option><option value='Bahawalpur'>Bahawalpur</option><option value='Mianwali'>Mianwali</option><option value='Bhakkar'>Bhakkar</option><option value='Multan'>Multan</option><option value='Chakwal'>Chakwal</option><option value='Muzaffargarh'>Muzaffargarh</option><option value='Chiniot'>Chiniot</option><option value='Narowal'>Narowal</option><option value='Dera Ghazi Khan'>Dera Ghazi Khan</option><option value='Nankana Sahib'>Nankana Sahib</option><option value='Faisalabad'>Faisalabad</option><option value='Okara'>Okara</option><option value='Gujranwala'>Gujranwala</option><option value='Pakpattan'>Pakpattan</option><option value='Gujrat'>Gujrat</option><option value='Rahim Yar Khan'>Rahim Yar Khan</option><option value='Hafizabad'>Hafizabad</option><option value='Rajanpur'>Rajanpur</option><option value='Jhang'>Jhang</option><option value='Rawalpindi'>Rawalpindi</option><option value='Jhelum'>Jhelum</option><option value='Sahiwal'>Sahiwal</option><option value='Kasur'>Kasur</option><option value='Sargodha'>Sargodha</option><option value='Khanewal'>Khanewal</option><option value='Sheikhupura'>Sheikhupura</option><option value='Khushab'>Khushab</option><option value='Sialkot'>Sialkot</option><option value='Lahore'>Lahore</option><option value='Toba Tek Singh'>Toba Tek Singh</option><option value='Layyah'>Layyah</option><option value='Vehari'>Vehari</option>";
			}

			
		}
		else if(document.signupForm.province.value == "Khyber Pakhtunkhwa")		
		{
			document.getElementById("showDistrict").style.display="block";
			if(chkKhyberPakhtunkhwa == 1)
			{	chkKhyberPakhtunkhwa++;
			
				chkPunjab=1;
				chkSindh=1;
				chkBalochistan=1;
				chkGilgitBaltistan=1;
				chkAzadJammuandKashmir=1;
				chkFata=1;
				
				document.getElementById("District").innerHTML="<option value='0'>Your District</option><option value='Abbottabad'>Abbottabad</option><option value='Bannu'>Bannu</option><option value='Batagram'>Batagram</option><option value='Buner'>Buner</option><option value='Charsadda'>Charsadda</option><option value='Chitral'>Chitral</option><option value='Dera Ismail Khan'>Dera Ismail Khan</option><option value='Hangu'>Hangu</option><option value='Haripur'>Haripur</option><option value='Karak'>Karak</option><option value='Kohat'>Kohat</option><option value='Upper Kohistan'>Upper Kohistan</option><option value='Lakki Marwat'>Lakki Marwat</option><option value='Lower Dir'>Lower Dir</option><option value='Malakand'>Malakand</option><option value='Mansehra'>Mansehra</option><option value='Mardan'>Mardan</option><option value='Nowshera'>Nowshera</option><option value='Peshawar'>Peshawar</option><option value='Shangla'>Shangla</option><option value='Swabi'>Swabi</option><option value='Swat'>Swat</option><option value='Tank'>Tank</option><option value='Upper Dir'>Upper Dir</option><option value='Torghar'>Torghar</option><option value='Lower Kohistan'>Lower Kohistan</option>";
			}
			
		}
		
		else if(document.signupForm.province.value == "Sindh")
		{
			document.getElementById("showDistrict").style.display="block";
			if(chkSindh == 1)
			{	chkSindh++;
			
				chkPunjab=1;
				chkKhyberPakhtunkhwa=1;
				chkBalochistan=1;
				chkGilgitBaltistan=1;
				chkAzadJammuandKashmir=1;
				chkFata=1;
				
				document.getElementById("District").innerHTML="<option value='0'>Your District</option><option value='Badin'>Badin</option><option value='Dadu'>Dadu</option><option value='Ghotki'>Ghotki</option><option value='Hyderabad'>Hyderabad</option><option value='Jacobabad'>Jacobabad</option><option value='Jamshoro'>Jamshoro</option><option value='Karachi'>Karachi</option><option value='Kashmore'>Kashmore</option><option value='Khairpur'>Khairpur</option><option value='Larkana'>Larkana</option><option value='Matiari'>Matiari</option><option value='Mirpurkhas'>Mirpurkhas</option><option value='Naushahro Firoz'>Naushahro Firoz</option><option value='Shaheed Benazirabad'>Shaheed Benazirabad</option><option value='Qamber and Shahdad Kot'>Qamber and Shahdad Kot</option><option value='Sanghar'>Sanghar</option><option value='Shikarpur'>Shikarpur</option><option value='Sukkur'>Sukkur</option><option value='Tando Allahyar'>Tando Allahyar</option><option value='Tando Muhammad Khan'>Tando Muhammad Khan</option><option value='Tharparkar'>Tharparkar</option><option value='Thatta'>Thatta</option><option value='Umer Kot'>Umer Kot</option><option value='Sujawal'>Sujawal</option><option value='Malir'>Malir</option><option value='Korangi'>Korangi</option><option value='Sujawal'>Sujawal</option>";
			}
		}
		
		else if(document.signupForm.province.value == "Balochistan")				
		{
			document.getElementById("showDistrict").style.display="block";
			if(chkBalochistan == 1)
			{	chkBalochistan++;
			
				chkPunjab=1;
				chkKhyberPakhtunkhwa=1;
				chkSindh=1;
				chkGilgitBaltistan=1;
				chkAzadJammuandKashmir=1;
				chkFata=1;
			
				document.getElementById("District").innerHTML="<option value='0'>Your District</option><option value='Awaran'>Awaran</option><option value='Barkhan'>Barkhan</option><option value='Bolan'>Bolan</option><option value='Chagai'>Chagai</option><option value='Dera Bugti'>Dera Bugti</option>	<option value='Gwadar'>Gwadar</option><option value='Harnai'>Harnai</option><option value='Jafarabad'>Jafarabad</option><option value='Jhal Magsi'>Jhal Magsi</option>	<option value='Kalat'>Kalat</option><option value='Kech'>Kech</option><option value='Kharan'>Kharan</option><option value='Khuzdar'>Khuzdar</option><option value='Kohlu'>Kohlu</option><option value='Lasbela'>Lasbela</option><option value='Loralai'>Loralai</option><option value='Mastung'>Mastung</option><option value='Musakhel'>Musakhel</option>	<option value='Naseerabad'>Naseerabad</option><option value='Nushki'>Nushki</option><option value='Panjgur'>Panjgur</option><option value='Pishin'>Pishin</option><option value='Qilla Abdullah'>Qilla Abdullah</option><option value='Qilla Saifullah'>Qilla Saifullah</option><option value='Quetta'>Quetta</option><option value='Sheerani'>Sheerani</option><option value='Sibi'>Sibi</option><option value='Washuk'>Washuk</option><option value='Zhob'>Zhob</option><option value='Ziarat'>Ziarat</option><option value='Sohbatpur'>Sohbatpur</option><option value='Lehri'>Lehri</option>";
			}
		}
		
		else if(document.signupForm.province.value == "Gilgit Baltistan")		
		{
			document.getElementById("showDistrict").style.display="block";
			if(chkGilgitBaltistan == 1)
			{	chkGilgitBaltistan++;
			
				chkPunjab=1;
				chkKhyberPakhtunkhwa=1;
				chkSindh=1;
				chkBalochistan=1;
				chkAzadJammuandKashmir=1;
				chkFata=1;
			
				document.getElementById("distrDistrictict").innerHTML="<option value='0'>Your District</option><option value='Ghanche'>Ghanche</option><option value='Skardu'>Skardu</option>	<option value='Hunza'>Hunza</option>	<option value='Astore'>Astore</option>	<option value='Kharmang'>Kharmang</option><option value='Diamer'>Diamer</option>	<option value='Shigar'>Shigar</option><option value='Ghizer'>Ghizer</option>	<option value='Nagar'>Nagar</option>";
			}
		}
		
		else if(document.signupForm.province.value == "Azad Jammu and Kashmir")	{
			document.getElementById("showDistrict").style.display="block";
			if(chkAzadJammuandKashmir == 1)
			{	chkAzadJammuandKashmir++;
				chkPunjab=1;
				chkKhyberPakhtunkhwa=1;
				chkSindh=1;
				chkBalochistan=1;
				chkGilgitBaltistan=1;
				chkFata=1;
			
				document.getElementById("District").innerHTML="<option value='0'>Your District</option><option value='Bhimber'>Bhimber</option><option value='Hattian'>Hattian</option><option value='Kotli'>Kotli</option><option value='Sudhnati'>Sudhnati</option><option value='Mirpur'>Mirpur</option><option value='Muzaffarabad'>Muzaffarabad</option><option value='Bagh'>Bagh</option><option value='Neelum'>Neelum</option><option value='Poonch'>Poonch</option><option value='Sudhnati'>Sudhnati</option>";
			}
		}
		
		else if(document.signupForm.province.value == "Fata"){
			document.getElementById("showDistrict").style.display="block";
			if(chkFata == 1)
			{	chkFata++;
			
				chkPunjab=1;
				chkKhyberPakhtunkhwa=1;
				chkSindh=1;
				chkBalochistan=1;
				chkGilgitBaltistan=1;
				chkAzadJammuandKashmir=1;
				
				document.getElementById("District").innerHTML="<option value='0'>Your District</option><option value='Bajaur'>Bajaur</option><option value='North Waziristan'>North Waziristan</option><option value='Khyber'>Khyber</option><option value='Orakzai'>Orakzai</option><option value='Kurram'>Kurram</option><option value='South Waziristan'>South Waziristan</option><option value='Mohmand'>Mohmand</option>";
			}
		}
		
		if(document.signupForm.province.value==0)			{document.getElementById("provinceError").innerHTML="please select your province";
															}
		else 												{document.getElementById("provinceError").innerHTML="";
															 return true;}
	}
	else if(document.signupForm.country.value != "Pakistan")	{return true;}
}
function District(){
	if( checkErrorForCountry == true )
	{ document.getElementById("showCity").style.display="block";
		if(document.signupForm.district.value==0)			{document.getElementById("districtError").innerHTML="please select your district";
															 }
		else												{document.getElementById("districtError").innerHTML=""; return true;}
	}
	else if(document.signupForm.country.value != "Pakistan")	{return true;}	
}
function City(){
	if(document.signupForm.city.value==0)				{document.getElementById("cityError").innerHTML="please select your city";}
	else												{document.getElementById("cityError").innerHTML="";return true;}
	if(document.signupForm.country.value != "Pakistan")	{document.getElementById("showCity").style.display="none"; return true;}
}
function Day(){	
	if(document.signupForm.day.value==0)				{
													 	document.getElementById("dateOfBirthError").innerHTML="Please select day";
														}
	else												{
														document.getElementById("dateOfBirthError").innerHTML=""; return true;}
}
function Month(){	
	if(document.signupForm.month.value==0)				{
														document.getElementById("dateOfBirthError").innerHTML="Please select month";
														}
	else												{
														document.getElementById("dateOfBirthError").innerHTML=""; return true;}
}
function Year(){	
	if(document.signupForm.year.value==0)				{
														document.getElementById("dateOfBirthError").innerHTML="Please select year";
														}
	else												{
														 document.getElementById("dateOfBirthError").innerHTML=""; return true;}
}
function Language(){
	if(document.signupForm.language.value==0)			{document.getElementById("languageError").innerHTML="please select your language";
														 }
	else												{document.getElementById("languageError").innerHTML="";
														 return true;}
}
function form2Script(){
	Country();
	Province();
	District();
	City();
	Day();
	Month();
	Year();
	Language();
	if( Country() == true && Province() == true && District() == true && City() == true && Day() == true && Month() == true && Year() == true && Language() == true ){
		document.getElementById("block2").style.display="none";
		document.getElementById("block3").style.display="block";
	}
	
	
}

// Form3Script
function Education()
{
	if(document.signupForm.education.value==0)			{document.getElementById("educationError").innerHTML="please select your educational level";
														 }
	else												{document.getElementById("educationError").innerHTML="";
														 return true;}
}
function Profession(){
	if(document.signupForm.profession.value==0)			{document.getElementById("professionError").innerHTML="please select your profession";
														 }
	else												{document.getElementById("professionError").innerHTML="";
														 return true;}
}
function Salary(){
	if(document.signupForm.salary.value==0)				{document.getElementById("salaryError").innerHTML="please select your salary";
														 }
	else												{document.getElementById("salaryError").innerHTML="";
														 return true;}
}
function FamilyType(){
	if(document.signupForm.familyType.value==0)			{document.getElementById("familyTypeError").innerHTML="please select your family type";
														 }
	else												{document.getElementById("familyTypeError").innerHTML="";
														 return true;}
}
function FamilyValues(){
	if(document.signupForm.familyValues.value==0)		{document.getElementById("familyValuesError").innerHTML="please select your family values";
														 }
	else												{document.getElementById("familyValuesError").innerHTML="";
														 return true;}
}
function FamilyAffluence(){
	if(document.signupForm.familyAffluence.value==0)	{document.getElementById("familyAffluenceError").innerHTML="please select your family affluence";
														 }
	else												{document.getElementById("familyAffluenceError").innerHTML="";
														 return true;}
}
function form3Script(){
	Education();
	Profession();
    Salary();
    FamilyType();
	FamilyValues();
	FamilyAffluence();
	if( Education() == true && Profession() == true && Salary() == true && FamilyType() == true  && FamilyValues() == true  && FamilyAffluence() == true  )
	{
		document.getElementById("block3").style.display="none";
		document.getElementById("block3_3").style.display="block";
	}
	
}

// Form3_3Script
function MaritalStatus(){
	if(document.signupForm.maritalStatus.value==0)		{document.getElementById("maritalStatusError").innerHTML="please select your marital status";
														 }
	else												{document.getElementById("maritalStatusError").innerHTML="";
														 return true;}
}
function Clan(){
	if(document.signupForm.clan.value==0)				{document.getElementById("clanError").innerHTML="please select your clan";
														 }
	else												{document.getElementById("clanError").innerHTML="";
														 return true;}
}
function Caste(){
	if(document.signupForm.caste.value==0)				{document.getElementById("casteError").innerHTML="please select your caste";
														 }
	else												{document.getElementById("casteError").innerHTML="";
														 return true;}
}

function Religion(){
	if(document.signupForm.religion.value==0)			{document.getElementById("religionError").innerHTML="please select your religion";
														 }
	else												{document.getElementById("religionError").innerHTML="";
														 return true;}
}
function form3_3Script(){
	MaritalStatus();
	Clan();
	Caste();
	Religion();
	if(  MaritalStatus()==true && Clan()==true && Caste()==true && Religion()==true  )
	{
		document.getElementById("block3_3").style.display="none";
		document.getElementById("block4").style.display="block";
	}
	
}

// Form4Script
function Height(){
	if(document.signupForm.height.value==0)				{document.getElementById("heightError").innerHTML="please select your height";
														 }
	else												{document.getElementById("heightError").innerHTML="";
														 return true;}
}
function Complexion(){
	if(document.signupForm.complexion.value==0)			{document.getElementById("complexionError").innerHTML="please select your complexion";
														 }
	else												{document.getElementById("complexionError").innerHTML="";
														 return true;}
}
function BodyType(){
	if(document.signupForm.bodyType.value==0)			{document.getElementById("bodyTypeError").innerHTML="please select your body type";
														 }
	else												{document.getElementById("bodyTypeError").innerHTML="";
														 return true;}
}
function Hobby(){
	if(document.signupForm.hobby.value==0)				{document.getElementById("hobbyError").innerHTML="please select your hobby";
														 }
	else												{document.getElementById("hobbyError").innerHTML="";
														 return true;}
}
function Disability(){
	if(document.signupForm.disability.value==0)			{document.getElementById("disabilityError").innerHTML="please select (if have any disability)";
														 }
	else												{document.getElementById("disabilityError").innerHTML="";
														 return true;}
}
function AboutYourself(){
	var countExplainYourself = document.signupForm.aboutYourself.value.length;
	var aboutText=document.signupForm.aboutYourself.value;
	
	if(document.signupForm.aboutYourself.value== 0)		{document.getElementById("explainYourselfError").innerHTML="please explain yourself";
														 }
	else if(!/^[a-zA-Z0-9.,& ]*$/g.test(aboutText))		{document.getElementById("explainYourselfError").innerHTML="Invalid input. Don't enter (;\`-=+!) etc";}
	else if(countExplainYourself < 50)					{document.getElementById("explainYourselfError").innerHTML="minimum 50 char required";
														}
	else if(countExplainYourself > 1000)				{document.getElementById("explainYourselfError").innerHTML="Max 1000 char are allowed";
														}
	else												{document.getElementById("explainYourselfError").innerHTML="";
														 return true;}
}
function countChar(){
	var countExplainYourself = document.signupForm.aboutYourself.value.length;
	
	if( countExplainYourself > 49 )
	{
		document.getElementById("countChar").style.color="green";
		document.getElementById("countChar").innerHTML=countExplainYourself+" / 50";
	}
	else
	{	
		document.getElementById("countChar").style.color="#999999";
		document.getElementById("countChar").innerHTML=countExplainYourself+" / 50";
	}
	
}
function form4Script(){
	Height();
	Complexion();
	BodyType();
	Hobby();
    Disability();
    AboutYourself();
	if( Height() == true && Complexion() == true && BodyType() == true && Hobby() == true && Disability() == true && AboutYourself() == true )
	{
		document.getElementById("block4").style.display="none";
		document.getElementById("block7").style.display="block";
	}
}


// Form5Script 
$(function () {
    $("#uploadProfilePicture").change(function () {
        if (this.files && this.files[0]) 
        {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);

        }
    });
});
function imageIsLoaded(e) {
    $('#hidePng').attr('src', e.target.result);
}
var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];   
var chkFileType = false;
var checkSize=true;
function imageDetails(oInput){		
    var fileName = document.getElementById('uploadProfilePicture').files[0].name;
    var fileSize = document.getElementById('uploadProfilePicture').files[0].size;
    var fileType = document.getElementById('uploadProfilePicture').files[0].type;
    var fileModifiedDate = document.getElementById('uploadProfilePicture').files[0].lastModifiedDate;
    
    if (oInput.type == "file") 
    {
        var sFileName = oInput.value;
            if (sFileName.length > 0) 
            {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) 
            {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) 
                {
                    if( fileSize >  3000000 )
                    {
                        document.getElementById("ImageLarger").innerHTML = "Sorry! Image size is larger <br>"+(fileSize/1048576).toFixed(2)+" MB";
                        document.getElementById("detailsOfProfile").innerHTML = "";
                        checkSize = false;
                    }
                    else if( (sizeInMb=fileSize/1048576) > 1 )
                    {
                        var newSizeInMb=sizeInMb.toFixed(2);
                        document.getElementById("detailsOfProfile").innerHTML = newSizeInMb+" MB<br>"+fileName;
                        checkSize = true;
                        document.getElementById("ImageLarger").innerHTML = "";
                    }
                    else 
                    {
                        sizeInkb=fileSize/1024;
                        var newSizeInKb=sizeInkb.toFixed(1);
                        document.getElementById("detailsOfProfile").innerHTML = newSizeInKb+" KB<br>"+fileName;
                        checkSize = true;
                        document.getElementById("ImageLarger").innerHTML = "";
                    }
                    
                    blnValid = true;
                    chkFileType = true;
                    document.getElementById("uploadProfilePictureError").innerHTML="";
                    break;
                }
            }
                
            if (!blnValid) 
            {
                document.getElementById("uploadProfilePictureError").innerHTML="Sorry, it is an invalid image format, allowed extensions are: " 
                + _validFileExtensions.join(", ");
                document.getElementById("detailsOfProfile").innerHTML = "";
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
    
}
function form5Script(){
    if(document.getElementById("uploadProfilePicture").value != "" && chkFileType == true && checkSize == true )
    {
        document.signupForm.submit();
    }
    else
    {
        document.getElementById("uploadProfilePictureError").innerHTML="Please select profile picture!";
    }
}



// Form7Script
function FatherStatus(){
	if(document.signupForm.fatherStatus.value==0)		{document.getElementById("fatherStatusError").innerHTML="please select your father status";
														 }
	else												{document.getElementById("fatherStatusError").innerHTML="";
														 return true;}
}
function MotherStatus(){
	if(document.signupForm.motherStatus.value==0)		{document.getElementById("motherStatusError").innerHTML="please select mother status";
														 }
	else												{document.getElementById("motherStatusError").innerHTML="";
														 return true;}
}
function NoOfBrothers(){
	if(document.signupForm.noOfBrothers.value==0)		{document.getElementById("noOfBrothersError").innerHTML="please select no of brothers";
														 }
	else												{document.getElementById("noOfBrothersError").innerHTML="";
														 return true;}
}
function NoOfSisters(){
	if(document.signupForm.noOfSisters.value==0)		{document.getElementById("noOfSistersError").innerHTML="please select no of sisters";
														 }
	else												{document.getElementById("noOfSistersError").innerHTML="";
														 return true;}
}


function form7Script(){
	FatherStatus();
	MotherStatus();
	NoOfBrothers();
    NoOfSisters();
    AboutYourself();
	if( FatherStatus() == true && MotherStatus() == true && NoOfBrothers() == true && NoOfSisters() == true )
	{
		document.getElementById("block7").style.display="none";
		document.getElementById("block8").style.display="block";
		document.getElementById("whitePageCenter").style.backgroundColor="#FFFFFF";
	}
}


// Form8Script
function PartnerMaritalStatus(){
	if(document.signupForm.partnerMaritalStatus.value==0){document.getElementById("partnerMaritalStatusError").innerHTML="select your marital status";
														 }
	else												{document.getElementById("partnerMaritalStatusError").innerHTML="";
														 return true;}
}
function PartnerAge(){
	if(document.signupForm.partnerAge.value==0)			{document.getElementById("partnerAgeError").innerHTML="please select partner age";
														 }
	else												{document.getElementById("partnerAgeError").innerHTML="";
														 return true;}
}
function PartnerHeight(){
	if(document.signupForm.partnerHeight.value==0)		{document.getElementById("partnerHeightError").innerHTML="please select partner height";
														 }
	else												{document.getElementById("partnerHeightError").innerHTML="";
														 return true;}
}	
function PartnerReligion(){
	if(document.signupForm.partnerReligion.value==0)	{document.getElementById("partnerReligionError").innerHTML="select religion";
														 }
	else												{document.getElementById("partnerReligionError").innerHTML="";
														 return true;}
}
function PartnerLanguage(){
	if(document.signupForm.partnerLanguage.value==0)	{document.getElementById("partnerLanguageError").innerHTML="select language";
														 }
	else												{document.getElementById("partnerLanguageError").innerHTML="";
														 return true;}
}
function PartnerEducation(){
	if(document.signupForm.partnerEducation.value==0)	{document.getElementById("partnerEducationError").innerHTML="select Education";
														 }
	else												{document.getElementById("partnerEducationError").innerHTML="";
														 return true;}
}
function PartnerComplexion(){
	if(document.signupForm.partnerComplexion.value==0)	{document.getElementById("partnerComplexionError").innerHTML="select complexion";
														 }
	else												{document.getElementById("partnerComplexionError").innerHTML="";
														 return true;}
}
function PartnerClan(){
	if(document.signupForm.partnerClan.value==0)		{document.getElementById("partnerClanError").innerHTML="select clan";
														 }
	else												{document.getElementById("partnerClanError").innerHTML="";
														 return true;}
}
function PartnerFamilyAffluence(){
	if(document.signupForm.partnerFamilyAffluence.value==0)	{document.getElementById("partnerFamilyAffluenceError").innerHTML="select family affluence";
														 }
	else												{document.getElementById("partnerFamilyAffluenceError").innerHTML="";
														 return true;}
}
function PartnerLocation(){
	var partnerLocationVar=document.signupForm.partnerLocation.value;
	var partnerLocationLengthVar=partnerLocationVar.length;
	
	if(partnerLocationVar=="")											
	{
		document.getElementById("partnerLocationError").innerHTML="location";
	}
	else if(!/^[a-zA-Z0-9.,& ]*$/g.test(partnerLocationVar))			{document.getElementById("partnerLocationError").innerHTML="Invalid location (only A-Z allowed)";
																	 }
	else if(partnerLocationLengthVar>30)							{document.getElementById("partnerLocationError").innerHTML="location is too much long. put short location";
																	 }
	else if(partnerLocationLengthVar<3)								{document.getElementById("partnerLocationError").innerHTML="location is not valid. enter correct location";
																	 }
	else															{
																	 document.getElementById("partnerLocationError").innerHTML=""; return true;}
}
function PartnerAbout(){
	var partnerAboutVar=document.signupForm.partnerAbout.value;
	var partnerAboutLengthVar=partnerAboutVar.length;
	
	if(partnerAboutVar=="")											
	{
		document.getElementById("partnerAboutError").innerHTML="write few lines about partner";
	}
	else if(!/^[a-zA-Z0-9.,& ]*$/g.test(partnerAboutVar))			{document.getElementById("partnerAboutError").innerHTML="only charcters(A-Z) are allowed";
																	 }
	else if(partnerAboutLengthVar>500)								{document.getElementById("partnerAboutError").innerHTML="it's too lengthy. write short!";
																	 }
	else if(partnerAboutLengthVar<10)								{document.getElementById("partnerAboutError").innerHTML="write few lines about partners";
	 																 }
	else															{
																	 document.getElementById("partnerAboutError").innerHTML=""; return true;}
}
function form8Script(){
	PartnerMaritalStatus();
	PartnerAge();
	PartnerHeight();
	PartnerReligion();
	PartnerLanguage();
	PartnerEducation();
	PartnerComplexion();
	PartnerClan();
	PartnerFamilyAffluence();
	PartnerLocation();
	PartnerAbout()
	if( PartnerMaritalStatus() == true && PartnerAge() == true && PartnerHeight() == true && PartnerReligion() == true && PartnerLanguage() == true && 
	PartnerEducation() == true && PartnerComplexion() == true && PartnerClan() == true && PartnerFamilyAffluence() == true && PartnerLocation() == true && PartnerAbout() == true )
	{																					  
		document.getElementById("block8").style.display="none";
		document.getElementById("whitePageCenter").style.backgroundColor="white"
		document.getElementById("block5").style.display="block";
	}
}


