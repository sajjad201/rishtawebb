<?php
require 'inc/connection/connect.php';

$name = $section = $section2 = $section3 = "";
if(isset($_POST['articles'])){
    echo $name=ucwords($_POST['name']);echo "<br>";
    echo $section1=$_POST['section1'];echo "<br>";
    echo $section2=$_POST['section2'];echo "<br>";
    if($_POST['name'] != ""){
        $add=mysqli_query($conn, "insert into articles (name, section1, section2) values(
            '$name',
            '$section1',
            '$section2'
        ) ");
        if(mysqli_affected_rows($conn) == 1){
            echo 'article added successfully!';
        }
        else{
            echo 'no data added';
        }
    }
    else{
        echo 'please enter article name';
    }
}
if(isset($_POST['update-articles'])){
    $id=$_POST['id'];
    $name=ucwords($_POST['name']);
    $section1=$_POST['section1'];
    $section2=$_POST['section2'];
    if($_POST['name'] != ""){
        $add=mysqli_query($conn, "UPDATE articles SET name = '$name', section1='$section1', section2='$section2' WHERE id = '$id' ");
        if(mysqli_affected_rows($conn) == 1){
            echo 'article updated successfully!';
        }
        else{
            echo 'nothing updated';
        }
    }
    else{
        echo 'not updated anything';
    }
}
if(isset($_POST['delete-article'])){
    $id=$_POST['id'];
    if($_POST['id'] != ""){
        $add=mysqli_query($conn, "DELETE FROM articles WHERE id = '$id' ");
        if(mysqli_affected_rows($conn) == 1){
            echo "article ".$id." deleted successfully!";
        }
        else{
            echo 'noting deleted';
        }
    }
    else{
        echo 'id not entered';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add article</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo $base_url;?>assets/css/style.css"  />
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
    </script>
    <style>.btn-link{padding:0px; outline:none}.btn-link:focus{outline:none}</style>
</head>
<body style="background-color: #fbfbfb;">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9"></div>
            <div class="col-md-3">
                <form action="" method="post">
                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#delete">delete</button>
                    <div id="delete" class="collapse">
                        <input type="text" name="id" placeholder="enter id">
                        <input type="submit" name="delete-article" value="Delete" class="btn btn-danger btn-sm">
                    </div>
                </form> 
            </div>
        </div>
    </div>   

    <div class="container add-art-cont">
        <div class="row">
            <div class="add-art-cont-div">
                <div class="col-md-2">
                    <?php 
                    $result=mysqli_query($conn, "select * from articles order by id desc");
                    while($r=mysqli_fetch_array($result)){?>
                        <?php echo $r['id'].": ".$r['name'];?><br>
                    <?php }
                    ?>
                </div>
                <div class="col-md-10">
                        <form action="" method="post">
                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#update"> update</button>
                            <div id="update" class="collapse">
                                <input type="text" name="id" placeholder="enter id">
                            </div><br>  
                            <input type="text" name="name" class="form-control" placeholder="Enter Article Name" value="<?php if(isset($_POST['articles'])){echo $_POST['name'];}?>"><br>
                            <textarea name="section1" class="form-control add-art-sec"><?php if(isset($_POST['articles'])){echo $_POST['section1'];}?></textarea><br>
                            <textarea name="section2" class="form-control add-art-sec"><?php if(isset($_POST['articles'])){echo $_POST['section2'];}?></textarea><br>
                            <input type="submit" name="articles" value="Add New Article" class="btn btn-success"><br><br>
                            <input type="submit" name="update-articles" value="Update Article" class="btn btn-info">
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>







