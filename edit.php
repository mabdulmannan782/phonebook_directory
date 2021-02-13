<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title>Edit Uesr</title>
</head>
	<?php 
	require "menu.php";
	$message = '';
	  if(isset($_POST['update'])){

	      $id = $_POST['id'];
	      $name = $_POST['name'];
	      $designation = $_POST['designation'];
	      $phone = $_POST['phone'];
	      $address = $_POST['address'];

	      if($name == ''  || $phone ==''  ){
	         $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Fields marked with * are required</div>';  

	      }
	      else
	      {
	         $query = "UPDATE contactdetails SET name = '$name', designation =  '$designation', phone =  '$phone', address = '$address'WHERE id ='$id'";
	          $result =$connection->query($query);

	          if($result){
	            header("Location:view_all_contact.php"); 
	           } else {
	             $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> '.$connection->error.'</div>';   
	           }
	      }
	   }

	   $id = $_GET['editid']; // GETTING ID FROM URL
	   $query = "SELECT * FROM contactdetails WHERE id ='$id' AND user_id = ".$_SESSION['contact_id'];
	   $result = $connection->query($query);
	   if ($result->num_rows == 1) {
	    $row = $result->fetch_assoc(); 
	   }
	   else
	   {
	     header('Location: view_all_contact.php');
	   }
	?>
<body class="bg-secondary">
	<section>
		<div class="container-fluid">
			<div class="row mt-5" style="padding-top: 50px;">
				<div class="col-md-4"></div>
				<div class="col-md-4 border">
					<h3 class="text-info text-center mt-5">Update User</h3>
					<form class="mt-5 ml-2 " action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
						<?php echo $message; ?>
					  <div class="form-group row">
					    <label for="Name" class="col-sm-3 col-form-label pl-1">Name<span class="text-danger">*</span></label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="name" id="Name" value="<?php echo $row['name']; ?>"  placeholder="Enter Name">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="Designation" class="col-sm-3 col-form-label pl-1">Designation</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="designation" id="Designation" value="<?php echo $row['designation']; ?>" placeholder="Designation">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="Phone" class="col-sm-3 col-form-label pl-1">Phone<span class="text-danger">*</span></label>
					    <div class="col-sm-9">
					      <input type="number" class="form-control" name="phone" id="Phone" value="<?php echo $row['phone']; ?>"  placeholder="Enter Phone Number">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="Address" class="col-sm-3 col-form-label pl-1">Address</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="address" id="Address" value="<?php echo $row['address']; ?>" placeholder="Address">
					    </div>
					  </div>
					  <div class="form-group text-center">
					  	<button type="submit" name="update" class="btn btn-primary mb-2 pl-4 pr-4 pt-2 pb-2">UPDATE</button>
					  </div>
					  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
					</form>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</section>
	
</body>
</html>