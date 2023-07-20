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
                    <div class="text-center mb-4">
                        <h1 class="h2 mb-2 text-gray-900"><i class="far fa-credit-card mr-2"></i>Subscription</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->

                    <?php
                        //Razorpay Package Section
                    ?>

                    <?php
                    //Edit Profile Zone Starts
                        if (isset($_POST['update'])){
                            $username=$_POST['username'];
                            $name=$_POST['name'];
                            $email=$_POST['email'];
                            $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
                            $sql="UPDATE accounts SET username='".$username."', name='".$name."', email='".$email."', password='".$password."' 
                            WHERE id='".$_POST['userid']."'";
                            $query=mysqli_query($conn,$sql);
                            echo '<script type="text/javascript">
                                        setTimeout(function(){
                                            swal({
                                                icon:"success",
                                                title:"Success!",
                                                text:"Data Updated Successfully",
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

                                    if ($stmt->num_rows>0){
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

                    <div class="card shadow mb-4">
                        <div class="card-body col-md-12">
                            <?php
                                $sql="SELECT name,username,email,package,package_expiry,created_at FROM accounts WHERE id='".$_SESSION['userId']."'";
                                $request=mysqli_query($conn,$sql);
                                while($row=mysqli_fetch_array($request)){
                                    $exp=date_create($row['package_expiry']);
                                    $expiry=date_format($exp,"d M, Y h:i A");
                            ?>
                            <div class="form-row text-gray-900">
                                <div class="form-group col-md-12">
                                    <div class="col-md-12 col-sm-4 mx-auto my-auto">
                                        <h4 class="col-sm-3 mb-3"><strong>Current Package</strong></h4>
                                        <div class="col-sm-3 col-md-12 col-lg-6">
                                            <div class="col-md-6 my-auto">
                                                <?php
                                                if($row['package']=="INFINITY"){
                                                    echo'<h6><strong>Package Name :</strong><label class="ml-2 badge text-white" style="background-color:#613DC1;">'.$row['package'].'</label></h6>';
                                                }else{
                                                    echo'<h6><strong>Package Name :</strong><label class="ml-2 badge bg-primary text-white">'.$row['package'].'</label></h6>';
                                                }
                                                ?>
                                            </div>
                                            <div class="col-md-8 my-auto">
                                                <h6><strong>Package Validity :</strong><label class="ml-2 badge bg-danger text-white"><?php echo $expiry;?></label></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-row text-gray-900">
                                <div class="col-md-12">
                                    <div class="col-md-12 d-flex justify-content-between">
                                            <h3 class="h4"><strong>Upgrade Subscription</strong></h3>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <label class="validityLabel"><strong>Monthly</strong></label>
                                            <div class="custom-control custom-switch custom-switch-xl ml-3">
                                                <input type="checkbox" class="custom-control-input inactive" id="duration">
                                                <label class="custom-control-label" for="duration" id="mY"></label>
                                            </div>
                                            <label class="validityLabel"><strong>Yearly</strong></label>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="form-row mt-3 d-flex justify-content-center col-md-12 mb-5 package-disp">
                                            <div class="card shadow col-md-3 mb-3 mr-3 package-card">
                                                <div class="mt-3 mb-2 mx-3">
                                                    <!-- <i class="package-icon bg-primary far fa-credit-card"></i> -->
                                                    <h4><strong>Basic</strong></h4>
                                                </div>
                                                <div class="col-sm-12 my-3">
                                                    <h5 class="h3"><strong>&#x20B9;<span id="basic">750</span></strong>&nbsp;<span class="h5" id="Basic">/ month</span></h5>
                                                    <span id="offer-1"></span>
                                                    <ul class="list-unstyled mt-4">
                                                        <li><strong>Manage Candidates</strong></li>
                                                        <li><strong><del class="text-gray">Manage Company</del></strong></li>
                                                        <li><strong><del class="text-gray">Manage Jobs</del></strong></li>
                                                        <li><strong>Manage Call List</strong></li>
                                                        <li><strong>Manage Accounts</strong></li>
                                                        <li><strong>Single User</strong></li>
                                                    </ul>
                                                    <a href="javascript:void(0)" class="btn btn-primary basicBtn" id="subscribeHRM" data-price="750" data-id="1"><strong><i class="far fa-credit-card mr-2"></i>Buy Now</strong></a>
                                                </div>
                                            </div>
                                            <div class="card shadow col-md-3 mb-3 mr-3 package-card recommended">
                                                <div class="mt-3 mb-2 mx-3">
                                                    <!-- <i class="package-icon bg-primary far fa-credit-card"></i> -->
                                                    <h4><strong>Smart</strong></h4>
                                                </div>
                                                <div class="col-sm-12 my-3">
                                                    <h5 class="h3"><strong>&#x20B9;<span id="smart">1000</span></strong>&nbsp;<span class="h5" id="Smart">/ month</span></h5>
                                                    <span id="offer-2"></span>
                                                    <ul class="list-unstyled mt-4">
                                                        <li><strong>Manage Candidates</strong></li>
                                                        <li><strong><del class="text-gray">Manage Company</del></strong></li>
                                                        <li><strong><del class="text-gray">Manage Jobs</del></strong></li>
                                                        <li><strong>Manage Call List</strong></li>
                                                        <li><strong>Manage Accounts</strong></li>
                                                        <li><strong>Multiple User</strong></li>
                                                    </ul>
                                                    <a href="javascript:void(0)" class="btn btn-white smartBtn" id="subscribeHRM" data-price="1000" data-id="2"><strong><i class="far fa-credit-card mr-2"></i>Buy Now</strong></a>
                                                </div>
                                            </div>
                                            <div class="card shadow col-md-3 mb-3 package-card">
                                                <div class="mt-3 mb-2 mx-3">
                                                    <!-- <i class="package-icon bg-primary far fa-credit-card"></i> -->
                                                    <h4><strong>Exclusive</strong></h4>
                                                </div>
                                                <div class="col-sm-12 my-3">
                                                    <h5 class="h3"><strong>&#x20B9;<span id="exclusive">1500</span></strong>&nbsp;<span class="h5" id="Exclusive">/ month</span></h5>
                                                    <span id="offer-3"></span>
                                                    <ul class="list-unstyled mt-4">
                                                        <li><strong>Manage Candidates</strong></li>
                                                        <li><strong>Manage Company</strong></li>
                                                        <li><strong>Manage Jobs</strong></li>
                                                        <li><strong>Manage Call List</strong></li>
                                                        <li><strong>Manage Accounts</strong></li>
                                                        <li><strong>Multiple Users</strong></li>
                                                    </ul>
                                                    <a href="javascript:void(0)" class="btn btn-primary exclusiveBtn" id="subscribeHRM" data-price="1500" data-id="3"><strong><i class="far fa-credit-card mr-2"></i>Buy Now</strong></a>
                                                </div>
                                            </div>
                                        </div>
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
<script src="js/custom.js"></script>
<!--  Razorpay Payment Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $('body').on('click','#subscribeHRM', function(e){
            var totalAmount=$(this).attr("data-price");
            var packageId=$(this).attr("data-id");
            var user="<?php echo $_SESSION['userRel'];?>";
            var options = {
                "key": "rzp_live_ApY6KwF2zxMpfl",
                "amount": (totalAmount*100), // 2000 paise = INR 20
                "name": "V Way Infotech",
                "description": "Subscription for Recruitment HRM",
                "handler": function(response){
                    $.ajax({
                        url: 'packagePurchase.php',
                        type: 'post',
                        dataType: 'json',
                        data: {
                          razorpay_payment_id: response.razorpay_payment_id ,totalAmount: totalAmount,package_id: packageId,user:user,
                        }, 
                        success: function (msg){
                        // window.location.href = 'success.php';
                            swal({
                                icon:"success",
                                title:"Payment Successful!",
                                text:"Your Plan Activated successfully...",
                                buttons: "Close",
                            }).then(function(){
                                window.location="index.php";
                            });
                        }
                    });
                },
                "theme": {
                "color": "#14EE80"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        });
    </script>