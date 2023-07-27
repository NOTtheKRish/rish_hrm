<?php
include('session.php');
include('includes/header.php');
include('includes/navbar.php');

include_once('includes/dbconfig.php');
?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- The empty top bar-->
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
                        <h1 class="h3 mb-2 text-gray-800">Resume Viewer</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Resume</h6>
                            <a href="candidates.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-arrow-left mr-2 fa-sm"></i>Back</a>
                        </div>

                        <div class="card-body">
                        
                        <!-- Delete Vendor Zone Ends -->

                            <div class="table-responsive">
                            <div class="dataTable-filter"> 
                                    <div class="mt-1">
                                        
                                    <!-- <tfoot>
                                        If needed add contents same sa <thead>
                                    </tfoot> -->
                                    <?php
                                        // Get Resume File Name
                                            if(isset($_GET['resume'])){
                                                $resume=$_GET['resume'];
                                                $fileExt=explode('.',$resume);
                                                $fileActualExt=strtolower(end($fileExt));
                                                if($fileActualExt=="doc"|| $fileActualExt=="docx"){
                                                    echo'<div class="col-md-12 text-center">
                                                    <h3 class="text-dark">Oops!</h3>
                                                    <span class="lead">Resume Preview Unavailable...</span><br>
                                                    <p>Reason: Word Document not supported for Preview</p>
                                                    <a class="btn btn-success" href="./uploads/'.$resume.'"><i class="fas fa-file-download mr-2"></i>Download Resume</a>
                                                    </div>';
                                                        // echo'<embed type="application/msword" src="./uploads/'.$resume.'" width="1000px" height="600px"/>';
                                                }else{
                                                    echo'<embed type="application/pdf" src="./uploads/'.$resume.'" width="1000px" height="600px"/>';
                                                }
                                                //echo'<iframe width="1000px" height="600px" src="https://docs.google.com/gview?url=http://'.$_SERVER['SERVER_NAME'].'/uploads/'.$resume.'&embedded=true"></iframe>';
                                            }else{
                                                echo "File Not Found!!";
                                            }
                                            ?>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>