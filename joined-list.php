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
                        <h1 class="h3 mb-2 text-gray-800">Joined List</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
                            <?php
                                if(isset($_GET['job_id'])||isset($_GET['entry_by'])){
                                    echo'<a class="d-none d-sm-inline-block btn btn-danger shadow-sm" href="joined-list.php">
                                        <i class="fas fa-minus-circle text-white-50"></i>
                                        Remove Filters
                                    </a>';
                                }else{
                                    echo'';
                                }
                            ?>
                            <a href="joined-list-create.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-plus mr-2 fa-sm"></i>Create New Joining</a>
                        </div>

                        <div class="card-body">
                            <!-- Create New Joined Zone Starts -->
                            <?php
                                if (isset($_POST["create"])){
                                    $previous = $_POST['previous'];
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"New Joined List Created Successfully!",
                                                    button: "Close",
                                                }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                            },500);
                                        </script>';
                                    // Data being Inserted into the Database
                                    $can_id = $_POST['can_id'];
                                    $job_id = $_POST['job_id'];
                                    $salary = $_POST['salary'];
                                    $joining_date = $_POST['joining_date'];
                                    $status = $_POST['status'];

                                    $entry_by = $_SESSION['userRel'];
                                    $userId = $_SESSION['userId'];
                                    $sql = "INSERT INTO joined (can_id,job_id,salary,joined_on,entry_by,user_id,status)
                                    VALUES ('".$can_id."','".$job_id."','".$salary."','".$joining_date."','".$entry_by."','".$userId."','".$status."')";
                                    $result = mysqli_query($conn,$sql);
                                }
                            ?>
                            <!-- Create New Joined Zone Ends -->

                            <!-- Edit Joined Zone Starts -->
                            <?php
                                if (isset($_POST["update"])){
                                    $previous = $_POST['previous'];
                                    $join_id = $_POST['join_id'];
                                    $salary = $_POST['salary'];
                                    $joining = $_POST['joining_date'];
                                    $status = $_POST['status'];
                                    $sql = "UPDATE joined SET joined_on='".$joining."', salary='".$salary."', status='".$status."' WHERE id='".$join_id."'";
                                    $query = mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"Joined Data Updated Successfully!",
                                                    button: "Close",
                                                }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });s
                                            },500);
                                        </script>';
                                }
                            ?>
                            <!-- Edit Joined Zone Ends -->

                            <!-- Delete Joined Zone Starts -->
                            <?php
                                if (isset($_POST["delete"])){
                                    $delete_id = $_POST['join_id'];
                                    $previous = $_POST['previous'];
                                    $sql = "DELETE FROM joined WHERE id='".$delete_id."'";
                                    $result=mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"Joined Data Deleted Successfully!",
                                                    button: "Close",
                                                }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                            },500);
                                        </script>';
                                }
                            ?>
                            <!-- Delete Joined Zone Ends -->

                            <div class="table-responsive">
                            <div class="dataTable-filter">
                                <?php
                                    if($_SESSION['id'] != 2){
                                        echo'<div class="col-md-3">
                                            <form action="joined-list.php" method="GET">
                                                <div class="mt-1">
                                                    <div class="col-md-12 d-flex">
                                                        <select class="form-control mr-2" name="entry_by">
                                                        <option value="">Entry By</option>';
                                                            $sql="SELECT id,name FROM accounts WHERE userRelation='".$_SESSION['userRel']."'";
                                                            $result=mysqli_query($conn,$sql);
                                                            if(mysqli_num_rows($result)>0){
                                                            while($row=mysqli_fetch_array($result)){
                                                        echo'<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                                    }}
                                                    echo'</select>
                                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>';
                                }?>
                            </div>
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>JOB ID</th>
                                            <th>Company Name</th>
                                            <th>Candidate Name</th>
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
                                            $sql = "SELECT * FROM joined WHERE entry_by='".$userRel."'";
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
                                            // Searching for Entry By
                                        if($userRel==$userId){
                                            if(isset($_GET['entry_by'])){
                                                $entry_by=$_GET['entry_by'];
                                                $sql= "SELECT * FROM joined WHERE entry_by='".$userRel."' AND user_id='".$entry_by."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM joined WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }else{
                                                $sql= 'SELECT * FROM joined WHERE entry_by="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                            }
                                        }else{
                                            if(isset($_GET['entry_by'])){
                                                $entry_by=$_GET['entry_by'];
                                                $sql= "SELECT * FROM joined WHERE entry_by='".$userRel."' AND user_id='".$entry_by."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM joined WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }else{
                                                $sql= 'SELECT * FROM joined WHERE entry_by="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                            }
                                        }
                                            if(mysqli_query($conn,$sql)){
                                                echo "";
                                            }else{
                                                echo "Error". $sql . "<br>". mysqli_error($conn);
                                            }
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                            while($row= mysqli_fetch_array($result)){
                                                // $join=date_create($row['joined_on']);
                                                // // Changing Date Format to display as 19 Dec 2003 04:00 PM
                                                // $joined=date_format($join,"d M Y");
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['id'];?></td>
                                            <td><?php echo'J-'.$row['job_id'];?></td>
                                            <?php
                                                $job_id=$row['job_id'];
                                                $ris="SELECT * FROM jobs WHERE id='".$job_id."'";
                                                $rish=mysqli_query($conn,$ris);
                                                if(mysqli_num_rows($rish)>0){
                                                while($rows=mysqli_fetch_array($rish)){
                                                ?>
                                                <?php echo '<td>'.$rows['com_name'].'</td>';?>
                                            <?php }}?>
                                            <?php
                                                $can_id=$row['can_id'];
                                                $ris="SELECT * FROM candidates WHERE id='".$can_id."'";
                                                $rish=mysqli_query($conn,$ris);
                                                if(mysqli_num_rows($rish)>0){
                                                while($rows=mysqli_fetch_array($rish)){
                                                ?>
                                                <?php echo '<td>'.$rows['name'].'</td>';?>
                                            <?php }}?>
                                            <td><?php echo $row['status'];?></td>
                                            <td style="text-align:center;"><?php echo'<a class="btn btn-circle btn-primary" href="joined-list-view.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-circle btn-primary" href="joined-list-edit.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-pen"></i></a>';
                                            if($_SESSION['id']==2){
                                                echo '</td>';
                                            }elseif ($_SESSION['id']!=2){
                                            echo'<a class="btn btn-circle btn-danger" href="joined-list-delete.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-trash"></i></a></td>';
                                            }?>
                                        </tr>
                                    </tbody>
                                        <?php
                                        }
                                    }else{
                                        echo '<td colspan="6" style="text-align:center;">Oops!! 0 results</td>';
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
                        <?php
                            for($page=1;$page<=$pagenumbers;$page++){?>
                                <li class="nav-item">
                                    <?php
                                        if(isset($_GET['entry_by'])){
                                            if(isset($_GET['page']) && $_GET['page']==$page){
                                                echo '<a href="joined-list.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }elseif(!isset($_GET['page']) && $page==1){
                                                echo '<a href="joined-list.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }else{
                                                echo '<a href="joined-list.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }
                                        }else{
                                            if(isset($_GET['page']) && $_GET['page']==$page){
                                                echo '<a href="joined-list.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }elseif(!isset($_GET['page']) && $page==1){
                                                echo '<a href="joined-list.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }else{
                                                echo '<a href="joined-list.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
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
