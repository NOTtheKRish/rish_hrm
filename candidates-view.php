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
                        <h1 class="h3 mb-2 text-gray-800">Candidates</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Preview Candidate Details</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="candidates.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>                        
                        <div class="card-body">
                            <?php
                                $view_data=$_GET['id'];
                                $sql= 'SELECT * FROM candidates WHERE id='.$view_data.'';
                                $result = mysqli_query($conn, $sql); 
                                    while($row= mysqli_fetch_array($result)){
                            ?> 
                            <!-- Video Details Start -->
                                    <div class="form-group row">
                                        <label for="can_id" class="col-sm-2 col-form-label">Candidate ID</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="can_id" value="C-'.$row['can_id'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="can_name" class="col-sm-2 col-form-label">Candidate Name</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="can_name" value="'.$row['name'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="can_gender" class="col-sm-2 col-form-label">Gender</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="gender" value="'.$row['gender'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="number" class="col-sm-2 col-form-label">Phone Number</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="number" value="'.$row['number'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="can_email" class="col-sm-2 col-form-label">WhatsApp Number</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="gender" value="'.$row['wp_number'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="can_qualification" class="col-sm-2 col-form-label">E-Mail</label>
                                        <div class="col-sm-10">
                                        <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="gender" value="'.$row['email'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="can_qualification" class="col-sm-2 col-form-label">Qualification</label>
                                        <div class="col-sm-10">
                                        <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="gender" value="'.$row['qualification'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="can_exp" class="col-sm-2 col-form-label">Experience</label>
                                        <div class="col-sm-10">
                                        <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="gender" value="'.$row['experience'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="can_jobrole" class="col-sm-2 col-form-label">JOB Role</label>
                                        <div class="col-sm-10">
                                        <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="gender" value="'.$row['jobrole'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="com_name" class="col-sm-2 col-form-label">Expected JOB</label>
                                        <div class="col-sm-10">
                                        <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="gender" value="'.$row['expected_job'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sent_date" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="sent_date" value="'.$row['address'].'"></td>';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="com_name" class="col-sm-2 col-form-label">Interested Location</label>
                                        <div class="col-sm-10">
                                        <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="gender" value="'.$row['location_interest'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="com_name" class="col-sm-2 col-form-label">Current Salary</label>
                                        <div class="col-sm-10">
                                        <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="gender" value="'.$row['salary_current'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="com_name" class="col-sm-2 col-form-label">Expected Salary</label>
                                        <div class="col-sm-10">
                                        <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="gender" value="'.$row['salary_expect'].'">';?>
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
                                        <?php echo'<a class="btn btn-primary" href="candidates-edit.php?id='.$row['id'].'"><i class="fas fa-edit mr-2"></i>Edit Details</a>';?>
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