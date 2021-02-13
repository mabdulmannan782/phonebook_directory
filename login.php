<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title>Login</title>
</head>
<?php 
session_start();

if(isset($_SESSION['username'])){
  header('Location: home.php');
}
$message = '';
require 'db.php';
if(isset($_POST['submit'])){

  $username = $_POST['username'];
  $password = $_POST['password'];

  if($username == '' || $password == ''){
     $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Fields marked with * are required</div>';  
  }
  else{
   $query = "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'";
   $result = $connection->query($query);
   $row = $result->num_rows;

   if($row == 1) {
     $member = $result->fetch_assoc();

     $_SESSION['username'] = $username;
     $_SESSION['contact_id'] = $member['id'];

     header('Location: home.php'); 
   }
   else
   {
     $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Invalid username or password</div>';  

   }

  }
}
 ?>
<body class="bg-secondary">
	<section>
		<div class="container">
			<div class="row mt-5">
				<div class="col-md-3"></div>
				<div class="col-md-5 border mt-5">
					<div class="text-center mt-5">
					  <h3 class="text-info">LOGIN</h3>
					</div>
						<?php echo "$message"; ?>
					<form class="mt-5 mb-4 ml-2" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
					  <div class="form-group row">
					    <label for="Username" class="col-md-3 col-form-label pl-1">Username<span class="text-danger">*</span></label>
					    <div class="col-md-9">
					      <input type="text" class="form-control" name="username" id="Username" placeholder="Enter Username">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-md-3 col-form-label pl-1">Password<span class="text-danger">*</span></label>
					    <div class="col-md-9">
					      <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Enter Password">
					    </div>
					  </div>
					  <div class="form-group text-center">
					  	<button type="submit" name="submit" class="btn btn-primary mb-2 pl-4 pr-4 pt-2 pb-2">LOGIN</button>
					  	<p class="text-primary">Not a member yet? Register<a class="nav-link d-inline text-light" href="registration.php">Here</a></p>
					  </div>
					</form>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</section>
	
</body>
</html>