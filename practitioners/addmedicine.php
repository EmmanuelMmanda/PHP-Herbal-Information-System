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

    input[type='file'] {
        border-radius: 60px;
    }
    </style>
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="sidebar.css">
</head>

<body>
    <?php include '../includes/header.php';?>
    <div class="container-fluid ">
        <div class="row pt-4 ">
            <?php include '../includes/practnav.php';?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4 ">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="bi bi-hospital"></i> Add Medicine </h1>
                </div>
                <!--querry section to add  medicin-->
                
                <?php	
                error_reporting(0);
                    if(isset($_POST['addmedicine'])){
                        $mname = mysqli_real_escape_string($conn,$_POST['mname']);
                        $mcategory = mysqli_real_escape_string($conn,$_POST['mcategory']);
                        $mdescription = mysqli_real_escape_string($conn,$_POST['mdescription']);
                        $image = $_FILES["image"]["name"];
                        $folder = "../upload/".basename($image);
                                $sql = "SELECT * FROM `medicine` WHERE `mname`='$mname'";
                                $query = mysqli_query($conn,$sql);
                                $row = mysqli_fetch_array($query);
                        $condition = ($row['mname'] == $mname && $row['mcategory'] == $mcategory && $row['added_by'] == $user);
                        if($condition == TRUE){
                                    $error ='Medicine entry exists!!';
                        }else{
                            if($mdescription == ''){
                                    $error = 'Please enter Medicine Description !!';
                            }elseif(strlen($mdescription)< 30){
                                    $error = 'Medicine Description is too Short !!';
                            }elseif(strlen($mdescription)> 150){
                                        $error = 'Medicine description too Long !!';
                            }else{
                                $addmed = "INSERT INTO `medicine`(mname,mdescription,mcategory,added_by,image) 
                            VALUES('$mname','$mdescription','$mcategory','$user','$image')";
                            $medquery = mysqli_query($conn,$addmed);
                                if ($medquery == TRUE){
                                    if (move_uploaded_file($_FILES['image']['tmp_name'], $folder)) {
                                        $msg = 'Medicine Recorded Succesfully';
                                            }else{
                                                $error = 'Image Upload failed!!';
                                            }
                                }else{
                                    $error = 'Failed to add medicine';
                                }
                            }
                            
                        }
                    
                        }
                        
                ?>

                <div class="col-lg-5 col-xl-8 account m-auto">
                    <h6 class="text-center top text-success">
                        <?php
                            if(isset($msg)){
                                echo $msg;
                            }else{
                                echo '';
                            }
                            ?>
                    </h6>
                    <h6 class="text-center text-danger bold">
                        <?php echo '<b>' .$_GET['error']. '</b>';?>
                        <?php
                            if(!isset($error)){
                                echo '';
                            }else{
                                echo  $error;
                            }
                            ?>
                    </h6>

                </div>
                <!-- start of conditional add medicine  model -->
                <?php
                $query = mysqli_query($conn,"SELECT `verified` FROM `practitioner` WHERE `username`='$user'");
                $row = mysqli_fetch_assoc($query);
                $verified = $row['verified'];
                if($verified == 0){
                        echo ' <div class="section">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hello. Practitioner </h5> 
                                </div>
                                <div class="modal-body text-danger">
                                    <h6>
                                        Sorry !! Only <a href="practitioners.php?verified">Verified Practitioners</a> can add Medicines.
                                        To verify yourself Please head to <a href="profile.php">Profile </a> Page or Use the Verify now Button Below.
                                    </h6>
                                </div>
                                <div class="modal-footer">
                                    <a type="button" href="profile.php" class="btn btn-primary">Verify Now</a>
                                </div>
                            </div>
                        </div>
                    </div>';
                }elseif($verified == 1){
                    echo '<div class="card mb-4 col-7 m-auto ">
                    <div class="card-header">Add medicine Information| <small class="text-danger">* All Fields
                            are
                            Mandatory</small></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row gx-3 mb-3">
                                <div class="text-center m-auto my-2">
                                    <img src="../images/herbs.png" class="rounded-circle" width="100px" height="100px" alt=""><br>
                                    <div class="form-group">
                                        <input type="file" id="files" class="btn btn-light" name="image" required /><br>
                                        <small class="text-center text-danger">* Select Only PNG and JPG image formats</small>
                                        <br>
                                    </div>
                                </div>
                                <div class="col6 input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-card-heading"></i>&nbsp;Name</span>
                                    <input type="text" class="form-control" placeholder="Enter Medicine Name" name="mname"
                                        required>
                                    &nbsp;
                                    <span class="input-group-text d-flex" id="basic-addon1"><i
                                            class="bi bi-card-heading d-flex"></i>&nbsp;Category</span>
                                    <select class="form-select " name="mcategory" id="mcategory" value="Choose a Category"
                                        required>
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
                                <div class="form-group d-flex m-auto w-100">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-lines-fill"></i>
                                            &nbsp;Medicine-Description.</span>
                                        <textarea cols="3" rows="1" name="mdescription" placeholder="Be short and Precise."
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- finish ad medicine button-->
                            <div class="text-center">
                                <button class="btn btn-primary " type="submit" name="addmedicine"> Add Medicine
                                </button>
                            </div>
        
                        </form>
        
                    </div>
                </div>';
                }else{
                    echo' <div class="section">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Hello. Practitioner </h5> 
                            </div>
                            <div class="modal-body text-danger">
                                <h6>
                                    Sorry !! Only <a href="prverified.php">Verified Practitioners</a> can add Medicines.
                                    Verification Might take some time. Use the Check Status Button Below to view your verification status.
                                </h6>
                            </div>
                            <div class="modal-footer">
                                <a type="button" href="profile.php" class="btn btn-primary">Check Status</a>
                            </div>
                        </div>
                    </div>
                </div>';
                }
                ?>

        </div>

        </main>

    </div>
    </div>
    <script src="../js/bootstrap.bundle.js"></script>

</body>

</html>