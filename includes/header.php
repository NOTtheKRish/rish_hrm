<!DOCTYPE html>
<html lang="en">
<?php
    include_once('includes/dbconfig.php');
    if(!isset($_SESSION['userRel'])){
        $sql="SELECT * FROM settings WHERE entry_by='1'";
    }elseif(isset($_SESSION['userRel'])){
        $sql="SELECT * FROM settings WHERE entry_by='".$_SESSION['userRel']."'";
    }
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result)){
?>
<head>
    <!-- Important Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Rishigesan G">
    <!-- Favicon -->
    <?php echo'<link rel="icon" type="image/png" href="img/'.$row['favicon'].'">';?>
    <!-- Title Tag -->
    <?php echo'<title>'.$row['name'].'</title>';?>
    <?php }?>
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">