<?php
	session_start();
	
	include('atualizar_desfazer.php');
		
	$_SESSION['nome_prancha'.$_GET['idprancha'].'_qdr'.$_SESSION['quadro_atual']] = $_GET['novalegenda'];
	include('desenha_layout.php');
?>
