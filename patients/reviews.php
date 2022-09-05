<?php  include "../includes/database.php";
session_start();
if(isset($_SESSION['patient'])){
    $user = $_SESSION['patient'];
}else{
    header('Location:../login.php?msg=Session has ended ! Please re-login');
}
if(isset($_POST['step1'])){
    $step1 = $_POST['type'];
    header('Location:?type='.$step1);
} 
//get nama and type from step 1 and 2
if(isset($_POST['name'])){
    $type = $_GET['type'];
    $name = $_POST['value'];
    header('Location:?review='.$type.'&name='.$name);
}
?>
<?php
//submit review in database

if(isset($_POST['submitreview'])){
    $mname=$pname='';
    $user_name = $user;
    $review = mysqli_real_escape_string($conn,$_POST['review']);
    $review_type = $_GET['review'];
    if($review_type == 'medicine'){
        $mname = $_GET['name'];
    }elseif($review_type == 'practitioners'){
        $pname = $_GET['name'];
    };
    $sql = "INSERT INTO `reviews`(username,review_type,medicine_name,practitioner_name,review_description)
    VALUES('$user_name','$review_type','$mname','$pname','$review')";
    $query = mysqli_query($conn,$sql);
    if($query){
        echo '<script>
        alert("Review Submitted successfully. Feel free to submit another review.");
        window.location.href="reviews.php";
        </script>';
    }else{
        echo '<script>
        alert("Failed to submit review!");
        window.location.href="reviews.php";
        </script>';
    }
} 
?>
<?php 
    $sql = "SELECT * FROM `patients` WHERE `username`= '$user'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    if($row){
        $fname = $row['fname'];
        $lname = $row['lname'];
        $image = $row['profile'];
        $phone = $row['phone'];
        $email = $row['email'];
        $username = $row['username'];
        $address = $row['address'] ;      
        $joined = $row['joined_on'];

    }
?>
<!doctype html>
<html lang="en">

<head>
    <title>Reviews</title>
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


    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="sidebar.css">

</head>

<body>
    <?php include '../includes/pat_header.php';?>
    <div class="container-fluid ">
        <div class="row pt-4 ">
            <?php include '../includes/patnavbar.php';?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="bi bi-lock"></i>Reviews</h1>
                </div>
                <div class="container-fluid">
                    <div class="container">
                        <!--step 1 card-->
                        <?php  
                        if(isset($_GET['step1'])){
                            ?>
                        <div class="card m-2 p-3">
                            <div class="card-body ">
                                <div class="form-group col-8 m-auto  text-center">
                                    <div class="container m-auto">
                                        <h4 for="Step" class="text-secondary">Step 1</h4>
                                    </div>
                                    <label for="question">What Do you want to review On?</label>
                                    <form action="" method="post">
                                        <select class="form-control form-select text-center m-2" name="type">
                                            <option value="medicine">Medicine</option>
                                            <option value="practitioners">Practitioners</option>
                                            <option value="Other Reviews">Other review</option>
                                        </select>
                                        <div class="text-center">
                                            <button type="submit" name="step1"
                                                class="btn btn-primary m-3 ">NEXT</button>
                                        </div>
                                    </form>
                                    <small><a href="reviews.php">Back</a></small>
                                </div>
                            </div>
                        </div>
                        <!--step 2 card-->
                        <?php
                        }elseif(isset ($_GET['type'])){
                            $type = $_GET['type'];
                            if($type == 'Other Reviews'){
                                echo '<script>
                                window.location.href="?review=Other Reviews&name=";
                                </script>';
                            }
                            ?>
                        <div class="card m-2 p-3">
                            <div class="card-body ">
                                <div class="form-group col-8 m-auto text-center">
                                    <div class="container m-auto">
                                        <h4 for="Step" class="text-secondary">Step 2</h4>
                                    </div>
                                    <label for="question">Choose among the <?php echo $_GET['type'];'s'?> below to
                                        review.</label>
                                    <form action="" method="post">
                                        <select class="form-control form-select text-center m-2" name="value">
                                            <?php 
                                            if($type == 'practitioners'){
                                                $sql = "SELECT * FROM `practitioner`";
                                                $query = mysqli_query($conn,$sql);
                                            while($row = mysqli_fetch_assoc($query)){
                                                ?>
                                            <option value="<?php echo $row['username'] ;?>"><?php 
                                                echo $row['fname'].' '.$row['lname'];
                                            }
                                            ?>
                                            </option>
                                            <?php
                                            }elseif($type == 'medicine'){
                                                $sql = "SELECT * FROM `medicine`";
                                                $query = mysqli_query($conn,$sql);
                                                while($row = mysqli_fetch_assoc($query)){
                                                ?>
                                            <option value="<?php echo $row['mname'] ;?>"><?php 
                                                echo $row['mname'].'&nbsp;'.'-&nbsp;';echo '&nbsp;Dr.'.$row['added_by'];
                                            }
                                            ?>
                                            </option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                        <div class="text-center">
                                            <button type="submit" name="name" class="btn btn-primary m-3 ">NEXT</button>
                                        </div>
                                    </form>
                                    <small><a href="reviews.php?step1">Back</a></small>
                                </div>
                            </div>
                        </div>
                        <!-- step 3 card finish review -->
                        <?php
                        }elseif(isset($_GET['review'])){ ?>
                        <div class="card m-2 p-3">
                            <div class="card-body ">
                                <div class="form-group m-auto text-center">
                                    <div class="container m-auto">
                                        <h4 for="Step" class="text-secondary">Submit Review</h4>
                                    </div>
                                    <p>You are reviewing
                                        <?php echo $_GET['review']; echo '<b>&nbsp;-></b>&nbsp;'.$_GET['name']; ?></p>
                                    <form action="" method="post">
                                        <textarea name="review"  cols="70" rows="2"
                                            placeholder="Please write your comment or reviews here."></textarea>
                                        <div class="text-center">
                                            <button type="submit" name="submitreview"
                                                class="btn btn-primary m-3 ">Submit</button>
                                        </div>
                                        <small><a href="reviews.php?step1">Back</a></small>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <?php
                        }
                        else{
                            echo '<div class="card m-2 p-3">
                            <div class="card-body ">
                                <div class="form-group col-8 m-auto  text-center">
                                    <div class="container m-auto">
                                        <h4 for="Step" class="text-secondary">Public Notice!</h4>
                                    <p>Dear Patient, The Reviews section has been setup, for you to provide us with insigts and suggestions based on our system users or services. 
                                    Please provide us actionable and valid response reviews only </p>
                                    </div>        
                                        <div class="text-center">
                                            <a href="?step1" class="btn btn-primary m-3 btn-small ">I accept</a>
                                        </div>
                                </div>
                            </div>
                        </div>';
                        }
                        ?>
                    </div>
                </div>

            </main>

        </div>
    </div>


    <script src="../js/bootstrap.bundle.js"></script>
    <script src="dashboard.js"></script>
</body>

</html>