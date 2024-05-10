<?php
include 'dbcon.php';
$advertiser_id = $_GET['advertiser_id'];
$ad_id = $_GET['ad_id'];

$select_ad_query = "select * from ads where id = '$ad_id'";
$fetch_ad = mysqli_fetch_assoc(mysqli_query($conn, $select_ad_query));
$website = $fetch_ad['website'];


$fetch_balance = mysqli_fetch_assoc(mysqli_query($conn, "select * from balance where user_id = '$advertiser_id'"));


// Deduct the ad cost from the advertiser's balance
$newBalance = $fetch_balance['balance'] - 0.5;
$clicks = $fetch_ad['clicks'] + 1;
$total_cost = $fetch_ad['total_cost'] + 0.5;

//Updating in database
$balance_update = mysqli_query($conn, "update `balance` SET `balance`='$newBalance' WHERE user_id = '$advertiser_id'");
$ad_update = mysqli_query($conn, "update `ads` SET `clicks`='$clicks', `total_cost`='$total_cost' WHERE id = '$ad_id'");


// Redirect the listener to the advertiser's website or landing page
if($balance_update and $ad_update){
    header("Location: $website");
}

?>