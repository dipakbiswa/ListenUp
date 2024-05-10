<!-- Modal -->
<div class="modal fade" id="UpdateAdModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Ad</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="#" method="post">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="hidden" name="id" value="<?php echo $row['id']?>"/>
                        <input type="text" name="name" value="<?php echo $row['name']?>" class="form-control" required="required"/>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="description" value="<?php echo $row['description']?>" class="form-control" required="required" />
                    </div>
                    <div class="form-group">
                        <label>Website</label>
                        <input type="url" name="website" value="<?php echo $row['website']?>" class="form-control" required="required"/>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="" required>
                            <option value="0">Pending approve</option>
                            <option value="1">Approve</option>
                            <option value="2">Disapprove</option>
                        </select>
                    </div>
                </div>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="save" class="btn btn-primary">Save changes</button>
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
