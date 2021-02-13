<?php
session_start(); 
	require 'db.php';
	if (!$_SESSION) {
	    header("Location: login.php");
	  }
	$query = "SELECT * FROM contactdetails WHERE user_id = ".$_SESSION['contact_id'];
	$result = $connection->query($query);
	$rows = $result->num_rows;
?>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="home.php">Phonebook Directory</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="home.php">Home</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="add_new.php">Add New</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="view_all_contact.php">View All <span><?php echo $rows; ?></span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="view_profile.php">View</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="change_password.php">Change Password</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="logout.php">Logout</a>
	      </li>
	    </ul>
	  </div>
	</nav>

	<div class="container mt-5 text-center text-info">
		<h4 class="mt-5">Login as: <span><?php echo $_SESSION['username']; ?></span></h4>
	</div>
