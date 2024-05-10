<?php
    session_start();
    if(!isset($_SESSION['brand_email'])){
        header("location: login.php");
    }
    include '../dbcon.php';
    $advertiser_id = $_SESSION['brand_id'];
    $advertiser_name = $_SESSION['brand_username'];
    $API = "rzp_test_bCJTYBVFqyOlsx";
    if(isset($_POST['add'])){
        $balance = $_POST['balance'];
        header("location: addingBalance.php?advertiser_id=$advertiser_id&api=$API&name=$advertiser_name&balance=$balance");
        
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta name="description" content="">
  
  
  <title>Add Balance</title>
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

<section data-bs-version="5.1" class="form7 cid-tB8hj1q9O1" id="form7-b">
    
    
    <div class="container">
        <div class="mbr-section-head">
            <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                <strong>Add Balance</strong></h3>
            
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                <form action="#" method="post" class="mbr-form form-with-styler mx-auto">
                    <p class="mbr-text mbr-fonts-style align-center mb-4 display-7">
                        Add balance to your advertiser account</p>
                        <p class="mbr-text mbr-fonts-style align-center mb-4 display-7" style="color: red;">
                        <?php if(isset($message)){ echo $message; } ?></p>
                    <div class="dragArea row">
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="name">
                            <input type="number" name="balance" min="200" max="10000" placeholder="Enter Balance" data-form-field="name" class="form-control" value="" id="name-form7-b" required>
                        </div>
                        
                        <div class="col-auto mbr-section-btn align-center">
                            <button type="submit" name="add" class="btn btn-primary display-4">Add Balance</button>
                        </div>
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
<script src="assets/formoid/formoid.min.js"></script>  

  
</body>
</html>