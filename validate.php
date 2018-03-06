<?php

require_once("includes/header.php");
require_once("includes/Database.php");
require_once("includes/User.php");


$db = new Database();

$username = $db->mysqli->real_escape_string($_POST['username']);
$password = $db->mysqli->real_escape_string($_POST['password']);


if(isset($_POST['submit'])) {
	if(empty($username) || empty($password)) {
		header("Location: login.php?error=empty");
		exit();
	}


	$result = $db->mysqli->query("SELECT * FROM admin WHERE username = '$username'");
	$row = $result->fetch_assoc();
	if($row < 1) {
		header("Location: login.php?error=invalid");
		exit();
	}
	else {
		var_dump($row);

	
		if(password_verify($password, $row['password'])) {
			$_SESSION['id'] = $row['id'];
			$_SESSION['username'] = $row['username'];
			header("Location: adminarea.php");
		}

		else {
			header("Location: login.php?error=invalid");
			exit();
		}
	}

}

else {
	header("Location: login.php");
	exit();
}