<?php
session_start();

include '../dbcon.php';

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
            $verify_status = "Your Account verified please <a href='http://localhost/audiobook2/artist/login.php'>login</a>";
        }

    } else {
        $verify_status = "Your Account is already verified please <a href='http://localhost/audiobook2/artist/login.php'>login</a>";
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


    <title>Verify Account</title>
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

    <?php include 'logoutNav.php'; ?>

    <section data-bs-version="5.1" class="form7 cid-tB8hNVbMgf" id="form7-d">


        <div class="container">
            <div class="mbr-section-head">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                    <strong>Verify your artist account</strong>
                </h3>
            </div>
            <div class="row justify-content-center mt-4">
                <center>
                    <p>
                        <?php
                        if (isset($verify_status)) {
                            echo $verify_status;
                        }
                        ?>
                    </p>
                </center>

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