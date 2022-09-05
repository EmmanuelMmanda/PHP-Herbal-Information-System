<?php
    session_start();
    require('includes/database.php');
if(isset($_POST['register'])){
        $fname = mysqli_real_escape_string($conn,$_POST['firstname']);
        $lname = mysqli_real_escape_string($conn,$_POST['lastname']);
        $uname = mysqli_real_escape_string($conn,$_POST['username']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $pass = mysqli_real_escape_string($conn,$_POST['pass']);
        $pass2 = mysqli_real_escape_string($conn,$_POST['pass2']);
        $profile = $_FILES["profile"]["name"];
        $folder = "upload/".basename($profile);

        $sql = "SELECT * FROM `practitioner` WHERE `username`='$uname'";
        $query = mysqli_query($conn,$sql);
        $result = mysqli_num_rows($query);
            if($result == 1){
                header('location:index.php?msg=Username already exist');
            }elseif($pass != $pass2){
                header('location:index.php?msg=passwords do not match');
            }else{
                $password = md5($pass);
                $register = "INSERT INTO `practitioner`(fname,lname,email,username,password,profile) 
                 VALUES('$fname','$lname','$email','$uname','$password','$profile')";
                 $out = mysqli_query($conn,$register);
                 if ($out == TRUE){
                    if (move_uploaded_file($_FILES['profile']['tmp_name'], $folder)) {
                        $_SESSION['username'] = $uname;
                        header('location:practitioners/finishregister.php?user='.$uname);
                    }else{
                        header('location:index.php?msg=Failed to register.');
                    }
                }
            }
    }
    else{
        header('location:index.php?msg=Failed to register practitioner.');
    }

?>