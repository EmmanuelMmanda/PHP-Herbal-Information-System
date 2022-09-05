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
    <title>Administrator Dashboard </title>
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
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="bi bi-speedometer2"></i>&nbsp; Admin Dashboard</h1>
                </div>
                <div class='container-fluid'>
                    <div class="row">
                        <div class="col-4 pb-2 mb-3 ">
                            <!-- small box -->
                            <div class="small-box bg-info text-center rounded p-0 m-0">
                                <p class="text-light">Total Practitioners</p>
                                <div class="p-0 m-o">
                                    <?php
                                $sql = "SELECT * FROM practitioner";
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
                                    <i class="fas fa-user-tie fa-2x"></i>
                                </div>
                                <hr class="dropdown-divider m-0">
                                <a href="practitioners.php" class="text-light">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-4 pb-2 mb-3">
                            <!-- small box -->
                            <div class="small-box bg-success text-center rounded">
                                <p class="text-light">Verified Practitioners</p>
                                <div class="p-0 m-o">
                                    <?php
                                $sql = "SELECT * FROM practitioner where `verified`=1";
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
                                    <i class="fas fa-user-tie fa-2x"></i>
                                </div>
                                <hr class="dropdown-divider m-0">
                                <a href="practitioners.php?verified" class="text-light">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-4 pb-2 mb-3">
                            <!-- small box -->
                            <div class="small-box bg-warning text-center rounded">
                                <p class="text-light">Total Medicines</p>
                                <div class="p-0 m-o">
                                    <?php
                                $sql = "SELECT * FROM `medicine`";
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
                                <a href="medicines.php" class="text-light">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-4 pb-2 mb-3">
                            <!-- small box -->
                            <div class="small-box mb-2 bg-secondary text-center rounded">
                                <p class="text-light">Total Patients</p>
                                <div class="p-0 m-o">
                                    <?php
                                $sql = "SELECT * FROM `patients`";
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
                                <i class="fas fa-user-tie fa-2x"></i>
                                </div>
                                <hr class="dropdown-divider m-0">
                                <div>&nbsp;</div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-4 pb-2 mb-3">
                            <!-- small box -->
                            <div class="small-box mb-2 bg-primary text-center rounded">
                                <p class="text-light">Reviews</p>
                                <div class="p-0 m-o">
                                    <?php
                                $sql = "SELECT * FROM `reviews`";
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
                                <i class="fas fa-user-tie fa-2x"></i>
                                </div>
                                <hr class="dropdown-divider m-0">
                                <a href="reviews.php" class="text-light">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <li class="list-unstyled border-top my-3"></li>
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>


</html>