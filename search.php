<?php
session_start();
//Checking login or not
if (!isset($_SESSION['username'])) {
  header("location: login.php");
}
include "dbcon.php";
if (isset($_POST['search_btn'])) {
  $search = $_POST['search'];
  header('location: audiobooks.php?search=' . $search);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Search | ListenUp</title>

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


  <div class="page-header theme-bg-dark py-5 text-center position-relative">
    <div class="theme-bg-shapes-right"></div>
    <div class="theme-bg-shapes-left"></div>
    <div class="container">
      <h1 class="page-heading single-col-max mx-auto">Search</h1>
      <div class="page-intro single-col-max mx-auto">Search Best Audiobooks.</div>
      <div class="main-search-box pt-3 d-block mx-auto">
        <form class="search-form w-100" action="#" method="post">
          <input type="text" placeholder="Search the best books..." name="search" class="form-control search-input">
          <button type="submit" class="btn search-btn" value="Search" name="search_btn"><i
              class="fas fa-search"></i></button>
        </form>
      </div>
    </div>
  </div><!--//page-header-->
  <div class="page-content">
    <div class="container">
      <div class="docs-overview py-5">
        <div class="row justify-content-center">
        </div>
      </div>
    </div>
  </div>

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