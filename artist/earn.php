<?php
session_start();
//Checking Session set or not
if (!isset($_SESSION['artist_email'])) {
    header("location: login.php");
}
include '../dbcon.php';
$artist_id = $_SESSION['artist_id'];
if (isset($_POST['filter'])) {
    $startDate = date($_POST['startDate']);
    $endDate = date($_POST['endDate']);
    $filter_query = "select * from play where artist_id = '$artist_id' and play_date between '$startDate' and '$endDate'";
    $filter_query_run = mysqli_query($conn, $filter_query);
    $filter_query_number = mysqli_num_rows($filter_query_run);

    $revenue = $filter_query_number / 1000;
    $revenue = $revenue * 80;
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


    <title>Earn</title>
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

    <section data-bs-version="5.1" class="content4 cid-tB8fTFSQK2" id="content4-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-md-12 col-lg-10">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                        <strong>My Earnings</strong>
                    </h3>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="form2 cid-tB8fZnb8X4" id="form2-7">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                    <form action="#" method="post" class="mbr-form form-with-styler">
                        <div class="dragArea row">

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="mbr-text mbr-fonts-style mb-5 align-center display-7">Filter by date</p>
                            </div>
                            <div class="col-lg col-md col-12 form-group mb-3" data-for="email">
                                Start date:<input type="date" name="startDate" class="form-control" id="name-form2-7"
                                    required>
                            </div>
                            <div class="col-lg col-md col-12 form-group mb-3" data-for="email">
                                End date:<input type="date" name="endDate" class="form-control" id="email-form2-7"
                                    required>
                            </div>
                            <div class="mbr-section-btn col-md-auto col"><button type="submit" name="filter"
                                    class="btn btn-primary display-4">Filter</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="features23 cid-tB8g4LiND9" id="features23-8">
        <div class="container">
            <div class="card-wrapper">
                <div class="card-box align-left">

                </div>
            </div>
            <!-- col-12 col-md-6 col-lg-4 -->
            <div class="row justify-content-center content-row mt-4">
                <div class="card p-4 p-md-3 col-md-6">
                    <div class="card-box">
                        <div class="title">
                            <span class="num mbr-fonts-style display-1"><strong>
                                    <?php if (isset($filter_query_number)) {
                                        echo $filter_query_number;
                                    } else {
                                        echo 0;
                                    } ?>
                                </strong></span>
                        </div>
                        <h4 class="card-title mbr-fonts-style display-5"><strong>Plays</strong></h4>
                    </div>
                </div>
                <div class="card p-4 p-md-3 col-md-6">
                    <div class="card-box">
                        <div class="title">
                            <span class="num mbr-fonts-style display-1"><strong>₹
                                    <?php if (isset($revenue)) {
                                        echo $revenue;
                                    } else {
                                        echo 0;
                                    } ?>
                                </strong></span>
                        </div>
                        <h4 class="card-title mbr-fonts-style display-5">
                            <strong>Eranings</strong>
                        </h4>

                    </div>
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