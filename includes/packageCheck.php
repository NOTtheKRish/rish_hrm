<?php
    include('dbconfig.php');
    $sq="SELECT package,package_expiry FROM accounts WHERE id='".$_SESSION['userRel']."'";
    $re=mysqli_query($conn,$sq);
    while($ro=mysqli_fetch_array($re)){
        $package=$ro['package'];
        $packageExp=$ro['package_expiry'];
    }
    $time=date_default_timezone_set('Asia/Kolkata');
    $today=date('Y-m-d H:i:s');
    if($today>=$packageExp || $packageExp==NULL){
        //Subscription Expired
        echo '<script type="text/javascript">
        setTimeout(function(){
                swal({
                    icon:"error",
                    title:"Oops!",
                    text:"Looks like your Subscription has expired!",
                    buttons:"Close",
                    closeOnClickOutside:false,
                    closeOnEsc:false,
                }).then(function(){
                    window.location="package.php";
                    });
            },500);
            </script>';
    }else{
        echo '';
    }
?>