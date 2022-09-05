<?php include "../includes/database.php";?>
<?php session_start();
if(!isset($_SESSION['admin'])){
    header('location:../');
}else{
    $admin= $_SESSION['admin'];
}
?>
<!Doctype html>
<html lang="en">
<head>
    <title>Medicines </title>
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
                    <h1 class="h2"><i class="bi bi-speedometer2"></i>&nbsp;Medicines</h1>
                </div>
                <div class="row">
                    <div class="form-group mt-3 col-lg-5 col-md-7 col-sl-5 m-auto position-relative">
                        <form action="" method="get">
                            <input type="search" name="search" class="form-control d-block search-box position-absolute"
                                placeholder="Search Medicine by name,category or status" aria-describedby="helpId">
                            <button type="submit"
                                class="btn btn-primary d-flex flex-row-reverse position-relative search-button">
                                Search
                            </button>
                        </form>
                        <div class="col-12 p-1">
                            <a href="medicines.php" class="btn btn-success btn-sm">All Medicines</a>
                            <a href="?disaproved" class="btn btn-info btn-sm">Disaproved Medicines</a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <?php
                            if(!isset($_GET['search'])){  
                                if(isset($_GET['disaproved'])){
                                    $sql = "SELECT * FROM `medicine` WHERE `status`= 'disaproved'";
                                }else{
                                    $sql = "SELECT * FROM `medicine`";
                                }                                                 
                            }else{
                                $keyword = $_GET['search'];
                                $sql = "SELECT * FROM `medicine` WHERE (`mname` LIKE '%".$keyword."%') OR (`mcategory` LIKE '%".$keyword."%') OR (`mdescription` LIKE '%".$keyword."%')";
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
                                $description = $record['mdescription'];
                                $image = $record['image'];
                                
                                $verified  = '';
                                if($verified== 0){
                                    $verified = '<small class="btn btn-danger btn-sm" style="border-radius:20px">Disapproved</small>';
                                }elseif($verified== 1){
                                    $verified = '<small class="btn btn-success btn-sm" style="border-radius:20px">Allowed</small>';
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
                                        <p class="p-0 m-0">Status: <?php  
                                        if($status == 'Allowed'){
                                            echo '<b class="text-success">';
                                            echo $status;
                                            echo '</b>';
                                        }else{
                                            echo '<b class="text-danger">';
                                            echo $status;
                                            echo '</b>';
                                        }    
                                        ?></p>
                                        </p>
                                        <p class="p-0 m-0">Medicine Category:
                                        <p class="text-info"><?php  echo $mcategory;?>
                                        </p>
                                        </p>
                                    </div>
                                    <a href="?id=<?php echo $id;?>" class="btn btn-primary mt-3 w-100 btn-sm   ">More
                                        info</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }          
                    }elseif(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $sql = "SELECT * FROM `medicine` WHERE `id`='$id' ";
                            $query = mysqli_query($conn,$sql);
                            $row = mysqli_fetch_assoc($query);
                            $mname =$mcategory =$image = $description = '';
                            if($query == TRUE){
                                $mname = $row['mname'];
                                $description = $row['mdescription'];
                                $mcategory = $row['mcategory'];  
                                $image = $row['image'];
                                $added_by = $row['added_by'];
                                ?>
                    <!--Query to verify or disapprove medicines and display messages -->
                    <?php
                            $error = $msg = "";
                            if(isset($_GET['id'])){
                                $id = $_GET['id'];
                                //check if medicine id is already Verified ;
                                $checksql = "SELECT `status` FROM `medicine` WHERE `id`='$id'";
                                $checkquery = mysqli_query($conn,$checksql); 
                                $statusrow = mysqli_fetch_assoc($checkquery);
                                $verifiedstatus = $statusrow['status'];
                                if($verifiedstatus == 'verified'){
                                    $msg = 'Medicine is Allowed !';
                                    $verifiedstatus == 'verified';
                                }
                            }                          
                            //verify medicines if verify button is pressed
                            if(isset($_POST['verifymedicine'])){     
                                    $verifysql = "UPDATE `medicine` SET `status`='Allowed' WHERE `id`='$id'";
                                    $verifyquery = mysqli_query($conn,$verifysql);
                                    if($verifyquery == TRUE){
                                        $msg = '<script>
                                        alert("Medicine Re-Verified Successfully");
                                        window.location.href="medicines.php";
                                        </script>
                                        ';
                                    }else{
                                        $error = '<script>
                                        alert("Failed to Re-verify Medicine");
                                        window.location.href="medicines.php";
                                        </script>
                                        ';
                                    } 
                                    
                                }                                                
                             //Disapprove Medicine if disapprove button is pressed ..
                            elseif(isset($_POST['disapprove_medicine'])) {
                                $verifysql = "UPDATE `medicine` SET `status`='disaproved' WHERE `id`='$id'";
                                $verifyquery = mysqli_query($conn,$verifysql);
                                if($verifyquery == TRUE){
                                    $msg = '<script>
                                    alert("Medicine Disaproved Successfully");
                                    window.location.href="medicines.php";
                                    </script>
                                    ';                              
                                }else{
                                    $error = '<script>
                                    alert("Failed to disaprove Medicine");
                                    window.location.href="medicines.php";
                                    </script>
                                    ';
                                    
                                }
                                
                            } 
                            ?>
                    <?php  echo '<div class="text-danger text-center">'; 
                                echo $error;
                                 echo '</div>';
                            echo '<div class="text-success text-center">'; 
                                echo $msg;
                                echo '</div>';
                                
                                ?>
                    <div class="card mb-4 col-5 m-auto rounded border-info ">
                        <div class="card-header ">
                            <h4><?php
                            echo $mname;?>'s Information.</h4>
                        </div>
                        <div class="">
                            <div class="">
                                <div class="member-card pt-2 pb-2">
                                    <div class="thumb-sm text-center member-thumb mx-auto">
                                        <img src="../upload/<?php echo $image; ?>" class="" alt="profile-image"
                                            height="140px" width="100%">
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
                                    <?php
                                    if($verifiedstatus == 'Allowed'){
                                        echo '<div class="text-center">
                                        <form action="" method="POST">
                                            <input id="disapprove" type="submit" class="btn btn-danger mt-3" name="disapprove_medicine"
                                                value="Diasprove Medicine" />
                                        </form>
                                    </div>';
                                    }else{
                                        echo '<div class="text-center">
                                        <form action="" method="POST">
                                            <input id="reverify" type="submit" class="btn btn-warning mt-3" name="verifymedicine"
                                                value="Re-Verify Medicine" />
                                        </form>
                                    </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php  
                   }
             }
                    ?>
                </div>
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

</body>

</html>