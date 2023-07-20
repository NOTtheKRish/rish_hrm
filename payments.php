<?php
include('session.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/packageCheck.php');
include_once('includes/dbconfig.php');
?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- The empty top bar-->
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex justify-content-center mb-4">
                        <h3 class="text-primary"><i class="fas fa-rupee-sign mr-3"></i></h3>
                        <h1 class="h3 mb-2 text-gray-800">Payments</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <h5 class="card-title text-dark"><strong>Company</strong><i class="fas fa-industry ml-3"></i></h5>
                                            <hr>
                                            <p class="text-dark">Pending Amount : <i class="fas fa-rupee-sign"></i>
                                            <?php
                                                $pending="SELECT total_pending FROM com_invoice WHERE entry_by='".$_SESSION['userRel']."' AND total_pending!='0'";
                                                $pending_amt=0;
                                                $result=mysqli_query($conn,$pending);
                                                while($rows=mysqli_fetch_array($result)){
                                                    $pending_amt+=$rows['total_pending'];
                                                }
                                            ?><?php echo $pending_amt;?></p>
                                            <a href="payments-company.php" class="btn btn-primary"><i class="fas fa-eye mr-2"></i>View</a>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <h5 class="card-title text-dark"><strong>Candidates</strong><i class="fas fa-users ml-3"></i></h5>
                                            <hr>
                                            <p class="text-dark">Pending Amount : <i class="fas fa-rupee-sign"></i>
                                            <?php
                                                $pending="SELECT total_pending FROM can_invoice WHERE entry_by='".$_SESSION['userRel']."' AND total_pending!='0'";
                                                $pending_amt=0;
                                                $result=mysqli_query($conn,$pending);
                                                while($rows=mysqli_fetch_array($result)){
                                                    $pending_amt+=$rows['total_pending'];
                                                }
                                            ?><?php echo $pending_amt;?></p>
                                            <a href="payments-candidates.php" class="btn btn-primary"><i class="fas fa-eye mr-2"></i>View</a>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <h5 class="card-title text-dark"><strong>Expenses</strong><i class="fas fa-wallet ml-3"></i></h5>
                                            <hr>
                                            <p class="text-dark">Maintain your Daily Expenses</p>
                                            <a href="expenses.php" class="btn btn-primary"><i class="fas fa-eye mr-2"></i>View</a>
                                        </div>
                                        </div>
                                    </div>
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