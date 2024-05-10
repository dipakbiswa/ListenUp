<?php
session_start();
//Checking Session set or not
if (!isset($_SESSION['artist_email'])) {
    header("location: login.php");
}
include '../dbcon.php';
$email = $_SESSION['artist_email'];
$artist_id = $_SESSION['artist_id'];

//Number of audiobooks
$audiobook_query = "select * from audiobook where artist_id = '$artist_id'";
$audiobook_query_run = mysqli_query($conn, $audiobook_query);
$audiobook_query_number = mysqli_num_rows($audiobook_query_run);

//Number of plays 
$yearMonth = date("M-Y");
$play_query = "select * from play where artist_id = '$artist_id' and yearMonth = '$yearMonth'";
$play_query_run = mysqli_query($conn, $play_query);
$play_query_number = mysqli_num_rows($play_query_run);

//revenue $1 for per 1000 plays
$revenue = $play_query_number / 1000;
//USD to INR
$revenue = $revenue * 80;

//Insert Revenue
$earnings_row = mysqli_num_rows(mysqli_query($conn, "select * from earnings where artist_id = '$artist_id' and yearMonth = '$yearMonth'"));
if($earnings_row == 0){
    mysqli_query($conn, "insert INTO `earnings`(`artist_id`, `balance`, `yearMonth`) VALUES ('$artist_id','$revenue','$yearMonth')");
}
else{
    mysqli_query($conn, "update `earnings` SET `balance`='$revenue' WHERE `yearMonth` = '$yearMonth' and `artist_id` = '$artist_id'");
}

//Fetching revenue
$fetch_revenue = "select * from earnings where artist_id = '$artist_id' and yearMonth = '$yearMonth'";
$fetch_revenue_run = mysqli_query($conn, $fetch_revenue);
$fetch_revenue_data = mysqli_fetch_assoc($fetch_revenue_run);


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v5.8.4, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <meta name="description" content="">


    <title>Home</title>
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

    <?php include 'nav.php'; ?>

    <section data-bs-version="5.1" class="content4 cid-tB8dYrnjrW" id="content4-2">




        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-md-12 col-lg-10">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-5">
                        <strong>My Dashboard</strong>
                    </h3>


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
                            <span class="num mbr-fonts-style display-1"><strong>
                                    <?php echo $audiobook_query_number; ?>
                                </strong></span>
                        </div>
                        <h4 class="card-title mbr-fonts-style display-5">
                            <strong>Audiobooks</strong>
                        </h4>

                    </div>
                </div>
                <div class="card p-4 p-md-3 col-md-6 col-lg-4">
                    <div class="card-box" >
                        <div class="title">
                            <span class="num mbr-fonts-style display-1"><strong>
                                    <?php echo $play_query_number; ?>
                                </strong></span>
                        </div>
                        <h4 class="card-title mbr-fonts-style display-5">
                            <strong>Plays</strong>
                        </h4>
                    </div>
                </div>
                <div class="card p-4 p-md-3 col-md-6 col-lg-4">
                    <div class="card-box">
                        <div class="title">
                            <span class="num mbr-fonts-style display-1"><strong>₹
                                    <?php echo $fetch_revenue_data['balance']; ?>
                                </strong></span>
                        </div>
                        <h4 class="card-title mbr-fonts-style display-5">
                            <strong>Earnings</strong>
                        </h4>

                    </div>
                </div>

                <center><a href="newAudiobook.php" class="btn btn-primary">Add New Audiobook</a></center>



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