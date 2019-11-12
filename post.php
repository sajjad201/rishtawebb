<?php  
 $connect = mysqli_connect("localhost", "root", "", "rishtawebchat");  
 echo $post_url = $_GET["post_url"];  
 $sql = "SELECT * FROM tbl_post WHERE post_url = '".$post_url."'";  
 $result = mysqli_query($connect, $sql);  
 ?>  
 <html>  
      <head>  
           <title>Make SEO Friendly / Clean Url in PHP using .htaccess</title>  
           <style>  
           .container  
           {  
                width:700px;  
                margin:0 auto;  
                border:1px solid #ccc;  
                padding:16px;  
           }  
           .form_text  
           {  
                width:100%;  
                padding:6px;  
           }  
           </style>  
      </head>  
      <body>  
           <div class="container">  
                <h3 align="center">Make SEO Friendly / Clean Url in PHP using .htaccess</h3>  
                <?php  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                          echo '<h3>'.$row["post_title"].'</h3>';  
                          echo '<p>'.$row["post_text"].'</p>';  
                     }  
                }  
                else  
                {  
                     echo '404 Page';  
                }  
                ?>  
           </div>  
      </body>  
 </html>  