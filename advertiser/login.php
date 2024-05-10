<?php  
  session_start();
  include '../dbcon.php';
  if (isset($_POST['login'])) {
        
        $email = $_POST['email'];
        $password = $_POST['password'];



        $email_query = "select * from user where email = '$email'";
        $email_query_run = mysqli_query($conn, $email_query);

        $email_row = mysqli_num_rows($email_query_run);



        if ($email_row == 0) {
            $login_status = "Email address not found!";  
        }
        else{
            $result_fetch = mysqli_fetch_assoc($email_query_run);
            if (password_verify($password, $result_fetch['password'])) {
              
                if ($result_fetch['is_verified'] == 0) {
                    $login_status = "Please Verify Your Email!";
                  }
                  else{
                    
                    $user_id = $result_fetch['id'];
                    $tbl_corordinator_rows = mysqli_num_rows(mysqli_query($conn, "select * from tbl_corordinator where user_id = '$user_id' and user_type_id = 3"));

                    
                      if ($tbl_corordinator_rows == 1) {
                        

                        $_SESSION['brand_username'] = $result_fetch['name'];
                        $_SESSION['brand_email'] = $result_fetch['email'];
                        $_SESSION['brand_phone'] = $result_fetch['phone'];
                        $_SESSION['brand_id'] = $result_fetch['id'];
                        


                        //Cookie Set
                        if (isset($_POST['remember_me'])) {
                          setcookie('email', $email, time() + (60*60+24) );
                          setcookie('password', $password, time() + (60*60+24) );
                        }
                        else{  //Cookie Unset when Remember Me unset
                          setcookie('email', '', time() - (60*60+24) );
                          setcookie('password', '', time() - (60*60+24) );
                        }


                        
                        
                        //Redirecting to Dashboard Onece Login
                        header('location: index.php');

                    }
                    else{
                      $login_status = "You are not an advertiser!";
                    }
                }
            }
            else{
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
<html  >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.8.4, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta name="description" content="">
  
  
  <title>Login | Advertiser</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,700;1,400;1,700&display=swap&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,700;1,400;1,700&display=swap&display=swap"></noscript>
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">

  
  
  
</head>
<body>
  
<?php include 'logoutNav.php'; ?>

<section data-bs-version="5.1" class="form7 cid-tB8hNVbMgf" id="form7-d">
    
    
    <div class="container">
        <div class="mbr-section-head">
            <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                <strong>Login to advertiser account</strong></h3>
        </div>
        <div class="row justify-content-center mt-4">
            <center><p><?php if(isset($login_status)){ echo $login_status; } ?></p></center>
            <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                <form action="#" method="post" class="mbr-form form-with-styler mx-auto">
                    <div class="dragArea row">
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="name">
                            <input type="email" name="email" placeholder="Email" class="form-control" id="name-form7-d" required>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="email">
                            <input type="password" name="password" placeholder="Password" class="form-control" id="email-form7-d" required>
                        </div>
                        <!--<div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3">
                            <input type="checkbox" name="remember_me" class="form-control">
                        </div>-->
                        <div class="col-auto mbr-section-btn align-center">
                            <button type="submit" name="login" class="btn btn-primary display-4">Login</button>
                        </div>
                        <br><br><br>
                        <center><p><a href="forgotPassword.php">Forgot Password</a> | <a href="signup.php">Sign Up</a></p></center>
                        
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