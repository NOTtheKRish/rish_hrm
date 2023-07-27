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
                        <h1 class="h3 mb-2 text-gray-800">JOB Vacancy</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Preview JOB Vacancy Details</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="vacancy.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>                        
                        <div class="card-body">
                            <?php
                                $view_data=$_GET['id'];
                                $sql= 'SELECT * FROM jobs WHERE id='.$view_data.'';
                                $result = mysqli_query($conn, $sql); 
                                    while($row= mysqli_fetch_array($result)){
                            ?> 
                            <!-- Video Details Start -->
                                    <div class="form-group row">
                                        <label for="job_id" class="col-sm-2 col-form-label">JOB ID</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="job_id" value="J-'.$row['job_id'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="com_name" class="col-sm-2 col-form-label">Company Name</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="com_name" value="'.$row['com_name'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jobrole" class="col-sm-2 col-form-label">Job Role</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="jobrole" value="'.$row['job_role'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="job_desc" class="col-sm-2 col-form-label">Job Description</label>
                                        <div class="col-sm-10">
                                            <?php echo'<textarea style="color:#000;" class="form-control-plaintext" name="job_desc" cols="30" rows="3">'.$row['job_desc'].'</textarea>'?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="skills_need" class="col-sm-2 col-form-label">Skills Need</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="skills_need" value="'.$row['skills_need'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="gender" value="'.$row['gender'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="qualification" class="col-sm-2 col-form-label">Qualification</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="qualification" value="'.$row['qualification'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="experience" class="col-sm-2 col-form-label">Experience</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="experience" value="'.$row['experience'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="salary" class="col-sm-2 col-form-label">Salary (From)</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="salary" value="'.$row['salary'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="salary" class="col-sm-2 col-form-label">Salary (To)</label>
                                        <div class="col-sm-10">
                                            <?php echo'<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="salary_max" value="'.$row['salary_max'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="extra_allowance" class="col-sm-2 col-form-label">Extra Allowance</label>
                                        <div class="col-sm-10">
                                            <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="extra_allowance" value="'.$row['extra_allowance'].'"></td>';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-2 col-form-label">Vacancy Status</label>
                                        <div class="col-sm-10">
                                            <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="status" value="'.$row['status'].'"></td>';?>
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
                                        <?php echo'<a class="btn btn-primary" href="vacancy-edit.php?id='.$row['id'].'"><i class="fas fa-edit mr-2"></i>Update Status</a>';?>
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