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
                            <h5 class="m-0 font-weight-bold text-primary">Edit Resume File</h5>
                            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="candidates.php">
                                <i class="fas fa-arrow-left mr-2 text-white-100"></i>
                                <strong>Back</strong>
                            </a>
                    </div>
                        <div class="card-body">
                            <?php
                                $can_id=$_GET['can_id'];
                                $sql= 'SELECT * FROM candidates WHERE id='.$can_id.'';
                                $result = mysqli_query($conn, $sql);
                                    while($rows= mysqli_fetch_array($result)){
                            ?>

                            <!-- Video Details Start -->
                            <form action="candidates.php" method="POST" enctype="multipart/form-data">
                                <div class="form-row">
                                    <!-- Upload Resume -->
                                    <?php echo'<input type="hidden" name="can_id" value="'.$rows['id'].'">'?>
                                    <?php echo'<input type="hidden" name="can_name" value="'.$rows['name'].'">'?>
                                    <?php echo'<input type="hidden" name="jobrole" value="'.$rows['jobrole'].'">'?>
                                    <?php echo'<input type="hidden" name="previous" value="'.$_SERVER['HTTP_REFERER'].'">'?>
                                    <div class="form-group col-md-6">
                                        <?php echo'<span class="lead">Candidate Name : '.$rows['name'].'</span>';?>
                                    </div>
                                    <!-- Upload Resume -->
                                    <div class="form-group col-md-12">
                                        <label class="lead" for="resume"><strong>Upload Resume</strong></label>
                                        <input class="form-control-file mb-1" type="file" name="resume">
                                        <label class="lead" for="resume"><strong>Supported Formats :</strong>&nbsp;Images(.jpg&ensp;.jpeg&ensp;.png)&nbsp;PDF(.pdf)&nbsp;Word File(.docx&ensp;.doc)</label><br><br>
                                        <button class="btn btn-success" name="resume" type="submit"><i class="fas fa-arrow-up mr-2"></i>Upload</button>
                                    </div>
                                </div>
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
