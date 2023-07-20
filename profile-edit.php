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

                    <div class="card mb-3">
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <span><strong>Edit Profile</strong></span>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle btn btn-circle" href="#" role="button" id="dropdownProfileMenu"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog text-gray-900"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownProfileMenu">
                                    <a class="dropdown-item" href="profile.php"><i class="fas fa-user-circle mr-2"></i>Profile</a>
                                    <a class="dropdown-item" href="edit-password.php"><i class="fas fa-lock mr-2"></i>Change Password</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                                $sql="SELECT id,name,username,email FROM accounts WHERE id='".$_SESSION['userRel']."'";
                                $request=mysqli_query($conn,$sql);
                                while($row=mysqli_fetch_array($request)){
                            ?>
                            <form action="profile.php" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <img class="img-fluid px-5 mt-2 my-3" src="img/undraw_profile_details.svg" alt="profile_details">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group col-md-8">
                                            <label for="name"><strong>Name</strong></label>
                                            <?php echo'<input class="form-control" type="text" name="name" value="'.$row['name'].'" required>'?>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="username"><strong>Username</strong></label>
                                            <?php echo'<input class="form-control" type="text" name="username" value="'.$row['username'].'" required autocomplete="off">'?>
                                            <?php echo'<input class="form-control" type="text" name="userid" hidden value="'.$row['id'].'">'?>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="email"><strong>E-Mail Address</strong></label>
                                            <?php echo'<input class="form-control" type="text" name="email" value="'.$row['email'].'" required>'?>
                                        </div>
                                        <div class="form-group col-auto">
                                            <button class="btn btn-primary" name="update" type="submit"><i class="fas fa-save mr-2"></i>Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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