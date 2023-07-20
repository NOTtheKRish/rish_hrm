<?php
include('includes/header.php');
include_once("includes/dbconfig.php");
?>
<div class="container-fluid bg-primary">
    <div class="col-md-8 mx-auto" style="margin-top:240px;margin-bottom:252px;">
        <div class="card mt-4">
            <h5 class="card-header"><strong>V Way - Candidate Registration Form</strong></h5>

            <?php
                if (isset($_POST["create"])){
                        $can_name=$_POST['name'];
                        $jobrole=$_POST['jobrole'];
                        $file=$_FILES['resume'];
                        $fileName=$_FILES['resume']['name'];
                        $fileTmpName=$_FILES['resume']['tmp_name'];
                        $fileError=$_FILES['resume']['error'];
                        $fileType=$_FILES['resume']['type'];

                        $fileExt=explode('.',$fileName);
                        $fileActualExt=strtolower(end($fileExt));
                        $allowed=array('jpg','jpeg','png','pdf','docx','doc');

                        if(in_array($fileActualExt,$allowed)){
                            if($fileError==0){
                                    $fileNameNew=$can_name."-".$jobrole.".".$fileActualExt;
                                    $fileDestination='uploads/'.$fileNameNew;
                                    move_uploaded_file($fileTmpName,$fileDestination);
                            }else{
                                echo "There was an error uploading the file... Try Again!";
                            }
                        }else{
                            echo "You cannot upload this file type...";
                        }


                    // Data being Inserted into the Database
                    $sql="INSERT INTO candidates (name,number,wp_number,email,qualification,experience,jobrole,expected_job,address,location_interest,salary_current,salary_expect,gender,resume)
                    VALUES ('".$_POST['name']."','".$_POST['number']."','".$_POST['wp_number']."','".$_POST['email']."','".$_POST['qualification']."','".$_POST['experience']."','".$_POST['jobrole']."','".$_POST['expected_job']."','".$_POST['address']."','".$_POST['location_interest']."','".$_POST['salary_current']."','".$_POST['salary_expect']."','".$_POST['gender']."','".$fileNameNew."')";
                    $result=mysqli_query($conn,$sql);
                }
            ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 text-center">
                        <h3>Registration Successful!</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include('includes/scripts.php');
?>