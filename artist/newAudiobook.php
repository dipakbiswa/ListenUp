<?php
session_start();
//Checking Session set or not
if (!isset($_SESSION['artist_email'])) {
    header("location: login.php");
}
include '../dbcon.php';
$artist_id = $_SESSION['artist_id'];
$artist_name = $_SESSION['artist_username'];
if (isset($_POST['upload'])) {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $category = $_POST['category'];
    $summary = $_POST['summary'];
    //Image
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    // Get Image Dimension
    $fileinfo = @getimagesize($image_tmp);
    $width = $fileinfo[0];
    $height = $fileinfo[1];
    $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $image_destination = "../assets/banner/";
    $image_file_path = $image_destination . $image_name;
    //Audio
    $audio_name = $_FILES['audio']['name'];
    $audio_tmp = $_FILES['audio']['tmp_name'];
    $audio_size = $_FILES['audio']['size'];
    $auido_extension = strtolower(pathinfo($audio_name, PATHINFO_EXTENSION));
    $audio_destination = "../assets/audio/";
    $audio_file_path = $audio_destination . $audio_name;

    //Is paid or not
    $isPaid = $_POST['isPaid'];

    //Link Generation
    $link = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name))) . time();

    //Qurery Run
    if($audio_size > 35000000){
        $message = "Audio size exceeds 35MB";
    }
    else{
        if($width != "500" and $height != "500"){
            $message = "Image size must be 500x500";
        }
        else{
            $insert_query = "insert INTO `audiobook`(`title`, `description`, `artist_name`, `category_id`, `summary`, `link`, `banner_name`, `audio_name`, `artist_id`, `is_paid`) VALUES ('$name','$desc','$artist_name','$category','$summary','$link','$image_name','$audio_name','$artist_id','$isPaid')";
            $insert_query_run = mysqli_query($conn, $insert_query);
            if ($insert_query_run and move_uploaded_file($image_tmp, $image_file_path) and move_uploaded_file($audio_tmp, $audio_file_path)) {
                $message = "Your audiobook has been uploaded!";
            } else {
                $message = "Somethings went wrong. Try after some times!";
            }
        }
    }

    
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v5.8.4, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <meta name="description" content="">


    <title>New Audiobook</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,700;1,400;1,700&display=swap&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,700;1,400;1,700&display=swap&display=swap">
    </noscript>
    <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">




</head>

<body>

    <?php include 'nav.php'; ?>

    <section data-bs-version="5.1" class="form7 cid-tB8hj1q9O1" id="form7-b">


        <div class="container">
            <div class="mbr-section-head">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                    <strong>Upload New Audiobook</strong>
                </h3>

            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                    <form action="#" method="post" enctype="multipart/form-data"
                        class="mbr-form form-with-styler mx-auto">
                        <p class="mbr-text mbr-fonts-style align-center mb-4 display-7">
                            Fill this form up to upload new audiobook</p>
                        <p class="mbr-text mbr-fonts-style align-center mb-4 display-7" style="color: red;">
                            <?php if (isset($message)) {
                                echo $message;
                            } ?>
                        </p>
                        <div class="dragArea row">
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="name">
                                Audiobook Name: <input type="text" name="name" placeholder="Audiobook Name"
                                    data-form-field="name" class="form-control" value="" id="name-form7-b" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="email">
                                Description: <textarea name="desc" id="desc" placeholder="Description"
                                    data-form-field="email" class="form-control" value="" required></textarea>
                            </div>
                            <div data-for="phone" class="col-lg-12 col-md-12 col-sm-12 form-group mb-3">
                                Category: <select class="form-control" name="category" placeholder="Category" required>
                                    <?php
                                    $category_query = "select * from category";
                                    $category_query_run = mysqli_query($conn, $category_query);
                                    while ($row = mysqli_fetch_assoc($category_query_run)) { ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="email">
                                Summary: <textarea name="summary" id="summary" placeholder="Summary"
                                    data-form-field="email" class="form-control" value="" required></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="name">
                                <center><img id="output" style="width: 150px;" /></center><br>
                                Banner: <input type="file" accept=".png, .jpg, .jpeg" name="image" placeholder="Banner"
                                    onchange="loadFile(event)" data-form-field="name" class="form-control" value=""
                                    id="name-form7-b" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3" data-for="name">
                                Audio: <input type="file" accept=".mp3" name="audio" placeholder="Audio"
                                    data-form-field="name" class="form-control" value="" id="name-form7-b" required>
                            </div>
                            <div data-for="phone" class="col-lg-12 col-md-12 col-sm-12 form-group mb-3">
                                For: <select class="form-control" placeholder="Category" name="isPaid" required>
                                    <option value="0">All users</option>
                                    <option value="1">Only for paid users</option>
                                </select>
                            </div>
                            <div class="col-auto mbr-section-btn align-center">
                                <button type="submit" name="upload" class="btn btn-primary display-4">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/smoothscroll/smooth-scroll.js"></script>
    <script src="assets/ytplayer/index.js"></script>
    <script src="assets/dropdown/js/navbar-dropdown.js"></script>
    <script src="assets/theme/js/script.js"></script>
    <script src="assets/formoid/formoid.min.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('summary');
        CKEDITOR.replace('desc');
    </script>
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