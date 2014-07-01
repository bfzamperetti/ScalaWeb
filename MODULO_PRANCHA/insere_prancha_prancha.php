<?php
	include_once('../INCLUDES/conecta.php');
	session_start();
	
	include('atualizar_desfazer.php');
	
	$_SESSION['pathimg_prancha'.$_GET['pranchadestino'].'_qdr'.$_SESSION['quadro_atual']] = $_SESSION['pathimg_prancha'.$_GET['pranchaorigem'].'_qdr'.$_SESSION['quadro_atual']];
	$_SESSION['nome_prancha'.$_GET['pranchadestino'].'_qdr'.$_SESSION['quadro_atual']] = $_SESSION['nome_prancha'.$_GET['pranchaorigem'].'_qdr'.$_SESSION['quadro_atual']];
	$_SESSION['pathvoz_prancha'.$_GET['pranchadestino'].'_qdr'.$_SESSION['quadro_atual']] = $_SESSION['pathvoz_prancha'.$_GET['pranchaorigem'].'_qdr'.$_SESSION['quadro_atual']];
	$_SESSION['ocupada_prancha'.$_GET['pranchadestino'].'_qdr'.$_SESSION['quadro_atual']] = $_SESSION['ocupada_prancha'.$_GET['pranchaorigem'].'_qdr'.$_SESSION['quadro_atual']];
	
	$_SESSION['pathimg_prancha'.$_GET['pranchaorigem'].'_qdr'.$_SESSION['quadro_atual']] = "";
	$_SESSION['nome_prancha'.$_GET['pranchaorigem'].'_qdr'.$_SESSION['quadro_atual']] = "";
	$_SESSION['pathvoz_prancha'.$_GET['pranchaorigem'].'_qdr'.$_SESSION['quadro_atual']] = "";
	$_SESSION['ocupada_prancha'.$_GET['pranchaorigem'].'_qdr'.$_SESSION['quadro_atual']] = 0;
	
	include('desenha_layout.php');
?>
