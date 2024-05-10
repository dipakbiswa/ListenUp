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

  } else {
    $result_fetch = mysqli_fetch_assoc($email_query_run);
    if (password_verify($password, $result_fetch['password'])) {

      if ($result_fetch['is_verified'] == 0) {
        $login_status = "Please Verify Your Email!";
      } else {

        $user_id = $result_fetch['id'];
        $tbl_corordinator_rows = mysqli_num_rows(mysqli_query($conn, "select * from tbl_corordinator where user_id = '$user_id' and user_type_id = 4"));

        if ($tbl_corordinator_rows == 1) {


          $_SESSION['username'] = $result_fetch['name'];
          $_SESSION['email'] = $result_fetch['email'];
          $_SESSION['phone'] = $result_fetch['phone'];
          $_SESSION['plan'] = $result_fetch['plan'];
          $_SESSION['id'] = $result_fetch['id'];


          //Fetcing Data
          $_SESSION['users'] = mysqli_num_rows(mysqli_query($conn, "select * from user")); //Total uses
		  $_SESSION['audiobooks'] = mysqli_num_rows(mysqli_query($conn, "select * from audiobook")); //Total audiobooks
		  $_SESSION['category'] = mysqli_num_rows(mysqli_query($conn, "select * from category")); //Total categorys
		  $_SESSION['ads'] = mysqli_num_rows(mysqli_query($conn, "select * from ads")); //Total ads
		  $_SESSION['notification'] = mysqli_num_rows(mysqli_query($conn, "select * from notification")); //Total notifications
		  $_SESSION['play'] = mysqli_num_rows(mysqli_query($conn, "select * from play")); //Total plays
		  
		  $res = mysqli_query($conn,'select sum(amount) FROM payment');
		  $row = mysqli_fetch_row($res);
		  $sum = $row[0];
		$_SESSION['earnings_from_subscription'] = $sum; //Total earnings from subscription

			$ads_res = mysqli_query($conn,'select sum(clicks) FROM ads');
			$ads_row = mysqli_fetch_row($ads_res);
			$clicks_sum = $ads_row[0];
			$_SESSION['total_ads_clicks'] = $clicks_sum; //Total ads click

          //Redirecting to Dashboard Onece Login
          header('location: dashboard.php');

        } else {
          $login_status = "You are not a admin!";
        }
      }
    } else {
      $login_status = "Password Incorrect!";
    }

  }


}

?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Admin Login</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="app-logo.png"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head> 

<body class="app app-login p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.php"><img class="logo-icon me-2" src="assets/images/app-logo.png" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Log in to Admin Portal</h2>
					<?php  

						if (isset($login_status)) {
							?>
								<h3 class="auth-heading text-center mb-5" style="color:red;"><?php echo $login_status; ?></h3>
							<?php
						}

					?>
			        <div class="auth-form-container text-start">
						<form class="auth-form login-form" action="login.php" method="POST">         
							<div class="email mb-3">
								<label class="sr-only" for="signin-email">Email</label>
								<input id="signin-email" name="email" type="email" class="form-control signin-email" placeholder="Email address" required="required">
							</div><!--//form-group-->
							<div class="password mb-3">
								<label class="sr-only" for="signin-password">Password</label>
								<input id="signin-password" name="password" type="password" class="form-control signin-password" placeholder="Password" required="required">
								<div class="extra mt-3 row justify-content-between">
									<!-- <div class="col-6">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="remember_me" value="" id="RememberPassword">
											<label class="form-check-label" for="RememberPassword">
											Remember me
											</label>
										</div>
									</div>//col-6 -->
									<!-- <div class="col-6">
										<div class="forgot-password text-end">
											<a href="reset-password.php">Forgot password?</a>
										</div>
									</div>//col-6 -->
								</div><!--//extra-->
							</div><!--//form-group-->
							<div class="text-center">
								<button type="submit" name="login" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button>
							</div>
						</form>
						
						<!-- <div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="signup.php" >here</a>.</div> -->
					</div><!--//auth-form-container-->	

			    </div><!--//auth-body-->
		    
			    
		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">
		    </div>
		    <div class="auth-background-mask"></div>
		    
	    </div><!--//auth-background-col-->
    
    </div><!--//row-->


</body>
</html> 

