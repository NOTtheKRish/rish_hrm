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
                            <h6 class="m-0 font-weight-bold text-primary">View Report</h6>
                            <?php
                                if(isset($_GET['from']) && isset($_GET['to'])){
                                    echo'<a href="usersreport-view.php?id='.$_GET['id'].'" class="btn btn-primary">
                                        <i class="fas fa-eye mr-2"></i>
                                        View Today\'s Report
                                    </a>';
                                }
                            ?>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                            <div class="dataTable-filter">
                                <form class="form" action="usersreport-view.php" method="GET">
                                    <div class="d-flex mt-1">
                                        <div class="col-md-6 d-flex">
                                                    <?php echo'<input type="text" hidden name="id" value="'.$_GET['id'].'">';?>
                                                <label class="p-1 mr-1" for="vendor_status">From</label>
                                                    <input class="form-control mr-3" type="date" id="from" name="from">
                                                <label class="p-1 mr-1" for="vendor_status">To</label>
                                                    <input class="form-control mr-1" type="date" id="to" name="to">
                                                <button class="btn btn-primary btn-circle mr-1"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12 p-5">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                                    <?php
                                        $view_data=$_GET['id'];
                                    ?>
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Total Calls</th>
                                            <th>Total Candidates</th>
                                            <th>Total Company</th>
                                            <th>Total Vacancy</th>
                                            <th>Total Interview Sent</th>
                                            <th>Total Joining</th>
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
                                            $sql = "SELECT id,name FROM accounts WHERE id=".$view_data."";
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
                                        //Filtering with Call Status
                                            $sql="SELECT id,username,name FROM accounts WHERE id=".$view_data."";
                                            $result=mysqli_query($conn,$sql);
                                            if(mysqli_num_rows($result)>0){
                                            while($row= mysqli_fetch_array($result)){                                                
                                        ?>
                                        <div class="d-flex col-md-12">
                                            <h4 class="mr-2">Username :</h4><h5 class="p-1 mr-3 text-gray-900"><?php echo $row['username'];?></h5>
                                            <h4 class="mr-2">Name :</h4><h5 class="p-1 mr-3 text-gray-900"><?php echo $row['name'];?></h5>
                                            <?php
                                                if(!isset($_GET['from'])){
                                                    if(!isset($_GET['to'])){
                                                        $date=date('d M Y');
                                                        $date_0=date('Ymd');
                                                        // $date_2=date("Ymd",strtotime('+1 day'));
                                                        // $date_1=date("Ymd",strtotime('-1 day'));
                                                        echo'<h4 class="ml-5 text-gray-900">Overall Report - '.$date.'</h4>';
                                                        // $calls="SELECT * FROM calls WHERE created_at BETWEEN ".$date_1." AND ".$date_2." AND user_id=".$view_data."";
                                                        $calls="SELECT * FROM calls WHERE created_at >=".$date_0." AND user_id=".$view_data."";
                                                        $int_sent="SELECT * FROM interview_sent WHERE sent_date=".$date_0." AND user_id=".$view_data."";
                                                        $joining="SELECT * FROM joined WHERE joined_on=".$date_0." AND user_id=".$view_data."";
                                                        $candidates="SELECT * FROM candidates WHERE created_at >=".$date_0." AND user_id=".$view_data."";
                                                        $company="SELECT * FROM company WHERE created_at >=".$date_0." AND user_id=".$view_data."";
                                                        $vacancy="SELECT * FROM jobs WHERE created_at >=".$date_0." AND user_id=".$view_data."";
                                                    }
                                                }else{
                                                    // Getting Current Date using PHP date()
                                                    $date_1=$_GET['from'];
                                                    $_date=date_create($date_1);
                                                    $date01=date_format($_date,"d M Y");
                                                    $date1=date_format($_date,"Ymd");
                                                    $date_2=$_GET['to'];
                                                    $date_=date_create($date_2);
                                                    $date02=date_format($date_,"d M Y");
                                                    $date2=date_format($date_,"Ymd");

                                                    $d1= new DateTime($date_2);
                                                    $d1->modify('+1 day');
                                                    $d2=$d1->format('Ymd');
                                                    echo'<script type="text/javascript">console.log("'.$d1->format('d M Y').'");</script>';
                                                    echo'<h4 class="ml-5 text-gray-900">Overall Report - From '.$date01.' Till '.$date02.'</h4>';
                                                    $calls="SELECT * FROM calls WHERE created_at >=".$date1." AND created_at<=".$d2." AND user_id=".$view_data."";
                                                    $int_sent="SELECT * FROM interview_sent WHERE sent_date >=".$date1." AND created_at<=".$d2." AND user_id=".$view_data."";
                                                    $joining="SELECT * FROM joined WHERE joined_on >=".$date1." AND created_at<=".$d2." AND user_id=".$view_data."";
                                                    $candidates="SELECT * FROM candidates WHERE created_at >=".$date1." AND created_at<=".$d2." AND user_id=".$view_data."";
                                                    $company="SELECT * FROM company WHERE created_at >=".$date1." AND created_at<=".$d2." AND user_id=".$view_data."";
                                                    $vacancy="SELECT * FROM jobs WHERE created_at >=".$date1." AND created_at<=".$d2." AND user_id=".$view_data."";
                                                }
                                            ?>
                                        </div>
                                    <tbody>
                                        <tr>
                                            <?php 
                                                $res=mysqli_query($conn,$calls);
                                                $res_num=mysqli_num_rows($res);
                                            ?>
                                            <td><?php echo $res_num;?></td>
                                            <?php 
                                                $res=mysqli_query($conn,$candidates);
                                                $res_num=mysqli_num_rows($res);
                                            ?>
                                            <td><?php echo $res_num;?></td>
                                            <?php 
                                                $res=mysqli_query($conn,$company);
                                                $res_num=mysqli_num_rows($res);
                                            ?>
                                            <td><?php echo $res_num;?></td>
                                            <?php 
                                                $res=mysqli_query($conn,$vacancy);
                                                $res_num=mysqli_num_rows($res);
                                            ?>
                                            <td><?php echo $res_num;?></td>
                                            <?php 
                                                $res=mysqli_query($conn,$int_sent);
                                                $res_num=mysqli_num_rows($res);
                                            ?>
                                            <td><?php echo $res_num;?></td>
                                            <?php 
                                                $res=mysqli_query($conn,$joining);
                                                $res_num=mysqli_num_rows($res);
                                            ?>
                                            <td>
                                                <?php echo $res_num;?>
                                                
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