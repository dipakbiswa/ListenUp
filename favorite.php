<?php
session_start();
include 'dbcon.php';
$user_id = $_SESSION['id'];
// $audiobook_id = $_SESSION['audiobook_id'];


if (isset($_POST['clicked'])) {
	$audiobook_id = $_POST['audiobook_id'];
	$favorite_query = "select * from `favourite` where `user_id` = '$user_id' and `audiobook_id`= '$audiobook_id'  ";
	$favorite_query_run = mysqli_query($conn, $favorite_query);
	$favorite_row = mysqli_num_rows($favorite_query_run);
	if ($favorite_row == 0) {
		$favorite_data_insert = "insert into `favourite`(`user_id`,`audiobook_id`) values('$user_id','$audiobook_id')";
		$favorite_data_insert_run = mysqli_query($conn, $favorite_data_insert);
		if ($favorite_data_insert_run) {
			echo "favorited";
		}
	}
	if ($favorite_row == 1) {
		$favorite_data_delete = "delete from `favourite` where `user_id`= '$user_id' and `audiobook_id` = '$audiobook_id'";
		$favorite_data_delete_run = mysqli_query($conn, $favorite_data_delete);
		if ($favorite_data_delete_run) {
			echo "notfavorite";
		}
	}
}
?>