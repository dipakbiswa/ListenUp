<?php
session_start();
//Checking Session set or not
if (!isset($_SESSION['artist_email'])) {
    header("location: login.php");
}

include '../dbcon.php';
$email = $_SESSION['artist_email'];
$artist_id = $_SESSION['artist_id'];


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v5.8.4, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <meta name="description" content="">


    <title>Earnings History</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
        integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
        integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
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
    <section data-bs-version="5.1" class="people5 mbr-embla cid-tB8f36WyTx" id="people5-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-md-12 col-lg-10">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-5">
                        <strong>Earnings History</strong>
                    </h3>
                </div>
            </div>
        </div>
        <div class="position-relative text-center">
            <table class="table">
                <thead>
                    <tr align="center">
                        <th scope="col">#</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Payment Of</th>
                        <th scope="col">Payment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $earnings_query = "select * from earnings_history where artist_id = '$artist_id'";
                    $earnings_query_run = mysqli_query($conn, $earnings_query);
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($earnings_query_run)) {
                        ?>
                        <tr align="center">
                            <th scope="row">
                                <?php echo $count; ?>
                            </th>
                            <td>
                                <?php echo $row['balance']; ?>
                            </td>
                            <td>
                                <?php echo $row['yearMonth']; ?>
                            </td>
                            <td>
                                <?php echo $row['pay_date']; ?>
                            </td>
                        </tr>
                        <?php $count++;
                    } ?>
                </tbody>
            </table>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/smoothscroll/smooth-scroll.js"></script>
    <script src="assets/ytplayer/index.js"></script>
    <script src="assets/dropdown/js/navbar-dropdown.js"></script>
    <script src="assets/theme/js/script.js"></script>


</body>

</html>