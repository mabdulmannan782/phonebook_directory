<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title>View All Contacts</title>
</head>
	<?php 
	require "menu.php";
	?>
<body class="bg-secondary">
	<section>
		<div class="container">
			<table class="table mt-5 table-bordered">
			  <thead>
			    <tr>
			      <th class="text-center" scope="col">S.NO</th>
			      <th class="text-center" scope="col">Name</th>
			      <th class="text-center" scope="col">Designation</th>
			      <th class="text-center" scope="col">Phone</th>
			      <th class="text-center" scope="col">Address</th>
			      <th class="text-center" scope="col">Action</th>
			    </tr>
			  </thead>
			<?php
			$sql = "SELECT * FROM contactdetails WHERE user_id = ".$_SESSION['contact_id'];
			$result = $connection->query($sql);
			$row = $result->num_rows;

			if ($row >  0) {
			    $count = 1;
			    while($row = $result->fetch_assoc()){
			    ?>
			    <tr>
			      <th class="text-center"><?php echo $count; ?></th>
			      <td><?php echo $row['name'] ?></td>
			      <td><?php echo $row['designation'] ?></td>
			      <td><?php echo $row['phone'] ?></td>
			      <td><?php echo $row['address'] ?></td>
			      <td class="text-center"><a href="edit.php?editid=<?php echo $row["id"]; ?>" class="nav-link text-white d-inline mr-2">Edit </a> |  <a href="delete.php?deleteid=<?php echo $row["id"]; ?>" class="nav-link text-white d-inline ml-2" onclick="return confirm('Are You Sure Do You Wan\'t To Delete The Contact?')">Delete </a></td>
			    </tr>
			  <?php $count++; }
			    } 
			    else {
			    	?>
				<tr>
				  <td colspan="6" class="text-center text-white"> No Record Found</td>
				</tr>
			<?php } ?>
			  </tbody>
			
			</table>	
		</div>
		
	</section>
</body>
</html>