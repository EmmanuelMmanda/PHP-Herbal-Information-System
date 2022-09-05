<?php  include "../includes/database.php";
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
    <title>Medicines</title>
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
    <?php include '../includes/pat_header.php';?>
    <div class="container-fluid ">
        <div class="row pt- ">
            <?php include '../includes/patnavbar.php';?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
                <div class="border-bottom pt-4">
                    <h1 class="h2"><i class="bi bi-hospital"></i> Medicines</h1>
                </div>
                <div class="row">
                    <div class="form-group mt-3 col-lg-5 col-md-7 col-sl-5 m-auto position-relative">
                        <form action="" method="get">
                            <input type="search" name="search" class="form-control d-block search-box position-absolute"
                                placeholder="Search Medicine by Keyword,Name,Owner or category"
                                aria-describedby="helpId">
                            <button type="submit"
                                class="btn btn-primary d-flex flex-row-reverse position-relative search-button">
                                Search
                            </button>
                        </form>
                        <div class="col-12 p-1">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <?php
                            if(!isset($_GET['search'])){  
                                if(isset($_GET['disapproved'])){
                                    $sql = "SELECT * FROM `medicine` WHERE `status`= 'disaproved'";
                                }elseif(isset($_GET['added-by'])){
                                    $added_by = $_GET['added-by'];
                                    $sql = "SELECT * FROM `medicine` WHERE `added_by`='$added_by'";
                                
                                }else{
                                    $sql = "SELECT * FROM `medicine` WHERE `status`= 'Allowed' ";
                                }                                                  
                            }else{
                                $keyword = $_GET['search'];
                                $sql = "SELECT * FROM `medicine` WHERE (`mname` LIKE '%".$keyword."%') OR (`mcategory` LIKE '%".$keyword."%') OR (`added_by` LIKE '%".$keyword."%') OR (`mdescription` LIKE '%".$keyword."%')";
                            }
                            $resultset = mysqli_query($conn, $sql);	
                            if(mysqli_num_rows($resultset)==0){
                                echo '<h5 class="text-center text-danger">';
                                echo 'No Medicine  found !';
                                echo '</h5>';
                            }elseif(!isset($_GET['id'])){	
                         while( $record = mysqli_fetch_assoc($resultset) ) {
                                $id = $record['id'];
                                $mname = $record['mname'];
                                $mcategory = $record['mcategory'];
                                $status = $record['status'];
                                $added_by = $record['added_by'];
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
                                    <div class="col-12 text-center ">
                                        <p class="p-0 m-0">Medicine Name:
                                        <p class="text-info"><?php  echo $mname;?></p>
                                        </p>
                                        
                                        </p>
                                        <p class="p-0 m-0">Medicine Category:
                                        <p class="text-info"><?php  echo $mcategory;?>
                                        </p>
                                        </p>
                                        <p class="p-0 m-0">Description:<span
                                                class="text-info ">&nbsp;<?php  echo $description;?>
                                            </span></p>
                                    </div>
                                    <a href="pr-profile.php?id&practitioner=<?php echo $added_by;?>"
                                        class="btn btn-primary mt-3 w-100 btn-sm   ">Contact Dr. <?php echo $added_by;?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
            </main>

        </div>
    </div>


    <script src="../js/bootstrap.bundle.js"></script>
</body>

</html>