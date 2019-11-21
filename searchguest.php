<?php
session_start();
require 'inc/connection/connect.php';


if (!isset($_SESSION["firstPersonId"])){
    $firstPerson=1;
}
else{
    $firstPerson=$_SESSION["firstPersonId"];
}
?>

<?php include('inc/pages/links-one.php');?>



<!---Pagination--->
<?php


$profilePictureResult="";
$ageResult="";
$maritalStatusResult="";
$heightResult="";
$siknColorResult="";
$religionResult="";
$educationResult="";
$familyTypeResult="";
$familyValuesResult="";
$familyAffluenceResult="";
$salaryResult="";
$languageResult="";
$profileCreatedByResult="";
$clanResult="";
$casteResult="";
$professionResult="";
$educationResult="";
$countryResult="";
$provinceResult="";
$districtResult="";
$cityResult="";



function ageCalculator($dob){
    if(!empty($dob)){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $ag = $birthdate->diff($today)->y;
        $mn = $birthdate->diff($today)->m;
        $dy = $birthdate->diff($today)->d;
        return "$ag Years";
    }else{
        return 0;
    }
}



function setAllCheckBox($select,$getChekboxes,$nameInDatabase)
{
	global $select;
	$first=0;
	$totalArrayLength=sizeof($getChekboxes);
	
	if($nameInDatabase == "dob")
	{
		foreach($getChekboxes as $check)
		{	
			if($first == 0)
			{
				$select .="AND ( TIMESTAMPDIFF(YEAR,`$nameInDatabase`,NOW()) $check";
				if($first == $totalArrayLength-1)
				{
					$select .=")";
				}
			}
			else if($first == $totalArrayLength-1)
			{
				$select .=" OR TIMESTAMPDIFF(YEAR,`$nameInDatabase`,NOW()) $check)";
			}
			else
			{
				$select .=" OR TIMESTAMPDIFF(YEAR,`$nameInDatabase`,NOW()) $check";
			}
			$first++;
		}
	}
	else if($nameInDatabase == "height")
	{
		foreach($getChekboxes as $check)
		{	
			if($first == 0)
			{
				$select .="AND ($nameInDatabase $check ";
				if($first == $totalArrayLength-1)
				{
					$select .=")";
				}
			}
			else if($first == $totalArrayLength-1)
			{
				$select .=" OR $nameInDatabase $check)";
			}
			else
			{
				$select .=" OR $nameInDatabase $check ";
			}
			$first++;
		}
	}
	else
	{
		foreach($getChekboxes as $check)
		{
			if($first == 0)
			{
				$select .="AND ($nameInDatabase='$check' ";
				if($first == $totalArrayLength-1)
				{
					$select .=")";
				}
			}
			else if($first == $totalArrayLength-1)
			{
				$select .=" OR $nameInDatabase='$check')";
			}
			else
			{
				$select .=" OR $nameInDatabase='$check' ";
			}
			$first++;
		}
	}
	
	return $select;
}





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

	
$id="";
$selectSomeID=false;
if(isset($_POST["submitSearchById"]))
{
	$id=test_input($_POST["id"]);
	if($id !="")
	{
		$selectForId="SELECT * FROM signup where id=$id ";
		$_SESSION["countRows"]=1;
		$_SESSION["select"]=$selectForId;
	}
	else
	{
		$selectSomeID=true;
	}
}

if(isset($_POST["submitForm"]))
{
	$select="SELECT * FROM signup WHERE 1=1  ";	
	if(isset($_POST["publicProfile"]))		{	setAllCheckBox($select,$_POST["publicProfile"],"publicProfile");	}
	if(isset($_POST["dob"]))				{	setAllCheckBox($select,$_POST["dob"],"dob");	}
	if(isset($_POST["maritalStatus"]))		{	setAllCheckBox($select,$_POST["maritalStatus"],"maritalStatus");	}
	if(isset($_POST["height"]))				{	setAllCheckBox($select,$_POST["height"],"height");	}
	if(isset($_POST["complexion"]))			{	setAllCheckBox($select,$_POST["complexion"],"complexion");	}
	if(isset($_POST["religion"]))			{	setAllCheckBox($select,$_POST["religion"],"religion");	}
	if(isset($_POST["education"]))			{	setAllCheckBox($select,$_POST["education"],"education");	}
	if(isset($_POST["familyType"]))			{	setAllCheckBox($select,$_POST["familyType"],"familyType");	}
	if(isset($_POST["familyValues"]))		{	setAllCheckBox($select,$_POST["familyValues"],"familyValues");	}
	if(isset($_POST["familyAffluence"]))	{	setAllCheckBox($select,$_POST["familyAffluence"],"familyAffluence");	}
	if(isset($_POST["salary"]))				{	setAllCheckBox($select,$_POST["salary"],"salary");	}
	if(isset($_POST["language"]))			{	setAllCheckBox($select,$_POST["language"],"language");	}
	if(isset($_POST["profileCreatedBy"]))	{	setAllCheckBox($select,$_POST["profileCreatedBy"],"profileCreatedBy");	}
	if(isset($_POST["clan"]))				{	setAllCheckBox($select,$_POST["clan"],"clan");	}
	
	if(isset($_POST["caste"]) && $_POST["caste"] !="0" )
	{
		$caste=$_POST["caste"];
		$select .="AND  caste='$caste' ";
		$casteResult=" 'Caste' ";
	}
	if(isset($_POST["profession"]) && $_POST["profession"] !="0")
	{
		$profession=$_POST["profession"];
		$select .="AND  profession='$profession' ";
		$professionResult=" 'Caste' ";
	}
	if(isset($_POST["country"]) && $_POST["country"] !="0")
	{
		$country=$_POST["country"];
		$select .="AND  country='$country' ";
		$countryResult=" 'Country' ";
	}
	if( isset($_POST["province"]) && $_POST["province"] !="0")
	{	
	    $province=$_POST["province"];
		$select .="AND  province='$province' ";
		$provinceResult=" 'Province' ";
	}
	if(isset($_POST["district"]) && $_POST["district"] !="0")
	{
		$district=$_POST["district"];
		$select .="AND district='$district' ";
		$districtResult=" 'District' ";
	}
	if(isset($_POST["city"]) && $_POST["city"] !="0")
	{
		$city=$_POST["city"];
		$select .="AND city='$city'";
		$cityResult=" 'City' ";
	}
	$_SESSION["countRows"]=mysqli_num_rows( mysqli_query($con, $select) );
	$_SESSION["select"]=$select;
}


if(isset($_SESSION['FirstVisit']) == false || isset($_POST["reset"]) )
{
	$select="SELECT * FROM signup WHERE 1=1  ";	
	$_SESSION["countRows"]=mysqli_num_rows( mysqli_query($con, $select) );
	$_SESSION["select"]=$select;		
	$_SESSION["FirstVisit"]=true;
}
if(isset($_SESSION['FirstVisit']) == true && !isset($_POST["submitForm"]) && !isset($_POST["submitSearchById"]) && !isset($_GET["page"]))
{
	$_SESSION["FirstVisit"]=true;	
	$select="SELECT * FROM signup WHERE 1=1  ";	
	$_SESSION["countRows"]=mysqli_num_rows( mysqli_query($con, $select) );
	$_SESSION["select"]=$select;
}

$select=$_SESSION["select"];
$findGenderQuery=mysqli_query($con, "select gender from signup where id=$firstPerson");

if (isset($_SESSION["firstPersonId"])){
    
    while($findGenderArray=mysqli_fetch_array($findGenderQuery))
    {
        if($findGenderArray["gender"] == "male")
        {
            $select .=" AND gender != 'male' "; 
            $_SESSION["select"]=$select;
            $_SESSION["countRows"]=@mysqli_num_rows( mysqli_query($con, $select) );
        }
        else
        {
            $select .=" AND gender != 'female' "; 
            $_SESSION["select"]=$select;
            $_SESSION["countRows"]=@mysqli_num_rows( mysqli_query($con, $select) );
        }
    }
}



