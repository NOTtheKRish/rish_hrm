<ul class="navbar-nav ml-auto">
    <div class="topbar-divider d-none d-sm-block"></div>
    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#"  role="button"
            data-toggle="dropdown">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                <strong>
                    <?php echo $_SESSION['name']?>
                </strong>
            </span>
            <img class="img-profile rounded-circle"
                src="img/undraw_profile.svg">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
            <a class="dropdown-item" href="profile.php"><i class="fas fa-user-circle mr-2"></i>Profile</a>
            <?php
                if($_SESSION['id'] != 2){
                // settings not allowed for staffs
            ?>
                    <a class="dropdown-item" href="settings.php"><i class="fas fa-cog mr-2"></i>Settings</a>
            <?php
                }
            ?>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt mr-2"></i>
                Logout
            </a>
        </div>
    </li>
</ul>
