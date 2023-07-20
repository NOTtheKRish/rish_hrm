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
                            $bank_name=$_POST['bank_name'];
                            $account_no=$_POST['account_no'];
                            $ifsc_code=$_POST['ifsc_code'];
                            $branch_name=$_POST['branch_name'];
                            $upi_id=$_POST['upi_id'];
                            $inv_desc=$_POST['inv_desc'];
                            $sql="UPDATE settings SET bank_name='".$bank_name."', account_no='".$account_no."', ifsc_code='".$ifsc_code."',branch_name='".$branch_name."',upi_id='".$upi_id."',inv_desc='".$inv_desc."' WHERE entry_by='".$_SESSION['userRel']."'";
                            $result=mysqli_query($conn,$sql);
                            echo '<script type="text/javascript">
                                    setTimeout(function(){
                                        swal({
                                            icon:"success",
                                            title:"Success!",
                                            text:"Payment Details Modified Successfully!",
                                            button: "Close",
                                        });
                                    },500);
                                </script>';
                        }

                        if(isset($_POST['upload'])){
                            $file=$_FILES['inv_sign'];
                            $fileName=$_FILES['inv_sign']['name'];
                            $fileTmpName=$_FILES['inv_sign']['tmp_name'];
                            $fileError=$_FILES['inv_sign']['error'];
                            $fileType=$_FILES['inv_sign']['type'];

                            $fileExt=explode('.',$fileName);
                            $fileActualExt=strtolower(end($fileExt));
                            $allowed=array('jpg','jpeg','png');

                            if(in_array($fileActualExt,$allowed)){
                                if($fileError==0){
                                        $fileNameNew="sign-".$_SESSION['userRel'].".".$fileActualExt;
                                        $fileDestination='img/'.$fileNameNew;
                                        if(file_exists("img/$fileNameNew")){
                                            //Deleting the existing file and then storing with same file name
                                            unlink("img/$fileNameNew");
                                            move_uploaded_file($fileTmpName,$fileDestination);
                                        }else{
                                            move_uploaded_file($fileTmpName,$fileDestination);
                                        }
                                        $sql="UPDATE settings SET inv_sign='".$fileNameNew."'WHERE entry_by='".$_SESSION['userRel']."'";
                                        $res=mysqli_query($conn,$sql);
                                        echo '<script type="text/javascript">
                                                    setTimeout(function(){
                                                        swal({
                                                            icon:"success",
                                                            title:"Success!",
                                                            text:"Signature Modified Successfully!",
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

                    ?>

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
                                    <a class="nav-link active" href="payment-details.php"><strong>Payment Details</strong></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="settings-addcontents.php"><strong>Add Contents</strong></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <!-- Page Under Construction Content -->
                            <div class="text-center">
                                <?php
                                        $sql="SELECT * FROM settings WHERE entry_by='".$_SESSION['userRel']."'";
                                        $result=mysqli_query($conn,$sql);
                                        while($row=mysqli_fetch_array($result)){
                                    ?>
                                    <form action="payment-details.php" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <img class="img-fluid px-5 my-3" src="img/undraw_wallet.svg" alt="payment_details">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="com_name"><strong>Bank Name</strong></label>
                                                <div class="form-group col-sm-12">
                                                        <?php echo'<input class="form-control" type="text" name="bank_name" value="'.$row['bank_name'].'">';?>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="displayLimit"><strong>Bank Account Number</strong></label>
                                                        <?php echo'<input class="form-control" type="text" name="account_no" value="'.$row['account_no'].'">';?>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="displayLimit"><strong>IFSC Code</strong></label>
                                                        <?php echo'<input class="form-control" type="text" name="ifsc_code" value="'.$row['ifsc_code'].'">';?>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="displayLimit"><strong>Branch Name</strong></label>
                                                        <?php echo'<input class="form-control" type="text" name="branch_name" value="'.$row['branch_name'].'">';?>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="displayLimit"><strong>UPI ID</strong></label>
                                                        <?php echo'<input class="form-control" type="text" name="upi_id" value="'.$row['upi_id'].'">';?>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="inv_desc"><strong>Invoice Description</strong>
                                                        <a data-toggle="popover" data-placement="bottom" data-content="Found at the bottom of the Invoice" href="javascript:void(0)">
                                                            <i class="fas fa-lg fa-info-circle" style="margin-top:10px;padding:10px;"></i>
                                                        </a>
                                                    </label>
                                                    <textarea class="form-control" name="inv_desc" cols="30" rows="5"><?php echo $row['inv_desc'];?></textarea>
                                                </div>
                                                <div class="form-group col-auto">
                                                    <button class="btn btn-primary" name="submit" type="submit"><i class="fas fa-save mr-2"></i>Save</button>
                                                </div>
                                                </form>
                                                <hr>
                                                <form action="payment-details.php" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group col-sm-12 text-center">
                                                        <label for="inv_sign"><strong>Invoice Signature</strong></label>
                                                        <div class="col-sm-12 my-2">
                                                            <img style="max-width:300px;" src="img/<?php echo $row['inv_sign']; ?>" alt="Invoice Signature">
                                                        </div>
                                                        <label for="inv_sign" class="mb-3">(Supported Formats : .jpg | .jpeg | .png)</label>
                                                        <input type="file" name="inv_sign" id="inv_sign">
                                                        <button class="btn btn-primary" type="submit" name="upload">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                <?php } ?>
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