<?php
session_start();
require 'inc/connection/connect.php';

if(!isset($_SESSION["firstPersonId"]))
{
  header("Location: /");
}
$firstPerson=$_SESSION["firstPersonId"];




$allErrorsOfPhp = $imageIssues = "";
$errorList=array(); 
$errorList["uploadProfilePictureErr"] = "";

$errorOccurred=false;


if($_SERVER['REQUEST_METHOD']=="POST")
{		

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
			$errorOccurred=true;
			$imageIssues="No image selected";
		}
		else if($imgSize > 3000000 )
		{
			$errorList["uploadProfilePictureErr"]="<br>Image size is too larger, Max size is 3 MB. Your file size is: ".round(($imgSize/1048576),2)."MBs<br>";
			$errorOccurred=true;
			$imageIssues="Image size is larger, Select image with small size";
		}
		else if(in_array($imgExtension,$expensions) == false)
		{
			$errorList["uploadProfilePictureErr"]="<br>Invalid file format(only jpg,png and jepg allowed)<br>";
			$errorOccurred=true;
			$imageIssues="Please upload valid image. Allowed image formats are (JPG) (JPEG) and (PNG)";
		}
		else if( empty($imgName) == false && $imgSize < 9000000 && in_array($imgExtension,$expensions) == true)
		{
			$uploadProfilePicture= $conn->real_escape_string(file_get_contents($_FILES['uploadProfilePicture']['tmp_name']));
		}
   }
	
	if( $errorOccurred == false )
	{
		$insertId=NULL;
		$publicProfile=$_POST["publicProfile"];
		
		$info = pathinfo($_FILES['uploadProfilePicture']['name']);
		$ext = $info['extension']; 
		$newname = $firstPerson.".".$ext; 
		$path = 'images/'.$newname;	
		$stmt = $conn->prepare("UPDATE signup SET uploadProfilePicture=?, publicProfile=? WHERE id=?");
		$stmt->bind_param("sss", $path, $publicProfile, $firstPerson);
		$stmt->execute();
		$stmt->close();
		move_uploaded_file($_FILES['uploadProfilePicture']['tmp_name'], $path);
		
		header('Location: myprofile.php');
		
	}
	else
	{
		$allErrorsOfPhp="please provide correct information because some errors still exists, check the form again and submit it.";
	}
	
	
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<?php include('inc/pages/links-one.php');?>
</head>
<body style="background-color:#E4E4E4;">

<!-- login-navbar -->
<?php include('inc/pages/navbar-login.php')?>

<h1 style="display:none">Create Account</h1>

