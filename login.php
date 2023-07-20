<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include_once('includes/dbconfig.php');

    // Check if $_SESSION or $_COOKIE already set
    if(isset($_SESSION['userid'])){
      echo'<script type="text/javascript">
          window.location.href="index.php";
      </script>';
    }else if(isset($_COOKIE['rememberme'])){
      // Decrypt cookie variable value
      // $userid = decryptCookie($_COOKIE['rememberme']);
      $userid=$_COOKIE['rememberme'];
      $sql_query = "SELECT username,id,role,userRelation,password FROM accounts WHERE id='".$userid."'";
      $result = mysqli_query($conn,$sql_query);
      while($row = mysqli_fetch_array($result)){
         session_name('RishHRM');
         session_start();
         // session_regenerate_id();
         $_SESSION['userid'] = $userid;
         $_SESSION['loggedin'] = TRUE;
         $_SESSION['name'] = $row['username'];
         $_SESSION['id'] = $row['role'];//User's Role
         $_SESSION['userId'] = $row['id'];//User's ID
         $_SESSION['userRel'] = $row['userRelation'];//Logged In User's Relation ID
         $_SESSION['start'] = time();
         $_SESSION['expire'] = $_SESSION['start']+(10*60);
         echo'<script type="text/javascript">
             window.location.href="index.php";
         </script>';
     }
    }
    // On submit
    if(isset($_POST['login_btn'])){
      $uname = mysqli_real_escape_string($conn,$_POST['username']);
      $password = mysqli_real_escape_string($conn,$_POST['password']);

      if ($uname != "" && $password != ""){
         $sql_query = "SELECT username,id,role,userRelation,password FROM accounts WHERE username='".$uname."'";
         $result = mysqli_query($conn,$sql_query);
         while($row = mysqli_fetch_array($result)){
             $pw=$row['password'];
             if(password_verify($password, $pw)){
                $userid = $row['id'];
                if(isset($_POST['rememberme'])){
                   // Set cookie variables
                   $days = 1;
                   $value=$userid;
                   setcookie("rememberme",$value,time()+ ($days * 24 * 60 * 60 * 100),"/");
                   session_name('RishHRM');
                   session_start();
                   $_SESSION['userid'] = $userid;
                   $_SESSION['loggedin'] = TRUE;
                   $_SESSION['name'] = $row['username'];
                   $_SESSION['id'] = $row['role'];//User's Role
                   $_SESSION['userId'] = $row['id'];//User's ID
                   $_SESSION['userRel'] = $row['userRelation'];//Logged In User's Relation ID
                   $_SESSION['start'] = time();
                   $_SESSION['expire'] = $_SESSION['start']+(1 * 24 * 60 * 60 * 100);
               }else{
                    session_name('RishHRM');
                    session_start();
                    $_SESSION['userid'] = $userid;
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $row['username'];
                    $_SESSION['id'] = $row['role'];//User's Role
                    $_SESSION['userId'] = $row['id'];//User's ID
                    $_SESSION['userRel'] = $row['userRelation'];//Logged In User's Relation ID
                    $_SESSION['start'] = time();
                    $_SESSION['expire'] = $_SESSION['start']+(1 * 24 * 60 * 60 * 100);
                }
                echo'<script type="text/javascript">
                    window.location.href="index.php";
                </script>';
            }else{
                echo'<script type="text/javascript">
                    alert("Invalid Password!");
                </script>';
            }
        }
      }
    }
        include('includes/header.php');
?>

<body class="bg-primary">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-10 col-md-5">
                <div class="card o-hidden border-0 shadow-lg my-4">
                    <div class="card-body p-0">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 mt-3 my-4" src="img/undraw_auth.svg" alt="Oops!">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 mt-5">
                                    <div class="text-center">
                                        <h1 class="h2 text-gray-900 mb-4"><strong>Login</strong><i class="fas fa-lock ml-2"></i></h1>
                                    </div>
                                </div>
                                <div class="p-3 mb-1">
                                    <div class="text-center">
                                        <form class="user" action="login.php" method="POST">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <input class="form-control form-control-user" type="text" name="username" placeholder="Username" required>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <input class="form-control form-control-user" type="password" name="password" placeholder="Password" required>
                                                </div>
                                                <div class="form-group ml-3">
                                                    <div class="custom-control custom-checkbox small">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="rememberme" checked>
                                                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <button class="btn btn-primary" name="login_btn" type="submit"><i class="fas fa-sign-in-alt mr-2"></i><strong>LOGIN</strong></button>
                                                </div>
                                                <div class="form-group col-md-12" style="margin-top:10px;">
                                                    <h5 class="text-gray-900">New User?&emsp;<a href="signup.php" class="badge bg-primary text-white"><i class="fas fa-user-plus mr-2"></i><strong>Sign Up</strong></a></h5>
                                                </div>
                                            </div>
                                        </form>
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
    include('includes/scripts.php');
?>
