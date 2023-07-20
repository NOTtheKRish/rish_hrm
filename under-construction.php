<?php
include('session.php');
include('includes/header.php');
include('includes/navbar.php');
include_once('includes/dbconfig.php');
?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <?php
                        include('includes/topbar.php');
                        include('includes/topbar-menu.php');
                    ?>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- All Contents of the page starts from here-->
                    <div class="card">
                        
                        <div class="card-body">
                            <!-- Page Under Construction Content -->
                            <div class="text-center">
                                <img class="img-fluid px-3 mt-3 mb-4" src="img/undraw_under_construction.svg" style="width:25rem" alt="Under Construction">
                                <p class="lead text-gray-800 mb-3">Page Under Construction</p>
                                <p class="text-gray-800 mb-3">Looks like you've found a Glitch in the Matrix...</p>
                                <a class="btn btn-primary" href="index.php"><i class="fas fa-chevron-circle-left mr-2"></i>Back to Dashboard</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>