<?php
session_start();

include 'dbcon.php';

if (isset($_GET['email']) && $_GET['verification_code']) {

  $email = $_GET['email'];
  $verification_code = $_GET['verification_code'];


  $query_for_verify = "select * from user where email='$email' and verification_code='$verification_code'";
  $query_query_for_verify_run = mysqli_query($conn, $query_for_verify);

  $fetch_data = mysqli_fetch_assoc($query_query_for_verify_run);
  $is_verify = $fetch_data['is_verified'];

  if ($is_verify == 0) {

    $verify_query = "update user SET is_verified = 1 WHERE email = '$email'";
    $verify_query_run = mysqli_query($conn, $verify_query);

    if ($verify_query_run) {
      $verify_status = "Your Account verified please <a href='http://localhost/audiobook2/login.php'>login</a>";
    }

  } else {
    $verify_status = "Your Account is already verified please <a href='http://localhost/audiobook2/login.php'>login</a>";
  }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Verify | Listen Books</title>

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
                    <span class="card-title-text">Verify Your Account</span>
                    <hr>
                    <h3 class="auth-heading text-center mb-5" style="color:red;">
                      <?php
                      if (isset($verify_status)) {
                        echo $verify_status;
                      }
                      ?>
                    </h3>
                  </h5>
                </center>
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