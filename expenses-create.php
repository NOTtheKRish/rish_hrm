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
                            <h5 class="m-0 font-weight-bold text-primary">Create New Expense</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="expenses-all.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body" style="color:#000;">
                            <!-- Video Details Start -->
                            <form action="expenses-all.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <?php echo'<input type="hidden" name="previous" value="'.$_SERVER['HTTP_REFERER'].'">'?>
                                        <label for="can_id" class="col-sm-4 col-form-label">Spend For</label>
                                        <div class="col-sm-2">
                                            <select name="spend_for" class="form-control">
                                                <option value="">Select Option</option>
                                                <?php
                                                    $spend="SELECT * FROM expenses_spendfor";
                                                    $res=mysqli_query($conn,$spend);
                                                    if(mysqli_num_rows($res)>0){
                                                        while($row=mysqli_fetch_array($res)){
                                                ?>
                                                <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                            <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="date" class="col-sm-4 col-form-label">Date</label>
                                        <div class="col-sm-3">
                                            <input type="date" class="form-control" name="date" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label">Name</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-4 col-form-label">Description</label>
                                        <div class="col-sm-4">
                                            <textarea class="form-control" name="description" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="gst_no" class="col-sm-4 col-form-label">GST Number</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="gst_no">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="taxable_amt" class="col-sm-4 col-form-label">Taxable Amount</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="taxable_amt" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cgst" class="col-sm-4 col-form-label">CGST</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="cgst">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sgst" class="col-sm-4 col-form-label">SGST</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="sgst">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="total_paid" class="col-sm-4 col-form-label">Total Paid Amount</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="total_paid" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="image" class="col-sm-4 col-form-label">Image</label>
                                        <div class="col-sm-3 mt-2">
                                            <input class="form-file-input" type="file" name="image">
                                        </div>
                                    </div>
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
