<?php include '../includes/database.php';?>
<?php
session_start();
error_reporting(0);
    if(!isset($_SESSION['username'])){
        header('location:../index.php?error=Please register an account first!');
    }
    if(isset($_GET['user'])){
        $user = $_GET['user'];
    }else{
        $error = 'No valid User Set';
        header('location:../login.php?msg=Failed to finish registration.');
    }
    $sql = "SELECT `id`,`is_new` FROM `practitioner` WHERE `username` = '$user'";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($query);
        if($row == TRUE){
            if($row['is_new'] == 1){
                header('location:../login.php');
            }
        } 
    $error = '';

    //check if finish register button was clicked an collect filled information...
    if(isset($_POST['finishregister'])){
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $office = mysqli_real_escape_string($conn,$_POST['office']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $speciality = mysqli_real_escape_string($conn,$_POST['speciality']);
    $bio = mysqli_real_escape_string($conn,$_POST['bio']);
    $facebook = mysqli_real_escape_string($conn,$_POST['facebook']);
    $twitter = mysqli_real_escape_string($conn,$_POST['twitter']);
    $register = "UPDATE `practitioner` SET  `address` = '$address',`office_name`='$office',`phone`='$phone',`professionality`='$speciality',`bio`='$bio',`facebook`='$facebook',`twitter`='$twitter',`is_new`=1 WHERE `username`='$user'";
     $result = mysqli_query($conn,$register);
     if($result== TRUE){ 
        $_SESSION['user'] = $user;
         header('location:index.php');
    }else{
         $error = 'Failed to Finish Registration';
     }
}else{
    $msg = '';
}
?>

<?php
    $image = '';
    $uname = '';
    $sql = "SELECT * FROM `practitioner` WHERE `username`= '$user'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    if($row==TRUE){
        $fname = $row['fname'];
        $lname = $row['lname'];
        $uname = $row['username'];
        $email = $row['email'];
        $image = $row['profile'];
    }
?>
<!--fetch profile data-->
<?php
    $usersession = $_SESSION['usersession'];
    $img_sql = "SELECT `profile` FROM `practitioner` WHERE `username`='$user'";
    $img_query = mysqli_query($conn,$img_sql);
    $img_data = mysqli_fetch_assoc($img_query);
    $img = $img_data['profile'];
    if($img == ''){
        $img = '../upload/user.png';
    }
?>
<!doctype html>
<html lang="en">

<head>
    <title>Finish Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

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

    .account {
        font-size: 14px;

    }
    </style>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="sidebar.css">

</head>

<body>
    <header class="navbar fixed-top bg-info flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 py-2 bg-light text-info shadow rounded" href="#">
            <h5 style="height: 38px;margin: 0;">HERBAL SYSTEM</h5>
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="bi bi-list"></span>
        </button>
        <div class="p-2 text-center d-none d-md-block text-success rounded bg-light">
            <marquee behavior="" direction="">
                <h5>INTEGRATED SYSTEM FOR LINKING PATIENTS WITH TRADITIONAL MEDICINE PROVIDERS.</h5>
            </marquee>
        </div>
        <div class="col-2 d-flex d-none d-sm-block bg-light text-info shadow rounded" style="padding: 1px;">
            <h5> &nbsp;<img src="../upload/<?php echo $img;?>" height="44px" width="44px" class="rounded-circle"
                    alt="">&nbsp;&nbsp;Hi.
                <?php echo strtoupper($user);?>
            </h5>
        </div>
    </header>
    <main class="pt-5">
        <div class="container-xl px-4 mt-4">
            <div class="alert alert-success alert-dismissible fade show p" role="alert">
                <h6>
                    You were Succesfully Registered ! Please provide us further Account details so we could integrate
                    you
                    easily with Patients.
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <hr class="mt-0 mb-4">
            <div class="row">
                <div class="col-lg-4 col-md-8 col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile </div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class=" rounded-circle mb-2" src="../upload/<?php echo $image ;?>" height="100px"
                                width="100px" alt="">
                            <h6 class="f-w-300">
                                <?php echo strtoupper($fname);echo ' ';echo strtoupper($lname); ?></h6>
                            <p><strong>Email: </strong> <?php echo $email; ?> <i class="bi bi-user"></i>

                            <p>Practitioner <i class="bi bi-pencil-square"></i>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 account">
                    <div class="text-center text-success">
                        <?php
                            if(isset($msg)){
                                echo $msg;
                            }else{
                                echo '';
                            }
                            ?>
                    </div>
                    <!-- Account details card-->
                    <div class="text-center text-danger">
                        <?php
                            if(!isset($error)){
                                echo '';
                            }else{
                                echo  $error;
                            }
                            ?>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">Account Details | <small class="text-danger">* All Fields are
                                Mandatory</small></div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="row gx-3 mb-3">
                                    <div class="col6 input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="bi bi-house"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Office Name"
                                            name="office" required>
                                    </div>
                                    <div class="col6 input-group mb-3">
                                        <label for=""></label>
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="bi bi-house"></i></span>
                                        <input type="text" class="form-control"
                                            placeholder="Enter an Address ie. Sinza, Dar-es-salaam" name="address"
                                            required>
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (location)-->
                                    <div class="col-md-6">
                                        <label for="inputLocation">Phone Number</label>
                                        <input class="form-control" id="inputLocation" type="text"
                                            placeholder="Phone Number ie 0763546545" name="phone" value="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Speciality</label>
                                        <select class="form-select" name="speciality" id="speciality" required>
                                            <option>Fertility[ Men ]</option>
                                            <option>Muscle and Joints</option>
                                            <option>Fertility[ Women ]</option>
                                            <option>Sexual Transmitted Diseases</option>
                                            <option>Cardiac Infections</option>
                                            <option>Dental Care</option>
                                            <option>Skin Infections</option>
                                            <option>Herbs for Health</option>
                                        </select>
                                    </div>

                                </div>
                                <!-- Form Group (email address)-->
                                <div class=" mb-2 ">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-lines-fill"></i>
                                            Biography.</span>
                                        <textarea cols="30" rows="5" name="bio"
                                            placeholder="Briefly and Precise, Tell us About yourself and your Speciality"
                                            class="form-control"></textarea>
                                    </div>


                                </div>
                                <!-- Form Row-->
                                <div class="row mb-3">
                                    <!-- Form Group (phone number)-->
                                    <div class="col6 input-group mb-3">
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
                                            placeholder="Enter Twitter Profile ie. twitter.com/dr.Mwaka" name="twitter"
                                            required>
                                    </div>
                                </div>
                                <!-- fiish registration button-->
                                <div class="text-center">
                                    <button class="btn btn-primary " type="subit" name="finishregister">Finish
                                        Registration</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="../js/bootstrap.bundle.js"></script>
</body>

</html>