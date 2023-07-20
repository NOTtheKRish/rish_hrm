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
                        <h1 class="h3 mb-2 text-gray-800">In/Out Call List</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Preview Call Details</h5>
                            <!-- <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="call-list.php"> -->
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="window.location.href=document.referrer">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <?php
                                $view_data=$_GET['id'];
                                $sql= 'SELECT * FROM calls WHERE id='.$view_data.'';
                                $result = mysqli_query($conn, $sql);
                                    while($row= mysqli_fetch_array($result)){
                            ?>
                            <!-- Video Details Start -->
                                    <div class="form-group row">
                                        <label for="call_id" class="col-sm-2 col-form-label">Call ID</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="call_id" value="E-'.$row['id'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="call_type" class="col-sm-2 col-form-label">Call Type</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="call_type" value="'.$row['type'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="number" class="col-sm-2 col-form-label">Phone Number</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="number" value="'.$row['number'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="name" value="'.$row['name'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="call_type" class="col-sm-2 col-form-label">Call Type</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="call_type" value="'.$row['type'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="job_role" class="col-sm-2 col-form-label">Job Role</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="job_role" value="'.$row['job_role'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="call_status" class="col-sm-2 col-form-label">Call Status</label>
                                        <div class="col-sm-10">
                                        <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="call_status" value="'.$row['status'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="location" class="col-sm-2 col-form-label">Location</label>
                                        <div class="col-sm-10">
                                        <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="location" value="'.$row['location'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="gst_no" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <?php echo $row['description']; ?>
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
                                        <?php echo'<a class="btn btn-primary" href="call-list-edit.php?id='.$row['id'].'"><i class="fas fa-edit mr-2"></i>Edit Details</a>';?>
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
