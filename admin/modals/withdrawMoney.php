<?php
    include '../dbcon.php';
    $pay_date = date('d-M-Y');
    if(isset($_POST['withdraw'])){
        $artist_id = $_POST['artist_id'];
        $balance = $_POST['balance'];
        $yearMonth = $_POST['yearMonth'];
        $insert_query_run = mysqli_query($conn, "insert INTO `earnings_history`(`artist_id`, `balance`, `pay_date`, `yearMonth`) VALUES ('$artist_id', '$balance','$pay_date','$yearMonth')");
        
        if($insert_query_run){
            $update_earnings = "update `earnings` SET `balance`='0' WHERE artist_id = '$artist_id' and yearMonth = '$yearMonth'";
            $update_earnings_run = mysqli_query($conn, $update_earnings);
            die();
        }
    }
?>
<!-- Modal -->
<div class="modal fade" id="withdrawMoney<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label>Artist Name</label>
                        <input type="hidden" name="artist_id" value="<?php echo $row['artist_id']; ?>" class="form-control" required="required" />
                        <input type="text" name="name" value="<?php echo $user_name_fetch['name'] ?>" class="form-control" required="required" />
                    </div>
                    <div class="form-group">
                        <label>Artist Earnings</label>
                        <input type="number" name="balance" value="<?php echo $row['balance']?>" class="form-control" required="required" />
                    </div>
                    <div class="form-group">
                        <label>Month Year</label>
                        <input type="text" name="yearMonth" value="<?php echo $row['yearMonth']?>" class="form-control" required="required" />
                    </div>
                </div>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="withdraw" class="btn btn-primary">Withdraw Now</button>
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