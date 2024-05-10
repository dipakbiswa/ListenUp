<?php
session_start();
//Checking login or not
if (!isset($_SESSION['username'])) {
	header("location: login.php");
}
include 'dbcon.php';
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Playlist Audiobooks | ListenUp</title>

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
	</style>

</head>

<body>
	<?php include 'header.php'; ?>




	<div class="page-content">
		<div class="container">
			<div class="docs-overview py-5">
				<div class="row justify-content-center">

					<?php
					if (isset($_GET['playlist'])) {
						$playlist = $_GET['playlist'];
						$query = "select * from `audiobook` inner join `$playlist` on audiobook.id = `$playlist`.audiobook_id";
						$query_run = mysqli_query($conn, $query);
					}

					?>

					<h2 class="card-title mb-3">Playlist Audiobooks</h2>
					<hr class="card-title mb-3">


					<div class="col-12 col-lg-12 py-3">
						<div class="card shadow-sm">
							<div class="card-body">
								<table class="table table-striped">
									<thead>
										<tr>
											<th scope="col" width="10%">Banner</th>
											<th scope="col" width="80%">Audiobook</th>
											<th scope="col" width="10%">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										while ($fetch_data = mysqli_fetch_assoc($query_run)) {
											?>
											<tr>
												<th scope="row">
													<a href="play.php?link=<?php echo $fetch_data['link']; ?>"><img
															src="assets/banner/<?php echo $fetch_data['banner_name']; ?>"
															class="img-fluid" width="30px">
													</a>
												</th>
												<td>
													<a href="play.php?link=<?php echo $fetch_data['link']; ?>"
														style="text-decoration: none;">
														<?php echo $fetch_data['title']; ?>
													</a>
												</td>
												<td>
													<form action="#" method="post">
														<input type="hidden" value="<?php echo $fetch_data['id']; ?>"
															name="audio_id">
														<button type="submit" class="btn btn-danger" name="delete"><i
																class="fas fa-trash"></i></button>
													</form>
												</td>
											</tr>
										<?php
										}
										if (isset($_POST['delete'])) {
											$audio_id = $_POST['audio_id'];
											$delete_query = "delete FROM `$playlist` WHERE `id` = '$audio_id'";
											$delete_query_run = mysqli_query($conn, $delete_query);
											if ($delete_query_run) {
												?>
												<script type="text/javascript">
													alert("Audiobook deleted from playlist");
													window.location.replace("library.php");
												</script>
												<?php
											}
										}
										?>
									</tbody>
								</table>
							</div><!--//card-body-->
						</div><!--//card-->
					</div><!--//col-->











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