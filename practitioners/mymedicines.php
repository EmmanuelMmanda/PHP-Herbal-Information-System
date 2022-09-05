<?php include "../includes/database.php";
error_reporting(0)?>
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
    <title>Practitioner | My Medicines </title>
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

    input[type='file'] {
        border-radius: 60px;
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
                    <h1 class="h2"><i class="bi bi-hospital"></i>&nbsp; My Medicines</h1>
                </div>
                <div class="row">
                    <div class="form-group mt-3 col-lg-5 col-md-7 col-sl-5 m-auto position-relative">
                        <form action="" method="get">
                            <input type="search" name="search" class="form-control d-block search-box position-absolute"
                                placeholder="Search Medicine by Keyword,Name or category" aria-describedby="helpId">
                            <button type="submit"
                                class="btn btn-primary d-flex flex-row-reverse position-relative search-button">
                                Search
                            </button>
                        </form>
                        <!--
                        <div class="col-12 p-1">
                            <a href="mymedicines.php" class="btn btn-success btn-sm">My Medicines</a>
                            <a href="?disapproved" class="btn btn-danger btn-sm">Sort By Disapproved</a>
                        </div> -->
                    </div>
                </div>
                <hr>
                <!--Display error message-->
                <?php if(isset($_GET['msg'])){
                        $msg = $_GET['msg'];
                        echo '<div class="text-center text-success">';
                        echo $msg;
                        echo '<div>';
                    }
                    ?>
            <!--end-->
                <div class="row mt-3">
                    <?php
                            if(!isset($_GET['search'])){  
                                if(isset($_GET['disapproved'])){
                                    $sql = "SELECT * FROM `medicine` WHERE `status`= 'disaproved' &&  `added_by`= '$user'";
                                }else{
                                    $sql = "SELECT * FROM `medicine`WHERE `added_by`= '$user' ";
                                }                                                  
                            }else{
                                $keyword = $_GET['search'];
                                $sql = "SELECT * FROM `medicine` WHERE (`mname` LIKE '%".$keyword."%') OR (`mcategory` LIKE '%".$keyword."%') OR (`mdescription` LIKE '%".$keyword."%')";
                            }
                            $resultset = mysqli_query($conn, $sql);	
                            if(mysqli_num_rows($resultset)==0){
                                echo '<h5 class="text-center text-danger">';
                                echo 'You have No Medicine !';
                                echo '</h5>';
                            }elseif(!isset($_GET['medicine'])){	
                         while( $record = mysqli_fetch_assoc($resultset) ) {
                                $id = $record['id'];
                                $mname = $record['mname'];
                                $mcategory = $record['mcategory'];
                                $description = $record['mdescription'];
                                $image = $record['image'];
                                
                                $verified  = '';
                                if($verified== 0){
                                    $verified = '<small class="btn btn-danger btn-sm" style="border-radius:20px">Not Verified</small>';
                                }elseif($verified== 1){
                                    $verified = '<small class="btn btn-success btn-sm" style="border-radius:20px">Verified</small>';
                                }else{
                                    echo '';
                                }
                            
                            ?>
                    <div class="col-lg-3 col-md-5 col-sm-8 card-box">
                        <div class="row m-0 bg-light mb-2">
                            <div class=" card-box">
                                <div class="member-card pt-2 pb-2">
                                    <div class="thumb-sm text-center member-thumb mx-auto">
                                        <img src="../upload/<?php echo $image; ?>" class="" alt="profile-image"
                                            height="160px" width="100%">
                                    </div>
                                    <div class="col-12 ">
                                        <label>M-Name: <p class="text-info d-inline-block"><?php  echo $mname;?></p>
                                        </label>
                                        <label>M-Category:<span class="text-info"><?php  echo $mcategory;?>
                                            </span></label>

                                    </div>
                                    <a href="?medicine=<?php echo $mname;?>"
                                        class="btn btn-primary mt-3 w-100 btn-sm">More
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } }else{
                        ?>
                    <!--Display more details on medicine based on medicine on get request-->
                    <?php
                        if(isset($_GET['medicine'])){
                            $mname = $_GET['medicine'];
                            $med_sql = "SELECT * FROM `medicine` WHERE `mname`='$mname'";
                            $med_query = mysqli_query($conn,$med_sql);
                            $data = mysqli_fetch_assoc($med_query);
                            if($med_query){
                                $medid = $data['id'];
                                $image = $data['image'];
                                $mcategory = $data['mcategory'];
                                $description = $data['mdescription'];
                                $added_by = $data['added_by'];                     
                            }
                        }
                        ?>
                         <!--query to delete medicine -->
                         <?php
                                if(isset($_POST['delete_medicine'])){
                                    $sql = "DELETE FROM `medicine` WHERE `id`='$medid'";
                                    $query = mysqli_query($conn,$sql);
                                    if($query){
                                        echo '<script>
                                        window.location.href="mymedicines.php?msg=Medicine Deleted Succesfully.";
                                        </script>';
                                        
                                    }
                                }
                                ?>
                    <!--medicine info card -->
                    <div class="card mb-4 col-5 m-auto rounded border-info ">
                        <div class="card-header ">
                            <h4><?php echo $mname;?>'s Information.</h4>
                        </div>
                        <div class="pt-2 pb-2">
                            <div class="thumb-sm text-center member-thumb mx-auto">
                                <img src="../upload/<?php echo $image; ?>" class="" alt="image" height="160px"
                                    width="80%">
                            </div>
                            <div class="col-12 bg-light  ">
                                <label class=" card btn btn-primary btn-sm d-block text-dark">Medicine Name: <p
                                        class="text-info d-inline-block"><?php  echo $mname;?></p>
                                </label>
                                <label class="card btn btn-primary btn-sm text-dark">Medicine Category:<p
                                        class="text-info d-inline-block"><?php  echo $mcategory;?>
                                    </p>
                                </label>
                                <label class=" card btn btn-primary btn-sm text-dark">Medicine Description:<p
                                        class="text-info d-inline-block">
                                        <?php  echo $description;?></p>
                                </label>
                                <label class=" card btn btn-primary btn-sm text-dark">Added By:<p
                                        class="text-info d-inline-block">
                                        <?php  echo $added_by;?></p>
                                </label>
                            </div>
                            <div class="rounded p-1 ">
                                <form action="" method="post"> <input type="submit" name="delete_medicine"
                                        class="btn btn-danger btn-sm" value="Delete Medicine">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    } ?>
            </main>

        </div>
    </div>


    <script src="../js/bootstrap.bundle.js"></script>
</body>

</html>