
<?php session_start(); ?>

<?php 
include '../dbcon.php';
    if (!isset($_SESSION['username'])) {
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Admin Dashboard</title>
    
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

<body class="app">   	
    <?php include 'header.php'; ?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4" >
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">👋 Welcome back!</h1>
			    
			    
				    
			    <div class="row g-4 mb-4">
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100" style="background: #17a2b8;">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1" style="color:#fff;">Total Users</h4>
							    <div class="stats-figure"><?php echo $_SESSION['users']; ?></div>
							    
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="report.php"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100" style="background:#ffc107;">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1" style="color:#fff;">Total Audiobooks</h4>
							    <div class="stats-figure"><?php echo $_SESSION['audiobooks']; ?></div>
							    
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="#"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100" style="background:#6c757d;">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1" style="color:#fff;">Total Categories</h4>
							    <div class="stats-figure"><?php echo $_SESSION['category']; ?></div>
							    
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="#"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100" style="background:#28a745;">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1" style="color:#fff;">Total Ads</h4>
							    <div class="stats-figure"><?php echo $_SESSION['ads']; ?></div>
							    
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="#"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
			    </div><!--//row-->
			    
				<div class="row g-4 mb-4">
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100" style="background: #17a2b8;">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1" style="color:#fff;">Total Notifications</h4>
							    <div class="stats-figure"><?php echo $_SESSION['notification']; ?></div>
							    
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="report.php"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100" style="background:#ffc107;">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1" style="color:#fff;">Total Plays</h4>
							    <div class="stats-figure"><?php echo $_SESSION['play']; ?></div>
							    
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="#"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100" style="background:#6c757d;">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1" style="color:#fff;">Subscription Earings</h4>
							    <div class="stats-figure">₹<?php echo $_SESSION['earnings_from_subscription']; ?></div>
							    
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="#"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100" style="background:#28a745;">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1" style="color:#fff;">Total Ads Clicks</h4>
							    <div class="stats-figure"><?php echo $_SESSION['total_ads_clicks']; ?></div>
							    
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="#"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
			    </div><!--//row-->




			    










			   
						    <!--//app-card-footer-->
						</div><!--//app-card-->
				    </div><!--//col-->
			    </div><!--//row-->
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	     <!--/*
	  <footer class="app-footer">
	    <div class="container text-center py-3">
	         
        <small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="app-link" href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>
	       
	    </div>
    </footer>
	    */-->
    </div><!--//app-wrapper-->    					

 
    <!-- Javascript -->          
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

    <!-- Charts JS -->
    <script src="assets/plugins/chart.js/chart.min.js"></script> 
    <script src="assets/js/index-charts.js"></script> 
    
    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 

</body>
</html> 

