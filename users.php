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
                    <div class="d-sm-flex align-items-center mb-4">
                        <h1 class="h3 mb-2 text-gray-800">Settings</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs nav-justified card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="settings.php"><strong>General</strong></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logoupload.php"><strong>Manage Logo</strong></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="manage-users.php"><strong>Users</strong></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <!-- Create User Details Zone Starts -->
                            <?php
                                if (isset($_POST['create'])){
                                    $role=$_POST['role'];
                                    $username=$_POST['username'];
                                    $name=$_POST['name'];
                                    $email=$_POST['email'];
                                    $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
                                    $sql="INSERT INTO accounts (role,username,name,email,password,userRelation)
                                    VALUES ('".$role."','".$username."','".$name."','".$email."','".$password."','".$_SESSION['userRel']."')";
                                    $query=mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"User Data Created Successfully",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                                }
                            ?>
                            <!-- Create User Details Zone Ends -->
                            <!-- Update User Details Zone Starts -->
                            <?php
                                if (isset($_POST['update'])){
                                    $username=$_POST['username'];
                                    $name=$_POST['name'];
                                    $email=$_POST['email'];
                                    $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
                                    $sql="UPDATE accounts SET username='".$username."', name='".$name."', email='".$email."', password='".$password."' 
                                    WHERE id='".$_POST['userid']."'";
                                    $query=mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"User Data Updated Successfully",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                                }
                            ?>
                            <!-- Update User Details Zone Ends -->
                            <!-- Delete User Zone Starts -->
                            <?php
                                if (isset($_POST["delete"])){
                                    $delete_id=$_POST['user_id'];
                                    $sql="DELETE FROM accounts WHERE id='".$delete_id."'";
                                    $result=mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"User Deleted Successfully",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                                }
                            ?>
                        <!-- Delete User Zone Ends -->
                                <div class="dataTable-filter">
                                        <div class="d-flex justify-content-end p-2 mt-1">
                                            <a href="users-create.php" class="btn btn-primary ml-2"><i class="fas fa-plus mr-2"></i>Add User</a>
                                        </div>
                                </div>
                                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>Username</th>
                                                <th>Name</th>
                                                <th>Role</th>
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
                                                $sql = "SELECT * FROM accounts WHERE userRelation='".$userRel."'";
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
                                            //Searching with User ID
                                                if(!isset($_GET['user'])){
                                                    $sql= 'SELECT * FROM accounts WHERE userRelation="'.$userRel.'" AND id !="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                                }else{
                                                    $userid=$_GET['user'];
                                                    $sql= "SELECT * FROM accounts WHERE userRelation='".$userRel."' AND id =".$userid."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                                }
                                                //$sql= 'SELECT * FROM accounts ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
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
                                                <td><?php echo $row['id'];?></td>
                                                <td><?php echo $row['username'];?></td>
                                                <td><?php echo $row['name'];?></td>
                                                <td><?php
                                                        if($row['role']==1){
                                                            echo "ADMIN";
                                                        }elseif($row['role']==2){
                                                            echo "STAFF";
                                                        }elseif($row['role']==3){
                                                            echo "FREELANCER";
                                                        }else{
                                                            echo "USER";
                                                        }
                                                    ?>
                                                </td>
                                                <td style="text-align:center;"><?php echo'<a class="btn btn-circle btn-primary" href="users-view.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-eye"></i></a>
                                                <a class="btn btn-circle btn-primary" href="users-edit.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-pen"></i></a>
                                                <a class="btn btn-circle btn-danger" href="users-delete.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-trash"></i></a>';?></td>
                                            </tr>
                                        </tbody>
                                            <?php
                                            }
                                        }else{
                                            echo '<td colspan="5" style="text-align:center;">Oops!! 0 results</td>';
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                            <div style="margin-left:18px;">
                                <?php
                                    if($result_num==0){
                                        echo'Showing 0 results per page among '.$result_num.' total results.';
                                    }else{
                                        echo'Showing '.$pagereslimit.' results per page among '.$result_num.' total results.';
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
                                    <?php echo '<a href="users.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';?></li><?php }?>
                            <!-- <li class="nav-item" id="next"><a href="#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 10px;margin-bottom: 10px">></a></li> -->
                            </ul>
                            </div>
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