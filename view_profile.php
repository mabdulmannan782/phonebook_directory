<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title>User Profile</title>
</head>
	<?php 
	require "menu.php";
	$query = "SELECT * FROM users WHERE id = '".$_SESSION['contact_id']."'";
	$result = $connection->query($query);
	$row = $result->fetch_assoc();
	?>
<body class="bg-secondary">
	<section>
		<div class="container">
			<div class="text-center mt-5">
				<h3 class="text-info">User Profile</h3>
			</div>
			<table class="table mt-5 table-bordered">
			  <thead>
			    <tr>
			      <th class="text-center" scope="col">Name</th>
			      <th class="text-center" scope="col">Username</th>
			      <th class="text-center" scope="col">Email</th>
			      <th class="text-center" scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <td><?php echo $row['name']; ?></td>
			      <td><?php echo $row['username']; ?></td>
			      <td><?php echo $row['email']; ?></td>
			      <td class="text-center"><span><a class="nav-link d-inline text-light" href="edit_profile.php">Edit</a></span></td>
			    </tr>
			    </tbody>
			</table>
		</div>
	</section>
</body>
</html>