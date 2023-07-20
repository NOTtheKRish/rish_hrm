<?php
    include("includes/dbconfig.php");
    if(isset($_POST['signup'])){
        $name=$_POST['name'];
        $username=$_POST['username'];
        $email=$_POST['email'];
        $number=$_POST['number'];
        $pass=password_hash($_POST['password'],PASSWORD_DEFAULT);
        date_default_timezone_set('Asia/Kolkata');
        $created_at=date("Y-m-d H:i:s");
        $packageExpiry=date("Y-m-d H:i:s",strtotime('+3 days'));
        $package="FREE TRIAL";

        $sq="SELECT max(id) FROM accounts";
        $re=mysqli_query($conn,$sq);
        while($ro=mysqli_fetch_array($re)){
        $id=($ro['max(id)'])+1;
        }
        $role=1;//admin

        //creating an admin user in accounts table
        $sql="INSERT INTO accounts(id,role,userRelation,username,name,password,email,package,package_expiry,created_at) 
        VALUES ('".$id."','".$role."','".$id."','".$username."','".$name."','".$pass."','".$email."','".$package."','".$packageExpiry."','".$created_at."')";
        $res=mysqli_query($conn,$sql);
        //creating entry in settings table
        $sql="INSERT INTO settings(id,name,email,number,entry_by,user_id) VALUES ('".$id."','".$name."','".$email."','".$number."','".$id."','".$id."')";
        $res=mysqli_query($conn,$sql);

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