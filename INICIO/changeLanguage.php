<?php
	session_start();
	$_SESSION['lang'] = $_GET['language'];
	header('Location: index.php');
?>
