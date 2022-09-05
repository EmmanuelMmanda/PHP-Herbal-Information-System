<?php include "../includes/database.php";?>
<?php session_start();
if(!isset($_SESSION['admin'])){
    header('location:../');
}else{
    $admin= $_SESSION['admin'];
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Verify Practitioners </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="../profile.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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

    .small-box {
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.25rem;
    }

    input[type='search'] {
        padding-left: 80px;
        text-align: center;
    }

    button.search-button,
    .search-box,
    .profile {
        border-radius: 70px;
    }

    .font {
        font-size: 24px;
    }
    </style>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="profile.css">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

</head>

<body>
<?php include '../includes/adminheader.php';?>
    <div class="container-fluid ">
        <div class="row pt-4 ">
        <?php include '../includes/adminnav.php';?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <?php 
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM `practitioner` WHERE `id`= '$id'";
                        $query = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_assoc($query);
                            if($row == TRUE){
                                    $error = '';
                                    $fname = $row['fname'];
                                    $lname = $row['lname'];
                                    $image = $row['profile'];
                                    $phone = $row['phone'];
                                    $email = $row['email'];
                                    $address = $row['address'];
                                    $uname = $row['username'];
                                    $bio = $row['bio'];
                                    $carreer = $row['professionality'] ;      
                                    $joined = $row['joined_on'];
                                    $facebook = $row['facebook'];
                                    $twitter = $row['twitter'];

                                }else{
                                    $fname=$uname=$lname=$phone=$email=$address=$carreer=$joined= "";
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
                                            <h6 class="f-w-600">
                                                <?php echo strtoupper($fname);echo ' ';echo strtoupper($lname); ?></h6>
                                            <p><strong>Specialty: </strong> <?php echo $carreer; ?> <i
                                                    class="bi bi-user"></i></p>
                        
                                            <p>Practitioner <i class="bi bi-pencil-square"></i>
                                            </p>
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
                                                    <h6 class="text-muted f-w-400">+255 <?php echo $phone; ?></h6>
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
                                                <li><a href="https://<?php echo $facebook; ?>" data-toggle="tooltip" data-placement="bottom" title=""
                                                        data-original-title="facebook" data-abc="true"><i
                                                            class="bi bi-facebook" aria-hidden="true"></i></a></li>
                                                <li><a href="https://<?php echo $twitter; ?>" data-toggle="tooltip" data-placement="bottom" title=""
                                                        data-original-title="twitter" data-abc="true"><i
                                                            class="bi bi-twitter" aria-hidden="true"></i> </a></li>
                                                <li><a href="https://wa.me/+255<?php echo $phone; ?>" data-toggle="tooltip" data-placement="bottom" title=""
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
</body>

</html>