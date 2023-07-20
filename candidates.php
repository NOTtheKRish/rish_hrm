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
                        <h1 class="h3 mb-2 text-gray-800">Candidates</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
                            <?php
                                if(isset($_GET['search'])||isset($_GET['jobrole'])||isset($_GET['experience'])||isset($_GET['entry_by'])){
                                    echo'<a class="d-none d-sm-inline-block btn btn-danger shadow-sm" href="candidates.php">
                                        <i class="fas fa-plus-circle text-white-50"></i>
                                        Show All
                                    </a>';
                                }else{
                                    echo'';
                                }
                            ?>
                            <a href="candidates-create.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-plus mr-2 fa-sm"></i>Add New Candidate</a>
                        </div>

                        <div class="card-body">
                            <!-- Create New Candidates Starts -->
                            <?php
                                if (isset($_POST["create"])){
                                    $previous=$_POST['previous'];

                                    $co="SELECT can FROM accounts WHERE id='".$_SESSION['userRel']."'";
                                    $cou=mysqli_query($conn,$co);
                                    while($coun=mysqli_fetch_array($cou)){
                                        $count=($coun['can'])+1;
                                    }
                                    // Data being Inserted into the Database
                                    $entry_by=$_SESSION['userRel'];
                                    $userId=$_SESSION['userId'];
                                    $sql="INSERT INTO candidates (can_id,name,number,wp_number,email,qualification,experience,jobrole,expected_job,address,location_interest,salary_current,salary_expect,gender,entry_by,user_id)
                                    VALUES ('".$count."','".$_POST['name']."','".$_POST['number']."','".$_POST['wp_number']."','".$_POST['email']."','".$_POST['qualification']."','".$_POST['experience']."','".$_POST['jobrole']."','".$_POST['expected_job']."','".$_POST['address']."','".$_POST['location_interest']."','".$_POST['salary_current']."','".$_POST['salary_expect']."','".$_POST['gender']."','".$entry_by."','".$userId."')";
                                    $result=mysqli_query($conn,$sql);

                                    //updating can count in accounts table
                                    $sql="UPDATE accounts SET can='".$count."' WHERE id='".$_SESSION['userRel']."'";
                                    $res=mysqli_query($conn,$sql);
                                    echo'<script type="text/javascript">
                                                setTimeout(function(){
                                                    swal({
                                                        icon:"success",
                                                        title:"Success!",
                                                        text:"New Candidate Created Successfully",
                                                        button: "Close",
                                                    }).then(function(){
                                                         window.location.href="'.$previous.'"
                                                     });
                                                },500);
                                            </script>';
                                }
                            ?>
                            <!-- Create Candidates Zone Ends -->

                            <!-- Edit Candidates Zone Starts -->
                            <?php
                                if (isset($_POST["update"])){
                                    $previous=$_POST['previous'];
                                    $can_id=$_POST['can_id'];
                                    $can_name=$_POST['can_name'];
                                    $can_number=$_POST['can_number'];
                                    $wp_number=$_POST['wp_number'];
                                    $email=$_POST['email'];
                                    $qualification=$_POST['qualification'];
                                    $experience=$_POST['experience'];
                                    $jobrole=$_POST['jobrole'];
                                    $expected_job=$_POST['expected_job'];
                                    $address=$_POST['address'];
                                    $location_interest=$_POST['location_interest'];
                                    $salary_current=$_POST['salary_current'];
                                    $salary_expect=$_POST['salary_expect'];
                                    $gender=$_POST['gender'];
                                    $sql="UPDATE candidates
                                    SET name='".$can_name."', number='".$can_number."', wp_number='".$wp_number."', email='".$email."', qualification='".$qualification."',experience='".$experience."',jobrole='".$jobrole."',expected_job='".$expected_job."',address='".$address."',location_interest='".$location_interest."',salary_current='".$salary_current."',salary_expect='".$salary_expect."',gender='".$gender."'
                                    WHERE id='".$can_id."'";
                                    $query=mysqli_query($conn,$sql);

                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"Candidate Data Edited Successfully",
                                                    button: "Close",
                                                }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                            },500);
                                        </script>';
                                }
                            ?>
                            <!-- Edit Candidates Zone Ends -->
                            <!-- Edit Candidate Resume Zone Starts -->
                            <?php
                                if(isset($_POST['resume'])){
                                    $previous=$_POST['previous'];
                                    $can_id=$_POST['can_id'];
                                    $can_name=$_POST['can_name'];
                                    $can_jobrole=$_POST['jobrole'];
                                    //Modification of Resume File Name
                                    $file=$_FILES['resume'];
                                    $fileName=$_FILES['resume']['name'];
                                    $fileTmpName=$_FILES['resume']['tmp_name'];
                                    $fileError=$_FILES['resume']['error'];
                                    $fileType=$_FILES['resume']['type'];

                                    $fileExt=explode('.',$fileName);
                                    $fileActualExt=strtolower(end($fileExt));
                                    $allowed=array('jpg','jpeg','png','pdf');

                                    if(in_array($fileActualExt,$allowed)){
                                        if($fileError==0){
                                                $fileNameNew=$can_name."-".$can_jobrole.".".$fileActualExt;
                                                $fileDestination='uploads/'.$fileNameNew;
                                                if(file_exists("uploads/$fileNameNew")){
                                                    //Deleting the existing file and then storing with same file name
                                                    unlink("uploads/$fileNameNew");
                                                    move_uploaded_file($fileTmpName,$fileDestination);
                                                }else{
                                                    move_uploaded_file($fileTmpName,$fileDestination);
                                                }
                                        }else{
                                            echo "There was an error uploading the file... Try Again!";
                                        }
                                    }else{
                                        echo "You cannot upload this file type...";
                                    }
                                    $sql="UPDATE candidates SET resume='".$fileNameNew."'WHERE id='".$can_id."'";
                                    $query=mysqli_query($conn,$sql);

                                        echo '<script type="text/javascript">
                                                setTimeout(function(){
                                                    swal({
                                                        icon:"success",
                                                        title:"Success!",
                                                        text:"Candidate Resume Modified Successfully",
                                                        button: "Close",
                                                    }).then(function(){
                                                         window.location.href="'.$previous.'"
                                                     });
                                                },500);
                                            </script>';
                                }
                            ?>
                            <!-- Edit Candidate Resume Zone Ends -->


                            <!-- Delete Candidate Zone Starts -->
                            <?php
                                if (isset($_POST["delete"])){
                                    $delete_id=$_POST['can_id'];
                                    $previous=$_POST['previous'];
                                    $sql="DELETE FROM candidates WHERE id='".$delete_id."'";
                                    $result=mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"error",
                                                    title:"Success!",
                                                    text:"Candidate Data Deleted Successfully",
                                                    button: "Close",
                                                }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                            },500);
                                        </script>';
                                }
                            ?>
                        <!-- Delete Candidate Zone Ends -->

                            <div class="table-responsive">
                            <div class="dataTable-filter">
                                <div class="row mt-1">
                                    <form action="candidates.php" method="GET">
                                        <div class="col-md-12 d-flex">
                                            <div class="col-md-3 d-flex">
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" placeholder="Search" name="search">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <button class="btn btn-primary"><i class="fas fa-search" onclick="this.form.submit();"></i></button>
                                                        </div>
                                                    </form>
                                            </div>
                                            <div class="col-md-3 d-flex">
                                                <div class="col-md-12">
                                                <form action="candidates.php" method="GET">
                                                    <label for="jobrole">Job Role</label>
                                                    <select class="form-control" name="jobrole" style="border: 2px solid #0070ff; border-radius: 3px;">
                                                        <option value="">Select JOB Role</option>
                                                        <?php
                                                            $sql="SELECT * FROM can_jobrole";
                                                            $result=mysqli_query($conn,$sql);
                                                            if(mysqli_num_rows($result)>0){
                                                            while($row=mysqli_fetch_array($result)){
                                                        ?>
                                                        <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                                        <?php }}?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-flex col-md-3">
                                                <div class="col-md-9">
                                                    <label for="experience">Experience</label>
                                                    <select class="form-control" name="experience" style="border:2px solid #0070ff;border-radius:3px;margin-right:3px;">
                                                        <option value="">Select Experience</option>
                                                        <?php
                                                            $sql="SELECT * FROM can_exp";
                                                            $result=mysqli_query($conn,$sql);
                                                            if(mysqli_num_rows($result)>0){
                                                                while($row=mysqli_fetch_array($result)){
                                                        ?>
                                                        <?php echo'<option value="'.$row['value'].'">'.$row['value'].'</option>';?>
                                                        <?php }}?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 mt-4 p-2">
                                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <?php
                                        if($_SESSION['id']!=2){
                                            echo'<div class="col-md-3">
                                            <form action="candidates.php" id="entry" method="GET">
                                            <div class="d-flex mt-1">
                                            <div class="col-md-12">
                                            <label for="entry_by">Entry By</label>
                                            <select class="form-control" name="entry_by" oninput="search()" style="border: 2px solid #0070ff; border-radius: 3px;">
                                            <option value="">Select User</option>';
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
                                            <th>Candidate ID</th>
                                            <th>Name</th>
                                            <th>Qualification</th>
                                            <th>Job Role</th>
                                            <th>Resume</th>
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
                                            $sql = "SELECT * FROM candidates WHERE entry_by='".$userRel."'";
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
                                        //Filtering with JOB Role and Experience
                                        if($userRel==$userId){
                                            if(isset($_GET['search'])){
                                                $search=$_GET['search'];
                                                $sql= "SELECT * FROM candidates WHERE number='".$search."' OR name LIKE '%".$search."%' AND entry_by='".$userRel."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM candidates WHERE number='".$search."' OR name LIKE '%".$search."%' AND entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }elseif(isset($_GET['jobrole']) && isset($_GET['experience']) && $_GET['jobrole']!="" && $_GET['experience']!=""){
                                                $job_role=$_GET['jobrole'];
                                                $exp=$_GET['experience'];
                                                //paginating
                                                $sql= "SELECT * FROM candidates WHERE jobrole='".$job_role."' AND experience='".$exp."' AND entry_by='".$userRel."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                    //display
                                                    $sql= "SELECT * FROM candidates WHERE jobrole='".$job_role."' AND experience='".$exp."' AND entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }elseif(isset($_GET['jobrole']) && isset($_GET['experience']) && $_GET['jobrole']!="" && $_GET['experience']==""){
                                                $job_role=$_GET['jobrole'];
                                                $exp="";
                                                //paginating
                                                $sql= "SELECT * FROM candidates WHERE jobrole='".$job_role."' AND entry_by='".$userRel."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                //display
                                                $sql= "SELECT * FROM candidates WHERE jobrole='".$job_role."' AND entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }elseif(isset($_GET['jobrole']) && isset($_GET['experience']) && $_GET['jobrole']=="" && $_GET['experience']!=""){
                                                $exp=$_GET['experience'];
                                                $job_role="";
                                                //paginating
                                                $sql= "SELECT * FROM candidates WHERE experience='".$exp."' AND entry_by='".$userRel."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                //display
                                                $sql= "SELECT * FROM candidates WHERE experience='".$exp."' AND entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }else{ // no filters applied
                                                $sql= 'SELECT * FROM candidates WHERE entry_by="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                            }
                                        // Searching for Entry By
                                            if(isset($_GET['entry_by'])){
                                                $entry_by=$_GET['entry_by'];
                                                $sql= "SELECT * FROM candidates WHERE entry_by='".$userRel."' AND user_id='".$entry_by."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                //display
                                                $sql= "SELECT * FROM candidates WHERE entry_by='".$userRel."' AND user_id='".$entry_by."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }
                                        }else{
                                            if(isset($_GET['search'])){
                                                $search=$_GET['search'];
                                                $sql= "SELECT * FROM candidates WHERE number='".$search."' OR name LIKE '%".$search."%' AND entry_by='".$userRel."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM candidates WHERE number='".$search."' OR name LIKE '%".$search."%' AND entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }elseif(isset($_GET['jobrole']) && isset($_GET['experience']) && $_GET['jobrole']!="" && $_GET['experience']!=""){
                                                $job_role=$_GET['jobrole'];
                                                $exp=$_GET['experience'];
                                                //paginating
                                                $sql= "SELECT * FROM candidates WHERE jobrole='".$job_role."' AND experience='".$exp."' AND entry_by='".$userRel."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                    //display
                                                    $sql= "SELECT * FROM candidates WHERE jobrole='".$job_role."' AND experience='".$exp."' AND entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }elseif(isset($_GET['jobrole']) && isset($_GET['experience']) && $_GET['jobrole']!="" && $_GET['experience']==""){
                                                $job_role=$_GET['jobrole'];
                                                $exp="";
                                                //paginating
                                                $sql= "SELECT * FROM candidates WHERE jobrole='".$job_role."' AND entry_by='".$userRel."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                //display
                                                $sql= "SELECT * FROM candidates WHERE jobrole='".$job_role."' AND entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }elseif(isset($_GET['jobrole']) && isset($_GET['experience']) && $_GET['jobrole']=="" && $_GET['experience']!=""){
                                                $exp=$_GET['experience'];
                                                $job_role="";
                                                //paginating
                                                $sql= "SELECT * FROM candidates WHERE experience='".$exp."' AND entry_by='".$userRel."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                //display
                                                $sql= "SELECT * FROM candidates WHERE experience='".$exp."' AND entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }else{ // no filters applied
                                                $sql= 'SELECT * FROM candidates WHERE entry_by="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                            }
                                        // Searching for Entry By
                                            if(isset($_GET['entry_by'])){
                                                $entry_by=$_GET['entry_by'];
                                                $sql= "SELECT * FROM candidates WHERE entry_by='".$userRel."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                //display
                                                $sql= "SELECT * FROM candidates WHERE entry_by='".$userRel."' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit;
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
                                            <td><?php echo 'C-'.$row['can_id'];?></td>
                                            <td><?php echo $row['name'];?></td>
                                            <td><?php echo $row['qualification'];?></td>
                                            <td><?php echo $row['jobrole'];?></td>
                                            <td style="text-align: center;"><?php
                                                if($row['resume']==""){
                                                    echo'<a class="btn btn-circle btn-primary" href="candidates-resume.php?can_id='.$row['id'].'"><i class="fas fa-file"></i></a></td>';
                                                }else{
                                                    echo'<a class="btn btn-circle btn-primary" href="resume-view.php?resume='.$row['resume'].'"><i class="fas fa-eye"></i></a>
                                                    <a class="btn btn-circle btn-primary" href="candidates-resume.php?can_id='.$row['id'].'"><i class="fas fa-file"></i></a></td>';
                                                }
                                            echo'<td style="text-align:center;"><a class="btn btn-circle btn-primary mr-1" href="candidates-view.php?id='.$row['id'].'" style="font-size:1rem;"><i class="far fa-eye"></i></a>';
                                            echo'<a class="btn btn-circle btn-primary mr-1" href="candidates-edit.php?id='.$row['id'].'" style="font-size:1rem;"><i class="far fa-edit"></i></a>';
                                            echo'<a class="btn btn-circle btn-success mr-1" target="_blank" href="https://wa.me/91'.$row['wp_number'].'"><i class="fab fa-lg fa-whatsapp"></i></a>';
                                            echo'<a class="btn btn-circle btn-primary mr-1" target="_blank" href="mailer.php?email='.$row['email'].'"><i class="fas fa-lg fa-envelope"></i></a>';
                                            if($_SESSION['id']==2){
                                                echo '</td>';
                                            }elseif ($_SESSION['id']!=2){
                                            echo'<a class="btn btn-circle btn-danger" href="candidates-delete.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-trash"></i></a></td>';
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
                        <ul class="nav tm-paging-links" style="overflow-x: scroll;flex-wrap:nowrap;">
                        <!-- <li class="nav-item" id="prev"><a href="#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 10px;margin-bottom: 10px"><</a></li> -->
                            <?php
                                for($page=1;$page<=$pagenumbers;$page++){?>
                                    <li class="nav-item">
                                        <?php
                                            if(isset($_GET['jobrole']) && isset($_GET['experience']) && $_GET['jobrole']!="" && $_GET['experience']!=""){
                                                // echo '<a href="candidates.php?jobrole='.$job_role.'&experience='.$exp.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="candidates.php?jobrole='.$job_role.'&experience='.$exp.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="candidates.php?jobrole='.$job_role.'&experience='.$exp.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="candidates.php?jobrole='.$job_role.'&experience='.$exp.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }
                                            }elseif(isset($_GET['jobrole']) && isset($_GET['experience']) && $_GET['jobrole']!="" && $_GET['experience']==""){
                                                // echo '<a href="candidates.php?jobrole='.$job_role.'&experience='.$exp.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="candidates.php?jobrole='.$job_role.'&experience='.$exp.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="candidates.php?jobrole='.$job_role.'&experience='.$exp.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="candidates.php?jobrole='.$job_role.'&experience='.$exp.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }
                                            }elseif(isset($_GET['jobrole']) && isset($_GET['experience']) && $_GET['jobrole']=="" && $_GET['experience']!=""){
                                                // echo '<a href="candidates.php?jobrole='.$job_role.'&experience='.$exp.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="candidates.php?jobrole='.$job_role.'&experience='.$exp.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="candidates.php?jobrole='.$job_role.'&experience='.$exp.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="candidates.php?jobrole='.$job_role.'&experience='.$exp.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }
                                            }elseif(isset($_GET['entry_by'])){
                                                // echo '<a href="candidates.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="candidates.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="candidates.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="candidates.php?entry_by='.$entry_by.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }
                                            }else{ // no filters applied
                                                // echo '<a href="candidates.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                if(isset($_GET['page']) && $_GET['page']==$page){
                                                    echo '<a href="candidates.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }elseif(!isset($_GET['page']) && $page==1){
                                                    echo '<a href="candidates.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                }else{
                                                    echo '<a href="candidates.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
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
        document.getElementById("entry").submit();
    }
</script>
