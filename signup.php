<?php

session_start();

//includeing phpMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


include 'dbcon.php';

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
    $tbl_corordinator_query = "select * from tbl_corordinator where user_id = '$user_id' and user_type_id = 1";
    $tbl_corordinator_row = mysqli_num_rows(mysqli_query($conn, $tbl_corordinator_query));
    if ($tbl_corordinator_row == 1) {
      $status = "Email Already Registed";
    } else {
      if ($password === $cpassword) {
        //Password Encripting
        $hash_password = password_hash($password, PASSWORD_BCRYPT);
        $tbl_corordinator_insert_query = "insert INTO `tbl_corordinator`(`user_id`, `user_type_id`) VALUES ('$user_id','1')";
        $tbl_corordinator_insert_query_run = mysqli_query($conn, $tbl_corordinator_insert_query);
        if ($tbl_corordinator_insert_query_run) {
          $status = "Account Created Successfully also password is updated!";
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
      $tbl_corordinator_insert_query = "insert INTO `tbl_corordinator`(`user_id`, `user_type_id`) VALUES ('$user_id','1')";
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
            <h3>Please confirm your email address</h3>
            <img src='https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjCEHbKhJx6AAtoNIZDQLaJh_YRF0PVaPRzCv5LgH_vmrLZWWK943QBpOWLnHsny-b5sM-a2_GX5PAZdyz-D6nV0fY2nSIvgOUoHWvpn-3WgXpztQ5NnfKEwzk1N883QMBBBAyHPWsTM3pItdmqC2y4GOZ4sFd6POj-U_kog_nyZc3B9rSx0wCLSAYo5HbC/s320/logo.png' width='150px' height='150px'>
            <p><b>Thanks for for registration $name!</b></p>
            <p>To finish signing up, please confirm your email address. This ensures we have the right email in case we need to contact you.</p>
            <a href='http://localhost/audiobook2/verify.php?email=$email&verification_code=$verification_code' style='background-color: #4CAF50;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                border-radius:10px;
                display: inline-block;
                font-size: 16px;'>Confirm email address</a>
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
  <title>Sign Up | ListenUp</title>

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
        <div class="docs-top-utilities d-flex justify-content-end align-items-center">
        </div><!--//container-->
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
                    <span class="card-title-text">Sign Up</span>
                    <hr>
                    <h5 style="color: red;">
                      <?php
                      if (isset($status)) {
                        echo $status;
                      }
                      ?>
                    </h5>
                  </h5>
                </center>
                <form action="#" method="post">
                  <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                  </div>
                  <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                  </div>
                  <div class="mb-3">
                    <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                  </div>
                  <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                  </div>
                  <div class="mb-3">
                    <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password"
                      required>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                    <label class="form-check-label" for="flexCheckDefault">
                      agree to our Terms of Use and Privacy Policy.
                    </label>
                  </div>
                  <br>
                  <div class="mb-3">
                    <button type="submit" name="signup" class="btn btn-primary" style="width: 100%;">Sign Up</button>
                  </div>
                </form>
                <center>
                  <p>Already have an account? <a href="login.php">Login Here!</a></p>
                </center>
              </div><!--//card-body-->
            </div><!--//card-->
          </div><!--//col-->










        </div><!--//row-->
      </div><!--//container-->
    </div><!--//container-->
  </div>

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