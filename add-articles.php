<?php
require 'inc/connection/connect.php';

$name = $section = $section2 = $section3 = "";
if(isset($_POST['articles'])){
    $name=ucwords($_POST['name']);
    $section1=$_POST['section1'];
    $section2=$_POST['section2'];
    if($_POST['name'] != ""){
        $add=mysqli_query($conn, "insert into articles (name, section1, section2) values(
            '$name',
            '$section1',
            '$section2'
        ) ");
        if($add){
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
</head>
<body style="background-color: #fbfbfb;">
    <div class="container add-art-cont">
        <div class="row">
            <div class="add-art-cont-div">
                <div class="col-md-12">
                        <form action="" method="post">
                            <input type="text" name="name" class="form-control" placeholder="Enter Article Name" value="<?php if(isset($_POST['articles'])){echo $_POST['name'];}?>"><br>
                            <textarea name="section1" class="form-control add-art-sec"><?php if(isset($_POST['articles'])){echo $_POST['section1'];}?></textarea><br>
                            <textarea name="section2" class="form-control add-art-sec"><?php if(isset($_POST['articles'])){echo $_POST['section2'];}?></textarea><br>
                            <input type="submit" name="articles" value="Add New Article" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>







