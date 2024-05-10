<?php
session_start();
include 'dbcon.php';
$user_id = $_SESSION['id'];
// $audiobook_id = $_SESSION['audiobook_id'];


if (isset($_POST['clicked'])) {
	$audiobook_id = $_POST['audiobook_id'];
	$like_query = "select * from `like` where `user_id` = '$user_id' and `audiobook_id`= '$audiobook_id'  ";
	$like_query_run = mysqli_query($conn, $like_query);
	$like_row = mysqli_num_rows($like_query_run);
	if ($like_row == 0) {
		$like_data_insert = "insert into `like`(`user_id`,`audiobook_id`) values('$user_id','$audiobook_id')";
		$like_data_insert_run = mysqli_query($conn, $like_data_insert);
		if ($like_data_insert_run) {
			echo "liked";
		}
	}
	if ($like_row == 1) {
		$like_data_delete = "delete from `like` where `user_id`= '$user_id' and `audiobook_id` = '$audiobook_id'";
		$like_data_delete_run = mysqli_query($conn, $like_data_delete);
		if ($like_data_delete_run) {
			echo "disliked";
		}
	}
}
?>