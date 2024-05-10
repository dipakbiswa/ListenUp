<?php
    include '../dbcon.php';
    $tid = $_GET['tid'];
    $advertiser_id = $_GET['advertiser_id'];
    $balance = $_GET['balance'];

    $checkRecordQuery = "select * from balance where user_id='$advertiser_id'";
    $checkRecordQueryRun = mysqli_query($conn, $checkRecordQuery);
    $row_count = mysqli_num_rows($checkRecordQueryRun);
    $fetch_data = mysqli_fetch_assoc($checkRecordQueryRun);

    if($row_count == 0){
        $addBalanceQuery = "insert INTO `balance`(`balance`, `user_id`, `tid`) VALUES ('$balance','$advertiser_id','$tid')";
        $addBalanceQueryRun = mysqli_query($conn, $addBalanceQuery);
        if($addBalanceQueryRun){
            header("location: index.php");
        }
    }
    else{
        $total_balance = $fetch_data['balance'] + $balance;
        $updateBalance = "update `balance` SET `balance`='$total_balance',`tid`='$tid' WHERE user_id = '$advertiser_id'";
        $updateBalanceRun = mysqli_query($conn, $updateBalance);
        if($updateBalanceRun){
            header("location: index.php");
        }
    }
?>