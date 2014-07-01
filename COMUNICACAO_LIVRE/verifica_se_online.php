<?php
include('../INCLUDES/conecta.php');

if (isset($_GET['logout'])){
	$logadid = $_SESSION['id'];

	$sql = "UPDATE usuario set chat_status = '0' where id= '".$logadid."'";
	$qery = pg_query($sql) or die ("erro");
	
	
	$_SESSION = array();
	header("Location: ../index.php");
	
}
?>
