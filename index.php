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
                    <!-- Top bar near Profile section -->

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
                        <h1 class="h3 mb-0 text-gray-900">Dashboard</h1>
                        <h4 class="h3 mb-0 text-gray-900" id="time"></h4>
                    </div>
                    <script type="text/javascript"> 
                            setInterval(showTime, 1000); 
                                function showTime(){ 
                                    var time = new Date();
                                    var hour = time.getHours(); 
                                    var min = time.getMinutes();
                                    var sec = time.getSeconds(); 
                                    var am_pm = "AM";
                                    if(hour >= 12){
                                        am_pm = "PM"; 
                                        if(hour > 12){
                                            hour -= 12;
                                        } 
                                    }
                                    if(hour == 0){
                                        hr = 12;
                                        am_pm = "AM"; 
                                    } 
                                    hour = (hour < 10) ? ("0"+hour) : hour; 
                                    min = (min < 10) ? ("0"+min) : min; 
                                    sec = (sec < 10) ? ("0"+sec) : sec; 
                                    var currentTime = hour + ":" + min + ":" + sec + " " + am_pm;
                                    document.getElementById("time").innerHTML = "Time : " + currentTime;
                                } 
                            showTime();
                    </script>
                    <!-- Content Row -->
                   <div class="row">
                       <!-- Candidates Card -->
                       <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h6 font-weight-bold text-primary text-uppercase mb-1">Total Candidates</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-900">
                                                <?php
                                                    $userId=$_SESSION['userId'];
                                                    $query = "SELECT * FROM candidates WHERE entry_by ='".$_SESSION['userRel']."' AND user_id='".$userId."'";
                                                    $query_run = mysqli_query($conn,$query);

                                                    $row = mysqli_num_rows($query_run);
                                                    echo '<h2>'.$row.'<h2>';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-900"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Company Card -->
                        <?php
                            echo'<div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="h6 font-weight-bold text-primary text-uppercase mb-1">Total Companies</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-900">';
                                                                $query = "SELECT * FROM company WHERE entry_by='".$_SESSION['userRel']."'";
                                                                $query_run = mysqli_query($conn,$query);

                                                                $row = mysqli_num_rows($query_run);
                                                                echo '<h2>'.$row.'<h2>';
                                                        echo'</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-industry fa-2x text-gray-900"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- JOBS Card -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="h6 font-weight-bold text-primary text-uppercase mb-1">Total JOBS</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-900">';
                                                                $query = "SELECT * FROM jobs WHERE entry_by='".$_SESSION['userRel']."' AND user_id='".$userId."'";
                                                                $query_run = mysqli_query($conn,$query);

                                                                $row = mysqli_num_rows($query_run);
                                                                echo '<h2>'.$row.'<h2>';
                                                        echo'</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-briefcase fa-2x text-gray-900"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                            ?>
                   </div>
                        
                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>