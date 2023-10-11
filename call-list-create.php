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
                        <h1 class="h3 mb-2 text-gray-800">In/Out Call Details</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Create New Call Entry</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="call-list.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <!-- Video Details Start -->
                            <form action="call-list.php" method="POST">
                                <?php echo'<input type="hidden" name="previous" value="'.$_SERVER['HTTP_REFERER'].'">'?>
                                <div class="form-row">
                                    <!-- Call Type -->
                                    <div class="form-group col-md-2">Call Type
                                        <div class="form-input my-2">
                                            <select name="calltype" class="form-control">
                                                <option value="IN">IN</option>
                                                <option value="OUT">OUT</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Phone Number -->
                                    <div class="form-group col-md-2">Phone Number
                                        <div class="form-input my-2">
                                            <input class="form-control" type="text" name="p_number" id="p_number">
                                        </div>
                                    </div>
                                    <!-- Name -->
                                    <div class="form-group col-md-3">Name
                                        <div class="form-input my-2">
                                            <input class="form-control" type="text" name="p_name" id="p_name">
                                        </div>
                                    </div>
                                    <!-- Job Role -->
                                    <div class="form-group col-md-3">Job Role
                                        <div class="form-input my-2">
                                            <select name="job_role" class="form-control form-select" id="job_role">
                                                <?php
                                                    $sql="SELECT * FROM can_jobrole ORDER BY value ASC";
                                                    $jobroles=mysqli_query($conn,$sql);
                                                    foreach ($jobroles as $jobrole) {
                                                ?>
                                                <?php echo'<option value="'.$jobrole['value'].'">'.$jobrole['value'].'</option>';?>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <!-- Type -->
                                    <div class="form-group col-md-2">Type
                                    <div class="form-input my-2">
                                        <select name="p_type" class="form-control" id="p_type">
                                            <?php
                                                $sql="SELECT * FROM call_type";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($row=mysqli_fetch_array($result)){
                                            ?>
                                            <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                            <?php }}?>
                                        </select>
                                    </div>
                                    </div>
                                    <!-- Status -->
                                    <div class="form-group col-md-2">Status
                                    <div class="form-input my-2">
                                        <select class="form-control" name="status">
                                            <?php
                                                $sql="SELECT * FROM call_status";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($row=mysqli_fetch_array($result)){
                                            ?>
                                            <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                            <?php }}?>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="form-group col-md-4">Location
                                        <div class="form-input my-2">
                                            <input class="form-control" name="location" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="forn-row">
                                    <!-- Call Description -->
                                    <div class="form-group col-md-8">Description
                                        <div class="form-input mb-2 mt-2">
                                            <textarea class="form-control" id="tinymce" name="description" cols="50" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                            <!-- Video Details End -->
                                <button class="btn btn-primary" name="create" type="submit"><i class="fas fa-edit mr-2"></i><strong>Create</strong></button>
                            </form>
                        </div>
                    </div><!-- Main Card End -->
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php
    include('includes/scripts.php');
    include('includes/call-autofill.php');
    include('includes/footer.php');

?>
