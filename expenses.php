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
                        <h3 class="text-primary"><i class="fas fa-wallet mr-3"></i></h3>
                        <h1 class="h3 mb-2 text-gray-800">Expenses</h1>
                    </div>

                    <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h5 class="m-0 font-weight-bold" style="color:#000;">Expenses Overview</h5>
                                <div>
                                    <a class="btn btn-circle btn-primary" href="expenses-create.php"><i class="fas fa-plus"></i></a>
                                    <a class="btn btn-circle btn-primary" href="expenses-all.php"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="myPieChart"></canvas>
                                </div>
                                <div class="mt-4 text-center">
                                    <span class="mr-2">
                                        <i class="fas fa-circle mr-1" style="color: #0070ff;"></i>Ad
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle mr-1" style="color: #1cc88a;"></i>EB Bill
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle mr-1" style="color: #36b9cc;"></i>Extra
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle mr-1" style="color: #2dd880;"></i>Food
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle mr-1" style="color: #ffb20f;"></i>Home
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle mr-1" style="color: #ffe548;"></i>Hospital
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle mr-1" style="color: #23f0c7;"></i>Mobile Bills
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle mr-1" style="color: #f93943;"></i>Office
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle mr-1" style="color: #080477;"></i>Petrol
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle mr-1" style="color: #b18fcf;"></i>Purchase
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle mr-1" style="color: #204b57;"></i>Salary
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle mr-1" style="color: #f78764;"></i>Service
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle mr-1" style="color: #7bb2d9;"></i>Social Media
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle mr-1" style="color: #9dc7c8;"></i>Travel
                                    </span>
                                </div>
                            </div>
                            <?php
                                include('expenses-total.php');
                            ?>
                        </div><!-- Card Ends -->
                </div>

            </div>
            <?php include('includes/footer.php');?>
                <!-- /.container-fluid -->
        </div>
            <!-- End of Main Content -->

<?php
    include('includes/scripts.php');
?>
<script type="text/javascript">
//Expenses Chart Content
// Set new default font family and font color to mimic Bootstrap's default styling

Chart.defaults.global.defaultFontFamily = 'Nunito Sans','-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
    labels: ["Ad","EB Bill","Extra","Food","Home","Hospital","Mobile Bills","Office","Petrol","Purchase","Salary","Service","Social Media","Travel"],
    datasets: [{
        <?php echo'data: ['.$ad.','.$eb.','.$extra.','.$food.','.$home.','.$hospital.','.$mobile_bills.','.$office.','.$petrol.','.$purchase.','.$salary.','.$service.','.$social.','.$travel.'],';?>
      backgroundColor: ['#0070ff', '#1cc88a', '#36b9cc','#2dd880','#ffb20f','#ffe548','#23f0c7','#f93943','#080477','#b18fcf','#204b57','#f78764','#7bb2d9','#9dc7c8'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf','#2dd880','#e09900','#ffda01','#0dbf9b','#f8121d','#020122','#9c70c2','#327486','#f5683d','#5199cd','#62a6a7'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
    },
    options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
    },
    });    
</script>