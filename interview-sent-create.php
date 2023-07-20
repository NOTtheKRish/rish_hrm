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
                        <h1 class="h3 mb-2 text-gray-800">Interview Sent Details</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Create New Interview Sent</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="interview-sent.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <!-- Video Details Start -->
                            <form action="interview-sent.php" method="POST">
                                <div class="form-row">
                                    <?php echo'<input type="hidden" name="previous" value="'.$_SERVER['HTTP_REFERER'].'">'?>
                                <div class="form-group col-md-3">Candidate ID
                                    <div class="form-input">
                                        <select name="can_id" class="form-control">
                                            <?php
                                                $userRel=$_SESSION['userRel'];
                                                $sql="SELECT * FROM candidates WHERE entry_by='".$userRel."'";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($row=mysqli_fetch_array($result)){
                                            ?>
                                            <?php echo'<option value="'.$row['id'].'">C-'.$row['can_id'].'-'.$row['name'].'</option>';?>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">JOB ID
                                    <div class="form-input">
                                        <select name="job_id" class="form-control">
                                            <?php
                                                $sql="SELECT * FROM jobs WHERE entry_by='".$userRel."'";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($row=mysqli_fetch_array($result)){
                                            ?>
                                            <?php echo'<option value="'.$row['id'].'">J-'.$row['job_id'].'-'.$row['job_role'].'</option>';?>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">Interview Sent Date
                                    <div class="form-input">
                                        <input class="form-control" type="date" name="sent_date">
                                    </div>
                                </div>
                                <div class="form-group col-md-3">Status
                                    <div class="form-input">
                                        <select name="sent_status" class="form-control">
                                            <?php
                                                $sql="SELECT * FROM sent_status";
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
                                <div class="form-group col-md-4">Description
                                    <textarea class="form-control" name="description" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="form-group">
                                    <button class="btn btn-primary" name="create" type="submit">
                                        <i class="fas fa-plus mr-2"></i>Create
                                    </button>
                                </div>
                            </div>
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
