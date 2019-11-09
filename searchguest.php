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
	$data=str_replace(" ", "", $data);
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
		$select .="OR city='$city'";
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

<title>Home - RISHTAWEB</title>



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
@font-face 
{
    font-family: 'QanelasSoftDEMO-ExtraBold';
    src: url('QanelasSoftDEMO-ExtraBold.otf');
}
#logoText1{font-size:39px; color:#FFFFFF; font-family: 'QanelasSoftDEMO-ExtraBold';}
#logoText2{color:#c48f65}
@media only screen and (max-width: 767px) {#logoText1{ font-size:26px; margin-top:9px}}





#searchIcon{ color:#D69C2F; font-size:16px; border:none; cursor:pointer; margin-top:8px; border-radius:1px;}
#searchIcon:hover{ background-color:#FFFFFF; }
#navbarToggleButton{ color:#FFFFFF; font-size:16px; border:none; cursor:pointer; margin-top:10px; border-radius:2px; padding-top:10px; padding-bottom:10px; border-radius:4px;}
#navbarToggleButton:hover{background-color:#800000; color:#FFFFFF;}










	
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
#namePadding{padding:0px; text-align:center; margin-top:10px; border:1px solid #EEEEEE; border-radius:5px; font-size:16px;
										margin-left:auto; margin-right:auto; padding:3px; padding-top:11px; padding-bottom:11px; width:155px; margin-bottom:15px }	
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
@font-face 
{
    font-family: 'QanelasSoftDEMO-ExtraBold';
    src: url('QanelasSoftDEMO-ExtraBold.otf');
}


</style>

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











<h1 style="display:none">Home</h1>


<div class="container-fluid">
	<div class="row">
	
	<div class="col-lg-12" style="margin-bottom:10px;">
		
	</div>
	
		<div class="col-lg-12" style="padding: unset;">
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
										 ADVANCED SEARCH<br />
										<span id="selectOptionText">
											Select Options Below for Advanced Search
										</span>
									</p>
									<!---AdvancedSearch--->
									
									
									
									<div class="col-lg-12 " style="padding:0px;">
									<form method="post" action="searchguest.php" name="searchForm"   >
									
									
									
										<div class="col-lg-12" style="padding:10px; padding-top:0px; margin-top:20px">
											
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
											
														<select class="form-control" name="caste" id="caste" style="border-radius:2px;">
															<option value="0">Does Not Matters</option>
															
															<option value="#" disabled="disabled" style="text-align:center">[-----punjabi-----]</option>
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
															
															<option value="#" disabled="disabled" >[-----Sindhi-----]</option>
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
															
															<option value="#" disabled="disabled" >[-----Pashtun-----]</option>
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
															
															<option value="#" disabled="disabled" >[-----Baloch-----]</option>
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
															
															<option value="#" disabled="disabled" >[-----Saraiki-----]</option>
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
															
															<option value="#" disabled="disabled" >[-----Kahsmiri-----]</option>
															<option value="Mir " >Mir </option>
															<option value="Dar" >Dar</option>
															<option value="Kashmiri Shaikh" >Kashmiri Shaikh</option>
															<option value="Khan" >Khan</option>
															<option value="Lone" >Lone</option>
															<option value="Butt" >Butt</option>
															<option value="Malik clan (Kashmir)" >Malik clan (Kashmir)</option>
															<option value="Wani" >Wani</option>
															
															<option value="#" disabled="disabled" >[-----Gujrati-----]</option>
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
															
															<option value="#" disabled="disabled" >[-----Brohui-----]</option>
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
															
															<option value="#" disabled="disabled" >[-----Irani-----]</option>
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
															
															<option value="#" disabled="disabled" >[-----Arab-----]</option>
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
															
															<option value="#" disabled="disabled" >[-----Turk-----]</option>
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
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#professionColl">Profession</div>
													<div class="col-lg-12 collapse in" id="professionColl" style="margin-top:8px">
														<select class="form-control" name="profession" id="profession" onBlur="Profession()" style="border-radius:2px;">
															<option value="0">Does Not Matters</option>
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
															<option value="Banking Service Professional" >Banking Service</option>
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
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											<div class="col-lg-12" style="padding:0px">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">

													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#countryColl">Location</div>
													<div class="col-lg-12 collapse in" id="countryColl" style="margin-top:8px">
														<select class="form-control" name="country" id="country" onChange="Country(value)" 
														style="border-radius:2px;"	onBlur="Country(value)">
															<option value="0" selected="selected">Does not Matters</option>
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
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											
											<div class="col-lg-12" style="padding:0px; display:none" id="showProvince">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#provinceColl">Province</div>
													<div class="col-lg-12 collapse in" id="provinceColl" style="margin-top:8px">
														<select class="form-control" name="province" id="province" onChange="Province()" 
														style="border-radius:2px;" onBlur="Province()"></select>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											<div class="col-lg-12" style="padding:0px; display:none" id="showDistrict">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#districtColl">District</div>
													<div class="col-lg-12 collapse in" id="districtColl" style="margin-top:8px">
														<select class="form-control" name="district" id="district" onChange="District()" 
														style="border-radius:2px;" onBlur="District()"></select>
													</div>
													<div class="col-lg-12"><p style="border-top:1px solid #F4F4F4; margin-top:5px"></p></div>
												</div>
											</div>
											
											<div class="col-lg-12" style="padding:0px; display:none" id="showCity">
												<div class="col-lg-12" style="padding:5px; padding-top:0px">
				
													<div class="coll col-lg-12 collapse in" style="cursor:pointer; font-family:'Segoe UI'; font-weight:600;" id="textcolor" 
																data-toggle="collapse" data-target="#cityColl">City</div>
													<div class="col-lg-12 collapse in" id="cityColl" style="margin-top:8px">
														<select class="form-control"  name="city" id="city" onBlur="City()" style="border-radius:2px;">
															<option value="0">Does not Matters</option>
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
										
										
				


