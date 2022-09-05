<?php session_start();?>
<?php  require('includes/database.php');?>

<?php 
if(isset($_POST['login'])){
        $uname = mysqli_real_escape_string($conn,$_POST['username']);
        $pass = mysqli_real_escape_string($conn,$_POST['password']);
        $password = md5($pass);
        
        //condition for patient
        $sql = "SELECT * FROM `patients` WHERE `username`='$uname' AND `password`='$password'";
        $query = mysqli_query($conn,$sql);
        $result = mysqli_num_rows($query);
        $rows = mysqli_fetch_array($query);
        if($result == 1){
            $_SESSION['patient'] = $rows['username'];
            header('location:patients/') ;    
        }
        else{
           //condition for practitioner
           $sql = "SELECT * FROM `practitioner` WHERE `username`='$uname' AND `password`='$password'";
           $query = mysqli_query($conn,$sql);
           $result = mysqli_num_rows($query);
           $rows = mysqli_fetch_assoc($query);
           if($result == 1){
               echo 'Succesfuly Logged in';
               $_SESSION['user'] = $rows['username'];
               header('location:practitioners/') ;    
           }
           else{
                //admin conditions
                $sql = "SELECT * FROM `admin` WHERE `username`='$uname' AND `password`='$password'";
                $query = mysqli_query($conn,$sql);
                $result = mysqli_num_rows($query);
                $rows = mysqli_fetch_assoc($query);
                if($result == 1){
                    echo 'Succesfuly Logged in';
                    $_SESSION['admin'] = $rows['username']; 
                    header('location:admin/admin.php') ;    
                }
                else{
                    header('location:login.php?error=Invalid Username or password');
                }
            }
        }
        }

?>