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
                        <h1 class="h3 mb-2 text-gray-800">Company</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Preview Company Details</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="company.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <?php
                                $view_data = $_GET['id'];
                                $sql = 'SELECT * FROM company WHERE id='.$view_data.'';
                                $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_array($result)){
                            ?>
                            <!-- Video Details Start -->
                                    <div class="form-group row">
                                        <label for="com_id" class="col-sm-2 col-form-label">Company ID</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="com_id" value="E-'.$row['com_id'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="com_name" class="col-sm-2 col-form-label">Company Name</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="com_name" value="'.$row['name'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="industry_type" class="col-sm-2 col-form-label">Industry Type</label>
                                        <div class="col-sm-10">
                                            <?php
                                                $s='SELECT name FROM industry_type WHERE id="'.$row['industry_type'].'"';
                                                $se=mysqli_query($conn,$s);
                                                while($type=mysqli_fetch_array($se)){
                                                    echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="industry_type" value="'.$type['name'].'">';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="contact_person" class="col-sm-2 col-form-label">Contact Person</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="contact_person" value="'.$row['contact_person'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="number" class="col-sm-2 col-form-label">Contact Number</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="number" value="'.$row['number'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="add_number" class="col-sm-2 col-form-label">Additional Number</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="add_number" value="'.$row['add_number'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">E-Mail</label>
                                        <div class="col-sm-10">
                                        <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="email" value="'.$row['email'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="gst" class="col-sm-2 col-form-label">GST Number</label>
                                        <div class="col-sm-10">
                                        <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="gst_no" value="'.$row['gst_no'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <?php echo $row['address']; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                    <?php
                                            if($_SESSION['id']=="1"){
                                                $entry=$row['user_id'];
                                                if($entry==NULL){
                                                    echo '';
                                                }else{
                                                $sq="SELECT name FROM accounts WHERE id='".$entry."'";
                                                    $res=mysqli_query($conn,$sq);
                                                    if(mysqli_num_rows($res)>0){
                                                        while($rows=mysqli_fetch_array($res)){
                                                        echo'<label for="entry_by" class="col-sm-2 col-form-label">Entry By</label>
                                                            <div class="col-sm-10">
                                                            <input style="color:#000;" type="text" readonly class="form-control-plaintext" name="entry_by" value="'.$rows['name'].'">
                                                            </div>';
                                                            }
                                                    }
                                                }
                                            }else{
                                                echo '';
                                            }
                                        ?>

                                    </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <?php echo'<a class="btn btn-primary" href="company-edit.php?id='.$row['id'].'"><i class="fas fa-edit mr-2"></i>Edit Details</a>';?>
                                    </div>
                                </div>
                                <?php }?>
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
