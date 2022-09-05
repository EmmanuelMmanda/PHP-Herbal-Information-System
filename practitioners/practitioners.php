<?php include "../includes/database.php"; ?>
<?php session_start();
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}else{
    header('Location:../login.php?msg=session has ended ! Please re-login');
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Practitioners</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">


    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 700px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
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
</head>
<!-- Bootstrap icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

<body>
    <?php include '../includes/header.php';?>
    <div class="container-fluid ">
        <div class="row pt-4 ">
            <?php include '../includes/practnav.php';?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-3 pt-4 ">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                    <h3><i class="bi bi-journal-medical"></i> Other Practitioners</h3>
                </div>
                <div class=" content container-fluid ">
                    <div class="row">
                        <div class="form-group mt-3 col-lg-5 col-md-7 col-sl-5 m-auto position-relative">
                            <form action="" method="get">
                                <input type="search" name="search"
                                    class="form-control d-block search-box position-absolute"
                                    placeholder="Search for Practitioner" aria-describedby="helpId">
                                <button type="submit"
                                    class="btn btn-primary d-flex flex-row-reverse position-relative search-button">
                                    Search
                                </button>

                            </form>
                            <!--
                            <div class="col-11 p-1">
                                <a href="?pending" class="btn btn-info btn-sm">Sort By Pending</a>
                                <a href="?verified" class="btn btn-success btn-sm">Sort By Verified</a>
                                <a href="?notverified" class="btn btn-danger btn-sm">Sort By Not Verified</a>
                            </div> 
                        -->
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <?php
                            if(!isset($_GET['search'])){
                                if(isset($_GET['verified'])){
                                    $sql = "SELECT * FROM `practitioner` WHERE `verified`=1";
                                }elseif(isset($_GET['notverified'])){
                                    $sql = "SELECT * FROM `practitioner` WHERE `verified`=0";
                                }elseif(isset($_GET['pending'])){
                                    $sql = "SELECT * FROM `practitioner` WHERE `verified`=2";
                                }
                                else{
                                    $sql = "SELECT * FROM `practitioner` WHERE  `username` != '$user' AND `verified`=1";
                                }                       
                            }else{
                                $keyword = $_GET['search'];
                                $sql = "SELECT * FROM `practitioner` WHERE (`fname` LIKE '%".$keyword."%') OR (`lname` LIKE '%".$keyword."%') OR (`professionality` LIKE '%".$keyword."%')";
                            }
                            $verified = '';
                            $resultset = mysqli_query($conn, $sql);	
                            if(mysqli_num_rows($resultset)==0){
                                echo '<h5 class="text-center text-danger">';
                                echo 'No Practitioners found !';
                                echo '</h5>';
                            }		
                            while( $record = mysqli_fetch_assoc($resultset) ) {
                                $id = $record['id'];
                                $fname = $record['fname'];
                                $lname = $record['lname'];
                                $image = $record['profile'];
                                $email = $record['email'];
                                $phone = $record['phone'];
                                $facebook = $record['facebook'];
                                $twitter = $record['twitter'];
                                $verified = $record['verified'];
                                $career = $record['professionality'];
                                if($verified== 0){
                                    $verified = '<small class="btn btn-danger btn-sm" style="border-radius:20px">Not Verified</small>';
                                }elseif($verified== 1){
                                    $verified = '<small class="btn btn-success btn-sm" style="border-radius:20px">Verified</small>';
                                }elseif($verified == 2){
                                    $verified = '<small class="btn btn-primary btn-sm" style="border-radius:20px">Pending</small>';
                                }else{
                                    echo '';
                                }
                            
                            ?>
                        <div class="col-lg-3 col-md-5 col-sm-8 card-box  ">
                            <div class="row m-0 bg-light mb-2">
                                <div class="text-center card-box">
                                    <div class="member-card pt-2 pb-2">
                                        <div class="thumb-sm member-thumb mx-auto">
                                            <img src="../upload/<?php echo $image; ?>" class="rounded-circle"
                                                alt="profile-image" height="80px" width="80px">
                                        </div>
                                        <div class="">
                                            <h5><?php  echo $fname;echo ' ';echo $lname; ?></h5>
                                            <p class="text-muted">@ <?php echo $career; ?> <span> </span><span></span>
                                            </p>
                                            <p class=" w-100 h-25 "><?php echo $verified; ?></p>
                                        </div>
                                        <ul class="social-link list-inline  m-t-40 m-b-10">
                                            <li class="list-inline-item"><a title="" data-placement="top"
                                                    data-toggle="tooltip" class="tooltips"
                                                    href="https://<?php echo $facebook; ?>"
                                                    data-original-title="Facebook"><i class="bi bi-facebook"></i></a>
                                            </li>
                                            <li class="list-inline-item"><a title="" data-placement="top"
                                                    data-toggle="tooltip" class="tooltips"
                                                    href="https://<?php echo $twitter; ?>"
                                                    data-original-title="Twitter"><i class="bi bi-twitter"></i></a></li>
                                            <li class="list-inline-item"><a title="" data-placement="top"
                                                    data-toggle="tooltip" class="tooltips"
                                                    href="https://wa.me/+255<?php echo $phone; ?>"
                                                    data-original-title="whatsapp"><i
                                                        class="bi bi-whatsapp h-100"></i></a>
                                            </li>
                                        </ul>
                                        <a href="pr-profile.php?id=<?php echo $id;?>"
                                            class="btn btn-primary mt-3 w-100 btn-sm   ">Full
                                            Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }  echo '<br';?>
                    </div>
                </div>
            </main>

        </div>
    </div>


    <script src="../js/bootstrap.bundle.js"></script>
</body>

</html>