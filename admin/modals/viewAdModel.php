<!-- Modal -->
<div class="modal fade" id="ViewAdModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">View Ad</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="#" method="post">
                <div class="col-md-8">
                    <center>
                        <img src="../advertiser/ads_banner/<?php echo $row['image_name']; ?>" alt="user profile" style=" width: 480px;">
                        <br>
                        <h3><?php echo $row['name']; ?></h3>
                        <p><?php echo $row['description']; ?></p>
                        <p><a href="<?php echo $row['website']; ?>" target="_blank"><?php echo $row['website']; ?></a></p>
                    </center>
                </div>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="submit" name="save" class="btn btn-primary">Save changes</button> -->
                </div>
                </div>
            </form>
            </div>
        </div>
        <div class="modal-footer">
            
        </div>
        </div>
    </div>
</div>
<?php
    include '../dbcon.php';
    if(isset($_POST['save'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $website = $_POST['website'];
        $status = $_POST['status'];
        $update_query_run = mysqli_query($conn, "update `ads` SET `name`='$name',`description`='$description',`website`='$website', `status`='$status' WHERE id = '$id'");
        if($update_query_run){
            // header("location: ads.php");
        }
    }
?>
