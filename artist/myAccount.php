<?php
session_start();
//Checking Session set or not
if (!isset($_SESSION['artist_email'])) {
    header("location: login.php");
}
include '../dbcon.php';
$email = $_SESSION['artist_email'];
$user_id = $_SESSION['artist_id'];
$user_query = "select * from user where email = '$email'";
$user_query_run = mysqli_query($conn, $user_query);
$user_data = mysqli_fetch_assoc($user_query_run);

//Bank query
$true = false;
$bank_query = "select * from payment_details where user_id = '$user_id'";
$bank_query_run = mysqli_query($conn, $bank_query);
$bank_row = mysqli_num_rows($bank_query_run);
$bank_data = mysqli_fetch_assoc($bank_query_run);
if ($bank_row) {
    $true = true;
} else {
    $true = false;
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


    <title>My Account</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
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

    <section data-bs-version="5.1" class="people5 mbr-embla cid-tB8f36WyTx" id="people5-4">






        <div class="position-relative text-center">
            <h3 class="mb-4 mbr-fonts-style display-5">
                <strong>My Account</strong>
            </h3>

            <div class="embla" data-skip-snaps="true" data-align="center" data-auto-play-interval="5">
                <div class="embla__viewport container-fluid">
                    <div class="embla__container">
                        <div class="embla__slide slider-image item" style="margin-left: 4rem; margin-right: 4rem;">
                            <div class="user">
                                <div class="user_image">
                                    <div class="item-wrapper position-relative">
                                        <img src="../assets/profile_pics/<?php echo $user_data['profile_pic']; ?>"
                                            alt="Mobirise Website Builder">
                                    </div>
                                </div>
                                <div class="user_text mb-4">
                                    <p class="mbr-fonts-style display-7"></p>
                                </div>
                                <div class="user_name mbr-fonts-style mb-2 display-2">
                                    <strong>
                                        <?php echo $user_data['name']; ?>
                                    </strong>
                                </div>
                                <div class="user_desk mbr-fonts-style display-7">
                                    <b>Email:</b>
                                    <?php echo $user_data['email']; ?>
                                </div>
                                <div class="user_desk mbr-fonts-style display-7">
                                    <b>Phone:</b>
                                    <?php echo $user_data['phone']; ?>
                                </div>
                                <hr>
                                <?php
                                if ($true) { ?>
                                    <div class="user_desk mbr-fonts-style display-7">
                                        <b>Account Holder's Name:</b>
                                        <?php echo $bank_data['acc_holder_name']; ?>
                                    </div>
                                    <div class="user_desk mbr-fonts-style display-7">
                                        <b>Account Number:</b>
                                        <?php echo $bank_data['account_number']; ?>
                                    </div>
                                    <div class="user_desk mbr-fonts-style display-7">
                                        <b>IFSC Code:</b>
                                        <?php echo $bank_data['ifsc_code']; ?>
                                    </div>
                                    <div class="user_desk mbr-fonts-style display-7">
                                        <b>Account Type:</b>
                                        <?php echo $bank_data['account_type']; ?>
                                    </div>
                                    <div class="user_desk mbr-fonts-style display-7">
                                        <b>Bank Name:</b>
                                        <?php echo $bank_data['bank_name']; ?>
                                    </div>
                                    <div class="user_desk mbr-fonts-style display-7">
                                        <b>Bank Branch:</b>
                                        <?php echo $bank_data['account_branch']; ?>
                                    </div>
                                    <hr>
                                <?php } ?>
                                <div class="user_desk mbr-fonts-style display-7">
                                    <?php
                                    if ($bank_row == 0) { ?>
                                        <a href="bankDetails.php" class="btn btn-success">Add Bank Details</a>
                                    <?php } else { ?>
                                        <a href="editBankDetails.php?id=<?php echo $user_id; ?>"
                                            class="btn btn-success">Edit Bank Details</a>
                                    <?php } ?>
                                </div>
                                <div class="user_desk mbr-fonts-style display-7">
                                    <a href="withdrawalHistory.php?artist_eamil=<?php echo $email ?>"
                                        class="btn btn-primary">Withdrawal History</a>
                                </div>
                                <div class="user_desk mbr-fonts-style display-7">
                                    <a href="logout.php" class="btn btn-danger">Log Out</a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/smoothscroll/smooth-scroll.js"></script>
    <script src="assets/ytplayer/index.js"></script>
    <script src="assets/dropdown/js/navbar-dropdown.js"></script>
    <script src="assets/embla/embla.min.js"></script>
    <script src="assets/embla/script.js"></script>
    <script src="assets/theme/js/script.js"></script>


</body>

</html>