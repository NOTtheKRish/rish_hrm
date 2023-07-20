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
                        <h1 class="h3 mb-2 text-gray-800">Vendor Details</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Create New Vendor</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="vendors.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <!-- Video Details Start -->
                            <form action="vendors.php" method="POST" enctype="multipart/form-data">
                                <div class="form-row">
                                    <?php echo'<input type="hidden" name="previous" value="'.$_SERVER['HTTP_REFERER'].'">'?>
                                    <div class="form-group col-md-3">Vendor Name<span class="text-danger">*</span>
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="vendor_name" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Store Name<span class="text-danger">*</span>
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="store_name" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Contact Number<span class="text-danger">*</span>
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="number" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Interested to SELL<span class="text-danger">*</span>
                                        <div class="form-input">
                                            <select name="sell_interest" class="form-control" data-live-search="true">
                                                <?php sellInterest($conn,$_SESSION['userRel']); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md-4">E-Mail<span class="text-danger">*</span>
                                        <div class="form-input">
                                            <input class="form-control" type="email" name="vendor_email" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">GST Number
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="gst_no" placeholder="Enter N/A if unavailable">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">Landline Number
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="landline" placeholder="Leave empty if unavailable">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md-6">Vehicle Name & Colour
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="vehicle_details" placeholder="Leave empty if unavailable">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">Vehicle Registration No
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="vehicle_reg" placeholder="Leave empty if unavailable">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md-6">Address<span class="text-danger">*</span>
                                        <div class="form-input">
                                            <textarea class="form-control" id="tinymce" name="address" cols="30" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">Details
                                        <div class="form-input">
                                            <textarea class="form-control" id="tinymce" name="details" cols="30" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md-3">Status
                                        <div class="form-input">
                                            <select class="form-control" name="status">
                                                <?php
                                                    $sql="SELECT * FROM vendor_status ORDER BY disp_order ASC";
                                                    $result=mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($result)>0){
                                                    while($row=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5">Upload Document 1
                                        <div class="form-input mt-2">
                                            <input class="form-file-input" type="file" name="document[]">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md-3">Upload Document 2
                                        <div class="form-input mt-2">
                                            <input class="form-file-input" type="file" name="document[]">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mt-2">Upload Document 3
                                        <div class="form-input mt-2">
                                            <input class="form-file-input" type="file" name="document[]">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 mt-2">Upload Document 4
                                        <div class="form-input mt-2">
                                            <input class="form-file-input" type="file" name="document[]">
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
