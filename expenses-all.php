<?php
include('session.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/packageCheck.php');
include_once('includes/dbconfig.php');
?>
<style type="text/css">
    .rish_btn{
        color: #000;
    }
    .rish_btn:hover{
        color: #fff;
    }
</style>

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
                    <div class="d-sm-flex justify-content-center mb-4">
                        <h3 class="text-primary"><i class="fas fa-wallet mr-3"></i></h3>
                        <h1 class="h3 mb-2 text-gray-800">Expenses</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">View All</h6>
                            <?php
                                if(isset($_GET['from'])||isset($_GET['to'])||isset($_GET['spendfor'])||isset($_GET['show'])){
                                    echo'<a class="d-none d-sm-inline-block btn btn-danger shadow-sm" href="expenses-all.php">
                                        <i class="fas fa-minus-circle text-white-50"></i>
                                        Remove Filters
                                    </a>';
                                }else{
                                    echo'';
                                }
                            ?>
                            <div class="justify-content-end">
                                <a href="expenses.php" class="rish_btn d-none d-sm-inline-block btn btn-success shadow-sm"><i class="fas fa-home mr-2"></i><strong>Home</strong></a>
                                <a href="expenses-create.php" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-plus mr-2"></i><strong>Add New Expense</strong></a>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Create New Expense Zone Starts -->
                            <?php
                                if (isset($_POST["create"])){
                                    // Data being Inserted into the Database
                                    $previous=$_POST['previous'];
                                    date_default_timezone_set('Asia/Kolkata');
                                    $dates=date_create($_POST['date']);
                                    $date=date_format($dates,'Y-m-d');
                                    $entry_by=$_SESSION['userRel'];
                                    $userRel=$_SESSION['userId'];
                                    $name=$_POST['name'];

                                    $file=$_FILES['image'];
                                    $fileName=$_FILES['image']['name'];
                                    $fileTmpName=$_FILES['image']['tmp_name'];
                                    $fileError=$_FILES['image']['error'];
                                    $fileType=$_FILES['image']['type'];

                                    $fileExt=explode('.',$fileName);
                                    $fileActualExt=strtolower(end($fileExt));
                                    $allowed=array('jpg','jpeg','png','pdf');

                                    if(in_array($fileActualExt,$allowed)){
                                        if($fileError==0){
                                                $fileNameNew=$userRel."-".$name."-".$date.".".$fileActualExt;
                                                $fileDestination='uploads/expenses/'.$fileNameNew;
                                                // if(file_exists("uploads/expenses/$fileNameNew")) unlink("uploads/expenses/$fileNameNew");
                                                move_uploaded_file($fileTmpName,$fileDestination);

                                                $sql="INSERT INTO expenses (date,spend_for,image,name,description,gst_no,taxable_amt,cgst,sgst,total_paid,entry_by,user_id)
                                                VALUES ('".$date."','".$_POST['spend_for']."','".$fileNameNew."','".$_POST['name']."','".$_POST['description']."','".$_POST['gst_no']."','".$_POST['taxable_amt']."','".$_POST['cgst']."','".$_POST['sgst']."','".$_POST['total_paid']."','".$entry_by."','".$userRel."')";
                                                $result=mysqli_query($conn,$sql);

                                                echo '<script type="text/javascript">
                                                setTimeout(function(){
                                                    swal({
                                                        icon:"success",
                                                        title:"Success!",
                                                        text:"New Expense Created Successfully!",
                                                        button: "Close",
                                                    }).then(function(){
                                                         window.location.href="'.$previous.'"
                                                     });
                                                },500);
                                            </script>';
                                        }else{
                                            $sql="INSERT INTO expenses (date,spend_for,name,description,gst_no,taxable_amt,cgst,sgst,total_paid,entry_by,user_id)
                                            VALUES ('".$date."','".$_POST['spend_for']."','".$_POST['name']."','".$_POST['description']."','".$_POST['gst_no']."','".$_POST['taxable_amt']."','".$_POST['cgst']."','".$_POST['sgst']."','".$_POST['total_paid']."','".$entry_by."','".$userRel."')";
                                            $result=mysqli_query($conn,$sql);

                                            echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"danger",
                                                    title:"Oops!",
                                                    text:"There was an error uploading the file... Try Again!",
                                                    button: "Close",
                                                }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                            },500);
                                        </script>';
                                        }
                                    }else{
                                        $sql="INSERT INTO expenses (date,spend_for,name,description,gst_no,taxable_amt,cgst,sgst,total_paid,entry_by,user_id)
                                        VALUES ('".$date."','".$_POST['spend_for']."','".$_POST['name']."','".$_POST['description']."','".$_POST['gst_no']."','".$_POST['taxable_amt']."','".$_POST['cgst']."','".$_POST['sgst']."','".$_POST['total_paid']."','".$entry_by."','".$userRel."')";
                                        $result=mysqli_query($conn,$sql);
                                            echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"danger",
                                                    title:"Oops!",
                                                    text:"You cannot upload this file type...",
                                                    button: "Close",
                                                }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                            },500);
                                        </script>';
                                    }
                                }
                            ?>
                            <!-- Create New Expense Zone Ends -->

                            <!-- Edit Expense Zone Starts -->
                            <?php
                                if (isset($_POST["update"])){
                                    $previous=$_POST['previous'];
                                    date_default_timezone_set('Asia/Kolkata');
                                    $dates=date_create($_POST['date']);
                                    $date=date_format($dates,'Y-m-d');
                                    $expense_id=$_POST['expense_id'];
                                    $spend_for=$_POST['spend_for'];
                                    $name=$_POST['name'];
                                    $description=$_POST['description'];
                                    $gst_no=$_POST['gst_no'];
                                    $taxable_amt=$_POST['taxable_amt'];
                                    $cgst=$_POST['cgst'];
                                    $sgst=$_POST['sgst'];
                                    $total_paid=$_POST['total_paid'];

                                    $userRel=$_SESSION['userRel'];

                                    // manipulating uploaded task image
                                    $file=$_FILES['image'];
                                    $fileName=$_FILES['image']['name'];
                                    $fileTmpName=$_FILES['image']['tmp_name'];
                                    $fileError=$_FILES['image']['error'];
                                    $fileType=$_FILES['image']['type'];

                                    $fileExt=explode('.',$fileName);
                                    $fileActualExt=strtolower(end($fileExt));
                                    $allowed=array('jpg','jpeg','png','pdf');

                                    if(in_array($fileActualExt,$allowed)){
                                        if($fileError==0){
                                                $fileNameNew=$userRel."-".$name."-".$date.".".$fileActualExt;
                                                $fileDestination='uploads/expenses/'.$fileNameNew;
                                                if(file_exists("uploads/expenses/$fileNameNew")) unlink("uploads/expenses/$fileNameNew");
                                                move_uploaded_file($fileTmpName,$fileDestination);

                                                $sql="UPDATE expenses
                                                SET date='".$date."',spend_for='".$spend_for."',image='".$fileNameNew."', name='".$name."', description='".$description."', gst_no='".$gst_no."', taxable_amt='".$taxable_amt."',cgst='".$cgst."',sgst='".$sgst."',total_paid='".$total_paid."'
                                                WHERE id='".$expense_id."'";
                                                $query=mysqli_query($conn,$sql);

                                                echo '<script type="text/javascript">
                                                setTimeout(function(){
                                                    swal({
                                                        icon:"success",
                                                        title:"Success!",
                                                        text:"Expense Data Updated Successfully",
                                                        button: "Close",
                                                    }).then(function(){
                                                         window.location.href="'.$previous.'"
                                                     });
                                                },500);
                                            </script>';
                                        }else{
                                            $sql="UPDATE expenses
                                            SET date='".$date."',spend_for='".$spend_for."', name='".$name."', description='".$description."', gst_no='".$gst_no."', taxable_amt='".$taxable_amt."',cgst='".$cgst."',sgst='".$sgst."',total_paid='".$total_paid."'
                                            WHERE id='".$expense_id."'";
                                            $query=mysqli_query($conn,$sql);

                                            echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"danger",
                                                    title:"Oops!",
                                                    text:"There was an error uploading the file... Try Again!",
                                                    button: "Close",
                                                }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                            },500);
                                        </script>';
                                        }
                                    }else{
                                        $sql="UPDATE expenses
                                        SET date='".$date."',spend_for='".$spend_for."', name='".$name."', description='".$description."', gst_no='".$gst_no."', taxable_amt='".$taxable_amt."',cgst='".$cgst."',sgst='".$sgst."',total_paid='".$total_paid."'
                                        WHERE id='".$expense_id."'";
                                        $query=mysqli_query($conn,$sql);
                                            echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"danger",
                                                    title:"Oops!",
                                                    text:"You cannot upload this file type...",
                                                    button: "Close",
                                                }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                            },500);
                                        </script>';
                                    }
                                }
                            ?>
                            <!-- Edit Expense Zone Ends -->

                            <!-- Delete Expenses Zone Starts -->
                            <?php
                                if (isset($_POST["delete"])){
                                    $delete_id=$_POST['expense_id'];
                                    $previous=$_POST['previous'];
                                    $sql="DELETE FROM expenses WHERE id='".$delete_id."'";
                                    $result=mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                    setTimeout(function(){
                                        swal({
                                            icon:"success",
                                            title:"Success!",
                                            text:"Expense Data Deleted Successfully",
                                            button: "Close",
                                        }).then(function(){
                                             window.location.href="'.$previous.'"
                                         });
                                    },500);
                                </script>';
                                }
                            ?>
                        <!-- Delete Expenses Zone Ends -->

                        <div class="table-responsive">
                            <div class="dataTable-filter">
                                <form action="expenses-all.php" method="GET">
                                    <div class="mt-0">
                                        <div class="col-md-10">
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <a class="nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">Filter All</a>
                                                    <a class="nav-link" id="nav-date-tab" data-toggle="tab" href="#nav-date" role="tab" aria-controls="nav-date" aria-selected="true">Filter by Date</a>
                                                    <a class="nav-link" id="nav-type-tab" data-toggle="tab" href="#nav-type" role="tab" aria-controls="nav-type" aria-selected="false">Filter By Type</a>
                                                </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                                                    <div class="col-md-12 d-flex mt-2">
                                                        <form action="expenses-all.php" method="GET">
                                                            <label class="form-label p-1" for="date">From</label>
                                                            <input class="form-control entries-filter mr-4" type="date" name="from" style="border:2px solid #24B387;border-radius: 10px;">
                                                            <label class="form-label p-1" for="date">To</label>
                                                            <input class="form-control entries-filter mr-4" type="date" name="to" style="border:2px solid #24B387;border-radius: 10px;">
                                                            <select class="entries-filter" name="spendfor" style="border: 2px solid #24B387; border-radius: 3px;height:30px;">
                                                                <option value="">Select Spending Type</option>
                                                                <?php
                                                                $spend="SELECT value FROM expenses_spendfor";
                                                                $spendfor=mysqli_query($conn,$spend);
                                                                while($spe=mysqli_fetch_array($spendfor)){
                                                                    echo'<option value="'.$spe['value'].'">'.$spe['value'].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <label class="mr-1">Show</label>
                                                                <select class="entries-filter" name="show" style="border: 2px solid #24B387; border-radius: 3px;height:30px;">
                                                                    <option value="10">10</option>
                                                                    <option value="25">25</option>
                                                                    <option value="50">50</option>
                                                                    <option value="100">100</option>
                                                                </select>
                                                            <label class="ml-1 mr-1">Entries</label>
                                                            <button type="submit" class="btn btn-primary btn-circle"><i class="fas fa-search"></i></button>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="nav-date" role="tabpanel" aria-labelledby="nav-date-tab">
                                                    <form action="expenses-all.php" method="GET">
                                                        <div class="col-md-8 d-flex mt-2">
                                                            <label class="form-label p-1" for="date">From</label>
                                                            <input class="form-control entries-filter mr-4" type="date" name="from" style="border:2px solid #24B387;border-radius: 10px;">
                                                            <label class="form-label p-1" for="date">To</label>
                                                            <input class="form-control entries-filter mr-4" type="date" name="to" style="border:2px solid #24B387;border-radius: 10px;">
                                                            <label class="form-label ml-2 mr-2">Show</label>
                                                            <select class="entries-filter" name="show" style="border: 2px solid #24B387; border-radius: 3px;height:30px;">
                                                                    <option value="10">10</option>
                                                                    <option value="25">25</option>
                                                                    <option value="50">50</option>
                                                                    <option value="100">100</option>
                                                                </select>
                                                            <label class="mr-2">Entries</label>
                                                            <button type="submit" class="btn btn-primary btn-circle"><i class="fas fa-search"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane fade" id="nav-type" role="tabpanel" aria-labelledby="nav-type-tab">
                                                    <form action="expenses-all.php" method="GET">
                                                        <div class="col-md-8 d-flex mt-2">
                                                            <label class="form-label mr-1" for="spendfor">Spend For</label>
                                                            <select class="entries-filter" name="spendfor" style="border: 2px solid #24B387; border-radius: 3px;height:30px;">
                                                                <option value="">Select Spending Type</option>
                                                                <?php
                                                                $spend="SELECT value FROM expenses_spendfor";
                                                                $spendfor=mysqli_query($conn,$spend);
                                                                while($spe=mysqli_fetch_array($spendfor)){
                                                                    echo'<option value="'.$spe['value'].'">'.$spe['value'].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <label class="form-label ml-2 mr-2">Show</label>
                                                            <select class="entries-filter" name="show" style="border: 2px solid #24B387; border-radius: 3px;height:30px;">
                                                                    <option value="10">10</option>
                                                                    <option value="25">25</option>
                                                                    <option value="50">50</option>
                                                                    <option value="100">100</option>
                                                                </select>
                                                            <label class="mr-2">Entries</label>
                                                            <button type="submit" class="btn btn-primary btn-circle"><i class="fas fa-search"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Spend For</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Total Paid</th>
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
                                                $pagereslimit = 10;
                                            }else{
                                                $pagereslimit = $_GET['show'];
                                            }
                                        // Finding out the total number of data in the table
                                            $sql = "SELECT * FROM expenses WHERE entry_by='".$_SESSION['userRel']."'";
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
                                        //Filtering with Date
                                            $userRel=$_SESSION['userRel'];
                                            if(isset($_GET['from']) && isset($_GET['to']) && isset($_GET['spendfor'])){
                                                $spend=$_GET['spendfor'];
                                                $from_date=date_create($_GET['from']);
                                                $fdate=date_format($from_date,'Ymd');
                                                $to_date=date_create($_GET['to']);
                                                $tdate=date_format($to_date,'Ymd');
                                                $sql="SELECT * FROM expenses WHERE entry_by='".$userRel."' AND spend_for LIKE '%".$spend."%' AND date BETWEEN ".$fdate." AND ".$tdate." ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit."";
                                            }else if(isset($_GET['from']) && isset($_GET['to'])){
                                                $from_date=date_create($_GET['from']);
                                                $fdate=date_format($from_date,'Ymd');
                                                $to_date=date_create($_GET['to']);
                                                $tdate=date_format($to_date,'Ymd');
                                                $sql="SELECT * FROM expenses WHERE entry_by='".$userRel."' AND date BETWEEN ".$fdate." AND ".$tdate." ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit."";
                                            }else if(isset($_GET['spendfor'])){
                                                $spend=$_GET['spendfor'];
                                                $sql="SELECT * FROM expenses WHERE entry_by='".$userRel."' AND spend_for LIKE '%".$spend."%' ORDER BY id ".$order." LIMIT ".$pagefirstvalue.",".$pagereslimit."";
                                            }else{
                                                $sql='SELECT * FROM expenses WHERE entry_by="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                            }
                                            $result = mysqli_query($conn, $sql);
                                            $total=0;
                                            if (mysqli_num_rows($result) > 0) {

                                            while($row= mysqli_fetch_array($result)){
                                                $date=date_create($row['date']);
                                                $expense_date=date_format($date,"d M Y");
                                                $total+=$row['total_paid'];
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $expense_date;?></td>
                                            <td><?php echo $row['spend_for'];?></td>
                                            <td><?php echo $row['name'];?></td>
                                            <td><?php echo $row['description'];?></td>
                                            <td><?php echo $row['total_paid'];?></td>
                                            <td style="text-align:center;"><?php echo'<a class="btn btn-circle btn-primary" href="expenses-view.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-circle btn-primary mr-1" href="expenses-edit.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-pen"></i></a>';
                                                echo'<a class="btn btn-circle btn-danger" href="expenses-delete.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-trash"></i></a></td>';?>
                                        </tr>
                                        <?php
                                        }
                                    } else{
                                        echo "Oops!! 0 results";
                                    }
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align:end;"><strong>Total</strong></td>
                                            <?php echo'<td>'.$total.'</td>';?>
                                            <td></td>
                                        </tr>
                                    </tbody>
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
                            <?php
                                for($page=1;$page<=$pagenumbers;$page++){?>
                                <li class="nav-item">
                                <?php echo '<a href="expenses-all.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #24B387;border-radius: 25px;background: #24B387;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';?></li><?php }?>
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
