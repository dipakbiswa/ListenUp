<?php
    session_start();
    if(!isset($_SESSION['brand_email'])){
        header("location: login.php");
    }
    include '../dbcon.php';
    // $email = $_SESSION['artist_email'];
    $advertiser_id = $_SESSION['brand_id'];
    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $fetch_image_query = mysqli_query($conn, "select * from `ads` where `id` = '$id'");
        $fetch_image_name = mysqli_fetch_assoc($fetch_image_query);
        $image_name = $fetch_image_name['image_name'];
        $delete_status = unlink("ads_banner/".$image_name);
        $delete_query_run = mysqli_query($conn, "delete FROM `ads` WHERE id = '$id'");
        if($delete_query_run and $delete_status){
            $message = "Ad deleted!";
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
  
  
  <title>My Ads</title>
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
<section data-bs-version="5.1" class="people5 mbr-embla cid-tB8f36WyTx" id="people5-4">
    <div class="container">
        <center><p style="color:red;"><?php if(isset($message)){echo $message; }?></p></center>
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-10">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-5">
                    <strong>My Ads</strong></h3> 
            </div>
        </div>
    </div>
    <div class="position-relative text-center">
        <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Website/URL</th>
                <th scope="col">CPC</th>
                <th scope="col">Total Cost</th>
                <th scope="col">Clicks</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ads_query = "select * from ads where advertiser_id = '$advertiser_id'";
            $ads_query_run = mysqli_query($conn, $ads_query);
            $count = 1;
            while($row = mysqli_fetch_assoc($ads_query_run)){
                ?>
            <tr>
                <th scope="row"><?php echo $count; ?></th>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['website']; ?></td>
                <td>₹<?php echo $row['ad_cost']; ?></td>
                <td>₹<?php echo $row['total_cost']; ?></td>
                <td><?php echo $row['clicks']; ?></td>
                <td><?php if($row['status'] == 1) echo "Approved"; else if($row['status'] == 2) echo "Disapproved"; else echo "Pending Approval" ; ?></td>
                <td><form action="#" method="post"><input type="hidden" name="id" value="<?php echo $row['id']; ?>"><button type="submit" name="delete" class="btn btn-danger"><svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" fill="white"></path> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" fill="white"></path> </svg></button></form></td>
            </tr>
            <?php $count++; }  ?>
        </tbody>
        </table>
    </div>
    <center><a href="newAd.php" class="btn btn-primary">Create New Ad</a></center>
</section>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>  
<script src="assets/smoothscroll/smooth-scroll.js"></script>  
<script src="assets/ytplayer/index.js"></script>  
<script src="assets/dropdown/js/navbar-dropdown.js"></script>  
<script src="assets/theme/js/script.js"></script>  
  
  
</body>
</html>