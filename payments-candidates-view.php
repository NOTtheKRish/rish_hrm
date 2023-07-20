<?php
include('session.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/packageCheck.php');
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
                        <h1 class="h3 mb-2 text-gray-800">Payments - Candidates</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Preview Candidate Payment Details</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="payments-candidates.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>                        
                        <div class="card-body">
                            <?php
                                $view_data=$_GET['id'];
                                $sql= 'SELECT * FROM can_payment WHERE id='.$view_data.'';
                                $result = mysqli_query($conn, $sql); 
                                    while($row=mysqli_fetch_array($result)){
                                        $inv_id=$row['inv_id'];
                                        $can_id=$row['can_id'];
                                        $pay_date=date_create($row['pay_date']);
                                        $payDate=date_format($pay_date,'d M Y');
                                        $payAmt=$row['payAmt'];
                                        $payMethod=$row['payMethod'];
                            ?> 
                                    <div class="form-group row">
                                        <label for="inv_id" class="col-sm-2 col-form-label">Invoice ID</label>
                                        <div class="col-sm-3">
                                            <?php echo'<input style="color:#000;" type="text" class="form-control-plaintext" readonly name="invId" value="'.$inv_id.'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="can_id" class="col-sm-2 col-form-label">Candidate ID</label>
                                        <div class="col-sm-3">
                                            <?php echo'<input style="color:#000;" type="text" class="form-control-plaintext" readonly name="can_id" value="C-'.$can_id.'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inv_date" class="col-sm-2 col-form-label">Payment Date</label>
                                        <div class="col-sm-3">
                                            <?php echo'<input style="color:#000;" type="text" class="form-control-plaintext" readonly name="payDate" value="'.$payDate.'">';?>
                                        </div>
                                    </div>                                   
                                    <div class="form-group row">
                                        <label for="amt_pay" class="col-sm-2 col-form-label">Payment Amount</label>
                                        <div class="col-sm-3">
                                            <?php echo '<input style="color:#000;" type="text" class="form-control-plaintext" readonly name="payAmt" value="'.$payAmt.'"></td>';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="amt_balance" class="col-sm-2 col-form-label">Payment Method</label>
                                        <div class="col-sm-3">
                                            <?php echo '<input style="color:#000;" type="text" class="form-control-plaintext" readonly name="payMethod" value="'.$payMethod.'"></td>';?>
                                        </div>
                                    </div><br>
                                <div class="form-row">
                                    <div class="form-group">
                                        <?php echo'<a class="btn btn-primary" target="_blank" href="invoice-candidates-view.php?id='.$inv_id.'"><i class="fas fa-eye mr-2"></i>View Invoice</a>';?>
                                        <?php echo'<a class="btn btn-primary" target="_blank" href="invoice-candidates-view.php?id='.$inv_id.'&print=true"><i class="fas fa-print mr-2"></i>Print</a>';?>
                                        <?php echo'<a class="btn btn-primary" href="payments-candidates-edit.php?id='.$row['id'].'"><i class="fas fa-pen mr-2"></i>Edit Payment</a>';?>
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