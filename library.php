<?php
session_start();
//Checking login or not
if (!isset($_SESSION['username'])) {
	header("location: login.php");
}
include 'dbcon.php';
$email = $_SESSION['email'];
$user_id = $_SESSION['id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Library | ListenUp</title>

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

	<style type="text/css">
		/* Style the tab */
		.tab {
			overflow: hidden;
			border: 1px solid #ccc;
			background-color: #f1f1f1;
			align-content: center;
		}

		/* Style the buttons that are used to open the tab content */
		.tab button {
			background-color: inherit;
			float: left;
			border: none;
			outline: none;
			cursor: pointer;
			padding: 14px 16px;
			transition: 0.3s;
		}

		/* Change background color of buttons on hover */
		.tab button:hover {
			background-color: #ddd;
		}

		/* Create an active/current tablink class */
		.tab button.active {
			background-color: #ccc;
		}

		/* Style the tab content */
		.tabcontent {
			display: none;
			padding: 6px 12px;
			border: 1px solid #ccc;
			border-top: none;
		}
	</style>
	<script type="text/javascript">
		function openCity(evt, cityName) {
			// Declare all variables
			var i, tabcontent, tablinks;

			// Get all elements with class="tabcontent" and hide them
			tabcontent = document.getElementsByClassName("tabcontent");
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}

			// Get all elements with class="tablinks" and remove the class "active"
			tablinks = document.getElementsByClassName("tablinks");
			for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" active", "");
			}

			// Show the current tab, and add an "active" class to the button that opened the tab
			document.getElementById(cityName).style.display = "block";
			evt.currentTarget.className += " active";
		}
	</script>

</head>

