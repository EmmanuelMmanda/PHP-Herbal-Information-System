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
        border-radius: 20px;
        color: #000;
        border-color: blue;
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
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4 ">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="bi bi-hospital"></i> Disease - Medicine Form </h1>
                </div>

                <div class="container ">
                    <!--add medicine -disease form modal-->
                    <div class="text-center p-1 mb-1 ">
                        <form action="" method="GET" class="rounded" >
                           <label for="">Search: </label> <input type="search" name="search" placeholder="search here."
                                class=" text-secondary mb-0 p-0">
                        </form>
                    </div>

                    <!--Table for display disease-->
                    <div class="" style="overflow: scroll;position: relative;height: 68vh;">
                        <table class="table table-striped table-bordered rounded" border="1">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th>Disease Name</th>
                                    <th>Symptoms</th>
                                    <th>Medicine Used</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(isset($_GET['search'])){
                                    $keyword = $_GET['search'];
                                    $sql = "SELECT * FROM `disease` WHERE  ((`dname` LIKE '%".$keyword."%') OR (`mname` LIKE '%".$keyword."%') OR (`symptoms` LIKE '%".$keyword."%'))";
                                }else{
                                    $sql = "SELECT * FROM `disease`";
                                }
                                $query = mysqli_query($conn,$sql);
                                $rows = mysqli_num_rows($query);
                                if($rows>0){                                   
                                    $num = 1;
                                    while($data = mysqli_fetch_assoc($query)){
                                        $id = $data['id'];
                                        ?>
                                <tr>
                                    <td scope="row"><?php echo $num++ ; ?></td>
                                    <td><?php echo $data['dname'] ?></td>
                                    <td><?php echo $data['symptoms'] ?></td>
                                    <td><?php echo $data['mname'] ?></td>
                                </tr>
                                <?php }
                                }else{
                                    echo '<h6 class="text-center text-danger">';
                                    echo '<b>No Disease-Medicine record Found !!</b>';
                                    echo '</h6>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--delete error and message section-->
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
                    <h6 class="text-center text-danger">
                        <?php
                            if(!isset($error)){
                                echo '';
                            }else{
                                echo  $error;
                            }
                            ?>
                    </h6>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.href.indexOf('#update_id') != -1) {
            $('#update_id').modal('show');
        }
    });
    </script>

</body>

</html>