<script type="text/javascript">

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
	if( document.searchForm.country.value == "Pakistan" )
	{	
		if(chkCountry == 1)
		{	chkCountry++;
			document.getElementById("province").innerHTML="<option value='0'>Does not Matters</option><option value='Punjab'>Punjab</option><option value='Khyber Pakhtunkhwa'>Khyber Pakhtunkhwa</option><option value='Sindh'>Sindh</option><option value='Balochistan'>Balochistan</option><option value='Gilgit Baltistan'>Gilgit Baltistan</option><option value='Azad Jammu and Kashmir'>Azad Jammu and Kashmir</option><option value='Fata'>Fata</option>";
		}
		checkErrorForCountry=true;
		document.getElementById("showProvince").style.display="block";
		
	}
	else 
	{
		checkErrorForCountry=false;
		document.getElementById("showProvince").style.display="none";
		document.getElementById("showDistrict").style.display="none";
		document.getElementById("showCity").style.display="none";
	}
	
}

function Province()
{	
	if( checkErrorForCountry == true )
	{	
		if(document.searchForm.province.value == "Punjab")					
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
				
				document.getElementById("district").innerHTML="<option value='0'>Does not Matters</option><option value='Attock'>Attock</option><option value='Lodhran'>Lodhran</option><option value='Bahawalnagar'>Bahawalnagar</option><option value='Mandi Bahauddin'>Mandi Bahauddin</option><option value='Bahawalpur'>Bahawalpur</option><option value='Mianwali'>Mianwali</option><option value='Bhakkar'>Bhakkar</option><option value='Multan'>Multan</option><option value='Chakwal'>Chakwal</option><option value='Muzaffargarh'>Muzaffargarh</option><option value='Chiniot'>Chiniot</option><option value='Narowal'>Narowal</option><option value='Dera Ghazi Khan'>Dera Ghazi Khan</option><option value='Nankana Sahib'>Nankana Sahib</option><option value='Faisalabad'>Faisalabad</option><option value='Okara'>Okara</option><option value='Gujranwala'>Gujranwala</option><option value='Pakpattan'>Pakpattan</option><option value='Gujrat'>Gujrat</option><option value='Rahim Yar Khan'>Rahim Yar Khan</option><option value='Hafizabad'>Hafizabad</option><option value='Rajanpur'>Rajanpur</option><option value='Jhang'>Jhang</option><option value='Rawalpindi'>Rawalpindi</option><option value='Jhelum'>Jhelum</option><option value='Sahiwal'>Sahiwal</option><option value='Kasur'>Kasur</option><option value='Sargodha'>Sargodha</option><option value='Khanewal'>Khanewal</option><option value='Sheikhupura'>Sheikhupura</option><option value='Khushab'>Khushab</option><option value='Sialkot'>Sialkot</option><option value='Lahore'>Lahore</option><option value='Toba Tek Singh'>Toba Tek Singh</option><option value='Layyah'>Layyah</option><option value='Vehari'>Vehari</option>"; 
			}

			
		}
		
		else if(document.searchForm.province.value == "Khyber Pakhtunkhwa")		
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
				
				document.getElementById("district").innerHTML="<option value='0'>Does not Matters</option><option value='Abbottabad'>Abbottabad</option><option value='Bannu'>Bannu</option><option value='Batagram'>Batagram</option><option value='Buner'>Buner</option><option value='Charsadda'>Charsadda</option><option value='Chitral'>Chitral</option><option value='Dera Ismail Khan'>Dera Ismail Khan</option><option value='Hangu'>Hangu</option><option value='Haripur'>Haripur</option><option value='Karak'>Karak</option><option value='Kohat'>Kohat</option><option value='Upper Kohistan'>Upper Kohistan</option><option value='Lakki Marwat'>Lakki Marwat</option><option value='Lower Dir'>Lower Dir</option><option value='Malakand'>Malakand</option><option value='Mansehra'>Mansehra</option><option value='Mardan'>Mardan</option><option value='Nowshera'>Nowshera</option><option value='Peshawar'>Peshawar</option><option value='Shangla'>Shangla</option><option value='Swabi'>Swabi</option><option value='Swat'>Swat</option><option value='Tank'>Tank</option><option value='Upper Dir'>Upper Dir</option><option value='Torghar'>Torghar</option><option value='Lower Kohistan'>Lower Kohistan</option>";
			}
			
		}
		
		else if(document.searchForm.province.value == "Sindh")
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
				
				document.getElementById("district").innerHTML="<option value='0'>Does not Matters</option><option value='Badin'>Badin</option><option value='Dadu'>Dadu</option><option value='Ghotki'>Ghotki</option><option value='Hyderabad'>Hyderabad</option><option value='Jacobabad'>Jacobabad</option><option value='Jamshoro'>Jamshoro</option><option value='Karachi'>Karachi</option><option value='Kashmore'>Kashmore</option><option value='Khairpur'>Khairpur</option><option value='Larkana'>Larkana</option><option value='Matiari'>Matiari</option><option value='Mirpurkhas'>Mirpurkhas</option><option value='Naushahro Firoz'>Naushahro Firoz</option><option value='Shaheed Benazirabad'>Shaheed Benazirabad</option><option value='Qamber and Shahdad Kot'>Qamber and Shahdad Kot</option><option value='Sanghar'>Sanghar</option><option value='Shikarpur'>Shikarpur</option><option value='Sukkur'>Sukkur</option><option value='Tando Allahyar'>Tando Allahyar</option><option value='Tando Muhammad Khan'>Tando Muhammad Khan</option><option value='Tharparkar'>Tharparkar</option><option value='Thatta'>Thatta</option><option value='Umer Kot'>Umer Kot</option><option value='Sujawal'>Sujawal</option><option value='Malir'>Malir</option><option value='Korangi'>Korangi</option><option value='Sujawal'>Sujawal</option>";
			}
		}
		
		else if(document.searchForm.province.value == "Balochistan")				
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
			
				document.getElementById("district").innerHTML="<option value='0'>Does not Matters</option><option value='Awaran'>Awaran</option><option value='Barkhan'>Barkhan</option><option value='Bolan'>Bolan</option><option value='Chagai'>Chagai</option><option value='Dera Bugti'>Dera Bugti</option>	<option value='Gwadar'>Gwadar</option><option value='Harnai'>Harnai</option><option value='Jafarabad'>Jafarabad</option><option value='Jhal Magsi'>Jhal Magsi</option>	<option value='Kalat'>Kalat</option><option value='Kech'>Kech</option><option value='Kharan'>Kharan</option><option value='Khuzdar'>Khuzdar</option><option value='Kohlu'>Kohlu</option><option value='Lasbela'>Lasbela</option><option value='Loralai'>Loralai</option><option value='Mastung'>Mastung</option><option value='Musakhel'>Musakhel</option>	<option value='Naseerabad'>Naseerabad</option><option value='Nushki'>Nushki</option><option value='Panjgur'>Panjgur</option><option value='Pishin'>Pishin</option><option value='Qilla Abdullah'>Qilla Abdullah</option><option value='Qilla Saifullah'>Qilla Saifullah</option><option value='Quetta'>Quetta</option><option value='Sheerani'>Sheerani</option><option value='Sibi'>Sibi</option><option value='Washuk'>Washuk</option><option value='Zhob'>Zhob</option><option value='Ziarat'>Ziarat</option><option value='Sohbatpur'>Sohbatpur</option><option value='Lehri'>Lehri</option>";
			}
		}
		
		else if(document.searchForm.province.value == "Gilgit Baltistan")		
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
			
				document.getElementById("district").innerHTML="<option value='0'>Does not Matters</option><option value='Ghanche'>Ghanche</option><option value='Skardu'>Skardu</option>	<option value='Hunza'>Hunza</option>	<option value='Astore'>Astore</option>	<option value='Kharmang'>Kharmang</option><option value='Diamer'>Diamer</option>	<option value='Shigar'>Shigar</option><option value='Ghizer'>Ghizer</option>	<option value='Nagar'>Nagar</option>";
			}
		}
		
		else if(document.searchForm.province.value == "Azad Jammu and Kashmir")	
		{
			document.getElementById("showDistrict").style.display="block";
			if(chkAzadJammuandKashmir == 1)
			{	chkAzadJammuandKashmir++;
			
				chkPunjab=1;
				chkKhyberPakhtunkhwa=1;
				chkSindh=1;
				chkBalochistan=1;
				chkGilgitBaltistan=1;
				chkFata=1;
			
				document.getElementById("district").innerHTML="<option value='0'>Does not Matters</option><option value='Bhimber'>Bhimber</option><option value='Hattian'>Hattian</option><option value='Kotli'>Kotli</option><option value='Sudhnati'>Sudhnati</option><option value='Mirpur'>Mirpur</option><option value='Muzaffarabad'>Muzaffarabad</option><option value='Bagh'>Bagh</option><option value='Neelum'>Neelum</option><option value='Poonch'>Poonch</option><option value='Sudhnati'>Sudhnati</option>";
			}
		}
		
		else if(document.searchForm.province.value == "Fata")					
		{
			document.getElementById("showDistrict").style.display="block";
			if(chkFata == 1)
			{	chkFata++;
			
				chkPunjab=1;
				chkKhyberPakhtunkhwa=1;
				chkSindh=1;
				chkBalochistan=1;
				chkGilgitBaltistan=1;
				chkAzadJammuandKashmir=1;
				
				document.getElementById("district").innerHTML="<option value='0'>Does not Matters</option><option value='Bajaur'>Bajaur</option><option value='North Waziristan'>North Waziristan</option><option value='Khyber'>Khyber</option><option value='Orakzai'>Orakzai</option><option value='Kurram'>Kurram</option><option value='South Waziristan'>South Waziristan</option><option value='Mohmand'>Mohmand</option>";
			}
		}
		
	}
}

