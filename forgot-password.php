<?php

session_start();

//includeing phpMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'dbcon.php';

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
    $reset_password_status = "Email not found! Please <a href='http://localhost/audiobook2/signup.php'>Sign Up</a>";
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
    $mail->Body = "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <title>Document</title>
        <style>
            *{
                font-family: sans-serif;
            }
        </style>
    </head>
    <body>
        <center>
            <h3>Reset Password</h3>
            <img src='https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjCEHbKhJx6AAtoNIZDQLaJh_YRF0PVaPRzCv5LgH_vmrLZWWK943QBpOWLnHsny-b5sM-a2_GX5PAZdyz-D6nV0fY2nSIvgOUoHWvpn-3WgXpztQ5NnfKEwzk1N883QMBBBAyHPWsTM3pItdmqC2y4GOZ4sFd6POj-U_kog_nyZc3B9rSx0wCLSAYo5HbC/s320/logo.png' width='150px' height='150px'>
            <p><b>Hello $name, Thanks for being a member!</b></p>
            <p>Click the button ⬇️ to reset password!</p>
            <a href='http://localhost/audiobook2/set-password.php?email=$email&token=$reset_token' style='background-color: #4CAF50;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                border-radius:10px;
                display: inline-block;
                font-size: 16px;'>Reset password</a>
        </center>
    </body>
    </html>";

    $mail->send();
    return true;
  } catch (Exception $e) {
    return false;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Forgot Password | ListenUp</title>

  <!-- Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="ListenUp audiobook platfrom">
  <meta name="author" content="ListenUp">
  <link rel="shortcut icon" href="favicon.ico">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

  <!-- FontAwesome JS-->
  <script defer src="assets/fontawesome/js/all.min.js"></script>

  <!-- Theme CSS -->
  <link id="theme-style" rel="stylesheet" href="assets/css/theme.css">

  <link rel="stylesheet" type="text/css" href="css/down-nav.css">


  <style type="text/css">
    .msger-inputarea {
      display: flex;
      padding: 10px;
      border-top: var(--border);
      background: #eee;
    }

    .msger-inputarea * {
      padding: 10px;
      border: none;
      border-radius: 3px;
      font-size: 1em;
    }

    .msger-input {
      flex: 1;
      background: #ddd;
    }

    .msger-send-btn {
      margin-left: 10px;
      background: rgb(0, 196, 65);
      color: #fff;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.23s;
    }

    .msger-send-btn:hover {
      background: rgb(0, 180, 50);
    }
  </style>

</head>

<body>
  <header class="header fixed-top">
    <div class="branding docs-branding">
      <div class="container-fluid position-relative py-2">
        <div class="docs-logo-wrapper">
          <div class="site-logo"><a class="navbar-brand" href="dashboard.php"><img class="logo-icon me-2"
                src="assets/images/logo.png" style="width: 50px;" alt="logo"><span class="logo-text">Listen<span
                  class="text-alt">Up</span></span></a></div>
        </div><!--//docs-logo-wrapper-->
        <div class="docs-top-utilities d-flex justify-content-end align-items-center"></div><!--//container-->
      </div><!--//branding-->
  </header><!--//header-->



  <div class="page-content">
    <div class="container">
      <div class="docs-overview py-5">
        <div class="row justify-content-center">







          <!--Read Summery-->
          <div class="col-12 col-lg-6 py-3" id="comment-section">
            <div class="card shadow-sm">
              <div class="card-body">
                <center>
                  <h5 class="card-title mb-3">
                    <span class="card-title-text">Forgot Password</span>
                    <hr>
                    <h5 style="color:red;">
                      <?php
                      if (isset($reset_password_status)) {
                        echo $reset_password_status;
                      }
                      ?>
                    </h5>
                  </h5>
                </center>
                <form action="#" method="post">
                  <div class="mb-3">
                    <input type="email" name="reg-email" class="form-control" placeholder="Email" required>
                  </div>
                  <div class="mb-3">
                    <button type="submit" name="reset-password" class="btn btn-primary" style="width: 100%;">Reset
                      Password</button>
                  </div>
                </form>

              </div><!--//card-body-->
            </div><!--//card-->
          </div><!--//col-->










        </div><!--//row-->
      </div><!--//container-->
    </div><!--//container-->
  </div><!--//page-content-->



  <footer class="footer">

    <div class="footer-bottom text-center py-5">




    </div>

  </footer>

  <!-- Javascript -->
  <script src="assets/plugins/popper.min.js"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

  <!-- Page Specific JS -->
  <script src="assets/plugins/smoothscroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js"></script>
  <script src="assets/js/highlight-custom.js"></script>
  <script src="assets/plugins/simplelightbox/simple-lightbox.min.js"></script>
  <script src="assets/plugins/gumshoe/gumshoe.polyfills.min.js"></script>
  <script src="assets/js/docs.js"></script>


  <!--Down Nav
    <nav class="nav">
          <a href="dashboard.php" class="nav-link">
              <i class="fa fa-home"></i>
              <span class="nav-text">Dashboard</span>
          </a>

          <a href="search.php" class="nav-link">
              <i class="fa fa-search"></i>
              <span class="nav-text">Search</span>
          </a>

          <a href="premium.php" class="nav-link">
              <i class="fa fa-gem"></i>
              <span class="nav-text">Premium</span>
          </a>

          <a href="categories.php" class="nav-link">
              <i class="fa fa-align-justify"></i>
              <span class="nav-text">Category</span>
          </a>

          <a href="account.php" class="nav-link">
              <i class="fa fa-user"></i>
              <span class="nav-text">Account</span>
          </a>
    </nav>-->
</body>

</html>