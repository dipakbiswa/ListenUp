<?php
session_start();
include 'dbcon.php';
if (isset($_POST['login'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];



  $email_query = "select * from user where email = '$email'";
  $email_query_run = mysqli_query($conn, $email_query);

  $email_row = mysqli_num_rows($email_query_run);



  if ($email_row == 0) {
    $login_status = "Email address not found!";

  } else {
    $result_fetch = mysqli_fetch_assoc($email_query_run);
    if (password_verify($password, $result_fetch['password'])) {

      if ($result_fetch['is_verified'] == 0) {
        $login_status = "Please Verify Your Email!";
      } else {

        $user_id = $result_fetch['id'];
        $tbl_corordinator_rows = mysqli_num_rows(mysqli_query($conn, "select * from tbl_corordinator where user_id = '$user_id' and user_type_id = 1"));

        if ($tbl_corordinator_rows == 1) {


          $_SESSION['username'] = $result_fetch['name'];
          $_SESSION['email'] = $result_fetch['email'];
          $_SESSION['phone'] = $result_fetch['phone'];
          $_SESSION['plan'] = $result_fetch['plan'];
          $_SESSION['id'] = $result_fetch['id'];



          //Cookie Set
          if (isset($_POST['remember_me'])) {
            setcookie('email', $email, time() + (60 * 60 + 24));
            setcookie('password', $password, time() + (60 * 60 + 24));
          } else { //Cookie Unset when Remember Me unset
            setcookie('email', '', time() - (60 * 60 + 24));
            setcookie('password', '', time() - (60 * 60 + 24));
          }


          //Checking that premiume plan is expired or not
          $_SESSION['plan_expired'] = 0;
          if ($result_fetch['plan'] == 1 or $result_fetch['plan'] == 2) {
            $today = date("d-m-Y");
            $plan_expiration = date("d-m-Y", strtotime($result_fetch['plan_expire']));
            $dateDiff = strtotime($plan_expiration) - strtotime($today);
            $Daysleft = floor($dateDiff / (60 * 60 * 24));
            if ($Daysleft <= 0) {
              $plan_update_query = "update user set plan = 0, plan_expire = 'NULL' where email = '$email'";
              $plan_update_query_run = mysqli_query($conn, $plan_update_query);
              if ($plan_update_query_run) {
                $_SESSION['plan_expired'] = 1;
              }
            }
          }

          //After updating the plan data we need to fetch plan data
          $fetch_plan_query = "select plan from user where email = '$email'";
          $fetch_plan_query_run = mysqli_query($conn, $fetch_plan_query);
          $fetch_plan = mysqli_fetch_assoc($fetch_plan_query_run);
          $_SESSION['plan'] = $fetch_plan['plan'];

          //Redirecting to Dashboard Onece Login
          header('location: dashboard.php');

        } else {
          $login_status = "You are not a listener!";
        }
      }
    } else {
      $login_status = "Password Incorrect!";
    }

  }


}

//Cookie Fetch
if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
  $cookie_email = $_COOKIE['email'];
  $cookie_password = $_COOKIE['password'];
}
else{
  $cookie_email = "";
  $cookie_password = "";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login | ListenUp</title>

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

          <!--<a href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/coderdocs-free-bootstrap-5-documentation-template-for-software-projects/" class="btn btn-primary d-none d-lg-flex">Download</a>
              </div>//docs-top-utilities-->


        </div><!--//container-->
      </div><!--//branding-->
  </header><!--//header-->


  <!--<div class="page-header theme-bg-dark py-5 text-center position-relative">
      <div class="theme-bg-shapes-right"></div>
      <div class="theme-bg-shapes-left"></div>
      <div class="container">
        <h1 class="page-heading single-col-max mx-auto">Search</h1>
        <div class="page-intro single-col-max mx-auto">Search Best Audiobooks.</div>
        <div class="main-search-box pt-3 d-block mx-auto">
                 <form class="search-form w-100">
                <input type="text" placeholder="Search the docs..." name="search" class="form-control search-input">
                <button type="submit" class="btn search-btn" value="Search"><i class="fas fa-search"></i></button>
            </form>
             </div>
      </div>
    </div>//page-header-->



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
                    <span class="card-title-text">Sign In</span>
                    <hr>
                    <h5 style="color: red;">
                      <?php if (isset($login_status)) {
                        echo $login_status;
                      }
                      ?>
                    </h5>
                  </h5>
                </center>
                <form action="#" method="post">
                  <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required value="<?php echo $cookie_email; ?>">
                  </div>
                  <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required value="<?php echo $cookie_password; ?>">
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember_me" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Remember Me
                    </label>
                  </div>
                  <br>
                  <div class="mb-3">
                    <button type="submit" name="login" class="btn btn-primary" style="width: 100%;">Sign In</button>
                  </div>
                </form>
                <center>
                  <p>Don't have an account? <a href="signup.php">Create Here!</a></p>
                </center>
                <center>
                  <p> <a href="forgot-password.php">Forgot Password?</a></p>
                </center>
              </div><!--//card-body-->
            </div><!--//card-->
          </div><!--//col-->










        </div><!--//row-->
      </div><!--//container-->
    </div><!--//container-->
  </div><!--//page-content-->

  <!--<section class="cta-section text-center py-5 theme-bg-dark position-relative">
      <div class="theme-bg-shapes-right"></div>
      <div class="theme-bg-shapes-left"></div>
      <div class="container">
        <h3 class="mb-2 text-white mb-3">Launch Your Software Project Like A Pro</h3>
        <div class="section-intro text-white mb-3 single-col-max mx-auto">Want to launch your software project and start getting traction from your target users? Check out our premium <a class="text-white" href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/coderpro-bootstrap-5-startup-template-for-software-projects/">Bootstrap 5 startup template CoderPro</a>! It has everything you need to promote your product.</div>
        <div class="pt-3 text-center">
          <a class="btn btn-light" href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/coderpro-bootstrap-5-startup-template-for-software-projects/">Get CoderPro<i class="fas fa-arrow-alt-circle-right ml-2"></i></a>
        </div>
      </div>
    </section>//cta-section-->

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