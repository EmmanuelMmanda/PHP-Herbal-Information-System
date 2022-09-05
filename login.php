<?php require('includes/database.php');
$msg = '';
$error = '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/istyles.css">
</head>

<body>
<div class="text-center text-info">
                    <?php 
                        error_reporting(0);
                        $msg = $_GET['msg'];
                        $error = $_GET['error'];
                        if(!isset($_GET['msg']) OR !isset($_GET['error']))
                        if(isset($error)){
                            echo '<div class="alert alert-danger alert-dismissible fade show p-1  mt-3 w-25 m-auto" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <h5 class=" text-center m-1 p-1">';
                            echo $error;
                            echo '</h5></div>';
                        }elseif($msg){
                            echo '<div class="alert alert-success alert-dismissible fade show  p-1  mt-3 w-25 m-auto" role="alert">
                            <h5 class=" text-center">';
                            echo $msg;
                            echo '</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }else{
                            echo '';
                        }
                         ?>
                </div>
    <div class="formbox">
        <div class="container">
            <div class="container">
                <div class="container text-center">
                    <?php
                        session_start();
                        if(!isset($_SESSION['image'])){
                            $image = "favicon.ico";
                        }else{
                            $table = $_SESSION['table'];
                            $sql = "SELECT * FROM `$table` LIMIT 1";
                            $query = mysqli_query($conn,$sql);
                            $row = mysqli_fetch_assoc($query);
                            if($row == TRUE){
                            $image = $row['profile'];
                            if($image == ""){
                                    $image = "favicon.ico";
                            }
                        }                        
                        }                
                    ?>
                    <img class="text-center mt-2 rounded-circle" src="upload/user.png" width="80px" height="80px"
                        alt="">
                    <?php session_destroy();?>
                </div>

                <form action="loginval.php" method="POST">
                    <div class="form-group">
                        <h5 class="text-center"> LOGIN NOW </h5>
                        <br> <label for="">Username</label>
                        <input type="text" name="username" id="" class="form-control" placeholder="Enter Username"
                            aria-describedby="helpId" required>
                        <label for="">Password</label>
                        <input type="password" name="password" id="" class="form-control" placeholder="Enter Password"
                            aria-describedby="helpId" required>
                    </div>
                    <div style="text-align: center;">
                        <button type="submit" name="login" class="btn btn-success">Login</button>
                    </div>
                </form><br>
                <p>Dont Have an account? <a href="index.php">Register Here</a></p>
            </div>

        </div>
    </div>
    <div class="footer bg-light text-center fixed-bottom">
        <p class="float-bottom">Herbals Trademark. 2022 .All rights Reserved</p>
    </div>
</body>

</html>