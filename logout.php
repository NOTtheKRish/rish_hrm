<?php
// session_name("RishHRM");
// session_start();
session_unset();
session_destroy();
// Remove cookie variables
$days = 1;
setcookie("rememberme","", time() - ($days * 24 * 60 * 60 * 100),"/");
setcookie("RishHRM","", time() - ($days * 24 * 60 * 60 * 100),"/");
// Redirect to the login page:
header('Location: login.php');
?>
