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
				$_SESSION['verify_statue'] = "Your Account verified please <a href='https://backonhost.com/login.php'>login</a>";
			}
			
		}
		else{

			$_SESSION['verify_statue'] = "Your Account is already verified please <a href='https://backonhost.com/login.php'>login</a>";
		}
		
	}


?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Verify - Back On Host</title>
    
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
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/app-logo.png" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Log in to Portal</h2>
					<?php  

						if (isset($_SESSION['verify_statue'])) {
							?>
								<h3 class="auth-heading text-center mb-5" style="color:red;"><?php echo $_SESSION['verify_statue']; ?></h3>
							<?php
						}

					?>
			        	

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
