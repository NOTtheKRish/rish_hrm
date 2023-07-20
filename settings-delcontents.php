<?php
include('session.php');
include('includes/header.php');
include('includes/navbar.php');
include_once('includes/dbconfig.php');
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
                                <li class="nav-item">
                                    <a class="nav-link" href="users.php"><strong>Users</strong></a>
                                </li>
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
                                <?php
                                    if(isset($_GET['qual'])){
                                        $del_data=$_GET['qual'];
                                        // For Qualification Edit
                                        echo'<div class="col-md-12">
                                            <div class="card card-body" style="text-align: -webkit-center;">
                                                <form action="settings-addcontents.php" method="POST">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label style="color:#000" for="qualification"><strong>Delete Qualification</strong></label>
                                                            <input class="form-control col-md-4" hidden type="text" name="qual_id" value="'.$del_data.'"></input>
                                                            <h5 class="mt-3 mb-3">Are you sure to Delete this Data??</h5>
                                                            <button class="btn btn-danger mt-2" name="qualification_del" type="submit"><i class="fas fa-trash mr-2"></i>Delete</button>
                                                            <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>';
                                        }
                                    if(isset($_GET['jobrole'])){
                                        $del_data=$_GET['jobrole'];
                                        // For JOB Role Edit
                                            echo'<div class="col-md-12">
                                                <div class="card card-body" style="text-align: -webkit-center;">
                                                    <form action="settings-addcontents.php" method="POST">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label style="color:#000" for="jobrole"><strong>Delete JOB Role</strong></label>
                                                                <input class="form-control col-md-4" hidden type="text" name="jobrole_id" value="'.$del_data.'"></input>
                                                                <h5 class="mt-3 mb-3">Are you sure to Delete this Data??</h5>
                                                                <button class="btn btn-danger mt-2" name="jobrole_del" type="submit"><i class="fas fa-trash mr-2"></i>Delete</button>
                                                                <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                    if(isset($_GET['spendfor'])){
                                        $del_data=$_GET['spendfor'];
                                        // For Spend For Edit
                                            echo'<div class="col-md-12">
                                                <div class="card card-body" style="text-align: -webkit-center;">
                                                    <form action="settings-addcontents.php" method="POST">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label style="color:#000" for="spendfor"><strong>Delete Spending For</strong></label>
                                                                <input class="form-control col-md-4" hidden type="text" name="spendfor_id" value="'.$del_data.'"></input>
                                                                <h5 class="mt-3 mb-3">Are you sure to Delete this Data??</h5>
                                                                <button class="btn btn-danger mt-2" name="spendfor_del" type="submit"><i class="fas fa-trash mr-2"></i>Delete</button>
                                                                <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                    if(isset($_GET['items'])){
                                        $del_data=$_GET['items'];
                                        // For Invoice Item Edit
                                            echo'<div class="col-md-12">
                                                <div class="card card-body" style="text-align: -webkit-center;">
                                                    <form action="settings-addcontents.php" method="POST">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label style="color:#000" for="items"><strong>Delete Invoice Item</strong></label>
                                                                <input class="form-control col-md-4" hidden type="text" name="item_id" value="'.$del_data.'"></input>
                                                                <h5 class="mt-3 mb-3">Are you sure to Delete this Data??</h5>
                                                                <button class="btn btn-danger mt-2" name="item_del" type="submit"><i class="fas fa-trash mr-2"></i>Delete</button>
                                                                <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                    if(isset($_GET['tax'])){
                                        $del_data=$_GET['tax'];
                                        // For Tax Edit
                                            echo'<div class="col-md-12">
                                                <div class="card card-body" style="text-align: -webkit-center;">
                                                    <form action="settings-addcontents.php" method="POST">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label style="color:#000" for="tax"><strong>Delete Tax</strong></label>
                                                                <input class="form-control col-md-4" hidden type="text" name="tax_id" value="'.$del_data.'"></input>
                                                                <h5 class="mt-3 mb-3">Are you sure to Delete this Data??</h5>
                                                                <button class="btn btn-danger mt-2" name="tax_del" type="submit"><i class="fas fa-trash mr-2"></i>Delete</button>
                                                                <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                    if(isset($_GET['buyInterest'])){
                                        $del_data=$_GET['buyInterest'];
                                        // For Tax Edit
                                            echo'<div class="col-md-12">
                                                <div class="card card-body" style="text-align: -webkit-center;">
                                                    <form action="settings-addcontents.php" method="POST">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label style="color:#000" for="tax"><strong>Delete Buy Interest</strong></label>
                                                                <input class="form-control col-md-4" hidden type="text" name="id" value="'.$del_data.'"></input>
                                                                <h5 class="mt-3 mb-3">Are you sure to Delete this Data??</h5>
                                                                <button class="btn btn-danger mt-2" name="buy_interest_del" type="submit"><i class="fas fa-trash mr-2"></i>Delete</button>
                                                                <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                    if(isset($_GET['sellInterest'])){
                                        $del_data=$_GET['sellInterest'];
                                        // For Tax Edit
                                            echo'<div class="col-md-12">
                                                <div class="card card-body" style="text-align: -webkit-center;">
                                                    <form action="settings-addcontents.php" method="POST">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label style="color:#000" for="tax"><strong>Delete Sell Interest</strong></label>
                                                                <input class="form-control col-md-4" hidden type="text" name="id" value="'.$del_data.'"></input>
                                                                <h5 class="mt-3 mb-3">Are you sure to Delete this Data??</h5>
                                                                <button class="btn btn-danger mt-2" name="sell_interest_del" type="submit"><i class="fas fa-trash mr-2"></i>Delete</button>
                                                                <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                    if(isset($_GET['industry_type'])){
                                        $del_data=$_GET['industry_type'];
                                        // For Industry Type Delete
                                            echo'<div class="col-md-12">
                                                <div class="card card-body" style="text-align: -webkit-center;">
                                                    <form action="settings-addcontents.php" method="POST">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label style="color:#000" for="tax"><strong>Delete Industry Type</strong></label>
                                                                <input class="form-control col-md-4" hidden type="text" name="id" value="'.$del_data.'"></input>
                                                                <h5 class="mt-3 mb-3">Are you sure to Delete this Data??</h5>
                                                                <button class="btn btn-danger mt-2" name="industry_type_del" type="submit"><i class="fas fa-trash mr-2"></i>Delete</button>
                                                                <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                ?>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php
    include('includes/scripts.php');
?>