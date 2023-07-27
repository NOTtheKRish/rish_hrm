<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include_once('includes/dbconfig.php');

    // Check if $_SESSION or $_COOKIE already set
    if(isset($_SESSION['userid'])){
        // header("index.php");
        echo'<script type="text/javascript">
            window.location.href="index.php";
        </script>';
    }else if(isset($_COOKIE['rememberme'])){
        // Fetch rememberme cookie value
        $userid = $_COOKIE['rememberme'];
        $sql_query = "SELECT username,id,role,userRelation,password FROM accounts WHERE id='".$userid."'";
        $result = mysqli_query($conn,$sql_query);
        while($row = mysqli_fetch_array($result)){
            session_name('RishHRM');
            session_start();
            $_SESSION['userid'] = $userid;
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $row['username'];
            $_SESSION['id'] = $row['role']; //User's Role
            $_SESSION['userId'] = $row['id']; //User's ID
            $_SESSION['userRel'] = $row['userRelation']; //Logged In User's Relation ID
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start']+(10*60);
            // header("index.php");
            echo'<script type="text/javascript">
                window.location.href="index.php";
            </script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Important Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Rishigesan G">
    <!-- Favicon -->
    <?php
        include_once('includes/dbconfig.php');
        $sql="SELECT * FROM settings WHERE entry_by='1'";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($result)){
    ?>
    <link rel="icon" type="image/png" href="img/<?php echo $row['favicon']; ?>">
    <!-- Title Tag -->
    <title>Login | <?php echo $row['name']; ?></title>
    <?php }?>
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style type="text/css">
    .bd-placeholder-img{
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }
    @media (min-width: 768px){
        .bd-placeholder-img-lg{
        font-size: 3.5rem;
        }
    }
    html,body{
        height: 100%;
    }
    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #CCE3DE;
    }
    .border-radius-20{
        border-radius: 20px;
    }
    .form-signin {
        width: 100%;
        max-width: 335px;
        padding: 15px;
        margin: auto;
    }
    .form-signin .checkbox {
        font-weight: 400;
    }
    .form-signin .form-floating:focus-within {
        z-index: 2;
    }
    .form-signin input[type="text"] {
        margin-bottom: -1px;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }
    .swal-button{
        background: #0070FF;
    }
    .btn-primary{
        background: #0070FF;
    }
    .hidden{
        display: none!important;
    }
</style>
</head>
<body class="text-center">
    
<main class="form-signin">
  <form class="form" method="POST" action="login-handler.php" autocomplete="off">
    <img class="mb-4 border-radius-20" src="img/logo.png" alt="Lakshy-Logo" width="150px">
    <h1 class="h3 mb-3">Lakshy Info Technologies</h1>
    <div class="form-floating">
      <input type="text" class="form-control" name="username" id="username" placeholder="Username">
      <label for="username">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" placeholder="Password" id="pass">
      <label for="password">Password</label>
    </div>
    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" value="remember-me" name="rememberme" checked id="rememberme">
      <label class="form-check-label" for="flexCheckDefault">
        Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary disabled hidden" id="initSignIn">
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span class="visually-hidden">Loading...</span>
    </button>
    <button class="w-100 btn btn-lg btn-primary" name="signIn" id="signIn">Sign In</button>
    <!-- <p class="mt-5 mb-3 text-muted">Copyright &copy; Lakshy Info Technologies</p> -->
  </form>
</main>
</body>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('body').on('click','#signIn',function(e){
            e.preventDefault();
            var username = $('#username').val();
            var pass = $('#pass').val();
            var rememberme = $('#rememberme').val();
            $('#initSignIn').removeClass('hidden');
            $('#signIn').addClass('hidden');
            $.ajax({
                url:'login-handler.php',
                type:'post',
                dataType:'json',
                data:{
                    username: username,
                    pass: pass,
                    rememberme: rememberme,
                },
                success:function(msg){
                    // console.log(msg);
                    $('#initSignIn').addClass('hidden');
                    $('#signIn').removeClass('hidden');
                    setTimeout(function(){
                        if(msg.status == "error"){
                            swal({
                                icon: "error",
                                title: msg.message,
                            });
                        }else if(msg.status == "success"){
                            swal({
                                icon: "success",
                                title: msg.message,
                                buttons: {
                                    confirm: "Go to Dashboard",
                                }
                            }).then(function(){
                                window.location.href = "index.php";
                            });
                        }
                    },600);
                }
            });
        });
    </script>
</html>