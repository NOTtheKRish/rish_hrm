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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-2 text-gray-800">Profile</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->

                    <?php
                    //Edit Profile Zone Starts
                        if (isset($_POST['update'])){
                            $username = $_POST['username'];
                            $name = $_POST['name'];
                            $email = $_POST['email'];
                            $sql = "UPDATE accounts SET username='".$username."', name='".$name."', email='".$email."' 
                            WHERE id = '".$_POST['userid']."'";
                            $query = mysqli_query($conn,$sql);
                            echo '<script type="text/javascript">
                                        setTimeout(function(){
                                            swal({
                                                icon:"success",
                                                title:"Success!",
                                                text:"Profile Data Updated Successfully",
                                                button: "Close",
                                            });
                                        },500);
                                    </script>';
                        }
                        //Edit Profile Zone Ends
                    ?>
                        <?php
                        //Change Password Zone Starts
                            if(isset($_POST['edit_pass'])){
                                // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
                                if ($stmt = $conn->prepare('SELECT password FROM accounts WHERE id = ?')){
                                    // Bind parameters (s = string, i = int, b = blob, etc), in our case, the id is a integer so we use "i"
                                    $stmt->bind_param('i',$_POST['id']);
                                    $stmt->execute();
                                    //Storing the result so that we can check if the account exists in database
                                    $stmt->store_result();

                                    if ($stmt->num_rows > 0){
                                        $stmt->bind_result($password);
                                        $stmt->fetch();
                                        // Now, we verify the current password
                                        if (password_verify($_POST['password'], $password)){
                                            // If current password is correct
                                            $new_pass=password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                                            $sql="UPDATE accounts SET password='".$new_pass."' WHERE id='".$_POST['id']."'";
                                            $result=mysqli_query($conn,$sql);
                                            echo '<script type="text/javascript">
                                                        setTimeout(function(){
                                                            swal({
                                                                icon:"success",
                                                                title:"Success!",
                                                                text:"Password Updated Successfully",
                                                                button: "Close",
                                                            });
                                                        },500);
                                                    </script>';
                                        }else{
                                            // If current password is wrong
                                            echo '<script type="text/javascript">
                                                        setTimeout(function(){
                                                            swal({
                                                                icon:"error",
                                                                title:"Oops!",
                                                                text:"Your Current Password is Wrong... Try Again!",
                                                                button: "Close",
                                                            });
                                                        },500);
                                                    </script>';
                                        }
                                    }
                                }
                                
                            }
                            //Change Password Zone Ends
                        ?>

                    <div class="card mb-4">
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <span><strong>Current User</strong></span>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle btn btn-circle" href="#" role="button" id="dropdownProfileMenu"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog text-gray-900"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownProfileMenu">
                                    <a class="dropdown-item" href="profile-edit.php"><i class="fas fa-user-edit mr-2"></i>Edit Profile</a>
                                    <a class="dropdown-item" href="edit-password.php"><i class="fas fa-lock mr-2"></i>Change Password</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                                $sql="SELECT name,username,email,created_at FROM accounts WHERE id='".$_SESSION['userId']."'";
                                $request=mysqli_query($conn,$sql);
                                while($row=mysqli_fetch_array($request)){
                                    // Changing Date Format to display as 19 Dec 2003 04:00 PM
                                    $created=date_create($row['created_at']);
                                    $created_at=date_format($created,"d M, Y h:i A");
                            ?>
                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <div class="col-md-5 mx-auto my-auto">
                                        <img class="img-fluid mb-2" src="img/undraw_profile.svg" alt="User">
                                    </div>
                                    <div class="col-md-5 text-center mx-auto my-auto">
                                        <h2><strong><?php echo $row['username']; ?></strong></h2>
                                    </div>
                                </div>
                                <div class="form-group col-md-5 mt-5">
                                    <div class="form-group mx-auto my-auto col-md-12">
                                        <div class="col-md-10 my-2">
                                            <span><strong>Name:</strong> <?php echo $row['name']; ?></span>
                                        </div>
                                        <div class="col-md-10 my-2">
                                            <span><strong>Username:</strong> <?php echo $row['username'];?></span>
                                        </div>
                                        <div class="col-md-10 my-2">
                                            <span><strong>E-Mail ID:</strong> <?php echo $row['email']; ?></span>
                                        </div>
                                        <div class="col-md-10 my-2">
                                            <span><strong>Created At:</strong> <?php echo $created_at ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
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