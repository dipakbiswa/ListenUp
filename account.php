<?php
session_start();
//Checking login or not
if (!isset($_SESSION['username'])) {
  header("location: login.php");
}
include 'dbcon.php';
$email = $_SESSION['email'];
$user_query = "select * from user where email = '$email'";
$user_query_run = mysqli_query($conn, $user_query);
$fetch_data = mysqli_fetch_assoc($user_query_run);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Account | ListenUp</title>

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



          <!--Play-->
          <div class="col-12 col-lg-6 py-3">
            <div class="card shadow-sm">
              <div class="card-body">
                <center>
                  <h4 class="card-title mb-3">
                    <span class="card-title-text">Account</span>
                  </h4>
                  <img src="assets/profile_pics/<?php echo $fetch_data['profile_pic']; ?>" width="150px"
                    style="border-radius: 500px; display: flex;"><br>
                </center>
                <h5 class="card-title mb-3">
                  <span class="card-title-text">Personal Info</span>
                  <hr>
                </h5>
                <span class="card-title-text"><b>Name:</b>
                  <?php echo $fetch_data['name']; ?>
                </span><br>
                <span class="card-title-text"><b>Email:</b>
                  <?php echo $fetch_data['email']; ?>
                </span>
                <br><br>


                <h5 class="card-title mb-3">
                  <span class="card-title-text">Member Plan</span>
                  <hr>
                </h5>
                <span class="card-title-text"><b>Plan:</b>
                  <?php
                  if ($fetch_data['plan'] == 0)
                    echo " Free Plan";
                  else if ($fetch_data['plan'] == 1)
                    echo " Monthly Plan";
                  else if ($fetch_data['plan'] == 2)
                    echo " Yearly Plan";
                  ?>
                </span><br>
                <span class="card-title-text"><b>Expiry Date:</b>
                  <?php echo $fetch_data['plan_expire']; ?>
                </span>
                <br><br>

                <center>
                  <a class="btn btn-danger" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                  <a class="btn btn-warning" href="edit_profile.php"><i class="fa-solid fa-pen-to-square"></i> Edit
                    Profile</a>
                  <a class="btn btn-primary" href="payment.php"><i class="fa-solid fa-gem"></i> Payment History</a>
                </center>

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

    <a href="categories.php" class="nav-link ">
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