if(isset($_POST["indexsearch"])){
	$select="SELECT * FROM signup WHERE 1=1  ";	
	if(isset($_POST["gender"]) && $_POST["gender"] !="0"){
		$gender=$_POST["gender"];
		$select .="AND  gender='$gender' ";
		$genderResult=" 'gender' ";
	}
	if(isset($_POST["caste"]) && $_POST["caste"] !="0"){
		$caste=$_POST["caste"];
		$select .="AND  caste='$caste' ";
		$casteResult=" 'caste' ";
	}
	if(isset($_POST["city"]) && $_POST["city"] !="0"){
		$city=$_POST["city"];
		$select .="AND city='$city'";
		$cityResult=" 'City' ";
	}
	if(isset($_POST["district"]) && $_POST["district"] !="0"){
		$district=$_POST["district"];
		$select .="AND  district='$district' ";
		$districtResult=" 'district' ";
	}
	if(isset($_POST["province"]) && $_POST["province"] !="0"){
		$province=$_POST["province"];
		$select .="AND  province='$province' ";
		$provinceResult=" 'province' ";
	}
	if(isset($_POST["country"]) && $_POST["country"] !="0"){
		$country=$_POST["country"];
		$select .="AND  country='$country' ";
		$countryResult=" 'country' ";
	}
	if(isset($_POST["religion"]) && $_POST["religion"] !="0"){
		$religion=$_POST["religion"];
		$select .="AND religion='$religion'";
		$religionResult=" 'religion' ";
	}
	if(isset($_POST["profession"]) && $_POST["profession"] !="0"){
		$profession=$_POST["profession"];
		$select .="AND  profession='$profession' ";
		$professionResult=" 'profession' ";
	}
	if(isset($_POST["language"]) && $_POST["language"] !="0"){
		$language=$_POST["language"];
		$select .="AND  language='$language' ";
		$languageResult=" 'language' ";
	}
	if(isset($_POST["clan"]) && $_POST["clan"] !="0"){
		$clan=$_POST["clan"];
		$select .="AND  clan='$clan' ";
		$clanResult=" 'clan' ";
	}
	if(isset($_POST["education"]) && $_POST["education"] !="0"){
		$education=$_POST["education"];
		$select .="AND education='$education'";
		$educationResult=" 'education' ";
	}
	if(isset($_POST["hobby"]) && $_POST["hobby"] !="0"){
		$hobby=$_POST["hobby"];
		$select .="AND  hobby='$hobby' ";
		$hobbyResult=" 'hobby' ";
	}
	if(isset($_POST["familytype"]) && $_POST["familytype"] !="0"){
		$familytype=$_POST["familytype"];
		$select .="AND  familyType='$caste' ";
		$familytypeResult=" 'familytype' ";
	}
	if(isset($_POST["familyvalues"]) && $_POST["familyvalues"] !="0"){
		$familyvalues=$_POST["familyvalues"];
		$select .="AND  familyValues='$familyvalues' ";
		$familyvaluesResult=" 'familyvalues' ";
	}
	if(isset($_POST["familyaffluence"]) && $_POST["familyaffluence"] !="0"){
		$familyaffluence=$_POST["familyaffluence"];
		$select .="AND familyaffluence='$familyaffluence'";
		$familyaffluenceResult=" 'familyaffluence' ";
	}
	$_SESSION["countRows"]=mysqli_num_rows( mysqli_query($con, $select) );
	$_SESSION["select"]=$select;
}



$count = $_SESSION["countRows"];
$per_page =10;					
$pages = ceil($count/$per_page);
if(@$_GET['page']==""){		$page="1";	}
else{	$page=$_GET['page'];	}
$start = ($page - 1) * $per_page;

$select=$_SESSION["select"];
if (isset($_SESSION["firstPersonId"])){
    $select .="AND id!=$firstPerson ";
}
$select .="AND makeMeHide='show' ";
$count=@mysqli_num_rows( mysqli_query($con, $select) );
$sql   = $select." ORDER BY `signup`.`id` DESC  LIMIT $start,$per_page ";	
$query2=mysqli_query($con, $sql);

$blankQuery=false;
if(@mysqli_num_rows($query2) == 0 && isset($_POST["submitSearchById"])){$blankQuery=true;}



//break integers into chunks and put into two dimessional array
$rowIndex=1;
$colIndex=1;
$chunk=4;						// Change number of indexes you want to show 5:1,2,3,4,5 will show 1 to five on first page
$arrayOfIndexes = array();
for($index=1; $index<=$pages; $index++)//get all integers from all "$pages": eg: pages=18; make chunks of 5 and put in array
{
	$arrayOfIndexes[$rowIndex][$colIndex]=$index;
	$colIndex++;
	if($index == $chunk)
	{
		$rowIndex=$rowIndex+1;
		$chunk=$chunk+4;		// Change also here number of indexes you want to show 5:1,2,3,4,5 will show 1 to five on first page
		$colIndex=1;
	}
}





//show and match integer chunk with pageValue eg:-pageValue=3:chunk == 12345 | pageValue=8:chunk=678910 
for($row=1; $row<=$pages; $row++)
{	
	@$lengthOfRow=count($arrayOfIndexes[$row]);
	
	for($col=1; $col<=$lengthOfRow; $col++)
	{
		if($arrayOfIndexes[$row][$col] == $page)//match or compare integers with pageValue
		{
			for($thisRow=1; $thisRow<=$lengthOfRow; $thisRow++)
			{
				$lastOne=$arrayOfIndexes[$row][$thisRow];	//show specific chunk here:[12345] or [678910]	
				if($thisRow==1)
				{
					$firstOne=$arrayOfIndexes[$row][$thisRow];
				}
			}
		}
	}
}
?><!---EndPagination--->













		


















<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Free online rishta in pakistan - Free matrimonial website</title>
<meta name="description" content="Find free online rishta in pakistan, rishtaweb is free online web based portal to search out rishta in your desired city, caste and religion and connect.">



<style>

#target a{color:#FFFFFF; font-weight:bolder; font-size:15px; padding:10px} li{margin:7px; margin-left:5px;}
#target a:hover{background-color:#800000;color:#FFFFFF; border-radius:3px;}	
#logoMargin{ margin-top:0px;}
@media only screen and (max-width: 767px)
{
	#logoMargin{ margin-top:0px}
	#navbarToggleButtonTop{color:#FFFFFF; font-size:24px; border:none; padding:10px; margin-top:5px; margin-bottom:5px; cursor:pointer; border-radius:2px; border-radius:4px;}
	#navbarToggleButtonTop:hover{background-color:#A00000; color:#FFFFFF; border-radius:3px;}	
	#navbarToggleButtonTopImage{color:#FFFFFF; font-size:24px; border:none; padding:0px; margin-top:9px; margin-bottom:5px; cursor:pointer; border-radius:2px; border-radius:4px;}
	#navbarToggleButtonTopImage:hover{ background-color:#A00000}
}

