<?php
session_start();
//Checking login or not
if (!isset($_SESSION['username'])) {
	header("location: login.php");
}
include 'dbcon.php';
$user_id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Dashboard | ListenUp</title>

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



	<!--Slider-->
	<div id="carouselExampleIndicators" class="carousel slide">
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
				aria-current="true" aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
				aria-label="Slide 2"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
				aria-label="Slide 3"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
				aria-label="Slide 4"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"
				aria-label="Slide 5"></button>
			
		</div>

		<div class="carousel-inner">
			<?php
			$slideshow_query = "select * from slideshow";
			$slideshow_query_run = mysqli_query($conn, $slideshow_query);
			while ($slideshow_row = mysqli_fetch_assoc($slideshow_query_run)) {
				?>
				<div class="carousel-item active">

					<img src="<?php echo "assets/slideshow_images/" . $slideshow_row['image_name']; ?>" class="d-block w-100">

				</div>
				<?php
			}
			?>
		</div>

		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
			data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
			data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>
	<!--Slider end-->






	<div class="page-content">
		<div class="container">
			<div class="docs-overview py-5">
				<div class="row justify-content-center">


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

					<!--Plan expired Notification-->
					<?php
					if ($_SESSION['plan_expired'] == 1) { ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Hello,
								<?php echo $_SESSION['username']; ?>!
							</strong> Your paid plan has been expired please <a herf="premium.php">renew</a> your plan.
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					<?php } ?>


					<h3 class="card-title mb-3">Audio Books</h3>
					<hr class="card-title mb-3">


					<?php
					$free_query = "select * from audiobook where is_paid = 0 order by id desc";
					$free_query_run = mysqli_query($conn, $free_query);
					while ($free_row = mysqli_fetch_assoc($free_query_run)) {
						?>
						<div class="col-12 col-lg-3 py-3">
							<div class="card shadow-sm">
								<div class="card-body">
									<center><img src="assets/banner/<?php echo $free_row['banner_name']; ?>" width="250px"
											style="border-radius: 10px; display: flex;"><br>
										<h5 class="card-title mb-3">
											<!--<span class="theme-icon-holder card-icon-holder me-2">
										<i class="fas fa-map-signs"></i>
									</span>//card-icon-holder-->
											<span class="card-title-text">
												<?php echo $free_row['title']; ?>
											</span>
										</h5>
										<span class="card-title-text">
											<?php echo " " . $free_row['artist_name']; ?>
										</span>
									</center>
									<a class="card-link-mask" href="play.php?link=<?php echo $free_row['link']; ?>"></a>
								</div><!--//card-body-->
							</div><!--//card-->
						</div><!--//col-->
						<?php
					}
					?>





					<h3 class="card-title mb-3">New Premium Summaries...</h3>
					<hr class="card-title mb-3">

					<?php
					$paid_query = "select * from audiobook where is_paid = 1 order by id desc";
					$paid_query_run = mysqli_query($conn, $paid_query);
					while ($paid_row = mysqli_fetch_assoc($paid_query_run)) {
						?>
						<div class="col-12 col-lg-3 py-3">
							<div class="card shadow-sm">
								<div class="card-body">
									<center><img src="assets/banner/<?php echo $paid_row['banner_name']; ?>" width="250px"
											style="border-radius: 10px; display: flex;"><br>
										<h5 class="card-title mb-3">
											<!--<span class="theme-icon-holder card-icon-holder me-2">
										<i class="fas fa-map-signs"></i>
									</span>//card-icon-holder-->
											<span class="card-title-text"><i class="fa fa-gem"></i>
												<?php echo " " . $paid_row['title']; ?>
											</span>
										</h5>
										<span class="card-title-text">
											<?php echo " " . $paid_row['artist_name']; ?>
										</span>
									</center>
									<a class="card-link-mask" href="play.php?link=<?php echo $paid_row['link']; ?>"></a>
								</div><!--//card-body-->
							</div><!--//card-->
						</div><!--//col-->
						<?php
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


			<ul class="social-list list-unstyled pb-4 mb-0">
				<li class="list-inline-item"><a href="#"><i class="fab fa-github fa-fw"></i></a></li>
				<li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
				<li class="list-inline-item"><a href="#"><i class="fab fa-slack fa-fw"></i></a></li>
				<li class="list-inline-item"><a href="#"><i class="fab fa-product-hunt fa-fw"></i></a></li>
				<li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f fa-fw"></i></a></li>
				<li class="list-inline-item"><a href="#"><i class="fab fa-instagram fa-fw"></i></a></li>
			</ul><!--//social-list-->

			<small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart"
					style="color: #fb866a;"></i> by KGEI Students </small>


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
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
		integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js"
		integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i"
		crossorigin="anonymous"></script>


	<!--Down Nav-->
	<nav class="nav">
		<a href="dashboard.php" class="nav-link active">
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