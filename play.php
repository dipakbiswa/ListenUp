<?php
session_start();
//Checking login or not
if (!isset($_SESSION['username'])) {
	header("location: login.php");
}
include 'dbcon.php';
$email = $_SESSION['email'];
$plan = $_SESSION['plan'];
$user_id = $_SESSION['id'];
if (isset($_GET['link'])) {
	$link = $_GET['link'];
	$query = "select * from audiobook where link = '$link'";
	$query_run = mysqli_query($conn, $query);
	$fetch = mysqli_fetch_assoc($query_run);
	$audiobook_id = $fetch['id'];
	$artist_id = $fetch['artist_id'];

	//Set session for audiobook_id
	$_SESSION['audiobook_id'] = $audiobook_id;
}
if (!isset($_GET['link'])) {
	header('location: dashboard.php');
}


//Play count
$today = date("Y-m-d");
$yearMonth = date("M-Y");
$play_count_query = "select * from play where user_id='$user_id' and audiobook_id='$audiobook_id'";
$play_count_query_run = mysqli_query($conn, $play_count_query);
$row_count = mysqli_num_rows($play_count_query_run);
if ($row_count == 0) {
	$update_play_count_query = "insert INTO `play`(`user_id`, `artist_id`, `audiobook_id`, `play_date`, `yearMonth`) VALUES ('$user_id','$artist_id','$audiobook_id', '$today', '$yearMonth')";
	$update_play_count_query_run = mysqli_query($conn, $update_play_count_query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>
		<?php echo $fetch['title']; ?>
	</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="ListenUp audiobook platfrom">
	<meta name="author" content="ListenUp">
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

	<!-- FontAwesome JS-->
	<script defer src="assets/fontawesome/js/all.min.js"></script>

	<!-- Theme CSS -->
	<link id="theme-style" rel="stylesheet" href="assets/css/theme.css">

	<link rel="stylesheet" type="text/css" href="css/down-nav.css">

	<!-- Jquery CDN -->
	<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

	<style type="text/css">
		.msger-inputarea {
			display: flex;
			padding: 10px;
			border-top: var(--border);
			background: #eee;
		}

		.msger-inputarea * {
			padding: 10px;
			border: none;
			border-radius: 3px;
			font-size: 1em;
		}

		.msger-input {
			flex: 1;
			background: #ddd;
		}

		.msger-send-btn {
			margin-left: 10px;
			background: rgb(0, 196, 65);
			color: #fff;
			font-weight: bold;
			cursor: pointer;
			transition: background 0.23s;
		}

		.msger-send-btn:hover {
			background: rgb(0, 180, 50);
		}

		/*Share Model*/
		.share-list {
			display: flex;
			flex-direction: row;
		}

		.share-list a {
			border-radius: 100px;
			width: 50px;
			height: 50px;
			padding: 7px;
			margin: 10px;
			cursor: pointer;
			overflow: hidden;


		}

		.share-img {
			width: 100%;
			height: 100%;
			filter: invert(100%);
		}

		a.fb-h {
			background: #3B5998;
		}

		a.tw-h {
			background: #00acee;
		}

		a.li-h {
			background: #0077B5;
		}

		a.re-h {
			background: #FF5700;
		}

		a.pi-h {
			background: #c8232c;
		}

		a.wp {
			background: #25d366;
		}


		.btn_list {
			list-style: none;
		}

		.btn_list li {
			display: inline-block;
		}



		.share-buttons {
			display: flex;
			justify-content: center;
		}

		.share-button {
			font-size: 1rem;
			color: #fff;
			background-color: #2d2d2d;
			border: none;
			border-radius: 5px;
			padding: 10px 20px;
			margin: 10px;
			cursor: pointer;
			display: flex;
			align-items: center;
		}

		.facebook {
			background-color: #3b5998;
		}

		.twitter {
			background-color: #1da1f2;
		}

		.linkedin {
			background-color: #0077b5;
		}

		.whatsapp {
			background-color: #25d366;
		}


		/* Copy Link Button CSS */
		/* tooltip settings 👇 */

		.copy {
			/* button */
			--button-bg: #353434;
			--button-hover-bg: #464646;
			--button-text-color: #CCCCCC;
			--button-hover-text-color: #8bb9fe;
			--button-border-radius: 10px;
			--button-diameter: 36px;
			--button-outline-width: 1px;
			--button-outline-color: rgb(141, 141, 141);
			/* tooltip */
			--tooltip-bg: #f4f3f3;
			--toolptip-border-radius: 4px;
			--tooltip-font-family: Menlo, Roboto Mono, monospace;
			/* 👆 this field should not be empty */
			--tooltip-font-size: 12px;
			/* 👆 this field should not be empty */
			--tootip-text-color: rgb(50, 50, 50);
			--tooltip-padding-x: 7px;
			--tooltip-padding-y: 7px;
			--tooltip-offset: 8px;
			/* --tooltip-transition-duration: 0.3s; */
			/* 👆 if you need a transition, 
  just remove the comment,
  but I didn't like the transition :| */
		}

		.copy {
			box-sizing: border-box;
			width: var(--button-diameter);
			height: var(--button-diameter);
			border-radius: var(--button-border-radius);
			background-color: var(--button-bg);
			color: var(--button-text-color);
			border: none;
			cursor: pointer;
			position: relative;
			outline: none;
		}

		.tooltip {
			position: absolute;
			opacity: 0;
			visibility: 0;
			top: 0;
			left: 50%;
			transform: translateX(-50%);
			white-space: nowrap;
			font: var(--tooltip-font-size) var(--tooltip-font-family);
			color: var(--tootip-text-color);
			background: var(--tooltip-bg);
			padding: var(--tooltip-padding-y) var(--tooltip-padding-x);
			border-radius: var(--toolptip-border-radius);
			pointer-events: none;
			transition: all var(--tooltip-transition-duration) cubic-bezier(0.68, -0.55, 0.265, 1.55);
		}

		.tooltip::before {
			content: attr(data-text-initial);
		}

		.tooltip::after {
			content: "";
			position: absolute;
			bottom: calc(var(--tooltip-padding-y) / 2 * -1);
			width: var(--tooltip-padding-y);
			height: var(--tooltip-padding-y);
			background: inherit;
			left: 50%;
			transform: translateX(-50%) rotate(45deg);
			z-index: -999;
			pointer-events: none;
		}

		.copy svg {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		.checkmark {
			display: none;
		}

		/* actions */

		.copy:hover .tooltip,
		.copy:focus:not(:focus-visible) .tooltip {
			opacity: 1;
			visibility: visible;
			top: calc((100% + var(--tooltip-offset)) * -1);
		}

		.copy:focus:not(:focus-visible) .tooltip::before {
			content: attr(data-text-end);
		}

		.copy:focus:not(:focus-visible) .clipboard {
			display: none;
		}

		.copy:focus:not(:focus-visible) .checkmark {
			display: block;
		}

		.copy:hover,
		.copy:focus {
			background-color: var(--button-hover-bg);
		}

		.copy:active {
			outline: var(--button-outline-width) solid var(--button-outline-color);
		}

		.copy:hover svg {
			color: var(--button-hover-text-color);
		}


		.like{
			color: black;
			background-color: #fff; 
			border: none;
		}
		.like2{
			color: red;
			background-color: #fff; 
			border: none;
		}
	</style>

</head>

<body>
	<?php include 'header.php'; ?>

	<script type="text/javascript">
		function refresh() {
			location.reload();
		}
	</script>


	<div class="page-content">
		<div class="container">
			<div class="docs-overview py-5">
				<div class="row justify-content-center">



					<!--Play-->
					<div class="col-12 col-lg-6 py-3">
						<div class="card shadow-sm">
							<div class="card-body">
								<center>
									<h5 class="card-title mb-3">
										<span class="card-title-text">
											<?php echo $fetch['title']; ?>
										</span>
									</h5>
									<p class="card-title mb-3">
										<span class="card-title-text">
											<?php echo $fetch['artist_name']; ?>
										</span>
									</p>
									<img src="assets/banner/<?php echo $fetch['banner_name']; ?>" width="250px"
										style="border-radius: 10px; display: flex;"><br>


									<!--Play Audio Plan Wise-->
									<?php
									$other_activity = false;
									if (($fetch['is_paid'] == 0)) {
										$other_activity = true;
										?>
										<audio id="playerControls" style="width: 100%;" preload="auto" controls
											controlsList="nodownload" autoplay>
											<source src="assets/audio/<?php echo $fetch['audio_name']; ?>">
											</source>
										</audio>
										<?php
									} else if (($fetch['is_paid'] == 1) and (($plan == 1) or ($plan == 2))) {
										$other_activity = true;
										?>
											<audio id="playerControls" style="width: 100%;" preload="auto" controls
												controlsList="nodownload" autoplay>
												<source src="assets/audio/<?php echo $fetch['audio_name']; ?>">
												</source>
											</audio>
										<?php
									} else {
										$other_activity = false;
										?>
											<a href="premium.php" class="btn btn-danger"><i class="fas fa-gem"></i> You need to
												upgrade your plan to play this audiobook</a>
										<?php
									}
									?>


									<?php
									if($other_activity){?>
									<ul class="btn_list">
										<!--Like Button-->
										<?php
										$like_query = "select * from `like` where `user_id` = '$user_id' and `audiobook_id`= '$audiobook_id'  ";
										$like_query_run = mysqli_query($conn, $like_query);
										$like_row = mysqli_num_rows($like_query_run);

										?>
										<li>


											<button class="like" id="like" title="<?php echo $audiobook_id ?>">
												<?php
												if($row_count == 1): ?>
													<i class="fas fa-heart" style="color:red;" id="like-icon"></i>
												<?php else : ?>
													<i class="fas fa-heart" id="like-icon"></i>
												<?php endif ?>
											</button>
											
											<script>
												$(document).ready(function(){
													$("#like").click(function(){
														var audiobook_id = $(this).attr("title");
														var like_icon = $("#like-icon").attr('style');
														$.post("like.php", {audiobook_id: audiobook_id, clicked: 'checked'}, function(data){
															if(data == 'liked'){
																clicked = true;
																$("#like-icon").css("color", "red");
															}
															else if(data == 'disliked'){
																clicked = false;
																$("#like-icon").css("color", "black");
															} 
														});
													});
												});
											</script>


										</li>
										<!--Like Button End-->

										<!--Comment Button-->
										<li>
											<a class="btn btn-link" href="#comment-section"
												style="border-radius: 800px; color: #000;"><i
													class="fa fa-message"></i></a>
										</li>
										<!--Comment Button End-->

										<!--favorite Button-->
										<?php
										$favorite_query = "select * from `favourite` where `user_id` = '$user_id' and `audiobook_id`= '$audiobook_id'  ";
										$favorite_query_run = mysqli_query($conn, $favorite_query);
										$favorite_row = mysqli_num_rows($favorite_query_run);


										// if (isset($_POST['favorite'])) {
										// 	if ($favorite_row == 0) {
										// 		$favorite_data_insert = "insert into `favourite`(`user_id`,`audiobook_id`)values('$user_id','$audiobook_id') ";
										// 		$favorite_data_insert_run = mysqli_query($conn, $favorite_data_insert);
										// 		if ($favorite_data_insert_run) {
										// 			//header('location: favourite_refresh.php');
										// 		}
										// 	} elseif ($favorite_row > 0) {
										// 		$favorite_data_delete = "delete from `favourite` where `user_id`= '$user_id' and `audiobook_id` = '$audiobook_id' ";
										// 		$favorite_data_delete_run = mysqli_query($conn, $favorite_data_delete);
										// 		if ($favorite_data_delete_run) {
										// 			//header('location: favourite_refresh.php');
										// 		}
										// 	}
										// }
										?>
										<li>

											<button class="like" id="favorite" title="<?php echo $audiobook_id ?>">
												<?php
												if($row_count == 1): ?>
													<i class="fas fa-star" id="favorite-icon" style="color: #dac819;"></i>
												<?php else : ?>
													<i class="fas fa-star" id="favorite-icon" style="color: #000;"></i>
												<?php endif ?>
											</button>
											
											<script>
												$(document).ready(function(){
													$("#favorite").click(function(){
														var audiobook_id = $(this).attr("title");
														var favorite_icon = $("#favorite-icon").attr('style');
														$.post("favorite.php", {audiobook_id: audiobook_id, clicked: 'checked'}, function(data){
															if(data == 'favorited'){
																clicked = true;
																$("#favorite-icon").css("color", "#dac819");
															}
															else if(data == 'notfavorite'){
																clicked = false;
																$("#favorite-icon").css("color", "black");
															} 
														});
													});
												});
											</script>
														
													
										</li>
										<!--favorite Button End-->

										<!--Add to playlist Button-->
										<li>
											<a class="btn btn-link" style="border-radius: 800px; color: #000;"><i
													class="fas fa-list" data-bs-toggle="modal"
													data-bs-target="#playlistModal" type="button"></i></a>
										</li>
										<!--Add to playlist Button End-->

										<!--Share Button-->
										<li>
											<a class="btn btn-link" style="border-radius: 800px; color: #000;"
												type="button" data-bs-toggle="modal" data-bs-target="#shareModal"><i
													class=" fas fa-share-square"></i></a>
										</li>
										<!--Share Button End-->


									</ul>
									<?php } 
										$like_count = mysqli_num_rows(mysqli_query($conn, "select * FROM `like` WHERE audiobook_id = $audiobook_id"));
										$comment_count = mysqli_num_rows(mysqli_query($conn, "select * from `comment` where audiobook_id = $audiobook_id"));
									?>
									<p>Likes: <?php echo $like_count ?> | Comments: <?php echo $comment_count ?></p>
								</center>
							</div><!--//card-body-->
						</div><!--//card-->
					</div><!--//col-->


					<!--Share Modal -->
					<!--share URL-->
					<?php

					$url = isset($_SERVER['HTTPS']) &&
						$_SERVER['HTTPS'] === 'on' ? "https://" : "http://";

					$url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

					//print_r($url);
					
					?>
					<!--Share URL End-->
					<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="exampleModalLabel"
						aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="exampleModalLabel">Share</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body">

									<div style="display: flex;">
										<div style="float: left; width: 90%;">
											<textarea class="form-control" style="height: 100px; width: 90%;"
												id="myLink" disabled><?php echo $url; ?></textarea>
										</div>
										<div style="float: right; width: 10%; margin: auto;">
											<!--Copy Button-->
											<button class="copy" onclick="copyLink()">
												<span data-text-end="Copied!" data-text-initial="Copy to clipboard"
													class="tooltip"></span>
												<span>
													<svg xml:space="preserve" style="enable-background:new 0 0 512 512"
														viewBox="0 0 6.35 6.35" y="0" x="0" height="20" width="20"
														xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
														xmlns="http://www.w3.org/2000/svg" class="clipboard">
														<g>
															<path fill="currentColor"
																d="M2.43.265c-.3 0-.548.236-.573.53h-.328a.74.74 0 0 0-.735.734v3.822a.74.74 0 0 0 .735.734H4.82a.74.74 0 0 0 .735-.734V1.529a.74.74 0 0 0-.735-.735h-.328a.58.58 0 0 0-.573-.53zm0 .529h1.49c.032 0 .049.017.049.049v.431c0 .032-.017.049-.049.049H2.43c-.032 0-.05-.017-.05-.049V.843c0-.032.018-.05.05-.05zm-.901.53h.328c.026.292.274.528.573.528h1.49a.58.58 0 0 0 .573-.529h.328a.2.2 0 0 1 .206.206v3.822a.2.2 0 0 1-.206.205H1.53a.2.2 0 0 1-.206-.205V1.529a.2.2 0 0 1 .206-.206z">
															</path>
														</g>
													</svg>
													<svg xml:space="preserve" style="enable-background:new 0 0 512 512"
														viewBox="0 0 24 24" y="0" x="0" height="18" width="18"
														xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
														xmlns="http://www.w3.org/2000/svg" class="checkmark">
														<g>
															<path data-original="#000000" fill="currentColor"
																d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z">
															</path>
														</g>
													</svg>
												</span>
											</button>
											<!--Copy Button End-->
										</div>
									</div>



									<br>
									<center>
										<div class="share-buttons">
											<button class="share-button facebook"><i
													class="fab fa-facebook-f"></i></button>
											<button class="share-button twitter"><i class="fab fa-twitter"></i></button>
											<button class="share-button linkedin"><i
													class="fab fa-linkedin-in"></i></button>
											<button class="share-button whatsapp"><i
													class="fab fa-whatsapp"></i></button>
										</div>
									</center>
								</div>
								<div class="modal-footer">
									<!--<button onclick="copyLink()" class="btn btn-primary">Copy text</button>-->

									<button type="button" class="btn btn-secondary"
										data-bs-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<!--Share Model End-->
					<!--Copy link -->
					<script>
						function copyLink() {
							// Get the text field
							var copyText = document.getElementById("myLink");

							// Select the text field
							copyText.select();
							copyText.setSelectionRange(0, 99999); // For mobile devices

							// Copy the text inside the text field
							navigator.clipboard.writeText(copyText.value);

							// Alert the copied text
							//alert("Copied the text: " + copyText.value);
						}
					</script>
					<!--Social share javascript-->
					<script>
						const shareButtons = document.querySelectorAll('.share-button');

						shareButtons.forEach(button => {
							button.addEventListener('click', event => {
								const url = window.location.href;
								const title = document.title;
								const site = 'ListenUp'; // Replace with your own site name

								switch (event.target.closest('.share-button').classList[1]) {
									case 'facebook':
										window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`);
										break;
									case 'twitter':
										window.open(`https://twitter.com/intent/tweet?url=${url}&text=${title} - ${site}`);
										break;
									case 'linkedin':
										window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}`);
										break;
									case 'whatsapp':
										window.open(`https://api.whatsapp.com/send?text=${title} - ${url}`);
										break;
								}
							});
						});

					</script>

					<!--Playlist Modal -->
					<div class="modal fade" id="playlistModal" tabindex="-1" aria-labelledby="exampleModalLabel"
						aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="exampleModalLabel">My Playlist</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<?php
									$playlist_query = "select * from playlist where user_id = '$user_id'";
									$playlist_query_run = mysqli_query($conn, $playlist_query);

									?>
									<table class="table table-striped">
										<thead>
											<tr>
												<th scope="col" width="70%">Playlist Name</th>
												<th scope="col" width="30%">Add to playlist</th>
											</tr>
										</thead>
										<tbody>
											<?php
											while ($fetch_playlist = mysqli_fetch_assoc($playlist_query_run)) {
												?>
												<tr>
													<td scope="row">
														<h4>
															<?php echo $fetch_playlist['playlist_name']; ?>
														</h4>
														</th>
													<td align="center">
														<form action="#" method="post">
															<input type="hidden"
																value="<?php echo $fetch_playlist['playlist_key']; ?>"
																name="playlist_key">
															<button type="submit" name="add_to_playlist"
																class="btn btn-primary"><i
																	class=" fas fa-plus-circle"></i></button>
														</form>
													</td>
												</tr>
												<?php
											}
											if (isset($_POST['add_to_playlist'])) {
												$playlist_key = $_POST['playlist_key'];
												$playlist_fetch = mysqli_fetch_assoc(mysqli_query($conn, "select * from playlist where playlist_key = '$playlist_key'"));
												$playlist_id = $playlist_fetch['id'];
												$insert_audio_to_playlist_query = "insert into `$playlist_key`(`playlist_id`, `audiobook_id`) values('$playlist_id', '$audiobook_id')";
												$insert_audio_to_playlist_query_run = mysqli_query($conn, $insert_audio_to_playlist_query);
												if($insert_audio_to_playlist_query_run){
													?>
													<script>
														alert("<?php echo $fetch['title']; ?> added to your playlist");
													</script>
													<?php 
												}
											}
											?>
										</tbody>
									</table>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary"
										data-bs-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary" data-bs-toggle="modal"
										data-bs-target="#newplaylistModal">Create New Playlist</button>
								</div>
							</div>
						</div>
					</div>
					<!--Playlist Modal End-->

					<!--New Playlist Modal -->
					<?php
					//Creating Playlist
					if (isset($_POST['create_playlist'])) {
						$playlist_name = $_POST['playlist_name'];
						$playlist_key = bin2hex(random_bytes(16));
						$create_playlist_query = "insert INTO `playlist`(`playlist_name`, `user_id`, `playlist_key`) VALUES ('$playlist_name','$user_id', '$playlist_key')";
						$create_playlist_query_run = mysqli_query($conn, $create_playlist_query);

						//Creating Playlist Table
						// $playlist_table_create_query = "select * from playlist where playlist_key = '$playlist_key' and user_id = '$user_id'";
						// $playlist_table_create_query_run = mysqli_query($conn, $playlist_table_create_query);
						// $playlist_table_fetch = mysqli_fetch_assoc($playlist_table_create_query_run);

						// $playlist_table_id = $playlist_table_fetch['id'];

						$create_playlist_table_query = "create TABLE `$playlist_key` (
										  `id` INT AUTO_INCREMENT PRIMARY KEY,
										  `playlist_id` INT,
										  `audiobook_id` INT
										)";
						$create_playlist_table_query_run = mysqli_query($conn, $create_playlist_table_query);
						if($create_playlist_table_query_run){
							?>
								<script>
									alert("Playlist Created!");
								</script>
							<?php
						}
					}
					?>
					<div class="modal fade" id="newplaylistModal" tabindex="-1" aria-labelledby="exampleModalLabel"
						aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="exampleModalLabel">Create New Playlist</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<form action="#" method="post">
									<div class="modal-body">
										<div class="mb-3">
											<input type="text" class="form-control" id="exampleFormControlInput1"
												name="playlist_name" placeholder="Enter Playlist Name" required>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary"
											data-bs-dismiss="modal">Close</button>
										<button class="btn btn-primary" type="submit"
											name="create_playlist">Create</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!--New Playlist Modal End-->

					<!--About Book-->
					<div class="col-12 col-lg-6 py-3">
						<div class="card shadow-sm">
							<div class="card-body">
								<center>
									<h5 class="card-title mb-3">
										<span class="card-title-text">About Book</span>
									</h5>
								</center>
								<p class="">
									<?php echo $fetch['description']; ?>
								</p>
							</div><!--//card-body-->
						</div><!--//card-->
					</div><!--//col-->



					<!--Read Summery-->
					<div class="col-12 col-lg-12 py-3" id="comment-section">
						<div class="card shadow-sm">
							<div class="card-body">
								<center>
									<h5 class="card-title mb-3">
										<span class="card-title-text">Read Summery</span>
									</h5>
								</center>
								<!--Read Summery Plan Wise-->
								<?php
								if (($fetch['is_paid'] == 0)) {
									?>
									<p class="">
										<?php echo $fetch['summary']; ?>
									</p>
									<?php
								} else if (($fetch['is_paid'] == 1) and (($plan == 1) or ($plan == 2))) {
									?>
										<p class="">
										<?php echo $fetch['summary']; ?>
										</p>
									<?php
								} else {
									?>
										<center><a href="premium.php" class="btn btn-danger"><i class="fas fa-gem"></i> You need
												to upgrade your plan to read this summery</a></center>
									<?php
								}
								?>
							</div><!--//card-body-->
						</div><!--//card-->
					</div><!--//col-->



					<!--Comment Section-->
					<?php
					$user_query = "select * from user where email = '$email'";
					$user_query_run = mysqli_query($conn, $user_query);
					$user_fetch = mysqli_fetch_assoc($user_query_run);
					$user_name = $user_fetch['name'];
					if (isset($_POST['post_comment'])) {
						$comment_message = $_POST['comment_message'];
						$insert_comment = "insert INTO `comment`(`user_id`, `audiobook_id`, `name`, `comment`) VALUES ('$user_id','$audiobook_id','$user_name','$comment_message')";
						$insert_comment_run = mysqli_query($conn, $insert_comment);

					}


					?>
					<div class="card shadow-0 border" style="background-color: #f0f2f5;" id="comment-section">
						<div class="card-body p-4">
							<!--Free users can't post comments on paid books-->
							<?php
							if (($fetch['is_paid'] == 0)) {
								?>
								<div class="form-outline mb-4">
									<center>
										<h5 class="card-title mb-3">
											<span class="card-title-text">Comment Section</span>
										</h5>
									</center>
									<form action="#" method="post">
										<textarea type="text" id="addANote" class="form-control"
											placeholder="Type comment..." name="comment_message" style="height: 100px;"
											required></textarea><br>
										<center><button class="btn btn-primary" type="submit" name="post_comment">Post
												Comment</button></center>
									</form>
								</div>
								<?php
							} else if (($fetch['is_paid'] == 1) and (($plan == 1) or ($plan == 2))) {
								?>
									<div class="form-outline mb-4">
										<center>
											<h5 class="card-title mb-3">
												<span class="card-title-text">Comment Section</span>
											</h5>
										</center>
										<form action="#" method="post">
											<textarea type="text" id="addANote" class="form-control"
												placeholder="Type comment..." name="comment_message" style="height: 100px;"
												required></textarea><br>
											<center><button class="btn btn-primary" type="submit" name="post_comment">Post
													Comment</button></center>
										</form>
									</div>
								<?php
							} else {
								?>
									<center><a href="premium.php" class="btn btn-danger"><i class="fas fa-gem"></i> You need to
											upgrade your plan to post comment in this audiobook</a></center>
								<?php
							}
							?>


							<?php

							$comment_query = "select * from comment where audiobook_id = '$audiobook_id' order by id desc";
							$comment_query_run = mysqli_query($conn, $comment_query);
							while ($comment_fetch = mysqli_fetch_assoc($comment_query_run)) {
								$comment_user_id = $comment_fetch['user_id'];
								$user_profile_query = "select profile_pic from user where id = '$comment_user_id'";
								$user_profile_query_run = mysqli_query($conn, $user_profile_query);
								$user_profile_query_fetch = mysqli_fetch_assoc($user_profile_query_run);
								?>
								<div class="card mb-4">
									<div class="card-body">
										<p>
											<?php echo $comment_fetch['comment']; ?>
										</p>
										<div class="d-flex justify-content-between">
											<div class="d-flex flex-row align-items-center">
												<p class="small mb-0 ms-2"><img
														src="assets/profile_pics/<?php echo $user_profile_query_fetch['profile_pic']; ?>"
														style="width:25px; border-radius:50%">&nbsp;<?php echo $comment_fetch['name']; ?></p>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
							?>



						</div>
					</div>


					<!--Comment End-->









				</div><!--//row-->
			</div><!--//container-->
		</div><!--//container-->
	</div><!--//page-content-->

	<footer class="footer">

		<div class="footer-bottom text-center py-5">




		</div>

	</footer>

	<!-- Javascript -->
	<script src="assets/plugins/popper.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	<!-- Page Specific JS -->
	<script src="assets/plugins/smoothscroll.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js"></script>
	<script src="assets/js/highlight-custom.js"></script>
	<script src="assets/plugins/simplelightbox/simple-lightbox.min.js"></script>
	<script src="assets/plugins/gumshoe/gumshoe.polyfills.min.js"></script>
	<script src="assets/js/docs.js"></script>


	<!--Down Nav-->
	<nav class="nav">
		<a href="dashboard.php" class="nav-link">
			<i class="fa fa-home"></i>
			<span class="nav-text">Dashboard</span>
		</a>

		<a href="premium.php" class="nav-link">
			<i class="fa fa-gem"></i>
			<span class="nav-text">Premium</span>
		</a>

		<a href="categories.php" class="nav-link">
			<i class="fa fa-align-justify"></i>
			<span class="nav-text">Category</span>
		</a>

		<a href="library.php" class="nav-link">
			<i class="far fa-list-alt"></i>
			<span class="nav-text">Library</span>
		</a>
	</nav>
</body>

</html>