<?php
include "../includes/database.php";?>
<?php session_start();
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}else{
    header('Location:../login.php?msg=session has ended ! Please re-login');
}
?>
<?php 
        $username = '';
        $sql = "SELECT `id`,`is_new` FROM `practitioner` WHERE `username` = '$user'";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($query);
        if($row == TRUE){
            if($row['is_new'] == 0){
                header('location:finishregister.php?id='.$username);
            }
        }
        
?>
<!doctype html>
<html lang="en">

<head>
    <title>Dashboard | Welcome</title>
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
    </style>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="sidebar.css">
</head>

<body>
    <?php include '../includes/header.php';?>
    <div class="container-fluid ">
        <div class="row pt-4 ">
            <?php include '../includes/practnav.php';?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="bi bi-speedometer2"></i>&nbsp;Dashboard</h1>
                </div>
                <div class='container-fluid'>
                    <div class="row">
                        <!-- ./col -->
                        <div class="col-5 pb-2 mb-3">
                            <!-- small box -->
                            <div class="small-box bg-info text-center rounded">
                                <p class="text-light">Your Medicines</p>
                                <div class="p-0 m-o">
                                    <?php
                                $sql = "SELECT * FROM medicine WHERE `added_by`='$user'";
                                $query = mysqli_query($conn,$sql);
                                if($num = mysqli_num_rows($query))
                                {
                                    echo '<h3>';
                                   echo $num ;
                                   echo '</h3>';
                                }else{
                                    echo '<h3>';
                                   echo '0' ;
                                   echo '</h3>';
                                }
                                
                            ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-disease fa-2x"></i>
                                </div>
                                <hr class="dropdown-divider m-0">
                                <a href="mymedicines.php" class="text-light">More info <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-5 pb-2 mb-3">
                            <!-- small box -->
                            <div class="small-box bg-success text-center rounded">
                                <p class="text-light">Status</p>
                                <div class="p-0 m-o"> 
                                    <?php
                                $sql = "SELECT * FROM `practitioner` WHERE `username`='$user'";
                                $query = mysqli_query($conn,$sql);
                                $row = mysqli_fetch_assoc($query);
                                if($row){
                                    $status = $row['verified'];
                                    if($status == 1){
                                        echo '<h3>';
                                        echo 'Verified &nbsp;&checkmark;';
                                        echo '<h3>';
                                    }elseif($status == 2){
                                        echo '<h3>';
                                        echo 'Pending Verification';
                                        echo '<h3>';
                                    }else{
                                        echo '<h3>';
                                        echo 'Not Verified';
                                        echo '<h3>';
                                    }
                                }
                            ?>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-tie fa-2x"></i>
                                </div>
                                <hr class="dropdown-divider m-0">
                                <a href="profile.php" class="text-light">More info <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- col -->
                        <!-- ./col -->
                    </div>
                </div>
                <li class="list-unstyled border-top my-3"></li>
            </main>

        </div>
    </div>


    <script src="../js/bootstrap.bundle.js"></script>
</body>

</html>