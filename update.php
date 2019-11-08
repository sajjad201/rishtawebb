<!DOCTYPE html>
<html>
<head>
	<?php include('inc/links-one.php');?>
</head>
<body style="background-color:#E4E4E4;">

<!-- login-navbar -->
<?php include('inc/navbar-login.php')?>


<h1 style="display:none">Create Account</h1>

<div class="container-fluid mainBody" style=" background-color:#E4E4E4; z-index:0;">
	<div class="row">
		<div class="col-lg-12" style="height:auto; padding-top:20px; padding-bottom:60px;  margin-top:0px">
			<div class="row" style="padding:10px">
				<div class="col-lg-2"></div>
				
				<!---whitePage--->
				<div class="col-lg-8" id="whitePage">
				 
				<div class="row" style="background-color:#eae6da">
					<div class="col-lg-12" id="whitePageChild1">
						<p id="whitePageChild2"><i class="fas fa-user-edit" style="margin-right:15px"></i>Update My Profile</p>
					</div>
					<div class="col-lg-12" style="background-color:#eae6da; padding:0px;">
						<div style="font-size:13px; color:#BF0000; background-color:#FFFFE8; text-align:center; ">
							<?php if($_SERVER['REQUEST_METHOD']=="POST"){echo $allErrorsOfPhp; echo $imageIssues;} ?>
						</div>
					</div>
				</div>
				
					<div class="row" style="background-color:#FFFFFF; padding-top:10px; color:#005960;">
						<div class="col-lg-2"></div>


