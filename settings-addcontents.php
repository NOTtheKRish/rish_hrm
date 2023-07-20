<?php
include('session.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/packageCheck.php');
include_once('includes/dbconfig.php');
include('includes/invoiceDrops.php');
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
            <div class="d-sm-flex align-items-center mb-4">
                <h1 class="h3 mb-2 text-gray-800">Settings</h1>
            </div>
            <!-- All Contents of the page starts from here-->
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs nav-justified card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="settings.php"><strong>General</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logoupload.php"><strong>Manage Logo</strong></a>
                        </li>
                        <?php
                        $sq = "SELECT package FROM accounts WHERE id='" . $_SESSION['userRel'] . "'";
                        $res = mysqli_query($conn, $sq);
                        while ($row = mysqli_fetch_array($res)) {
                            $package = $row['package'];
                        }
                        if ($package == "BASIC (MONTHLY)" || $package == "BASIC (YEARLY)") {
                            echo '';
                        } else {
                            echo '<li class="nav-item">
                                    <a class="nav-link" href="users.php"><strong>Users</strong></a>
                                </li>';
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="payment-details.php"><strong>Invoice Details</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="settings-addcontents.php"><strong>Add Contents</strong></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-qualification" role="tab" aria-controls="pills-qualification" aria-selected="true">Qualification</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-jobrole" role="tab" aria-controls="pills-jobrole" aria-selected="false">JOB Role & JOB Expected</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-spendfor-tab" data-toggle="pill" href="#pills-spendfor" role="tab" aria-controls="pills-spendfor" aria-selected="false">Spend For</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-items-tab" data-toggle="pill" href="#pills-item" role="tab" aria-controls="pills-item" aria-selected="false">Invoice Item</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-tax-tab" data-toggle="pill" href="#pills-tax" role="tab" aria-controls="pills-tax" aria-selected="false">Tax</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-buy-tab" data-toggle="pill" href="#pills-buy-interest" role="tab" aria-controls="pills-buy-interest" aria-selected="false">Buy Interest</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-sell-tab" data-toggle="pill" href="#pills-sell-interest" role="tab" aria-controls="pills-sell-interest" aria-selected="false">Sell Interest</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-industry-tab" data-toggle="pill" href="#pills-industry-type" role="tab" aria-controls="pills-industry-type" aria-selected="false">Industry Type</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-qualification" role="tabpanel" aria-labelledby="pills-qualification-tab">
                                <!-- Create Qualification Area Starts -->
                                <?php
                                if (isset($_POST["qualification_add"])) {
                                    echo '<script type="text/javascript">
                                                                setTimeout(function(){
                                                                    swal({
                                                                        icon:"success",
                                                                        title:"Success!",
                                                                        text:"New Qualification Successfully",
                                                                        button: "Close",
                                                                    });
                                                                },500);
                                                            </script>';
                                    $qualification = $_POST['qualification'];
                                    $sql = "INSERT INTO can_qualification (value) VALUES ('" . $qualification . "')";
                                    $qual = mysqli_query($conn, $sql);
                                }
                                ?>
                                <!-- Create Qualification Area End -->
                                <!-- Edit Qualification Area Starts -->
                                <?php
                                if (isset($_POST["qualification_edit"])) {
                                    echo '<script type="text/javascript">
                                                                setTimeout(function(){
                                                                    swal({
                                                                        icon:"success",
                                                                        title:"Success!",
                                                                        text:"Qualification Data Modified Successfully",
                                                                        button: "Close",
                                                                    });
                                                                },500);
                                                            </script>';
                                    $qual_id = $_POST['qual_id'];
                                    $qualification = $_POST['qualification'];
                                    $sql = "UPDATE can_qualification SET value='" . $qualification . "'
                                                        WHERE id='" . $qual_id . "'";
                                    $qual = mysqli_query($conn, $sql);
                                }
                                ?>
                                <!-- Edit Qualification Area End -->
                                <!-- Delete Qualification Area Starts -->
                                <?php
                                if (isset($_POST["qualification_del"])) {
                                    echo '<script type="text/javascript">
                                                                setTimeout(function(){
                                                                    swal({
                                                                        icon:"info",
                                                                        title:"Success!",
                                                                        text:"Qualification Data Deleted Successfully",
                                                                        button: "Close",
                                                                    });
                                                                },500);
                                                            </script>';
                                    $qual_id = $_POST['qual_id'];
                                    $sql = "DELETE FROM can_qualification WHERE id='" . $qual_id . "'";
                                    $qual = mysqli_query($conn, $sql);
                                }
                                ?>
                                <!-- Delete Qualification Area End -->
                                <!-- Create JOB Role Area Starts -->
                                <?php
                                if (isset($_POST["jobrole_add"])) {

                                    echo '<script type="text/javascript">

                                                                    setTimeout(function(){

                                                                        swal({

                                                                            icon:"success",

                                                                            title:"Success!",

                                                                            text:"JOB Role / Expected JOB Added Successfully",

                                                                            button: "Close",

                                                                        });

                                                                    },500);

                                                                </script>';

                                    $jobrole = $_POST['jobrole'];

                                    $sql = "INSERT INTO can_jobrole (value) VALUES ('" . $jobrole . "')";

                                    $jobro = mysqli_query($conn, $sql);

                                    $sql = "INSERT INTO can_jobexpect (value) VALUES ('" . $jobrole . "')";

                                    $jobexpect = mysqli_query($conn, $sql);
                                }

                                ?>

                                <!-- Create JOB Role Area End -->

                                <!-- Edit JOB Role Area Starts -->

                                <?php

                                if (isset($_POST["jobrole_edit"])) {

                                    echo '<script type="text/javascript">

                                                                    setTimeout(function(){

                                                                        swal({

                                                                            icon:"success",

                                                                            title:"Success!",

                                                                            text:"JOB Role / Expected JOB Modified Successfully",

                                                                            button: "Close",

                                                                        });

                                                                    },500);

                                                                </script>';

                                    $jobrole_id = $_POST['jobrole_id'];

                                    $jobrole = $_POST['jobrole'];

                                    $sql = "UPDATE can_jobrole SET value='" . $jobrole . "'

                                                        WHERE id='" . $jobrole_id . "'";

                                    $qual = mysqli_query($conn, $sql);

                                    $sql = "UPDATE can_jobexpect SET value='" . $jobrole . "'

                                                        WHERE id='" . $jobrole_id . "'";

                                    $qual = mysqli_query($conn, $sql);
                                }

                                ?>

                                <!-- Edit JOB Role Area End -->

                                <!-- Delete JOB Role Area Starts -->

                                <?php

                                if (isset($_POST["jobrole_del"])) {

                                    echo '<script type="text/javascript">

                                                                    setTimeout(function(){

                                                                        swal({

                                                                            icon:"info",

                                                                            title:"Success!",

                                                                            text:"JOB Role / Expected JOB Deleted Successfully",

                                                                            button: "Close",

                                                                        });

                                                                    },500);

                                                                </script>';

                                    $jobrole_id = $_POST['jobrole_id'];

                                    $sql = "DELETE FROM can_jobrole WHERE id='" . $jobrole_id . "'";

                                    $qual = mysqli_query($conn, $sql);

                                    $sql = "DELETE FROM can_jobexpect WHERE id='" . $jobrole_id . "'";

                                    $qual = mysqli_query($conn, $sql);
                                }

                                ?>

                                <!-- Delete JOB Role Area End -->

                                <!-- Create Spend For Area Starts -->

                                <?php

                                if (isset($_POST["spendfor_add"])) {

                                    echo '<script type="text/javascript">

                                                                    setTimeout(function(){

                                                                        swal({

                                                                            icon:"success",

                                                                            title:"Success!",

                                                                            text:"New Data Added Successfully",

                                                                            button: "Close",

                                                                        });

                                                                    },500);

                                                                </script>';

                                    $spendfor = $_POST['spendfor'];

                                    $sql = "INSERT INTO expenses_spendfor (value) VALUES ('" . $spendfor . "')";

                                    $spend = mysqli_query($conn, $sql);
                                }

                                ?>

                                <!-- Create Spend For Area End -->

                                <!-- Edit Spend For Area Starts -->

                                <?php

                                if (isset($_POST["spendfor_edit"])) {

                                    echo '<script type="text/javascript">

                                                                setTimeout(function(){

                                                                    swal({

                                                                        icon:"success",

                                                                        title:"Success!",

                                                                        text:"Data Modified Successfully",

                                                                        button: "Close",

                                                                    });

                                                                },500);

                                                            </script>';

                                    $spendfor_id = $_POST['spendfor_id'];

                                    $spendfor = $_POST['spendfor'];

                                    $sql = "UPDATE expenses_spendfor SET value='" . $spendfor . "'

                                                        WHERE id='" . $spendfor_id . "'";

                                    $spend = mysqli_query($conn, $sql);
                                }

                                ?>

                                <!-- Edit Spend For Area End -->

                                <!-- Delete Spend For Area Starts -->

                                <?php

                                if (isset($_POST["spendfor_del"])) {

                                    echo '<script type="text/javascript">

                                                                setTimeout(function(){

                                                                    swal({

                                                                        icon:"info",

                                                                        title:"Success!",

                                                                        text:"Data Deleted Successfully",

                                                                        button: "Close",

                                                                    });

                                                                },500);

                                                            </script>';

                                    $spendfor_id = $_POST['spendfor_id'];

                                    $sql = "DELETE FROM expenses_spendfor WHERE id='" . $spendfor_id . "'";

                                    $spend = mysqli_query($conn, $sql);
                                }

                                ?>

                                <!-- Delete Spend For Area End -->

                                <!-- Create Invoice Item Area Starts -->

                                <?php

                                if (isset($_POST["item_add"])) {

                                    echo '<script type="text/javascript">

                                                                setTimeout(function(){

                                                                    swal({

                                                                        icon:"success",

                                                                        title:"Success!",

                                                                        text:"New Invoice Item Added Successfully",

                                                                        button: "Close",

                                                                    });

                                                                },500);

                                                            </script>';

                                    $items = $_POST['item'];
                                    $desc=$_POST['description'];
                                    $price=$_POST['price'];
                                    $tax=$_POST['tax'];

                                    $entry_by = $_SESSION['userRel'];

                                    $sql = "INSERT INTO items (value,description,price,tax,entry_by) VALUES ('".$items."','".$desc."','".$price."','".$tax."','".$entry_by."')";

                                    $item = mysqli_query($conn, $sql);
                                }

                                ?>

                                <!-- Create Invoice Item Area End -->

                                <!-- Edit Invoice Item Area Starts -->

                                <?php

                                if (isset($_POST["item_edit"])) {

                                    echo '<script type="text/javascript">

                                                                setTimeout(function(){

                                                                    swal({

                                                                        icon:"success",

                                                                        title:"Success!",

                                                                        text:"Invoice Item Modified Successfully",

                                                                        button: "Close",

                                                                    });

                                                                },500);

                                                            </script>';

                                    $item_id = $_POST['item_id'];

                                    $items = $_POST['item'];
                                    $desc=$_POST['description'];
                                    $price=$_POST['price'];
                                    $tax=$_POST['tax'];

                                    $sql = "UPDATE items SET value='".$items."', description='".$desc."', price='".$price."', tax='".$tax."' WHERE id='".$item_id."'";

                                    $item = mysqli_query($conn, $sql);
                                }

                                ?>

                                <!-- Edit Invoice Item Area End -->

                                <!-- Delete Invoice Item Area Starts -->

                                <?php

                                if (isset($_POST["item_del"])) {

                                    echo '<script type="text/javascript">

                                                                setTimeout(function(){

                                                                    swal({

                                                                        icon:"info",

                                                                        title:"Success!",

                                                                        text:"Invoice Item deleted Successfully",

                                                                        button: "Close",

                                                                    });

                                                                },500);

                                                            </script>';

                                    $item_id = $_POST['item_id'];

                                    $sql = "DELETE FROM items WHERE id='" . $item_id . "'";

                                    $item = mysqli_query($conn, $sql);
                                }

                                ?>

                                <!-- Delete Invoice Item Area End -->

                                <!-- Create Tax Area Starts -->
                                <?php
                                if (isset($_POST["tax_add"])) {
                                    echo '<script type="text/javascript">
                                                                setTimeout(function(){
                                                                    swal({
                                                                        icon:"success",
                                                                        title:"Success!",
                                                                        text:"New Tax added Successfully",
                                                                        button: "Close",
                                                                    });
                                                                },500);
                                                            </script>';
                                    $tax = $_POST['tax'];
                                    $cgst = $tax / 2;
                                    $sql = "INSERT INTO tax (tax_percent,cgst,sgst) VALUES ('" . $tax . "','" . $cgst . "','" . $cgst . "')";
                                    $taxes = mysqli_query($conn, $sql);
                                }
                                ?>
                                <!-- Create Tax Area End -->
                                <!-- Edit Tax Area Starts -->
                                <?php
                                if (isset($_POST["tax_edit"])) {
                                    echo '<script type="text/javascript">
                                                                setTimeout(function(){
                                                                    swal({
                                                                        icon:"success",
                                                                        title:"Success!",
                                                                        text:"Tax Data Modified Successfully",
                                                                        button: "Close",
                                                                    });
                                                                },500);
                                                            </script>';
                                    $tax_id = $_POST['tax_id'];
                                    $taxes = $_POST['tax'];
                                    $cgst = $taxes / 2;
                                    $sql = "UPDATE tax SET tax_percent='" . $taxes . "',cgst='" . $cgst . "',sgst='" . $cgst . "' WHERE id='" . $tax_id . "'";
                                    $tax = mysqli_query($conn, $sql);
                                }
                                ?>
                                <!-- Edit Tax Area End -->
                                <!-- Delete Tax Area Starts -->
                                <?php
                                if (isset($_POST["tax_del"])) {
                                    echo '<script type="text/javascript">
                                                                setTimeout(function(){
                                                                    swal({
                                                                        icon:"info",
                                                                        title:"Success!",
                                                                        text:"Tax Deleted Successfully",
                                                                        button: "Close",
                                                                    });
                                                                },500);
                                                            </script>';
                                    $tax_id = $_POST['tax_id'];
                                    $sql = "DELETE FROM tax WHERE id='" . $tax_id . "'";
                                    $tax = mysqli_query($conn, $sql);
                                }
                                ?>
                                <!-- Delete Tax Area End -->
                                <!-- Create Buy Interest Area Starts -->
                                <?php
                                if(isset($_POST["buy_interest_add"])) {
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"New Buy Interest added Successfully",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                                    $buyInterest=$_POST['buy_interest'];
                                    $userRel=$_SESSION['userRel'];
                                    $userId=$_SESSION['userId'];
                                    $sql="INSERT INTO interest_buy (name,entry_by,user_id) VALUES ('".$buyInterest."','".$userRel."','".$userId."')";
                                    mysqli_query($conn, $sql);
                                }
                                ?>
                                <!-- Create Buy Interest Area End -->
                                <!-- Edit Buy Interest Area Starts -->
                                <?php
                                if (isset($_POST["buy_interest_edit"])) {
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"Buy Interest Data Modified Successfully",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                                    $id=$_POST['id'];
                                    $buyInterest=$_POST['buy_interest'];
                                    $userRel=$_SESSION['userRel'];
                                    $userId=$_SESSION['userId'];
                                    $sql="UPDATE interest_buy SET name='".$buyInterest."' WHERE id='".$id."'";
                                    mysqli_query($conn, $sql);
                                }
                                ?>
                                <!-- Edit Buy Interest Area End -->
                                <!-- Delete Buy Interest Area Starts -->
                                <?php
                                if (isset($_POST["buy_interest_del"])) {
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"info",
                                                    title:"Success!",
                                                    text:"Buy Interest Deleted Successfully",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                                    $id=$_POST['id'];
                                    $sql="DELETE FROM interest_buy WHERE id='".$id."'";
                                    mysqli_query($conn, $sql);
                                }
                                ?>
                                <!-- Delete Buy Interest Area End -->
                                <!-- Create Sell Interest Area Starts -->
                                <?php
                                if(isset($_POST["sell_interest_add"])) {
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"New Sell Interest added Successfully",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                                    $sellInterest=$_POST['sell_interest'];
                                    $userRel=$_SESSION['userRel'];
                                    $userId=$_SESSION['userId'];
                                    $sql="INSERT INTO interest_sell (name,entry_by,user_id) VALUES ('".$sellInterest."','".$userRel."','".$userId."')";
                                    mysqli_query($conn, $sql);
                                }
                                ?>
                                <!-- Create Sell Interest Area End -->
                                <!-- Edit Sell Interest Area Starts -->
                                <?php
                                if (isset($_POST["sell_interest_edit"])) {
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"Sell Interest Data Modified Successfully",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                                    $id=$_POST['id'];
                                    $sellInterest=$_POST['sell_interest'];
                                    $userRel=$_SESSION['userRel'];
                                    $userId=$_SESSION['userId'];
                                    $sql="UPDATE interest_sell SET name='".$sellInterest."' WHERE id='".$id."'";
                                    mysqli_query($conn, $sql);
                                }
                                ?>
                                <!-- Edit Sell Interest Area End -->
                                <!-- Delete Sell Interest Area Starts -->
                                <?php
                                if (isset($_POST["sell_interest_del"])) {
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"info",
                                                    title:"Success!",
                                                    text:"Sell Interest Deleted Successfully",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                                    $id=$_POST['id'];
                                    $sql="DELETE FROM interest_sell WHERE id='".$id."'";
                                    mysqli_query($conn, $sql);
                                }
                                ?>
                                <!-- Delete Sell Interest Area End -->
                                <!-- Create Industry Type Area Starts -->
                                <?php
                                if(isset($_POST["industry_type_add"])) {
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"New Industry Type added Successfully",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                                    $industry_type=$_POST['industry_type'];
                                    $userRel=$_SESSION['userRel'];
                                    $userId=$_SESSION['userId'];
                                    $sql="INSERT INTO industry_type (name,entry_by,user_id) VALUES ('".$industry_type."','".$userRel."','".$userId."')";
                                    mysqli_query($conn, $sql);
                                }
                                ?>
                                <!-- Create Industry Type Area End -->
                                <!-- Edit Industry Type Area Starts -->
                                <?php
                                if (isset($_POST["industry_type_edit"])) {
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"Industry Type Modified Successfully",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                                    $id=$_POST['id'];
                                    $industry_type=$_POST['industry_type'];
                                    $userRel=$_SESSION['userRel'];
                                    $userId=$_SESSION['userId'];
                                    $sql="UPDATE industry_type SET name='".$industry_type."' WHERE id='".$id."'";
                                    mysqli_query($conn, $sql);
                                }
                                ?>
                                <!-- Edit Industry Type Area End -->
                                <!-- Delete Industry Type Area Starts -->
                                <?php
                                if (isset($_POST["industry_type_del"])) {
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"info",
                                                    title:"Success!",
                                                    text:"Industry Type Deleted Successfully",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                                    $id=$_POST['id'];
                                    $sql="DELETE FROM industry_type WHERE id='".$id."'";
                                    mysqli_query($conn, $sql);
                                }
                                ?>
                                <!-- Delete Industry Type Area End -->

                                <div class="col-md-2 mt-4">

                                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#staticQualification"><i class="fas fa-plus mr-2"></i>Add Qualification</button>

                                </div>

                                <div class="d-flex justify-content-center">

                                    <div class="table-responsive text-center mt-2" style="max-width:800px;max-height:400px;border:3px solid #0070ff;border-radius:9px;">

                                        <table class="table table-bordered dataTable">

                                            <thead>

                                                <tr>

                                                    <th>S.No.</th>

                                                    <th>Qualification</th>

                                                    <th>Actions</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                                $sql = "SELECT * FROM can_qualification";

                                                $result = mysqli_query($conn, $sql);

                                                $qual_total = mysqli_num_rows($result);

                                                if ($qual_total > 0) {

                                                    while ($row = mysqli_fetch_array($result)) {

                                                ?>

                                                        <tr>

                                                            <?php echo '<td>' . $row['id'] . '</td>'; ?>

                                                            <?php echo '<td>' . $row['value'] . '</td>'; ?>

                                                            <?php echo '<td><a href="settings-editcontents.php?qual=' . $row['id'] . '" class="btn btn-circle btn-primary mr-2" type="button"><i class="fas fa-pen"></i></a><a href="settings-delcontents.php?qual=' . $row['id'] . '" class="btn btn-circle btn-danger mr-2" type="button"><i class="fas fa-trash"></i></a></td>';



                                                            ?>

                                                        </tr>

                                                <?php }
                                                } ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </div><br>

                                <?php echo '<p class="text-dark lead">Total ' . $qual_total . ' Entries</p>'; ?>

                            </div>

                            <div class="tab-pane fade" id="pills-jobrole" role="tabpanel" aria-labelledby="pills-profile-tab">

                                <div class="col-md-2 mt-4">

                                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#staticJOBRole"><i class="fas fa-plus mr-2"></i>Add JOB Role</button>

                                </div>

                                <div class="d-flex justify-content-center">

                                    <div class="table-responsive mt-2" style="max-width:800px;max-height:400px;border:3px solid #0070ff;border-radius:9px;">

                                        <table class="table table-bordered dataTable">

                                            <thead>

                                                <tr>

                                                    <th>S.No.</th>

                                                    <th>JOB Role / JOB Expected</th>

                                                    <th>Actions</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                                $sql = "SELECT * FROM can_jobrole";

                                                $result = mysqli_query($conn, $sql);

                                                $jobrole_total = mysqli_num_rows($result);

                                                if ($jobrole_total > 0) {

                                                    while ($row = mysqli_fetch_array($result)) {

                                                ?>

                                                        <tr>

                                                            <?php echo '<td>' . $row['id'] . '</td>'; ?>

                                                            <?php echo '<td>' . $row['value'] . '</td>'; ?>

                                                            <?php echo '<td><a href="settings-editcontents.php?jobrole=' . $row['id'] . '" class="btn btn-circle btn-primary mr-2" type="button"><i class="fas fa-pen"></i></a><a href="settings-delcontents.php?jobrole=' . $row['id'] . '" class="btn btn-circle btn-danger mr-2" type="button"><i class="fas fa-trash"></i></a></td>'; ?>

                                                        </tr>

                                                <?php }
                                                } ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </div><br>

                                <?php echo '<p class="text-dark lead">Total ' . $jobrole_total . ' Entries</p>'; ?>

                            </div>

                            <div class="tab-pane fade" id="pills-spendfor" role="tabpanel" aria-labelledby="pills-spendfor-tab">

                                <div class="col-md-2 mt-4">

                                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#staticSpendFor"><i class="fas fa-plus mr-2"></i>Add New</button>

                                </div>

                                <div class="d-flex justify-content-center">

                                    <div class="table-responsive mt-2" style="max-width:800px;max-height:400px;border:3px solid #0070ff;border-radius:9px;">

                                        <table class="table table-bordered dataTable">

                                            <thead>

                                                <tr>

                                                    <th>S.No.</th>

                                                    <th>Spend For</th>

                                                    <th>Actions</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                                $sql = "SELECT * FROM expenses_spendfor";

                                                $result = mysqli_query($conn, $sql);

                                                $spendfor_total = mysqli_num_rows($result);

                                                if ($spendfor_total > 0) {

                                                    while ($row = mysqli_fetch_array($result)) {

                                                ?>

                                                        <tr>

                                                            <?php echo '<td>' . $row['id'] . '</td>'; ?>

                                                            <?php echo '<td>' . $row['value'] . '</td>'; ?>

                                                            <?php echo '<td><a href="settings-editcontents.php?spendfor=' . $row['id'] . '" class="btn btn-circle btn-primary mr-2" type="button"><i class="fas fa-pen"></i></a><a href="settings-delcontents.php?spendfor=' . $row['id'] . '" class="btn btn-circle btn-danger mr-2" type="button"><i class="fas fa-trash"></i></a></td>'; ?>

                                                        </tr>

                                                <?php }
                                                } ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </div><br>

                                <?php echo '<p class="text-dark lead">Total ' . $spendfor_total . ' Entries</p>'; ?>

                            </div>

                            <div class="tab-pane fade" id="pills-item" role="tabpanel" aria-labelledby="pills-items-tab">

                                <div class="col-md-2 mt-4">

                                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#staticItem"><i class="fas fa-plus mr-2"></i>Add New Item</button>

                                </div>

                                <div class="d-flex justify-content-center">

                                    <div class="table-responsive mt-2" style="max-width:800px;max-height:400px;border:3px solid #0070ff;border-radius:9px;">

                                        <table class="table table-bordered dataTable">

                                            <thead>

                                                <tr>

                                                    <th>S.No.</th>

                                                    <th>Items</th>
                                                    <th>Description</th>
                                                    <th>Price</th>
                                                    <th>Tax (in %)</th>

                                                    <th>Actions</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                                $sql = "SELECT * FROM items WHERE entry_by='" . $_SESSION['userRel'] . "'";

                                                $result = mysqli_query($conn, $sql);

                                                $items_total = mysqli_num_rows($result);

                                                if ($items_total > 0) {

                                                    while ($row = mysqli_fetch_array($result)) {

                                                ?>

                                                        <tr>

                                                            <?php echo '<td>' . $row['id'] . '</td>'; ?>

                                                            <?php echo '<td>'.$row['value'].'</td>'; ?>
                                                            <?php echo '<td>'.$row['description'].'</td>'; ?>
                                                            <?php echo '<td>'.$row['price'].'</td>'; ?>
                                                            <?php echo '<td>'.$row['tax'].'</td>'; ?>

                                                            <?php echo '<td><a href="settings-editcontents.php?items=' . $row['id'] . '" class="btn btn-circle btn-primary mr-2" type="button"><i class="fas fa-pen"></i></a><a href="settings-delcontents.php?items=' . $row['id'] . '" class="btn btn-circle btn-danger mr-2" type="button"><i class="fas fa-trash"></i></a></td>'; ?>

                                                        </tr>

                                                <?php }
                                                } ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </div><br>

                                <?php echo '<p class="text-dark lead">Total ' . $items_total . ' Entries</p>'; ?>

                            </div>

                            <div class="tab-pane fade" id="pills-tax" role="tabpanel" aria-labelledby="pills-tax-tab">
                                <div class="col-md-2 mt-4">
                                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#staticTax"><i class="fas fa-plus mr-2"></i>Add New Tax</button>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="table-responsive mt-2" style="max-width:800px;max-height:400px;border:3px solid #0070ff;border-radius:9px;">
                                        <table class="table table-bordered dataTable">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Tax Percent</th>
                                                    <th>CGST</th>
                                                    <th>SGST</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM tax";
                                                $result = mysqli_query($conn, $sql);
                                                $tax_total = mysqli_num_rows($result);
                                                if ($tax_total > 0) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                        <tr>
                                                            <?php echo '<td>' . $row['id'] . '</td>'; ?>
                                                            <?php echo '<td>' . $row['tax_percent'] . '</td>'; ?>
                                                            <?php echo '<td>' . $row['cgst'] . '</td>'; ?>
                                                            <?php echo '<td>' . $row['sgst'] . '</td>'; ?>
                                                            <?php echo '<td><a href="settings-editcontents.php?tax=' . $row['id'] . '" class="btn btn-circle btn-primary mr-2" type="button"><i class="fas fa-pen"></i></a><a href="settings-delcontents.php?tax=' . $row['id'] . '" class="btn btn-circle btn-danger mr-2" type="button"><i class="fas fa-trash"></i></a></td>'; ?>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><br>
                                <?php echo '<p class="text-dark lead">Total ' . $tax_total . ' Entries</p>'; ?>
                            </div>

                            <div class="tab-pane fade" id="pills-buy-interest" role="tabpanel" aria-labelledby="pills-buy-interest-tab">
                                <div class="col-md-2 mt-4">
                                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#staticBuyInterest"><i class="fas fa-plus mr-2"></i>Add New</button>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="table-responsive mt-2" style="max-width:800px;max-height:400px;border:3px solid #0070ff;border-radius:9px;">
                                        <table class="table table-bordered dataTable">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Interest</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $userRel=$_SESSION['userRel'];
                                                $userId=$_SESSION['userId'];
                                                $sql="SELECT * FROM interest_buy WHERE entry_by='".$userRel."' AND user_id='".$userId."'";
                                                $result=mysqli_query($conn,$sql);
                                                $total=mysqli_num_rows($result);
                                                if($tax_total>0){
                                                    while($row=mysqli_fetch_array($result)){
                                                ?>
                                                        <tr>
                                                            <?php echo '<td>'.$row['id'].'</td>'; ?>
                                                            <?php echo '<td>'.$row['name'].'</td>'; ?>
                                                            <?php echo '<td><a href="settings-editcontents.php?buyInterest='.$row['id'].'" class="btn btn-circle btn-primary mr-2" type="button"><i class="fas fa-pen"></i></a><a href="settings-delcontents.php?buyInterest='.$row['id'].'" class="btn btn-circle btn-danger mr-2" type="button"><i class="fas fa-trash"></i></a></td>'; ?>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><br>
                                <?php echo '<p class="text-dark lead">Total '.$total.' Entries</p>'; ?>
                            </div>

                            <div class="tab-pane fade" id="pills-sell-interest" role="tabpanel" aria-labelledby="pills-sell-interest-tab">
                                <div class="col-md-2 mt-4">
                                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#staticSellInterest"><i class="fas fa-plus mr-2"></i>Add New</button>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="table-responsive mt-2" style="max-width:800px;max-height:400px;border:3px solid #0070ff;border-radius:9px;">
                                        <table class="table table-bordered dataTable">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Interest</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $userRel=$_SESSION['userRel'];
                                                $userId=$_SESSION['userId'];
                                                $sql="SELECT * FROM interest_sell WHERE entry_by='".$userRel."' AND user_id='".$userId."'";
                                                $result=mysqli_query($conn,$sql);
                                                $total=mysqli_num_rows($result);
                                                if($tax_total>0){
                                                    while($row=mysqli_fetch_array($result)){
                                                ?>
                                                        <tr>
                                                            <?php echo '<td>'.$row['id'].'</td>'; ?>
                                                            <?php echo '<td>'.$row['name'].'</td>'; ?>
                                                            <?php echo '<td><a href="settings-editcontents.php?sellInterest='.$row['id'].'" class="btn btn-circle btn-primary mr-2" type="button"><i class="fas fa-pen"></i></a><a href="settings-delcontents.php?sellInterest='.$row['id'].'" class="btn btn-circle btn-danger mr-2" type="button"><i class="fas fa-trash"></i></a></td>'; ?>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><br>
                                <?php echo '<p class="text-dark lead">Total '.$total.' Entries</p>'; ?>
                            </div>
                            <div class="tab-pane fade" id="pills-industry-type" role="tabpanel" aria-labelledby="pills-industry-type-tab">
                                <div class="col-md-2 mt-4">
                                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#staticIndustryType"><i class="fas fa-plus mr-2"></i>Add New</button>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="table-responsive mt-2" style="max-width:800px;max-height:400px;border:3px solid #0070ff;border-radius:9px;">
                                        <table class="table table-bordered dataTable">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Name</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $userRel=$_SESSION['userRel'];
                                                $userId=$_SESSION['userId'];
                                                $sql="SELECT * FROM industry_type WHERE entry_by='".$userRel."' AND user_id='".$userId."'";
                                                $result=mysqli_query($conn,$sql);
                                                $total=mysqli_num_rows($result);
                                                if($tax_total>0){
                                                    while($row=mysqli_fetch_array($result)){
                                                ?>
                                                        <tr>
                                                            <?php echo '<td>'.$row['id'].'</td>'; ?>
                                                            <?php echo '<td>'.$row['name'].'</td>'; ?>
                                                            <?php echo '<td><a href="settings-editcontents.php?industry_type='.$row['id'].'" class="btn btn-circle btn-primary mr-2" type="button"><i class="fas fa-pen"></i></a><a href="settings-delcontents.php?industry_type='.$row['id'].'" class="btn btn-circle btn-danger mr-2" type="button"><i class="fas fa-trash"></i></a></td>'; ?>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><br>
                                <?php echo '<p class="text-dark lead">Total '.$total.' Entries</p>'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Qualification Modal Starts -->

            <div class="modal fade" id="staticQualification" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticQualification" aria-hidden="true">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title text-dark" id="staticQualification"><strong>Add Qualification</strong></h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <i class="fas fa-times"></i>

                            </button>

                        </div>

                        <div class="modal-body text-dark">

                            <form action="settings-addcontents.php" method="POST">

                                <div class="form-group row">

                                    <label for="qualification" class="col-sm-3 col-form-label">Qualification</label>

                                    <div class="col-sm-9">

                                        <input name="qualification" type="text" class="form-control">

                                    </div>

                                </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            <button name="qualification_add" type="submit" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add</button>

                        </div>

                        </form>

                    </div>

                </div>

            </div>

            <!-- Add Qualification Modal Ends -->

            <!-- Add JOB Role Modal Starts -->

            <div class="modal fade" id="staticJOBRole" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticJOBRole" aria-hidden="true">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title text-dark" id="staticJOBRole"><strong>Add JOB Role</strong></h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <i class="fas fa-times"></i>

                            </button>

                        </div>

                        <div class="modal-body text-dark">

                            <form action="settings-addcontents.php" method="POST">

                                <div class="form-group row">

                                    <label for="jobrole" class="col-sm-3 col-form-label">JOB Role</label>

                                    <div class="col-sm-9">

                                        <input name="jobrole" type="text" class="form-control">

                                    </div>

                                </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            <button name="jobrole_add" type="submit" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add</button>

                        </div>

                        </form>

                    </div>

                </div>

            </div>

            <!-- Add JOB Role Modal Ends -->

            <!-- Add Spend For Modal Starts -->

            <div class="modal fade" id="staticSpendFor" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticSpendFor" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="staticSpendFor"><strong>Add Spend For</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body text-dark">
                            <form action="settings-addcontents.php" method="POST">
                                <div class="form-group row">
                                    <label for="jobrole" class="col-sm-3 col-form-label">Spend For</label>
                                    <div class="col-sm-9">
                                        <input name="spendfor" type="text" class="form-control">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="spendfor_add" type="submit" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add</button>
                        </div>

                        </form>

                    </div>

                </div>

            </div>

            <!-- Add Spend For Modal Ends -->

            <!-- Add Invoice Item Modal Starts -->

            <div class="modal fade" id="staticItem" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticItem" aria-hidden="true">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title text-dark" id="staticItem"><strong>Add Invoice Item</strong></h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <i class="fas fa-times"></i>

                            </button>

                        </div>

                        <div class="modal-body text-dark">

                            <form action="settings-addcontents.php" method="POST">

                                <div class="form-group row">

                                    <label for="item" class="col-sm-3 col-form-label">Invoice Item</label>

                                    <div class="col-sm-9">

                                        <input name="item" type="text" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group row">

                                    <label for="description" class="col-sm-3 col-form-label">Item Description</label>

                                    <div class="col-sm-9">

                                        <textarea class="form-control" name="description" cols="30" rows="2"></textarea>

                                    </div>

                                </div>
                                <div class="form-group row">

                                    <label for="price" class="col-sm-3 col-form-label">Item Price</label>

                                    <div class="col-sm-9">

                                        <input name="price" type="number" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group row">

                                    <label for="tax" class="col-sm-3 col-form-label">Tax (in %)</label>

                                    <div class="col-sm-9">

                                        <select class="form-control" name="tax">
                                            <?php getTax($conn);?>
                                        </select>

                                    </div>

                                </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            <button name="item_add" type="submit" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add</button>

                        </div>

                        </form>

                    </div>

                </div>

            </div>

            <!-- Add Invoice Item Modal Ends -->
            <!-- Add Tax Modal Starts -->
            <div class="modal fade" id="staticTax" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticTax" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="staticTax"><strong>Add Tax</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body text-dark">
                            <form action="settings-addcontents.php" method="POST">
                                <div class="form-group row">
                                    <label for="tax" class="col-sm-3 col-form-label">Tax</label>
                                    <div class="col-sm-9">
                                        <input name="tax" type="text" class="form-control">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="tax_add" type="submit" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Add Tax Modal Ends -->
            <!-- Add Buy Interest Modal Starts -->
            <div class="modal fade" id="staticBuyInterest" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBuyInterest" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="staticBuyInterest"><strong>Add Buy Interest</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body text-dark">
                            <form action="settings-addcontents.php" method="POST">
                                <div class="form-group row">
                                    <label for="buy_interest" class="col-sm-3 col-form-label">Buy Interest</label>
                                    <div class="col-sm-9">
                                        <input name="buy_interest" type="text" class="form-control">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="buy_interest_add" type="submit" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Add Buy Interest Modal Ends -->
            <!-- Add Sell Interest Modal Starts -->
            <div class="modal fade" id="staticSellInterest" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticSellInterest" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="staticSellInterest"><strong>Add Sell Interest</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body text-dark">
                            <form action="settings-addcontents.php" method="POST">
                                <div class="form-group row">
                                    <label for="sell_interest" class="col-sm-3 col-form-label">Sell Interest</label>
                                    <div class="col-sm-9">
                                        <input name="sell_interest" type="text" class="form-control">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="sell_interest_add" type="submit" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Add Sell Interest Modal Ends -->
            <!-- Add Industry Type Modal Starts -->
            <div class="modal fade" id="staticIndustryType" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticIndustryType" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="sellInterest"><strong>Add Industry Type</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body text-dark">
                            <form action="settings-addcontents.php" method="POST">
                                <div class="form-group row">
                                    <label for="industry_type" class="col-sm-3 col-form-label">Industry Type</label>
                                    <div class="col-sm-9">
                                        <input name="industry_type" type="text" class="form-control">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="industry_type_add" type="submit" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Add Sell Interest Modal Ends -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>