<?php  require('includes/database.php');?>
<?php
session_start();
if(isset($_POST['register'])){
        $fname = mysqli_real_escape_string($conn,$_POST['firstname']);
        $lname = mysqli_real_escape_string($conn,$_POST['lastname']);
        $uname = mysqli_real_escape_string($conn,$_POST['username']);
        $pass = mysqli_real_escape_string($conn,$_POST['pass']);
        $pass2 = mysqli_real_escape_string($conn,$_POST['pass2']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $phone = mysqli_real_escape_string($conn,$_POST['phone']);
        $address = mysqli_real_escape_string($conn,$_POST['address']);
        $profile = $_FILES["profile"]["name"];
        $folder = "upload/".basename($profile);

        $sql = "SELECT * FROM `patients` WHERE `username`='$uname'";
        $query = mysqli_query($conn,$sql);
        $result = mysqli_num_rows($query);
            if($result == 1){
                header('location:index.php?msg=Username already exist');
            }elseif($pass != $pass2){
                header('location:index.php?msg=passwords do not match');
            }else{
                $password = md5($pass);
                $register = "INSERT INTO `patients`(fname,lname,username,password,phone,profile,email,address) 
                 VALUES('$fname','$lname','$uname','$password','$phone','$profile','$email','$address')";
                 $out = mysqli_query($conn,$register);
                 if ($out == TRUE){
                    if (move_uploaded_file($_FILES['profile']['tmp_name'], $folder)) {
                        $_SESSION['table'] = 'patients';
                        header('location:login.php?msg=Succesfully Registered !! Login Now');
                    }else{
                        header('location:index.php?msg=Failed to register.');
                    }
                }
                }
    }
    else{
        header('location:login.php?msg=Patient Something went wrong');
    }
?>