<div class="container-fluid mainBody" style=" background-color:#E4E4E4; z-index:0;">
	<div class="row">
		<div class="col-lg-12" style="height:auto; padding-top:50px; padding-bottom:30px;  margin-top:0px">
			<div class="row">
				<div class="col-lg-2"></div>
				
				<!---whitePage--->
				<div class="col-lg-8" id="whitePage" >
				 
				<div class="row"  >
					<div class="col-lg-12" id="createYourAccount">
						<p id="createYourRishtawebAccount"><i class="far fa-images" style="margin-right:15px"></i>Update Your Profile Picture</p>
					</div>
					<div class="col-lg-12" style="background-color:#eae6da; padding:0px;">
						<div style="font-size:13px; color:#BF0000; background-color:#FFFFE8; text-align:center; ">
							<?php if($_SERVER['REQUEST_METHOD']=="POST"){echo $allErrorsOfPhp; echo $imageIssues;} ?>
						</div>
					</div>
				</div>
				
					<div class="row" style="background-color:#FFFFFF; padding:15px; padding-top:10px;">
						<div class="col-lg-2"></div>
						
						<!---CompleteForm--->
						<div class="col-lg-8">
							<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="signupForm" autocomplete="off">
		
								
								<div id="block5" style="color:#88b04b">
								
									<div class="col-lg-12" style="padding:5px; margin-bottom:10px;">
										<div style="color:#463220; text-align:center; font-family:Rubik; font-size:16px; font-weight:600">
										Select Image and Update</div>
									</div>
									<div class="form-group" style="margin-top:10px;">
										<div class="col-lg-4 col-sm-4 col-xs-12" style="padding:10px; text-align:center">
											<label for="uploadProfilePicture" class="btn btn-default">
												<div class="thumbnail" style="height:165px; width:150px; margin-left:auto; margin-right:auto; padding:0px">
														<?php
														$result=mysqli_query($conn, "select * from signup where id=$firstPerson limit 1");
														while($queryArray=mysqli_fetch_array($result)){?>
														
								<?php if($queryArray["publicProfile"]!="Private"){?>
								<img src="<?php echo $queryArray['uploadProfilePicture']; ?>" style="height:165px; width:150px; border-radius:5px;" alt="My Old Image">
								<?php }
								else if($queryArray["gender"]=="male"){?><img src="allpics/male4.png" style="height:165px; width:150px; border-radius:5px;" 
								alt="My Old Image"/><?php }
								else{?><img src="allpics/female4.png" style="height:165px; width:150px; border-radius:5px;" alt="My Old Image"/><?php } ?>
																
														<?php }?>	
														<input type="file" style="display:none" id="uploadProfilePicture" 
														name="uploadProfilePicture" onChange="imageDetails(this)">
												</div>
												<p style="font-size:14px; font-family:'Segoe UI'; font-weight:600; margin-top:-10px">
												<i class="fa fa-upload" aria-hidden="true" style="margin-right:10px"></i>Upload New Image</p>
											</label><p style="font-size:12px; font-family:'Segoe UI'; color:#999999; margin-top:4px">Max size limit: 3 MB</p>
										</div>
										<div class="col-lg-4 col-sm-4 col-xs-12" style="padding-top:60px; padding-left:30px; text-align:center; padding-bottom:60px">
											<img src="allpics/white-arrow-transparent-png-22.png" style="height:100px; width:100px; " alt="Arrow">
										</div>
										<div class="col-lg-4 col-sm-4 col-xs-12" style="padding:10px;">
											<div style="border:1px solid #CCCCCC; border-radius:5px; padding-left:14px; padding-top:10px; height:220px; width:180px; 
														margin-left:auto; margin-right:auto;text-align:center">
												<div class="thumbnail" style="height:160px; width:150px">
														<img src="allpics/transparent-background.jpg" style="height:150px; width:150px" id="hidePng" alt="Tranparent">
												</div>
												<div style="font-size:12px; color:#408080; text-align:center; margin-bottom:15px; padding-right:15px">
													<select name="publicProfile" id="publicProfile" class="form-control" 
														style=" margin-top:-15px; border-radius:2px;"> 
														<option value="Public">Public</option><option value="Private">Private</option>
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
											<p id="uploadProfilePictureError" style="font-size:12px; color:#BF0000; text-align:center;">
												<?php echo $errorList["uploadProfilePictureErr"]; ?>
											</p>
										</div>
									<div class="form-group" style="padding:0px; margin-bottom:80px">
										<div class="col-sm-12" style="padding:0px" >
											<button type="button" class="btn btn-lg btn-block" onClick="form5Script()" 
											style="border-radius:2px; background-color:#cfb095; color:#FFFFFF; outline:none">
											Click Here to Update</button>
										</div>
									</div>
									
								</div>

<!---Form5Script--->
<script type="text/javascript">
	
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
	function imageIsLoaded(e) {$('#hidePng').attr('src', e.target.result);};
	
	
	
	var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];   
	var chkFileType = false;
	var checkSize=true;
	function imageDetails(oInput)
	{		
		
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
		
	}<!---EndedFunction(imageDetails)--->
	
	function form5Script()
	{
		if(document.getElementById("uploadProfilePicture").value != "" && chkFileType == true && checkSize == true )
		{
			document.signupForm.submit();
		}
		else
		{
			document.getElementById("uploadProfilePictureError").innerHTML="Please select another profile picture!";
		}
	}
	
</script>
<!---EndedForm5Script--->

								<!---EndedBlock5--->
								
								
								
								
							</form>
						</div>
						<!---EndedCompleteForm--->
						
						<div class="col-lg-2" style="text-align:center; padding:35px;"><!--rightSideOfForm --></div>
						
						
					</div>
					
				<div class="row" style="">
					
				</div>
					
				</div>
				<!---whitePage--->
				<div class="col-lg-2" ></div>
			</div>
		</div>
	</div>
</div>


<?php include('inc/pages/footer.php');?>

</body>
</html>


<script>

function backToPage8()
{
	document.getElementById("block8").style.display="none";
	document.getElementById("block7").style.display="block";
}

function backToPage7()
{
	document.getElementById("block7").style.display="none";
	document.getElementById("block4").style.display="block";
}

function backToPage6()
{
	document.getElementById("block6").style.display="none";
	document.getElementById("block8").style.display="block";
}
function backToPage4()
{
	document.getElementById("block5").style.display="none";
	document.getElementById("block6").style.display="block";
}
function backToPage3_3()
{
	document.getElementById("block4").style.display="none";
	document.getElementById("block3_3").style.display="block";
}
function backToPage3()
{
	document.getElementById("block3_3").style.display="none";
	document.getElementById("block3").style.display="block";
}
function backToPage2()
{
	document.getElementById("block3").style.display="none";
	document.getElementById("block2").style.display="block";
}
function backToPage1()
{
	document.getElementById("block2").style.display="none";
	document.getElementById("block1").style.display="block";
}

</script>



