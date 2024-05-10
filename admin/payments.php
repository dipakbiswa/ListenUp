<?php session_start(); ?>

<?php 
    if (!isset($_SESSION['username'])) {
        header('location: login.php');
    }
	include '../dbcon.php';

    


?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Payments</title>
    
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

</head> 

<body class="app">   	
    <?php include 'header.php'; ?>
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Payments</h1>
				    </div>
				    
			    </div><!--//row-->
			   
			    
			    
				
				
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr align="center">
												<th class="cell">Id</th>
                                                <th class="cell">User Name</th>
												<th class="cell">Transaction Id</th>
												<th class="cell">Amount</th>
												<th class="cell">Plan Name</th>
												<th class="cell">Date</th>
												<th class="cell">Next Payment</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query_run = mysqli_query($conn, "select * from payment order by id desc");
											while($row = mysqli_fetch_assoc($query_run)){
                                                $user_name_fetch = mysqli_fetch_assoc(mysqli_query($conn, "select * from user where id = ".$row['user_id']));
                                                ?>
											<tr align="center">
												<td class="cell"><?php echo $row['id']; ?></td>
												<td class="cell"><?php echo $user_name_fetch['name']; ?></td>
												<td class="cell"><?php echo $row['transaction_id']; ?></td>
												<td class="cell"><?php echo $row['amount']; ?></td>
												<td class="cell"><?php echo $row['plan_name']; ?></td>
												<td class="cell"><?php echo $row['date']; ?></td>
												<td class="cell"><span class="badge bg-danger"><?php echo $row['next_payment']; ?></span></td>
											</tr>
											<?php
											}
											?>	
										</tbody>
									</table>
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

