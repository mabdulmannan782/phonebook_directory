<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title>Change Password</title>
</head>
	<?php 
	require "menu.php";
	$message = '';

	if (isset($_POST['update'])) {
		$old_password = $_POST['old_password'];
		$new_password = $_POST['new_password'];
		$confirm_password = $_POST['confirm_password'];
		
		if ($old_password == '' || $new_password == '' || $confirm_password == '') {
			$message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error!</strong> Fieldm marked with * are required</div>';

		} else {
			
			$sql = "SELECT * FROM users WHERE id =".$_SESSION['contact_id']." AND password = '".$old_password."'";
			$result = $connection->query($sql);

			if ($result->num_rows == 1) {
				
				if ($new_password == $confirm_password) {
					$query = "UPDATE users SET password = '".$new_password."' WHERE id = ".$_SESSION['contact_id'];

					$result = $connection->query($query);
					if ($result) {
						$message = '<div class=" alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times; </button><strong>Success!</strong> Password Change Successfully</div>';

					} else {
						$message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>There was error while adding record.</div>';
					}
				} else {
					$message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>
						Confirm Password does not match.</div>';

				}
				
			} else {
				$message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>
					Old Password does not match.</div>';
			}
			
		}
		
	}
	
	 ?>
<body class="bg-secondary">
	<section>
		<div class="container">
			<div class="row mt-5">
				<div class="col-md-4"></div>
				<div class="col-md-5 border mt-5">
					<div class="text-center mt-5">
						<h3 class="text-info">Change Password</h3>
					</div>
					<form class="mt-5 ml-2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						<?php echo $message; ?>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label pl-1">Old Password<span class="text-danger">*</span></label>
					    <div class="col-sm-9">
					      <input type="password" class="form-control" name="old_password" id="inputPassword" required placeholder="Old Password">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label pl-1">New Password<span class="text-danger">*</span></label>
					    <div class="col-sm-9">
					      <input type="password" class="form-control" name="new_password" id="inputPassword" required placeholder="New Password">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputNewPassword" class="col-sm-3 col-form-label pl-1">Confirm New Password<span class="text-danger">*</span></label>
					    <div class="col-sm-9">
					      <input type="password" class="form-control" name="confirm_password" id="inputNewPassword" required placeholder="Confirm New Password">
					    </div>
					  </div>
					  <div class="form-group text-center">
					  	<button type="submit" name="update" class="btn btn-primary mb-2 pl-4 pr-4 pt-2 pb-2">CHANGE</button>
					  </div>
					</form>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>	
	</section>	
</body>
</html>