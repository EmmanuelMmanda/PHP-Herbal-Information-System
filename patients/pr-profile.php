<?php  include "../includes/database.php";
error_reporting(0);
if(!isset($_GET['id'])){
    header('location:practitioners.php');

}
?>
<?php 
session_start();
if(isset($_SESSION['patient'])){
    $user = $_SESSION['patient'];
}else{
    header('Location:../login.php?msg=Session has ended ! Please re-login');
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Practitioner's Profile</title>
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


    <!-- Custom styles  -->
    <link rel="stylesheet" href="sidebar.css">

</head>

<body>
    <?php include '../includes/pat_header.php';?>
    <div class="container-fluid ">
        <div class="row pt-4 ">
            <?php include '../includes/patnavbar.php';?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <?php 
                    if(isset($_GET['id'])){
                        $pr_name= '';
                        $pr_name = $_GET['practitioner'];
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM `practitioner` WHERE `id`= '$id' OR `username`='$pr_name'";
                        $query = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_assoc($query);
                            if($row == TRUE){
                                    
                                    $error = '' ;
                                    $fname = $row['fname'];
                                    $lname = $row['lname'];
                                    $image = $row['profile'];
                                    $phone = $row['phone'];
                                    $email = $row['email'];
                                    $address = $row['address'];
                                    $uname = $row['username'];
                                    $carreer = $row['professionality'] ;      
                                    $joined = $row['joined_on'];
                                    $verified = $row['verified'];
                                    $facebook  = $row['facebook'];
                                    $twitter = $row['twitter'];

                                }else{
                                    $fname=$uname=$verified =$lname=$phone=$email=$address=$carreer=$joined= "";
                                    $image = 'user.png';
                                    $error = "<b>No Profile with ID = $id Found </b>";                         
                                } 
                            }
                        ?>
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="bi bi-journal-medical"></i><?php echo $uname ;echo "'s"?> Profile</h1>
                </div>
                <div class="text-center text-danger">
                    <?php  if(isset($error)){
                        echo $error;
                    }else{
                        echo '';
                    } ?>
                </div>
                <div class="container p-0 m-0" id="page-content">
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
                                            <h6 class="f-w-600">
                                                <?php echo strtoupper($fname);echo ' ';echo strtoupper($lname); ?></h6>
                                            <h6 class="p-1">Specialty: <b class="text-dark"><?php echo $carreer; ?> <i
                                                        class="bi bi-user"></i></b>
                                            </h6>
                                            <h6 class="p-1">Medicines: <b class="text-dark"><?php
                                            $meds_sql= "SELECT * FROM `medicine` WHERE `added_by`='$uname'";
                                            $meds_query = mysqli_query($conn,$meds_sql);
                                            $numofmeds = mysqli_num_rows($meds_query);                            
                                            echo $numofmeds; ?> <i class="bi bi-user"></i></b>
                                            </h6>
                                            <?php  
                                            
                                            if($verified == 0){
                                                echo '<button type="button" style="border-radius:40px;" class="btn btn-danger"
                                                 data-toggle="modal" data-target="#modelId">
                                                Not Verified
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
                                            <p>Practitioner <i class="bi bi-pencil-square"></i>

                                        </div>
                                        <!-- update profile modal -->
                                        <a href="medicines.php?added-by=<?php echo $uname?>"
                                            class="btn btn-info w-100 mb-0" data-toggle="modal"
                                            data-target="#updatemodel">
                                            VIEW PRACTITIONER MEDICINES
                                        </a>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="card-block">
                                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Profile Information
                                            </h6>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Email</p>
                                                    <h6 class="text-muted f-w-400"><?php echo $email; ?></h6>
                                                    <a href="mailto:<?php echo $email; ?>" class="btn btn-info btn-sm"
                                                        aria-label="Left Align">
                                                        <span class="bi bi-send" aria-hidden="true"></span>&nbsp;Send
                                                        Email
                                                    </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Phone</p>
                                                    <h6 class="text-muted f-w-400">+255<?php echo $phone; ?></h6>
                                                    <a href="sms:+255<?php echo $phone; ?>?&body=Hellow <?php echo $user; ?> ,I am interested in your medicine."
                                                        class="btn btn-info btn-sm" aria-label="Left Align">
                                                        <span class="bi bi-send" aria-hidden="true"></span> &nbsp;Send
                                                        Text
                                                    </a> &nbsp;
                                                    <a href="tel:+255<?php echo $phone;?>" class="btn btn-info btn-sm"
                                                        aria-label="Left Align">
                                                        <span class="bi bi-phone" aria-hidden="true"></span> &nbsp;
                                                        Call Now
                                                    </a>
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
                                            <ul class="social-link list-unstyled m-t-40 m-b-10">
                                                <li><a target="_blank" href="https://<?php echo $facebook; ?>"
                                                        data-toggle="tooltip" data-placement="bottom" title=""
                                                        data-original-title="facebook" data-abc="true"><i
                                                            class="bi bi-facebook" aria-hidden="true"></i></a></li>
                                                <li><a target="_blank" href="https://<?php echo $twitter; ?>"
                                                        data-toggle="tooltip" data-placement="bottom" title=""
                                                        data-original-title="twitter" data-abc="true"><i
                                                            class="bi bi-twitter" aria-hidden="true"></i> </a></li>
                                                <li><a target="_blank"
                                                        href="https://wa.me/+255<?php echo $phone; ?>?text=Hellow <?php echo $user; ?> ,I am interested in your medicine."
                                                        data-toggle="tooltip" data-placement="bottom" title=""
                                                        data-original-title="whatsapp" data-abc="true"><i
                                                            class="bi bi-whatsapp" aria-hidden="true"></i></a></li>
                                            </ul>
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
    <script src="dashboard.js"></script>
</body>

</html>