<?php
include('session.php');
include('includes/header.php');
include('includes/navbar.php');
include_once("includes/dbconfig.php");
include('vendor/PHPMailer/src/Exception.php');
include('vendor/PHPMailer/src/PHPMailer.php');
include('vendor/PHPMailer/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <?php
                        include('includes/topbar.php');
                        include('includes/topbar-menu.php');
                    ?>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-2 text-gray-800">V Way Mailer</h1>
                    </div>

                    <!-- All Contents of the page starts from here-->
                    <div class="card mb-4"><!-- Main Card Start -->
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                            <h5 class="m-0 font-weight-bold text-primary">Send a Mail</h5>
                            <a class="d-none d-sm-inline-block btn btn-circle btn-danger" id="closeBtn" href="index.php">
                                <i class="fas fa-times pt-1"></i>
                            </a>
                    </div>
                    <?php
                        $email="";
                        if(isset($_GET['email'])){
                            $email=$_GET['email'];
                        }
                        if(isset($_POST['send'])){

                            $sq="SELECT name,email FROM accounts WHERE id='".$_SESSION['userRel']."'";
                            $res=mysqli_query($conn,$sq);
                            while($c=mysqli_fetch_assoc($res)){
                                $comMail=$c['email'];
                                $comName=$c['name'];
                            }
                            $to=$_POST['to_email'];
                            if($_POST['cc']==""){
                                $cc=null;
                            }elseif($_POST['cc']!=""){
                                $cc=$_POST['cc'];
                            }
                            if($_POST['bcc']==""){
                                $bcc=null;
                            }elseif($_POST['bcc']!=""){
                                $bcc=$_POST['bcc'];
                            }
                            $subject=$_POST['subject'];
                            $message=$_POST['message'];
                            //Create an instance; passing `true` enables exceptions
                            $mail = new PHPMailer(true);
                            
                            try {
                                //Server settings
                                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                                $mail->isSMTP();                                            //Send using SMTP
                                $mail->Host       = 'vwayinfotech.in';                     //Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                $mail->Username   = 'support@vwayinfotech.in';                     //SMTP username
                                $mail->Password   = 'Q8z(xuDb$uM0';                               //SMTP password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                            
                                //Recipients
                                $mail->setFrom('support@vwayinfotech.in', 'V Way Infotech');
                                // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
                                $mail->addAddress($to);               //Name is optional
                                $mail->addReplyTo($comMail,$comName);
                                if($cc==null){
                                    echo '';
                                }else{
                                    $mail->addCC($cc);
                                }
                                if($bcc==null){
                                    echo '';
                                }else{
                                    $mail->addBCC($bcc);
                                }
                            
                                //Attachments
                                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                            
                                //Content
                                $mail->isHTML(true);                                  //Set email format to HTML
                                $mail->Subject = $subject;
                                $mail->Body    = $message;
                            
                                $mail->send();
                                echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon: "success",
                                                    title: "Success!",
                                                    text: "Mail Sent Successfully!",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                            } catch (Exception $e) {
                                echo '<script type="text/javascript">
                                            setTimeout(function(){
                                                swal({
                                                    icon: "success",
                                                    title: "Success!",
                                                    text: "Mail could not be sent. Mailer Error : '.$mail->ErrorInfo.'",
                                                    button: "Close",
                                                });
                                            },500);
                                        </script>';
                            }
                        }
                    ?>
                        <div class="card-body">
                            <div class="card shadow">
                                <div class="card-body p-5">
                                    <form class="form" action="" method="POST">
                                        <div class="form-group row">
                                            <label for="to_email" class="col-sm-2 col-form-label">To</label>
                                            <div class="col-sm-4">
                                                <?php echo'<input type="text" class="form-control" name="to_email" value="'.$email.'">';?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="cc" class="col-sm-2 col-form-label">CC</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="cc">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bcc" class="col-sm-2 col-form-label">BCC</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="bcc">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="subject" class="col-sm-2 col-form-label">Subject</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" name="subject">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="message" class="col-sm-2 col-form-label">Message</label>
                                            <div class="col-sm-5">
                                                <textarea class="form-control" name="message" cols="30" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit" name="send"><i class="fas fa-paper-plane mr-2"></i>Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- Main Card End -->
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>