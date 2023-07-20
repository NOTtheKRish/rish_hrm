<?php
include('session.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/packageCheck.php');
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
                        <h1 class="h3 mb-2 text-gray-800">Interview Sent</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
                            <?php
                                if(isset($_GET['status'])||isset($_GET['entry_by'])){
                                    echo'<a class="d-none d-sm-inline-block btn btn-danger shadow-sm" href="interview-sent.php">
                                        <i class="fas fa-minus-circle text-white-50"></i>
                                        Remove Filters
                                    </a>';
                                }else{
                                    echo'';
                                }
                            ?>
                            <a href="interview-sent-create.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-plus mr-2 fa-sm"></i>Create New Interview Sent</a>
                        </div>

                        <div class="card-body">
                            <!-- Create New Interview Sent Zone Starts -->
                            <?php
                                if (isset($_POST["create"])){
                                    // Data being Inserted into the Database
                                    $entry_by=$_SESSION['userRel'];
                                    $userId=$_SESSION['userId'];
                                    $previous=$_POST['previous'];
                                    $sql="INSERT INTO interview_sent (can_id,job_id,sent_date,status,entry_by,user_id)
                                    VALUES ('".$_POST['can_id']."','".$_POST['job_id']."','".$_POST['sent_date']."','".$_POST['sent_status']."','".$entry_by."','".$userId."')";
                                    $result=mysqli_query($conn,$sql);

                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon: "success",
                                                    title: "Success!",
                                                    text: "New Interview Sent Created Successfully!",
                                                    button: "Close",
                                                }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                            },500);
                                        </script>';
                                }
                            ?>
                            <!-- Create New Interview Zone Ends -->

                            <!-- Edit Interview Sent Zone Starts -->
                            <?php
                                if (isset($_POST["update"])){
                                    $previous=$_POST['previous'];
                                    $sent_id=$_POST['sent_id'];
                                    /*$can_id=$_POST['can_id'];
                                    $job_id=$_POST['job_id'];*/
                                    $sent_date=$_POST['sent_date'];
                                    $status=$_POST['sent_status'];
                                    $sql="UPDATE interview_sent
                                    SET sent_date='".$sent_date."', status='".$status."'
                                    WHERE id='".$sent_id."'";
                                    $query=mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                                setTimeout(function(){
                                                    swal({
                                                        icon:"success",
                                                        title:"Success!",
                                                        text:"Interview Sent Data Updated Successfully!",
                                                        button: "Close",
                                                    }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                                },500);
                                            </script>';
                                }
                            ?>
                            <!-- Edit Interview Sent Zone Ends -->

                            <!-- Delete Interview Sent Zone Starts -->
                            <?php
                                if (isset($_POST["delete"])){
                                    $delete_id=$_POST['sent_id'];
                                    $previous=$_POST['previous'];
                                    $sql="DELETE FROM interview_sent WHERE id='".$delete_id."'";
                                    $result=mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"Interview Sent Data Deleted Successfully!",
                                                    button: "Close",
                                                }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                            },500);
                                        </script>';
                                }
                            ?>
                            <!-- Delete Interview Sent Zone Ends -->

                        <div class="table-responsive">
                            <div class="dataTable-filter">
                            <div class="col-md-12 d-flex">
                                <form action="interview-sent.php" method="GET">
                                    <div class="row mt-1">
                                        <div class="d-flex col-md-12">
                                                <select class="form-control mr-1" name="status">
                                                    <option value="">Status</option>
                                                    <?php
                                                        $sql="SELECT * FROM sent_status";
                                                        $result=mysqli_query($conn,$sql);
                                                        if(mysqli_num_rows($result)>0){
                                                        while($row=mysqli_fetch_array($result)){
                                                    ?>
                                                    <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                                    <?php }}?>
                                                </select>
                                            <button class="btn btn-primary btn-circle"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="d-flex">
                                    <?php
                                        if($_SESSION['id']!=2){
                                            echo'<div class="col-md-12">
                                                <form action="" id="form" method="GET">
                                                    <div class="d-flex mt-1">
                                                        <div class="col-md-12">
                                                            <select class="form-control" name="entry_by" oninput="search()" >
                                                            <option value="">Entry By</option>';
                                                                $sql="SELECT id,name FROM accounts WHERE userRelation='".$_SESSION['userRel']."'";
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
                                    }?>
                                </div>
                            </div>
                            </div>
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Interview Sent Date</th>
                                            <th>JOB ID</th>
                                            <th>Company Name</th>
                                            <th>Candidate Name</th>
                                            <th>Candidate Number</th>
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
                                            $userRel=$_SESSION['userRel'];
                                            $userId=$_SESSION['userId'];
                                        // Finding out the total number of data in the table
                                            $sql = "SELECT * FROM interview_sent WHERE entry_by='".$userRel."'";
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
                                        //Filtering with INterview Sent Status
                                        if($userRel==$userId){
                                            if(isset($_GET['status'])){
                                                $status=$_GET['status'];
                                                $sql="SELECT * FROM interview_sent WHERE status='".$status."' AND entry_by='".$userRel."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql="SELECT * FROM interview_sent WHERE status='".$status."' AND entry_by='".$userRel."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }elseif(isset($_GET['entry_by'])){
                                                $entry_by=$_GET['entry_by'];
                                                $sql= "SELECT * FROM interview_sent WHERE entry_by='".$userRel."' AND user_id='".$entry_by."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM interview_sent WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }else{
                                                $sql='SELECT * FROM interview_sent WHERE entry_by="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                            }
                                        }else{
                                            if(isset($_GET['status'])){
                                                $status=$_GET['status'];
                                                $sql="SELECT * FROM interview_sent WHERE status='".$status."' AND entry_by='".$userRel."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql="SELECT * FROM interview_sent WHERE status='".$status."' AND entry_by='".$userRel."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }elseif(isset($_GET['entry_by'])){
                                                $entry_by=$_GET['entry_by'];
                                                $sql= "SELECT * FROM interview_sent WHERE entry_by='".$userRel."' AND user_id='".$entry_by."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM interview_sent WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }else{
                                                $sql='SELECT * FROM interview_sent WHERE entry_by="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
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
                                                $sen=date_create($row['sent_date']);
                                                // Changing Date Format to display as 19 Dec 2003 04:00 PM
                                                $sent=date_format($sen,"d M Y");
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['id'];?></td>
                                            <td><?php echo $sent;?></td>
                                            <?php
                                                $job_id=$row['job_id'];
                                                $ris="SELECT * FROM jobs WHERE id='".$job_id."'";
                                                $rish=mysqli_query($conn,$ris);
                                                if(mysqli_num_rows($rish)>0){
                                                    while($rows=mysqli_fetch_array($rish)){
                                                        ?>
                                                <td><?php echo'J-'.$rows['job_id'];?></td>
                                                <td><?php echo $rows['com_name'];?></td>
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
                                            <?php
                                                $can_id=$row['can_id'];
                                                $ris="SELECT * FROM candidates WHERE id='".$can_id."'";
                                                $rish=mysqli_query($conn,$ris);
                                                if(mysqli_num_rows($rish)>0){
                                                while($rows=mysqli_fetch_array($rish)){
                                                ?>
                                                <?php echo '<td>'.$rows['number'].'</td>';?>
                                            <?php }}?>
                                            <td><?php echo $row['status'];?></td>
                                            <td style="text-align:center;"><?php echo'<a class="btn btn-circle btn-primary" href="interview-sent-view.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-circle btn-primary" href="interview-sent-edit.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-pen"></i></a>';
                                            if($_SESSION['id']==2){
                                                echo '</td>';
                                            }elseif ($_SESSION['id']!=2){
                                            echo'<a class="btn btn-circle btn-danger" href="interview-sent-delete.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-trash"></i></a></td>';
                                            }?>
                                        </tr>
                                    </tbody>
                                        <?php
                                        }
                                    }else{
                                        echo '<td class="text-center" colspan="8">Oops!! 0 results</td>';
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
                                                    echo '<a href="interview-sent.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="interview-sent.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="interview-sent.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }
                                            }elseif(isset($_GET['status'])){
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="interview-sent.php?status='.$status.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="interview-sent.php?status='.$status.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="interview-sent.php?status='.$status.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }
                                            }else{
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="interview-sent.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="interview-sent.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="interview-sent.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
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
<script>
    function search(){
        document.getElementById("form").submit();
    }
</script>
