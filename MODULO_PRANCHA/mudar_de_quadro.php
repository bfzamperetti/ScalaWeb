<?php
	session_start();
	
	//Atualiza o quadro atual
	$_SESSION['quadro_atual'] = $_SESSION['quadro_atual'] + $_GET['direcao'];
	
	//se o quadro atual for 0, ele volta a ser 1.
	if ($_SESSION['quadro_atual'] == 0) $_SESSION['quadro_atual'] = 1;
	
	//Atualiza o numero de quadros, e zera o quadro atual.
	if ($_SESSION['n_quadros'] < $_SESSION['quadro_atual']){
		$_SESSION['n_quadros'] = $_SESSION['n_quadros'] + 1;
		
		if (!isset($_SESSION['layout_qdr'.$_SESSION['quadro_atual']])){
		for ($i = 0; $i < 12; $i++){
				$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = "";
				$_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = "";
				$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = 0;
				$_SESSION['pathvoz_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = ""; 
			}
			$_SESSION['layout_qdr'.$_SESSION['quadro_atual']] = 1;
			
		}
	
	}
	
	if($_SESSION['quadro_atual'] != $_SESSION['n_quadros']){ // ver a situação para remover o ultimo quadro caso ele esteja vazio
		$vazio = true;
		for ($i = 0; $i < 12; $i++)
			if ($_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['n_quadros']] == 1)
				$vazio = false;
		if ($vazio)
		$_SESSION['n_quadros'] -= 1;
	}		
	
	include('desenha_layout.php');
?>
