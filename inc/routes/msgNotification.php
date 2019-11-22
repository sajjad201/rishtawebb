<!DOCTYPE html>
<html>
<head>

<meta name="robots" content="noindex, nofollow" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js" type="text/javascript" charset="utf-8"></script>


</head>


<body>



<a href="#" id="notificationLink" onclick = "removeNotification()" style="text-decoration:none; font-family:Verdana">Message
	<span id="notification_count" style="color: #ffffff; font-weight: bold; text-align:center"></span>
</a>

<div id="HTMLnoti" style="text-align:center"></div>


</body>
</html>

<script type="text/javascript" charset="utf-8">
 
function addmsg(type, msg)
{
	document.getElementById("notification_count").innerHTML=msg;
	
	
	if( msg >0 )
	{
		document.getElementById("notification_count").style.background="#DF0000";
	}
	else if(msg == 0)
	{
		document.getElementById("notification_count").style.background="#C0C0C0";
	}
}
 
function cutmsg(type, msg1)
{
	document.getElementById("notification_count").innerHTML=msg1;
}

function removeNotification()
{
	$.ajax
	({
		type: "GET",
		url: "remove.php",
		async: true,
		cache: false,
		timeout:10000,
		success: function(data)	{	cutmsg("new", data);	setTimeout(	waitForMsg,	100);}
	});
}

function waitForMsg()
{ 
	$.ajax
	({
		type: "GET",
		url: "select.php",
		async: true,
		cache: false,
		timeout:50000,
		 
		success: function(data){	addmsg("new", data);	setTimeout( waitForMsg,1000 );	},
		error: function(	XMLHttpRequest, textStatus, errorThrown){	addmsg("error", textStatus + " (" + errorThrown + ")");	setTimeout(	waitForMsg,	1000	);	}
	});
}
 $(document).ready(function(){ waitForMsg();	});
 
</script>



















