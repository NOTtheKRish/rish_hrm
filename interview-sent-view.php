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
                        <h1 class="h3 mb-2 text-gray-800">Interview Sent</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card shadow mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Preview Interview Sent Details</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="interview-sent.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>                        
                        <div class="card-body">
                            <?php
                                $view_data=$_GET['id'];
                                $sql= 'SELECT * FROM interview_sent WHERE id='.$view_data.'';
                                $result = mysqli_query($conn, $sql); 
                                    while($row= mysqli_fetch_array($result)){
                                        $sen=date_create($row['sent_date']);
                                        // Changing Date Format to display as 19 Dec 2003 04:00 PM
                                        $sent=date_format($sen,"d M Y");
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
                                            <?php
                                                $can_id=$row['can_id'];
                                                $sql="SELECT * FROM candidates WHERE id='".$can_id."'";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($rows=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="can_name" value="'.$rows['name'].'"></td>';?>
                                            <?php }}?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="can_number" class="col-sm-2 col-form-label">Phone Number</label>
                                        <div class="col-sm-10">
                                            <?php
                                                $can_id=$row['can_id'];
                                                $sql="SELECT * FROM candidates WHERE id='".$can_id."'";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($rows=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="can_number" value="'.$rows['number'].'"></td>';?>
                                            <?php }}?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="can_wp" class="col-sm-2 col-form-label">WhatsApp Number</label>
                                        <div class="col-sm-10">
                                            <?php
                                                $can_id=$row['can_id'];
                                                $sql="SELECT * FROM candidates WHERE id='".$can_id."'";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($rows=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="can_wp" value="'.$rows['wp_number'].'"></td>';?>
                                            <?php }}?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="can_email" class="col-sm-2 col-form-label">E-Mail</label>
                                        <div class="col-sm-10">
                                            <?php
                                                $can_id=$row['can_id'];
                                                $sql="SELECT * FROM candidates WHERE id='".$can_id."'";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($rows=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo '<input style="color:#000;" type="email" readonly class="form-control-plaintext" name="can_email" value="'.$rows['email'].'"></td>';?>
                                            <?php }}?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="can_qualification" class="col-sm-2 col-form-label">Qualification</label>
                                        <div class="col-sm-10">
                                            <?php
                                                $can_id=$row['can_id'];
                                                $sql="SELECT * FROM candidates WHERE id='".$can_id."'";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($rows=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="can_qualification" value="'.$rows['qualification'].'"></td>';?>
                                            <?php }}?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="can_exp" class="col-sm-2 col-form-label">Experience</label>
                                        <div class="col-sm-10">
                                            <?php
                                                $can_id=$row['can_id'];
                                                $sql="SELECT * FROM candidates WHERE id='".$can_id."'";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($rows=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="can_exp" value="'.$rows['experience'].'"></td>';?>
                                            <?php }}?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="can_jobrole" class="col-sm-2 col-form-label">Job Role</label>
                                        <div class="col-sm-10">
                                            <?php
                                                $can_id=$row['can_id'];
                                                $sql="SELECT * FROM candidates WHERE id='".$can_id."'";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($rows=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="can_jobrole" value="'.$rows['jobrole'].'"></td>';?>
                                            <?php }}?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="com_name" class="col-sm-2 col-form-label">Company Name</label>
                                        <div class="col-sm-10">
                                            <?php
                                                $job_id=$row['job_id'];
                                                $sql="SELECT * FROM jobs WHERE id='".$job_id."'";
                                                $result=mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                while($rows=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="com_name" value="'.$rows['com_name'].'"></td>';?>
                                            <?php }}?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sent_date" class="col-sm-2 col-form-label">Sent Date</label>
                                        <div class="col-sm-10">
                                            <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="sent_date" value="'.$sent.'"></td>';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sent_status" class="col-sm-2 col-form-label">Status</label>
                                        <div class="col-sm-10">
                                            <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="sent_status" value="'.$row['status'].'"></td>';?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <?php echo '<input style="color:#000;" type="text" readonly class="form-control-plaintext" name="description" value="'.$row['description'].'"></td>';?>
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
                                        <?php echo'<a class="btn btn-primary" href="interview-sent-edit.php?id='.$row['id'].'"><i class="fas fa-edit mr-2"></i>Update Status</a>';?>
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