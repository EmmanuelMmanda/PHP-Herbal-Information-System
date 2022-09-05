<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light pt-5  sidebar collapse position-fixed">
                <div class="z-index-n1 bg-light sticky pt-2">
                    <ul class="list-unstyled ps-0">
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed"
                                data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                                Dashboard
                            </button>
                            <div class="collapse" id="home-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="index.php" class="link-dark rounded">Overview</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed"
                                data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="true">
                                Practitioners
                            </button>
                            <div class="collapse " id="dashboard-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="practitioners.php" class="link-dark rounded">Other Practitioners</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed"
                                data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="true">
                                Medicine
                            </button>
                            <div class="collapse" id="orders-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="mymedicines.php" class="link-dark rounded">My Medicines</a></li> 
                                <li><a href="addmedicine.php" class="link-dark rounded">Add Medicines</a></li>                 
                                </ul>
                            </div>
                        </li>
                        <li class="border-top my-3"></li>
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed"
                                data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="true">
                                Account
                            </button>
                            <div class="collapse show" id="account-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="profile.php" class="link-dark rounded">Profile</a></li>
                                    <li><a href="passwords.php" class="link-dark rounded">Passwords</a></li>
                                    <li><a href="../includes/logout.php" class="link-dark rounded">Sign out</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>