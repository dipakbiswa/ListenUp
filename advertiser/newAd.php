<?php
    session_start();
    if(!isset($_SESSION['brand_email'])){
        header("location: login.php");
    }
    include '../dbcon.php';
    $email = $_SESSION['brand_email'];
    $advertiser_id = $_SESSION['brand_id'];

    if(isset($_POST['create'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        //Image variables
        $image_name = $_FILES['file']['name'];
        $image_tmp = $_FILES['file']['tmp_name'];
        $fileinfo = @getimagesize($image_tmp);
        $width = $fileinfo[0];
        $height = $fileinfo[1];
        $dest_path = "ads_banner/";
        $image_name = time().$image_name;
        $target_file = $dest_path . $image_name;

        $url = $_POST['url'];

        $balance_row = mysqli_num_rows(mysqli_query($conn, "select * from balance where user_id = $advertiser_id"));
        if($balance_row > 0){
            if($width != "728" and $height != "90"){
                $message = "Banner size mustbe 728x90";
            }
            else{
                $ads_insert_query = "insert INTO `ads`(`advertiser_id`, `name`, `description`, `image_name`, `website`, `ad_cost`) VALUES ('$advertiser_id','$name','$description','$image_name','$url',0.50)";
                $ads_insert_query_run = mysqli_query($conn, $ads_insert_query);
                if($ads_insert_query_run and move_uploaded_file($image_tmp, $target_file)){
                    $message = "Ad created!";
                }
            }
        }
        else{
            $message = "Add balance!";
        }

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
  
  
  <title>Create new ad</title>
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
                <strong>Create new ad</strong></h3>
            
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                <form action="#" method="post" enctype="multipart/form-data" class="mbr-form form-with-styler mx-auto">
                    <p class="mbr-text mbr-fonts-style align-center mb-4 display-7">
                        Run ads on our platform</p>
                        <p class="mbr-text mbr-fonts-style align-center mb-4 display-7" style="color: red;">
                        <?php if(isset($message)){ echo $message; } ?></p>
                    <div class="dragArea row">
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="name">
                            <input type="text" name="name" min="200" max="10000" placeholder="Enter Name" data-form-field="name" class="form-control" value="" id="name-form7-b" required>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="name">
                            <textarea type="text" name="description" min="200" max="10000" placeholder="Enter Description" data-form-field="name" class="form-control" value="" id="name-form7-b" required></textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="name">
                            Upload banner: <input type="file" accept=".png, .jpg, .jpeg, .gif" name="file" min="200" max="10000" placeholder="Upload banner" data-form-field="name" class="form-control" value="" id="name-form7-b" required>
                            Upload 728x90 Size Banner for best result 
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="name">
                            <input type="url" name="url" min="200" max="10000" placeholder="Enter URL" data-form-field="name" class="form-control" value="" id="name-form7-b" required>
                        </div>
                        
                        <div class="col-auto mbr-section-btn align-center">
                            <button type="submit" name="create" class="btn btn-primary display-4">Create ad</button>
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