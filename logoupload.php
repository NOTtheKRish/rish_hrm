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
                    <?php
                        if(isset($_POST["submit"])){
                            $logo=$_POST['logo'];
                            $sql="UPDATE settings SET logo='".$logo."' WHERE entry_by='".$_SESSION['userRel']."'";
                            $result=mysqli_query($conn,$sql);
                            echo '<script type="text/javascript">
                                    setTimeout(function(){
                                        swal({
                                            icon:"success",
                                            title:"Success!",
                                            text:"Data Modified Successfully",
                                            button: "Close",
                                        });
                                    },500);
                                </script>';
                        }
                    ?>

                    <!-- All Contents of the page starts from here-->
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs nav-justified card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="settings.php"><strong>General</strong></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="logoupload.php"><strong>Manage Logo</strong></a>
                                </li>
                                <?php
                                    $sq="SELECT package FROM accounts WHERE id='".$_SESSION['userRel']."'";
                                    $res=mysqli_query($conn,$sq);
                                    while($row=mysqli_fetch_array($res)){
                                        $package=$row['package'];
                                    }
                                    if($package=="BASIC (MONTHLY)" || $package=="BASIC (YEARLY)"){
                                        echo'';
                                    }else{
                                        echo'<li class="nav-item">
                                            <a class="nav-link" href="users.php"><strong>Users</strong></a>
                                        </li>';
                                    }
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="payment-details.php"><strong>Payment Details</strong></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="settings-addcontents.php"><strong>Add Contents</strong></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <?php
                                if(isset($_POST['logo'])){
                                    //Modification of Uploaded File Name
                                    $file=$_FILES['logo'];
                                    $fileName=$_FILES['logo']['name'];
                                    $fileTmpName=$_FILES['logo']['tmp_name'];
                                    $fileError=$_FILES['logo']['error'];
                                    $fileType=$_FILES['logo']['type'];

                                    $fileExt=explode('.',$fileName);
                                    $fileActualExt=strtolower(end($fileExt));
                                    $allowed=array('jpg','jpeg','png');

                                    if(in_array($fileActualExt,$allowed)){
                                        if($fileError==0){
                                                $fileNameNew="logo-".$_SESSION['userRel'].".".$fileActualExt;
                                                $fileDestination='img/'.$fileNameNew;
                                                if(file_exists("img/$fileNameNew")){
                                                    //Deleting the existing file and then storing with same file name
                                                    unlink("img/$fileNameNew");
                                                    move_uploaded_file($fileTmpName,$fileDestination);
                                                }else{
                                                    move_uploaded_file($fileTmpName,$fileDestination);
                                                }
                                                $sql="UPDATE settings SET logo='".$fileNameNew."'WHERE entry_by='".$_SESSION['userRel']."'";
                                                $res=mysqli_query($conn,$sql);
                                                echo '<script type="text/javascript">
                                                        setTimeout(function(){
                                                            swal({
                                                                icon:"success",
                                                                title:"Success!",
                                                                text:"Company Logo Modified Successfully",
                                                                button: "Close",
                                                            });
                                                        },500);
                                                    </script>';
                                        }else{
                                            echo '<script type="text/javascript">
                                                    setTimeout(function(){
                                                        swal({
                                                            icon:"error",
                                                            title:"Oops!",
                                                            text:"There was an error uploading the File... Try Again!!",
                                                            button: "Close",
                                                        });
                                                    },500);
                                                </script>';
                                        }
                                    }else{
                                        echo '<script type="text/javascript">
                                                setTimeout(function(){
                                                    swal({
                                                        icon:"error",
                                                        title:"Unsupported File Format!",
                                                        text:"You cannot upload this file type...",
                                                        button: "Close",
                                                    });
                                                },500);
                                            </script>';
                                    }
                                }
                                if(isset($_POST['favicon'])){
                                    //Modification of Uploaded File Name
                                    $file=$_FILES['favicon'];
                                    $fileName=$_FILES['favicon']['name'];
                                    $fileTmpName=$_FILES['favicon']['tmp_name'];
                                    $fileError=$_FILES['favicon']['error'];
                                    $fileType=$_FILES['favicon']['type'];

                                    $fileExt=explode('.',$fileName);
                                    $fileActualExt=strtolower(end($fileExt));
                                    $allowed=array('jpg','jpeg','png');

                                    if(in_array($fileActualExt,$allowed)){
                                        if($fileError==0){
                                                $fileNameNew="favicon-".$_SESSION['userRel'].".".$fileActualExt;
                                                $fileDestination='img/'.$fileNameNew;
                                                if(file_exists("img/$fileNameNew")){
                                                    //Deleting the existing file and then storing with same file name
                                                    unlink("img/$fileNameNew");
                                                    move_uploaded_file($fileTmpName,$fileDestination);
                                                }else{
                                                    move_uploaded_file($fileTmpName,$fileDestination);
                                                }
                                                $sql="UPDATE settings SET favicon='".$fileNameNew."'WHERE entry_by='".$_SESSION['userRel']."'";
                                                $res=mysqli_query($conn,$sql);
                                                echo '<script type="text/javascript">
                                                    setTimeout(function(){
                                                        swal({
                                                            icon:"success",
                                                            title:"Success!",
                                                            text:"Logo Favicon Modified Successfully!",
                                                            button: "Close",
                                                        });
                                                    },500);
                                                </script>';
                                        }else{
                                            echo '<script type="text/javascript">
                                                    setTimeout(function(){
                                                        swal({
                                                            icon:"error",
                                                            title:"Oops!",
                                                            text:"There was an error uploading the file... Try Again!!",
                                                            button: "Close",
                                                        });
                                                    },500);
                                                </script>';
                                        }
                                    }else{
                                        echo '<script type="text/javascript">
                                                setTimeout(function(){
                                                    swal({
                                                        icon:"error",
                                                        title:"Unsupported File Format!",
                                                        text:"You cannot upload this file type...",
                                                        button: "Close",
                                                    });
                                                },500);
                                            </script>';
                                    }
                                }
                            ?>
                            <?php
                                    $sql="SELECT logo,favicon FROM settings WHERE entry_by='".$_SESSION['userRel']."'";
                                    $result=mysqli_query($conn,$sql);
                                    while($row=mysqli_fetch_array($result)){
                                ?>
                                <form action="logoupload.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <img class="img-fluid px-5 my-3" src="img/undraw_upload.svg" alt="settings">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                              <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="pills-logo-tab" data-toggle="pill" href="#pills-logo" role="tab" aria-controls="pills-logo" aria-selected="true">Company Logo</a>
                                              </li>
                                              <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Logo Favicon</a>
                                              </li>
                                            </ul>
                                            <div class="tab-content" id="pills-tabContent">
                                              <div class="tab-pane fade show active" id="pills-logo" role="tabpanel" aria-labelledby="pills-logo-tab">
                                                <label class="h4 text-dark" for="com_logo"><strong>Company Logo</strong></label>
                                                <div class="form-group mt-3 col-sm-8">
                                                    <?php
                                                        if($row['logo']==""){
                                                            echo'<span>Current Logo : N/A</span><br><br>';
                                                        }else{
                                                            echo'<span class="mb-2">Current Logo : <img style="width:50px;" src="img/'.$row['logo'].'" alt="logo"></span><br><br>';
                                                        }
                                                        echo'<input class="form-control-file" type="file" name="logo"><br>';
                                                    ?>
                                                    <label class="lead" for="logosize"><strong>Recommended Logo Size</strong> : 512px*512px</label><br>
                                                    <label class="lead" for="logo"><strong>Supported Formats</strong> : Images (.jpg&ensp;.jpeg&ensp;.png)</label>
                                                </div>
                                                <div class="form-group col-auto">
                                                    <button class="btn btn-primary" name="logo" type="submit"><i class="fas fa-save mr-2"></i>Save</button>
                                                </div>
                                            </div>
                                              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                  <label class="h4 text-dark" for="favicon"><strong>Logo Favicon</strong></label>
                                                <div class="form-group mt-3 col-sm-8">
                                                    <?php
                                                        if($row['logo']==""){
                                                            echo'<span>Current Favicon : N/A</span><br><br>';
                                                        }else{
                                                            echo'<span>Current Favicon : <img style="width:50px;" src="img/'.$row['favicon'].'" alt="logo"><br><br>';
                                                        }
                                                        echo'<input class="form-control-file" type="file" name="favicon"><br>';
                                                    ?>
                                                    <label class="lead" for="logosize"><strong>Recommended Logo Size</strong> : 48px*48px</label><br>
                                                    <label class="lead" for="favicon"><strong>Supported Formats</strong> : Images (.jpg&ensp;.jpeg&ensp;.png)</label>
                                                </div>
                                                <div class="form-group col-auto">
                                                    <button class="btn btn-primary" name="favicon" type="submit"><i class="fas fa-save mr-2"></i>Save</button>
                                                </div>
                                              </div>
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