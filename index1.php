<?php  
 $connect = mysqli_connect("localhost", "root", "", "rishtawebchat");  
 if(isset($_POST["submit_btn"]))  
 {  
      $post_title = mysqli_real_escape_string($connect, $_POST["post_title"]);  
      $post_text = mysqli_real_escape_string($connect, $_POST["post_text"]);  
      $post_title = htmlentities($post_title);  
      $post_text = htmlentities($post_text);  
      $sql = "INSERT INTo tbl_post (post_title, post_text, post_url) VALUES ('".$post_title."', '".$post_text."', '".php_slug($post_title)."')";  
      if(mysqli_query($connect, $sql))  
      {  
           header("location:p/".php_slug($post_title)."");  
      }  
 }  
 function php_slug($string)  
 {  
      $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($string)));  
      return $slug;  
 }  
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
                <form name="submit_form" method="post">  
                     <p>Post Title  
                     <input type="text" name="post_title" class="form_text" maxlength="200" />  
                     </p>  
                     <p>Post Text  
                     <textarea name="post_text" class="form_text" rows="10"></textarea>  
                     </p>  
                     <p><input type="submit" name="submit_btn" value="Submit" />  
                </form>  
                <?php
                $sql = "SELECT post_url FROM tbl_post";  
                $result = mysqli_query($connect, $sql);  
                if(mysqli_num_rows($result)){
                     while($r=mysqli_fetch_array($result)){?>
                         <a href="p/<?php echo $r['post_url']?>"><?php echo $r['post_url']?></a><br>
                    <?php }
                }
                ?>
           </div>  
      </body>  
 </html>  