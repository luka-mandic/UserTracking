<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User Tracking Software</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style>
		body{
			padding-top: 65px;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
		<div class="container">
	     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
	       <span class="navbar-toggler-icon"></span>
	     </button>
	      <a class="nav-link" href="index.php" style="color: white">Home</a>

	     <div class="collapse navbar-collapse" id="navbarsExampleDefault">
	       <?php if(isset($_SESSION['username'])): ?>
			   <a class="btn btn-primary my-2 my-sm-0 ml-auto" href="adminarea.php">Admin</a>
		       <form class="form-inline ml-2" action="logout.php" method="POST">
		         <button class="btn btn-danger my-2 my-sm-0" type="submit" name="submit">Logout</button>
		       </form>
		       
	   		<?php endif; ?>
	     </div>
	     </div>
	   </nav>