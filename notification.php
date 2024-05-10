<?php
session_start();
include 'dbcon.php';
//Checking login or not
if (!isset($_SESSION['username'])) {
  header("location: login.php");
}
$notification_query = "select * from notification";
$notification_query_run = mysqli_query($conn, $notification_query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Notification | ListenUp</title>

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
  </style>

</head>

<body>
  <?php include 'header.php'; ?>

  <div class="page-content">
    <div class="container">
      <div class="docs-overview py-5">
        <div class="row justify-content-center">



          <!--Comment Section-->
          <div class="card shadow-0 border" style="background-color: #f0f2f5;" id="comment-section">
            <div class="card-body p-4">
              <div class="form-outline mb-4">
                <center>
                  <h5 class="card-title mb-3">
                    <span class="card-title-text">Notification</span>
                  </h5>
                </center>
              </div>


              <?php
              if (mysqli_num_rows($notification_query_run) == 0) {
                ?>
                <div class="card mb-4">
                  <div class="card-body">
                    <center>
                      <h5 style="color: red;">No Notification</h5>
                    </center>
                  </div>
                </div>
                <?php
              } else {
                while ($row = mysqli_fetch_assoc($notification_query_run)) { ?>
                  <div class="card mb-4">
                    <div class="card-body">
                      <h5>
                        <?php echo $row['subject']; ?>
                      </h5>
                      <hr>
                      <p>
                        <?php echo $row['message']; ?>
                      </p>
                      <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                          <p class="small mb-0 ms-2">From:
                            <?php echo $row['published_by']; ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php }
              } ?>



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