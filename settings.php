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
                    <?php
                        if(isset($_POST["submit"])){
                            $name=$_POST['com_name'];
                            $address=$_POST['address'];
                            $email=$_POST['email'];
                            $gst_no=$_POST['gst_no'];
                            $number=$_POST['number'];
                            $sql="UPDATE settings SET name='".$name."', address='".$address."', email='".$email."',gst_no='".$gst_no."', number='".$number."' WHERE entry_by = 1";
                            $result=mysqli_query($conn,$sql);
                            echo '<script type="text/javascript">
                                    setTimeout(function(){
                                        swal({
                                            icon:"success",
                                            title:"Success!",
                                            text:"Data Updated Successfully",
                                            button: "Close",
                                        });
                                    },500);
                                </script>';
                        }
                    ?>

                    <!-- All Contents of the page starts from here-->
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs nav-justified card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="settings.php"><strong>General</strong></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logoupload.php"><strong>Manage Logo</strong></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="users.php"><strong>Users</strong></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <?php
                                        $sql="SELECT * FROM settings WHERE entry_by = 1";
                                        $result=mysqli_query($conn,$sql);
                                        while($row=mysqli_fetch_array($result)){
                                    ?>
                                    <form action="settings.php" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <img class="img-fluid px-5 my-3" src="img/undraw_personal_settings.svg" alt="settings">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="com_name"><strong>Company Name</strong></label>
                                                <div class="form-group col-sm-12">
                                                        <?php echo'<input class="form-control" type="text" name="com_name" value="'.$row['name'].'">';?>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="displayLimit"><strong>Company Address</strong></label>
                                                        <?php echo'<input class="form-control" type="text" name="address" value="'.$row['address'].'">';?>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="displayLimit"><strong>E-Mail</strong></label>
                                                        <?php echo'<input class="form-control" type="text" name="email" value="'.$row['email'].'">';?>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="displayLimit"><strong>GST No.</strong></label>
                                                        <?php echo'<input class="form-control" type="text" name="gst_no" value="'.$row['gst_no'].'">';?>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="displayLimit"><strong>Phone Number</strong></label>
                                                        <?php echo'<input class="form-control" type="text" name="number" value="'.$row['number'].'">';?>
                                                </div>
                                                <div class="form-group col-auto">
                                                    <button class="btn btn-primary" name="submit" type="submit"><i class="fas fa-save mr-2"></i>Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>