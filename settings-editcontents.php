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
                                        $edit_data=$_GET['qual'];
                                        $sql='SELECT id,value FROM can_qualification WHERE id='.$edit_data.'';
                                        $result=mysqli_query($conn,$sql); 
                                            while($row=mysqli_fetch_array($result)){
                                        // For Qualification Edit
                                        echo'<div class="col-md-12">
                                            <div class="card card-body" style="text-align: -webkit-center;">
                                                <form action="settings-addcontents.php" method="POST">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label style="color:#000" for="qualification"><strong>Edit Qualification</strong></label>
                                                            <input class="form-control col-md-4" hidden type="text" name="qual_id" value="'.$edit_data.'"></input>
                                                            <input class="form-control col-md-4 justify-content-center" type="text" name="qualification" value="'.$row['value'].'">
                                                            <button class="btn btn-primary mt-2" name="qualification_edit" type="submit"><i class="fas fa-pen mr-2"></i>Save</button>
                                                            <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>';
                                        }
                                    }
                                    if(isset($_GET['jobrole'])){
                                        $edit_data=$_GET['jobrole'];
                                        $sql='SELECT id,value FROM can_jobrole WHERE id='.$edit_data.'';
                                        $result=mysqli_query($conn,$sql); 
                                            while($row=mysqli_fetch_array($result)){
                                        // For JOB Role Edit
                                            echo'<div class="col-md-12">
                                                <div class="card card-body" style="text-align: -webkit-center;">
                                                    <form action="settings-addcontents.php" method="POST">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label style="color:#000" for="jobrole"><strong>Edit JOB Role</strong></label>
                                                                <input class="form-control col-md-4" hidden type="text" name="jobrole_id" value="'.$edit_data.'"></input>
                                                                <input class="form-control col-md-4" type="text" name="jobrole" value="'.$row['value'].'">
                                                                <button class="btn btn-primary mt-2" name="jobrole_edit" type="submit"><i class="fas fa-pen mr-2"></i>Save</button>
                                                                <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                    }
                                    if(isset($_GET['spendfor'])){
                                        $edit_data=$_GET['spendfor'];
                                        $sql='SELECT id,value FROM expenses_spendfor WHERE id='.$edit_data.'';
                                        $result=mysqli_query($conn,$sql); 
                                            while($row=mysqli_fetch_array($result)){
                                        // For Spend For Edit
                                            echo'<div class="col-md-12">
                                                <div class="card card-body" style="text-align: -webkit-center;">
                                                    <form action="settings-addcontents.php" method="POST">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label style="color:#000" for="jobrole"><strong>Edit Spend For</strong></label>
                                                                <input class="form-control col-md-4" hidden type="text" name="spendfor_id" value="'.$edit_data.'"></input>
                                                                <input class="form-control col-md-4" type="text" name="spendfor" value="'.$row['value'].'">
                                                                <button class="btn btn-primary mt-2" name="spendfor_edit" type="submit"><i class="fas fa-pen mr-2"></i>Save</button>
                                                                <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                    }
                                    if(isset($_GET['items'])){
                                        $edit_data=$_GET['items'];
                                        $sql='SELECT id,value,description,price,tax FROM items WHERE id='.$edit_data.'';
                                        $result=mysqli_query($conn,$sql); 
                                            while($row=mysqli_fetch_array($result)){
                                        // For Invoice Item Edit
                                            echo'<div class="col-md-12">
                                                <div class="card card-body" style="text-align: -webkit-center;">
                                                    <form action="settings-addcontents.php" method="POST">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label style="color:#000" for="items"><strong>Edit Invoice Item</strong></label><br>
                                                                <input class="form-control col-md-4" hidden type="text" name="item_id" value="'.$edit_data.'"></input>
                                                                <label class="my-2" for="item">Item</label>
                                                                <input class="form-control col-md-4 my-2" type="text" name="item" value="'.$row['value'].'">
                                                                <label class="my-2" for="description">Description</label>
                                                                <textarea class="form-control col-md-4" name="description" cols="30" rows="2">'.$row['description'].'</textarea>
                                                                <label class="my-2" for="price">Price</label>
                                                                <input class="form-control col-md-4 my-2" type="number" name="price" value="'.$row['price'].'">
                                                                <label class="my-2" for="tax">Tax (in %)</label>
                                                                <input class="form-control col-md-4 my-2" type="number" name="tax" value="'.$row['tax'].'">
                                                                <button class="btn btn-primary mt-2" name="item_edit" type="submit"><i class="fas fa-pen mr-2"></i>Save</button>
                                                                <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                    }
                                    if(isset($_GET['tax'])){
                                        $edit_data=$_GET['tax'];
                                        $sql='SELECT id,tax_percent FROM tax WHERE id='.$edit_data.'';
                                        $result=mysqli_query($conn,$sql); 
                                            while($row=mysqli_fetch_array($result)){
                                        // For Tax Edit
                                            echo'<div class="col-md-12">
                                                <div class="card card-body" style="text-align: -webkit-center;">
                                                    <form action="settings-addcontents.php" method="POST">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label style="color:#000" for="tax"><strong>Edit Tax</strong></label>
                                                                <input class="form-control col-md-4" hidden type="text" name="tax_id" value="'.$edit_data.'"></input>
                                                                <input class="form-control col-md-4" type="text" name="tax" value="'.$row['tax_percent'].'">
                                                                <button class="btn btn-primary mt-2" name="tax_edit" type="submit"><i class="fas fa-pen mr-2"></i>Save</button>
                                                                <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                    }
                                    if(isset($_GET['buyInterest'])){
                                        $edit_data=$_GET['buyInterest'];
                                        $sql='SELECT id,name FROM interest_buy WHERE id='.$edit_data.'';
                                        $result=mysqli_query($conn,$sql); 
                                            while($row=mysqli_fetch_array($result)){
                                        // For Buy Interest Edit
                                            echo'<div class="col-md-12">
                                                <div class="card card-body" style="text-align: -webkit-center;">
                                                    <form action="settings-addcontents.php" method="POST">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label style="color:#000" for="tax"><strong>Edit Buy Interest</strong></label>
                                                                <input class="form-control col-md-4" hidden type="text" name="id" value="'.$edit_data.'"></input>
                                                                <input class="form-control col-md-4" type="text" name="buy_interest" value="'.$row['name'].'">
                                                                <button class="btn btn-primary mt-2" name="buy_interest_edit" type="submit"><i class="fas fa-pen mr-2"></i>Save</button>
                                                                <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                    }
                                    if(isset($_GET['sellInterest'])){
                                        $edit_data=$_GET['sellInterest'];
                                        $sql='SELECT id,name FROM interest_sell WHERE id='.$edit_data.'';
                                        $result=mysqli_query($conn,$sql); 
                                            while($row=mysqli_fetch_array($result)){
                                        // For Sell Interest Edit
                                            echo'<div class="col-md-12">
                                                <div class="card card-body" style="text-align: -webkit-center;">
                                                    <form action="settings-addcontents.php" method="POST">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label style="color:#000" for="tax"><strong>Edit Sell Interest</strong></label>
                                                                <input class="form-control col-md-4" hidden type="text" name="id" value="'.$edit_data.'"></input>
                                                                <input class="form-control col-md-4" type="text" name="sell_interest" value="'.$row['name'].'">
                                                                <button class="btn btn-primary mt-2" name="sell_interest_edit" type="submit"><i class="fas fa-pen mr-2"></i>Save</button>
                                                                <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                    }
                                    if(isset($_GET['industry_type'])){
                                        $edit_data=$_GET['industry_type'];
                                        $sql='SELECT id,name FROM industry_type WHERE id='.$edit_data.'';
                                        $result=mysqli_query($conn,$sql); 
                                            while($row=mysqli_fetch_array($result)){
                                        // For Sell Interest Edit
                                            echo'<div class="col-md-12">
                                                <div class="card card-body" style="text-align: -webkit-center;">
                                                    <form action="settings-addcontents.php" method="POST">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label style="color:#000" for="tax"><strong>Edit Industry Type</strong></label>
                                                                <input class="form-control col-md-4" hidden type="text" name="id" value="'.$edit_data.'"></input>
                                                                <input class="form-control col-md-4" type="text" name="industry_type" value="'.$row['name'].'">
                                                                <button class="btn btn-primary mt-2" name="industry_type_edit" type="submit"><i class="fas fa-pen mr-2"></i>Save</button>
                                                                <a href="settings-addcontents.php" class="btn btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Go back</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                        }
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