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
    <title>Ads</title>
    
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
			            <h1 class="app-page-title mb-0">Ads</h1>
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
                                                <th class="cell">Ad</th>
												<th class="cell">Name</th>
												<th class="cell">Description</th>
												<th class="cell">Advertiser</th>
												<th class="cell">Website/URL</th>
												<th class="cell">CPC</th>
												<th class="cell">Total Cost</th>
                                                <th class="cell">Clicks</th>
                                                <th class="cell">Status</th>
												<th class="cell">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query_run = mysqli_query($conn, "select * from ads order by id desc");
											while($row = mysqli_fetch_assoc($query_run)){
                                                $category_name_fetch = mysqli_fetch_assoc(mysqli_query($conn, "select * from user where id = ".$row['advertiser_id']));
                                                ?>
											<tr align="center">
												<td class="cell"><?php echo $row['id']; ?></td>
												<td class="cell"><img src="../advertiser/ads_banner/<?php echo $row['image_name']; ?>" alt="user profile" style="height: 50px; width: 50px;"></td>
												<td class="cell"><?php echo $row['name']; ?></td>
												<td class="cell"><?php echo $row['description']; ?></td>
												<td class="cell"><?php echo $category_name_fetch['name']; ?></td>
												<td class="cell"><?php echo $row['website']; ?></td>
												<td class="cell"><span class="badge bg-danger">	₹<?php echo $row['ad_cost']; ?></span></td>
                                                <td class="cell"><?php echo $row['total_cost']; ?></td>
                                                <td class="cell"><?php echo $row['clicks']; ?></td>
                                                <td class="cell"><?php if($row['status'] == 1) echo "Approved"; else if($row['status'] == 2) echo "Disapproved"; else echo "Pending Approval" ; ?></td>
												<td class="cell">
													<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ViewAdModal<?php echo $row['id']; ?>"><svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"> <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" fill="white"></path> <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" fill="white"></path> </svg></button>
													<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#UpdateAdModal<?php echo $row['id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"> <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/> <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/> </svg></button>
													<button class="btn btn-danger"><svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" fill="white"></path> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" fill="white"></path> </svg></button>
												</td>
                                                <?php include 'modals/updateAdModel.php'; include 'modals/viewAdModel.php'; ?>
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

