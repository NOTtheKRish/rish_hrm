<?php
    include('includes/header.php');
?>

<body class="bg-primary">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-10 col-md-5 pt-2">
                <div class="card o-hidden border-0 shadow-lg my-1">
                    <div class="card-body p-0">
                        <div class="row d-flex">
                            <div class="col-md-12">
                                <div class="p-3 mt-1">
                                    <div class="text-center">
                                        <h1 class="h3 text-gray-900 mt-3 mb-4"><strong>Sign Up</strong><i class="fas fa-user-plus ml-2"></i></h1>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="text-center">
                                        <form class="form" action="" method="POST" autocomplete="off">
                                            <div class="form-row justify-content-center px-4">
                                                <div class="col-md-6">
                                                    <div class="form-group col-md-12">
                                                        <input class="form-control form-control-user" type="text" name="name" placeholder="Name" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <input class="form-control form-control-user" type="text" name="username" placeholder="Username" maxlength="20" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <input class="form-control form-control-user" type="email" name="email" placeholder="E-Mail ID" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <input class="form-control form-control-user" type="text" name="number" placeholder="Phone Number" maxlength="10" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <input class="form-control form-control-user" type="password" name="password" placeholder="Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-md-12 justify-content-center">
                                                <button class="btn btn-primary" name="signup" type="submit"><i class="fas fa-shield-alt mr-2"></i><strong>Sign Up</strong></button>
                                            </div>
                                        </form>
                                        <!-- <div class="row mt-3 justify-content-center">
                                            <label for="copyright"><strong>Copyright &copy; V Way Infotech 2022</strong></label>
                                        </div> -->
                                        <div class="row mt-3 justify-content-center">
                                            <h5 class="text-gray-900"><strong>Having Account?<a class="ml-2 badge bg-primary text-white" href="login.php"><i class="fas fa-sign-in-alt mr-2"></i>Login</a></strong></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
    include("includes/dbconfig.php");
    if(isset($_POST['signup'])){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $pass = password_hash($_POST['password'],PASSWORD_DEFAULT);
        date_default_timezone_set('Asia/Kolkata');
        $created_at = date("Y-m-d H:i:s");
        $packageExpiry = date("Y-m-d H:i:s",strtotime('+3 days'));
        $package="FREE TRIAL";

        $sq = "SELECT max(id) FROM accounts";
        $re = mysqli_query($conn,$sq);
        while($ro = mysqli_fetch_array($re)){
        $id = ($ro['max(id)'])+1;
        }
        $role = 1;//admin

        //creating an admin user in accounts table
        $sql = "INSERT INTO accounts(id,role,userRelation,username,name,password,email,package,package_expiry,created_at) 
        VALUES ('".$id."','".$role."','".$id."','".$username."','".$name."','".$pass."','".$email."','".$package."','".$packageExpiry."','".$created_at."')";
        $res = mysqli_query($conn,$sql);
        //creating entry in settings table
        $sql = "INSERT INTO settings(id,name,email,number,entry_by,user_id) VALUES ('".$id."','".$name."','".$email."','".$number."','".$id."','".$id."')";
        $res = mysqli_query($conn,$sql);

          echo'<script type="text/javascript">
                  setTimeout(function(){
                      swal({
                        icon:"success",
                        title:"Success!",
                        text:"Registration Successful!",
                        button:"Close",
                      }).then(function() {
                          window.location = "login.php";
                      });
                  },500);
              </script>';
    }
?>

<?php
    include('includes/scripts.php');
?>