function District()
{
	if( checkErrorForCountry == true )
	{ 
		document.getElementById("showCity").style.display="block";
	}	
	
}


</script>
						
										
										
										
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
                        <a rel="canonical" target="_blank" href="viewprofile.php?viewProfileId=<?php echo $array2['id'];?>" style="text-decoration:none" id="hidePrefrencesParent" >
                    <?php 
                    }
                    else{?>
                        <a rel="canonical" target="_blank" href="viewguest.php?viewProfileId=<?php echo $array2['id'];?>" style="text-decoration:none" id="hidePrefrencesParent" >
                    <?php }?>
				
				<a rel="canonical" target="_blank" href="viewguest.php?viewProfileId=<?php echo $array2['id'];?>" style="text-decoration:none" id="hidePrefrencesParent" > 
					<div class="col-lg-12 col-md-12 col-xs-12" id="changeCenter">
						<div class="col-lg-3 col-md-3 col-xs-12" >
							<div id="profileId">
								<?php echo "id: ".$array2['id'];?>
							</div>
                            <div style="height:160px; width:155px; margin-left:auto; margin-right:auto; border-radius:5px; border:2px solid #E1E1E1">
                            <?php
                            if (!isset($_SESSION["firstPersonId"])){?>
                                <?php if($array2["gender"]=="male"){?><img src="assets/allpics/male4.png" height="100%" width="100%" alt="User Image"/><?php }
                                else{?><img src="assets/allpics/female4.png" height="100%" width="100%" alt="User Image"/><?php } ?>
                            <?php }
                            else{?>
                                <?php if($array2["publicProfile"]!="Private"){?>
                                <img src="<?php echo $array2['uploadProfilePicture']; ?>"	height="100%" width="100%" style="border-radius:2px;" alt="User Image"> 
                                <?php }else if($array2["gender"]=="male"){?><img src="assets/allpics/male4.png" height="100%" width="100%" alt="User Image"/><?php }
                                else{?><img src="assets/allpics/female4.png" height="100%" width="100%" alt="User Image"/><?php } ?>
                            <?php } ?>
							</div>
							<div id="namePadding">
								<span style="font-family:'Segoe UI'; font-weight:bold; color:#006e6d;">
									<?php echo $array2['firstName']." ".$lastName=$array2['lastName'];?>
								</span>
							</div>
						</div>
						<div class="col-lg-9 col-md-9 col-xs-12" id="about">
							<div class="col-lg-12 col-sm-12 col-xs-12" style=" padding:0px; color:#333333; font-family:'Segoe UI'; padding-right:0px; 
											line-height:15px; overflow-wrap:break-word; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
											
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="padding:0px; margin-top:5px" >
									<p id="aboutText" style="margin-bottom:12px;">Basic Info</p>
									<?php if($array2['city'] != "") {?><p style="color:#CCCCCC">
									<i class="fas fa-map-marker-alt" style="margin-right:9px; font-size:10px"></i>Location</p>
									<?php } else{?><p style="color:#CCCCCC">Country</p><?php }?>
									<p style="color:#CCCCCC"><i class="fas fa-user-clock" style="margin-right:6px; font-size:9px;"></i>Age</p>
									<p style="color:#CCCCCC"><i class="fas fa-male" style="margin-right:10px; font-size:12px; margin-left:2px"></i>Height</p>
									<p style="color:#CCCCCC"><i class="fab fa-delicious" style="margin-right:8px; font-size:10px"></i>Clan</p>
									<p style="color:#CCCCCC"><i class="fas fa-user-graduate" style="margin-right:8px; font-size:10px"></i>Education</p>
									<p style="color:#CCCCCC"><i class="far fa-user" style="margin-right:8px; font-size:10px"></i>Language</p>
									<p style="color:#CCCCCC" data-toggle="tooltip" data-placement="top" title="Marital Status">
										<i class="fas fa-user-circle" style="margin-right:8px; font-size:10px"></i>M-Status
									</p>
									<p style="color:#CCCCCC"><i class="fas fa-mosque" style="margin-right:5px; font-size:10px"></i>Religion</p>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="padding:0px; padding-left:5px; margin-top:13px">
									<p style="margin-bottom:23px"></p>
									<span style="color:#666666">
										<p><?php if($array2['city'] != "") {echo $array2['city']; } else{echo $array2['country']; }?></p>
										<p><?php $row11 = array('dob'=>$array2['dob']);	echo ageCalculator($row11['dob']);	?></p>
										<p><?php echo $array2['height']." ft"; ?></p>
										<p><?php echo $array2['clan']; ?></p>
										<p><?php echo $array2['education']; ?></p>
										<p><?php echo $array2['language']; ?></p>
										<p><?php echo $array2['maritalStatus']; ?></p>
										<p><?php echo $array2['religion']; ?></p>
									</span>
									<!---tooltip--->
									<script>
									$(document).ready(function(){
									  $('[data-toggle="tooltip"]').tooltip();   
									});
									</script>
									<!---tooltip--->
								</div>
								<div class="col-lg-5 col-md-2 col-sm-2 col-xs-5"  id="hidePrefrences">
									<p style="font-family:'Segoe UI'; margin-bottom:-2px; font-weight:600; color:#00539c">
										Partner Preferences
									</p>
									<p style="margin-top:16px"><?php echo $array2['pLocation']; ?></p>
									<p><?php echo $array2['pAge']; ?></p>
									<p><?php echo $array2['pHeight']; ?></p>
									<p><?php echo $array2['pClan']; ?></p>
									<p><?php echo $array2['pEducation']; ?></p>
									<p><?php echo $array2['pLanguage']; ?></p>
									<p><?php echo $array2['pMaritalStatus']; ?></p>
									<p><?php echo $array2['pReligion']; ?></p>
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
							
										<div class="col-lg-12 col-xs-12" style="border:0px solid #CCCCCC; padding:0px; border-radius:5px;">
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
</div>

