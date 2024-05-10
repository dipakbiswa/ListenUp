<?php
    session_start();
    if(!isset($_SESSION['brand_email'])){
        header("location: login.php");
    }
    include '../dbcon.php';
    $email = $_SESSION['brand_email'];
    $user_id = $_SESSION['brand_id'];

    //Balance
    $balance_query = "select * from balance where user_id = '$user_id'";
    $balance_query_run = mysqli_query($conn, $balance_query);
    $balance_fetch = mysqli_fetch_assoc($balance_query_run);
    $balance_row = mysqli_num_rows($balance_query_run);

    //Ads
    $ads_query = "select * from ads where advertiser_id = '$user_id'";
    $ads_query_run = mysqli_query($conn, $ads_query);
    $ads_row = mysqli_num_rows($ads_query_run);
    


?>
<!DOCTYPE html>
<html  >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta name="description" content="">
  
  
  <title>Home</title>
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
  
<?php include 'nav.php'; ?>

<section data-bs-version="5.1" class="content4 cid-tB8dYrnjrW" id="content4-2">
    

    
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-10">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-5">
                    <strong>My Dashboard</strong></h3>
                
                
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="features23 cid-tB8duIi0tm" id="features23-1">

    

    
    
    <div class="container">
        <div class="card-wrapper">
            <div class="card-box align-left">
                
                
                
            </div>
        </div>
        <!-- col-12 col-md-6 col-lg-4 -->
        <div class="row justify-content-center content-row mt-4">
            <div class="card p-4 p-md-3 col-md-6 col-lg-4">
                <div class="card-box">
                    <div class="title">
                        <span class="num mbr-fonts-style display-1"><strong><?php echo $ads_row; ?></strong></span>
                    </div>
                    <h4 class="card-title mbr-fonts-style display-5">
                        <strong>Ads</strong></h4>
                    
                </div>
            </div>
            <!--<div class="card p-4 p-md-3 col-md-6 col-lg-4">
                <div class="card-box">
                    <div class="title">
                        <span class="num mbr-fonts-style display-1"><strong><?php //echo $play_query_number; ?></strong></span>
                    </div>
                    <h4 class="card-title mbr-fonts-style display-5">
                        <strong>Plays</strong></h4>
                    
                </div>
            </div>-->
            <div class="card p-4 p-md-3 col-md-6 col-lg-4">
                <div class="card-box">
                    <div class="title">
                        <span class="num mbr-fonts-style display-1"><strong>₹ <?php if($balance_row > 0) echo $balance_fetch['balance']; else echo 0 ?></strong></span>
                    </div>
                    <h4 class="card-title mbr-fonts-style display-5">
                        <strong>Balance</strong></h4>
                    
                </div>
            </div>
            
            <center><a href="addBalance.php" class="btn btn-primary">Add Balance</a></center>
            
            
            
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