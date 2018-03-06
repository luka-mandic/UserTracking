<?php
require_once("includes/header.php");

if(isset($_SESSION['id'])) {

	
	require_once("includes/Database.php");
	require_once("includes/User.php");

	$user = new User();
	$result = $user->getUsers();
	?>

	<div class="container">
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">IP address</th>
		      <th scope="col">Browser</th>
		      <th scope="col">Browser Version</th>
		      <th scope="col">Operating system</th>
		      <th scope="col">Country</th>
		      <th scope="col">City</th>
		      <th scope="col">Number of visits</th>
		    </tr>
		  </thead>
		  <tbody>
			<?php
			if($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>".$row['IP_address']."</td>"; 
					echo "<td>".$row['browser']."</td>"; 
					echo "<td>".$row['browser_version']."</td>"; 
					echo "<td>".$row['os']."</td>"; 
					echo "<td>".$row['country']."</td>"; 
					echo "<td>".$row['city']."</td>"; 
					echo "<td>".$row['visits']."</td>"; 
					echo "</tr>";
				}
			}
			?>
		 </tbody>
		</table>
	</div>
<?php
}

else {
	header("Location: login.php");
		exit();
}
?>