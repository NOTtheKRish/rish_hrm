<?php
include('session.php');
include('includes/header.php');
include('includes/navbar.php');
include_once("includes/dbconfig.php");
include("includes/interestDrops.php");
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-2 text-gray-800">Company Details</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Create New Company</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="company.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <!-- Video Details Start -->
                            <form action="company.php" method="POST">
                                <div class="form-row">
                                    <?php echo'<input type="hidden" name="previous" value="'.$_SERVER['HTTP_REFERER'].'">'?>
                                    <div class="form-group col-md-3">Company Name
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="com_name">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Contact Person
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="contact_person">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Contact Number
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="number">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Additional Number
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="add_number">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md-3">E-Mail
                                        <div class="form-input">
                                            <input class="form-control" type="email" name="com_email">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">GST Number
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="gst_no" placeholder="Enter N/A if unavailable">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Industry Type
                                        <div class="form-input">
                                            <select class="form-control" name="industry_type">
                                                <?php industryType($conn,$_SESSION['userRel']); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md-6">Address
                                        <div class="form-input">
                                            <textarea class="form-control" id="tinymce" name="address" cols="30" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group">
                                        <button class="btn btn-primary" name="create" type="submit">
                                            <i class="fas fa-plus mr-2"></i>Create
                                        </button>
                                    </div>
                                </div>
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