<body>
	<?php include 'header.php'; ?>

	<div class="page-content">
		<div class="container">
			<div class="docs-overview py-5">
				<div class="row justify-content-center">




					<h2 class="card-title mb-3">My Library</h2>
					<hr class="card-title mb-3">

					<!-- Tab links -->
					<div class="tab">
						<button class="tablinks" onclick="openCity(event, 'favorite')">Favourites</button>
						<button class="tablinks" onclick="openCity(event, 'playlist')">Playlists</button>
						<button class="tablinks" onclick="openCity(event, 'liked')">Liked</button>
					</div>

					<!-- Tab content -->
					<!--Favourite-->
					<div id="favorite" class="tabcontent">
						<h3>My Favourites</h3>
						<hr class="card-title mb-3">
						<div class="row justify-content-center">

							<?php
							$favourite_query = "select * from `audiobook` inner join `favourite` on audiobook.id = favourite.audiobook_id where favourite.user_id='$user_id'";
							$favourite_query_run = mysqli_query($conn, $favourite_query);
							$favourite_row = mysqli_num_rows($favourite_query_run);
							if ($favourite_row == 0) {
								$favourite_status = "No books in your favourite section!";
							} else {
								while ($favourite_row = mysqli_fetch_assoc($favourite_query_run)) {
									?>
									<!--Book-->
									<div class="col-12 col-lg-3 py-3">
										<div class="card shadow-sm">
											<div class="card-body">
												<center><img src="assets/banner/<?php echo $favourite_row['banner_name']; ?>"
														width="250px" style="border-radius: 10px; display: flex;"><br>
													<h5 class="card-title mb-3">
														<span class="card-title-text">
															<?php echo $favourite_row['title']; ?>
														</span>
													</h5>
												</center>
												<a class="card-link-mask"
													href="play.php?link=<?php echo $favourite_row['link']; ?>"></a>
											</div><!--//card-body-->
										</div><!--//card-->
									</div><!--//col-->
									<!--Book End-->
									<?php
								}
							}
							?>
							<center>
								<h5 style="color: red;">
									<?php if (isset($favourite_status)) {
										echo $favourite_status;
									} ?>
								</h5>
							</center>

						</div>
					</div>
					<!--Favourite end-->

					<!--Playlist-->
					<div id="playlist" class="tabcontent">
						<h3>My Playlists</h3>
						<hr class="card-title mb-3">
						<div class="row justify-content-center">
							<?php
							$playlist_query = "select * from playlist where user_id = '$user_id'";
							$playlist_query_run = mysqli_query($conn, $playlist_query);

							?>
							<table class="table table-striped" align="center">
								<tbody>
									<?php
									while ($fetch_playlist = mysqli_fetch_assoc($playlist_query_run)) {
										?>
										<tr align="center">

											<td scope="row" width="95%">
												<a href="show_playlist.php?playlist=<?php echo $fetch_playlist['playlist_key']; ?>"
													style="text-decoration: none; width: 100%;" class="btn btn-primary">
													<?php echo $fetch_playlist['playlist_name']; ?>
												</a>
											</td>
											<td scope="row" width="5%">
												<form action="#" method="post">
													<input type="hidden" value="<?php echo $fetch_playlist['playlist_key']; ?>"
														name="playlist_key">
													<button type="submit" name="delete_playlist" class="btn btn-danger">
														<i class="fas fa-trash"></i>
													</button>
												</form>
											</td>
										</tr>
									<?php
									}
									if (isset($_POST['delete_playlist'])) {
										$playlist_key = $_POST['playlist_key'];
										$playlist_delete_query = "delete from `playlist` where playlist_key = '$playlist_key'";
										$playlist_delete_query_run = mysqli_query($conn, $playlist_delete_query);
										$drop_playlist_query = "drop table `$playlist_key`";
										$drop_playlist_query_run = mysqli_query($conn, $drop_playlist_query);
										if ($playlist_delete_query_run and $drop_playlist_query_run) {
											?>
											<script type="text/javascript">
												alert("Playlist Deleted!");
												window.location.replace("library.php");
											</script>
											<?php
										}
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<!--Playlist end-->

					<!--Like-->
					<div id="liked" class="tabcontent">
						<h3>My Liked</h3>
						<hr class="card-title mb-3">
						<div class="row justify-content-center">


							<?php
							$like_query = "select * from `audiobook` inner join `like` on audiobook.id = like.audiobook_id where like.user_id = '$user_id'";
							$like_query_run = mysqli_query($conn, $like_query);
							$like_row = mysqli_num_rows($like_query_run);
							if ($like_row == 0) {
								$like_status = "No books in your like section";
							} else {
								while ($like_row = mysqli_fetch_assoc($like_query_run)) {
									?>
									<!--Book-->
									<div class="col-12 col-lg-3 py-3">
										<div class="card shadow-sm">
											<div class="card-body">
												<center><img src="assets/banner/<?php echo $like_row['banner_name']; ?>"
														width="250px" style="border-radius: 10px; display: flex;"><br>
													<h5 class="card-title mb-3">
														<span class="card-title-text">
															<?php echo $like_row['title']; ?>
														</span>
													</h5>
												</center>
												<a class="card-link-mask"
													href="play.php?link=<?php echo $like_row['link']; ?>"></a>
											</div><!--//card-body-->
										</div><!--//card-->
									</div><!--//col-->
									<!--Book End-->
									<?php
								}
							}
							?>
							<center>
								<h5 style="color: red;">
									<?php if (isset($like_status)) {
										echo $like_status;
									} ?>
								</h5>
							</center>

						</div>
					</div>
					<!--Like End-->
					<!--End Tabs-->











				</div><!--//row-->
			</div><!--//container-->
			



			<!-- Banner Ad-->
			<?php
			if($_SESSION['plan'] == 0){
			?>
				<center>
					Advertisement | <a href="premium.php" style="text-decoration:none;">Remove ad</a>
					<?php
						$fetch_ad_query = "select * from ads where status = 1 ORDER BY rand() LIMIT 1";
						$fetch_ad_query_run = mysqli_query($conn, $fetch_ad_query);

						$fetch_ad = mysqli_fetch_assoc($fetch_ad_query_run);
						$advertiser_id = $fetch_ad['advertiser_id'];
						$ad_id = $fetch_ad['id'];
										
						$fetch_balance = mysqli_fetch_assoc(mysqli_query($conn, "select * from balance where user_id = '$advertiser_id'"));
						if($fetch_balance['balance'] >= $fetch_ad['ad_cost']){
							echo "<form method='post'><a href='adClicked.php?ad_id=".$ad_id."&advertiser_id=".$advertiser_id."' name='adClicked'><img src='advertiser/ads_banner/".$fetch_ad['image_name']."' class='img-fluid' style='border:1px solid black' width='728' height='90'></a></form>";
						}							
					?>
				</center>
				<br><br>
			<?php
			}
			?>
			<!-- Banner Ad end -->



		</div><!--//container-->
	</div><!--//page-content-->

	<!--<section class="cta-section text-center py-5 theme-bg-dark position-relative">
		<div class="theme-bg-shapes-right"></div>
		<div class="theme-bg-shapes-left"></div>
		<div class="container">
			<h3 class="mb-2 text-white mb-3">Launch Your Software Project Like A Pro</h3>
			<div class="section-intro text-white mb-3 single-col-max mx-auto">Want to launch your software project and start getting traction from your target users? Check out our premium <a class="text-white" href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/coderpro-bootstrap-5-startup-template-for-software-projects/">Bootstrap 5 startup template CoderPro</a>! It has everything you need to promote your product.</div>
			<div class="pt-3 text-center">
				<a class="btn btn-light" href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/coderpro-bootstrap-5-startup-template-for-software-projects/">Get CoderPro<i class="fas fa-arrow-alt-circle-right ml-2"></i></a>
			</div>
		</div>
	</section>//cta-section-->

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

		<a href="categories.php" class="nav-link ">
			<i class="fa fa-align-justify"></i>
			<span class="nav-text">Category</span>
		</a>

		<a href="library.php" class="nav-link active">
			<i class="far fa-list-alt"></i>
			<span class="nav-text">Library</span>
		</a>
	</nav>
</body>

</html>