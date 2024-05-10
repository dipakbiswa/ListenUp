<?php session_start(); ?>

<?php 
    if (!isset($_SESSION['username'])) {
        header('location: login.php');
    }
	include '../dbcon.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
        $image_name = $_POST['image_name'];
        $file = "../assets/category_banner/".$image_name;
		$delete_query_run = mysqli_query($conn, "delete from category where id = '$id'");
		if($delete_query_run and unlink($file)){
			$message = "Category Deleted!";
		}
	}
    


?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Categories</title>
    
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
			            <h1 class="app-page-title mb-0">Categories</h1>
				    </div>
				    <a href="newCategory.php" class="btn btn-success">New Category</a>
					<br>
					<center><p style="color:red;"><?php if(isset($message)){ echo $message; } ?></p></center>
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
                                                <th class="cell">Name</th>
												<th class="cell">Image</th>
												<th class="cell">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query_run = mysqli_query($conn, "select * from category");
											while($row = mysqli_fetch_assoc($query_run)){?>
											<tr align="center">
												<td class="cell"><?php echo $row['id']; ?></td>
                                                <td class="cell"><?php echo $row['name']; ?></td>
												<td class="cell"><img src="../assets/category_banner/<?php echo $row['image_name']; ?>" style="width: 150px;"></td>
												<td class="cell"><form action="#" method="post"><input type="hidden" name="id" value="<?php echo $row['id']; ?>"><input type="hidden" name="image_name" value="<?php echo $row['image_name']; ?>"><button type="submit" name="delete" class="btn btn-danger"><svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" fill="white"></path> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" fill="white"></path> </svg></button></form></td>
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

