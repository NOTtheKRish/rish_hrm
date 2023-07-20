<?php
include('session.php');
include('includes/header.php');
include('includes/navbar.php');
include_once("includes/dbconfig.php");
include_once("includes/invoiceDrops.php");
// include_once("includes/invoiceFunctions.php");
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
                        <h1 class="h3 mb-2 text-gray-800">Invoice - Candidates</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Create New Invoice</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="invoice-candidates.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                        </div>
                        <div class="card-body">                            
                            <!-- Video Details Start -->
                            <form action="invoice-candidates.php" class="invoice-form" id="invoice-form" method="POST" role="form" novalidate="">
                                <div class="form-row">
                                    <div class="form-group col-md-3">Candidate ID
                                        <div class="form-input">
                                            <select name="can_id" class="form-control">
                                                <option value="">Select Candidate</option>
                                                <?php
                                                    $sql="SELECT * FROM candidates WHERE entry_by='".$_SESSION['userRel']."'";
                                                    $result=mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($result)>0){
                                                    while($row=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo'<option value="'.$row['id'].'">C-'.$row['can_id'].' - '.$row['name'].'</option>';?>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Invoice Date
                                        <div class="form-input">
                                            <input class="form-control" type="date" name="inv_date">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">Invoice Year
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="inv_year" value="<?php getInvoiceYear($conn); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">Invoice No
                                        <div class="form-input">
                                            <input class="form-control" type="text" name="inv_no" value="<?php getCanInvoiceId($conn); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row my-3">
                                    <div class="form-group col-md-4">Item
                                        <div class="form-input">
                                            <select id="item_1" class="form-control item">
                                                <?php getItems($conn,$_SESSION['userRel']);?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">Description
                                        <div class="form-input">
                                            <textarea class="form-control" id="description_1" cols="30" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">Quantity
                                        <div class="form-input">
                                            <input type="number" id="quantity_1" class="form-control quantity" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row my-3">
                                    <div class="form-group col-md-2">Price
                                        <div class="form-input">
                                            <input type="number" id="price_1" class="form-control price" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">GST Tax (in %)
                                        <div class="form-input">
                                            <input type="number" id="taxRate_1" class="form-control tax" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">Tax Total
                                        <div class="form-input">
                                            <input type="number" id="taxTot_1" class="form-control taxTotal" autocomplete="off" value="">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">Total
                                        <div class="form-input">
                                            <input type="number" id="total_1" class="form-control total" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row d-flex justify-content-between">
                                    <div class="form-group col-md-5">
                                        <button class="btn btn-primary" id="addRows" type="button">
                                            <i class="fas fa-plus-square mr-2"></i>Add Item
                                        </button>
                                    </div>
                                </div>
                                <div class="form-row mt-4">
                                    <h4><strong>Invoice</strong></h4>
                                </div>
                                <div class="form-row">
                                <table class="table table-responsive" id="invoiceItem">
                                    <thead>
                                        <tr class="bg-light text-dark">
                                            <td><input id="checkAll" class="form-control" type="checkbox"></td>
                                            <td style="max-width:400px;">Item</td>
                                            <!-- <td style="width:250px;">Description</td> -->
                                            <td style="max-width:100px;">Quantity</td>
                                            <td style="max-width:150px;">Price</td>
                                            <td style="max-width:120px;">GST (in %)</td>
                                            <td style="max-width:150px;">GST Amt</td>
                                            <td style="max-width:150px;">Total</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody id="invoiceItem">
                                        <tr class="bg-secondary">
                                            <!-- <td></td>
                                            <td><select id="item_1" class="form-control item"><?php getItems($conn,$_SESSION['userRel']);?></select></td>
                                            <td><textarea class="form-control" id="description_1" cols="30" rows="1"></textarea></td>
                                            <td><input type="number" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
                                            <td><input type="number" id="price_1" class="form-control price" autocomplete="off"></td>
                                            <td><input type="number" id="taxRate_1" class="form-control tax" autocomplete="off"></td>
                                            <td><input type="number" id="total_1" class="form-control total" autocomplete="off"></td>
                                            <td><input type="number" hidden id="taxTot_1" class="form-control taxTotal" autocomplete="off" value=""></td> -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-row d-flex justify-content-between">
                                <div class="form-group col-md-5">
                                    <button class="btn btn-danger" id="removeRows" type="button">
                                        <i class="fas fa-minus mr-2"></i>Delete
                                    </button>
                                </div>
                                <!-- <div class="form-group col-md-4 row text-right">
                                    <div class="input-group mb-3"><span class="col-md-5 p-2">Subtotal:&nbsp;</span>
                                        <div class="input-group-prepend">
                                        <div class="input-group-text" style="max-height:38px;border:1px solid #0070FF;">&#x20B9;</div>
                                        </div>
                                        <input value="" type="number" class="form-control" name="amtPay" id="subTotal" placeholder="Subtotal">
                                    </div>
                                    <div class="input-group mb-3"><span class="col-md-5 p-2">CGST Tax Amount:&nbsp;</span>
                                        <div class="input-group-prepend">
                                        <div class="input-group-text" style="max-height:38px;border:1px solid #0070FF;">&#x20B9;</div>
                                        </div>
                                        <input value="" type="number" class="form-control" name="cgstAmt" id="CGSTtaxAmount" placeholder="CGST Tax Amount">
                                    </div>
                                    <div class="input-group mb-3"><span class="col-md-5 p-2">SGST Tax Amount:&nbsp;</span>
                                        <div class="input-group-prepend">
                                        <div class="input-group-text" style="max-height:38px;border:1px solid #0070FF;">&#x20B9;</div>
                                        </div>
                                        <input value="" type="number" class="form-control" name="sgstAmt" id="SGSTtaxAmount" placeholder="SGST Tax Amount">
                                    </div>
                                    <div class="input-group mb-3"><span class="col-md-5 p-2">Total Amount:&nbsp;</span>
                                        <div class="input-group-prepend">
                                        <div class="input-group-text" style="max-height:38px;border:1px solid #0070FF;">&#x20B9;</div>
                                        </div>
                                        <input value="" type="number" class="form-control" name="totalPay" id="totalAfterTax" placeholder="Total">
                                    </div>
                                </div> -->
                            </div>
                            <hr class="mt-5">
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
?>
<script type="text/javascript" src="js/invoice.js"></script>
<?php
    include('includes/footer.php');
?>