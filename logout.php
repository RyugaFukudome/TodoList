<?php
	session_start();

	unset($_SESSION['userid'],$_SESSION['username']);

	header('Location: login.php');
	exit();
?>
