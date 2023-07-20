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

                    <!-- Page Heading -->
                    <div class="d-sm-flex justify-content-center mb-4">
                        <h3 class="text-primary"><i class="fas fa-wallet mr-3"></i></h3>
                        <h1 class="h3 mb-2 text-gray-800">Expenses</h1>
                    </div>
                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Delete Details</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="expenses-all.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <!-- Delete Video Start -->
                            <?php echo'<form action="expenses-all.php" method="POST">';?>
                                <div class="form-row d-sm-flex">
                                    <div class="form-group">Are you sure to delete this Expense??</div>
                                    <?php echo'<input type="hidden" name="expense_id" value="'.$_GET['id'].'">'?>
                                    <?php echo'<input type="hidden" name="previous" value="'.$_SERVER['HTTP_REFERER'].'">'?>
                                </div>
                            <!-- Delete Video End -->
                                <button class="btn btn-primary" name="delete" type="submit"><i class="fas fa-trash mr-2"></i><strong>Delete</strong></button>
                            </form>
                        </div>
                    </div><!-- Main Card End -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

<?php
    include('includes/scripts.php');
    include('includes/footer.php');

?>
