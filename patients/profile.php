<?php  include "../includes/database.php";
session_start();
if(isset($_SESSION['patient'])){
    $user = $_SESSION['patient'];
}else{
    header('Location:../login.php?msg=Session has ended !');
}
?>
<?php 
    $verification = '';
    $sql = "SELECT * FROM `patients` WHERE `username`= '$user'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    if($row){
        $id = $row['id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $image = $row['profile'];
        $phone = $row['phone'];
        $email = $row['email'];
        $address =$row['address'];
        $username = $row['username'];
        $role = $row['role'] ;
        $joined = $row['joined_on'];
    }
?>
<!doctype html>
<html lang="en">

<head>
    <title><?php echo $user;echo"'s"?> Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

    input[type='file'] {
        border-radius: 60px;
    }
    </style>


    <!-- Custom styles  -->
    <link rel="stylesheet" href="sidebar.css">

</head>

<body>
    <?php include '../includes/pat_header.php';?>
    <div class="container-fluid ">
        <div class="row">
            <?php include '../includes/patnavbar.php';?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h3><i class="bi bi-journal-medical"></i> My Profile</h3>
                </div>
                <div class="container p-0" id="page-content">
                    <div class="section">
                        <?php
                             if(isset($error)){
                                echo '<h5 class="text-danger text-center">';
                                echo $error;
                                echo '</h5>';
                            }elseif(isset($msg)){
                                echo '<h5 class="text-success text-center">';
                                echo $msg;
                                echo '</h5>';            
                              }else{
                                  echo '';
                              }
                    ?>
                    </div>
                    <div class="row container p-2 d-flex justify-content-center">
                        <div class="col-lg-11 col-md-12 p-1">
                            <div class="card user-card-full">
                                <div class="row m-l-0 m-r-0">
                                    <div class="col-sm-4 bg-c-lite-green user-profile">
                                        <div class="card-block text-center text-white">
                                            <div class="m-b-25">
                                                <img src="../upload/<?php echo $image; ?>" data-toggle="modal"
                                                    data-target="#updatepic" class=" img-radius rounded-circle"
                                                    alt="User-Profile-Image" height="100px" width="100px">
                                                <div class="modal fade col-lg-5 m-auto" id="updatepic" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content bg-light">
                                                            <form action="" method="post" enctype="multipart/form-data">
                                                                <div class="modal-header  p-1">
                                                                    <h5 class="text-dark">Update Profile Picture</h5>
                                                                </div>
                                                                <div class="modal-body m-auto">
                                                                    <img src="../upload/<?php echo $image; ?>"
                                                                        data-toggle="modal" data-target="#updatepic"
                                                                        class=" img-radius rounded-circle"
                                                                        alt="User-Profile-Image" height="100px"
                                                                        width="100px">
                                                                    <div class="form-group w-100">
                                                                        <input type="file" id="files"
                                                                            class="btn btn-info" name="image" /><br>
                                                                        <small class="text-center text-dark">Only PNG
                                                                            and
                                                                            JPG image
                                                                            formats</small>
                                                                        <br>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary"
                                                                        data-dismiss="modal">close</button>
                                                                    <button class="btn btn-primary"
                                                                        name="updatepicture">Update</button>
                                                                </div>
                                                            </form>
                                                            <!-- Update profile picture -->
                                                            <div class="update">
                                                                <?php
                                                            if(isset($_POST['updatepicture'])){
                                                                    $filename = $_FILES['image']['name'];
                                                                    $location = "../upload/".basename($filename);

                                                                    $updateprofile = "UPDATE `patients` SET `profile`='$filename' WHERE `id`='$id'";
                                                                    $execute = mysqli_query($conn,$updateprofile);
                                                                    if($execute == TRUE){
                                                                        if(move_uploaded_file($_FILES['image']['tmp_name'], $location)){
                                                                            $msg = 'Profile Picture Updated Succesfully';
                                                                        }else{
                                                                            $error = 'Failed to Update Profile Picture';
                                                                        }
                                                                    }else{
                                                                        $error = 'Update Error';
                                                                    }
                                                            }else{
                                                                $error = 'Something is wrong';
                                                            }
                                                    ?>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <h6 class="f-w-600">
                                                <?php echo $fname;echo ' ';echo $lname; ?></h6>
                                            <p><i class="bi bi-lock"></i>Patient
                                            </p>

                                        </div>
                                        <!-- update profile modal -->
                                        <div class="col-lg-6 d-flex m-auto t">
                                            <button type="button" class="btn btn-info text-light"
                                                style="border-radius: 30px;" data-toggle="modal"
                                                data-target="#updatemodel">
                                                Update Profile
                                            </button>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade " id="updatemodel" tabindex="-1" role="dialog"
                                            aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light p-1 w-100">
                                                        <h5 class="modal-title">Update Profile</h5>

                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">
                                                            <div class="row gx-3 mb-2">
                                                                <!-- Form Group UPDATE PROFILE(location)-->
                                                                <div class="col-md-6">
                                                                    <label for="inputLocation">FirstName</label>
                                                                    <input class="form-control" id="firstname"
                                                                        type="text" placeholder="Enter firstname"
                                                                        name="fname" value="" required>
                                                                </div>
                                                                <div class=" col-md-6">
                                                                    <label for="">Lastname</label>
                                                                    <input class="form-control" id="lastname"
                                                                        type="text" placeholder="Enter lastname"
                                                                        name="lname" value="" required>
                                                                </div>

                                                            </div>
                                                            <div class="row gx-3 mb-2">
                                                                <div class="col-md-6">
                                                                    <label for="inputLocation">Email</label>
                                                                    <input class="form-control" id="inputemail"
                                                                        type="email"
                                                                        placeholder="Enter valid email address"
                                                                        name="email" value="" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="inputLocation">Phone Number</label>
                                                                    <input class="form-control" id="inputLocation"
                                                                        type="text" placeholder="ie. 0763546545"
                                                                        name="phone" value="" required>
                                                                </div>
                                                            </div>
                                                            <div class="row gx-3 mb-1">

                                                                <div class="col-md-6">
                                                                    <label for="">Address</label>
                                                                    <input class="form-control" id="inputadress"
                                                                        type="text"
                                                                        placeholder="ie. Dar es salaam,Tanzania"
                                                                        name="address" value="" required>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer p-0">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    name="update">Update</button>
                                                            </div>
                                                        </form>
                                                        <?php  
                                                            if(isset($_POST['update'])){
                                                                $fname = mysqli_real_escape_string($conn,$_POST['fname']);
                                                                $lastname = mysqli_real_escape_string($conn,$_POST['lname']);
                                                                $email = mysqli_real_escape_string($conn,$_POST['email']);
                                                                $phonenumber = mysqli_real_escape_string($conn,$_POST['phone']);
                                                                $place = mysqli_real_escape_string($conn,$_POST['address']);

                                                                $stmt = "UPDATE `patients` SET `fname`= '$fname', `lname`='$lastname',
                                                                        `email`='$email',`phone`='$phonenumber',
                                                                        `address`='$place'
                                                                        WHERE `username`='$user';
                                                                 ";
                                                                 $run = mysqli_query($conn,$stmt);
                                                                 if($run == TRUE){
                                                                     $msg = 'Profile update Succesfully';
                                                                 }else{
                                                                     $error = 'Failed to Update Profile';
                                                                 }

                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="card-block">
                                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Profile Information
                                            </h6>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Email</p>
                                                    <h6 class="text-muted f-w-400"><?php echo $email; ?></h6>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Phone</p>
                                                    <h6 class="text-muted f-w-400">+255<?php echo $phone; ?></h6>
                                                </div>
                                            </div>
                                            <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Additional Information
                                            </h6>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Address</p>
                                                    <h6 class="text-muted f-w-400"><?php echo $address ;?></h6>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Member since</p>
                                                    <h6 class="text-muted f-w-400"><?php echo $joined; ?></h6>
                                                    <!-- delete account-->
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal" data-target=".bd-example-modal-sm">
                                                        <span class="bi bi-trash3"
                                                            aria-hidden="true"></span>&nbsp;DeleteAccount
                                                    </button>
                                                    <!--verify delete modal-->
                                                    <div class="modal fade bd-example-modal-sm" tabindex="-1"
                                                        role="dialog" aria-labelledby="mySmallModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content p-1">
                                                                <div class="modal-header p-0 m-0 text-center">
                                                                    <h6 class="p-1">Delete&nbsp;Account <i
                                                                            class="bi bi-trash3"></i></h6>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h6 class="text-info ">
                                                                        Are you sure you want to delete Account?
                                                                    </h6>
                                                                </div>
                                                                <div class="text-center footer p-1">
                                                                    <form action="" method="POST">
                                                                        <button class="btn btn-secondary btn-sm p-1"
                                                                            type="button"
                                                                            data-dismiss="modal">NO</button>
                                                                        <button class="btn btn-danger btn-sm p-1"
                                                                            type="submit" name="deleteaccount">YES, I
                                                                            Agree.</button>
                                                                    </form>
                                                                    <!--query to delete user account -->
                                                                    <?php
                                                                    if(isset($_POST['deleteaccount'])){
                                                                        $del_sql = "DELETE FROM `patients` WHERE `id`='$id'";
                                                                        $deleted = mysqli_query($conn,$del_sql);
                                                                        if($deleted == TRUE){
                                                                            session_unset();
                                                                            session_destroy();
                                                                        }else{
                                                                            $error = "Failed to delete Account";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end verify delete modal-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>


    <script src="../js/bootstrap.bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>