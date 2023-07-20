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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-2 text-gray-800">Company Details</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Edit Company Details</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="company.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <?php
                                $edit_data=$_GET['id'];
                                $sql= 'SELECT * FROM company WHERE id='.$edit_data.'';
                                $result = mysqli_query($conn, $sql);
                                    while($rows= mysqli_fetch_array($result)){
                            ?>
                            <!-- Video Details Start -->
                            <form action="company.php" method="POST">
                                    <div class="form-row">
                                        <?php echo'<input type="hidden" name="com_id" value="'.$rows['id'].'">';?>
                                        <?php echo'<input type="hidden" name="previous" value="'.$_SERVER['HTTP_REFERER'].'">'?>
                                        <div class="form-group col-md-3">Company Name
                                            <div class="form-input">
                                                <?php echo'<input class="form-control" type="text" name="com_name" value="'.$rows['name'].'">';?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">Contact Person
                                            <div class="form-input">
                                                <?php echo'<input class="form-control" type="text" name="contact_person" value="'.$rows['contact_person'].'">'?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">Contact Number
                                            <div class="form-input">
                                                <?php echo'<input class="form-control" type="text" name="number" value="'.$rows['number'].'">';?>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">Additional Number
                                            <div class="form-input">
                                                <?php echo'<input class="form-control" type="text" name="add_number" value="'.$rows['add_number'].'">';?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">E-Mail
                                            <div class="form-input">
                                                <?php echo'<input class="form-control" type="email" name="com_email" value="'.$rows['email'].'">';?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">GST No
                                            <div class="form-input">
                                                <?php echo'<input class="form-control" type="text" name="gst_no" value="'.$rows['gst_no'].'">';?>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">Industry Type
                                            <div class="form-input">
                                                <select class="form-control" name="industry_type" id="industry_type">
                                                    <option value="">Select Type</option>
                                                    <?php
                                                        $s='SELECT id,name FROM industry_type WHERE entry_by='.$_SESSION['userRel'].'';
                                                        $se=mysqli_query($conn,$s);
                                                        while($type=mysqli_fetch_array($se)){
                                                            if($rows['industry_type']==$type['id']){
                                                                echo '<option value="'.$type['id'].'" selected>'.$type['name'].'</option>';
                                                            }else{
                                                                echo '<option value="'.$type['id'].'">'.$type['name'].'</option>';
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">Address
                                            <div class="form-input">
                                                <?php echo'<textarea class="form-control" id="tinymce" name="address" cols="30" rows="4">'.$rows['address'].'</textarea>';?>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <button class="btn btn-primary" name="update" type="submit">
                                                <i class="fas fa-edit mr-2"></i>Update
                                            </button>
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
