<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title>Registeration Form</title>
</head>
<?php 
require "db.php";
$message = '';
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
  	$username = $_POST['username'];
  	$email = $_POST['email'];
  	$password = $_POST['password'];
  	$confirm_password = $_POST['confirm_password'];

  if ($name == '' || $username == ''  || $email == ''  || $password == '' || $confirm_password ==''){
    $message = '<div class="alert alert-danger alert-dismissible">
    				<button type="button" class="close" data-dismiss="alert">&times;</button>
    				<strong>Error!</strong> Fields marked with * are required
				</div>'; 

  }
  else if( $password != $confirm_password){
    
      $message = '<div class="alert alert-danger alert-dismissible">
      				<button type="button" class="close" data-dismiss="alert">&times;</button>
      				<strong>Error!</strong> Passwords do not match.
  				  </div>'; 
  }
  else
  {
    $emailExists = $connection->query("SELECT * FROM users WHERE email = '$email' ");
    $usernameExists = $connection->query("SELECT * FROM users WHERE username = '$username' ");

    if ($usernameExists->num_rows == 1) {
      
      $message = '<div class="alert alert-danger alert-dismissible">
      				<button type="button" class="close" data-dismiss="alert">&times;</button>
      				<strong>Error!</strong> Username already exists.
  				  </div>';
    }
    elseif ($emailExists->num_rows == 1) {
      $message = '<div class="alert alert-danger alert-dismissible">
      				<button type="button" class="close" data-dismiss="alert">&times;</button>
      				<strong>Error!</strong> Email already exists.
  				  </div>';
      
    }
    else
    {
        $sql = "INSERT INTO users(name, username, email, password) VALUES ('$name','$username','$email', '$password')";
        $result = $connection->query($sql);
        if($result == TRUE){
          $message = '<div class="alert alert-success alert-dismissible">
          				<button type="button" class="close" data-dismiss="alert">&times;</button>
          				<strong>Success!</strong> Record added successfully.
      				  </div>';
          header('Location: home.php');
        }
        else  
        {
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
					<h3 class="text-info text-center mt-5">Register</h3>
					<?php echo $message; ?>
					<form class="mt-5 ml-2" action="<?php echo $_SERVER['PHP_SELF']; ?> " method="POST">
					  <div class="form-group row">
					    <label for="inputName" class="col-sm-2 col-form-label pl-1">Name<span class="text-danger">*</span></label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="name" id="inputName" required placeholder="Name*">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputUsername" class="col-sm-2 col-form-label pl-1">Username<span class="text-danger">*</span></label>
					    <div class="col-sm-10">
					      <input type="txte" class="form-control" name="username" id="inputUsername" required placeholder="Username*">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputEmail" class="col-sm-2 col-form-label pl-1">Email<span class="text-danger">*</span></label>
					    <div class="col-sm-10">
					      <input type="email" class="form-control" name="email" id="inputEmail" required placeholder="Email*">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputpassword" class="col-sm-2 col-form-label pl-1">Password<span class="text-danger">*</span></label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" name="password" id="inputpassword" required placeholder="Password*">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputconfirm_password" class="col-sm-2 col-form-label pl-1">Confirm Password<span class="text-danger">*</span></label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" name="confirm_password" id="inputconfirm_password" required placeholder="Confirm Password*">
					    </div>
					  </div>
					  <div class="form-group text-center">
					  	<button type="submit" name="submit" class="btn btn-primary mb-2 pl-4 pr-4 pt-2 pb-2">REGISTER</button>
					  	<p class="text-primary">Already have an account? please login<a class="nav-link d-inline text-light" href="login.php">Here</a></p>
					  </div>
					</form>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</section>

	
	
</body>
</html>