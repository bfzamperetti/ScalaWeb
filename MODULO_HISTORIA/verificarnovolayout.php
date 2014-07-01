<?php
	include('../INCLUDES/conecta.php');
	session_start();
	
	//apagar layout atual
	if ($_GET['tipo_novo_layout'] == 0){
		for ($i = 0; $i < 6; $i++){
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'] = 100000;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'] = 100000;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_narracao'] = '';
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'] = '#ccc';
		}
	}
	
	//se o modelo de layout for 1
	if ($_GET['tipo_novo_layout'] == 1){
		$_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] = 1; 
		for ($i = 0; $i < 4; $i++){
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_layout'] = 1;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'] = 100000;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'] = 100000;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_narracao'] = '';
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'] = '#ccc';
		}
	}
	
	//se o modelo de layout for 2
	if ($_GET['tipo_novo_layout'] == 2){
		$_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] = 2; 
		for ($i = 0; $i < 1; $i++){
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_layout'] = 2;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'] = 100000;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'] = 100000;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_narracao'] = '';
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'] = '#ccc';
		}
	}
	
	//se o modelo de layout for 3
	if ($_GET['tipo_novo_layout'] == 3){
		$i = 0;
		$_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] = 3;
		$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_layout'] = 3;
		$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'] = 100000;
		$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'] = 100000;
		$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_narracao'] = '';
		$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'] = '#ccc';
		for ($i = 1; $i < 3; $i++){
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_layout'] = 1;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'] = 100000;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'] = 100000;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_narracao'] = '';
		}
	}
	
	//se o modelo de layout for 4
	if ($_GET['tipo_novo_layout'] == 4){
		$_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] = 4;
		for ($i = 0; $i < 6; $i++){
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_layout'] = 4;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'] = 100000;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'] = 100000;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_narracao'] = '';
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'] = '#ccc';
		}
	}
	
	//se o modelo de layout for 5
	if ($_GET['tipo_novo_layout'] == 5){
		$_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] = 5;
		for ($i = 0; $i < 2; $i++){
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_layout'] = 5;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'] = 100000;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'] = 100000;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_narracao'] = '';
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'] = '#ccc';
		}
	}
	
	include('desenha_layout.php');
?>
