<?php
session_start();
//Checking Session set or not
if (!isset($_SESSION['artist_email'])) {
    header("location: login.php");
}
include '../dbcon.php';
$email = $_SESSION['artist_email'];
$user_id = $_SESSION['artist_id'];
if (isset($_POST['save'])) {
    $acc_holders_name = $_POST['name'];
    $bank_name = $_POST['bank_name'];
    $account_number = $_POST['account_number'];
    $ifsc_code = $_POST['ifsc_code'];
    $acc_type = $_POST['acc_type'];
    $branch = $_POST['branch'];

    $insert_query = "insert INTO `payment_details`(`user_id`, `bank_name`, `acc_holder_name`, `account_number`, `ifsc_code`, `account_type`, `account_branch`) VALUES ('$user_id','$bank_name','$acc_holders_name','$account_number','$ifsc_code','$acc_type','$branch')";
    $insert_query_run = mysqli_query($conn, $insert_query);
    if ($insert_query) {
        $message = "Bank Details Updated Successfuly!";
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


    <title>Bank Details</title>
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

    <section data-bs-version="5.1" class="form7 cid-tB8hj1q9O1" id="form7-b">


        <div class="container">
            <div class="mbr-section-head">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                    <strong>Bank Details</strong>
                </h3>

            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                    <form action="#" method="post" enctype="multipart/form-data"
                        class="mbr-form form-with-styler mx-auto">
                        <p class="mbr-text mbr-fonts-style align-center mb-4 display-7">
                            Fill this form up to receive payment</p>
                        <p class="mbr-text mbr-fonts-style align-center mb-4 display-7" style="color: red;">
                            <?php if (isset($message)) {
                                echo $message;
                            } ?>
                        </p>
                        <div class="dragArea row">
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="name">
                                <input type="text" name="name" placeholder="Account Holder's Name"
                                    data-form-field="name" class="form-control" value="" id="name-form7-b" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="email">
                                <input type="text" name="bank_name" placeholder="Bank Name" data-form-field="email"
                                    class="form-control" value="" id="email-form7-b" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="email">
                                <input type="text" name="account_number" placeholder="Account Number"
                                    data-form-field="email" class="form-control" value="" id="email-form7-b" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="email">
                                <input type="text" name="ifsc_code" placeholder="IFCS Code" data-form-field="email"
                                    class="form-control" value="" id="email-form7-b" required>
                            </div>
                            <div data-for="phone" class="col-lg-12 col-md-12 col-sm-12 form-group mb-3">
                                Account type: <select class="form-control" name="acc_type" placeholder="Account type"
                                    required>
                                    <option value="Savings">Savings</option>
                                    <option value="Currents">Currents</option>
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="email">
                                <input type="text" name="branch" placeholder="Branch Name" data-form-field="email"
                                    class="form-control" value="" id="email-form7-b" required>
                            </div>

                            <div class="col-auto mbr-section-btn align-center">
                                <button type="submit" name="save" class="btn btn-primary display-4">Save</button>
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