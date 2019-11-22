<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rishtawebchat";
$conn = new mysqli($servername, $username, $password, $dbname);


$result=mysqli_query($conn, 'select * from signup');
$i=1;
while($r=mysqli_fetch_array($result)){?>
    
<url>
    <loc>http://rishtaweb.com/profile/<?php echo $r['id'];?></loc>
    <lastmod>2019-11-21T12:32:27+00:00</lastmod>
    <priority>0.64</priority>
</url>
    
<?php }?>