<?php
$result=mysqli_query($conn, "select * from signup where id=$firstPerson limit 1");
while($queryArray=mysqli_fetch_array($result)){?>						
						<!---CompleteForm--->
						<div class="col-lg-8"  >
							<form class="form-horizontal" action="inc/update-route.php" method="post" enctype="multipart/form-data" name="signupForm" autocomplete="off">
		
								<!---block1--->
								<div id="block1" style="margin-top:35px">
										<div class="col-lg-12" style="padding:5px; margin-bottom:10px;">
											<div id="headings" style="color:#E47A2E"><i class="far fa-file-image" style="margin-right:15px;"></i></i>Image Privacy</div>
										</div>
									<div class="form-group">
										<label for="publicProfile" class="col-sm-4 control-label" style="color:#E47A2E">
										<i class="far fa-eye-slash" style="margin-right:10px"></i>Hide / Show</label>
										<div class="col-sm-6">
											<select class="form-control" name="publicProfile" id="publicProfile" onBlur="PublicProfile()" style=" border:2px solid #E47A2E">
											
												<option value="<?php echo $queryArray["publicProfile"];?>"><?php echo $queryArray["publicProfile"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["publicProfile"] ?>"]').eq(1).remove();
													});
												</script>
												<option value="Public">Public</option>
												<option value="Private">Private</option>
											</select>
											<div id="publicProfileError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["publicProfileErr"]; ?></div><hr>
										</div>
									</div>
									
								</div>
								
								<div id="block1" style="margin-top:15px">
									<div class="col-lg-12" style="padding:5px; margin-bottom:10px;">
										<div id="headings"><i class="fas fa-user-tie" style="margin-right:15px"></i>Basic Profile Info</div>
									</div>
										
									<div class="form-group">
										<label for="firstName" class="col-sm-4 control-label">First Name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="firstName" id="firstName"
											onBlur="FirstName()" value="<?php echo $queryArray["firstName"];?>">
											<div id="firstNameError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["firstNameErr"];?></div>
										</div>
									</div>
									<div class="form-group">
										<label for="lastName" class="col-sm-4 control-label">Last Name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="lastName" id="lastName"
											onBlur="LastName()" value="<?php echo $queryArray["lastName"];?>">
											<div id="lastNameError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["lastNameErr"];?></div>
										</div>
									</div>
									
								
									<div class="form-group">
										<label for="profileCreatedBy" class="col-sm-4 control-label">Created By</label>
										<div class="col-sm-6">
											<select class="form-control" name="profileCreatedBy" id="profileCreatedBy" onBlur="ProfileCreatedBy()">
											
												<option value="<?php echo $queryArray["profileCreatedBy"];?>"><?php echo $queryArray["profileCreatedBy"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["profileCreatedBy"] ?>"]').eq(1).remove();
													});
												</script>
												<option value="Myself">Myself</option>
												<option value="Parent">Parent</option>
												<option value="Guardian">Guardian</option>
												<option value="Sister">Sister</option>
												<option value="Brother">Brother </option>
												<option value="Friend">Friend</option>
											</select>
											<div id="profileCreatedByError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["profileCreatedByErr"]; ?></div>
										</div>
									</div>
								</div>
								
								
								<!---EnddBlock1--->
							
								<!---Block2--->
								
								<div id="block2">
								
									
									
									<div class="form-group">
										<label for="language" class="col-sm-4 control-label" >Language</label>
										<div class="col-sm-6">
											<select class="form-control" name="language" id="language" onBlur="Language()">
												<option value="<?php echo $queryArray["language"];?>"><?php echo $queryArray["language"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["language"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="Urdu">Urdu</option>
												<option value="Punjabi">Punjabi</option>
                                                <option value="Pashto">Pashto</option>
                                                <option value="Sindhi">Sindhi</option>
                                                <option value="Saraiki">Saraiki</option>
                                                <option value="Balochi">Balochi</option>
                                                <option value="Hindko">Hindko</option>
                                                <option value="English">English</option>
                                                <option value="Arabic">Arabic</option>
                                                <option value="Kashmiri">Kashmiri</option>
                                                <option value="Shina">Shina</option>
                                                <option value="Bengali">Bengali</option>
                                                <option value="Hindi">Hindi</option>
                                                <option value="Persian">Persian</option>
                                                <option value="Chinese">Chinese</option>
                                                <option value="Spanish">Spanish</option>
                                                <option value="French">French</option>
                                                <option value="Sundanese">Sundanese</option>
                                                <option value="Russian">Russian</option>
                                                <option value="Turkish">Turkish</option>
                                                <option value="Telugu">Telugu</option>
                                                <option value="Marathi">Marathi</option>
                                                <option value="Tamil">Tamil</option>
                                                <option value="Other">Other</option>			
											</select>
											<div id="languageError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["languageErr"]; ?></div>
										</div>
									</div>
									
									
								
									
								</div>
								

								<!---EndBlock2--->
						
								<!---Block3--->
								
								<div id="block3">
								
								
									
									<div class="form-group">
										<label for="education" class="col-sm-4 control-label" >Education</label>
										<div class="col-sm-6">
											<select class="form-control" name="education" id="education" onBlur="Education()">
												<option value="<?php echo $queryArray["education"];?>"><?php echo $queryArray["education"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["education"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="High school" label="High school">High school</option>
												<option value="Diploma" label="Intermediate">Intermediate</option>
												<option value="Diploma" label="Diploma">Diploma</option>
												<option value="Bachelors" label="Bachelors">Bachelors</option>
												<option value="Masters" label="Masters">Masters</option>
												<option value="Doctorate" label="Doctorate">Doctorate</option>
												<option value="Less than high school" label="Less than high school">Less than high school</option>
											</select>
											<div id="educationError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["educationErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="profession" class="col-sm-4 control-label" >Profession</label>
										<div class="col-sm-6">
											<select class="form-control" name="profession" id="profession" onBlur="Profession()">
												<option value="<?php echo $queryArray["profession"];?>"><?php echo $queryArray["profession"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["profession"] ?>"]').eq(1).remove();
													})
												</script>
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
											<div id="professionError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["professionErr"]; ?></div>
										</div>
									</div>
									
						
									<div class="form-group">
										<label for="salary" class="col-sm-4 control-label" >Salary</label>
										<div class="col-sm-6">
											<select class="form-control" name="salary" id="salary" onBlur="Salary()">
												<option value="<?php echo $queryArray["salary"];?>"><?php echo $queryArray["salary"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["salary"] ?>"]').eq(1).remove();
													})
												</script>
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
											<div id="salaryError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["salaryErr"]; ?></div>
										</div>
									</div>
									
							
								</div>
								

								<!---EndedBlock3--->
								
								
								<!---Block3_3--->
								<div id="block3_3" >
									
									<div class="form-group">
										<label for="maritalStatus" class="col-sm-4 control-label" >Marital Status</label>
										<div class="col-sm-6">
											<select class="form-control" name="maritalStatus" id="maritalStatus" onBlur="MaritalStatus()">
												<option value="<?php echo $queryArray["maritalStatus"];?>"><?php echo $queryArray["maritalStatus"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["maritalStatus"]; ?>"]').eq(1).remove();
													});
												</script>
												<option value="Never Married" class="Never Married">Never Married</option><option value="Divorcee">Divorcee</option>
												<option value="Separated">Separated</option><option value="Widow/Widower">Widow/Widower</option>
												<option value="Married">Married</option>
											</select>
											<div id="maritalStatusError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["maritalStatusErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="clan" class="col-sm-4 control-label" >Clan</label>
										<div class="col-sm-6">
											<select class="form-control" name="clan" id="clan" onBlur="Clan()">
												<option label="<?php echo $queryArray["clan"];?>" 
												value="<?php echo $queryArray["clan"];?>"><?php echo $queryArray["clan"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[label="<?php echo $queryArray["clan"]; ?>"]').eq(1).remove();
													});
												</script>
												<option label="Punjabi" value="Punjabi">Punjabi</option>
												<option label="Sindhi" value="Sindhi">Sindhi</option>
												<option label="Pashtun" value="Pashtun">Pashtun</option>
												<option label="Baloch" value="Baloch">Baloch</option>
												<option label="Saraiki" value="Saraiki">Saraiki</option>
												<option label="Kashmiri" value="Kashmiri">Kashmiri</option>
												<option label="Gujrati" value="Gujrati">Gujrati</option>
												<option label="Brohui" value="Brohui">Brohui</option>
												<option label="Irani" value="Irani">Irani</option>
												<option label="Arab" value="Arab">Arab</option>
												<option label="Turk" value="Turk">Turk</option>
											</select>
											<div id="clanError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["clanErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="caste" class="col-sm-4 control-label" >Caste</label>
										<div class="col-sm-6">
											<select class="form-control" name="caste" id="caste" onBlur="Caste()">
												<option value="<?php echo $queryArray["caste"];?>"><?php echo $queryArray["caste"];?></option>
												
												<option value="#" disabled="disabled" style="text-align:center">[-----punjabi-----]</option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["caste"] ?>"]').eq(1).remove();
													})
												</script>
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
											<div id="casteError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["casteErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="religion" class="col-sm-4 control-label" >Religion</label>
										<div class="col-sm-6">
											<select class="form-control" name="religion" id="religion" onBlur="Religion()">
												<option value="<?php echo $queryArray["religion"];?>"><?php echo $queryArray["religion"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["religion"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="Just A Muslim">Just A Muslim</option>
												<option value="Brailvi">Brailvi</option>
												<option value="Deobandi">Deobandi</option>
												<option value="Wahabi">Wahabi</option>
												<option value="Abbasi">Abbasi</option>
												<option value="Shia">Shia</option>
												<option value="Hindu">Hindu</option>
												<option value="Parsi">Parsi</option>
											</select>
											<div id="religionError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["religionErr"]; ?></div>
										</div>
									</div>
									
									
									
								
									
									
									
							
								</div>
								

							
								<!---EndedBlock3_3--->
						
								<!---Block4--->
								<div id="block4" >
								
									<div class="form-group">
										<label for="height" class="col-sm-4 control-label" >Height</label>
										<div class="col-sm-6">
											<select class="form-control" name="height" id="height" onBlur="Height()">
												<option value="<?php echo $queryArray["height"];?>"><?php echo $queryArray["height"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["height"] ?>"]').eq(1).remove();
													})
												</script>
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
											<div id="heightError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["heightErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="complexion" class="col-sm-4 control-label" >Complexion</label>
										<div class="col-sm-6">
											<select class="form-control" name="complexion" id="complexion" onBlur="Complexion()">
												<option value="<?php echo $queryArray["complexion"];?>"><?php echo $queryArray["complexion"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["complexion"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="Brown">Brown</option><option value="White">White</option>
												<option value="Dark">Dark</option>
											</select>
											<div id="complexionError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["complexionErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="bodyType" class="col-sm-4 control-label" >Body Type</label>
										<div class="col-sm-6">
											<select class="form-control" name="bodyType" id="bodyType" onBlur="BodyType()">
												<option value="<?php echo $queryArray["bodyType"];?>"><?php echo $queryArray["bodyType"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["bodyType"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="Aethlit">Aethlit</option>
												<option value="Slim">Slim</option>
												<option value="Avarage">Avarage</option>
												<option value="Heavy">Heavy</option>
												
											</select>
											<div id="bodyTypeError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["bodyTypeErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="hobby" class="col-sm-4 control-label" >Hobby</label>
										<div class="col-sm-6">
											<select class="form-control" name="hobby" id="hobby" onBlur="Hobby()">
												<option value="<?php echo $queryArray["hobby"];?>"><?php echo $queryArray["hobby"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["hobby"] ?>"]').eq(1).remove();
													})
												</script>
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
											<div id="hobbyError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["hobbyErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="disability" class="col-sm-4 control-label" >Disability</label>
										<div class="col-sm-6">
											<select class="form-control" name="disability" id="disability" onBlur="Disability()">
												<option value="<?php echo $queryArray["disability"];?>"><?php echo $queryArray["disability"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["disability"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="None">None</option><option value="Physical Disability">Physical Disability</option>
											</select>
											<div id="disabilityError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["disabilityErr"]; ?></div>
										</div>
									</div>
									
									
									<div class="form-group">
										<label for="aboutYourself" class="col-sm-4 control-label">About Myself</label>
										<div class="col-sm-6">
											<div id="countChar" style=" float:right; color:#999999"></div>
											<textarea class="form-control" id="aboutYourself" name="aboutYourself" style="resize:vertical" rows="5" 
											onBlur="AboutYourself()" onKeyUp="CountChar()"><?php echo $queryArray["aboutYourself"];?></textarea>
											<div id="explainYourselfError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["explainYourSelfErr"];?></div>
											<hr>
										</div>
									</div>
									
									
									
									<div class="col-lg-12" style="padding:5px; margin-bottom:10px;">
										<div id="headings" style="color:#838487"><i class="fas fa-map-marker-alt" style="margin-right:15px"></i>Location Details</div>
									</div>
									
									<div class="form-group">
										<label for="country" class="col-sm-4 control-label" style="color:#838487">Country</label>
										<div class="col-sm-6">
											<select class="form-control" name="country" id="country" onChange="Country(value)" onBlur="Country(value)" 
											style="border:2px solid #838487">
												
												<option value="<?php if($queryArray["country"] == ""){echo "Pakistan";}else{echo $queryArray["country"];}?>">
												<?php if($queryArray["country"] == ""){echo "Pakistan";}else{echo $queryArray["country"];}?></option>
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
											<div id="countryError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["countryErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group" id="showProvince" style="display:none">
										<label for="province" class="col-sm-4 control-label" style="color:#838487">Province</label>
										<div class="col-sm-6">
											<select class="form-control" name="province" id="province" onChange="Province()" onBlur="Province()" style="border:2px solid #838487">
											<script type="text/javascript">
												$(document).ready(function(){
													$('option[value="<?php echo $queryArray["province"] ?>"]').eq(1).remove();
												})
											</script>
											</select>
											<div id="provinceError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["provinceErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group" style="display:none" id="showDistrict">
										<label for="district" class="col-sm-4 control-label" style="color:#838487">District</label>
										<div class="col-sm-6">
											<select class="form-control" name="district" id="district" onChange="District()" onBlur="District()" style="border:2px solid #838487">
											<script type="text/javascript">
												$(document).ready(function(){
													$('option[value="<?php echo $queryArray["district"] ?>"]').eq(1).remove();
												})
											</script>
											</select>
											<div id="districtError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["districtErr"]; ?></div>
										</div>
									</div>
									
									
									<div class="form-group" style="display:none" id="showCity">
										<label for="city" class="col-sm-4 control-label" style="color:#838487">City</label>
										<div class="col-sm-6">
											<select class="form-control" name="city" id="city" onBlur="City()" style="border:2px solid #838487">
												<option value="<?php if($queryArray["city"] == ""){echo "Hazro";}else{echo $queryArray["city"];}?>">
												<?php if($queryArray["city"] == ""){echo "Hazro";}else{echo $queryArray["city"];}?></option>
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
											<div id="cityError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["cityErr"]; ?></div>
										</div>
									</div>
									
									
									
									<div class="form-group">
										<label for="familyAffluence" class="col-sm-4 control-label" ></label>
										<div class="col-sm-6">
											<hr>
										</div>
									</div>
									
									
									
									
								</div>
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
<!---Form4Script--->		
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

$(document).ready(function() { Country(); Province(); District(); });

function Country()
{
	if( document.signupForm.country.value == "Pakistan" )
	{	
		if(chkCountry == 1)
		{	chkCountry++;
			document.getElementById("province").innerHTML="<option value='<?php if($queryArray["province"] == ""){echo "Punjab";}else{echo $queryArray["province"];}?>'><?php if($queryArray["province"] == ""){echo "Punjab";} else {echo $queryArray["province"];}?></option><option value='Khyber Pakhtunkhwa'>Khyber Pakhtunkhwa</option><option value='Sindh'>Sindh</option><option value='Balochistan'>Balochistan</option><option value='Gilgit Baltistan'>Gilgit Baltistan</option><option value='Azad Jammu and Kashmir'>Azad Jammu and Kashmir</option><option value='Fata'>Fata</option>";
		
		
		}
		checkErrorForCountry=true;
		document.getElementById("showProvince").style.display="block";
		document.getElementById("showProvince").style.display="block";
		document.getElementById("showDistrict").style.display="block";
		document.getElementById("showCity").style.display="block";	
	
	
	}
	else 
	{
		checkErrorForCountry=false;
		document.getElementById("provinceError").innerHTML="";
		document.getElementById("showProvince").style.display="none";
		document.getElementById("showDistrict").style.display="none";
		document.getElementById("showCity").style.display="none";
	}
	
	
}

function Province()
{	
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
				
				document.getElementById("district").innerHTML="<option value='<?php  if($queryArray["district"] == "" ){echo "Attock";}else{echo $queryArray["district"];}?>'><?php if($queryArray["district"] == "" ){echo "Attock";}else{ echo $queryArray["district"];}?></option><option value='Lodhran'>Lodhran</option><option value='Bahawalnagar'>Bahawalnagar</option><option value='Mandi Bahauddin'>Mandi Bahauddin</option><option value='Bahawalpur'>Bahawalpur</option><option value='Mianwali'>Mianwali</option><option value='Bhakkar'>Bhakkar</option><option value='Multan'>Multan</option><option value='Chakwal'>Chakwal</option><option value='Muzaffargarh'>Muzaffargarh</option><option value='Chiniot'>Chiniot</option><option value='Narowal'>Narowal</option><option value='Dera Ghazi Khan'>Dera Ghazi Khan</option><option value='Nankana Sahib'>Nankana Sahib</option><option value='Faisalabad'>Faisalabad</option><option value='Okara'>Okara</option><option value='Gujranwala'>Gujranwala</option><option value='Pakpattan'>Pakpattan</option><option value='Gujrat'>Gujrat</option><option value='Rahim Yar Khan'>Rahim Yar Khan</option><option value='Hafizabad'>Hafizabad</option><option value='Rajanpur'>Rajanpur</option><option value='Jhang'>Jhang</option><option value='Rawalpindi'>Rawalpindi</option><option value='Jhelum'>Jhelum</option><option value='Sahiwal'>Sahiwal</option><option value='Kasur'>Kasur</option><option value='Sargodha'>Sargodha</option><option value='Khanewal'>Khanewal</option><option value='Sheikhupura'>Sheikhupura</option><option value='Khushab'>Khushab</option><option value='Sialkot'>Sialkot</option><option value='Lahore'>Lahore</option><option value='Toba Tek Singh'>Toba Tek Singh</option><option value='Layyah'>Layyah</option><option value='Vehari'>Vehari</option>";
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
				
				document.getElementById("district").innerHTML="<option value='<?php  if($queryArray["district"] == "" ){echo "Abbottabad";}else{echo $queryArray["district"];}?>'><?php if($queryArray["district"] == "" ){echo "Abbottabad";}else{ echo $queryArray["district"];}?></option><option value='Bannu'>Bannu</option><option value='Batagram'>Batagram</option><option value='Buner'>Buner</option><option value='Charsadda'>Charsadda</option><option value='Chitral'>Chitral</option><option value='Dera Ismail Khan'>Dera Ismail Khan</option><option value='Hangu'>Hangu</option><option value='Haripur'>Haripur</option><option value='Karak'>Karak</option><option value='Kohat'>Kohat</option><option value='Upper Kohistan'>Upper Kohistan</option><option value='Lakki Marwat'>Lakki Marwat</option><option value='Lower Dir'>Lower Dir</option><option value='Malakand'>Malakand</option><option value='Mansehra'>Mansehra</option><option value='Mardan'>Mardan</option><option value='Nowshera'>Nowshera</option><option value='Peshawar'>Peshawar</option><option value='Shangla'>Shangla</option><option value='Swabi'>Swabi</option><option value='Swat'>Swat</option><option value='Tank'>Tank</option><option value='Upper Dir'>Upper Dir</option><option value='Torghar'>Torghar</option><option value='Lower Kohistan'>Lower Kohistan</option>";
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
				
				document.getElementById("district").innerHTML="<option value='<?php  if($queryArray["district"] == "" ){echo "Badin";}else{echo $queryArray["district"];}?>'><?php if($queryArray["district"] == "" ){echo "Badin";}else{ echo $queryArray["district"];}?></option><option value='Dadu'>Dadu</option><option value='Ghotki'>Ghotki</option><option value='Hyderabad'>Hyderabad</option><option value='Jacobabad'>Jacobabad</option><option value='Jamshoro'>Jamshoro</option><option value='Karachi'>Karachi</option><option value='Kashmore'>Kashmore</option><option value='Khairpur'>Khairpur</option><option value='Larkana'>Larkana</option><option value='Matiari'>Matiari</option><option value='Mirpurkhas'>Mirpurkhas</option><option value='Naushahro Firoz'>Naushahro Firoz</option><option value='Shaheed Benazirabad'>Shaheed Benazirabad</option><option value='Qamber and Shahdad Kot'>Qamber and Shahdad Kot</option><option value='Sanghar'>Sanghar</option><option value='Shikarpur'>Shikarpur</option><option value='Sukkur'>Sukkur</option><option value='Tando Allahyar'>Tando Allahyar</option><option value='Tando Muhammad Khan'>Tando Muhammad Khan</option><option value='Tharparkar'>Tharparkar</option><option value='Thatta'>Thatta</option><option value='Umer Kot'>Umer Kot</option><option value='Sujawal'>Sujawal</option><option value='Malir'>Malir</option><option value='Korangi'>Korangi</option><option value='Sujawal'>Sujawal</option>";
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
			
				document.getElementById("district").innerHTML="<option value='<?php  if($queryArray["district"] == "" ){echo "Awaran";}else{echo $queryArray["district"];}?>'><?php if($queryArray["district"] == "" ){echo "Awaran";}else{ echo $queryArray["district"];}?></option><option value='Barkhan'>Barkhan</option><option value='Bolan'>Bolan</option><option value='Chagai'>Chagai</option><option value='Dera Bugti'>Dera Bugti</option>	<option value='Gwadar'>Gwadar</option><option value='Harnai'>Harnai</option><option value='Jafarabad'>Jafarabad</option><option value='Jhal Magsi'>Jhal Magsi</option>	<option value='Kalat'>Kalat</option><option value='Kech'>Kech</option><option value='Kharan'>Kharan</option><option value='Khuzdar'>Khuzdar</option><option value='Kohlu'>Kohlu</option><option value='Lasbela'>Lasbela</option><option value='Loralai'>Loralai</option><option value='Mastung'>Mastung</option><option value='Musakhel'>Musakhel</option>	<option value='Naseerabad'>Naseerabad</option><option value='Nushki'>Nushki</option><option value='Panjgur'>Panjgur</option><option value='Pishin'>Pishin</option><option value='Qilla Abdullah'>Qilla Abdullah</option><option value='Qilla Saifullah'>Qilla Saifullah</option><option value='Quetta'>Quetta</option><option value='Sheerani'>Sheerani</option><option value='Sibi'>Sibi</option><option value='Washuk'>Washuk</option><option value='Zhob'>Zhob</option><option value='Ziarat'>Ziarat</option><option value='Sohbatpur'>Sohbatpur</option><option value='Lehri'>Lehri</option>";
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
			
				document.getElementById("district").innerHTML="<option value='<?php  if($queryArray["district"] == "" ){echo "Ghanche";}else{echo $queryArray["district"];}?>'><?php if($queryArray["district"] == "" ){echo "Ghanche";}else{ echo $queryArray["district"];}?></option><option value='Skardu'>Skardu</option>	<option value='Hunza'>Hunza</option>	<option value='Astore'>Astore</option>	<option value='Kharmang'>Kharmang</option><option value='Diamer'>Diamer</option>	<option value='Shigar'>Shigar</option><option value='Ghizer'>Ghizer</option>	<option value='Nagar'>Nagar</option>";
			}
		}
		
		else if(document.signupForm.province.value == "Azad Jammu and Kashmir")	
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
			
				document.getElementById("district").innerHTML="<option value='<?php  if($queryArray["district"] == "" ){echo "Bhimber";}else{echo $queryArray["district"];}?>'><?php if($queryArray["district"] == "" ){echo "Bhimber";}else{ echo $queryArray["district"];}?></option><option value='Hattian'>Hattian</option><option value='Kotli'>Kotli</option><option value='Sudhnati'>Sudhnati</option><option value='Mirpur'>Mirpur</option><option value='Muzaffarabad'>Muzaffarabad</option><option value='Bagh'>Bagh</option><option value='Neelum'>Neelum</option><option value='Poonch'>Poonch</option><option value='Sudhnati'>Sudhnati</option>";
			}
		}
		
		else if(document.signupForm.province.value == "Fata")					
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
				
				document.getElementById("district").innerHTML="<option value='<?php  if($queryArray["district"] == "" ){echo "Bajaur";}else{echo $queryArray["district"];}?>'><?php if($queryArray["district"] == "" ){echo "Bajaur";}else{ echo $queryArray["district"];}?></option><option value='North Waziristan'>North Waziristan</option><option value='Khyber'>Khyber</option><option value='Orakzai'>Orakzai</option><option value='Kurram'>Kurram</option><option value='South Waziristan'>South Waziristan</option><option value='Mohmand'>Mohmand</option>";
			}
		}
		
		
	}
	else if(document.signupForm.country.value != "Pakistan")	{return true;}
	
	
	

}





