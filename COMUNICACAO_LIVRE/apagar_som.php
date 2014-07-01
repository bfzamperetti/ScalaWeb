<?php
	include('../INCLUDES/conecta.php');
	session_start();
	
	$sql = 'SELECT caminho FROM som_usuario WHERE id = '.$_GET['id'];
	$qry = pg_query($sql);
	$som = pg_fetch_array($qry, NULL, PGSQL_ASSOC);
	
	if (file_exists($_SESSION['url_sons_usuario'].$som['caminho']))
	unlink($_SESSION['url_sons_usuario'].$som['caminho']);
	
	$sql = 'DELETE FROM som_usuario WHERE id = '.$_GET['id'];
	$qry = pg_query($sql);
		
	
?>