<?php }else if($selectSomeID == true){?>

<div class="" style="background-color:#f0ead6;  font-family:'Segoe UI'; border-radius:3px; border:1px solid #bfa873; color:#333333;
	font-size:20px; margin-top:0px; padding:20px; height:auto;  margin-bottom:10px">No ID is selected! 
	<p style=" font-size:14px;">please select some id.</p>
</div>

<?php } else { ?>	

<div class="" style="background-color:#FFFFFF;  font-family:'Segoe UI'; border-radius:3px; border:1px solid #F5F5F5;
font-size:20px; margin-top:0px; padding:20px; height:auto;  margin-bottom:10px; font-weight:600; color:#d5ae41">No Result Found! 
<p style=" font-size:14px; font-weight:400;">try again and search with different user ID.</p>
</div>
							
<?php } ?><!--endedCheckBlankQueryForAllCenterRepeaet-->									
						
					</div></div>
					<!---EndedCenter(Col-lg-6)--->
					
					<!---RightSideBar--->
					<div class="col-lg-3 col-md-2 col-sm-12 col-xs-12" id="RightSideBar">
                        <div class="right-div">
                            <div class="rishta-div-head">
                                Rishty in Lahore
                            </div>
                            <div class="rishta-div-body">
                                <a href="#" class="rishta-div-body-link">Female Rishta in Lahore</a>
                            </div>
                            <div class="rishta-div-body">
                                <a href="#" class="rishta-div-body-link">male Rishta in Lahore</a>
                            </div>
                        </div>
                        <div class="right-div">
                            <div class="rishta-div-head">
                                Rishty in Arain
                            </div>
                            <div class="rishta-div-body">
                                <a href="#" class="rishta-div-body-link">Female Arain Rishta</a>
                            </div>
                            <div class="rishta-div-body">
                                <a href="#" class="rishta-div-body-link">male Arain Rishta</a>
                            </div>
                        </div>
                        <div class="right-div">
                            <div class="rishta-div-head">
                                Rishty in Middle Class Family
                            </div>
                            <div class="rishta-div-body">
                                <a href="#" class="rishta-div-body-link">Female Rishta in Middle Class Family</a>
                            </div>
                            <div class="rishta-div-body">
                                <a href="#" class="rishta-div-body-link">male Rishta in Middle Class Family</a>
                            </div>
                        </div>
                        <div class="right-div">
                            <div class="rishta-div-head">
                                Rishty in Moderate/Traditional/Liberal Family
                            </div>
                            <div class="rishta-div-body">
                                <a href="#" class="rishta-div-body-link">Female Rishta in Moderate Family</a>
                            </div>
                            <div class="rishta-div-body">
                                <a href="#" class="rishta-div-body-link">male Rishta in Moderate Family</a>
                            </div>
                            <div class="rishta-div-body">
                                <a href="#" class="rishta-div-body-link">Female Rishta in Traditional Family</a>
                            </div>
                            <div class="rishta-div-body">
                                <a href="#" class="rishta-div-body-link">male Rishta in Traditional Family</a>
                            </div>
                            <div class="rishta-div-body">
                                <a href="#" class="rishta-div-body-link">Female Rishta in Traditional Liberal</a>
                            </div>
                            <div class="rishta-div-body">
                                <a href="#" class="rishta-div-body-link">male Rishta in Traditional Liberal</a>
                            </div>
                        </div>
                        <div class="right-div">
                            <div class="rishta-div-head">
                                Rishty in Punjabi Family
                            </div>
                            <div class="rishta-div-body">
                                <a href="#" class="rishta-div-body-link">Female Rishta in Punjabi Family</a>
                            </div>
                            <div class="rishta-div-body">
                                <a href="#" class="rishta-div-body-link">male Rishta in Punjabi Family</a>
                            </div>
                        </div>
                        
                        
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

</body>
</html>






























