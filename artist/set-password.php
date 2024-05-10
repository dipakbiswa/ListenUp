<?php

session_start();


$true = false;

include '../dbcon.php';


if (isset($_GET['email']) && isset($_GET['token'])) {

  $email = $_GET['email'];
  $token = $_GET['token'];

  date_default_timezone_get();
  $date = date("Y-m-d");

  $query = "select * from user where email='$email' and reset_token='$token' and token_expire='$date'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {
    if (mysqli_num_rows($query_run) == 1) {
      $true = true;
    }
  } else {
    $set_password_status = "Link Expired!";
  }
}

if (isset($_POST['set_password'])) {

  $password = $_POST['new_password'];
  $cpassword = $_POST['new_cpassword'];
  $email = $_POST['email'];

  //Password Encripting
  $hash_password = password_hash($password, PASSWORD_BCRYPT);

  if ($password === $cpassword) {

    $update_password = "update user SET password='$hash_password', reset_token='NULL',token_expire='NULL' WHERE email= '$email'";
    $update_password_run = mysqli_query($conn, $update_password);

    if ($update_password_run) {
      $set_password_status = "Password Updated! <a href='http://localhost/audiobook2/artist/login.php'> Login Now</a>";
    }
  } else {
    $set_password_status = "Passwords not matched!";
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


  <title>Set Password</title>
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
          <strong>Set Password</strong>
        </h3>

      </div>
      <div class="row justify-content-center mt-4">
        <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
          <?php
          if ($true) { ?>
            <form action="#" method="post" class="mbr-form form-with-styler mx-auto">
              <div class="dragArea row">
                <h5 style="color:red;">
                  <?php
                  if (isset($set_password_status)) {
                    echo $set_password_status;
                  }
                  ?>
                </h5>
                <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="name">
                  <input type="password" name="new_password" placeholder="Password" class="form-control" id="name-form7-d"
                    required>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="name">
                  <input type="password" name="new_cpassword" placeholder="Confirm Password" class="form-control"
                    id="name-form7-d" required>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="name">
                  <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" class="form-control"
                    id="name-form7-d" required>
                </div>
                <div class="col-auto mbr-section-btn align-center">
                  <button type="submit" name="set_password" class="btn btn-primary display-4">Reset Password</button>
                </div>
              </div>
            </form>
          <?php } ?>
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