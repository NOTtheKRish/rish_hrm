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
                    <div class="d-sm-flex justify-content-center mb-4">
                        <h3 class="text-primary"><i class="fas fa-wallet mr-3"></i></h3>
                        <h1 class="h3 mb-2 text-gray-800">Expenses</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Preview Expenses Details</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="expenses-all.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <?php
                                $edit_data=$_GET['id'];
                                $sql= 'SELECT * FROM expenses WHERE id='.$edit_data.'';
                                $result = mysqli_query($conn, $sql);
                                    while($row= mysqli_fetch_array($result)){
                                        $date=date_create($row['date']);
                                        // Changing Date Format to display as 19 Dec 2003
                                        $expense_date=date_format($date,"d m Y");
                            ?>
                            <!-- Video Details Start -->
                                    <div class="form-group row">
                                        <label for="spend_for" class="col-sm-2 col-form-label">Spend For</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="spend_for" value="'.$row['spend_for'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="name" value="'.$row['name'].'"></td>';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                                <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="description" value="'.$row['description'].'"></td>';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="gst_no" class="col-sm-2 col-form-label">GST No</label>
                                        <div class="col-sm-10">
                                                <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="gst_no" value="'.$row['gst_no'].'"></td>';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="taxable_amt" class="col-sm-2 col-form-label">Taxable Amount</label>
                                        <div class="col-sm-10">
                                            <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="taxable_amt" value="'.$row['taxable_amt'].'"></td>';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cgst" class="col-sm-2 col-form-label">CGST</label>
                                        <div class="col-sm-10">
                                                <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="cgst" value="'.$row['cgst'].'"></td>';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sgst" class="col-sm-2 col-form-label">SGST</label>
                                        <div class="col-sm-10">
                                                <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="sgst" value="'.$row['sgst'].'"></td>';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="total_paid" class="col-sm-2 col-form-label">Total Paid Amount</label>
                                        <div class="col-sm-10">
                                                <?php echo '<input style="color:#000;" type="number" readonly class="form-control-plaintext" name="total_paid" value="'.$row['total_paid'].'"></td>';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="image" class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-10">
                                            <p>
                                                <?php
                                                    if($row['image']!=""){
                                                ?>
                                              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseImg" aria-expanded="false" aria-controls="collapseImg">
                                                View Image
                                              </button>
                                              <?php
                                                  }else{
                                                      echo 'Image Unavailable';
                                                  }
                                              ?>
                                            </p>
                                            <div class="collapse my-auto" id="collapseImg">
                                              <div class="card card-body">
                                                <?php echo'<iframe src="./uploads/expenses/'.$row['image'].'" width="970px" height="600px"></iframe>';?>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <?php echo'<a class="btn btn-primary" href="expenses-edit.php?id='.$row['id'].'"><i class="fas fa-pen mr-2"></i>Edit Expense</a>';?>
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
