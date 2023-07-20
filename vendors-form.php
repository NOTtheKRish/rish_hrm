<?php
include('includes/header.php');
include_once("includes/dbconfig.php");
?>
<div class="container-fluid bg-primary">
    <div class="col-md-8 mx-auto" style="margin-top:10px;margin-bottom:78px;">
        <div class="card mt-4">
            <h5 class="card-header"><strong>V Way - Company Registration Form</strong></h5>
            <div class="card-body">
                <form action="vendors-success.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="vendor_name" class="col-md-4 col-form-label">Vendor Name</label>
                            <div class="col-md-8">
                                <input style="color:#000;" type="text"  class="form-control" name="vendor_name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="store_name" class="col-md-4 col-form-label">Store Name</label>
                            <div class="col-md-8">
                                <input style="color:#000;" type="text"  class="form-control" name="store_name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="number" class="col-md-4 col-form-label">Contact Number</label>
                            <div class="col-md-8">
                                <input style="color:#000;" type="text"  class="form-control" name="number" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sell_interest" class="col-md-4 col-form-label">Interested to SELL</label>
                            <div class="col-md-8">
                                <input style="color:#000;" type="text"  class="form-control" name="sell_interest" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vendor_email" class="col-md-4 col-form-label">E-Mail</label>
                            <div class="col-md-8">
                                <input style="color:#000;" type="text"  class="form-control" name="vendor_email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gst_no" class="col-md-4 col-form-label">GST Number</label>
                            <div class="col-md-8">
                                <input style="color:#000;" type="text"  class="form-control" name="gst_no" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label">Address</label>
                            <div class="col-md-8">
                                <input style="color:#000;" type="text"  class="form-control" name="address" required>
                            </div>
                        </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button class="btn btn-primary" name="create" type="submit">
                                <i class="fas fa-save mr-2"></i>Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    include('includes/scripts.php');
?>