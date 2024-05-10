<?php
session_start();
//Checking login or not
if (!isset($_SESSION['username'])) {
  header("location: login.php");
}
include 'dbcon.php';
$email = $_SESSION['email'];
$user_id = $_SESSION['id'];
$payment_query = "select * from payment where user_id = '$user_id' order by id desc";
$payment_query_run = mysqli_query($conn, $payment_query);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Payment | ListenUp</title>

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


    .table {
      width: 100%;
      border-collapse: collapse;
    }

    .table td,
    .table th {
      padding: 12px 15px;
      border: 1px solid #ddd;
      text-align: center;
      font-size: 16px;
    }

    .table th {
      background-color: #92c9e6;
      color: #ffffff;
    }

    .table tbody tr:nth-child(even) {
      background-color: #d1e8f5;
    }

    /*responsive*/

    @media (max-width: 500px) {
      .table thead {
        display: none;
      }

      .table,
      .table tbody,
      .table tr,
      .table td {
        display: block;
        width: 100%;
      }

      .table tr {
        margin-bottom: 15px;
      }

      .table td {
        padding-left: 50%;
        text-align: left;
        position: relative;
      }

      .table td::before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 15px;
        font-size: 15px;
        font-weight: bold;
        text-align: left;
      }
    }
  </style>

</head>

<body>
  <?php include 'header.php'; ?>



  <div class="page-content">
    <div class="container">
      <div class="docs-overview py-5">
        <div class="row justify-content-center">


          <div class="col-12 col-lg-9 py-3">
            <div class="card shadow-sm">
              <div class="card-body">
                <center>
                  <h4 class="card-title mb-3">
                    <span class="card-title-text">My Payment History</span>
                  </h4>
                  <hr>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Plan Name</th>
                        <th scope="col">Transaction Id</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th scope="col">Expire Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      while ($user_fetch = mysqli_fetch_assoc($payment_query_run)) { ?>
                        <tr>
                          <th scope="row">
                            <?php echo $i; ?>
                          </th>
                          <td>
                            <?php echo $user_fetch['plan_name']; ?>
                          </td>
                          <td>
                            <?php echo $user_fetch['transaction_id']; ?>
                          </td>
                          <td>₹
                            <?php echo $user_fetch['amount']; ?>
                          </td>
                          <td>
                            <?php echo $user_fetch['date']; ?>
                          </td>
                          <td>
                            <?php echo $user_fetch['next_payment']; ?>
                          </td>
                        </tr>
                        <?php $i++;
                      } ?>
                    </tbody>
                  </table>
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