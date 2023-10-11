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
                        <h1 class="h3 mb-2 text-gray-800">Candidate Details</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Edit Details</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="candidates.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <?php
                                $edit_data=$_GET['id'];
                                $sql= 'SELECT * FROM candidates WHERE id='.$edit_data.'';
                                $result = mysqli_query($conn, $sql);
                                    while($rows= mysqli_fetch_array($result)){
                            ?>

                            <!-- Video Details Start -->
                            <form action="candidates.php" method="POST">
                                <div class="form-row">
                                    <!-- Can ID -->
                                        <?php echo'<input class="form-control" type="text" name="can_id" value="'.$rows['id'].'" hidden>';?>
                                        <?php echo'<input type="hidden" name="previous" value="'.$_SERVER['HTTP_REFERER'].'">'?>
                                    <!-- Can Name -->
                                    <div class="form-group col-md-2">Candidate Name
                                        <div class="form-input my-2">
                                            <?php echo'<input class="form-control" type="text" name="can_name" value="'.$rows['name'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">Gender
                                        <div class="form-input my-2">
                                            <select name="gender" class="form-control">
                                            <?php echo'<option value="'.$rows['gender'].'">'.$rows['gender'].'</option>';?>
                                            <option value="">Select Gender</option>
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
                                    <!-- Phone Number -->
                                    <div class="form-group col-md-2">Phone Number
                                        <div class="form-input my-2">
                                            <?php echo'<input class="form-control" type="text" name="can_number" value="'.$rows['number'].'">';?>
                                        </div>
                                    </div>
                                    <!-- Name -->
                                    <div class="form-group col-md-3">WhatsApp Number
                                        <div class="form-input my-2">
                                            <?php echo'<input class="form-control" type="text" name="wp_number" value="'.$rows['wp_number'].'">';?>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">E-Mail
                                        <div class="form-input">
                                            <?php echo'<input class="form-control" type="email" name="email" value="'.$rows['email'].'">';?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">Qualification
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
                                <div class="form-group col-md-3">Experience
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
                            </div><br>
                            <div class="form-row">
                                <div class="form-group col-md-4">Job Role
                                    <div class="form-input">
                                        <select class="form-control" name="jobrole">
                                            <?php echo'<option value="'.$rows['jobrole'].'">'.$rows['jobrole'].'</option>';?>
                                            <option value="">Select Job Role</option>
                                            <?php
                                                $sql="SELECT * FROM can_jobrole ORDER BY value ASC";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($row=mysqli_fetch_array($result)){
                                            ?>
                                            <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">Expected Job
                                    <div class="form-input">
                                        <select name="expected_job" class="form-control">
                                            <?php echo'<option value="'.$rows['expected_job'].'">'.$rows['expected_job'].'</option>';?>
                                            <option value="">Select Expected Job</option>
                                        <?php
                                            $sql="SELECT * FROM can_jobexpect ORDER BY value ASC";
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
                                <div class="form-group col-md-6">Address
                                    <div class="form-input">
                                        <?php echo'<textarea class="form-control" name="address" cols="30" rows="4">'.$rows['address'].'</textarea>';?>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">Interested Location
                                    <div class="form-input">
                                        <?php echo'<input class="form-control" type="text" name="location_interest" value="'.$rows['location_interest'].'">';?>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">Current Salary
                                    <div class="form-input">
                                        <?php echo'<input class="form-control" type="text" name="salary_current" value="'.$rows['salary_current'].'">';?>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">Expected Salary
                                    <div class="form-input">
                                        <?php echo'<input class="form-control" type="text" name="salary_expect" value="'.$rows['salary_expect'].'">';?>
                                    </div>
                                </div>
                            </div><br>
                            <!-- Video Details End -->
                                <button class="btn btn-primary" name="update" type="submit"><i class="fas fa-edit mr-2"></i><strong>Update</strong></button>
                            </form>
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
