<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rishtawebchat";
$conn = new mysqli($servername, $username, $password, $dbname);


$result=mysqli_query($conn, 'select * from caste');
$i=1;
while($r=mysqli_fetch_array($result)){?>
    
<url>
    <loc>http://rishtaweb.com/find/caste/<?php echo $r['url'];?></loc>
    <lastmod>2019-12-04T10:45:22+00:00</lastmod>
    <priority>0.64</priority>
</url>
    
<?php }?>