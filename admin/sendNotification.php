<?php session_start(); ?>

<?php 
    if (!isset($_SESSION['username'])) {
        header('location: login.php');
    }
	include '../dbcon.php';
    $name = $_SESSION['username'];
    if(isset($_POST['send'])){
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $insert_query_run = mysqli_query($conn, "insert INTO `notification`(`subject`, `message`, `published_by`) VALUES ('$subject','$message','$name')");
        if($insert_query_run){
            $message = "Notification Sent!";
        }
    }

    


?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Notifications</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="app-logo.png"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <style>
        .width-change{
            width: 800px;
            margin: auto;
        }
    </style>
</head> 

<body class="app">   	
    <?php include 'header.php'; ?>
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Send Notifications</h1>
				    </div>
			    </div><!--//row-->
			   
			    
			    
				
				
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
                                    <div class="width-change">
							        <center>
                                        <br>
                                        <br>
                                        <h3>Send Notification</h3>
                                        <p style="color:red;"><?php if(isset($message)){ echo $message; } ?></p>
                                        <form action="#" method="post">
                                            <div class="email mb-3">
                                                <label class="sr-only" for="signin-email">Subject</label>
                                                <input id="signin-email" name="subject" type="text" class="form-control signin-email" placeholder="Subject" required="required">
                                            </div>
                                            <div class="email mb-3">
                                                <textarea name="message" placeholder="Message" class="form-control signin-email"></textarea>
                                            </div>
                                            <div class="email mb-3">
                                                <button type="submit" name="send" class="btn btn-success">Send</button>
                                            </div>
                                        </form>
                                        <br>
                                        <br>
                                    </center>
                                    </div>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
					</div><!--//tab-pane-->			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
	   
	    
    </div><!--//app-wrapper-->    					

 
    <!-- Javascript -->          


    

    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  
    
    
    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 

</body>
</html> 

