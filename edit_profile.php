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
	$message = "";
	if (isset($_POST['update'])) 
	{
		
		$name = $_POST['name'];
		$username = $_POST['username'];
		$email = $_POST['email'];

		$id = $_SESSION['contact_id'];

		if ($name == '' || $username == '' || $email == '' ) 
		{
			$message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error!</strong> Fileds marked With * are required</div>';

		} 
		else 
		{
			$usernameExists = $connection->query("SELECT * FROM users WHERE id <> '$id' AND username = '$username'");

			

			$emailExists =$connection->query("SELECT * FROM users WHERE id <> '$id' AND email = '$email'");

			
			if ($usernameExists->num_rows == 1) {
				$message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Username already exists</div>';

			} 
			elseif ($emailExists->num_rows == 1) {
				$message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Email already exists</div>';

			}
			else {
				$query = "UPDATE users SET name = '$name', username = '$username', email = '$email' WHERE id = '$id'";
				$result = $connection->query($query);
				$_SESSION['username'] = $username;

				if ($result) {
					$message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Success!</strong> Profile Update Successfully</div>';
						header('Location: view_profile.php');
				} else {
					$message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Error!</strong>'.$connection->error.'</div>';
				}
				
			}
		}
		
	}
	$sql = "SELECT * FROM users WHERE id = ".$_SESSION['contact_id'];
	$result = $connection->query($sql);
	$row = $result->fetch_assoc();
	
	?>
<body class="bg-secondary">
	<section>
		<div class="container-fluid">
			<div class="row mt-5" style="padding-top: 50px;">
				<div class="col-md-4"></div>
				<div class="col-md-4 border">
					<h3 class="text-info text-center mt-5">Update Profile</h3>
					<form class="mt-5 ml-2 " action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						<?php echo $message; ?>
					  <div class="form-group row">
					    <label for="Name" class="col-sm-3 col-form-label pl-1">Name<span class="text-danger">*</span></label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="name" id="Name" value="<?php echo $row['name']; ?>" placeholder="Enter Name">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="Username" class="col-sm-3 col-form-label pl-1">Username<span class="text-danger">*</span></label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="username" id="Username" value="<?php echo $row['username']; ?>" placeholder="Username">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="Email" class="col-sm-3 col-form-label pl-1">Email<span class="text-danger">*</span></label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="email" id="Email" value="<?php echo $row['email']; ?>" placeholder="Enter Email">
					    </div>
					  </div>
					  <div class="form-group text-center">
					  	<button type="submit" name="update" class="btn btn-primary mb-2 pl-4 pr-4 pt-2 pb-2">CHANGE</button>
					  </div>
					</form>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</section>
	
</body>
</html>