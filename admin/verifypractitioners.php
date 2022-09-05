<?php include "../includes/database.php";?>
<?php session_start();
error_reporting(0);
if(!isset($_SESSION['admin'])){
    header('location:../');
}else{
    $admin= $_SESSION['admin'];
}
?>
<!Doctype html>
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

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

</head>

<body>
    <?php include '../includes/adminheader.php';?>
    <!--sidebar -->
    <div class="container-fluid ">
        <div class="row pt-4 ">
            <?php include '../includes/adminnav.php';?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                    <h3><i class="bi bi-journal-medical"></i>Verify Practitioners</h3>
                </div>
                <div class=" content container-fluid ">
                    <div class="row">
                        <div class="form-group mt-3 col-lg-5 col-md-7 col-sl-5 m-auto position-relative">
                            <form action="" method="get" class="">
                                <input type="search" name="search" id=""
                                    class="form-control d-block search-box position-absolute"
                                    placeholder="Search for Practitioner">
                                <button type="submit"
                                    class="btn btn-primary d-flex flex-row-reverse position-relative search-button">
                                    Search
                                </button>

                            </form>
                        </div>
                    </div>


                    <hr>
                    <div class="row mt-3">
                        <!-- Check for verified Practiioners -->
                        <?php
                        if(!isset($_GET['search'])){
                                $sql = "SELECT * FROM `practitioner` WHERE `verified`=2";
                                
                            }else{
                               
                            $keyword = $_GET['search'];
                            $sql = "SELECT * FROM `practitioner` WHERE `verified`=2 && ((`fname` LIKE '%".$keyword."%') 
                            OR (`lname` LIKE '%".$keyword."%') 
                            OR (`professionality` LIKE '%".$keyword."%'))";
                        }
                           $verified = '';
                            $resultset = mysqli_query($conn, $sql);	
                            if($numrows = mysqli_num_rows($resultset) == 0){
                                echo '<h4 class="text-info text-center">';
                                echo 'No Pending Verifications !';
                                echo '</h4>';
                            }	
                            while( $row = mysqli_fetch_assoc($resultset) ) {
                                $id = $row['id'];
                                $fname = $row['fname'];
                                $lname = $row['lname'];
                                $image = $row['profile'];
                                $verified = $row['verified'];
                                $career = $row['professionality'];
                                

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
                                        <a href="?id=<?php echo $id; ?>#userprofile"
                                            class="btn btn-primary mt-3 w-100 btn-sm">View
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php }  echo '<br>';?>
                    </div>
                </div>
            </main>
            <!--- query practitioner data bsed on id -->
            <?php
                if(isset($_GET['id'])){
                    $userid = $_GET['id']; 
                $sql = "SELECT * FROM `practitioner` WHERE `id`= '$userid'";
                $resultset = mysqli_query($conn, $sql);			
                while( $row = mysqli_fetch_assoc($resultset) ) {
                    $id = $row['id'];
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $image = $row['profile'];
                    $email = $row['email'];
                    $address = $row['address'];
                    $phone = $row['phone'];
                    $office = $row['office_name'];
                    $uname = $row['username'];
                    $bio = $row['bio'];
                    $verified = $row['verified'];
                    $career = $row['professionality'];
                    $license = $row['license'];
                    $buslicense = $row['businesslicense'];
                    $nida = $row['nida'];
                    $joined = $row['joined_on'];
                    $facebook = $row['facebook'];
                    $twitter = $row['twitter'];
                  }  
                }
                ?>
            <!--Practitioners Profile Verification Modal -->
            <div class="modal fade col-8" id="userprofile" aria-labelledby="userprofile" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="col-12 p-1">
                                <div class="text-center">
                                    <?php
                            if(isset($_POST['verifyuser'])){
                                $verify = "UPDATE `practitioner` SET `verified`= 1 WHERE `id`='$userid'";
                                $checkverify = mysqli_query($conn,$verify);
                                $msg = $error = '';
                                if($checkverify == TRUE){
                                    echo "<script>
                                    alert('Practitioner Verified Succesfully');
                                    window.location.href='verifypractitioners.php';
                                    </script>";
                                }else{
                                    echo "<script>
                                    alert('Failed to verify Practitioners');
                                    window.location.href='verifypractitioners.php';
                                    </script>";
                                }
                            }
                         ?>
                                </div>
                                <div class="">
                                    <h6 class="m-b-20  b-b-default">Profile Information
                                    </h6>
                                    <hr>
                                    <div class="text-center p-0">
                                        <img style="border-radius: 50%;" src="../upload/<?php echo $image;?>"
                                            width="100px" height="100px">
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Name</p>
                                            <h6 class="text-muted f-w-400">
                                                <?php echo $fname;?>&nbsp;<?php echo $lname;?></h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Phone</p>
                                            <h6 class="text-muted f-w-400"> +255<?php echo $phone; ?></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="text-muted f-w-400"><?php echo $email; ?></h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Username</p>
                                            <h6 class="text-muted f-w-400"> <?php echo $uname; ?></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Additional Information
                                    </h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Office Name</p>
                                            <h6 class="text-muted f-w-400"><?php echo $office; ?></h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Address</p>
                                            <h6 class="text-muted f-w-400"> <?php echo $address; ?></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <p class="m-b-10 f-w-600">Biography</p>
                                            <h6 class="text-muted f-w-400"><?php echo $bio ;?></h6>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="m-b-10 f-w-600">Member since</p>
                                            <h6 class="text-muted f-w-400"><?php echo $joined; ?></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <label for="verify">Uploaded Information & Documents</label>
                                    <div class="col-5 bg-light align-self-right card text-center">
                                        <p class="m-b-10 f-w-600">NIDA Number</p>
                                        <h6 class="text-muted text-center f-w-400"><?php echo $nida; ?></h6>
                                    </div>
                                    <div class="text-center d-flex">
                                        <a class="btn btn-info" href="../upload/license/<?php echo $license; ?>"
                                            target="_blank">&boxbox;
                                            PREVIEW PRACTITIONER LICENSE</a>
                                        <a class="btn btn-primary" href="../upload/buslicense/<?php echo $buslicense ?>"
                                            target="_blank">&boxbox;
                                            PREVIEW BUSINESS LICENSE</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="" method="post">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                                <button type="submit" name="verifyuser" class="btn btn-success ">Verify</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.href.indexOf('#userprofile') != -1) {
            $('#userprofile').modal('show');
        }
    });
    </script>
</body>

</html>