<?php
include('includes/header.php');
include_once("includes/dbconfig.php");
?>
<div class="container-fluid bg-primary">
    <div class="col-md-8 mx-auto" style="margin-top:240px;margin-bottom:252px;">
        <div class="card mt-4">
            <h5 class="card-header"><strong>V Way Grocery - Vendor Registration Form</strong></h5>

            <?php
                if (isset($_POST["create"])){
                    // Data being Inserted into the Database
                    $sql="INSERT INTO vendors (name,store_name,number,sell_interest,email,gst_no,address)
                    VALUES ('".$_POST['vendor_name']."','".$_POST['store_name']."','".$_POST['number']."','".$_POST['sell_interest']."','".$_POST['vendor_email']."','".$_POST['gst_no']."','".$_POST['address']."')";
                    $result=mysqli_query($conn,$sql);
                }
            ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 text-center">
                        <h3>Registration Successful!</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include('includes/scripts.php');
?>