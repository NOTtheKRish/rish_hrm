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
                        <h1 class="h3 mb-2 text-gray-800">Job Vacancy</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
                            <?php
                                if(isset($_GET['status'])||isset($_GET['entry_by'])){
                                    echo'<a class="d-none d-sm-inline-block btn btn-danger shadow-sm" href="vacancy.php">
                                        <i class="fas fa-minus-circle text-white-50"></i>
                                        Remove Filters
                                    </a>';
                                }else{
                                    echo'';
                                }
                            ?>
                            <a href="vacancy-create.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-plus mr-2 fa-sm"></i>Add New JOB Vacancy</a>
                        </div>

                        <div class="card-body">
                            <!-- Create New JOB Vacancy Zone Starts -->
                            <?php
                                if (isset($_POST["create"])){
                                    $previous=$_POST['previous'];
                                    // Data being Inserted into the Database
                                    date_default_timezone_set('Asia/Kolkata');
                                    $created_at = date('Y-m-d H:i:s');

                                    $co="SELECT jobs FROM accounts WHERE id='".$_SESSION['userRel']."'";
                                    $cou=mysqli_query($conn,$co);
                                    while($coun=mysqli_fetch_array($cou)){
                                        $count=($coun['jobs'])+1;
                                    }

                                    $entry_by=$_SESSION['userRel'];
                                    $userId=$_SESSION['userId'];
                                    $sql="INSERT INTO jobs (job_id,com_name,job_role,openings,job_desc,skills_need,gender,qualification,experience,salary,salary_max,extra_allowance,status,entry_by,user_id,created_at)
                                    VALUES ('".$count."','".$_POST['com_name']."','".$_POST['jobrole']."','".$_POST['openings']."','".$_POST['job_desc']."','".$_POST['skills_need']."','".$_POST['gender']."','".$_POST['qualification']."','".$_POST['experience']."','".$_POST['salary']."','".$_POST['salary_max']."','".$_POST['extra_allowance']."','".$_POST['status']."','".$entry_by."','".$userId."','".$created_at."')";
                                    $result=mysqli_query($conn,$sql);

                                    //updating job count in accounts table
                                    $sql="UPDATE accounts SET jobs='".$count."' WHERE id='".$_SESSION['userRel']."'";
                                    $res=mysqli_query($conn,$sql);

                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"New JOB Vacancy Created Successfully",
                                                    button: "Close",
                                                }).then(function(){
                                                    window.location.href="'.$previous.'"
                                                });
                                            },500);
                                        </script>';
                                }
                            ?>
                            <!-- Create New JOB Vacancy Zone Ends -->

                            <!-- Edit JOB Vacancy Zone Starts -->
                            <?php
                                if (isset($_POST["update"])){
                                    $previous=$_POST['previous'];
                                    $job_id=$_POST['job_id'];
                                    $com_name=$_POST['com_name'];
                                    $job_role=$_POST['job_role'];
                                    $openings=$_POST['openings'];
                                    $job_desc=$_POST['job_desc'];
                                    $skills_need=$_POST['skills_need'];
                                    $gender=$_POST['gender'];
                                    $qualification=$_POST['qualification'];
                                    $experience=$_POST['experience'];
                                    $salary=$_POST['salary'];
                                    $salary_max=$_POST['salary_max'];
                                    $extra_allowance=$_POST['extra_allowance'];
                                    $status=$_POST['status'];
                                    $sql="UPDATE jobs
                                    SET com_name='".$com_name."', job_role='".$job_role."', openings='".$openings."', job_desc='".$job_desc."', skills_need='".$skills_need."',gender='".$gender."',qualification='".$qualification."',experience='".$experience."',salary='".$salary."',salary_max='".$salary_max."',extra_allowance='".$extra_allowance."',status='".$status."'
                                    WHERE id='".$job_id."'";
                                    $query=mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"JOB Vacancy Edited Successfully",
                                                    button: "Close",
                                                }).then(function(){
                                                    window.location.href="'.$previous.'"
                                                });
                                            },500);
                                        </script>';
                                }
                            ?>
                            <!-- Edit JOB Vacancy Zone Ends -->

                            <!-- Delete JOB Vacancy Zone Starts -->
                            <?php
                                if (isset($_POST["delete"])){
                                    $delete_id=$_POST['job_id'];
                                    $previous=$_POST['previous'];
                                    $sql="DELETE FROM jobs WHERE id='".$delete_id."'";
                                    $result=mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"info",
                                                    title:"Success!",
                                                    text:"JOB Vacancy Deleted Successfully",
                                                    button: "Close",
                                                }).then(function(){
                                                    window.location.href="'.$previous.'"
                                                });
                                            },500);
                                        </script>';
                                }
                            ?>
                        <!-- Delete JOB Vacancy Zone Ends -->

                            <div class="table-responsive">
                            <div class="dataTable-filter">
                                <div class="row d-flex mt-1">
                                    <form action="vacancy.php" method="GET">
                                            <div class="col-md-12 d-flex">
                                                <select class="form-control mx-1" name="status">
                                                    <option value="">Vacancy Status</option>
                                                    <?php
                                                        $sql="SELECT * FROM jobs_status";
                                                        $result=mysqli_query($conn,$sql);
                                                        if(mysqli_num_rows($result)>0){
                                                        while($row=mysqli_fetch_array($result)){
                                                    ?>
                                                    <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                                    <?php }}?>
                                                </select>
                                                <button class="btn btn-primary btn-circle"><i class="fas fa-search"></i></button>
                                            </div>
                                    </form>
                                    <?php
                                        if($_SESSION['id']!=2){
                                            echo'<div class="col-md-3">
                                                <form action="vacancy.php" id="ris" method="GET">
                                                    <div class="d-flex">
                                                        <div class="col-md-12">
                                                            <select class="form-control" name="entry_by" oninput="s()">
                                                            <option value="">Entry By</option>';
                                                                $sql="SELECT id,name FROM accounts where userRelation='".$_SESSION['userRel']."'";
                                                                $result=mysqli_query($conn,$sql);
                                                                if(mysqli_num_rows($result)>0){
                                                                while($row=mysqli_fetch_array($result)){
                                                            echo'<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                                        }}
                                                        echo'</select>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>JOB ID</th>
                                            <th>JOB Role</th>
                                            <th>Company Name</th>
                                            <th>Openings</th>
                                            <th>Qualification</th>
                                            <th>Status</th>
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
                                        // Finding out the total number of data in the table
                                            $userRel=$_SESSION['userRel'];
                                            $userId=$_SESSION['userId'];
                                            $sql = "SELECT * FROM jobs WHERE entry_by='".$userRel."'";
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
                                        // Retrieve selective values according to the page limit
                                        if($userRel==$userId){
                                            if(isset($_GET['status'])){
                                                $status=$_GET['status'];
                                                $sql= "SELECT * FROM jobs WHERE entry_by='".$userRel."' AND status='".$status."'";
                                                $result = mysqli_query($conn,$sql);
                                                $result_num = mysqli_num_rows($result);
                                                // Determine number of total pages available
                                                $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM jobs WHERE status='".$status."' AND entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }elseif(isset($_GET['entry_by'])){
                                                $entry_by=$_GET['entry_by'];
                                                $sql= "SELECT * FROM jobs WHERE entry_by='".$userRel."' AND user_id='".$entry_by."'";
                                                $result = mysqli_query($conn,$sql);
                                                $result_num = mysqli_num_rows($result);
                                                // Determine number of total pages available
                                                $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM jobs WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }else{
                                                $sql= 'SELECT * FROM jobs WHERE entry_by="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                            }
                                        }else{
                                            if(isset($_GET['status'])){
                                                $status=$_GET['status'];
                                                $sql= "SELECT * FROM jobs WHERE entry_by='".$userRel."' AND status='".$status."'";
                                                $result = mysqli_query($conn,$sql);
                                                $result_num = mysqli_num_rows($result);
                                                // Determine number of total pages available
                                                $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM jobs WHERE status='".$status."' AND entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }elseif(isset($_GET['entry_by'])){
                                                $entry_by=$_GET['entry_by'];
                                                $sql= "SELECT * FROM jobs WHERE entry_by='".$userRel."'";
                                                $result = mysqli_query($conn,$sql);
                                                $result_num = mysqli_num_rows($result);
                                                // Determine number of total pages available
                                                $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM jobs WHERE entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }else{
                                                $sql= 'SELECT * FROM jobs WHERE entry_by="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                            }
                                        }
                                            if(mysqli_query($conn,$sql)){
                                                echo "";
                                            }else{
                                                echo "Error". $sql . "<br>". mysqli_error($conn);
                                            }
                                            $result = mysqli_query($conn, $sql);
                                            $result_num = mysqli_num_rows($result);
                                            if (mysqli_num_rows($result) > 0) {

                                            while($row= mysqli_fetch_array($result)){
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo 'J-'.$row['job_id'];?></td>
                                            <td><?php echo $row['job_role'];?></td>
                                            <td><?php echo $row['com_name'];?></td>
                                            <td><?php echo $row['openings'];?></td>
                                            <td><?php echo $row['qualification'];?></td>
                                            <td><?php echo $row['status'];?></td>
                                            <td style="text-align:center;"><?php echo'<a class="btn btn-circle btn-primary" href="vacancy-view.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-circle btn-primary" href="vacancy-edit.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-pen"></i></a>';
                                            if($_SESSION['id']==2){
                                                echo '</td>';
                                            }elseif ($_SESSION['id']!=2){
                                            echo'<a class="btn btn-circle btn-danger" href="vacancy-delete.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-trash"></i></a></td>';
                                            }?>
                                        </tr>
                                    </tbody>
                                        <?php
                                        }
                                    } else{
                                        echo '<td class="text-center" colspan="7">Oops!! 0 results</td>';
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                        <div style="margin-left:18px;">
                            <?php
                                if($result_num==0){
                                    echo 'Total Results : '.$result_num.'';
                                }else{
                                    echo 'Total Results : '.$result_num.' (Showing '.$pagereslimit.' results per page)';
                                }
                            ?>
                        <br>
                        </div>
                        <div>
                        <ul class="nav tm-paging-links" style="overflow-x: scroll;flex-wrap:nowrap;">
                            <?php
                                for($page=1;$page<=$pagenumbers;$page++){?>
                                    <li class="nav-item">
                                        <?php
                                            if(isset($_GET['entry_by'])){
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="vacancy.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="vacancy.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="vacancy.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }
                                            }elseif(isset($_GET['status'])){
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="vacancy.php?status='.$status.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="vacancy.php?status='.$status.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="vacancy.php?status='.$status.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }
                                            }else{
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="vacancy.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="vacancy.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="vacancy.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }
                                            }
                                        ?>
                                    </li>
                                <?php }?>
                        </ul>
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
    <script type="text/javascript">
        function s(){
            document.getElementById("ris").submit();
        }
    </script>