</script>
<!---EndedForm4Script--->			
								<!---EndedBlock4--->
								
								
								
								
								
								
								
								<!---Block7--->
								<div id="block7" >
								
								<div class="col-lg-12" style="padding:5px; margin-bottom:10px;">
											<div id="headings" style="color:#578ca9"><i class="fas fa-users" style="margin-right:15px"></i>Family Values</div>
								</div>			
									<div class="form-group">
										<label for="fatherStatus" class="col-sm-4 control-label" style="color:#578ca9">Father Status</label>
										<div class="col-sm-6">
											<select class="form-control" name="fatherStatus" id="fatherStatus" onBlur="FatherStatus()" style="border:2px solid #578ca9">
												<option value="<?php echo $queryArray["fatherStatus"];?>"><?php echo $queryArray["fatherStatus"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["fatherStatus"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="Employed">Employed</option>
												<option value="Bussiness">Bussiness</option>
												<option value="Retired">Retired</option>
												<option value="Not Employed">Not Employed</option>
												<option value="Passed Away">Passed Away</option>
											</select>
											<div id="fatherStatusError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["fatherStatusErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="motherStatus" class="col-sm-4 control-label" style="color:#578ca9">Mother Status</label>
										<div class="col-sm-6">
											<select class="form-control" name="motherStatus" id="motherStatus" onBlur="MotherStatus()" style="border:2px solid #578ca9">
												<option value="<?php echo $queryArray["motherStatus"];?>"><?php echo $queryArray["motherStatus"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["motherStatus"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="Homemaker">Homemaker</option><option value="Employed">Employed</option>
												<option value="Bussiness">Bussiness</option><option value="Retired">Retired</option>
												<option value="Passed Away">Passed Away</option>
											</select>
											<div id="motherStatusError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["motherStatusErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="noOfBrothers" class="col-sm-4 control-label" style="color:#578ca9">No of Brothers</label>
										<div class="col-sm-6">
											<select class="form-control" name="noOfBrothers" id="noOfBrothers" onBlur="NoOfBrothers()" style="border:2px solid #578ca9">
												<option value="<?php echo $queryArray["noOfBrothers"];?>"><?php echo $queryArray["noOfBrothers"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["noOfBrothers"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="no">0</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="5">5+</option>
											</select>
											<div id="noOfBrothersError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["noOfBrothersErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="noOfSisters" class="col-sm-4 control-label" style="color:#578ca9">No of Sisters</label>
										<div class="col-sm-6">
											<select class="form-control" name="noOfSisters" id="noOfSisters" onBlur="NoOfSisters()" style="border:2px solid #578ca9">
												<option value="<?php echo $queryArray["noOfSisters"];?>"><?php echo $queryArray["noOfSisters"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["noOfSisters"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="no" >0</option>
												<option value="1" >1</option>
												<option value="2" >2</option>
												<option value="3" >3</option>
												<option value="4" >4</option>
												<option value="5" >5</option>
												<option value="5+" >5+</option>
											</select>
											<div id="noOfSistersError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["noOfSistersErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="familyType" class="col-sm-4 control-label" style="color:#578ca9">Family Type</label>
										<div class="col-sm-6">
											<select class="form-control" name="familyType" id="familyType" onBlur="FamilyType()" style="border:2px solid #578ca9">
												<option value="<?php echo $queryArray["familyType"];?>"><?php echo $queryArray["familyType"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["familyType"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="Joint">Joint</option><option value="Nuclear">Nuclear</option>
											</select>
											<div id="familyTypeError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["familyTypeErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="familyValues" class="col-sm-4 control-label" style="color:#578ca9">Family Values</label>
										<div class="col-sm-6">
											<select class="form-control" name="familyValues" id="familyValues" onBlur="FamilyValues()" style="border:2px solid #578ca9">
												<option value="<?php echo $queryArray["familyValues"];?>"><?php echo $queryArray["familyValues"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["familyValues"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="Traditional">Traditional</option><option value="Moderate">Moderate </option>
												<option value="Liberal">Liberal</option>
											</select>
											<div id="familyValuesError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["familyValuesErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="familyAffluence" class="col-sm-4 control-label" style="color:#578ca9">Family Affluence</label>
										<div class="col-sm-6">
											<select class="form-control" name="familyAffluence" id="familyAffluence" onBlur="FamilyAffluence()" style="border:2px solid #578ca9">
												<option value="<?php echo $queryArray["familyAffluence"];?>"><?php echo $queryArray["familyAffluence"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["familyAffluence"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="Affluent">Affluent</option><option value="Upper Middle Class">Upper Middle Class</option>
												<option value="Middle Class">Middle Class</option><option value="Lower Class">Lower Class</option>
											</select>
											<div id="familyAffluenceError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["familyAffluenceErr"]; ?></div><hr>
										</div>
									</div>
									
									
									
										
								</div>

								<!---EndedBlock7--->
								
								
								
								
								<!---Block8--->
								<div id="block8">
								
								<div class="col-lg-12" style="padding:5px; margin-bottom:10px;">
									<div id="headings" style="color:#d2c29d"><i class="fas fa-user-friends" style="margin-right:15px;"></i>Partner Preferences</div>
									
								</div>			
									<div class="form-group">
										<label for="partnerMaritalStatus" class="col-sm-4 control-label" style="color:#d2c29d">Marital Status</label>
										<div class="col-sm-6">
											<select class="form-control" name="partnerMaritalStatus" id="partnerMaritalStatus" onBlur="PartnerMaritalStatus()" 
												style="border:2px solid #d2c29d">
												<option value="<?php echo $queryArray["pMaritalStatus"];?>"><?php echo $queryArray["pMaritalStatus"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["pMaritalStatus"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="Never Married">Never Married</option><option value="Divorcee">Divorcee</option>
												<option value="Separated">Separated</option><option value="Widow/Widower">Widow/Widower</option>
												<option value="Does Not Matters">Does Not Matters</option>
											</select>
											<div id="partnerMaritalStatusError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["partnerMaritalStatusErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="partnerAge" class="col-sm-4 control-label" style="color:#d2c29d">Age Range</label>
										<div class="col-sm-6">
											<select class="form-control" name="partnerAge" id="partnerAge" onBlur="PartnerAge()" style="border:2px solid #d2c29d">
												<option value="<?php echo $queryArray["pAge"];?>"><?php echo $queryArray["pAge"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["pAge"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="18-24 Years">18-24 years</option><option value="25-30 Years">25-30 years</option>
												<option value="31-40 Years">31-40 years</option><option value="41-50 Years">41-50 years</option>
												<option value="51-60 Years">51-60 years</option><option value="60+ Years">60+ years</option>
												<option value="Does Not Matters">Does Not Matters</option>
											</select>
											<div id="partnerAgeError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["partnerAgeErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="partnerHeight" class="col-sm-4 control-label" style="color:#d2c29d">Height Range</label>
										<div class="col-sm-6">
											<select class="form-control" name="partnerHeight" id="partnerHeight" onBlur="PartnerHeight()" style="border:2px solid #d2c29d">
												<option value="<?php echo $queryArray["pHeight"];?>"><?php echo $queryArray["pHeight"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["pHeight"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="4.1ft - 4.5ft">4.1ft - 4.5ft</option>
												<option value="4.6ft - 5.0ft">4.6ft - 5.0ft</option>
												<option value="5.1ft - 5.5ft">5.1ft - 5.5ft</option>
												<option value="5.6ft - 6.0ft">5.6ft - 6.0ft</option>
												<option value="6.1ft or above">6.1ft or above</option>
												<option value="Does Not Matters">Does Not Matters</option>
											</select>
											<div id="partnerHeightError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["partnerHeightErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="partnerReligion" class="col-sm-4 control-label" style="color:#d2c29d">Religion</label>
										<div class="col-sm-6">
											<select class="form-control" name="partnerReligion" id="partnerReligion" onBlur="PartnerReligion()" style="border:2px solid #d2c29d">
												<option value="<?php echo $queryArray["pReligion"];?>"><?php echo $queryArray["pReligion"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["pReligion"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="Just A muslim" label="Just A Muslim">Just a Muslim</option>
												<option value="Brailvi" label="Brailvi">Brailvi</option>
												<option value="Deobandi" label="Deobandi">Deobandi</option>
												<option value="Wahabi" label="Wahabi">Wahabi</option>
												<option value="Abbasi" label="Abbasi">Abbasi</option>
												<option value="Shia" label="Shia">Shia</option>
												<option value="Hindu" label="Hindu">Hindu</option>
												<option value="Parsi" label="Parsi">Parsi</option>
												<option value="Does Not Matters" label="Does Not Matters">Does not Matters</option>
											</select>
											<div id="partnerReligionError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["partnerReligionErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="partnerLanguage" class="col-sm-4 control-label" style="color:#d2c29d">Language</label>
										<div class="col-sm-6">
											<select class="form-control" name="partnerLanguage" id="partnerLanguage" onBlur="PartnerLanguage()" style="border:2px solid #d2c29d">
												<option value="<?php echo $queryArray["pLanguage"];?>"><?php echo $queryArray["pLanguage"];?></option>
												<option value="Urdu">Urdu</option>
												<option value="Punjabi">Punjabi</option>
                                                <option value="Pashto">Pashto</option>
                                                <option value="Sindhi">Sindhi</option>
                                                <option value="Saraiki">Saraiki</option>
                                                <option value="Balochi">Balochi</option>
                                                <option value="Hindko">Hindko</option>
                                                <option value="English">English</option>
                                                <option value="Arabic">Arabic</option>
                                                <option value="Kashmiri">Kashmiri</option>
                                                <option value="Shina">Shina</option>
                                                <option value="Bengali">Bengali</option>
                                                <option value="Hindi">Hindi</option>
                                                <option value="Persian">Persian</option>
                                                <option value="Chinese">Chinese</option>
                                                <option value="Spanish">Spanish</option>
                                                <option value="French">French</option>
                                                <option value="Sundanese">Sundanese</option>
                                                <option value="Russian">Russian</option>
                                                <option value="Turkish">Turkish</option>
                                                <option value="Telugu">Telugu</option>
                                                <option value="Marathi">Marathi</option>
                                                <option value="Tamil">Tamil</option>
                                                <option value="Other">Other</option>		
												<option value="Does Not Matters">Does not Matters</option>
											</select>
											<div id="partnerLanguageError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["partnerLanguageErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="partnerEducation" class="col-sm-4 control-label" style="color:#d2c29d">Education</label>
										<div class="col-sm-6">
											<select class="form-control" name="partnerEducation" id="partnerEducation" onBlur="PartnerEducation()" style="border:2px solid #d2c29d">
												<option value="<?php echo $queryArray["pEducation"];?>"><?php echo $queryArray["pEducation"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["pEducation"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="Matric or Less" label="Matric or Less">Matric or Less</option>
												<option value="Intermediate or Less" label="Intermediate or Less">Intermediate (12 years)</option>
												<option value="Diploma 13 Years" label="Diploma 13 Years">Diploma (13 Years)</option>
												<option value="Bachelors (14 years)" label="Bachelors (14 years)">Bachelors (14 years)</option>
												<option value="Bachelors (16 years)" label="Bachelors (16 years)">Bachelors (16 years)</option>
												<option value="Masters" label="Masters">Masters</option>
												<option value="Doctorate" label="Doctorate">Doctorate</option>
												<option value="Does Not Matters">Does Not Matters</option>	
											</select>
											<div id="partnerEducationError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["partnerEducationErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="partnerComplexion" class="col-sm-4 control-label" style="color:#d2c29d">Skin Tone</label>
										<div class="col-sm-6">
											<select class="form-control" name="partnerComplexion" id="partnerComplexion" onBlur="PartnerComplexion()" 
											style="border:2px solid #d2c29d">
												<option value="<?php echo $queryArray["pComplexion"];?>"><?php echo $queryArray["pComplexion"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[value="<?php echo $queryArray["pComplexion"] ?>"]').eq(1).remove();
													})
												</script>
												<option value="Fair">Fair</option><option value="Medium">Medium</option>
												<option value="Dark">Dark</option><option value="Wheatish">Wheatish</option>
												<option value="Does Not Matters">Does not Matters</option>
											</select>
											<div id="partnerComplexionError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["partnerComplexionErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="partnerClan" class="col-sm-4 control-label" style="color:#d2c29d">Clan</label>
										<div class="col-sm-6">
											<select class="form-control" name="partnerClan" id="partnerClan" onBlur="PartnerClan()" style="border:2px solid #d2c29d">
												<option class="<?php echo $queryArray["pClan"];?>" 
														value="<?php echo $queryArray["pClan"];?>"><?php echo $queryArray["pClan"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[class="<?php echo $queryArray["pClan"] ?>"]').eq(1).remove();
													})
												</script>
												<option class="Punjabi" value="Punjabi">Punjabi</option>
												<option class="Sindhi" value="Sindhi">Sindhi</option>
												<option class="Pashtun" value="Pashtun">Pashtun</option>
												<option class="Baloch" value="Baloch">Baloch</option>
												<option class="Saraiki" value="Saraiki">Saraiki</option>
												<option class="Kashmiri" value="Kashmiri">Kashmiri</option>
												<option class="Gujrati" value="Gujrati">Gujrati</option>
												<option class="Brohui" value="Brohui">Brohui</option>
												<option class="Irani" value="Irani">Irani</option>
												<option class="Arab" value="Arab">Arab</option>
												<option class="Turk" value="Turk">Turk</option>
												<option value="Does Not Matters">Does not Matters</option>
											</select>
											<div id="partnerClanError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["partnerClanErr"]; ?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="partnerFamilyAffluence" class="col-sm-4 control-label" style="color:#d2c29d">Family Affluence</label>
										<div class="col-sm-6">
											<select class="form-control" name="partnerFamilyAffluence" id="partnerFamilyAffluence" onBlur="PartnerFamilyAffluence()" 
												style="border:2px solid #d2c29d">
												<option class="<?php echo $queryArray["pFamilyAffluence"];?>" 
												value="<?php echo $queryArray["pFamilyAffluence"];?>"><?php echo $queryArray["pFamilyAffluence"];?></option>
												<script type="text/javascript">
													$(document).ready(function(){
														$('option[class="<?php echo $queryArray["pFamilyAffluence"] ?>"]').eq(1).remove();
													})
												</script>
												<option class="Affluent" value="Affluent">Affluent</option>
												<option class="Upper Middle Class" value="Upper Middle Class">Upper Middle Class</option>
												<option class="Middle Class" value="Middle Class">Middle Class</option>
												<option class="Lower Class" value="Lower Class">Lower Class</option>
												<option value="Does Not Matters">Does not Matters</option>
												
											</select>
											<div id="partnerFamilyAffluenceError" style="font-size:12px; color:#BF0000;">
												<?php echo $errorList["partnerFamilyAffluenceErr"]; ?>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="partnerLocation" class="col-sm-4 control-label" style="color:#d2c29d">Location</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="partnerLocation" id="partnerLocation" style="border:2px solid #d2c29d"
											placeholder="e.g: Lahore, Punjab, Pakistan" onBlur="PartnerLocation()" value="<?php echo $queryArray["pLocation"];?>">
											<div id="partnerLocationError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["partnerLocationErr"];?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="partnerAbout" class="col-sm-4 control-label" style="color:#d2c29d">Write Few Lines</label>
										<div class="col-sm-6">
											<textarea class="form-control" id="partnerAbout" name="partnerAbout" style="resize:vertical; border:2px solid #d2c29d" 
											rows="3" onBlur="PartnerAbout()" onKeyUp="countChar()"><?php echo $queryArray["pAbout"];?></textarea>
											<div id="partnerAboutError" style="font-size:12px; color:#BF0000;"><?php echo $errorList["partnerLocationErr"];?></div>
										</div>
									</div>
									
										
								</div>

								<!---EndedBlock8--->
								
								
								
								
								
								
								<!---Block6--->
								
							<div id="block6">
								
								
								
								<div class="form-group">
									<div class="col-sm-4"></div>
									<div class="col-sm-6" style=" ">
										<button type="button" class="btn btn-lg btn-block" style="border-radius:3px; background-color:#005960; color:#FFFFFF; 
										outline:none;" onClick="ViewModel()">
										Update</button>
									</div>
									<div class="col-sm-4"></div>
								</div>
								<div class="form-group">
									<div class="col-sm-4"></div>
									<div class="col-sm-6" style="margin-top:-15px; margin-bottom:60px;">
										<a href="myprofile.php" onClick="backToPage3_3()"><i class="fa fa-angle-left" style="margin-right:8px;"></i>back</a>
									</div>
								</div>	
								<div class="modal fade" id="updateModal" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content" style="border-radius:3px;">
											<div class="modal-header" style=" background-color:#F7F7F7; color:#005960; border-radius:3px">
												<h3 class="modal-title" id="modalTitle">Are You Sure to Make Changes!</h3>
											</div>
											<div class="modal-body" id="modalBodyPadding">
												<div class="container-fluid">
													<div class="row" style="margin-top:20px; margin-bottom:20px; ">
														<div class="col-lg-6 col-xs-12" style="margin-bottom:10px">
														<button type="button" class="btn btn-lg btn-block" data-dismiss="modal" 
															style="background-color:#f0ead6; outline:none; color:#333333; border-radius:3px;">
															Not Now
														</button>
														</div>
														<div class="col-lg-6 col-xs-12">
															<button type="button" class="btn btn-lg btn-block" style="border-radius:3px; color:#FFFFFF; 
															outline:none; background-color:#92b558" onClick="SubmitUpdateForm()">Yes Update Profile!</button>
														</div>
													</div>	
												</div>
											</div>
											
										</div>
									
									</div>
								</div>

										
							</div>
	
<script type="text/javascript"> 

function FirstName()
{
	var firstNameVar=document.signupForm.firstName.value;
	var firstNameLengthVar=firstNameVar.length;
	
	if(firstNameVar=="")											
	{
		document.getElementById("firstName").style.borderColor="red";
		document.getElementById("firstNameError").innerHTML="enter first name";
	}
	else if(!/^[a-zA-Z ]*$/g.test(firstNameVar))			    {document.getElementById("firstNameError").innerHTML="Invalid first name (only A-Z allowed)"; }
	else if(firstNameLengthVar>12)								{document.getElementById("firstNameError").innerHTML="first name is too much long. put short name";}
	else if(firstNameLengthVar<2)								{document.getElementById("firstNameError").innerHTML="first name is not valid. enter correct name";}
	else														{document.getElementById("firstName").style.borderColor="#cddce5";
											    				 document.getElementById("firstNameError").innerHTML=""; return true;}
}

function LastName()
{
	var lastNameVar=document.signupForm.lastName.value;
	var lastNameLengthVar=lastNameVar.length;
	
	if(lastNameVar=="")											
	{
		document.getElementById("lastName").style.borderColor="red";
		document.getElementById("lastNameError").innerHTML="enter first name";
	}
	else if(!/^[a-zA-Z ]*$/g.test(lastNameVar))					{document.getElementById("lastNameError").innerHTML="Invalid last name (only A-Z allowed)";}
	else if(lastNameLengthVar>12)								{document.getElementById("lastNameError").innerHTML="last name is too much long. put short name";}
	else if(lastNameLengthVar<2)								{document.getElementById("lastNameError").innerHTML="name is not valid. enter correct name";}
	else														{document.getElementById("lastName").style.borderColor="#cddce5";
											    				 document.getElementById("lastNameError").innerHTML=""; return true;}
}



function PartnerLocation()
{
	var partnerLocationVar=document.signupForm.partnerLocation.value;
	var partnerLocationLengthVar=partnerLocationVar.length;
	
	if(partnerLocationVar=="")											
	{
		document.getElementById("partnerLocation").style.borderColor="red";
		document.getElementById("partnerLocationError").innerHTML="location";
	}
	else if(!/^[a-zA-Z ]*$/g.test(partnerLocationVar))			{document.getElementById("partnerLocationError").innerHTML="Invalid location (only A-Z allowed)";}
	else if(partnerLocationLengthVar>30)						{document.getElementById("partnerLocationError").innerHTML="location is too much long. put short location";}
	else if(partnerLocationLengthVar<3)							{document.getElementById("partnerLocationError").innerHTML="location is not valid. enter correct location";}
	else														{document.getElementById("partnerLocation").style.borderColor="#cddce5";
											    				 document.getElementById("partnerLocationError").innerHTML=""; return true;}

}

function PartnerAbout()
{
	var partnerAboutVar=document.signupForm.partnerAbout.value;
	var partnerAboutLengthVar=partnerAboutVar.length;
	
	if(partnerAboutVar=="")											
	{
		document.getElementById("partnerAbout").style.borderColor="red";
		document.getElementById("partnerAboutError").innerHTML="write few lines about partner";
	}
	else if(!/^[a-zA-Z ]*$/g.test(partnerAboutVar))				{document.getElementById("partnerAboutError").innerHTML="only charcters(A-Z) are allowed";}
	else if(partnerAboutLengthVar>100)							{document.getElementById("partnerAboutError").innerHTML="it's too lengthy. write short!";}
	else if(partnerAboutLengthVar<8)							{document.getElementById("partnerAboutError").innerHTML="write few lines about partners";}
	else														{document.getElementById("partnerAbout").style.borderColor="#cddce5";
																 document.getElementById("partnerAboutError").innerHTML=""; return true;}

}



function AboutYourself()
{
	var countExplainYourself = document.signupForm.aboutYourself.value.length;

	if(document.signupForm.aboutYourself.value== 0)				{document.getElementById("explainYourselfError").innerHTML="please explain yourself";
																 document.getElementById("aboutYourself").style.borderColor="red";}
	else if(countExplainYourself < 50)							{document.getElementById("explainYourselfError").innerHTML="minimum 50 char required";
																 document.getElementById("aboutYourself").style.borderColor="red";}
	else if(countExplainYourself > 600)							{document.getElementById("explainYourselfError").innerHTML="Max 600 char are allowed";
															     document.getElementById("aboutYourself").style.borderColor="red";}
	else														{document.getElementById("explainYourselfError").innerHTML="";
														 		 document.getElementById("aboutYourself").style.borderColor="#cddce5";return true;}

}


function ViewModel()
{
	if(FirstName() != true){document.getElementById("firstName").focus();}
	else if(LastName() != true){document.getElementById("lastName").focus();}
	else if(AboutYourself() != true){document.getElementById("aboutYourself").focus();}
	else if(PartnerLocation() != true){document.getElementById("partnerLocation").focus();}
	else if(PartnerAbout() != true){document.getElementById("partnerAbout").focus();}
	else if( FirstName() == true && LastName() == true && AboutYourself() == true &&  PartnerLocation() == true && PartnerAbout() == true)
	{
		$('#updateModal').modal('toggle');
	}
}

function SubmitUpdateForm()
{
	document.signupForm.submit();
}




function CountChar()
{
	var countExplainYourself = document.signupForm.aboutYourself.value.length;
	
	if( countExplainYourself > 99 )
	{
		document.getElementById("countChar").style.color="green";
		document.getElementById("countChar").style.borderColor="green";
		document.getElementById("countChar").innerHTML=countExplainYourself;
	}
	else
	{	
		document.getElementById("countChar").style.color="#ffbb00";
		document.getElementById("countChar").style.borderColor="#CCCCCC";
		document.getElementById("countChar").innerHTML=countExplainYourself;
	}
	
}



</script>
		
								
							</form>
						</div>
						<!---EndedCompleteForm--->
<?php }?>						
						<div class="col-lg-2" style="text-align:center; padding:35px;"><!--rightSideOfForm --></div>
						
						
					</div>
					
				<div class="row" style="">
					<div class="col-lg-12" style="text-align:center; padding:2px; background-color: #005960; margin-top:10px" >
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


<?php include('inc/footer.php');?>

</body>
</html>


