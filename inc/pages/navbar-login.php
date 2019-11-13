<!---navbar--->
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-xs-12 navbar-login-fixed" style="padding:0px; position:fixed; z-index:1; box-shadow:0px 0px 5px">
<nav class="navbar-inverse" style=" background-color:#A00000;">
	<div class="container-fluid">
		<div class="row" style="font-family:Arial">
		
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 " >
				<a href="<?php echo $base_url?>/" style="text-decoration:none">
					<div id="logoText1">RISHTA<span id="logoText2">WEB</span></div>
				</a>	
			</div>
			<div class="col-xs-2" style=" padding:0px; position:relative">
				<a href="<?php echo $base_url?>allConversation.php" id="notificationLink" onclick = "removeNotification()">
					<span class="navbar-toggle" id="navbarToggleButtonTop">
						<i class="fas fa-comments"></i>
						<span id="notification_count" style="padding:2px; background-color:#e94b3c; color:#FFFFFF; display:none; padding-left:7px; padding-right:7px; 
							padding-bottom:0px; border-radius:12px; font-size:14px; font-weight:600; font-family:'Times New Roman'; margin-top:-32px; 
							position:absolute; margin-left:18px">
						</span>
					</span>	
				</a>
			</div>
			<div class="col-xs-2" style="padding:0px">
				<span class="navbar-toggle" id="searchIcon" style="font-size:20px;">
					<i class="fas fa-search" style="font-weight:700"></i>
				</span>
				<script>
			
				  $("#searchIcon").click(function(){
					$("#leftSideBar").toggle();
					$("#centerBar").toggle();
					$("#focus").focus();
					$("#showEmptyLeftSideBar").toggle();
				  });
			
				</script>
			</div>
			<div class="col-xs-2" style="padding:0px; ">
				<span class="navbar-toggle" data-toggle="collapse" data-target="#target" id="navbarToggleButtonTop" 
					style="padding:15px; margin-top:5px; margin-bottom:5px; ">
					<span class="icon-bar"></span> <span id="iconBar" class="icon-bar"></span> <span id="iconBar" class="icon-bar"></span>
				</span>	
			</div>
			
			
			
			<div class="col-lg-9  col-md-9 col-sm-8 col-xs-12" style="padding:0px; background-color:#A00000">
				<div class="collapse navbar-collapse" id="target" style="border-top:0px solid #800000">
					<ul class=" nav navbar-nav" data-toggle="modal" data-target="#myModal">
						<li><a rel="canonical" href="<?php echo $base_url?>searchguest.php"><i class="fas fa-home nav-icons" style="margin-right:15px"></i>Home</a></li>
					</ul>
					<ul class=" nav navbar-nav" data-toggle="modal" data-target="#myModal">
						<li><a href="<?php echo $base_url?>myprofile.php"><i class="fas fa-user-alt nav-icons" style="margin-right:15px"></i>My Profile</a></li>
					</ul>
					<ul class=" nav navbar-nav" data-toggle="modal" data-target="#myModal">
						<li><a href="<?php echo $base_url?>all-categories.php"><i class="fas fa-list-ul nav-icons" style="margin-right:15px"></i>Category</a></li>
					</ul>
					<ul class=" nav navbar-nav" data-toggle="modal" data-target="#myModal">
						<li><a href="<?php echo $base_url?>searchguest.php"><i class="fas fa-search nav-icons" style="margin-right:15px"></i>Search</a></li>
					</ul>
					<ul class="nav navbar-nav">
						<li>
							<a rel="canonical" href="<?php echo $base_url?>allConversation.php " id="notificationLink" onclick = "removeNotification()">
								<i class="fas fa-envelope nav-icons" style="margin-right:15px"></i>Messages 
								<span id="notification_count2" style="padding:2px; background-color:#FFFFFF; color:#800000; display:none;
							 	 padding-left:6px; padding-right:6px; border-radius:12px"></span>
							</a>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right" >
						<li style="  border-radius:4px;">
							<a href="<?php echo $base_url?>inc/connection/logout.php"><i class="fas fa-power-off" style="margin-right:12px"></i>Logout</a>
						</li>
					</ul>
				</div>	
			</div>
			
		</div>
	</div>
</nav>

		</div>
	</div>
</div><br><br>
<!---//navbar--->
<script>

function addmsg(type, msg)
{
	document.getElementById("notification_count").innerHTML=msg;
	document.getElementById("notification_count2").innerHTML=msg;
	
	if(msg=="logout"){window.location="/"}
	if( msg > 0 )
	{
		document.getElementById("notification_count").style.display="inline";
		document.getElementById("notification_count2").style.display="inline";
	}
	if(msg == 0)
	{
		document.getElementById("notification_count").style.display="none";
		document.getElementById("notification_count2").style.display="none";
		
	}
	
	
}
 
function cutmsg(type, msg1)
{
	document.getElementById("notification_count").innerHTML=msg1;
	document.getElementById("notification_count2").innerHTML=msg1;
}

function removeNotification()
{
	$.ajax
	({
		type: "GET",
		url: "/rishtawebb/inc/routes/remove.php",
		async: true,
		cache: false,
		timeout:100000,
		success: function(data)	{	cutmsg("new", data);	setTimeout(	waitForMsg,	5000);}
	});
}

function waitForMsg()
{ 
	$.ajax
	({
		type: "GET",
		url: "/rishtawebb/inc/routes/select.php",
		async: true,
		cache: false,
		timeout:100000,
		 
		success: function(data){	addmsg("new", data);	setTimeout( waitForMsg,5000 );	},
		error: function(	XMLHttpRequest, textStatus, errorThrown){	addmsg("error", textStatus + " (" + errorThrown + ")");	setTimeout(	waitForMsg,	5000	);	}
	});
}
 $(document).ready(function(){ waitForMsg();	});
 
 
 

</script>
