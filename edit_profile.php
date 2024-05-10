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

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    

    if(!empty($_FILES['image']['tmp_name'])){

        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $dest_path = "assets/profile_pics/";
        $target_file = $dest_path . $image_name;

        if (($extension == 'png') or ($extension == 'jpg') or ($extension == 'jpeg')) {
            $update_query = "update `user` SET `name`='$name',`email`='$email',`profile_pic`='$image_name' WHERE id = '$id'";
            $update_query_run = mysqli_query($conn, $update_query);
            if ($update_query_run and move_uploaded_file($image_tmp, $target_file)) {
                $message = "Profile updated!";
            } else {
                $message = "Somethings went wrong!";
            }
        } else {
            $message = "Please upload one .png, .jpg and .jpeg files!";
        }
    }
    else{
        $update_query = "update `user` SET `name`='$name',`email`='$email' WHERE id = '$id'";
        $update_query_run = mysqli_query($conn, $update_query);
        if ($update_query_run) {
            $message = "Profile updated!";
        } else {
                $message = "Somethings went wrong!";
        }
    }
}
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




        .p-image {
            position: absolute;
            top: 167px;
            right: 250px;
            color: #28b76b;
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        }
        .p-image:hover {
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        }
        .upload-button {
            font-size: 1.2em;
        }

        .upload-button:hover {
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
            color: #999;
        }

        .file-upload {
            display: none;
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
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <center>
                                        <h4 class="card-title mb-3">
                                            <span class="card-title-text">Edit Profile</span>
                                        </h4>
                                        <?php
                                        if (isset($message)) {
                                            ?>
                                            <span style="color: red;">
                                                <?php echo $message; ?>
                                            </span>
                                            <?php
                                        }
                                        ?>
                                    </center>
                                    <center>
                                        <div class="mb-3">
                                            <img id="output" style="width: 130px; border-radius:50%;"
                                                src="assets/profile_pics/<?php echo $fetch_data['profile_pic'] ?>" /><br>
                                            <div class="p-image">
                                                <label for="imageUpload"><i class="fa fa-camera upload-button"></i></label>
                                                <input type="file" class="file-upload" id="imageUpload" accept=".png, .jpg, .jpeg" name="image"
                                                onchange="loadFile(event)">
                                            </div>
                                        </div>
                                    </center>
                                    <div class="mb-3">
                                        <input type="text" name="name" class="form-control" placeholder="Name"
                                            value="<?php echo $fetch_data['name'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            value="<?php echo $fetch_data['email'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" name="id" class="form-control" placeholder="id"
                                            value="<?php echo $fetch_data['id'] ?>" required>
                                    </div>
                                    <br>
                                    <div class="mb-3">
                                        <button type="submit" name="update" class="btn btn-primary"
                                            style="width: 100%;">Update Profile</button>
                                    </div>
                                </form>
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

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>


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
    <script>
        var loadFile = function (event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

    </script>
</body>

</html>