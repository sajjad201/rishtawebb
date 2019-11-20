<?php
session_start();
require '../connection/connect.php';


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


if(isset($_GET["fromID"]))
{
	$fromID=test_input($_GET["fromID"]);
	$message=test_input($_GET["messageText"]);
	$toID=test_input($_GET["toID"]);
	
	date_default_timezone_set("Asia/Karachi");
	$timestamp = date('d/m/Y-h:i:s a', time());
	$splitTimeStamp = explode("-",$timestamp);
	$date = $splitTimeStamp[0];
	$time = $splitTimeStamp[1];
	
	$nullID=NULL;
	$unread='unread';
	$check = $conn->prepare("insert into chatdetails values (?, ?, ?, ?, ?, ?, ?)");
	$check->bind_param("sssssss", $nullID, $fromID, $message, $toID, $unread, $date, $time);
	$check->execute();	

}





$firstPerson=test_input($_SESSION["firstPersonId"]);
$secondPerson=test_input($_SESSION["secondPerson"]);




$secondPersonNameQuery=mysqli_query($conn, "select firstName,lastName from signup where id=$secondPerson limit 1");
while($secondPersonNameResult=@mysqli_fetch_array($secondPersonNameQuery))
{
	$person2Fname=$secondPersonNameResult["firstName"];
	$_SESSION["person2"]=$secondPersonNameResult["firstName"];
	$person2Lname=$secondPersonNameResult["lastName"];
}


$name="select firstName,lastName from signup where id=$secondPerson limit 1";
$nameResult = $conn->query($name);
$nameResultRow = $nameResult->fetch_assoc();
$nameResultCount = $nameResult->num_rows;
if($nameResultCount==0){?><span style="color:#FF0000">Something went wrong. please refresh the page!</span><?php }


$firstPersonNameQuery=mysqli_query($conn, "select firstName,lastName from signup where id=$firstPerson limit 1");
while($firstPersonNameResult=mysqli_fetch_array($firstPersonNameQuery))
{
	$person1Fname=$firstPersonNameResult["firstName"];
	$person1Lname=$firstPersonNameResult["lastName"];
}


$messageQuery=mysqli_query($conn, " select * from chatdetails where ( fromID='$firstPerson' or toID='$firstPerson' ) AND ( fromID='$secondPerson' or toID='$secondPerson' )ORDER BY `chatdetails`.`id` ASC ");
while($messageArray=mysqli_fetch_array($messageQuery))
{
		
	if( $messageArray["fromID"] == $secondPerson)
	{
		
	?>		

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:0px; margin-bottom:5px">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="background-color:#D5D5FF; word-wrap:break-word; padding:12px; border-radius:25px;
										border-top-left-radius:0px; padding-bottom:0px">
									
								<div style="font-family:Helvetica; font-size:12px; color:#000000"><?php echo $messageArray["message"] ; ?></div>
								
								<div class="row" style="font-size:11px; color:#333333; font-family:'Calibri Light'">
									<div class="col-lg-12" style="text-align:center; padding-bottom:7px; padding-top:12px;">
										<?php echo $messageArray["time"]." | ".$messageArray["date"]; ?>
										
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>
					</div>
					
	<?php					
	}
	else 
	{
	?>		

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:0px; margin-bottom:5px">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="background-color:#eda978; color:#FFFFFF; padding:12px; border-radius:25px;
									border-top-right-radius:0px; padding-bottom:0px; float:right;">
								
							<div style="font-family:Helvetica; font-size:12px; color:#000000;  word-wrap:break-word; "><?php echo $messageArray["message"];?></div>
							<div class="row" style="font-size:11px; color:#333333; font-family:'Calibri Light'">
									<div class="col-lg-12" style="text-align:center; padding-bottom:7px; padding-top:12px">
										<?php echo $messageArray["date"]." | ".$messageArray["time"]; ?>
										
									</div>
								</div>
								
						</div>
					</div>
					
	<?php					
	}
}

$sql1 = "select * from chatdetails where status = 'unread' and fromID=$firstPerson and toID=$secondPerson ";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();
$count1 = $result1->num_rows;
$conn->close();
?>
<div class="col-lg-12" style="padding:0px">
	<div class="col-lg-6"></div>
	<div class="col-lg-6" style="text-align:right; font-family:'Segoe UI'; padding:0px">
		<span style="background-color:#EEEEEE; color:#00A600; border-radius:3px; padding-left:5px; padding-right:5px">
			<?php if($count1 == 0){echo $_SESSION["person2"]." seen your message <i class='fas fa-check-double'></i>";}
			else {?><span style="color:#0099CC"><?php echo "message sent <i class='fas fa-check'></i>";}?></span>
		</span>
	</div>
</div>

	












