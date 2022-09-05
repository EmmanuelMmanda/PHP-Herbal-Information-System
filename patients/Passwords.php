<?php  include "../includes/database.php";
session_start();
if(isset($_SESSION['patient'])){
    $user = $_SESSION['patient'];
}else{
    header('Location:../login.php?msg=Session has ended ! Please re-login');
}
?>
<?php 
    $sql = "SELECT * FROM `patients` WHERE `username`= '$user'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    if($row){
        $fname = $row['fname'];
        $lname = $row['lname'];
        $image = $row['profile'];
        $phone = $row['phone'];
        $email = $row['email'];
        $username = $row['username'];
        $address = $row['address'] ;      
        $joined = $row['joined_on'];

    }
?>
<!doctype html>
<html lang="en">

<head>
    <title>Password Reset</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="profile.css">

    <!-- Bootstrap icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>


    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="sidebar.css">

</head>

<body>
<?php include '../includes/pat_header.php';?>
    <div class="container-fluid ">
        <div class="row pt-4 ">
        <?php include '../includes/patnavbar.php';?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="bi bi-lock"></i> Change Password</h1>
                </div>
                <?php
                        if(isset($_POST['change'])){
                            $cpass = mysqli_real_escape_string($conn,$_POST['cpass']);
                            $npass = mysqli_real_escape_string($conn,$_POST['npass']);
                            $rpass = mysqli_real_escape_string($conn,$_POST['rpass']);
                            
                            $sql = "SELECT `password` FROM `patients` WHERE `username`='$user'";
                            $query = mysqli_query($conn,$sql);
                            $row = mysqli_fetch_array($query);
                            $oldpass = $row['password'];

                            $msg = $error = "";
                            if($oldpass == md5($cpass)){
                                if($npass == $rpass){
                                    $npass = md5($npass);
                                    $nsql = "UPDATE `patients` SET `password`='$npass' WHERE `username` = '$user'";
                                    $nquery = mysqli_query($conn,$nsql);
                                    if($query = TRUE){
                                        $msg = 'Password Updated Succesfully';
                                    }else{
                                        $error = 'Failed to change Password';
                                    }
                                } else{
                                    $error = 'Passwords do not match';
                                }                             
                        }else{
                            $error = 'Incorrect Current Password';
                        }
                }         
                ?>
                <h6 class="text-center  text-success"> <?php 
                if(!isset($msg)){echo '';
                }else{
                        echo $msg;
                    }
                ?></h6>
                <h6 class="text-center  text-danger"> <?php 
                if(!isset($error)){ echo '';
                }else{
                    echo $error;
                }
                ?></h6>
                <div class="container p-0" id="page-content">
                    <div class="row container p-2 d-flex justify-content-center">
                        <div class="col-lg-11 col-md-12 p-1">
                            <div class="card user-card-full">
                                <div class="row m-l-0 m-r-0">
                                    <div class="col-sm-4 bg-c-lite-green user-profile">
                                        <div class="card-block text-center text-white">
                                            <div class="m-b-25">
                                                <img src="../upload/<?php echo $image; ?>"
                                                    class="img-radius rounded-circle" alt="User-Profile-Image"
                                                    height="100px" width="100px">
                                            </div>
                                            <h6 class="f-w-600"><?php echo $fname;echo ' ';echo $lname; ?></h6>
                                            <p>Patient <i class="bi bi-pencil-square"></i>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="card-block">
                                            <form action="" method="POST">
                                                <div class="form-group">
                                                    <label for="">
                                                        <h6>Current Password</h6>
                                                    </label>
                                                    <input type="password" name="cpass" id="" class="form-control"
                                                        placeholder="Enter Current password" aria-describedby="helpId"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">
                                                        <h6>New Password</h6>
                                                    </label>
                                                    <input type="password" name="npass" id="" class="form-control"
                                                        placeholder="Enter New password" aria-describedby="helpId"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">
                                                        <h6>Repeat-Password</h6>
                                                    </label>
                                                    <input type="password" name="rpass" id="" class="form-control"
                                                        placeholder="Repeat New password" aria-describedby="helpId"
                                                        required>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" name="change"
                                                        class="btn btn-success p-2 mt-2">Change Password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <li class="list-unstyled border-top my-3"></li>

                <!--cards end-->
            </main>

        </div>
    </div>


    <script src="../js/bootstrap.bundle.js"></script>
    <script src="dashboard.js"></script>
</body>

</html>