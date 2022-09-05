<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light pt-5  sidebar collapse position-fixed">
    <div class="z-index-n1 bg-light sticky pt-2">
        <ul class="list-unstyled ps-0">
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                    data-bs-target="#home-collapse" aria-expanded="true">
                    Dashboard
                </button>
                <div class="collapse" id="home-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="admin.php" class="link-dark rounded">Overview</a></li>
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                    data-bs-target="#dashboard-collapse" aria-expanded="true">
                    Practitioners
                </button>
                <div class="collapse " id="dashboard-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="practitioners.php" class="link-dark rounded">All Practitioners</a></li>
                        <li><a href="verifypractitioners.php" class="link-dark rounded">Verify Practitioners</a></li>
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                    data-bs-target="#orders-collapse" aria-expanded="true">
                    Medicine
                </button>
                <div class="collapse" id="orders-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="medicines.php" class="link-dark rounded">All Mediciness</a></li>
                        <li><a href="medicines.php?disaproved" class="link-dark rounded">Disaproved Medicines</a></li>
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                    data-bs-target="#user-collapse" aria-expanded="true">
                    Reviews
                </button>
                <div class="collapse" id="user-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="reviews.php" class="link-dark rounded">User Reviews</a></li>
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                    data-bs-target="#account-collapse" aria-expanded="true">
                    Account
                </button>
                <div class="collapse show" id="account-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="../includes/logout.php" class="link-dark rounded">Sign out</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>