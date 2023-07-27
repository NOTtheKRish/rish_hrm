<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <?php
                        include_once('includes/dbconfig.php');
                        $sql = "SELECT name,logo FROM settings WHERE entry_by = 1";
                        $result = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_array($result)){
                            echo'<img src="img/'.$row['logo'].'" style="height:55px">';
                    ?>
                </div>
                <?php echo'<div class="sidebar-brand-text mx-3">'.$row['name'].'</div>';?>
            </a>
            <?php }?>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span><strong>Dashboard</strong></span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Call List Accordion-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCallList"
                    aria-expanded="true" aria-controls="collapseCallList">
                    <i class="fas fa-phone-alt"></i>
                    <span><strong>Call List</strong></span>
                </a>
                <div id="collapseCallList" class="collapse" aria-labelledby="headingCallList" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="call-list.php"><strong>All Calls</strong></a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Candidate Accordion -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCandidate"
                    aria-expanded="true" aria-controls="collapseCandidate">
                    <i class="fas fa-user"></i>
                    <span><strong>Candidate</strong></span>
                </a>
                <div id="collapseCandidate" class="collapse" aria-labelledby="headingCandidate" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="candidates.php"><strong>All Candidates</strong></a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompany"
                aria-expanded="true" aria-controls="collapseCompany">
                    <i class="fas fa-industry"></i>
                    <span><strong>Company</strong></span>
                </a>
                <div id="collapseCompany" class="collapse" aria-labelledby="headingCompany" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="company.php"><strong>All Companies</strong></a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Jobs Accordion -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseJobs"
                    aria-expanded="true" aria-controls="collapseJobs">
                    <i class="fas fa-briefcase"></i>
                    <span><strong>Jobs</strong></span>
                </a>
                <div id="collapseJobs" class="collapse" aria-labelledby="headingJobs" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="vacancy.php"><strong>Vacancy</strong></a>
                        <a class="collapse-item" href="interview-sent.php"><strong>Interview Sent</strong></a>
                        <a class="collapse-item" href="joined-list.php"><strong>Joined List</strong></a>
                    </div>
                </div>
            </li>
            <?php
                if($_SESSION['id'] != 2){
            ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings"
                    aria-expanded="true" aria-controls="collapseSettings">
                    <i class="fas fa-cog"></i>
                    <span><strong>Settings</strong></span>
                </a>
                <div id="collapseSettings" class="collapse" aria-labelledby="headingSettings" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="settings.php"><strong>General Settings</strong></a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Users Accordion -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
                    aria-expanded="true" aria-controls="collapseUsers">
                    <i class="fas fa-user"></i>
                    <span><strong>Users</strong></span>
                </a>
                <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="users.php"><strong>Manage Users</strong></a>
                    </div>
                </div>
            </li>
            <?php
                }
            ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
<!-- End of Sidebar -->

<!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
<!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Logout</strong></h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure to end your current session?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>