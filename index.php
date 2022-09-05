<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome To Herbals</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/istyles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="container">
            <div class="container-box col-10 m-auto mt-5">
                <form class="form-control">
                    <div class="content p-3 m-1 mb-5 text-light bg-success">
                        <marquee behavior="" direction=""><b>WELCOME TO THE INTEGRATED SYSTEM FOR LINKING PATIENTS WITH
                                TRADITIONAL MEDICINE PROVIDERS</b></marquee>
                    </div>
                    <div class="text-center" style="color: red;">
                        <?php 
                        if(!isset($_GET['msg'])){
                            echo '';
                        }else{
                            echo $_GET['msg'];
                        }
                         ?>
                    </div>
                    <div class="box1">
                        <img class="loginimg" src="images/sample6.jpeg" alt="">
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                            data-target="#modelId1">Register as a Patient</button>
                    </div>
                    <div class="box2">
                        <img class="loginimg" src="images/sampe3.jpeg" alt="">
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                            data-target="#modelId2">Register as a Practitioner</button>
                    </div>
                    <div class="text-center p-4">
                        <a href="login.php" class="btn btn-success">Login</a>
                    </div>
                </form>

            </div>
            <!--Start of  Patients Modal -->
            <div class="modal fade" id="modelId1" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-1">
                            <h5 class="modal-title p-1">Patients Signup</h5>
                        </div>
                        <div class="modal-body p-2 mb-0">
                        <p class="text-center text-primary">Fill in your Credentials</p>
                            <!-- capturing form data -->
                            <form action="patval.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="firstname" id=""
                                        placeholder="Enter Firstname" required>
                                    <input type="text" class="form-control" name="lastname" id=""
                                        placeholder="Enter Lastname" required>
                                    <input type="text" class="form-control" name="username" id=""
                                        placeholder="Enter Username" required>
                                    <input type="email" class="form-control" name="email" id=""
                                        placeholder="Enter valid email address" required>
                                    <input type="text" class="form-control" name="address" id=""
                                        placeholder="Enter an Address ie. Dodoma ,Tanzania" required>
                                    <input type="password" class="form-control" name="pass" id=""
                                        placeholder="Enter Password" required>
                                    <input type="password" class="form-control" name="pass2" id=""
                                        placeholder="Repeat Password" required>
                                    <input type="text" class="form-control" name="phone" id=""
                                        placeholder="Enter Phone Number ie. 0769642828" required>
                                    <div class="form-group">
                                        <input type="file" class="form-control-file" name="profile" id="" placeholder=""
                                            aria-describedby="fileHelpId" required>
                                        <small id="fileHelpId" class="form-text text-muted">Choose a Profile
                                            Image</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="register" class="btn btn-success">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of patients model -->
            <!-- start of practitioners model -->
            <div class="modal fade" id="modelId2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title p-1">Practitioners Signup</h5>
                        </div>
                        <div class="modal-body">
                            <!--Getting form data -->
                            <form action="practval.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <p class="text-center text-upper text-primary">Fill in your Credentials</p>
                                    <input type="text" class="form-control" name="firstname" id=""
                                        placeholder="Enter Firstname" required>
                                    <input type="text" class="form-control" name="lastname" id=""
                                        placeholder="Enter Lastname" required>
                                    <input type="text" class="form-control" name="username" id=""
                                        placeholder="Enter Username" required>
                                    <input type="email" class="form-control" name="email" id=""
                                        placeholder="Enter Email" required>
                                    <input type="password" class="form-control" name="pass" id=""
                                        placeholder="Enter Password" required>
                                    <input type="password" class="form-control" name="pass2" id=""
                                        placeholder="Repeat Password" required>
                                    <div class="form-group">
                                        <label for=""></label>
                                        <input type="file" class="form-control-file" name="profile" id="" placeholder=""
                                            aria-describedby="fileHelpId" required>
                                        <small id="fileHelpId" class="form-text text-muted">Choose a Profile
                                            Image</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="register" class="btn btn-success">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <!--end practitioner model --->
        </div>
    </div>
    <div class="footer bg-light text-center fixed-bottom">
        <p>Herbals Trademark. 2022 .All rights Reserved</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>