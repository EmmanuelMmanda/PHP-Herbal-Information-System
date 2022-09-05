<header class="navbar fixed-top bg-info flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 py-2 bg-light text-info shadow rounded" href="#">
            <h5 style="height: 38px;margin: 0;">HERBAL SYSTEM</h5>
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="bi bi-list"></span>
        </button>
        <div class="p-2 text-center d-none d-md-block text-success rounded bg-light">
            <marquee behavior="" direction="">
            <h5>INTEGRATED SYSTEM FOR LINKING PATIENTS WITH TRADITIONAL MEDICINE PROVIDERS.</h5>
            </marquee>
        </div>
        <!--fetch user image fro database -->
        <?php
            include 'database.php';
            $user = $_SESSION['patient'];
            $img_sql = "SELECT `profile` FROM `patients` WHERE `username`='$user'";
            $img_query = mysqli_query($conn,$img_sql);
            $img_data = mysqli_fetch_assoc($img_query);
            $img = $img_data['profile'];
            if($img == ''){
                $img = '../upload/user.png';
            }
        ?>
        <div class="col-2 d-flex d-none d-sm-block bg-light text-info shadow rounded" style="padding: 1px;">
            <h5> &nbsp;<img src="../upload/<?php echo $img;?>"
               height="44px" width="44px" class="rounded-circle" alt="">&nbsp;&nbsp;Hi.
                <?php echo strtoupper($user);?>
            </h5>
        </div>
    </header>