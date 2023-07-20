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
                            <h5 class="m-0 font-weight-bold text-primary">Edit Details</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="call-list.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <?php
                                $edit_data=$_GET['id'];
                                $sql= 'SELECT * FROM calls WHERE id='.$edit_data.'';
                                $result = mysqli_query($conn, $sql);
                                    while($row= mysqli_fetch_array($result)){
                            ?>

                            <!-- Video Details Start -->
                            <form action="call-list.php" method="POST">
                                <div class="form-row">
                                    <!-- Call ID -->
                                    <div class="form-group col-md-2 ml-2 mr-2">Call ID
                                        <div class="form-input mb-2 mt-2">
                                            <?php echo'<input class="form-control" type="text" name="call_id" value="'.$row['id'].'" readonly>';?>
                                            <?php echo'<input type="hidden" name="previous" value="'.$_SERVER['HTTP_REFERER'].'">'?>
                                        </div>
                                    </div>
                                    <!-- Call Type -->
                                    <div class="form-group col-md-2">Call Type
                                        <div class="form-input my-2">
                                            <select class="form-control" name="calltype">
                                                <option value="">Select Call Type</option>
                                                <?php
                                                    if($row['calltype']=="IN"){
                                                ?>
                                                    <option value="IN" selected>IN</option>
                                                    <option value="OUT">OUT</option>
                                                <?php
                                                    }elseif($row['calltype']=="OUT"){
                                                ?>
                                                        <option value="IN">IN</option>
                                                        <option value="OUT" selected>OUT</option>
                                                <?php
                                                    }else{
                                                ?>
                                                        <option value="IN">IN</option>
                                                        <option value="OUT">OUT</option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Phone Number -->
                                    <div class="form-group col-md-2">Phone Number
                                        <div class="form-input my-2">
                                            <?php echo'<input class="form-control" type="text" name="phone_number" value="'.$row['number'].'">';?>
                                        </div>
                                    </div>
                                    <!-- Name -->
                                    <div class="form-group col-md-3">Name
                                        <div class="form-input my-2">
                                            <?php echo'<input class="form-control" type="text" name="person_name" value="'.$row['name'].'">';?>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <!-- Type -->
                                    <div class="form-group col-md-2">Type
                                    <div class="form-input my-2">
                                        <select name="call_type" class="form-control">
                                            <?php echo'<option value="'.$row['type'].'">'.$row['type'].'</option>';?>
                                            <option value="">Select Type</option>
                                            <?php
                                                $sql="SELECT * FROM call_type";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($rows=mysqli_fetch_array($result)){
                                            ?>
                                            <?php echo'<option value="'.$rows['value'].'">'.$rows['value'].'</option>';?>
                                            <?php }}?>
                                        </select>
                                    </div>
                                    </div>
                                    <!-- Status -->
                                    <div class="form-group col-md-2">Status
                                    <div class="form-input my-2">
                                        <select class="form-control" name="call_status">
                                            <?php
                                                $sql="SELECT * FROM call_status";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($rows=mysqli_fetch_array($result)){
                                            ?>
                                            <?php
                                                if($rows['value']==$row['status']){
                                                    echo'<option value="'.$rows['value'].'" selected>'.$rows['value'].'</option>';
                                                }else{
                                                    echo'<option value="'.$rows['value'].'">'.$rows['value'].'</option>';
                                                }
                                            ?>
                                            <?php }}?>
                                        </select>
                                    </div>
                                    </div>
                                    <!-- Job Role -->
                                    <div class="form-group col-md-3">Job Role
                                        <div class="form-input my-2">
                                            <select class="form-control" name="job_role">
                                                <option value="">Select Job Role</option>
                                                <?php
                                                    $sql="SELECT * FROM can_jobrole";
                                                    $jobroles=mysqli_query($conn,$sql);
                                                    foreach($jobroles as $jobrole){
                                                ?>
                                                <?php 
                                                    if($row['job_role']==$jobrole['value']){
                                                        echo'<option value="'.$jobrole['value'].'" selected>'.$jobrole['value'].'</option>';
                                                    }else{
                                                        echo'<option value="'.$jobrole['value'].'">'.$jobrole['value'].'</option>';
                                                    }
                                                ?>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">Location
                                        <div class="form-input my-2">
                                            <input class="form-control" name="location" type="text" value="<?php echo $row['location']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <!-- Call Description -->
                                    <div class="form-group col-md-8">Description
                                        <div class="form-input mb-2 mt-2">
                                            <?php echo'<textarea class="form-control" id="tinymce" name="call_description" cols="50" rows="2">'.$row['description'].'</textarea>';?>
                                        </div>
                                    </div>
                                </div>
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
