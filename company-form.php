<?php
include('includes/header.php');
include_once("includes/dbconfig.php");
?>
<div class="container-fluid bg-primary">
    <div class="col-md-8 mx-auto" style="margin-top:10px;margin-bottom:78px;">
        <div class="card mt-4">
            <h5 class="card-header"><strong>V Way - Company Registration Form</strong></h5>
            <div class="card-body">
                <form action="company-upload.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
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
                        <div class="form-group col-md-4">E-Mail
                            <div class="form-input">
                                <input class="form-control" type="email" name="com_email">
                            </div>
                        </div>
                        <div class="form-group col-md-4">GST Number
                            <div class="form-input">
                                <input class="form-control" type="text" name="gst_no">
                            </div>
                        </div>
                    </div><br>
                    <div class="form-row">
                        <div class="form-group col-md-6">Address
                            <div class="form-input">
                                <textarea class="form-control" name="address" cols="30" rows="4"></textarea>
                            </div>
                        </div>
                    </div><br>
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