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
                        <h1 class="h3 mb-2 text-gray-800">Company</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
                            <?php
                                if(isset($_GET['company']) || isset($_GET['entry_by'])){
                                    echo'<a class="d-none d-sm-inline-block btn btn-danger shadow-sm" href="company.php">
                                        <i class="fas fa-minus-circle text-white-50"></i>
                                        Remove Filters
                                    </a>';
                                }else{
                                    echo'';
                                }
                            ?>
                            <a href="company-create.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-plus mr-2 fa-sm"></i>Add New Company</a>
                        </div>

                        <div class="card-body">
                            <!-- Create New Company Zone Starts -->
                            <?php
                                if (isset($_POST["create"])){
                                    $previous = $_POST['previous'];

                                    $co = "SELECT com FROM accounts WHERE id='".$_SESSION['userRel']."'";
                                    $cou = mysqli_query($conn,$co);
                                    while($coun = mysqli_fetch_array($cou)){
                                        $count = ($coun['com'])+1;
                                    }
                                    // Data being Inserted into the Database
                                    $entry_by = $_SESSION['userRel'];
                                    $userId = $_SESSION['userId'];
                                    date_default_timezone_set('Asia/Kolkata');
                                    $created_at = date('Y-m-d H:i:s');
                                    $sql = "INSERT INTO company (com_id,name,contact_person,number,add_number,email,gst_no,industry_type,address,entry_by,user_id,created_at)
                                    VALUES ('".$count."','".$_POST['com_name']."','".$_POST['contact_person']."','".$_POST['number']."','".$_POST['add_number']."','".$_POST['com_email']."','".$_POST['gst_no']."','".$_POST['industry_type']."','".$_POST['address']."','".$entry_by."','".$userId."','".$created_at."')";
                                    $result=mysqli_query($conn,$sql);

                                    //updating com count in accounts table
                                    $sql = "UPDATE accounts SET com = '".$count."' WHERE id='".$_SESSION['userRel']."'";
                                    $res = mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                                setTimeout(function(){
                                                    swal({
                                                        icon:"success",
                                                        title:"Success!",
                                                        text:"New Company Created Successfully!",
                                                        button: "Close",
                                                    }).then(function(){
                                                         window.location.href="'.$previous.'"
                                                     });
                                                },500);
                                            </script>';
                                }
                            ?>
                            <!-- Create New Company Zone Ends -->

                            <!-- Edit Company Zone Starts -->
                            <?php
                                if (isset($_POST["update"])){
                                    $previous = $_POST['previous'];
                                    $com_id = $_POST['com_id'];
                                    $com_name = $_POST['com_name'];
                                    $contact_person = $_POST['contact_person'];
                                    $number = $_POST['number'];
                                    $add_number = $_POST['add_number'];
                                    $email = $_POST['com_email'];
                                    $gst = $_POST['gst_no'];
                                    $address = $_POST['address'];
                                    $industry_type = $_POST['industry_type'];
                                    $sql = "UPDATE company SET name='".$com_name."', contact_person='".$contact_person."', number='".$number."', add_number='".$add_number."', email='".$email."',gst_no='".$gst."',industry_type='".$industry_type."',address='".$address."' WHERE id='".$com_id."'";
                                    $query = mysqli_query($conn,$sql);

                                    echo '<script type="text/javascript">
                                                setTimeout(function(){
                                                    swal({
                                                        icon:"success",
                                                        title:"Success!",
                                                        text:"Company Data Modified Successfully",
                                                        button: "Close",
                                                    }).then(function(){
                                                         window.location.href="'.$previous.'"
                                                     });
                                                },500);
                                            </script>';
                                }
                            ?>
                            <!-- Edit Company Zone Ends -->

                            <!-- Delete Company Zone Starts -->
                            <?php
                                if (isset($_POST["delete"])){
                                    $delete_id = $_POST['com_id'];
                                    $previous = $_POST['previous'];
                                    $sql = "DELETE FROM company WHERE id='".$delete_id."'";
                                    $result = mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                                setTimeout(function(){
                                                    swal({
                                                        icon:"warning",
                                                        title:"Success!",
                                                        text:"Company Data Deleted Successfully",
                                                        button: "Close",
                                                    }).then(function(){
                                                         window.location.href="'.$previous.'"
                                                     });
                                                },500);
                                            </script>';
                                }
                            ?>
                        <!-- Delete Company Zone Ends -->

                            <div class="table-responsive">
                            <div class="dataTable-filter">
                                <form action="company.php" method="GET">
                                    <div class="row d-flex mt-1">
                                        <div class="col-md-3 d-flex">
                                            <div class="col-md-10">
                                                <select class="form-control" name="company" style="border:2px solid #0070ff;border-radius:3px;margin-right:3px;">
                                                    <option value="">Select Company</option>
                                                    <?php
                                                        $sql="SELECT * FROM company WHERE entry_by='".$_SESSION['userRel']."'";
                                                        $result=mysqli_query($conn,$sql);
                                                        if(mysqli_num_rows($result)>0){
                                                        while($row=mysqli_fetch_array($result)){
                                                    ?>
                                                    <?php echo'<option value="'.$row['name'].'">'.$row['name'].'</option>';?>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-primary btn-circle"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                        <?php
                                            if($_SESSION['id']==1){
                                                echo'<div class="col-md-3">
                                                    <form action="company.php" id="rishi" method="GET">
                                                        <div class="d-flex">
                                                            <div class="col-md-12">
                                                                <select class="form-control" name="entry_by" oninput="s()" style="border: 2px solid #0070ff; border-radius: 3px;">
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
                                            }
                                        ?>
                                    </div>
                            </div>
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Company ID</th>
                                            <th>Company Name</th>
                                            <th>Contact Number</th>
                                            <th>Address</th>
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
                                            $sql = "SELECT * FROM company WHERE entry_by='".$userRel."'";
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
                                        //Searching with Candidate ID
                                        if($userRel==$userId){
                                            if(isset($_GET['company'])){
                                                $company=$_GET['company'];
                                                $sql= "SELECT * FROM company WHERE entry_by='".$userRel."' AND name='".$company."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM company WHERE entry_by='".$userRel."' AND name='".$company."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }elseif(isset($_GET['entry_by'])){
                                                    $entry_by=$_GET['entry_by'];
                                                    $sql= "SELECT * FROM company WHERE entry_by='".$userRel."' AND user_id='".$entry_by."'";
                                                        $result = mysqli_query($conn,$sql);
                                                        $result_num = mysqli_num_rows($result);
                                                        // Determine number of total pages available
                                                        $pagenumbers = ceil($result_num/$pagereslimit);
                                                    $sql= "SELECT * FROM company WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }else{
                                                $sql= 'SELECT * FROM company WHERE entry_by="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                            }
                                        }else{
                                            if(isset($_GET['company'])){
                                                $company=$_GET['company'];
                                                $sql= "SELECT * FROM company WHERE entry_by='".$userRel."' AND name='".$company."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM company WHERE entry_by='".$userRel."' AND name='".$company."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }elseif(isset($_GET['entry_by'])){
                                                    $entry_by=$_GET['entry_by'];
                                                    $sql= "SELECT * FROM company WHERE entry_by='".$userRel."'";
                                                        $result = mysqli_query($conn,$sql);
                                                        $result_num = mysqli_num_rows($result);
                                                        // Determine number of total pages available
                                                        $pagenumbers = ceil($result_num/$pagereslimit);
                                                    $sql= "SELECT * FROM company WHERE entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }else{
                                                $sql= 'SELECT * FROM company WHERE entry_by="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                            }
                                        }
                                        // Searching for Entry By
                                            // if(isset($_GET['entry_by'])){
                                            //     $entry_by=$_GET['entry_by'];
                                            //     $sql= "SELECT * FROM company WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            // }
                                            if(mysqli_query($conn,$sql)){
                                                echo "";
                                            }else{
                                                echo "Error". $sql . "<br>". mysqli_error($conn);
                                            }
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {

                                            while($row= mysqli_fetch_array($result)){
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo 'E-'.$row['com_id'];?></td>
                                            <td><?php echo $row['name'];?></td>
                                            <td><?php echo $row['number'];?></td>
                                            <td><?php echo $row['address'];?></td>
                                            <td style="text-align:center;"><?php echo'<a class="btn btn-circle btn-primary mb-1" href="company-view.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-circle btn-primary mr-1 mb-1" href="vacancy-create.php?company='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-plus-square"></i></a>';
                                            echo'<a class="btn btn-circle btn-success mr-1" target="_blank" href="https://wa.me/91'.$row['number'].'"><i class="fab fa-lg fa-whatsapp"></i></a><br>';
                                            echo'<a class="btn btn-circle btn-primary mr-1" href="company-edit.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-pen"></i></a>';
                                            if($_SESSION['id']==2){
                                                echo '</td>';
                                            }elseif ($_SESSION['id']!=2){
                                            echo'<a class="btn btn-circle btn-danger" href="company-delete.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-trash"></i></a></td>';
                                            }?>
                                        </tr>
                                    </tbody>
                                        <?php
                                        }
                                    } else{
                                        echo '<td colspan="6" class="text-center">Oops!! 0 results</td>';
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
                        <ul class="nav tm-paging-links">
                        <!-- <li class="nav-item" id="prev"><a href="#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 10px;margin-bottom: 10px"><</a></li> -->
                            <?php
                                for($page=1;$page<=$pagenumbers;$page++){?>
                                    <li class="nav-item">
                                        <?php
                                            if(isset($_GET['entry_by'])){
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="company.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="company.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="company.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }
                                            }else{
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="company.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="company.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="company.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
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

<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>
<script type="text/javascript">
    function s(){
        document.getElementById("rishi").submit();
    }
</script>
