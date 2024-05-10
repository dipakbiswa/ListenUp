<?php
include 'dbcon.php';
session_start();
$artist_id = $_SESSION['artist_id'];
$yearMonth = date("M-Y");
$play_query = "select * from play where artist_id = '$artist_id' and yearMonth = '$yearMonth'";
$play_query_run = mysqli_query($conn, $play_query);
$play_query_number = mysqli_num_rows($play_query_run);
echo $play_query_number;
echo $yearMonth;