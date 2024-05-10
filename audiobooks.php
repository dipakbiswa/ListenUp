<?php
session_start();
//Checking login or not
if (!isset($_SESSION['username'])) {
	header("location: login.php");
}

include 'dbcon.php';
if (isset($_GET['category_id'])) {
	$category_id = $_GET['category_id'];

} else {
	$category_id = "";
}

if (isset($_GET['search'])) {
	$search = $_GET['search'];
	$search_query = "select * from audiobook where title like '%$search%' or description like '%$search%' or artist_name like '%$search%'";
	$search_query_run = mysqli_query($conn, $search_query);

} else {
	$search = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>
		<?php
		if (isset($_GET['category_id'])) {
			echo $category_id;
		}
		if (isset($_GET['search'])) {
			echo $search;
		}
		?>
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

</head>

<body>
	<?php include 'header.php'; ?>




	<div class="page-content">
		<div class="container">
			<div class="docs-overview py-5">
				<div class="row justify-content-center">












					<h2 class="card-title mb-3">Audio Books</h2>
					<hr class="card-title mb-3">


					<!--Show by category -->
					<?php
					$category_query = "select * from audiobook where category_id = '$category_id'";
					$category_query_run = mysqli_query($conn, $category_query);
					while ($category_row = mysqli_fetch_assoc($category_query_run)) {
						?>
						<div class="col-12 col-lg-3 py-3">
							<div class="card shadow-sm">
								<div class="card-body">
									<center><img src="assets/banner/<?php echo $category_row['banner_name']; ?>"
											width="250px" style="border-radius: 10px; display: flex;"><br>
										<h5 class="card-title mb-3">
											<span class="card-title-text">
												<?php echo $category_row['title']; ?>
											</span>
										</h5>
										<span class="card-title-text">
											<?php echo " " . $category_row['artist_name']; ?>
										</span>
									</center>
									<a class="card-link-mask" href="play.php?link=<?php echo $category_row['link']; ?>"></a>
								</div><!--//card-body-->
							</div><!--//card-->
						</div><!--//col-->
					<?php
					}
					?>


					<!--Show by Search -->
					<?php
					if (isset($_GET['search'])) {
						while ($search_row = mysqli_fetch_assoc($search_query_run)) {
							?>
							<div class="col-12 col-lg-3 py-3">
								<div class="card shadow-sm">
									<div class="card-body">
										<center><img src="assets/banner/<?php echo $search_row['banner_name']; ?>" width="250px"
												style="border-radius: 10px; display: flex;"><br>
											<h5 class="card-title mb-3">
												<span class="card-title-text">
													<?php echo $search_row['title']; ?>
												</span>
											</h5>
											<span class="card-title-text">
												<?php echo " " . $search_row['artist_name']; ?>
											</span>
										</center>
										<a class="card-link-mask" href="play.php?link=<?php echo $search_row['link']; ?>"></a>
									</div><!--//card-body-->
								</div><!--//card-->
							</div><!--//col-->
						<?php
						}
					}
					?>





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