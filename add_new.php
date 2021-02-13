<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title>Add New Uesr</title>
</head>
	<?php 
	require "menu.php";
	$message = '';
	if (isset($_POST['submit'])) {
		$name = $_POST['name'];
		$designation = $_POST['designation'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		
		if ($name == '' || $phone == '') {
		    $message = '<div class="alert alert-danger alert-dismissible">
		    				<button type="button" class="close" data-dismiss="alert">&times;</button>
		    				<strong>Error!</strong> Fields marked with * are required
						</div>';
		} 
		else {
			$nameExists = $connection->query("SELECT * FROM contactdetails WHERE name = '$name' ");
			$phoneExists = $connection->query("SELECT * FROM contactdetails WHERE phone = '$phone' ");

			if ($nameExists->num_rows == 1) {
			    $message = '<div class="alert alert-danger alert-dismissible">
			    				<button type="button" class="close" data-dismiss="alert">&times;</button>
			    				<strong>Error!</strong> Name already exists.
							  </div>';
			} elseif ($phoneExists->num_rows == 1) {
					    $message = '<div class="alert alert-danger alert-dismissible">
					    				<button type="button" class="close" data-dismiss="alert">&times;</button>
					    				<strong>Error!</strong> Phone Number already exists.
									  </div>';	
			}
			else{
				$sql = "INSERT INTO contactdetails(`name`, `designation`, `phone`, `address`, `user_id`) VALUES ('$name', '$designation', '$phone', '$address', ".$_SESSION['contact_id'].")";
				$result = $connection->query($sql);
				if ($result == TRUE) {
				    $message = '<div class="alert alert-success alert-dismissible">
				    				<button type="button" class="close" data-dismiss="alert">&times;</button>
				    				<strong>Success!</strong> Record added successfully.
								  </div>';
					header('Location: view_all_contact.php');
				} else {
					$message = '<div class="alert alert-danger alert-dismissible">
          				<button type="button" class="close" data-dismiss="alert">&times;</button>
          				<strong>Error!</strong> '.$connection->error.'</div>';
				}
			}
		}
	} 
	?>
<body class="bg-secondary">
	<section>
		<div class="container-fluid">
			<div class="row mt-5">
				<div class="col-md-4"></div>
				<div class="col-md-4 border">
					<h3 class="text-info text-center mt-5">Add User</h3>
					<?php echo $message; ?>
					<form class="mt-5 ml-2 " action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					  <div class="form-group row">
					    <label for="Name" class="col-sm-3 col-form-label pl-1">Name<span class="text-danger">*</span></label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="name" id="Name" placeholder="Enter Name">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="Designation" class="col-sm-3 col-form-label pl-1">Designation</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="designation" id="Designation" placeholder="Designation">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="Phone" class="col-sm-3 col-form-label pl-1">Phone<span class="text-danger">*</span></label>
					    <div class="col-sm-9">
					      <input type="number" class="form-control" name="phone" id="Phone" placeholder="Enter Phone Number">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="Address" class="col-sm-3 col-form-label pl-1">Address</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="address" id="Address" placeholder="Address">
					    </div>
					  </div>
					  <div class="form-group text-center">
					  	<button type="submit" name="submit" class="btn btn-primary mb-2 pl-4 pr-4 pt-2 pb-2">ADD</button>
					  </div>
					  <input  type="hidden" name="user_id" value="<?php echo $_SESSION['contact_id']; ?>">
					</form>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</section>
</body>
</html>