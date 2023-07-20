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
                        <h1 class="h3 mb-2 text-gray-800">Vendors</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
                            <?php
                                if(isset($_GET['search']) || isset($_GET['entry_by']) || isset($_GET['status'])){
                                    echo'<a class="d-inline-block btn btn-danger shadow-sm mt-2" href="vendors.php">
                                        <i class="fas fa-minus-circle text-white-50"></i>
                                        Remove Filters
                                    </a>';
                                }else{
                                    echo'';
                                }
                            ?>
                            <div class="">
                                <a href="vendors-create.php" class="btn btn-primary shadow-sm mt-2">
                                    <i class="fas fa-plus mr-2 fa-sm"></i>Add New</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Create New Vendor Zone Starts -->
                            <?php
                                if (isset($_POST["create"])){
                                    $previous=$_POST['previous'];

                                    $co="SELECT vendors FROM accounts WHERE id='".$_SESSION['userRel']."'";
                                    $cou=mysqli_query($conn,$co);
                                    while($coun=mysqli_fetch_array($cou)){
                                        $count=($coun['vendors'])+1;
                                    }
                                    // Data being Inserted into the Database
                                    date_default_timezone_set('Asia/Kolkata');
                                    $created_at = date('Y-m-d');
                                    $vendor_name=$_POST['vendor_name'];
                                    $store_name=$_POST['store_name'];

                                    // manipulating uploaded documents in an array
                                    $uploadedDocument=array();
                                    $c=count($_FILES['document']['name']);

                                    for($i=0 ; $i<$c ; $i++){
                                        $file=$_FILES['document'][$i];
                                        $fileName=$_FILES['document']['name'][$i];
                                        $fileTmpName=$_FILES['document']['tmp_name'][$i];
                                        $fileError=$_FILES['document']['error'][$i];
                                        $fileType=$_FILES['document']['type'][$i];


                                        $fileExt=explode('.',$fileName);
                                        $fileActualExt=strtolower(end($fileExt));

                                        $allowed=array('jpg','jpeg','png','pdf');

                                        if(in_array($fileActualExt,$allowed)){
                                            if($fileError==0){
                                                    $fileNameNew=$vendor_name."-".$i."-".$store_name.".".$fileActualExt;
                                                    $fileDestination='uploads/vendor/'.$fileNameNew;
                                                    move_uploaded_file($fileTmpName,$fileDestination);

                                                    array_push($uploadedDocument,$fileNameNew);
                                            }else{
                                                echo "There was an error uploading the file... Try Again!";
                                            }
                                        }else{
                                            // echo "You cannot upload this file type...";
                                        }
                                    }

                                    $entry_by=$_SESSION['userRel'];
                                    $userId=$_SESSION['userId'];

                                    if(array_key_exists(3,$uploadedDocument)){
                                        $sql="INSERT INTO vendors (vendor_id,name,store_name,number,landline,vehicle_details,vehicle_reg,document,document2,document3,document4,sell_interest,email,gst_no,address,details,status,entry_by,user_id,created_at)
                                                VALUES('".$count."','".$_POST['vendor_name']."','".$_POST['store_name']."','".$_POST['number']."','".$_POST['landline']."','".$_POST['vehicle_details']."','".$_POST['vehicle_reg']."','".$uploadedDocument[0]."','".$uploadedDocument[1]."','".$uploadedDocument[2]."','".$uploadedDocument[3]."','".$_POST['sell_interest']."','".$_POST['vendor_email']."','".$_POST['gst_no']."','".$_POST['address']."','".$_POST['details']."','".$_POST['status']."','".$entry_by."','".$userId."','".$created_at."')";
                                    }elseif(array_key_exists(2,$uploadedDocument)){
                                        $sql="INSERT INTO vendors (vendor_id,name,store_name,number,landline,vehicle_details,vehicle_reg,document,document2,document3,sell_interest,email,gst_no,address,details,status,entry_by,user_id,created_at)
                                        VALUES('".$count."','".$_POST['vendor_name']."','".$_POST['store_name']."','".$_POST['number']."','".$_POST['landline']."','".$_POST['vehicle_details']."','".$_POST['vehicle_reg']."','".$uploadedDocument[0]."','".$uploadedDocument[1]."','".$uploadedDocument[2]."','".$_POST['sell_interest']."','".$_POST['vendor_email']."','".$_POST['gst_no']."','".$_POST['address']."','".$_POST['details']."','".$_POST['status']."','".$entry_by."','".$userId."','".$created_at."')";
                                    }elseif(array_key_exists(1,$uploadedDocument)){
                                        $sql="INSERT INTO vendors (vendor_id,name,store_name,number,landline,vehicle_details,vehicle_reg,document,document2,sell_interest,email,gst_no,address,details,status,entry_by,user_id,created_at)
                                        VALUES('".$count."','".$_POST['vendor_name']."','".$_POST['store_name']."','".$_POST['number']."','".$_POST['landline']."','".$_POST['vehicle_details']."','".$_POST['vehicle_reg']."','".$uploadedDocument[0]."','".$uploadedDocument[1]."','".$_POST['sell_interest']."','".$_POST['vendor_email']."','".$_POST['gst_no']."','".$_POST['address']."','".$_POST['details']."','".$_POST['status']."','".$entry_by."','".$userId."','".$created_at."')";
                                    }elseif(array_key_exists(0,$uploadedDocument)){
                                        $sql="INSERT INTO vendors (vendor_id,name,store_name,number,landline,vehicle_details,vehicle_reg,document,sell_interest,email,gst_no,address,details,status,entry_by,user_id,created_at)
                                        VALUES('".$count."','".$_POST['vendor_name']."','".$_POST['store_name']."','".$_POST['number']."','".$_POST['landline']."','".$_POST['vehicle_details']."','".$_POST['vehicle_reg']."','".$uploadedDocument[0]."','".$_POST['sell_interest']."','".$_POST['vendor_email']."','".$_POST['gst_no']."','".$_POST['address']."','".$_POST['details']."','".$_POST['status']."','".$entry_by."','".$userId."','".$created_at."')";
                                    }else{
                                        $sql="INSERT INTO vendors (vendor_id,name,store_name,number,landline,vehicle_details,vehicle_reg,sell_interest,email,gst_no,address,details,status,entry_by,user_id,created_at)
                                        VALUES ('".$count."','".$_POST['vendor_name']."','".$_POST['store_name']."','".$_POST['number']."','".$_POST['landline']."','".$_POST['vehicle_details']."','".$_POST['vehicle_reg']."','".$_POST['sell_interest']."','".$_POST['vendor_email']."','".$_POST['gst_no']."','".$_POST['address']."','".$_POST['details']."','".$_POST['status']."','".$entry_by."','".$userId."','".$created_at."')";
                                    }
                                    $result=mysqli_query($conn,$sql);

                                    $sql="UPDATE accounts SET vendors='".$count."' WHERE id='".$_SESSION['userRel']."'";
                                    $res=mysqli_query($conn,$sql);

                                    echo '<script type="text/javascript">
                                             setTimeout(function(){
                                                 swal({
                                                     icon:"success",
                                                     title:"Success!",
                                                     text:"New Vendor Created Successfully",
                                                     button: "Close",
                                                 }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                             },500);
                                         </script>';
                                }
                            ?>
                            <!-- Create New Vendor Zone Ends -->

                            <!-- Edit Vendor Zone Starts -->
                            <?php
                                if (isset($_POST["update"])){
                                    $previous=$_POST['previous'];
                                    $vendor_id=$_POST['vendor_id'];
                                    $vendor_name=$_POST['vendor_name'];
                                    $store_name=$_POST['store_name'];
                                    $number=$_POST['number'];
                                    $landline=$_POST['landline'];
                                    $vehicle_details=$_POST['vehicle_details'];
                                    $vehicle_reg=$_POST['vehicle_reg'];

                                    // manipulating uploaded task image
                                    $file=$_FILES['document'];
                                    $fileName=$_FILES['document']['name'];
                                    $fileTmpName=$_FILES['document']['tmp_name'];
                                    $fileError=$_FILES['document']['error'];
                                    $fileType=$_FILES['document']['type'];

                                    $fileExt=explode('.',$fileName);
                                    $fileActualExt=strtolower(end($fileExt));
                                    $allowed=array('jpg','jpeg','png','pdf');

                                    if(in_array($fileActualExt,$allowed)){
                                        if($fileError==0){
                                                $fileNameNew=$vendor_name."-".$store_name.".".$fileActualExt;
                                                $fileDestination='uploads/vendor/'.$fileNameNew;
                                                if(file_exists("uploads/vendor/$fileNameNew")) unlink("uploads/vendor/$fileNameNew");
                                                move_uploaded_file($fileTmpName,$fileDestination);
                                        }else{
                                            echo "There was an error uploading the file... Try Again!";
                                        }
                                    }else{
                                        // echo "You cannot upload this file type...";
                                    }

                                    $sell_interest=$_POST['sell_interest'];
                                    $email=$_POST['vendor_email'];
                                    $gst_no=$_POST['gst_no'];
                                    $address=$_POST['address'];
                                    $details=$_POST['details'];
                                    $status=$_POST['status'];
                                    if(isset($fileNameNew)){
                                        $sql="UPDATE vendors SET name='".$vendor_name."', store_name='".$store_name."', number='".$number."', landline='".$landline."', vehicle_details='".$vehicle_details."',vehicle_reg='".$vehicle_reg."',document='".$fileNameNew."', sell_interest='".$sell_interest."', email='".$email."',gst_no='".$gst_no."',address='".$address."',details='".$details."',status='".$status."'
                                        WHERE id='".$vendor_id."'";
                                    }else{
                                        $sql="UPDATE vendors SET name='".$vendor_name."', store_name='".$store_name."', number='".$number."', landline='".$landline."', vehicle_details='".$vehicle_details."',vehicle_reg='".$vehicle_reg."', sell_interest='".$sell_interest."', email='".$email."',gst_no='".$gst_no."',address='".$address."',details='".$details."',status='".$status."'
                                        WHERE id='".$vendor_id."'";
                                    }
                                    $query=mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"Vendor Data Modified Successfully",
                                                    button: "Close",
                                                }).then(function(){
                                                    window.location.href="'.$previous.'"
                                                });
                                            },500);
                                        </script>';
                                }
                            ?>
                            <!-- Edit Vendor Zone Ends -->

                            <!-- Delete Vendor Zone Starts -->
                            <?php
                                if (isset($_POST["delete"])){
                                    $delete_id=$_POST['vendor_id'];
                                    $previous=$_POST['previous'];
                                    $sql="DELETE FROM vendors WHERE id='".$delete_id."'";
                                    $result=mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"info",
                                                    title:"Success!",
                                                    text:"Vendor Data Deleted Successfully",
                                                    button: "Close",
                                                }).then(function(){
                                                    window.location.href="'.$previous.'"
                                                });
                                            },500);
                                        </script>';
                                }
                            ?>
                        <!-- Delete Vendor Zone Ends -->

                        <div class="table-responsive">
                            <div class="dataTable-filter">
                            <div class="row col-md-12 mt-1">
                                <form action="vendors.php" method="GET">
                                    <div class="col-md-12">
                                        <div class="d-flex">
                                            <input class="form-control" type="text" placeholder="Search" name="search">
                                            <button class="btn btn-primary btn-circle ml-1" type="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <form action="vendors.php" method="GET">
                                    <div class="col-md-12">
                                        <div class="d-flex">
                                                <select class="form-control" name="status" oninput="this.form.submit();">
                                                    <option value="">Vendor Status</option>
                                                    <?php
                                                        $sql="SELECT * FROM vendor_status ORDER BY disp_order ASC";
                                                        $result=mysqli_query($conn,$sql);
                                                        if(mysqli_num_rows($result)>0){
                                                        while($row=mysqli_fetch_array($result)){
                                                    ?>
                                                    <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                                    <?php }}?>
                                                </select>
                                            <button class="btn btn-primary btn-circle ml-1"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-md-3">
                                    <?php
                                        if($_SESSION['id']==1 || $_SESSION['id']==0){
                                            echo'<form action="" id="form" method="GET">
                                                    <div class="d-flex">
                                                        <div class="col-md-12">
                                                            <select class="form-control" name="entry_by" oninput="search()">
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
                                                </form>';
                                        }else{
                                            echo'';
                                        }
                                        ?>
                                </div>
                            </div>
                            </div>
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Vendor ID</th>
                                            <th>Vendor Name</th>
                                            <th>Store Name</th>
                                            <th>Contact Number</th>
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
                                        if($userRel==$userId){
                                            $sql = "SELECT * FROM vendors WHERE entry_by='".$_SESSION['userRel']."'";
                                        }else{
                                            $sql = "SELECT * FROM vendors WHERE entry_by='".$_SESSION['userRel']."' AND user_id='".$userId."'";
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
                                        // Retrieve selective values according to the page
                                        //Filtering with Call Status
                                        if($userRel==$userId){
                                            if(!isset($_GET['status'])){
                                                $sql='SELECT * FROM vendors WHERE entry_by="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                            }else{
                                                $status=$_GET['status'];
                                                $sql="SELECT * FROM vendors WHERE status='".$status."' AND entry_by='".$userRel."'";
                                                $result = mysqli_query($conn,$sql);
                                                $result_num = mysqli_num_rows($result);
                                                // Determine number of total pages available
                                                $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql="SELECT * FROM vendors WHERE status='".$status."' AND entry_by='".$userRel."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }
                                        // Searching for Entry By
                                            if(isset($_GET['entry_by'])){
                                                $entry_by=$_GET['entry_by'];
                                                $sql= "SELECT * FROM vendors WHERE entry_by='".$userRel."' AND user_id='".$entry_by."'";
                                                $result = mysqli_query($conn,$sql);
                                                $result_num = mysqli_num_rows($result);
                                                // Determine number of total pages available
                                                $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM vendors WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }
                                            if(isset($_GET['search'])){
                                                $search=$_GET['search'];
                                                $sql="SELECT * FROM vendors WHERE number='".$search."' OR name LIKE '%".$search."%' OR store_name LIKE '%".$search."%' AND entry_by='".$entry_by."'";
                                                $result = mysqli_query($conn,$sql);
                                                $result_num = mysqli_num_rows($result);
                                                // Determine number of total pages available
                                                $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql="SELECT * FROM vendors WHERE number='".$search."' OR name LIKE '%".$search."%' OR store_name LIKE '%".$search."%' AND entry_by='".$entry_by."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }
                                        }else{
                                            if(!isset($_GET['status'])){
                                                $sql='SELECT * FROM vendors WHERE entry_by="'.$userRel.'" AND user_id="'.$userId.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                            }else{
                                                $status=$_GET['status'];
                                                $sql="SELECT * FROM vendors WHERE status='".$status."' AND entry_by='".$userRel."' AND user_id='".$userId."'";
                                                $result = mysqli_query($conn,$sql);
                                                $result_num = mysqli_num_rows($result);
                                                // Determine number of total pages available
                                                $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql="SELECT * FROM vendors WHERE status='".$status."' AND entry_by='".$userRel."' AND user_id='".$userId."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }
                                        // Searching for Entry By
                                            if(isset($_GET['entry_by'])){
                                                $entry_by=$_GET['entry_by'];
                                                $sql= "SELECT * FROM vendors WHERE entry_by='".$userRel."' AND user_id='".$entry_by."'";
                                                $result = mysqli_query($conn,$sql);
                                                $result_num = mysqli_num_rows($result);
                                                // Determine number of total pages available
                                                $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM vendors WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }
                                            if(isset($_GET['search'])){
                                                $search=$_GET['search'];
                                                $sql="SELECT * FROM vendors WHERE number='".$search."' OR name LIKE '%".$search."%' OR store_name LIKE '%".$search."%' AND entry_by='".$entry_by."' AND user_id='".$userId."'";
                                                $result = mysqli_query($conn,$sql);
                                                $result_num = mysqli_num_rows($result);
                                                // Determine number of total pages available
                                                $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql="SELECT * FROM vendors WHERE number='".$search."' OR name LIKE '%".$search."%' OR store_name LIKE '%".$search."%' AND entry_by='".$entry_by."' AND user_id='".$user_id."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
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
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo 'V-'.$row['id'];?></td>
                                            <td><?php echo $row['name'];?></td>
                                            <td><?php echo $row['store_name'];?></td>
                                            <td><?php echo $row['number'];?></td>
                                            <td><?php echo $row['status'];?></td>
                                            <td style="text-align:center;"><?php echo'<a class="btn btn-circle btn-primary" href="vendors-view.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-circle btn-primary mr-1" href="vendors-edit.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-pen"></i></a>';
                                            echo'<a class="btn btn-circle btn-success mr-1" target="_blank" href="https://wa.me/91'.$row['number'].'"><i class="fab fa-lg fa-whatsapp"></i></a>';
                                            echo'<a class="btn btn-circle btn-primary mr-1" target="_blank" href="mailer.php?email='.$row['email'].'"><i class="fas fa-lg fa-envelope"></i></a>';
                                            if($_SESSION['id']!=1){
                                                echo '</td>';
                                            }elseif ($_SESSION['id']!=2){
                                                echo'<a class="btn btn-circle btn-danger" href="vendors-delete.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-trash"></i></a></td>';
                                            }?>
                                        </tr>
                                    </tbody>
                                        <?php
                                        }
                                    } else{
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
                        <!-- <li class="nav-item" id="prev"><a href="#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 10px;margin-bottom: 10px"><</a></li> -->
                        <?php
                            for($page=1;$page<=$pagenumbers;$page++){?>
                                <li class="nav-item">
                                    <?php
                                        if(isset($_GET['entry_by'])){
                                            if(isset($_GET['page']) && $_GET['page']==$page){
                                                echo '<a href="vendors.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }elseif(!isset($_GET['page']) && $page==1){
                                                echo '<a href="vendors.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }else{
                                                echo '<a href="vendors.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }
                                        }elseif(isset($_GET['status'])){
                                            if(isset($_GET['page']) && $_GET['page']==$page){
                                                echo '<a href="vendors.php?status='.$status.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }elseif(!isset($_GET['page']) && $page==1){
                                                echo '<a href="vendors.php?status='.$status.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }else{
                                                echo '<a href="vendors.php?status='.$status.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }
                                        }else{
                                            if(isset($_GET['page']) && $_GET['page']==$page){
                                                echo '<a href="vendors.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }elseif(!isset($_GET['page']) && $page==1){
                                                echo '<a href="vendors.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }else{
                                                echo '<a href="vendors.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
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
    function search(){
        document.getElementById("form").submit();
    }
</script>
