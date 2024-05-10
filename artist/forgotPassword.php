<?php

session_start();

//includeing phpMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../dbcon.php';

if (isset($_POST['reset-password'])) {
  $email = $_POST['reg-email'];

  $check_account_registed_or_not = "select * from user where email='$email'";
  $check_account_registed_or_not_run = mysqli_query($conn, $check_account_registed_or_not);

  $fetch_name = mysqli_fetch_assoc($check_account_registed_or_not_run);

  $check_account_row_no = mysqli_num_rows($check_account_registed_or_not_run);

  if ($check_account_row_no == 1) {

    $reset_token = bin2hex(random_bytes(16));
    date_default_timezone_get();
    $date = date("Y-m-d");

    $update_query = "update user SET reset_token='$reset_token', token_expire ='$date' WHERE email = '$email'";
    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run && sendMail($email, $fetch_name['name'], $reset_token)) {
      $reset_password_status = "Please check your email to set new password!";
    }
  } else {
    $reset_password_status = "Email not found! Please <a href='http://localhost/audiobook2/artist/signup.php'>Sign Up</a>";
  }
}


//Send mail function
function sendMail($email, $name, $reset_token)
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
    $mail->Subject = 'Reset Password For ListenUp Account';
    $mail->Body = "Hello $name,<br> Thanks for being a member! <br> 
                  We got a request from you to reset your password!<br>
                  Click the link below:<br>
                  <a href='http://localhost/audiobook2/artist/set-password.php?email=$email&token=$reset_token'>Reset Password</a><br>
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


  <title>Login</title>
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

  <section data-bs-version="5.1" class="form7 cid-tB8hNVbMgf" id="form7-d">


    <div class="container">
      <div class="mbr-section-head">
        <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
          <strong>Forgot Password</strong>
        </h3>

      </div>
      <div class="row justify-content-center mt-4">
        <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
          <form action="#" method="post" class="mbr-form form-with-styler mx-auto">
            <div class="dragArea row">
              <h5 style="color:red;">
                <?php
                if (isset($reset_password_status)) {
                  echo $reset_password_status;
                }
                ?>
              </h5>
              <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="name">
                <input type="email" name="reg-email" placeholder="Email" class="form-control" id="name-form7-d"
                  required>
              </div>

              <div class="col-auto mbr-section-btn align-center">
                <button type="submit" name="reset-password" class="btn btn-primary display-4">Reset Password</button>
              </div>
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