<?php

session_start();

if(isset($_SESSION['id']) && isset($_POST['submit'])) {
	session_unset();
	session_destroy();
	header("Location: index.php");
	exit();
}
else{
	header("Location: index.php");
	exit();
}