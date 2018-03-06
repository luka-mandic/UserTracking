<?php

require_once("includes/header.php");
if(isset($_GET['error'])){
	if($_GET['error'] == 'empty') {
		echo '<div class="container">
				<div class="alert alert-danger mt-3">
				  Please fill out all the fields!
				</div>
				</div>';

	}
	elseif ($_GET['error'] == 'invalid') {
		echo '<div class="container">
				<div class="alert alert-danger mt-3">
				  Invalid credentials!
				</div>
				</div>';
	}
}

if(isset($_SESSION['username'])) {
	header("Location: adminarea.php");
	exit();
}

?>

<div class="container">
	<form method="POST" action="validate.php">
		<h1>Please log in</h1>
		<div class="form-group">
			<label for="username">Username:</label>
			<input type="text" name="username" class="form-control">
		</div>

		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" name="password" class="form-control">
		</div>

		<div class="form-group">
			<button type="submit" name="submit" class="btn btn-primary">Log in</button>
		</div>
	</form>
 </div>

  </body>
</html>