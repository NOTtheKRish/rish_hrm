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
                        <h1 class="h3 mb-2 text-gray-800">Payments - Company</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Edit Company Payment Details</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="payments-company.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <?php
                                $view_data=$_GET['id'];
                                $sql= 'SELECT * FROM com_payment WHERE id='.$view_data.'';
                                $result = mysqli_query($conn, $sql);
                                    while($row= mysqli_fetch_array($result)){
                                            $inv_id=$row['inv_id'];
                                            $com_id=$row['com_id'];
                                            $payMethod=$row['payMethod'];
                                            $payAmt=$row['payAmt'];
                                            $payDate=$row['pay_date'];
                            ?>
                            <!-- Video Details Start -->
                            <form action="payments-company.php" method="POST">
                                    <div class="form-group row">
                                        <label for="inv_id" class="col-sm-2 col-form-label">Invoice ID</label>
                                        <div class="col-sm-3">
                                            <?php echo'<input type="hidden" name="previous" value="'.$_SERVER['HTTP_REFERER'].'">'?>
                                            <?php echo'<input style="color:#000;" type="text" class="form-control-plaintext" hidden readonly name="payId" value="'.$view_data.'">';?>
                                            <?php echo'<input style="color:#000;" type="text" class="form-control-plaintext" readonly name="invId" value="'.$inv_id.'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="com_id" class="col-sm-2 col-form-label">Company ID</label>
                                        <div class="col-sm-3">
                                            <?php echo'<input style="color:#000;" type="text" class="form-control-plaintext" readonly name="com_id" value="E-'.$com_id.'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inv_date" class="col-sm-2 col-form-label">Payment Date</label>
                                        <div class="col-sm-3">
                                            <?php echo'<input style="color:#000;" type="date" class="form-control" name="payDate" value="'.$payDate.'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="amt_pay" class="col-sm-2 col-form-label">Payment Amount</label>
                                        <div class="col-sm-3">
                                            <?php echo '<input style="color:#000;" type="text" class="form-control" name="payAmt" value="'.$payAmt.'"></td>';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="amt_balance" class="col-sm-2 col-form-label">Payment Method</label>
                                        <div class="col-sm-3">
                                            <select class="form-control" name="payMethod">
                                                <?php echo'<option value="'.$payMethod.'">'.$payMethod.'</option>';?>
                                                <?php
                                                    $sq="SELECT method FROM paymethod";
                                                    $res=mysqli_query($conn,$sq);
                                                    while($ro=mysqli_fetch_array($res)){
                                                        if($ro['method']!=$payMethod){
                                                            echo'<option value="'.$ro['method'].'">'.$ro['method'].'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <?php echo '<input style="color:#000;" type="text" hidden class="form-control" name="oldPaid" value="'.$payAmt.'"></td>';?>
                                    </div><br>
                                <div class="form-row">
                                    <div class="form-group">
                                        <button class="btn btn-primary" name="edit" type="submit"><i class="fas fa-pen mr-2"></i>Update</button>
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
