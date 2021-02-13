<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title>Home</title>
</head>
<?php 
require "menu.php";
 ?>
<body class="bg-secondary">
	<section>
		<div class="container mt-5 text-info">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4 mt-5">
					<h4>Total Users in Your Contacts <span class="text-danger"><?php echo $rows; ?></span></h4>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</section>
</body>
</html>