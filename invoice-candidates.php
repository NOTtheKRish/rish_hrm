<?php
include('session.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/packageCheck.php');
include_once('includes/dbconfig.php');
include('includes/functions.php');
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
                        <h1 class="h3 mb-2 text-gray-800">Invoices - Candidates</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
                            <?php
                                if(isset($_GET['can'])){
                                    echo'<a class="d-none d-sm-inline-block btn btn-danger shadow-sm" href="invoice-candidates.php">
                                        <i class="fas fa-plus-circle text-white-50"></i>
                                        Show All
                                    </a>';
                                }else{
                                    echo'';
                                }
                            ?>
                            <a href="invoice-candidates-create.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-plus mr-2 fa-sm"></i>Add New Invoice</a>
                        </div>

                        <div class="card-body">
                            <?php
                            //Create New Candidate Invoice Zone Starts
                                if (isset($_POST["create"])){
                                    // Data being Inserted into the Database using Functions
                                    $invoice = new Rishi();
                                    if(!empty($_POST['can_id']) && $_POST['can_id']){
                                        $invoice->saveCanInvoice($_POST);
                                    }
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"New Invoice for Candidate Created Successfully!",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                                }
                                //Create New Candidate Invoice Zone Ends
                            ?>
                            <?php
                                // Edit Candidate Invoice Zone Starts
                                if(isset($_POST['update'])){
                                    $invoice = new Rishi();
                                    if((!empty($_POST['can_id']) && $_POST['can_id']) && (!empty($_POST['inv_id']) && $_POST['inv_id'])){
                                        $invoice->editCanInvoice($_POST);
                                    }
                                    echo '<script type="text/javascript">
                                                setTimeout(function(){
                                                    swal({
                                                        icon:"success",
                                                        title:"Success!",
                                                        text:"Candidate Invoice Edited Successfully!",
                                                        button: "Close",
                                                    });
                                                },500);
                                            </script>';
                                }
                                // Edit Candidate Invoice Zone Ends
                            ?>
                            <?php
                            //Delete Candidate Invoice Zone Starts
                                if (isset($_POST["delete"])){
                                    $delete_id=$_POST['inv_id'];
                                    $sql="DELETE FROM can_invoice WHERE id='".$delete_id."'";
                                    $result=mysqli_query($conn,$sql);
                                    $sq="DELETE FROM can_invoice_item WHERE inv_id='".$delete_id."'";
                                    $res=mysqli_query($conn,$sq);
                                    echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon:"success",
                                                    title:"Success!",
                                                    text:"Candidate Invoice Deleted Successfully",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                                }
                                //Delete Candidate Invoice Zone Ends
                            ?>
                            <div class="table table-responsive">
                            <div class="dataTable-filter">
                                <form action="invoice-candidates.php" id="form" method="GET">
                                    <div class="d-flex mt-1">
                                        <div class="col-md-3">
                                            <select class="form-control" oninput="search()" name="can">
                                                <option value="">Select Candidate</option>
                                                <?php
                                                    $sql="SELECT * FROM candidates WHERE entry_by='".$_SESSION['userRel']."'";
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
                                            <th>Invoice Date</th>
                                            <th>Invoice ID</th>
                                            <th>Candidate Name</th>
                                            <th>Total Amount</th>
                                            <th>Total Pending</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
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
                                            $sql = "SELECT * FROM can_invoice WHERE entry_by='".$userRel."' AND user_id='".$userId."'";
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
                                            if(isset($_GET['can'])){
                                                $can=$_GET['can'];
                                                $sql= "SELECT * FROM can_invoice WHERE can_id='".$can."' AND entry_by='".$userRel."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM can_invoice WHERE can_id='".$can."' AND entry_by='".$userRel."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }else{
                                                $sql= 'SELECT * FROM can_invoice WHERE entry_by="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                            }
                                        }else{
                                            if(isset($_GET['can'])){
                                                $can=$_GET['can'];
                                                $sql= "SELECT * FROM can_invoice WHERE can_id='".$can."' AND entry_by='".$userRel."' AND user_id='".$userId."'";
                                                    $result = mysqli_query($conn,$sql);
                                                    $result_num = mysqli_num_rows($result);
                                                    // Determine number of total pages available
                                                    $pagenumbers = ceil($result_num/$pagereslimit);
                                                $sql= "SELECT * FROM can_invoice WHERE can_id='".$can."' AND entry_by='".$userRel."' AND user_id='".$userId."' LIMIT ".$pagefirstvalue.",".$pagereslimit;
                                            }else{
                                                $sql= 'SELECT * FROM can_invoice WHERE entry_by="'.$userRel.'" AND user_id="'.$userId.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
                                            }
                                        }
                                            if(mysqli_query($conn,$sql)){
                                                echo "";
                                            }else{
                                                echo "Error". $sql . "<br>". mysqli_error($conn);
                                            }
                                            $result = mysqli_query($conn, $sql);
                                            $total_pending=0;
                                            if (mysqli_num_rows($result) > 0) {

                                            while($row= mysqli_fetch_array($result)){
                                                $id=$row['id'];
                                                $inv_id=$row['inv_id'];
                                                $total_pending+=$row['total_pending'];
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['inv_date'];?></td>
                                            <td><?php echo $row['inv_year'].'-CAN-'.$row['inv_id'];?></td>
                                            <td><?php
                                                $can_id=$row['can_id'];
                                                $sql="SELECT * FROM candidates WHERE id='".$can_id."'";
                                                $com=mysqli_query($conn,$sql);
                                                foreach($com as $rows){
                                                ?>
                                                <?php echo $rows['name'];?>
                                            <?php }?>
                                            </td>
                                            <td><?php echo '&#x20B9;'.$row['total_pay'];?></td>
                                            <td><?php echo '&#x20B9;'.$row['total_pending'];?></td>
                                            <td>
                                                <?php
                                                    if($row['status']=="PENDING"){
                                                        echo '<span class="badge bg-danger text-white">'.$row['status'].'</span>';
                                                    }else if($row['status']=="PAID"){
                                                        echo '<span class="badge bg-primary text-white">'.$row['status'].'</span>';
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align:center;"><?php echo'<a target="_blank" class="btn btn-circle btn-primary" href="invoice-candidates-view.php?id='.$id.'" style="font-size:1rem;"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-circle btn-primary" href="invoice-candidates-edit.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-pen"></i></a>
                                            <a target="_blank" class="btn btn-circle btn-primary" href="invoice-candidates-view.php?id='.$id.'&print=true" style="font-size:1rem;"><i class="fas fa-print"></i></a>
                                            <button data-id="'.$id.'" data-toggle="modal" data-target="#deleteInvoice" class="btn btn-circle btn-danger" style="font-size:1rem;"><i class="fas fa-trash"></i></button>';?></td>
                                        </tr>
                                        <?php
                                        }?>
                                        <tr>
                                            <td class="text-right" colspan="4">Total</td>
                                            <td><?php echo '&#x20B9;'.number_format($total_pending,2,'.',',');?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <?php } else{
                                        echo'<td class="text-center" colspan="7">Oops!! 0 results</td>';
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
                                                if(isset($_GET['com'])){
                                                    if(isset($_GET['page']) && $_GET['page']==$page){
                                                        echo '<a href="invoice-candidates.php?can='.$can.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                    }elseif(!isset($_GET['page']) && $page==1){
                                                        echo '<a href="invoice-candidates.php?can='.$can.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                    }else{
                                                        echo '<a href="invoice-candidates.php?can='.$can.'&page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                    }
                                                }else{
                                                    if(isset($_GET['page']) && $_GET['page']==$page){
                                                        echo '<a href="invoice-candidates.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                    }elseif(!isset($_GET['page']) && $page==1){
                                                        echo '<a href="invoice-candidates.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #14ee80;border-radius: 25px;background: #14ee80;color: #000;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                    }else{
                                                        echo '<a href="invoice-candidates.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';
                                                    }
                                                }
                                            ?>
                                        </li>
                                <?php }?>
                            </ul>
                        </div>
                        <!-- Delete Invoice Modal -->
                        <div class="modal fade" id="deleteInvoice" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteInvoiceLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="h4 modal-title text-gray-900" id="staticBackdropLabel">Delete Invoice</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Are you sure to Delete this Invoice?</h4>
                                        <form action="" method="POST">
                                            <input name="inv_id" class="form-control" hidden type="text" id="deleteInvoice-id">
                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button name="delete" type="submit" class="btn btn-primary">Delete</button>
                                        </form>
                                    </div>
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
<script type="text/javascript">
    function search(){
        document.getElementById("form").submit();
    }
    //JQuery script to get delId into a Modal
    $('#deleteInvoice').on('show.bs.modal',function(event){
        var button = $(event.relatedTarget); // Button that triggered the modal
        var delId = button.data('id'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('.modal-title').text('Delete Invoice - '+delId);
        modal.find('.modal-body #deleteInvoice-id').val(delId);
    });
</script>
