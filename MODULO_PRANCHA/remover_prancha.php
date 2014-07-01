<?php
	session_start();
	
	//este include e chamado sempre que alguma alteracao no quadro e feita, para que o botao desfazer funcione corretamente
	include('atualizar_desfazer.php');
	
	
	// Zera a prancha enviada por GET 
	$_SESSION['pathimg_prancha'.$_GET['id'].'_qdr'.$_SESSION['quadro_atual']] = "";
	$_SESSION['nome_prancha'.$_GET['id'].'_qdr'.$_SESSION['quadro_atual']] = "";
	$_SESSION['ocupada_prancha'.$_GET['id'].'_qdr'.$_SESSION['quadro_atual']] = 0;
	$_SESSION['pathvoz_prancha'.$_GET['id'].'_qdr'.$_SESSION['quadro_atual']] = ""; 
	
	include('desenha_layout.php');
?>
