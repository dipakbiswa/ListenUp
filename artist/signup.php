<?php

session_start();

//includeing phpMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


include '../dbcon.php';

if (isset($_POST['signup'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $email_query = "select * from user where email = '$email'";
    $email_query_run = mysqli_query($conn, $email_query);

    $email_row = mysqli_num_rows($email_query_run);

    if ($email_row > 0) {
        $fetch_data = mysqli_fetch_assoc($email_query_run);
        $user_id = $fetch_data["id"];
        $tbl_corordinator_query = "select * from tbl_corordinator where user_id = '$user_id' and user_type_id = 2";
        $tbl_corordinator_row = mysqli_num_rows(mysqli_query($conn, $tbl_corordinator_query));
        if ($tbl_corordinator_row == 1) {
            $status = "Email Already Registed";
        } else {
            if ($password === $cpassword) {
                //Password Encripting
                $hash_password = password_hash($password, PASSWORD_BCRYPT);
                $tbl_corordinator_insert_query = "insert INTO `tbl_corordinator`(`user_id`, `user_type_id`) VALUES ('$user_id','2')";
                $tbl_corordinator_insert_query_run = mysqli_query($conn, $tbl_corordinator_insert_query);
                if ($tbl_corordinator_insert_query_run) {
                    $status = "Account Created Successfully! You are also a listener. Your password is updated to this new password for both accounts.";
                }
            } else {
                $status = "Passwords are not matched!";
            }
        }

    } else {
        if ($password === $cpassword) {

            //Verification Code Generate
            $verification_code = bin2hex(random_bytes(16));

            //Password Encripting
            $hash_password = password_hash($password, PASSWORD_BCRYPT);


            $insert_query = "insert into user(name, email, phone, password, verification_code, is_verified) values('$name', '$email', '$phone', '$hash_password', '$verification_code','0')";
            $insert_query_run = mysqli_query($conn, $insert_query);
            $fetch_current_data = mysqli_fetch_assoc(mysqli_query($conn, "select * from user where email = '$email'"));
            $user_id = $fetch_current_data['id'];
            $tbl_corordinator_insert_query = "insert INTO `tbl_corordinator`(`user_id`, `user_type_id`) VALUES ('$user_id','2')";
            $tbl_corordinator_insert_query_run = mysqli_query($conn, $tbl_corordinator_insert_query);
      
            if ($insert_query_run && $tbl_corordinator_insert_query_run && sendMail($email, $name, $verification_code)) {
                $status = "Account Created Successfully! Please check your email and verify your account!";
            }
        } else {
            $status = "Passwords are not matched!";
        }
    }
}



function sendMail($email, $name, $verification_code)
{
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    require 'PHPMailer/Exception.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.hostinger.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'inbox@toolify.online'; //SMTP username
        $mail->Password = 'ddDD96147420##'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('inbox@toolify.online', 'ListenUp');
        $mail->addAddress($email, $name); //Add a recipient


        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Email Verification From ListenUp';
        $mail->Body = "Hello $name,<br> Thanks for registration! <br> 
                  <a href='http://localhost/audiobook2/artist/verify.php?email=$email&verification_code=$verification_code'>Click Here</a> to verify you Account.<br>
                  Thank You";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v5.8.4, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <meta name="description" content="">


    <title>Signup</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,700;1,400;1,700&display=swap&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,700;1,400;1,700&display=swap&display=swap">
    </noscript>
    <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">

</head>

<body>

<?php include 'logoutNav.php'; ?>

    <section data-bs-version="5.1" class="form7 cid-tB8i15PcFh" id="form7-f">


        <div class="container">
            <div class="mbr-section-head">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                    <strong>Sign Up to artist account</strong>
                </h3>
            </div>
            <div class="row justify-content-center mt-4">
                <center>
                    <p>
                        <?php if (isset($status)) {
                            echo $status;
                        } ?>
                    </p>
                </center>
                <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                    <form action="#" method="post" class="mbr-form form-with-styler mx-auto">

                        <div class="dragArea row">
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="name">
                                <input type="text" name="name" placeholder="Name" data-form-field="name"
                                    class="form-control" value="" id="name-form7-f">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="email">
                                <input type="email" name="email" placeholder="Email" data-form-field="email"
                                    class="form-control" value="" id="email-form7-f">
                            </div>
                            <div data-for="phone" class="col-lg-12 col-md-12 col-sm-12 form-group mb-3">
                                <input type="tel" name="phone" placeholder="Phone" data-form-field="phone"
                                    class="form-control" value="" id="phone-form7-f">
                            </div>
                            <div data-for="password" class="col-lg-12 col-md-12 col-sm-12 form-group mb-3">
                                <input type="password" name="password" placeholder="Password" data-form-field="password"
                                    class="form-control" value="" id="password-form7-f">
                            </div>
                            <div data-for="cpassword" class="col-lg-12 col-md-12 col-sm-12 form-group mb-3">
                                <input type="password" name="cpassword" placeholder="Confirm Password"
                                    data-form-field="cpassword" class="form-control" value="" id="cpassword-form7-f">
                            </div>
                            <div class="col-auto mbr-section-btn align-center">
                                <button type="submit" name="signup" class="btn btn-primary display-4">Sign Up</button>
                            </div>
                            <br><br><br>
                            <center>
                                <p>Already have an account? <a href="login.php">Login Here</a></p>
                            </center>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/smoothscroll/smooth-scroll.js"></script>
    <script src="assets/ytplayer/index.js"></script>
    <script src="assets/dropdown/js/navbar-dropdown.js"></script>
    <script src="assets/theme/js/script.js"></script>

</body>

</html>