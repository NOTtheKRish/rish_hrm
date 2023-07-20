<?php
    session_name("VWay");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Important Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="V Way Infotech">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="img/favicon-32x32.png">
    <!-- Title Tag -->
    <title>Recruitment CRM - V Way Infotech</title>
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
    <style>
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
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .swal-button{
            background: #0070FF;
        }
        .btn-primary{
            background: #0070FF;
        }
    </style>
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form class="form" method="POST" novalidate="">
    <img class="mb-4" src="img/logo1.png" alt="V Way Infotech" width="150px">
    <h1 class="h3 mb-3 fw-normal">Recruitment HRM</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="username" placeholder="name@example.com">
      <label for="username">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="pass" placeholder="Password">
      <label for="password">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">Copyright &copy; V Way Infotech 2022</p>
    <div class="checkbox mb-3">
      <label>
        New User? <a class="ml-2" href="signup.php">Sign Up</a>
      </label>
    </div>
  </form>
</main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('body').on('click','#login',function(){
            var username=$('#username').val();
            var pass=$('#pass').val();
            $.ajax({
                url:'action.php',
                type:'post',
                dataType:'json',
                data:{
                    username:username,pass:pass,
                },
                success:function(msg){
                    
                }
            })
        });
        setTimeout(function(){
            swal({
                icon:"success",
            });
        },500);
    </script>
  </body>
</html>
