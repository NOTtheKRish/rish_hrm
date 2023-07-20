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
                        <h1 class="h3 mb-2 text-gray-800">Payments - Company</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
                            <?php
                                if(isset($_GET['company'])){
                                    echo'<a class="d-none d-sm-inline-block btn btn-danger shadow-sm" href="payments-company.php">
                                        <i class="fas fa-plus-circle text-white-50"></i>
                                        Show All
                                    </a>';
                                }else{
                                    echo'';
                                }
                            ?>
                            <a href="payments-company-create.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-plus mr-2 fa-sm"></i>Add New Payment</a>
                        </div>

                        <div class="card-body">
                            <?php
                            //  Create Zone Starts
                                if (isset($_POST["create"])){
                                    $previous=$_POST['previous'];
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"New Payment for Company Created Successfully",
                                                    button: "Close",
                                                }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                            },500);
                                        </script>';
                                        // Data being Inserted into the Database
                                        $inv_id=$_POST['inv_id'];
                                        $payAmt=$_POST['payAmt'];
                                        $payMethod=$_POST['payMethod'];
                                        $payDate=$_POST['payDate'];
                                        date_default_timezone_set('Asia/Kolkata');
                                        $created_at=date('Y-m-d H:i:s');

                                        $qw="SELECT com_id,total_pending,total_paid FROM com_invoice WHERE id='".$inv_id."'";
                                        $qwe=mysqli_query($conn,$qw);
                                        while($ro=mysqli_fetch_array($qwe)){
                                            $outstanding=$ro['total_pending'];
                                            $paid=$ro['total_paid'];
                                            $com_id=$ro['com_id'];
                                        }
                                        //adding paid amt to total_paid
                                        $paid+=$payAmt;
                                        $outstanding-=$payAmt;
                                        if($outstanding==0){
                                            $status="PAID";
                                        }else if($outstanding!=0){
                                            $status="PENDING";
                                        }
                                        //Adding a Payment Record
                                        $entry_by=$_SESSION['userRel'];
                                        $userId=$_SESSION['userId'];
                                        $sql="INSERT INTO com_payment (inv_id,com_id,payMethod,payAmt,pay_date,entry_by,user_id,created_at)
                                        VALUES ('".$inv_id."','".$com_id."','".$payMethod."','".$payAmt."','".$payDate."','".$entry_by."','".$userId."','".$created_at."')";
                                        $result=mysqli_query($conn,$sql);
                                        //Saving Current Invoice Payment Calculation
                                        $sql="UPDATE com_invoice SET total_paid='".$paid."',total_pending='".$outstanding."',status='".$status."' WHERE id='".$inv_id."'";
                                        $res=mysqli_query($conn,$sql);
                                }
                                // Create New Company payment Zone Ends
                            ?>
                            <?php
                                //Delete Payment Zone Starts

                                if (isset($_POST["delete"])){
                                    $previous=$_POST['previous'];
                                    $delete_id=$_POST['payId'];
                                    //Getting existing data from Payment
                                    $sql="SELECT inv_id,payAmt from com_payment WHERE id='".$delete_id."'";
                                    $res=mysqli_query($conn,$sql);
                                    while($ro=mysqli_fetch_array($res)){
                                        $payAmt=$ro['payAmt'];
                                        $inv_id=$ro['inv_id'];
                                    }
                                    //Getting existing data from Invoice
                                    $qw="SELECT total_pending,total_paid,status FROM com_invoice WHERE id='".$inv_id."'";
                                    $qwe=mysqli_query($conn,$qw);
                                    while($ro=mysqli_fetch_array($qwe)){
                                        $outstanding=$ro['total_pending'];
                                        $paid=$ro['total_paid'];
                                        $status=$ro['status'];
                                    }
                                    //now,subtracting payAmt(that is being deleted) from paid and adding payAmt to pending
                                    $outstanding+=$payAmt;
                                    $paid-=$payAmt;
                                    if($outstanding==0){
                                        $status="PAID";
                                    }else if($outstanding!=0){
                                        $status="PENDING";
                                    }
                                    //Saving Current Invoice Payment Calculation
                                    $sql="UPDATE com_invoice SET total_paid='".$paid."',total_pending='".$outstanding."',status='".$status."' WHERE id='".$inv_id."'";
                                    $res=mysqli_query($conn,$sql);
                                    //Now, deleting the Payment Record
                                    $sql="DELETE FROM com_payment WHERE id='".$delete_id."'";
                                    $result=mysqli_query($conn,$sql);
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"Payment Data Deleted Successfully",
                                                    button: "Close",
                                                }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                            },500);
                                        </script>';
                                }
                                // Delete Payment Zone Ends
                                ?>
                        <?php

                            //Edit Payment Details
                            if(isset($_POST['edit'])){
                                $previous=$_POST['previous'];
                                $payId=$_POST['payId'];//id of Payment that is being edited
                                $invId=$_POST['invId'];//id of Invoice that is being edited
                                $payDate=$_POST['payDate'];
                                $payAmt=$_POST['payAmt'];
                                $payMethod=$_POST['payMethod'];
                                $oldPaid=$_POST['oldPaid'];

                                //Getting existing data from Invoice
                                $sq="SELECT * FROM com_invoice WHERE id='".$invId."'";
                                $re=mysqli_query($conn,$sq);
                                while($r=mysqli_fetch_array($re)){
                                    $outstanding=$r['total_pending'];
                                    $paid=$r['total_paid'];
                                    $status=$r['status'];
                                }
                                //now, we add (old payAmt) with total_pending and subtract (old payAmt) with total_paid
                                $outstanding+=$oldPaid;
                                $paid-=$oldPaid;

                                //now, modifying the edited data
                                $paid+=$payAmt;
                                $outstanding-=$payAmt;

                                if($outstanding==0){
                                    $status="PAID";
                                }else if($outstanding!=0){
                                    $status="PENDING";
                                }
                                //Saving Current Invoice Payment Calculation
                                $sql="UPDATE com_invoice SET total_paid='".$paid."',total_pending='".$outstanding."',status='".$status."' WHERE id='".$invId."'";
                                $res=mysqli_query($conn,$sql);


                                //Editing Payment Data
                                //Saving Current Payment Calculation
                                $sql="UPDATE com_payment SET payMethod='".$payMethod."',payAmt='".$payAmt."',pay_date='".$payDate."' WHERE id='".$payId."'";
                                $res=mysqli_query($conn,$sql);
                                echo '<script type="text/javascript">
                                        setTimeout(function(){
                                            swal({
                                                icon:"success",
                                                title:"Success!",
                                                text:"Payment Data Modified Successfully",
                                                button: "Close",
                                            }).then(function(){
                                                     window.location.href="'.$previous.'"
                                                 });
                                        },500);
                                    </script>';
                            }
                        ?>
                            <div class="table table-responsive">
                            <div class="dataTable-filter">
                                <form action="payments-company.php" id="form" method="GET">
                                    <div class="d-flex mt-1">
                                        <div class="col-md-3">
                                            <select class="form-control" name="company" oninput="search()">
                                                <option value="">Select Company</option>
                                                <?php
                                                    $sql="SELECT * FROM company WHERE entry_by='".$_SESSION['userRel']."'";
                                                    $result=mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($result)>0){
                                                    while($row=mysqli_fetch_array($result)){
                                                ?>
                                                <?php echo'<option value="'.$row['id'].'">'.$row['name'].'</option>';?>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Payment Date</th>
                                            <th>Invoice ID</th>
                                            <th>Payment Method</th>
                                            <th>Payment Amount</th>
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
                                            $sql = "SELECT * FROM com_payment WHERE entry_by='".$userRel."' AND user_id='".$userId."'";
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
                                        if($userRel==$userId){
                                            if(isset($_GET['company'])){
                                                $company=$_GET['company'];
                                                $sql= "SELECT * FROM com_payment WHERE com_id='".$company."' AND entry_by='".$userRel."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM com_payment WHERE com_id='".$company."' AND entry_by='".$userRel."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }else{
                                                $sql= 'SELECT * FROM com_payment WHERE entry_by="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                            }
                                        }else{
                                            if(isset($_GET['company'])){
                                                $company=$_GET['company'];
                                                $sql= "SELECT * FROM com_payment WHERE com_id='".$company."' AND entry_by='".$userRel."' AND user_id='".$userId."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM com_payment WHERE com_id='".$company."' AND entry_by='".$userRel."' AND user_id='".$userId."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }else{
                                                $sql= 'SELECT * FROM com_payment WHERE entry_by="'.$userRel.'" AND user_id="'.$userId.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
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
                                            <td><?php echo $row['pay_date'];?></td>
                                            <td><?php echo $row['inv_id'];?></td>
                                            <td><?php echo $row['payMethod'];?></td>
                                            <td><?php echo '&#x20B9;'.$row['payAmt'];?></td>
                                            <td style="text-align:center;"><?php echo'<a class="btn btn-circle btn-primary" href="payments-company-view.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-circle btn-primary" href="payments-company-edit.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-pen"></i></a>
                                            <a class="btn btn-circle btn-danger" href="payments-company-delete.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-trash"></i></a>';?></td>
                                        </tr>
                                    </tbody>
                                        <?php
                                        }
                                    } else{
                                        echo '<td class="text-center" colspan="5">Oops!! 0 results</td>';
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
                                        if(isset($_GET['company'])){
                                            if(isset($_GET['page']) && $_GET['page']==$page){
                                                echo '<a href="payments-company.php?company='.$company.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }elseif(!isset($_GET['page']) && $page==1){
                                                echo '<a href="payments-company.php?company='.$company.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }else{
                                                echo '<a href="payments-company.php?company='.$company.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }
                                        }else{
                                            if(isset($_GET['page']) && $_GET['page']==$page){
                                                echo '<a href="payments-company.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }elseif(!isset($_GET['page']) && $page==1){
                                                echo '<a href="payments-company.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                            }else{
                                                echo '<a href="payments-company.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
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
<script type="text/javascript">
    function search(){
        document.getElementById("form").submit();
    }
</script>
