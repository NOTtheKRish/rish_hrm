<?php
    include_once("includes/dbconfig.php");
    $response = [];
    $uname = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['pass']);
  
        if ($uname != "" && $password != ""){
           $sql_query = "SELECT username,id,role,userRelation,password FROM accounts WHERE username='".$uname."'";
           $result = mysqli_query($conn,$sql_query);
           $result_num = mysqli_num_rows($result);
           if($result_num != 0){
                // account exists
                while($row = mysqli_fetch_array($result)){
                   $pw = $row['password'];
                   if(password_verify($password, $pw)){
                      $userid = $row['id'];
                      if(isset($_POST['rememberme'])){
                         // Set cookie variables
                         $days = 1;
                         $value = $userid;
                         setcookie("rememberme",$value,time()+ ($days * 24 * 60 * 60 * 100),"/");
                         session_name('RishHRM');
                         session_start();
                         $_SESSION['userid'] = $userid;
                         $_SESSION['loggedin'] = TRUE;
                         $_SESSION['name'] = $row['username'];
                         $_SESSION['id'] = $row['role']; // User's Role
                         $_SESSION['userId'] = $row['id']; // User's ID
                         $_SESSION['userRel'] = $row['userRelation']; // Logged In User's Relation ID
                         $_SESSION['start'] = time();
                         $_SESSION['expire'] = $_SESSION['start']+(1 * 24 * 60 * 60 * 100);
                     }else{
                          session_name('RishHRM');
                          session_start();
                          $_SESSION['userid'] = $userid;
                          $_SESSION['loggedin'] = TRUE;
                          $_SESSION['name'] = $row['username'];
                          $_SESSION['id'] = $row['role']; // User's Role
                          $_SESSION['userId'] = $row['id']; // User's ID
                          $_SESSION['userRel'] = $row['userRelation']; // Logged In User's Relation ID
                          $_SESSION['start'] = time();
                          $_SESSION['expire'] = $_SESSION['start']+(1 * 24 * 60 * 60 * 100);
                      }
                      $response = [
                            'status' => "success",
                            'message' => "Authentication Successful!",
                        ];
                  }else{
                    $response = [
                        'status' => "error",
                        'message' => "Invalid Password",
                    ];
                  }
              }
           }else{
            // account doesn't exists
                $response = [
                    'status' => "error",
                    'message' => "Account does not exists!",
                ];
           }
        }

        echo json_encode($response);
?>