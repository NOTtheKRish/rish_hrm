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
                        <h1 class="h3 mb-2 text-gray-800">Vendors</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Preview Vendor Details</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="vendors.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <?php
                                $view_data=$_GET['id'];
                                $sql= 'SELECT * FROM vendors WHERE id='.$view_data.'';
                                $result = mysqli_query($conn, $sql);
                                    while($row= mysqli_fetch_array($result)){
                            ?>
                            <!-- Video Details Start -->
                                    <div class="form-group row">
                                        <label for="store_id" class="col-sm-2 col-form-label">Vendor ID</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="vendor_id" value="V-'.$row['id'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="vendor_name" class="col-sm-2 col-form-label">Vendor Name</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="vendor_name" value="'.$row['name'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="store_name" class="col-sm-2 col-form-label">Store Name</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="store_name" value="'.$row['store_name'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="number" class="col-sm-2 col-form-label">Contact Number</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="number" value="'.$row['number'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="landline" class="col-sm-2 col-form-label">Landline Number</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="landline" value="'.$row['landline'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="landline" class="col-sm-2 col-form-label">Vehicle Name & Colour</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="landline" value="'.$row['vehicle_details'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="landline" class="col-sm-2 col-form-label">Vehicle Registration Number</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="landline" value="'.$row['vehicle_reg'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sell_interest" class="col-sm-2 col-form-label">Interested to SELL</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="sell_interest" value="'.$row['sell_interest'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">E-Mail</label>
                                        <div class="col-sm-10">
                                        <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="email" value="'.$row['email'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="gst_no" class="col-sm-2 col-form-label">GST Number</label>
                                        <div class="col-sm-10">
                                        <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="gst_no" value="'.$row['gst_no'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <?php echo $row['address']; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="details" class="col-sm-2 col-form-label">Details</label>
                                        <div class="col-sm-10">
                                            <?php echo $row['details']; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="vendor_status" class="col-sm-2 col-form-label">Status</label>
                                        <div class="col-sm-10">
                                            <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="vendor_status" value="'.$row['status'].'"></td>';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="document" class="col-sm-2 col-form-label">Document</label>
                                        <div class="col-sm-10">
                                            <p>
                                                <?php
                                                    if($row['document']!=""){
                                                ?>
                                              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseDocument1" aria-expanded="false" aria-controls="collapseDocument">
                                                View Document 1
                                              </button>
                                              <?php
                                                  }if($row['document2']!=""){
                                                ?>
                                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseDocument2" aria-expanded="false" aria-controls="collapseDocument">
                                                    View Document 2
                                                </button>
                                                <?php
                                                    }if($row['document3']!=""){
                                                ?>
                                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseDocument3" aria-expanded="false" aria-controls="collapseDocument">
                                                    View Document 3
                                                </button>
                                                <?php
                                                    }if($row['document4']!=""){
                                                ?>
                                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseDocument4" aria-expanded="false" aria-controls="collapseDocument">
                                                    View Document 4
                                                </button>
                                                <?php
                                            }if($row['document']=="" && $row['document2']=="" && $row['document3']=="" && $row['document4']==""){
                                                      echo 'Documents Unavailable';
                                                  }
                                              ?>
                                            </p>
                                            <div class="collapse my-auto" id="collapseDocument1">
                                              <div class="card card-body">
                                                <?php echo'<iframe src="./uploads/vendor/'.$row['document'].'" width="970px" height="600px"></iframe>';?>
                                              </div>
                                            </div>
                                            <div class="collapse my-auto" id="collapseDocument2">
                                              <div class="card card-body">
                                                <?php echo'<iframe src="./uploads/vendor/'.$row['document2'].'" width="970px" height="600px"></iframe>';?>
                                              </div>
                                            </div>
                                            <div class="collapse my-auto" id="collapseDocument3">
                                              <div class="card card-body">
                                                <?php echo'<iframe src="./uploads/vendor/'.$row['document3'].'" width="970px" height="600px"></iframe>';?>
                                              </div>
                                            </div>
                                            <div class="collapse my-auto" id="collapseDocument4">
                                              <div class="card card-body">
                                                <?php echo'<iframe src="./uploads/vendor/'.$row['document4'].'" width="970px" height="600px"></iframe>';?>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                    <?php
                                            if($_SESSION['id']=="1"){
                                                $entry=$row['user_id'];
                                                if($entry==NULL){
                                                    echo '';
                                                }else{
                                                $sq="SELECT name FROM accounts WHERE id='".$entry."'";
                                                    $res=mysqli_query($conn,$sq);
                                                    if(mysqli_num_rows($res)>0){
                                                        while($rows=mysqli_fetch_array($res)){
                                                        echo'<label for="entry_by" class="col-sm-2 col-form-label">Entry By</label>
                                                            <div class="col-sm-10">
                                                            <input style="color:#000;" type="text" readonly class="form-control-plaintext" name="entry_by" value="'.$rows['name'].'">
                                                            </div>';
                                                            }
                                                    }
                                                }
                                            }else{
                                                echo '';
                                            }
                                        ?>

                                    </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <?php echo'<a class="btn btn-primary" href="vendors-edit.php?id='.$row['id'].'"><i class="fas fa-edit mr-2"></i>Edit Details</a>';?>
                                    </div>
                                </div>
                                <?php }?>
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
