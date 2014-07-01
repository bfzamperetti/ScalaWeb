<?php
	include('../INCLUDES/conecta.php');
	session_start();
	
	include('atualizar_desfazer.php');
	//se for só para limpar o layout
	if ($_GET['tipo_novo_layout'] == 0){
		$_GET['tipo_novo_layout'] = $_SESSION['layout_qdr'.$_SESSION['quadro_atual']];
	}
	
	//se o modelo de layout for 1
	if ($_GET['tipo_novo_layout'] == 1){
		for ($i = 0; $i < 12; $i++){
			$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = "";
			$_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = "";
			$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = 0;
			$_SESSION['pathvoz_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = ""; 
		}
		$_SESSION['layout_qdr'.$_SESSION['quadro_atual']] = 1; 
	}
	
	//se o modelo de layout for 2
	if ($_GET['tipo_novo_layout'] == 2){
		for ($i = 0; $i < 12; $i++){
			$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = "";
			$_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = "";
			$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = 0;
			$_SESSION['pathvoz_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = ""; 
		}
		$_SESSION['layout_qdr'.$_SESSION['quadro_atual']] = 2; 
	}
	
	//se o modelo de layout for 3
	if ($_GET['tipo_novo_layout'] == 3){
		for ($i = 0; $i < 12; $i++){
			$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = "";
			$_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = "";
			$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = 0;
			$_SESSION['pathvoz_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = ""; 
		}
		$_SESSION['layout_qdr'.$_SESSION['quadro_atual']] = 3; 
	}
	
	//se o modelo de layout for 4
	if ($_GET['tipo_novo_layout'] == 4){
		for ($i = 0; $i < 12; $i++){
			$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = "";
			$_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = "";
			$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = 0;
			$_SESSION['pathvoz_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = ""; 
		}
		$_SESSION['layout_qdr'.$_SESSION['quadro_atual']] = 4; 
	}
	
	//se o modelo de layout for 5
	if ($_GET['tipo_novo_layout'] == 5){
		for ($i = 0; $i < 12; $i++){
			$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = "";
			$_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = "";
			$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = 0;
			$_SESSION['pathvoz_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = ""; 
		}
		$_SESSION['layout_qdr'.$_SESSION['quadro_atual']] = 5; 
	}
	//volta para a varredura no menu principal
	echo"<script>location.href='index.php?varAtual=menu_inferior';</script>";
?>
