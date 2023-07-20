<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*ini_set('session.gc_maxlifetime',64800);
session_set_cookie_params(64800); //64800
    $newid = session_create_id('vwi-');
    session_id($newid);
    session_start();
    include_once('includes/dbconfig.php');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
// include('includes/header.php');
// Login Form Submitted...
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $conn->prepare('SELECT username,id,role,userRelation,password FROM accounts WHERE username = ?')){
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
    if ($stmt->num_rows > 0){
        $stmt->bind_result($username,$id,$role,$userRel,$password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if(password_verify($_POST['password'], $password)){
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin']=TRUE;
            $_SESSION['name']=$_POST['username'];
            $_SESSION['id']=$role;//User's Role
            $_SESSION['userId']=$id;//User's ID
            $_SESSION['userRel']=$userRel;//Logged In User's Relation ID
            $_SESSION['start']=time();
            $_SESSION['expire']=$_SESSION['start']+(10*60);

            // creating remember token
            $rToken=generateRandomString();
            // updating created remember token into the logged in account
            $r=$conn->prepare("UPDATE accounts SET remember_token = ? WHERE id = ?");
            $r->bind_param('si',$rToken,$id);
            $r->execute();
            $r->close();
            // creating cookies
            setcookie('username',$username,time()+(86400*1),"/");
            setcookie('rToken',$rToken,time()+(86400*1),"/");
            setcookie('isLoggedIn',"true",time()+(86400*1),"/");
            header('Location: index.php');
        }else{
            // Status: Incorrect Password - Content
            echo'<script type="text/javascript">
                alert("Looks like your Login credentials are wrong...");
                window.location.href="login.php";
            </script>';
        }
    } else{
        // Status: Incorrect Username - Content
        echo'<script type="text/javascript">
            alert("User not Found!");
            window.location.href="login.php";
        </script>';
    }

	$stmt->close();
}*/
include "includes/dbconfig.php";

// Check if $_SESSION or $_COOKIE already set
if(isset($_SESSION['userid']) ){
  echo'<script type="text/javascript">
      window.location.href="index.php";
  </script>';
}else if( isset($_COOKIE['rememberme'] )){
  // Decrypt cookie variable value
  $userid = decryptCookie($_COOKIE['rememberme']);
  $sql_query = "select count(*) as countUser,username,id,role,userRelation,password from accounts where id='".$userid."'";
  $result = mysqli_query($conn,$sql_query);
  $row = mysqli_fetch_array($result);
  $count = $row['countUser'];
  if( $count > 0 ){
     session_name('PrintHub');
     session_start();
     // session_regenerate_id();
     $_SESSION['userid'] = $userid;
     $_SESSION['loggedin']=TRUE;
     $_SESSION['name']=$row['username'];
     $_SESSION['id']=$row['role'];//User's Role
     $_SESSION['userId']=$row['id'];//User's ID
     $_SESSION['userRel']=$row['userRelation'];//Logged In User's Relation ID
     $_SESSION['start']=time();
     $_SESSION['expire']=$_SESSION['start']+(10*60);
     echo'<script type="text/javascript">
         window.location.href="index.php";
     </script>';
  }
}

// // Encrypt cookie
// function encryptCookie( $value ) {
//
//    $key = hex2bin(openssl_random_pseudo_bytes(4));
//
//    $cipher = "aes-256-cbc";
//    $ivlen = openssl_cipher_iv_length($cipher);
//    $iv = openssl_random_pseudo_bytes($ivlen);
//
//    $ciphertext = openssl_encrypt($value, $cipher, $key, 0, $iv);
//
//    return( base64_encode($ciphertext . '::' . $iv. '::' .$key) );
// }
//
// // Decrypt cookie
// function decryptCookie( $ciphertext ) {
//    $cipher = "aes-256-cbc";
//    list($encrypted_data, $iv,$key) = explode('::', base64_decode($ciphertext));
//    return openssl_decrypt($encrypted_data, $cipher, $key, 0, $iv);
// }

// On submit
if(isset($_POST['login_btn'])){
  $uname = mysqli_real_escape_string($conn,$_POST['username']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);

  if ($uname != "" && $password != ""){
     $sql_query = "select count(*) as countUser,username,id,role,userRelation,password from accounts where username='".$uname."'";
     $result = mysqli_query($conn,$sql_query);
     $row = mysqli_fetch_array($result);

     $count = $row['countUser'];
     $pw=$row['password'];

     if($count > 0){
         if(password_verify($password, $pw)){
            $userid = $row['id'];
            if(isset($_POST['rememberme'])){

               // Set cookie variables
               $days = 1;
               // $value = encryptCookie($userid);
               $value=$userid;
               setcookie("rememberme",$value,time()+ ($days * 24 * 60 * 60 * 1),"/hrm");
               session_name('VWay');
               session_start();
               $_SESSION['userid'] = $userid;
               $_SESSION['loggedin']=TRUE;
               $_SESSION['name']=$row['username'];
               $_SESSION['id']=$row['role'];//User's Role
               $_SESSION['userId']=$row['id'];//User's ID
               $_SESSION['userRel']=$row['userRelation'];//Logged In User's Relation ID
               $_SESSION['start']=time();
               $_SESSION['expire']=$_SESSION['start']+(1 * 24 * 60 * 60 * 1);
           }else{
                session_name('VWay');
                session_start();
                $_SESSION['userid'] = $userid;
                $_SESSION['loggedin']=TRUE;
                $_SESSION['name']=$row['username'];
                $_SESSION['id']=$row['role'];//User's Role
                $_SESSION['userId']=$row['id'];//User's ID
                $_SESSION['userRel']=$row['userRelation'];//Logged In User's Relation ID
                $_SESSION['start']=time();
                $_SESSION['expire']=$_SESSION['start']+(1 * 24 * 60 * 60 * 1);
            }
            echo'<script type="text/javascript">
                window.location.href="index.php";
            </script>';
        }else{
            echo'<script type="text/javascript">
                alert("Invalid Password!");
            </script>';
            echo'<script type="text/javascript">
                window.location.href="login.php";
            </script>';
        }
     } else{
         echo'<script type="text/javascript">
             alert("Invalid Username and Password!");
         </script>';
        echo'<script type="text/javascript">
            window.location.href="login.php";
        </script>';
     }

  }

}
?>
