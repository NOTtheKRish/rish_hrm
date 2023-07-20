<?php
    $data = [
    'payment_id' => $_POST['razorpay_payment_id'],
    'amount' => $_POST['totalAmount'],
    'package_id' => $_POST['package_id'],
    'user' => $_POST['user'],
    ];
    // you can write your database insertation code here
    $packageId=$_POST['package_id'];
    /* Package Plans and their Reference IDs
    1 => Basic (MONTHLY)
    2 => Smart (MONTHLY)
    3 => Exclusive (MONTHLY)
    4 => Basic (YEARLY)
    5 => Smart (YEARLY)
    6 => Exclusive (YEARLY)
    */
    include('includes/dbconfig.php');
    $user=$_POST['user'];
    date_default_timezone_set('Asia/Kolkata');
    $TODAY=date("Y-m-d H:i:s");
    if($packageId==1){
        $package="BASIC (MONTHLY)";
        $packageExpiry=date("Y-m-d H:i:s",strtotime('+30 days'));
        $sq="UPDATE accounts SET package='".$package."',package_expiry='".$packageExpiry."' WHERE id='".$user."'";
    }else if($packageId==2){
        $package="SMART (MONTHLY)";
        $packageExpiry=date("Y-m-d H:i:s",strtotime('+30 days'));
        $sq="UPDATE accounts SET package='".$package."',package_expiry='".$packageExpiry."' WHERE id='".$user."'";
    }else if($packageId==3){
        $package="EXCLUSIVE (MONTHLY)";
        $packageExpiry=date("Y-m-d H:i:s",strtotime('+30 days'));
        $sq="UPDATE accounts SET package='".$package."',package_expiry='".$packageExpiry."' WHERE id='".$user."'";
    }else if($packageId==4){
        $package="BASIC (YEARLY)";
        $packageExpiry=date("Y-m-d H:i:s",strtotime('+365 days'));
        $sq="UPDATE accounts SET package='".$package."',package_expiry='".$packageExpiry."' WHERE id='".$user."'";
    }else if($packageId==5){
        $package="SMART (YEARLY)";
        $packageExpiry=date("Y-m-d H:i:s",strtotime('+365 days'));
        $sq="UPDATE accounts SET package='".$package."',package_expiry='".$packageExpiry."' WHERE id='".$user."'";
    }else if($packageId==6){
        $package="EXCLUSIVE (YEARLY)";
        $packageExpiry=date("Y-m-d H:i:s",strtotime('+365 days'));
        $sq="UPDATE accounts SET package='".$package."',package_expiry='".$packageExpiry."' WHERE id='".$user."'";
    }
    $res=mysqli_query($conn,$sq);
    // after successfully insert transaction in database, pass the response accordingly
    $arr = array('msg' => 'Payment successfully credited', 'status' => true);  
    echo json_encode($arr);
?>