#logoText1{font-size:39px; color:#FFFFFF; font-family: 'QanelasSoftDEMO-ExtraBold';}
#logoText2{color:#c48f65}
@media only screen and (max-width: 767px) {#logoText1{ font-size:26px; margin-top:9px}}





#searchIcon{ color:#D69C2F; font-size:16px; border:none; cursor:pointer; margin-top:8px; border-radius:1px;}
#searchIcon:hover{ background-color:#FFFFFF; }
#navbarToggleButton{ color:#FFFFFF; font-size:16px; border:none; cursor:pointer; margin-top:10px; border-radius:2px; padding-top:10px; padding-bottom:10px; border-radius:4px;}
#navbarToggleButton:hover{background-color:#A00000; color:#FFFFFF;}










	
@media only screen and (max-width: 800px) {#fadeshow1 {display: none;}}


.form-control:focus 
{
	box-shadow:0px 0px 0px #9191FF;
	border:2px solid #00539c;
	border-radius:2px;
}
.form-control
{
	border:1px solid #C8C8C8;
	box-shadow: 0 0 0 0 ;
}

.tooltip{ font-family:"Segoe UI"; padding:0px;}

/*Collapse styling*/
.coll:after {font-family: "Glyphicons Halflings"; content: "\e252";float: right; font-size:9px;}
.coll.collapsed:after {content: "\e250";}

.collAd:after {font-family: "Glyphicons Halflings"; content: "\e252";float: right; font-size:13px; margin-top:1px}
.collAd.collapsed:after {content: "\e250"; font-size:13px; margin-top:1px}

#textcolor:hover{color:#0066CC;}

/*cehck box styling*/
.checkBoxLabel {display: block; position: relative; padding-left: 35px; margin-bottom: 12px;cursor: pointer;font-size:12px; font-family:sans-serif; font-weight:500;
-webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;}
.checkBoxLabel input { position: absolute; opacity: 0;cursor: pointer;height: 0; width: 0;}
.checkmark { position: absolute;top: 0;left: 0;height: 20px; width: 20px; background-color: #eee;}
.checkBoxLabel:hover input ~ .checkmark { background-color: #ccc;}
.checkBoxLabel input:checked ~ .checkmark { background-color: white;border:1px solid lightgray;}
.checkmark:after {content: ""; position: absolute; display: none;}
.checkBoxLabel input:checked ~ .checkmark:after {display: block;}
.checkBoxLabel .checkmark:after {left: 7px; top: 2px; width: 6px; height: 11px;border:1px solid #00cc00;border-width: 0 2px 2px 0;
  -webkit-transform: rotate(45deg);-ms-transform: rotate(45deg); transform: rotate(45deg);}
  
/*center*/
#add{background-color:#FFFFFF; border:15px solid #FFFFFF; border-right:0px; border-radius:5px; padding:0px;}
@media only screen and (max-width: 775px) {#add {border-right:15px solid #FFFFFF;}}
#text{overflow-wrap:break-word;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;}
#connectbtn :hover{ background-color:#eda978;}  
@media only screen and (max-width: 775px) 
{#addBorder {border-right:10px solid #FFFFFF;} #nameBox { height:30px; background-color:#FFFFFF; line-height:30px} #detailBox{ border-top:0px;}}
#text{overflow-wrap:break-word;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;}
#connectbtn :hover{ background-color:#eda978;}
#changeCenter{border:1px solid #CCCCCC; background-color:#FFFFFF; padding:0px; border-radius:8px; padding-left:0px; padding-right:0px; margin-bottom:20px; }

#hidePrefrences
{
	padding:0px; color:#666666; font-family:'Segoe UI'; border-left:2px solid #E6E6FF; margin-top:5px;
	text-align:right;  text-align:left; padding-left:12px; padding-top:2px;
}

#hidePrefrencesParent:hover #hidePrefrences{  visibility: visible; opacity: 1;  }
#aboutText{margin-right:15px; font-weight:600; font-family:'Segoe UI'; color:#00539c; margin-top:4px;}
#namePadding{padding:10px 0px; text-align:center; margin-top:10px; border:1px solid #EEEEEE; border-radius:5px; font-size:16px; background-color:#fbfbfb;
										margin-left:auto; margin-right:auto; width:155px; margin-bottom:15px }	
#about{padding:5px; padding-left:25px; padding-right:5px;}													
#profileId{color:#999999; font-family:'Calibri Light'; margin-top:1px; font-size:11px}
#visitProfile{padding:6px; border:1px solid #7da046; background-color:#92b558; border-radius:2px; text-align:center; color:#FFFFFF; margin-bottom:10px;
								font-weight:600; margin-top:5px; width:155px; margin-left:auto; margin-right:auto; font-family:'Segoe UI'; font-size:14px;}
#body{background-color:#F0F0F0}		
#advancedSearchText{color:#578CA9; text-align:center; background-color:#F3F3F3; padding-top:12px; padding-bottom:12px;
									font-family:'Segoe UI'; font-size:16px; border-top-left-radius:8px; border-top-right-radius:8px; font-weight:700}		
#advancedSearchBox{padding:0px; border-radius:8px; border:1px solid #CCCCCC; background-color:#FFFFFF}	
#searchButtonHeight{border-radius:2px; font-weight:600; text-align:center; padding:15px 0px;}		
#sticky{position: -webkit-sticky; position: sticky; bottom: 0px; padding:7px; border-top:1px solid #CCCCCC; background-color:#FFFFFF; box-shadow:0px -2px 2px lightgray}
#searchByIdBox{padding:15px; border-radius:8px; border:1px solid #CCCCCC; margin-top:0px; background-color:#FFFFFF; }
#selectOptionText{font-size:12px; font-weight:400; color:#666666}
#RightSideBar{padding:10px; padding-top:5px; display:block}	
.con-fl-pa{
    padding:0px 40px;
}		
#leftSideBar{ padding: 0px 10px 0px 40px;}									
@media only screen and (max-width: 775px) 
{
	#hidePrefrences{  border-left:2px solid #F4F4FF; }
	#about{ font-size:12px; padding-left:10px;} #myselfChild{ margin-left:-40px}#aboutText{ margin-right:55px}
	#changeCenter{ border-radius:8px; border:1px solid #C8C8C8; box-shadow:0px 0px 3px gray}
	#leftSideBar{ display:none; padding: 10px;}
	#namePadding{ padding:4px; height:auto; margin-top:5px; border-radius:2px; margin-bottom:5px;}
	#hidePrefrences{  visibility: visible; opacity: 1;  }
	#profileId{ text-align:right}
	#visitProfile{ margin-bottom:5px;}
	#body{background-color:#EBEBEB}		
	#advancedSearchText{color:#333333; background-color:lightgray; border-top-left-radius:8px; border-top-right-radius:8px; 
		border:1px solid #eef3f6; margin-bottom:20px; font-size:18px;}	
	#advancedSearchBox{padding:0px; border-radius:8px; border:1px solid #999999;}		
	#searchButtonHeight{height:45px}
	#searchByIdBox{border:1px solid #999999; margin-bottom:25px; box-shadow:0px 0px 10px lightgray }
	#selectOptionText{font-size:12px; font-weight:400; color:#333333; }	
    #RightSideBar{display:none}	
    .con-fl-pa{
        padding:10px;
    }	
}







#changeCenter:hover { border:1px solid lightgray; box-shadow:0px 0px 8px lightgray;}


</style>


<!-- select2 -->
<script src="<?php echo $base_url;?>assets/select2/select2popper.js"></script> 
<script src="<?php echo $base_url;?>assets/select2/select2min.js"></script> 
<link rel="stylesheet" href="<?php echo $base_url;?>assets/select2/select2.css"> 
<link rel="stylesheet" href="<?php echo $base_url;?>assets/css/style.css"  />
</head>

<body id="body">

<!-- navbar -->
<?php 
    if(isset($_SESSION["firstPersonId"])) {
        include('inc/pages/navbar-login.php');          // login navbar
    }
    else{
        include('inc/pages/navbar-index.php');         // guest navbar
        ?><br><br><?php
    }
?>


<div class="container-fluid">
	<div class="row">
		<h1 class="se-h1-title"> free online marriage, shadi or rishta website in pakistan, </h1>
		<div class="col-lg-12 searchguest-bg" style="padding: unset;">
            <div class="col-lg-12" style="margin-top:50px; padding:0px; margin-bottom:30px">
            <div class="container-fluid">
                <span id="search-icon-guest" class="navbar-toggle search-icon-guest"  style="font-size:25px;">
					 <i class="fas fa-search" style="font-weight:700"></i>
				</span>
				<script>
				  $("#search-icon-guest").click(function(){
					$("#leftSideBar").toggle();
					$("#centerBar").toggle();
					$("#focus").focus();
					$("#showEmptyLeftSideBar").toggle();
				  });
				</script>
            </div>
				<div class="col-lg-3 col-md-3 col-sm-4" id="leftSideBar">
				
					<!---leftSideBar--->
					<div class="col-lg-1"></div>
					<div class="col-lg-12 " style="padding:0px; margin-bottom:100px" >
					
				  		<div class="col-lg-12 leftSideBar-all">
				  			<a href="" class="leftSideBar-all-li">RESET ALL FILTERS</a>
						</div>
						<div class="col-lg-12 " id="searchByIdBox">
							<form name="searchById" method="post" action="searchguest.php">
								<input type="text" class="form-control" placeholder="Id example: 5768" style="border-radius:2px" name="id"/>
								<button type="submit" id="submitSearchById" name="submitSearchById" class="btn btn-block submitSearchById" >
									<span class="glyphicon glyphicon-search" style="float:left"></span>SEARCH BY ID
								</button>
							</form>
							 <script type="text/javascript">				  	
								var input = document.getElementById("id");
								input.addEventListener("keyup", function(event) {
									event.preventDefault();
									if (event.keyCode === 13) {
										document.getElementById("submitSearchById").click();
									}
								});
							 </script>
						</div>
									
						<div class="col-lg-12 " style="padding-top:0px; margin-top:15px; padding:0px; ">
							<div class="col-lg-12 " id="advancedSearchBox">
								<div class="col-lg-12 " style="margin-bottom:20px; padding:0px; margin-top:0px; ">
									<p id="advancedSearchText">
										 SELECT OPTIONS BELOW<br />
										<span id="selectOptionText">
											Select Options Below for Advanced Search
										</span>
									</p>
									<!---AdvancedSearch--->
									
									
									
									<div class="col-lg-12 " style="padding:0px;">
									<form method="post" action="searchguest.php" name="searchForm"   >
									
									
									
										<div class="col-lg-12" style="padding:10px; padding-top:0px; margin-top:20px">
											
											<?php if(!isset($firstPerson)){?>
												<div class="col-lg-12" style="padding:0px">
													<div class="col-lg-12" style="padding:5px; padding-top:0px">
														<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																	data-toggle="collapse" data-target="#profilePictureColl">Profile Picture</div>
														<div class="col-lg-12 collapse in" id="profilePictureColl" style="margin-top:8px">
															<label class="checkBoxLabel">Public
															<input type="checkbox" name="publicProfile[]" value="Public" id="focus"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Hidden
															<input type="checkbox" name="publicProfile[]" value="Private"><span class="checkmark"></span>
															</label>
														</div>
														<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
													</div>
												</div>
											<?php }?>
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#ageColl">Age Range</div>
													<div class="col-lg-12 collapse in" id="ageColl" style="margin-top:8px">
														<label class="checkBoxLabel">18 years - 24 years
														  <input type="checkbox" name="dob[]" value="BETWEEN 18 AND 24"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">25 years - 32 years
														  <input type="checkbox" name="dob[]" value="BETWEEN 25 AND 32"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">33 years - 45 years
														  <input type="checkbox" name="dob[]" value="BETWEEN 33 AND 45"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">46 years - 65 years
														  <input type="checkbox" name="dob[]" value="BETWEEN 46 AND 65"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Greater than 66 years
														  <input type="checkbox" name="dob[]" value="BETWEEN 66 AND 100"><span class="checkmark"></span>
														</label>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600; " id="textcolor" 
																data-toggle="collapse" data-target="#maritalStatusColl">Marital Status</div>
													<div class="col-lg-12 collapse in" id="maritalStatusColl" style="margin-top:8px">
														<label class="checkBoxLabel">Never Married
														  <input type="checkbox" name="maritalStatus[]" value="Never Married"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Divorced
														  <input type="checkbox" name="maritalStatus[]" value="Divorced"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Separated
														  <input type="checkbox" name="maritalStatus[]" value="Separated"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Widow/Widower
														  <input type="checkbox" name="maritalStatus[]" value="Widow/Widower"><span class="checkmark"></span>
														</label>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#heightColl">Height Range</div>
													<div class="col-lg-12 collapse in" id="heightColl" style="margin-top:8px">
														<label class="checkBoxLabel">5.0ft or Less
														  <input type="checkbox" name="height[]" value="BETWEEN 4.0 AND 5.0"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">5.1ft - 6.0ft
														  <input type="checkbox" name="height[]" value="BETWEEN 5.1 AND 6.0"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">6.1ft - 7.0ft
														  <input type="checkbox" name="height[]" value="BETWEEN 6.1 AND 7.0"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">7.1ft or Greater
														  <input type="checkbox" name="height[]" value="BETWEEN 7.1 AND 8.0"><span class="checkmark"></span>
														</label>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#complexionColl">Skin Color</div>
													<div class="col-lg-12 collapse in" id="complexionColl" style="margin-top:8px">
														<label class="checkBoxLabel">Brown
														  <input type="checkbox" name="complexion[]" value="Brown"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">White
														  <input type="checkbox" name="complexion[]" value="White"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Dark
														  <input type="checkbox" name="complexion[]" value="Dark"><span class="checkmark"></span>
														</label>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#religionColl">Religion</div>
													<div class="col-lg-12 collapse in" id="religionColl" style="margin-top:8px">
														<label class="checkBoxLabel">Just A Muslim
														  <input type="checkbox" name="religion[]" value="Just a Muslim"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Brailvi
														  <input type="checkbox" name="religion[]" value="Brailvi"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Deobandi
														  <input type="checkbox" name="religion[]" value="Deobandi"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Wahabi
														  <input type="checkbox" name="religion[]" value="Wahabi"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Abbasi
														  <input type="checkbox" name="religion[]" value="Abbasi"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel" onclick="ShowMoreReligion()" id="ShowMoreReligion1">
															<div style="color:#88b04b; margin-left:-35px; font-family:'Segoe UI'">
																Show More
															</div>
														</label>
														<script>
															function ShowMoreReligion()
															{
																document.getElementById("ShowMoreReligion1").style.display="none";
																document.getElementById("ShowMoreReligion2").style.display="block";
																document.getElementById("ShowLessReligion1").style.display="block";
															}
														</script>
														<div id="ShowMoreReligion2" style="display:none">
															<label class="checkBoxLabel">Shia
															  <input type="checkbox" name="religion[]" value="Shia"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Hindu
															  <input type="checkbox" name="religion[]" value="Hindu"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Parsi
															  <input type="checkbox" name="religion[]" value="Parsi"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel" onclick="ShowLessReligion()" id="ShowLessReligion1">
																<div style="color:#88b04b; margin-left:-35px; font-family:'Segoe UI'">
																	Show Less
																</div>
															</label>
															<script>
																function ShowLessReligion()
																{
																	document.getElementById("ShowMoreReligion1").style.display="block";
																	document.getElementById("ShowMoreReligion2").style.display="none";
																	document.getElementById("ShowLessReligion1").style.display="none";
																}
															</script>
														</div>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#educationColl">Education</div>
													<div class="col-lg-12 collapse in" id="educationColl" style="margin-top:8px">
														<label class="checkBoxLabel">High school
														  <input type="checkbox" name="education[]" value="Matric or Less"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Intermediate
														  <input type="checkbox" name="education[]" value="Intermediate"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Diploma
														  <input type="checkbox" name="education[]" value="Diploma (13 Years)"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Bachelors 14 years
														  <input type="checkbox" name="education[]" value="Bachelors (14 years)"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Bachelors 16 years
														  <input type="checkbox" name="education[]" value="Bachelors (16 years)"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel" onclick="ShowMoreEducation()" id="ShowMoreEducation1">
															<div style="color:#88b04b; margin-left:-35px; font-family:'Segoe UI'">
																Show More
															</div>
														</label>
														<script>
															function ShowMoreEducation()
															{
																document.getElementById("ShowMoreEducation1").style.display="none";
																document.getElementById("ShowMoreEducation2").style.display="block";
																document.getElementById("ShowLessEducation1").style.display="block";
															}
														</script>
														<div id="ShowMoreEducation2" style="display:none">
															<label class="checkBoxLabel">Masters
															  <input type="checkbox" name="education[]" value="Masters"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Doctorate
															  <input type="checkbox" name="education[]" value="Doctorate"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel" onclick="ShowLessEducation()" id="ShowLessEducation1">
																<div style="color:#88b04b; margin-left:-35px; font-family:'Segoe UI'">
																	Show Less
																</div>
															</label>
															<script>
																function ShowLessEducation()
																{
																	document.getElementById("ShowMoreEducation1").style.display="block";
																	document.getElementById("ShowMoreEducation2").style.display="none";
																	document.getElementById("ShowLessEducation1").style.display="none";
																}
															</script>
														</div>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#familyTypeColl">Family Type</div>
													<div class="col-lg-12 collapse in" id="familyTypeColl" style="margin-top:8px">
														<label class="checkBoxLabel">Nuclear
														  <input type="checkbox" name="familyType[]" value="Nuclear"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Joint
														  <input type="checkbox" name="familyType[]" value="Joint"><span class="checkmark"></span>
														</label>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#familyValuesColl">Family Values</div>
													<div class="col-lg-12 collapse in" id="familyValuesColl" style="margin-top:8px">
														<label class="checkBoxLabel">Traditional
														  <input type="checkbox" name="familyValues[]" value="Traditional"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Moderate
														  <input type="checkbox" name="familyValues[]" value="Moderate"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Liberal
														  <input type="checkbox" name="familyValues[]" value="Liberal"><span class="checkmark"></span>
														</label>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#familyAffluenceColl">Family Affluence</div>
													<div class="col-lg-12 collapse in" id="familyAffluenceColl" style="margin-top:8px">
														<label class="checkBoxLabel">Middle Class
														  <input type="checkbox" name="familyAffluence[]" value="Middle Class"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Upper Middle Class
														  <input type="checkbox" name="familyAffluence[]" value="Upper Middle Class"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Affluent
														  <input type="checkbox" name="familyAffluence[]" value="Affluent"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Lower Class
														  <input type="checkbox" name="familyAffluence[]" value="Lower Class">
														  <span class="checkmark"></span>
														</label>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#incomeColl">Income Range(per month)</div>
													<div class="col-lg-12 collapse in" id="incomeColl" style="margin-top:8px">
														<label class="checkBoxLabel">Not Earning Yet
														  <input type="checkbox" name="salary[]" value="Not Earning Yet"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">15,000-30,000
														  <input type="checkbox" name="salary[]" value="15000-30000"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">31,000-60,000
														  <input type="checkbox" name="salary[]" value="31000-60000"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">61,000-100,000
														  <input type="checkbox" name="salary[]" value="61000-100000"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">100,000-200,000
														  <input type="checkbox" name="salary[]" value="100000-200000"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel" onclick="ShowMoreSalary()" id="ShowMoreSalary1">
															<div style="color:#88b04b; margin-left:-35px; font-family:'Segoe UI'">
																Show More
															</div>
														</label>
														<script>
															function ShowMoreSalary()
															{
																document.getElementById("ShowMoreSalary1").style.display="none";
																document.getElementById("ShowMoreSalary2").style.display="block";
																document.getElementById("ShowLessSalary1").style.display="block";
															}
														</script>
														<div id="ShowMoreSalary2" style="display:none">
															<label class="checkBoxLabel">300,000-500,000
															  <input type="checkbox" name="salary[]" value="300000-500000"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">200,000-300,000
															  <input type="checkbox" name="salary[]" value="200000-300000"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Not Want to Mention
															  <input type="checkbox" name="salary[]" value="Not Want to Mention"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel" onclick="ShowLessSalary()" id="ShowLessSalary1">
																<div style="color:#88b04b; margin-left:-35px; font-family:'Segoe UI'">
																	Show Less
																</div>
															</label>
															<script>
																function ShowLessSalary()
																{
																	document.getElementById("ShowMoreSalary1").style.display="block";
																	document.getElementById("ShowMoreSalary2").style.display="none";
																	document.getElementById("ShowLessSalary1").style.display="none";
																}
															</script>
														</div>
															
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#languageColl">Language</div>
													<div class="col-lg-12 collapse in" id="languageColl" style="margin-top:8px">
														<label class="checkBoxLabel">Urdu
														  <input type="checkbox" name="language[]" value="Urdu"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Punjabi
														  <input type="checkbox" name="language[]" value="Punjabi"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Pashto
														  <input type="checkbox" name="language[]" value="Pashto"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Sindhi
														  <input type="checkbox" name="language[]" value="Sindhi"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Saraiki
														  <input type="checkbox" name="language[]" value="Saraiki"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel" onclick="ShowMoreLanguages()" id="showMoreLanguages1">
															<div style="color:#88b04b; margin-left:-35px; font-family:'Segoe UI'">
																Show More
															</div>
														</label>
														<script>
															function ShowMoreLanguages()
															{
																document.getElementById("showMoreLanguages1").style.display="none";
																document.getElementById("showMoreLanguages2").style.display="block";
																document.getElementById("ShowLessLanguages1").style.display="block";
															}
														</script>
														<div id="showMoreLanguages2" style="display:none">
															<label class="checkBoxLabel">Balochi
															  <input type="checkbox" name="language[]" value="Balochi"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Hindko
															  <input type="checkbox" name="language[]" value="Hindko"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Arabic
															  <input type="checkbox" name="language[]" value="Arabic"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Kashmiri
															  <input type="checkbox" name="language[]" value="Kashmiri"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Shina
															  <input type="checkbox" name="language[]" value="Shina"><span class="checkmark"></span>
															</label>	
															<label class="checkBoxLabel">Bengali
															  <input type="checkbox" name="language[]" value="Bengali"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Hindi
															  <input type="checkbox" name="language[]" value="Hindi"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Persian

															  <input type="checkbox" name="language[]" value="Persian"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Chinese
															  <input type="checkbox" name="language[]" value="Chinese"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Spanish
															  <input type="checkbox" name="language[]" value="Spanish"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">French
															  <input type="checkbox" name="language[]" value="French"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Sundanese
															  <input type="checkbox" name="language[]" value="Sundanese"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Russian
															  <input type="checkbox" name="language[]" value="Russian"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Turkish
															  <input type="checkbox" name="language[]" value="Turkish"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Telugu
															  <input type="checkbox" name="language[]" value="Telugu"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Marathi
															  <input type="checkbox" name="language[]" value="Marathi"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Tamil
															  <input type="checkbox" name="language[]" value="Tamil"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Tamil
															  <input type="checkbox" name="language[]" value="Tamil"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Other
															  <input type="checkbox" name="language[]" value="Other"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel" onclick="ShowLessLanguages()" id="ShowLessLanguages1">
																<div style="color:#88b04b; margin-left:-35px; font-family:'Segoe UI'">
																	Show Less
																</div>
															</label>
															<script>
																function ShowLessLanguages()
																{
																	document.getElementById("showMoreLanguages1").style.display="block";
																	document.getElementById("showMoreLanguages2").style.display="none";
																	document.getElementById("ShowLessLanguages1").style.display="none";
																}
															</script>
														</div>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											
											<div class="col-lg-12" style="padding:0px; margin-top:8px;">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#genderColl">Profile Created By</div>
													<div class="col-lg-12 collapse in" id="genderColl" style="margin-top:8px">
														<label class="checkBoxLabel">Myself
														  <input type="checkbox" name="profileCreatedBy[]" value="Myself">
														  <span class="checkmark" ></span>
														</label>
														<label class="checkBoxLabel">Parent
														  <input type="checkbox" name="profileCreatedBy[]" value="Parent"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Guardian
														  <input type="checkbox" name="profileCreatedBy[]" value="Guardian"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Sister
														  <input type="checkbox" name="profileCreatedBy[]" value="Sister"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Brother
														  <input type="checkbox" name="profileCreatedBy[]" value="Brother"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Friend
														  <input type="checkbox" name="profileCreatedBy[]" value="Friend"><span class="checkmark"></span>
														</label>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#clanColl">Clan</div>
													<div class="col-lg-12 collapse in" id="clanColl" style="margin-top:8px">
														<label class="checkBoxLabel">Punjabi
														  <input type="checkbox" name="clan[]" value="Punjabi"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Sindhi
														  <input type="checkbox" name="clan[]" value="Sindhi"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Pashtun
														  <input type="checkbox" name="clan[]" value="Pashtun"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Baloch
														  <input type="checkbox" name="clan[]" value="Baloch"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel">Saraiki
														  <input type="checkbox" name="clan[]" value="Saraiki"><span class="checkmark"></span>
														</label>
														<label class="checkBoxLabel" onclick="ShowMoreClan()" id="showMoreClan1">
															<div style="color:#88b04b; margin-left:-35px; font-family:'Segoe UI'">
																Show More
															</div>
														</label>
														<script>
															function ShowMoreClan()
															{
																document.getElementById("showMoreClan1").style.display="none";
																document.getElementById("showMoreClan2").style.display="block";
																document.getElementById("ShowLessClas1").style.display="block";
															}
														</script>
														<div id="showMoreClan2" style="display:none">
															<label class="checkBoxLabel">Kashmiri
															  <input type="checkbox" name="clan[]" value="Kashmiri"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Gujrati
															  <input type="checkbox" name="clan[]" value="Gujrati"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Brohui
															  <input type="checkbox" name="clan[]" value="Brohui"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Irani
															  <input type="checkbox" name="clan[]" value="Irani"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Arab
															  <input type="checkbox" name="clan[]" value="Arab"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel">Turk
															  <input type="checkbox" name="clan[]" value="Turk"><span class="checkmark"></span>
															</label>
															<label class="checkBoxLabel" onclick="ShowLessClan()" id="ShowLessClan1">
																<div style="color:#88b04b; margin-left:-35px; font-family:'Segoe UI'">
																	Show Less
																</div>
															</label>
															<script>
																function ShowLessClan()
																{
																	document.getElementById("showMoreClan1").style.display="block";
																	document.getElementById("showMoreClan2").style.display="none";
																	document.getElementById("ShowLessClan1").style.display="none";
																}
															</script>
														</div>	
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#castColl">Caste</div>
													<div class="col-lg-12 collapse in" id="castColl" style="margin-top:8px">
														<select class="form-control select2 Caste" name="caste" id="caste">
															<option value="0">Select</option>
															<?php
																$result=mysqli_query($conn, "select * from caste");
																while($r=mysqli_fetch_array($result)){?>
																	<option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
																<?php }
															?>
														</select>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#professionColl">Profession</div>
													<div class="col-lg-12 collapse in" id="professionColl" style="margin-top:8px">
														<select class="form-control select2 Profession" name="profession" id="profession">
															<option value="0">Select</option>
															<?php
															$result=mysqli_query($conn, "select * from profession");
															if(mysqli_num_rows($result) > 0){
																while($r=mysqli_fetch_array($result)){?>
																	<option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
																<?php }
															}
															?>
														</select>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#cityColl">City</div>
													<div class="col-lg-12 collapse in" id="cityColl" style="margin-top:8px">
														<select class="form-control select2 City" name="city" id="City">
															<option value="0">Select</option>
															<?php
																$result=mysqli_query($conn, "select * from city");
																while($r=mysqli_fetch_array($result)){?>
																	<option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
																<?php }
															?>
														</select>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#districtColl">District</div>
													<div class="col-lg-12 collapse in" id="districtColl" style="margin-top:8px">
														<select class="form-control select2 District" name="district" id="district">
															<option value="0">Select</option>
															<?php
															$result=mysqli_query($conn, "select * from district");
															if(mysqli_num_rows($result) > 0){
																while($r=mysqli_fetch_array($result)){?>
																	<option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
																<?php }
															}
															?>
														</select>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#provinceColl">Province</div>
													<div class="col-lg-12 collapse in" id="provinceColl" style="margin-top:8px">
														<select class="form-control select2 Province" name="province" id="province">
															<option value="0">Select</option>
															<?php
															$result=mysqli_query($conn, "select * from province");
															if(mysqli_num_rows($result) > 0){
																while($r=mysqli_fetch_array($result)){?>
																	<option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
																<?php }
															}
															?>
														</select>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#countryColl">Country</div>
													<div class="col-lg-12 collapse in" id="countryColl" style="margin-top:8px">
														<select class="form-control select2 Country" name="country" id="country">
															<option value="0">Select</option>
															<?php
															$result=mysqli_query($conn, "select * from country");
															if(mysqli_num_rows($result) > 0){
																while($r=mysqli_fetch_array($result)){?>
																	<option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
																<?php }
															}
															?>
														</select>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											
										</div>	
										
										
										<div class="col-lg-12 col-xs-12"  id="sticky"  >
											<div class="col-lg-12 col-xs-12" style="padding:0px; background-color:#FFFFFF;">
												<button type="submit" class="btn btn-primary btn-block" name="submitForm" id="searchButtonHeight">
													<span class="glyphicon glyphicon-search" style=" margin-right:15px; margin-left:-30px"></span>ADVANCED SEARCH
												</button>
											</div>
										</div>
										
										</form>
										<!---EndedAdvancedSearch--->	
										
							</div>
						</div>
					</div>
				</div>
				<!---EndedLeftSideBar--->
				
								
			</div>
					
		</div>
				
			
				<div class="col-lg-6 col-md-7 col-sm-8" style=" padding:5px;" id="centerBar">                
				<?php
				if($blankQuery==false && $id != $firstPerson && $selectSomeID == false){ // checkBlankQueryForAllCenterRepeaet ?>
					<div class="col-lg-12" style="padding:0px; margin-top:-20px">
						<span style="font-family:'Segoe UI'; color:#999999">
							<?php 
								echo "showing ".mysqli_num_rows($query2).". total results: $count "; 
							?>
						</span>
					</div>
				<?php
				while($array2=mysqli_fetch_array($query2)){
                    if (!isset($_SESSION["firstPersonId"])){?>
                        <a rel="canonical" target="_blank" href="profile/<?php echo $array2['id']?>" style="text-decoration:none" id="hidePrefrencesParent" >
                    <?php 
                    }
                    else{?>
                        <a rel="canonical" target="_blank" href="profile/<?php echo $array2['id']?>" style="text-decoration:none" id="hidePrefrencesParent" >
                    <?php }?>
				
				<a rel="canonical" target="_blank" href="profile/<?php echo $array2['id']?>" style="text-decoration:none" id="hidePrefrencesParent" > 
					<div class="col-lg-12 col-md-12 col-xs-12" id="changeCenter">
						<div class="col-lg-3 col-md-3 col-xs-12">
							<div id="profileId" style="height:15px;">
								<?php echo "id: ".$array2['id']; if (!isset($_SESSION["firstPersonId"])){echo " | ".$array2['gender'];}?>
							</div>
                            <div style="height:160px; width:155px; margin-left:auto; margin-right:auto; border-radius:5px; border:2px solid #E1E1E1">
                            <?php
                            if (!isset($_SESSION["firstPersonId"])){?>
                                <?php if($array2["gender"]=="male"){?><img src="assets/allpics/mlogin.png" height="100%" width="100%" alt="User Image"/><?php }
                                else{?><img src="assets/allpics/flogin.png" height="100%" width="100%" alt="User Image"/><?php } ?>
                            <?php }
                            else{?>
                                <?php if($array2["publicProfile"]!="Private"){?>
                                <img src="<?php echo $array2['uploadProfilePicture']; ?>"	height="100%" width="100%" style="border-radius:2px;" alt="User Image"> 
                                <?php }else if($array2["gender"]=="male"){?><img src="assets/allpics/male4.png" height="100%" width="100%" alt="User Image"/><?php }
                                else{?><img src="assets/allpics/female4.png" height="100%" width="100%" alt="User Image"/><?php } ?>
                            <?php } ?>
							</div>
							<div id="namePadding">
								<span style="font-family:'Segoe UI'; font-weight:bold; color:#2A4B7C;">
									<?php echo $array2['firstName']." ".$lastName=$array2['lastName'];?>
								</span>
							</div>
						</div>
						<div class="col-lg-9 col-md-9 col-xs-12" id="about">
							<div class="col-lg-12 col-sm-12 col-xs-12 sg-sen-div">
											
								<div class="col-lg-4 col-md-3 col-sm-3 col-xs-5" style="padding:0px; margin-top:5px" >
									<p id="aboutText" style="margin-bottom:12px;">Basic Info</p>
									<?php if($array2['city'] != "") {?><p style="color:#CCCCCC">
									<i class="fas fa-map-marker-alt" style="margin-right:12px; font-size:14px"></i>City</p>
									<?php } else{?>
										<p style="color:#CCCCCC"><i class="fas fa-map-marker-alt" style="margin-right:12px; font-size:14px"></i>
										Country</p>
									<?php }?>
									<p style="color:#CCCCCC"><i class="fas fa-user-clock" style="margin-right:8px; font-size:13px;"></i>Caste</p>
									<p style="color:#CCCCCC"><i class="fas fa-user-graduate" style="margin-right:12px; font-size:13px"></i>Education</p>
									<p style="color:#CCCCCC"><i class="fas fa-chalkboard-teacher" style="margin-right:8px; font-size:13px"></i>Profession</p>
									<p style="color:#CCCCCC"><i class="far fa-user" style="margin-right:10px; font-size:14px"></i>Religion</p>
									<p style="color:#CCCCCC"><i class="fas fa-user-clock" style="margin-right:7px; font-size:13px;"></i>Age</p>
									<p style="color:#CCCCCC"><i class="fas fa-male" style="margin-right:17px; font-size:13px;"></i>Marital Status</p>
								</div>
								<div class="col-lg-5 col-md-4 col-sm-4 col-xs-4" style="padding:0px; padding-left:5px; margin-top:17px">
									<p style="margin-bottom:23px"></p>
									<span style="color:#666666">
										<p><?php if($array2['city'] != "") {echo $array2['city']; } else{echo $array2['country']; }?></p>
										<p><?php echo $array2['caste']; ?></p>
										<p><?php echo $array2['education']; ?></p>
										<p><?php echo $array2['profession']; ?></p>
										<p><?php echo $array2['religion']; ?></p>
										<p><?php $row11 = array('dob'=>$array2['dob']);	echo ageCalculator($row11['dob'])." old";	?></p>
										<p><?php echo $array2['maritalStatus']; ?></p>
									</span>
									<!---tooltip--->
									<script>
									$(document).ready(function(){
									  $('[data-toggle="tooltip"]').tooltip();   
									});
									</script>
									<!---tooltip--->
								</div>
								<div class="col-lg-3 col-md-2 col-sm-2 col-xs-3 hidePrefrences">
									<div>
										<i class="fas fa-envelope"></i>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</a>	
					
					
					
				
			<?php }?>     
			
		
					<!---EndedCenterRepeat--->
					
					
					
					
					
					
						<!---paginationStart--->
						<div class="col-lg-12" style="margin-top:-15px; padding:0px">
							<?php if($page <= $pages && $page>0 ){?>	
							
										<div class="col-lg-12 col-xs-12" style="border:0px solid #CCCCCC; padding:0px; border-radius:5px; margin-bottom:20px">
											<div class="col-lg-12 col-xs-12" style=" height:auto; padding:0px">
												
												<?php	if( $page>1 ){	$previous=$page-1; ?>
												
														<a rel="canonical"  href="searchguest.php?page=<?php echo $previous; ?> ">
															<div class="col-lg-3 col-xs-3" style="padding:0px; margin-left:1px">
																<button type="button" class="btn btn-default btn-block" style="border-radius:0px;
																		border-top-left-radius:3px;border-bottom-left-radius:3px">
																	<span style="margin-right:2px; font-size:16px" class="glyphicon glyphicon-chevron-left"></span>
																	Back
																</button>
															</div>
														</a>
														
															<?php
											
															if($firstOne != 1)
															{
															?>
															
															<a rel="canonical" href="searchguest.php?page=<?php echo $firstOne-1;?>">
																<div class="col-lg-1 col-xs-1" style="padding:0px; margin-left:1px">
																	<button type="button" class="btn btn-default btn-block" style="border-radius:0px;">
																	<span style="font-size:12px; margin-left:-7px;" class="glyphicon glyphicon-menu-left"></span>
																		<span style="margin-left:-6px;"><?php echo $firstOne-1;?></span>
																	</button>
																</div>
															</a>
															
														<?php }?>
														
													
														
																
												<?php }	if($page >= $pages){
												
														for($row=1; $row<=$pages; $row++)
														{
															@$lengthOfRow=count($arrayOfIndexes[$row]);
															for($col=1; $col<=$lengthOfRow; $col++)
															{
																if($arrayOfIndexes[$row][$col] == $page)
																{
																	for($thisRow=1; $thisRow<=$lengthOfRow; $thisRow++)
																	{
																			
																	?>
																	<a rel="canonical" href="searchguest.php?page=<?php echo $arrayOfIndexes[$row][$thisRow];?>">
																			<div class="col-lg-1 col-xs-1" style="padding:0px; margin-left:1px">
																			
																				<?php if( $page == $arrayOfIndexes[$row][$thisRow] ){?>
																					<button type="button" class="btn btn-primary btn-block" style="border-radius:0px;">
																						<?php echo $arrayOfIndexes[$row][$thisRow];?>
																					</button>
																				<?php }else{?>
																					<button type="button" class="btn btn-default btn-block" style="border-radius:0px;">
																						<?php echo $arrayOfIndexes[$row][$thisRow];?>
																					</button>
																						<?php }?>
																				
																			</div>
																		</a>
																	<?php	
																	}
																}
															}
														}
														?>
												
														
														<div style="cursor:pointer" onclick="EndOfResults()">
															<div class="col-lg-3 col-xs-3" style="padding:0px; margin-left:1px">
																<button type="button" class="btn btn-default btn-block" style="border-radius:0px;
																			border-top-right-radius:3px;border-bottom-right-radius:3px">
																	Next<span style="margin-left:12px; font-size:16px" class="glyphicon glyphicon-chevron-right"></span>
																</button>
															</div>
														</div>
														<script>function EndOfResults()
														{document.getElementById("change").style.color="gray";
														document.getElementById("change").style.borderRadius="3px";
														document.getElementById("change").style.background="#F9F9F9";
														document.getElementById("change").style.textAlign ="center";
														document.getElementById("change").style.padding ="5px";
														document.getElementById("change").style.marginTop ="3px";
														document.getElementById("change").innerHTML = "Result Ends! Click Privous or Search Again.";
														}
														</script>
														<div id="change" class="col-lg-12 col-xs-12" style="display:block; font-family:'Segoe UI'; font-size:12px; padding:0px;">
															End of Results
														</div>
														
													
													
												<?php }	else if($page==1){	
												
														for($row=1; $row<=$pages; $row++)
														{
															@$lengthOfRow=count($arrayOfIndexes[$row]);
															for($col=1; $col<=$lengthOfRow; $col++)
															{
																if($arrayOfIndexes[$row][$col] == $page)
																{
																	for($thisRow=1; $thisRow<=$lengthOfRow; $thisRow++)
																	{
																			
																	?>
																	<a rel="canonical" href="searchguest.php?page=<?php echo $arrayOfIndexes[$row][$thisRow];?>">
																			<div class="col-lg-1 col-xs-1" style="padding:0px; margin-left:1px">
																				
																				<?php if($page == $arrayOfIndexes[$row][$thisRow]){?>
																					<button type="button" class="btn btn-primary btn-block" style="border-radius:0px; 
																								border-top-left-radius:3px;border-bottom-left-radius:3px">
																						<?php echo $lastOne=$arrayOfIndexes[$row][$thisRow];?>
																					</button>
																				<?php }else{?>
																						
																					<button type="button" class="btn btn-default btn-block" style="border-radius:0px;">
																						<?php echo $lastOne=$arrayOfIndexes[$row][$thisRow];?>
																					</button>
																						<?php }?>
																			</div>
																		</a>
																	<?php	
																	}
																}
															}
														}
														
														$lastOne=$lastOne+1;
														if($pages >= $lastOne){
														?>
														
														
														<a rel="canonical" href="searchguest.php?page=<?php echo $lastOne;?>">
															<div class="col-lg-1 col-xs-1" style="padding:0px; margin-left:1px">
																<button type="button" class="btn btn-default btn-block" style="border-radius:0px;">
																	<span style="margin-left:-6px;"><?php echo $lastOne;?>
																	<span style="font-size:12px; margin-left:-6px" class="glyphicon glyphicon-menu-right"></span>
																</button>
															</div>
														</a>
														
														<?php }?>
														
														
														<a rel="canonical" href="searchguest.php?page=<?php echo $page+1; ?>  ">
															<div class="col-lg-3 col-xs-3" style="padding:0px; margin-left:1px">
																<button type="button" class="btn btn-default btn-block" style="border-radius:0px; 
																							border-top-right-radius:3px;border-bottom-right-radius:3px">
																	Next<span style="margin-left:12px; font-size:16px" class="glyphicon glyphicon-chevron-right"></span>
																</button>
															</div>
														</a>
														
														<?php }	else{	
														
														for($row=1;$row<=$pages;$row++)
														{
															@$lengthOfRow=count($arrayOfIndexes[$row]);
															for($col=1;$col<=$lengthOfRow;$col++)
															{
																if($arrayOfIndexes[$row][$col] == $page)
																{
																	for($thisRow=1;$thisRow<=$lengthOfRow;$thisRow++)
																	{
																			
																	?>
																	<a rel="canonical"href="searchguest.php?page=<?php echo $arrayOfIndexes[$row][$thisRow];?>">
																			<div class="col-lg-1 col-xs-1" style="padding:0px; margin-left:1px">
																			
																				<?php if( $page == $arrayOfIndexes[$row][$thisRow] ){?>
																					<button type="button" class="btn btn-primary btn-block" style="border-radius:0px;">
																						<?php echo $lastOne=$arrayOfIndexes[$row][$thisRow];?>
																					</button>
																				<?php }else{?>
																					<button type="button" class="btn btn-default btn-block" style="border-radius:0px;">
																						<?php echo $lastOne=$arrayOfIndexes[$row][$thisRow];?>
																					</button>
																					<?php } ?>
																			</div>
																		</a>
																	<?php	
																	}
																}
															}
														}
														$lastOne=$lastOne+1;
														if($pages >= $lastOne){
														?>
														
														<a rel="canonical" href="searchguest.php?page=<?php echo $lastOne;?>">
															<div class="col-lg-1 col-xs-1" style="padding:0px; margin-left:1px">
																<button type="button" class="btn btn-default btn-block" style="border-radius:0px;">
																	<span style="margin-left:-6px;"><?php echo $lastOne;?></span>
																	<span style="font-size:12px; margin-left:-6px" class="glyphicon glyphicon-menu-right"></span>
																</button>
															</div>
														</a>
														<?php }?>
														
														<a rel="canonical" href="searchguest.php?page=<?php echo $page+1; ?>  ">
															<div class="col-lg-3 col-xs-3" style="padding:0px; margin-left:1px">
																<button type="button" class="btn btn-default btn-block" style="border-radius:0px;  
																			border-top-right-radius:3px;border-bottom-right-radius:3px">
																	Next<span style="margin-left:12px; font-size:16px" class="glyphicon glyphicon-chevron-right"></span>
																</button>
															</div>
														</a>
														
												<?php }	?>
												
												
											</div>
										</div>
										
										
										
										
										
							<?php	}	else{ ?>
							<div class="" style="background-color:#FFFFFF;  font-family:'Segoe UI'; border-radius:3px;
								font-size:20px; margin-top:17px; padding:20px; height:auto;  margin-bottom:10px">No Record Found! 
                                <p style=" font-size:14px;">search again with different/multiple parameters.</p>
                            </div>    
							<?php }?>
							
						<!---Endedpagination--->
						
<?php }else if($id == $firstPerson){?>

<div class="" style="background-color:#d2c29d;  font-family:'Segoe UI'; border-radius:3px; border:2px solid #bfa873; color:#333333;
	font-size:20px; margin-top:0px; padding:20px; height:auto;  margin-bottom:10px">Your profile will not Visible to You! 
	<p style=" font-size:14px;">to view your profile, visit 'My Profile' page.</p>

<?php }else if($selectSomeID == true){?>

<div class="" style="background-color:#f0ead6;  font-family:'Segoe UI'; border-radius:3px; border:1px solid #bfa873; color:#333333;
	font-size:20px; margin-top:0px; padding:20px; height:auto;  margin-bottom:10px">No ID is selected! 
	<p style=" font-size:14px;">please select some id.</p>


<?php } else { ?>	

<div class="" style="background-color:#FFFFFF;  font-family:'Segoe UI'; border-radius:3px; border:1px solid #F5F5F5;
font-size:20px; margin-top:0px; padding:20px; height:auto;  margin-bottom:10px; font-weight:600; color:#d5ae41">No Result Found! 
<p style=" font-size:14px; font-weight:400;">try again and search with different user ID.</p>
 
							
<?php } ?><!--endedCheckBlankQueryForAllCenterRepeaet-->									
						
					</div></div>
					<!---EndedCenter(Col-lg-6)--->
					
					<!---RightSideBar--->
					<div class="col-lg-3 col-md-2 col-sm-12 col-xs-12" id="RightSideBar">
					<?php
						if(!isset($_SESSION['firstPersonId'])){?>
							<div class="right-div">
								<div class="rishta-div-head">
									Rishta by Gender
								</div>
								<?php
									$result=mysqli_query($conn, "select * from gender");
									if(mysqli_num_rows($result) > 0){
										while($r=mysqli_fetch_array($result)){?>
											<div class="rishta-div-body">
												<a href="check-category/gender/<?php echo $r['url'];?>" class="rishta-div-body-link" >
													<?php echo ucwords(str_replace('-', ' ', $r['url']));?>
												</a>
											</div>
										<?php }
									}
								?>
							</div>
						<?php }?>
						<div class="right-div">
							<div class="rishta-div-head">
								Rishty by Clan
							</div>
							<?php
								$result=mysqli_query($conn, "select * from clan");
								if(mysqli_num_rows($result) > 0){
									while($r=mysqli_fetch_array($result)){?>
										<div class="rishta-div-body">
											<a href="check-category/clan/<?php echo $r['url'];?>" class="rishta-div-body-link" >
												<?php echo ucwords(str_replace('-', ' ', $r['url']));?>
											</a>
										</div>
									<?php }
								}
							?>
						</div>
						<div class="right-div">
							<div class="rishta-div-head">
								Rishty by City
							</div>
							<?php
								$result=mysqli_query($conn, "select * from city limit 10");
								if(mysqli_num_rows($result) > 0){
									while($r=mysqli_fetch_array($result)){?>
										<div class="rishta-div-body">
											<a href="check-category/city/<?php echo $r['url'];?>" class="rishta-div-body-link" >
												<?php echo ucwords(str_replace('-', ' ', $r['url']));?>
											</a>
										</div>
									<?php }
								}
							?>
						</div>
						<div class="right-div">
							<div class="rishta-div-head">
								Rishty by Family Affluence
							</div>
							<?php
								$result=mysqli_query($conn, "select * from familyaffluence");
								if(mysqli_num_rows($result) > 0){
									while($r=mysqli_fetch_array($result)){?>
										<div class="rishta-div-body">
											<a href="check-category/familyaffluence/<?php echo $r['url'];?>" class="rishta-div-body-link" >
												<?php echo ucwords(str_replace('-', ' ', $r['url']));?>
											</a>
										</div>
									<?php }
								}
							?>
						</div>
						<div class="right-div">
							<div class="rishta-div-head">
								Rishty by Family Type
							</div>
							<?php
								$result=mysqli_query($conn, "select * from familytype");
								if(mysqli_num_rows($result) > 0){
									while($r=mysqli_fetch_array($result)){?>
										<div class="rishta-div-body">
											<a href="check-category/familytype/<?php echo $r['url'];?>" class="rishta-div-body-link" >
												<?php echo ucwords(str_replace('-', ' ', $r['url']));?>
											</a>
										</div>
									<?php }
								}
							?>
						</div>
						<div class="right-div">
							<div class="rishta-div-head">
								Rishty by Family Values
							</div>
							<?php
								$result=mysqli_query($conn, "select * from familyvalues");
								if(mysqli_num_rows($result) > 0){
									while($r=mysqli_fetch_array($result)){?>
										<div class="rishta-div-body">
											<a href="check-category/familyvalues/<?php echo $r['url'];?>" class="rishta-div-body-link" >
												<?php echo ucwords(str_replace('-', ' ', $r['url']));?>
											</a>
										</div>
									<?php }
								}
							?>
					</div>
					<!---EndedRightSideBar--->
					
				</div>
				
				<div class="col-lg-12" style="padding:0px;  margin-top:150px;"></div>
				
				
			</div>
		</div>
	</div>
</div>

<!-- footer -->
<?php include('inc/pages/footer.php');?>
<script src="<?php echo $base_url;?>assets/js/register.js"></script>

</body>
</html>






























