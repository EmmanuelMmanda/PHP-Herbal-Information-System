<?php  include "../includes/database.php";?>
<!-- check if a valid session value is present -->
<?php session_start();
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}else{
    header('Location:../login.php?msg=session has ended ! Please re-login');
}
?>
<!-- fetch practitioner record based on username -->
<?php 
    $verification = '';
    $sql = "SELECT * FROM `practitioner` WHERE `username`= '$user'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    if($row){
        $id = $row['id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $image = $row['profile'];
        $phone = $row['phone'];
        $email = $row['email'];
        $verified =  $row['verified'];
        $bio = $row['bio'];
        $username = $row['username'];
        $address = $row['address'] ;  
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
    <?php include '../includes/header.php';?>
    <!--Nav Bar section -->
    <div class="container-fluid ">
        <div class="row pt-4 ">
            <?php include '../includes/practnav.php';?>
            <!-- main body section -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2><i class="bi bi-journal-medical"></i> My Profile</h2>
                </div>
                <div class="container p-0" id="page-content">
                    <div class="section">
                        <!-- License upload -->
                        <?php
                            if(isset($_POST['upload'])){
                                //get practitooner license
                                $practlicense = $_FILES["practlicense"]["name"];
                                $folder = "../upload/license/".basename($practlicense);
                                //get business licence 
                                $businesslicense = $_FILES["buslicense"]["name"];
                                $folder2 = "../upload/buslicense/".basename($businesslicense);
                                //get nida number
                                $nida = mysqli_real_escape_string($conn,$_POST['nida']);
                                //update the 3 records...
                                $command = "UPDATE `practitioner` SET `license`='$practlicense', `businesslicense`='$businesslicense',`nida`='$nida' WHERE `username`='$user'";
                                $result = mysqli_query($conn,$command);
                                if($result == TRUE){
                                    if (move_uploaded_file($_FILES['practlicense']['tmp_name'],$folder)){
                                        if(move_uploaded_file($_FILES['buslicense']['tmp_name'],$folder2)){
                                            mysqli_query($conn,"UPDATE `practitioner` SET `verified`= 2 WHERE `username`='$user'");
                                        echo '<script>
                                        alert("Documents have been submitted for Verification");
                                        window.location.href="";
                                        </script>';   
                                        }else{
                                            echo 'Business license failed to upload';
                                        }                                                         
                                    }else{
                                        $error = "Practitioner license failed to upload";
                                    }
                                }else{
                                    $error = 'Something went Wrong! Please try again Later.';
                                }
                            }else{
                                echo '';
                            }
                            ?>
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
                    <!-- profile and Update card-->
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
                                                            <div class="modal-header  p-1">
                                                                <h5 class="text-dark">Update Profile Picture</h5>
                                                            </div>
                                                            <div class="modal-body m-auto">
                                                                <img src="../upload/<?php echo $image; ?>"
                                                                    data-toggle="modal" data-target="#updatepic"
                                                                    class=" img-radius rounded-circle"
                                                                    alt="User-Profile-Image" height="100px"
                                                                    width="100px">
                                                                <form action="" method="post"
                                                                    enctype="multipart/form-data">
                                                                    <div class="form-group w-100">
                                                                        <input type="file" id="files"
                                                                            class="btn btn-info" name="image" /><br>
                                                                        <small class="text-center text-dark">Only PNG
                                                                            and JPG image
                                                                            formats</small>
                                                                        <br>
                                                                    </div>


                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-secondary"
                                                                            data-dismiss="modal">close</button>
                                                                        <button type="submit" class="btn btn-primary"
                                                                            name="updatepicture">Update</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <h6 class="f-w-600">
                                                <?php echo $fname;echo ' ';echo $lname; ?></h6>
                                            <p><i class="bi bi-lock"></i> <?php echo $verification ?>Practitioner
                                            </p>
                                            <!--Verification Modal for practitioners -->
                                            <!-- Button trigger modal -->
                                            <?php  
                                            $duty = "";
                                            if($verified == 0){
                                                echo '<button type="button" style="border-radius:40px;" class="btn btn-danger"
                                                 data-toggle="modal" data-target="#modelId">
                                                Verify Now
                                            </button>'  ;
                                            }elseif($verified == 1){
                                                echo '<button type="button" style="border-radius:40px;" class="btn btn-success"
                                                data-toggle="modal" >
                                               Verified
                                           </button>';
                                            }elseif($verified == 2){
                                                echo '<button type="button" style="border-radius:40px;" class="btn btn-primary"
                                                data-toggle="modal" >
                                               Verification Pending
                                           </button>';
                                            }else{
                                                echo '';
                                            }
                                                                   
                                            ?>
                                            <!-- Modal License verification -->
                                            <div class="modal fade text-dark" id="modelId" tabindex="-1" role="dialog"
                                                aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form action="" method="post" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-dark"> Practitioners
                                                                    Verification</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="container-fluid">
                                                                    <h6 class="">
                                                                        Submit the Following Documents !
                                                                    </h6>
                                                                    <ol class="text">
                                                                        <li class="text-info">Upload a valid
                                                                            Practitioners License
                                                                            Issued
                                                                            by the State</li>

                                                                        <div class="form-group">
                                                                            <input type="file" id="files"
                                                                                class="btn btn-light"
                                                                                name="practlicense" required /><br>
                                                                            <small class="text-center text-danger">Only
                                                                                PNG and JPG
                                                                                image
                                                                                formats !!<b>NOT PDF</b></small>
                                                                            <br>
                                                                        </div>
                                                                        <hr>
                                                                        <li class="text-info">Valid Business License
                                                                        </li>

                                                                        <div class="form-group">
                                                                            <input type="file" id="files"
                                                                                class="btn btn-light" name="buslicense"
                                                                                required /><br>
                                                                            <small class="text-center text-danger">Only
                                                                                PNG and JPG
                                                                                image
                                                                                formats !!<b>NOT PDF</b></small>
                                                                            <br>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="form-group">
                                                                            <li class="text-info ">NIDA Number</li>
                                                                            <input type="text" name="nida" id=""
                                                                                class="form-control"
                                                                                placeholder="Enter National identity card No."
                                                                                aria-describedby="helpId" required>
                                                                        </div>
                                                                    </ol>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" name="upload"
                                                                    class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                        <!-- Update profile picture -->
                                                        <div class="update">
                                                            <?php
                                                            if(isset($_POST['updatepicture'])){
                                                                    $filename = $_FILES['image']['name'];
                                                                    $location = "../upload/".basename($filename);

                                                                    $updateprofile = "UPDATE practitioner SET `profile`='$filename' WHERE `id`='$id'";
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
                                        <div class="text-white text-center">
                                            <h6 for="bio" class="text-center text-light"><u>Biography</u> </h6>
                                            <p class="text-center justify-content-center"><?php echo $bio ?></p>
                                        </div>
                                        <!-- update profile modal -->
                                        <button type="button" class="btn btn-info w-100 mb-0" data-toggle="modal"
                                            data-target="#updatemodel">
                                            Update Profile
                                        </button>

                                        <!-- Update profile Modal form  -->
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
                                                                <!-- Form Group (location)-->
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
                                                                    <label for="">Office Name (Label) </label>
                                                                    <input class="form-control" id="inputofficename"
                                                                        type="text" placeholder="ie. Grace Product"
                                                                        name="office" value="" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="">Address</label>
                                                                    <input class="form-control" id="inputadress"
                                                                        type="text"
                                                                        placeholder="ie. Dar es salaam,Tanzania"
                                                                        name="address" value="" required>
                                                                </div>
                                                            </div>
                                                            <!-- Form Group (email address)-->
                                                            <div class="mb-1 ">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i
                                                                            class="bi bi-person-lines-fill"></i>
                                                                        Biography.</span>
                                                                    <textarea cols="25" rows="5" name="bio"
                                                                        placeholder="Briefly and Precise, Tell us About yourself and your Speciality"
                                                                        class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                            <!-- Form Row-->
                                                            <div class="row mb-3">
                                                                <!-- Form Group (phone number)-->
                                                                <div class="col6 input-group mb-2">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="bi bi-facebook"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter Facebook Profile ie. facebook.com/grace-products"
                                                                        name="facebook" required>
                                                                </div>
                                                                <div class="col6 input-group mb-3">
                                                                    <label for=""></label>
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="bi bi-twitter"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter Twitter Profile ie. twitter.com/dr.Mwaka"
                                                                        name="twitter" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer p-0">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    name="update">Update</button>
                                                            </div>
                                                        </form>
                                                        <!-- update profile when form is filled -->
                                                        <?php  
                                                            if(isset($_POST['update'])){
                                                                $firstname = mysqli_real_escape_string($conn,$_POST['fname']);
                                                                $lastname = mysqli_real_escape_string($conn,$_POST['lname']);
                                                                $email = mysqli_real_escape_string($conn,$_POST['email']);
                                                                $phonenumber = mysqli_real_escape_string($conn,$_POST['phone']);
                                                                $officename = mysqli_real_escape_string($conn,$_POST['office']);
                                                                $place = mysqli_real_escape_string($conn,$_POST['address']);
                                                                $biography = mysqli_real_escape_string($conn,$_POST['bio']);
                                                                $facebook = mysqli_real_escape_string($conn,$_POST['facebook']);
                                                                $twitter = mysqli_real_escape_string($conn,$_POST['twitter']);

                                                                $stmt = "UPDATE `practitioner` SET `fname`= '$fname', `lname`='$lastname',
                                                                        `email`='$email',`phone`='$phonenumber',`office_name`='$officename',
                                                                        `address`='$place',`bio`='$biography' , `facebook`='$facebook', `twitter`='$twitter'
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
                                    <!-- profile information card -->
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
                                                </div>
                                            </div>
                                            <br><br><b></b>

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