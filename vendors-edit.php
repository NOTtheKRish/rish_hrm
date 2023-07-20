<?php
include('session.php');
include('includes/header.php');
include('includes/navbar.php');
include_once("includes/dbconfig.php");
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
                            <h5 class="m-0 font-weight-bold text-primary">Edit Vendor Details</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="vendors.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <?php
                                $edit_data=$_GET['id'];
                                $sql= 'SELECT * FROM vendors WHERE id='.$edit_data.'';
                                $result = mysqli_query($conn, $sql);
                                    while($rows= mysqli_fetch_array($result)){
                            ?>
                            <!-- Video Details Start -->
                            <form action="vendors.php" method="POST" enctype="multipart/form-data">
                                <div class="form-row">
                                    <?php echo'<input type="hidden" name="vendor_id" value="'.$_GET['id'].'">'?>
                                    <?php echo'<input type="hidden" name="previous" value="'.$_SERVER['HTTP_REFERER'].'">'?>
                                    <div class="form-group col-md-3">Vendor Name
                                        <div class="form-input">
                                            <?php echo'<input class="form-control" type="text" name="vendor_name" value="'.$rows['name'].'">'?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Store Name
                                        <div class="form-input">
                                            <?php echo'<input class="form-control" type="text" name="store_name" value="'.$rows['store_name'].'">'?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Contact Number
                                        <div class="form-input">
                                            <?php echo'<input class="form-control" type="text" name="number" value="'.$rows['number'].'">'?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Landline Number
                                        <div class="form-input">
                                            <?php echo'<input class="form-control" type="text" name="landline" value="'.$rows['landline'].'">'?>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md-4">E-Mail
                                        <div class="form-input">
                                            <?php echo'<input class="form-control" type="email" name="vendor_email" value="'.$rows['email'].'">'?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">GST Number
                                        <div class="form-input">
                                            <?php echo'<input class="form-control" type="text" name="gst_no" value="'.$rows['gst_no'].'">'?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Interested to SELL
                                        <div class="form-input">
                                            <?php echo'<input class="form-control" type="text" name="sell_interest" value="'.$rows['sell_interest'].'">'?>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md-6">Vehicle Name & Colour
                                        <div class="form-input">
                                            <?php echo'<input class="form-control" type="text" name="vehicle_details" placeholder="Leave empty if unavailable" value="'.$rows['vehicle_details'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">Vehicle Registration No
                                        <div class="form-input">
                                            <?php echo'<input class="form-control" type="text" name="vehicle_reg" placeholder="Leave empty if unavailable" value="'.$rows['vehicle_reg'].'">';?>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md-6">Address
                                        <div class="form-input">
                                            <?php echo'<textarea class="form-control" id="tinymce" name="address" cols="30" rows="4">'.$rows['address'].'</textarea>'?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">Details
                                        <div class="form-input">
                                            <?php echo'<textarea class="form-control" id="tinymce" name="details" cols="30" rows="4">'.$rows['details'].'</textarea>'?>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md-3">Status
                                        <div class="form-input">
                                            <select class="form-control" name="status">
                                                <?php
                                                    $sql="SELECT * FROM vendor_status";
                                                    $result=mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($result)>0){
                                                    while($row=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5">Upload Document (Current Document : <?php if($rows['document']!=""){ echo $rows['document'];}else{ echo "N/A";} ?>)
                                        <div class="form-input mt-2">
                                            <input class="form-file-input" type="file" name="document">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group">
                                        <button class="btn btn-primary" name="update" type="submit">
                                            <i class="fas fa-plus mr-2"></i>Update
                                        </button>
                                    </div>
                                </div>
                                <?php }?>
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
