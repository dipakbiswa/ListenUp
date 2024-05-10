<?php
session_start();
//Checking Session set or not
if (!isset($_SESSION['artist_email'])) {
    header("location: login.php");
}
include '../dbcon.php';
$email = $_SESSION['artist_email'];
$artist_id = $_SESSION['artist_id'];

if (isset($_POST['delete'])) {
    $audiobook_id = $_POST['audiobook_id'];
    $fetch_query = "select * from audiobook where id = '$audiobook_id'";
    $fetch_query_run = mysqli_query($conn, $fetch_query);
    $fetch_data = mysqli_fetch_assoc($fetch_query_run);
    $audio_name = $fetch_data['audio_name'];
    $delete_status = unlink("../assets/audio/" . $audio_name);

    $delete_query = "delete FROM `audiobook` WHERE id = '$audiobook_id'";
    $delete_query_run = mysqli_query($conn, $delete_query);
    if ($delete_query_run and $delete_status) {
        $message = "Audiobook deleted!";
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


    <title>My Audiobooks</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
        integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
        integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
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
    <section data-bs-version="5.1" class="people5 mbr-embla cid-tB8f36WyTx" id="people5-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-md-12 col-lg-10">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-5">
                        <strong>My Audiobooks</strong>
                    </h3>
                </div>
                <center>
                    <p style="color: red;">
                        <?php if (isset($message)) {
                            echo $message;
                        } ?>
                    </p>
                </center>
            </div>
        </div>
        <div class="position-relative text-center">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Banner</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Plays</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $audiobook_query = "select * from audiobook where artist_id = '$artist_id'";
                    $audiobook_query_run = mysqli_query($conn, $audiobook_query);
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($audiobook_query_run)) {
                        $audiobook_id = $row['id'];
                        $play_count_query = "select * from play where artist_id = '$artist_id' and audiobook_id = '$audiobook_id'";
                        $play_count_query_run = mysqli_query($conn, $play_count_query);
                        $play_count = mysqli_num_rows($play_count_query_run);

                        //Fetching category name using category id
                        $category_id = $row['category_id'];
                        $category_name_query = "select * from category where id = $category_id";
                        $category_name_query_run = mysqli_query($conn, $category_name_query);
                        $category_name_fetch = mysqli_fetch_assoc($category_name_query_run);
                        ?>
                        <tr align="center">
                            <th scope="row">
                                <?php echo $count; ?>
                            </th>
                            <td>
                                <img src="<?php echo "../assets/banner/".$row['banner_name']; ?>" style="width: 50px; border-radius:3px;">
                            </td>
                            <td>
                                <?php echo $row['title']; ?>
                            </td>
                            <td>
                                <?php echo $category_name_fetch['name']; ?>
                            </td>
                            <td>
                                <?php echo $play_count; ?>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="editAudiobook.php?audiobook-id=<?php echo $row['id']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"> <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/> <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/> </svg>
                                </a>
                            </td>
                            <td>
                                <form action="#" method="post">
                                    <input type="hidden" name="audiobook_id" value="<?php echo $row['id']; ?>">
                                    <button name="delete" class="btn btn-danger"><svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" fill="white"></path> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" fill="white"></path> </svg></button>
                                </form>
                            </td>
                        </tr>
                        <?php $count++;
                    } ?>
                </tbody>
            </table>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/smoothscroll/smooth-scroll.js"></script>
    <script src="assets/ytplayer/index.js"></script>
    <script src="assets/dropdown/js/navbar-dropdown.js"></script>
    <script src="assets/theme/js/script.js"></script>


</body>

</html>