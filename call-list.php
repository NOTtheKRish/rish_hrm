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
                        <h1 class="h3 mb-2 text-gray-800">Call List</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
                            <?php
                                if(isset($_GET['search']) || isset($_GET['jobrole']) || isset($_GET['entry_by']) || isset($_GET['status'])){
                                    echo'<a class="d-none d-sm-inline-block btn btn-danger shadow-sm" href="call-list.php">
                                        <i class="fas fa-plus-circle text-white-50"></i>
                                        Show All
                                    </a>';
                                }else{
                                    echo'';
                                }
                            ?>
                            <a class="btn btn-sm btn-primary shadow-sm" href="call-list-create.php">
                                <i class="fas fa-plus fa-sm text-white-50"></i>
                                Add New CALL
                            </a>
                        </div>

                        <div class="card-body">
                            <!-- Create New Call Entry Zone Starts -->
                            <?php
                                if (isset($_POST["create"])){
                                    $previous=$_POST['previous'];

                                    $co="SELECT calls FROM accounts WHERE id='".$_SESSION['userRel']."'";
                                    $cou=mysqli_query($conn,$co);
                                    while($coun=mysqli_fetch_array($cou)){
                                        $count=($coun['calls'])+1;
                                    }
                                    // Data being Inserted into the Database
                                    $entry_by=$_SESSION['userRel'];
                                    $userId=$_SESSION['userId'];
                                    date_default_timezone_set('Asia/Kolkata');
                                    $created_at = date('Y-m-d H:i:s');
                                    $sql="INSERT INTO calls (call_id,calltype,number,name,type,location,description,job_role,status,entry_by,user_id,created_at)
                                    VALUES ('".$count."','".$_POST['calltype']."','".$_POST['p_number']."','".$_POST['p_name']."','".$_POST['p_type']."','".$_POST['location']."','".$_POST['description']."','".$_POST['job_role']."','".$_POST['status']."','".$entry_by."','".$userId."','".$created_at."')";
                                    $result=mysqli_query($conn,$sql);

                                    //updating calls count in accounts table
                                    $sql="UPDATE accounts SET calls='".$count."' WHERE id='".$_SESSION['userRel']."'";
                                    $res=mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                                setTimeout(function(){
                                                    swal({
                                                        icon:"success",
                                                        title:"Success!",
                                                        text:"New Call Entry Created Successfully",
                                                        button: "Close",
                                                    }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                                },500);
                                        </script>';
                                }
                            ?>
                            <?php
                            ?>
                            <!-- Create New Call Entry Zone Ends -->

                            <!-- Edit Call Entry Zone Starts -->
                            <?php
                                if (isset($_POST["update"])){
                                    $previous=$_POST['previous'];
                                    $call_id=$_POST['call_id'];
                                    $calltype=$_POST['calltype'];
                                    $phone_number=$_POST['phone_number'];
                                    $person_name=$_POST['person_name'];
                                    $call_type=$_POST['call_type'];
                                    $location=$_POST['location'];
                                    $call_status=$_POST['call_status'];
                                    $call_description=$_POST['call_description'];
                                    $job_role=$_POST['job_role'];
                                    date_default_timezone_set('Asia/Kolkata');
                                    $updated_on = date('Y-m-d');
                                    $sql="UPDATE calls
                                    SET calltype='".$calltype."',number='".$phone_number."',name='".$person_name."',type='".$call_type."',location='".$location."',description='".$call_description."',job_role='".$job_role."',status='".$call_status."'
                                    WHERE id='".$call_id."'";
                                    $query=mysqli_query($conn,$sql);

                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"Call Entry Modified Successfully",
                                                    button: "Close",
                                                }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                            },500);
                                        </script>';
                                }
                            ?>
                            <!-- Edit Call Entry Zone Ends -->

                            <!-- Delete Call Entry Zone Starts -->
                            <?php
                                if (isset($_POST["delete"])){
                                    $delete_id=$_POST['call_id'];
                                    $previous=$_POST['previous'];
                                    $sql="DELETE FROM calls WHERE id='".$delete_id."'";
                                    $result=mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"info",
                                                    title:"Success!",
                                                    text:"Call Entry Deleted Successfully",
                                                    button: "Close",
                                                }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                            },500);
                                        </script>';
                                }
                            ?>
                        <!-- Delete Call Entry Zone Ends -->

                        <div class="table-responsive">
                            <div class="dataTable-filter">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-4">
                                            <form action="call-list.php" method="GET">
                                                <div class="d-flex mt-1">
                                                    <div class="col-lg-10">
                                                        <input class="form-control" type="text" placeholder="Search" name="search">
                                                    </div>
                                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <?php
                                            if($_SESSION['id']==1 || $_SESSION['id']==0){
                                        ?>
                                                <div class="col-lg-8">
                                                    <div class="d-block d-lg-inline-flex col-lg-12 mt-1">
                                                            <div class="col-lg-6 mt-1">
                                                                <form action="call-list.php" id="entry" method="GET">
                                                                    <select class="form-control" name="jobrole" onchange="this.form.submit();">
                                                                        <option value="">Job Role</option>';
                                                                        <?php
                                                                            $sql="SELECT value FROM can_jobrole";
                                                                            $jobroles=mysqli_query($conn,$sql);
                                                                            foreach($jobroles as $jobrole){
                                                                                echo'<option value="'.$jobrole['value'].'">'.$jobrole['value'].'</option>';
                                                                            }
                                                                            ?>
                                                                    </select>
                                                                </form>
                                                            </div>
                                                            <div class="col-lg-6 mt-1">
                                                                <form class="d-block d-lg-flex col-lg-12" action="call-list.php" id="entry" method="GET">
                                                                    <div class="col-lg-6">
                                                                        <select class="form-control" name="entry_by">
                                                                            <option value="">Entry By</option>
                                                                            <?php
                                                                                $sql="SELECT id,name FROM accounts WHERE userRelation='".$_SESSION['userRel']."'";
                                                                                $result=mysqli_query($conn,$sql);
                                                                                if(mysqli_num_rows($result)>0){
                                                                                while($row=mysqli_fetch_array($result)){
                                                                            ?>
                                                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                                            <?php
                                                                                }}
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <select class="form-control" name="status">
                                                                            <option value="">Call Status</option>
                                                                            <?php
                                                                                $sql="SELECT value FROM call_status";
                                                                                $result=mysqli_query($conn,$sql);
                                                                                if(mysqli_num_rows($result)>0){
                                                                                while($row=mysqli_fetch_array($result)){
                                                                            ?>
                                                                            <option value="<?php echo $row['value']; ?>"><?php echo $row['value']; ?></option>
                                                                            <?php
                                                                                }}
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                </div>
                                            <?php
                                            }else{
                                            ?>
                                                <div class="col-lg-6">
                                                    <form action="call-list.php" id="entry" method="GET">
                                                        <div class="d-flex mt-1">
                                                            <div class="col-lg-5">
                                                                <select class="form-control" name="job_role">
                                                                    <option value="">Job Role</option>';
                                                                    <?php
                                                                        $sql="SELECT value FROM can_jobrole";
                                                                        $jobroles=mysqli_query($conn,$sql);
                                                                        foreach($jobroles as $jobrole){
                                                                            echo'<option value="'.$jobrole['value'].'">'.$jobrole['value'].'</option>';
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <select class="form-control" name="status">
                                                                    <option value="">Call Status</option>';
                                                                    <?php
                                                                        $sql="SELECT value FROM call_status";
                                                                        $result=mysqli_query($conn,$sql);
                                                                        foreach($result as $row){
                                                                            echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php
                                                }
                                            ?>
                                    </div>
                            </div>
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Call Date</th>
                                            <th>Call Type</th>
                                            <th>Name</th>
                                            <th>Number</th>
                                            <th>Location</th>
                                            <th>Type</th>
                                            <th>Job Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        If needed add contents same sa <thead>
                                    </tfoot> -->
                                    <?php
                                        // Maximum results in a page - $pagereslimit variable
                                        // Results Order By value Check and Manipulating
                                            $order="DESC";
                                        // Dynamic Page Result Limit Check and Manipulating
                                            if(!isset($_GET['show'])){
                                                $pagereslimit = 25;
                                            }else{
                                                $pagereslimit = $_GET['show'];
                                            }
                                            $userRel=$_SESSION['userRel'];
                                            $userId=$_SESSION['userId'];
                                            $role=$_SESSION['id'];
                                        // Finding out the total number of data in the table
                                        if($userRel==$userId || $role==2){
                                            $sql = "SELECT * FROM calls WHERE entry_by='".$userRel."'";
                                        }else{
                                            $sql = "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$userId."'";
                                        }
                                            $result = mysqli_query($conn,$sql);
                                            $result_num = mysqli_num_rows($result);
                                        // Determine number of total pages available
                                            $pagenumbers = ceil($result_num/$pagereslimit);
                                        // Determine which page the visitor is currently on
                                            if(!isset($_GET['page'])){
                                                $page = 1;
                                            }else{
                                                $page = $_GET['page'];
                                            }
                                        // Determine maximum results for a page according to a page's result SQL limit
                                            $pagefirstvalue = ($page-1)*$pagereslimit;
                                        // Searching Phone Number
                                        if($userRel==$userId){
                                            if(isset($_GET['jobrole'])){
                                                $jobrole = $_GET['jobrole'];
                                                $sql = "SELECT * FROM calls WHERE entry_by='".$userRel."' AND job_role LIKE '%".$jobrole."%'";
                                                $result = mysqli_query($conn,$sql);
                                                $result_num = mysqli_num_rows($result);
                                                // Determine number of total pages available
                                                $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql = "SELECT * FROM calls WHERE entry_by='".$userRel."' AND job_role LIKE '%".$jobrole."%' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }elseif(isset($_GET['search'])){
                                                $search=$_GET['search'];
                                                $sql= "SELECT * FROM calls WHERE number='".$search."' OR name LIKE '%".$search."%' AND entry_by='".$userRel."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE number='".$search."' OR name LIKE '%".$search."%' AND entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }elseif(isset($_GET['entry_by']) && isset($_GET['status']) && $_GET['entry_by']!="" && $_GET['status']!=""){// Searching for Entry By & Call Status
                                                $entry_by = $_GET['entry_by'];
                                                $status = $_GET['status'];
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' AND status='".$status."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' AND status='".$status."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }elseif(isset($_GET['entry_by']) && isset($_GET['status']) && $_GET['entry_by']!="" && $_GET['status']==""){// Searching with Entry By
                                                $entry_by=$_GET['entry_by'];
                                                $status="";
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$entry_by."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }elseif(isset($_GET['entry_by']) && isset($_GET['status']) && $_GET['entry_by']=="" && $_GET['status']!=""){// Searching with Call Status
                                                $entry_by="";
                                                $status=$_GET['status'];
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND status='".$status."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND status='".$status."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }else{
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }
                                        }elseif($role==2){
                                            if(isset($_GET['search'])){
                                                $search=$_GET['search'];
                                                $sql= "SELECT * FROM calls WHERE number='".$search."' OR name LIKE '%".$search."%' AND entry_by='".$userRel."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE number='".$search."' OR name LIKE '%".$search."%' AND entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }elseif(isset($_GET['entry_by']) && isset($_GET['status']) && $_GET['entry_by']!="" && $_GET['status']!=""){// Searching for Entry By & Call Status
                                                $entry_by=$_GET['entry_by'];
                                                $status=$_GET['status'];
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' AND status='".$status."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' AND status='".$status."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }elseif(isset($_GET['entry_by']) && isset($_GET['status']) && $_GET['entry_by']!="" && $_GET['status']==""){// Searching with Entry By
                                                $entry_by=$_GET['entry_by'];
                                                $status="";
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$entry_by."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }elseif(isset($_GET['entry_by']) && isset($_GET['status']) && $_GET['entry_by']=="" && $_GET['status']!=""){// Searching with Call Status
                                                $entry_by="";
                                                $status=$_GET['status'];
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND status='".$status."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND status='".$status."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }elseif(isset($_GET['job_role']) && isset($_GET['status']) && $_GET['job_role']!="" && $_GET['status']==""){ // searching with jobrole

                                                $job_role=$_GET['job_role'];
                                                $status="";
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND job_role='".$job_role."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND job_role='".$job_role."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }elseif(isset($_GET['job_role']) && isset($_GET['status']) && $_GET['job_role']=="" && $_GET['status']!=""){ // searching with status

                                                $job_role="";
                                                $status=$_GET['status'];
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND status='".$status."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND status='".$status."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }elseif(isset($_GET['job_role']) && isset($_GET['status']) && $_GET['job_role']!="" && $_GET['status']!=""){ // searching with job role and status

                                                $job_role=$_GET['job_role'];
                                                $status=$_GET['status'];
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND job_role='".$job_role."' AND status='".$status."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND job_role='".$job_role."' AND status='".$status."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }else{
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }
                                        }else{
                                            if(isset($_GET['search'])){
                                                $search=$_GET['search'];
                                                $sql= "SELECT * FROM calls WHERE number='".$search."' OR name LIKE '%".$search."%' AND entry_by='".$userRel."' AND user_id='".$userId."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE number='".$search."' OR name LIKE '%".$search."%' AND entry_by='".$userRel."' AND user_id='".$userId."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }elseif(isset($_GET['entry_by']) && isset($_GET['status']) && $_GET['entry_by']!="" && $_GET['status']!=""){// Searching for Entry By & Call Status
                                                $entry_by=$_GET['entry_by'];
                                                $status=$_GET['status'];
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' AND status='".$status."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' AND status='".$status."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }elseif(isset($_GET['entry_by']) && isset($_GET['status']) && $_GET['entry_by']!="" && $_GET['status']==""){// Searching with Entry By
                                                $entry_by=$_GET['entry_by'];
                                                $status="";
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$entry_by."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }elseif(isset($_GET['entry_by']) && isset($_GET['status']) && $_GET['entry_by']=="" && $_GET['status']!=""){// Searching with Call Status

                                                $entry_by="";
                                                $status=$_GET['status'];
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND status='".$status."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND status='".$status."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }elseif(isset($_GET['job_role']) && isset($_GET['status']) && $_GET['job_role']!="" && $_GET['status']==""){ // searching with jobrole

                                                $job_role=$_GET['job_role'];
                                                $status="";
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$userId."' AND job_role='".$job_role."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$userId."' AND job_role='".$job_role."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }elseif(isset($_GET['job_role']) && isset($_GET['status']) && $_GET['job_role']=="" && $_GET['status']!=""){ // searching with status

                                                $job_role="";
                                                $status=$_GET['status'];
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$userId."' AND status='".$status."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$userId."' AND status='".$status."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }elseif(isset($_GET['job_role']) && isset($_GET['status']) && $_GET['job_role']!="" && $_GET['status']!=""){ // searching with job role and status

                                                $job_role=$_GET['job_role'];
                                                $status=$_GET['status'];
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$userId."' AND job_role='".$job_role."' AND status='".$status."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$userId."' AND job_role='".$job_role."' AND status='".$status."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;

                                            }else{
                                                $sql= "SELECT * FROM calls WHERE entry_by='".$userRel."' AND user_id='".$userId."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }
                                        }
                                        // Retrieve selective values according to the page limit
                                            if(mysqli_query($conn,$sql)){
                                                echo "";
                                            }else{
                                                echo "Error". $sql . "<br>". mysqli_error($conn);
                                            }
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {

                                            while($row= mysqli_fetch_array($result)){
                                                $created=date_create($row['created_at']);
                                                // Changing Date Format to display as 19 Dec 2003
                                                $created_at=date_format($created,"d M Y");
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['call_id']; ?> </td>
                                            <td><?php echo $created_at; ?> </td>
                                            <td><?php echo $row['calltype']; ?></td>
                                            <td><?php echo $row['name']; ?> </td>
                                            <td><?php echo $row['number']; ?> </td>
                                            <td><?php echo $row['location']; ?> </td>
                                            <td><?php echo $row['type']; ?></td>
                                            <td><?php echo $row['job_role']; ?></td>
                                            <td style="text-align:center;"><?php echo'<a class="btn btn-circle btn-primary" href="call-list-view.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-circle btn-primary" href="call-list-edit.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-pen"></i></a>
                                            <a class="btn btn-circle btn-success mr-1" target="_blank" href="https://wa.me/91'.$row['number'].'"><i class="fab fa-lg fa-whatsapp"></i></a>';
                                            if($_SESSION['id']==2){
                                                echo '</td>';
                                            }elseif($_SESSION['id']!=2){
                                            echo'<a class="btn btn-circle btn-danger" href="call-list-delete.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-trash"></i></a></td>';
                                            }?>
                                        </tr>
                                    </tbody>
                                        <?php
                                        }
                                    } else{
                                        echo '<td style="text-align:center;" colspan="7">Oops!! 0 results</td>';
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                        <div style="margin-left:18px;">
                            <?php
                                if($result_num==0){
                                    echo'Total Results : '.$result_num.'';
                                }else{
                                    echo'Total Results : '.$result_num.' (Showing '.$pagereslimit.' results per page)';
                                }
                            ?>
                        <br>
                        </div>
                        <div>
                            <ul class="nav tm-paging-links" style="overflow-x: scroll;flex-wrap:nowrap;">
                            <!-- <li class="nav-item" id="prev"><a href="#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 10px;margin-bottom: 10px"><</a></li> -->
                            <?php
                                for($page=1;$page<=$pagenumbers;$page++){?>
                                    <li class="nav-item">
                                        <?php
                                            if(isset($_GET['number'])){
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="call-list.php?search='.$search.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="call-list.php?search='.$search.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="call-list.php?search='.$search.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }
                                            }elseif(isset($_GET['entry_by']) && isset($_GET['status'])){
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="call-list.php?entry_by='.$entry_by.'&status='.$status.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="call-list.php?entry_by='.$entry_by.'&status='.$status.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="call-list.php?entry_by='.$entry_by.'&status='.$status.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }
                                            }elseif(isset($_GET['status'])){
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="call-list.php?status='.$status.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="call-list.php?status='.$status.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="call-list.php?status='.$status.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }
                                            }else{
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="call-list.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px;font-weight:bold;">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="call-list.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px;font-weight:bold;">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="call-list.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }
                                            }
                                        ?>
                                    </li>
                                <?php }?>
                            <!-- <li class="nav-item" id="next"><a href="#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 10px;margin-bottom: 10px">></a></li> -->
                            </ul>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script> -->
    <!-- <script src="js/datatables.js"></script> -->

<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>
<script>
    function search(){
        document.getElementById("entry").submit();
    }
</script>
