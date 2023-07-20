<?php
include('session.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/packageCheck.php');
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
                            <h5 class="m-0 font-weight-bold text-primary">Edit JOB Vacancy</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="vacancy.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <?php
                                $edit_data=$_GET['id'];
                                $sql= 'SELECT * FROM jobs WHERE id='.$edit_data.'';
                                $result = mysqli_query($conn, $sql);
                                    while($rows= mysqli_fetch_array($result)){
                            ?>
                            <!-- Video Details Start -->
                            <form action="vacancy.php" method="POST">
                                <div class="form-row">
                                    <?php echo'<input type="hidden" name="job_id" value="'.$_GET['id'].'">'?>
                                    <?php echo'<input type="hidden" name="previous" value="'.$_SERVER['HTTP_REFERER'].'">'?>
                                    <div class="form-group col-md-3">Company Name
                                        <div class="form-input">
                                            <?php echo'<input class="form-control" type="text" name="com_name" value="'.$rows['com_name'].'">'?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">JOB Role
                                        <div class="form-input">
                                            <select class="form-control" name="job_role">
                                                <?php echo'<option value="'.$rows['job_role'].'">'.$rows['job_role'].'</option>';?>
                                                <option value="">Select Job Role</option>
                                                <?php
                                                    $sql="SELECT * FROM can_jobrole";
                                                    $result=mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($result)>0){
                                                    while($row=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Number of Vacancy
                                        <div class="form-input">
                                            <?php echo'<input class="form-control" type="number" min="1" name="openings" value="'.$rows['openings'].'">';?>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md-5">JOB Description
                                        <div class="form-input">
                                            <?php echo'<textarea class="form-control" name="job_desc" cols="30" rows="3">'.$rows['job_desc'].'</textarea>';?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">Skills Need
                                        <div class="form-input">
                                            <?php echo'<input class="form-control" type="text" name="skills_need" value="'.$rows['skills_need'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Gender
                                        <div class="form-input">
                                            <select name="gender" class="form-control">
                                            <?php echo'<option value="'.$rows['gender'].'">'.$rows['gender'].'</option>';?>
                                            <option value="">Select Qualification</option>
                                            <?php
                                                $sql="SELECT * FROM can_gender";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($row=mysqli_fetch_array($result)){
                                            ?>
                                            <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                            <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md-4">Qualification
                                        <div class="form-input">
                                            <select name="qualification" class="form-control">
                                                <?php echo'<option value="'.$rows['qualification'].'">'.$rows['qualification'].'</option>';?>
                                                <option value="">Select Qualification</option>
                                                <?php
                                                    $sql="SELECT * FROM can_qualification";
                                                    $result=mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($result)>0){
                                                    while($row=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">Experience
                                        <div class="form-input">
                                            <select name="experience" class="form-control">
                                                <?php echo'<option value="'.$rows['experience'].'">'.$rows['experience'].'</option>';?>
                                                <option value="">Select Experience</option>
                                                <?php
                                                    $sql="SELECT * FROM can_exp";
                                                    $result=mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($result)>0){
                                                    while($row=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Extra Allowance
                                        <div class="form-input">
                                            <?php echo'<textarea class="form-control" name="extra_allowance" cols="30" rows="3">'.$rows['extra_allowance'].'</textarea>';?>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md-3">Salary (From)
                                        <div class="form-input">
                                            <?php echo'<input class="form-control" type="number" name="salary" value="'.$rows['salary'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Salary (To)
                                        <div class="form-input">
                                            <?php echo'<input class="form-control" type="number" name="salary_max" value="'.$rows['salary_max'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Vacancy Status
                                        <div class="form-input">
                                            <select name="status"class="form-control">
                                                <?php
                                                    $sql="SELECT * FROM jobs_status";
                                                    $result=mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($result)>0){
                                                    while($row=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
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
