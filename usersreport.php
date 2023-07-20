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
                    <div class="d-sm-flex justify-content-center mb-4">
                        <h3 class="text-primary"><i class="fas fa-chart-line mr-3"></i></h3>
                        <h1 class="h3 mb-2 text-gray-800">Users Report</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
                        </div>

                        <div class="card-body">
                        <div class="table-responsive">
                            <!-- <div class="dataTable-filter">
                                <form class="form" action="usersreport.php" method="GET">
                                    <div class="d-flex mt-1">
                                        <div class="col-md-7 d-flex">
                                                <label class="p-1 mr-1" for="vendor_status">From</label>
                                                <input class="form-control mr-3" type="date" name="from">
                                                <label class="p-1 mr-1" for="vendor_status">To</label>
                                                <input class="form-control mr-1" type="date" name="to">
                                                <button class="btn btn-primary btn-circle mr-1"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div> -->
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Total Calls</th>
                                            <th>Total Joining</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        If needed add contents same sa <thead>
                                    </tfoot> -->
                                    <?php
                                        // Maximum results in a page - $pagereslimit variable
                                        // Results Order By value Check and Manipulating 
                                            $order="ASC";
                                        // Dynamic Page Result Limit Check and Manipulating
                                            if(!isset($_GET['show'])){
                                                $pagereslimit = 10;
                                            }else{
                                                $pagereslimit = $_GET['show'];
                                            }
                                        // Finding out the total number of data in the table
                                            $userRel=$_SESSION['userRel'];
                                            $sql = "SELECT id,name FROM accounts WHERE userRelation='".$userRel."'";
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
                                            $sql='SELECT id,name FROM accounts WHERE userRelation="'.$userRel.'" ORDER BY id '.$order.' LIMIT '.$pagefirstvalue.','.$pagereslimit;
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
                                            <td><?php echo $row['name'];?></td>
                                            <?php 
                                                $calls="SELECT * FROM calls WHERE user_id=".$row['id']."";
                                                $res=mysqli_query($conn,$calls);
                                                $res_num=mysqli_num_rows($res);
                                            ?>
                                            <td><?php echo $res_num;?></td>
                                            <?php 
                                                $joining="SELECT * FROM joined WHERE user_id=".$row['id']."";
                                                $res=mysqli_query($conn,$joining);
                                                $res_num=mysqli_num_rows($res);
                                            ?>
                                            <td><?php echo $res_num;?></td>
                                            <td style="text-align:center;">
                                                <?php echo'<a class="btn btn-circle btn-primary" href="usersreport-view.php?id='.$row['id'].'" style="font-size:1rem;"><i class="fas fa-eye"></i></a>';
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                        <?php
                                        }
                                    } else{
                                        echo "Oops!! 0 results";
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
                                <?php echo '<a href="vendors.php?page='.$page.'&show='.$pagereslimit.'&order='.$order.'#dataTable" class="nav-link tm-paging-link" style="border: 2px solid #0070ff;border-radius: 25px;background: #0070ff;color: #fff;margin-top: 5px;margin-left: 18px;margin-bottom: 10px">'.$page.'</a>';?></li><?php }?>
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