<?php
	session_start();
	
	if ($_GET['direcao'] == -1){
		$j = 0;
		
		if($_SESSION['hist_quadro_atual'] == $_SESSION['hist_n_quadros']){	
			for ($i = 0; $i < 6; $i++){	
				$inicio = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'];
				$fim = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'];	 
				if (($inicio == 100000) && ($fim == 100000) && ($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_narracao'] == '') && ($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'] == '#ccc'))
					$j++;					 				
				else {
					$cont = 0;
					for ($k = $inicio; $k < $fim; $k++){
						if 	($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$k.'_path'] == '') 
						$cont++;
					}  
					if (($cont == ($fim - $inicio)) && ($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'] == '#ccc')) 
						$j++;					
				} 
			}
			if($j == 6) $_SESSION['hist_n_quadros'] = $_SESSION['hist_n_quadros'] - 1;
		}		
	}
	
	//Atualiza o quadro atual
	$_SESSION['hist_quadro_atual'] = $_SESSION['hist_quadro_atual'] + $_GET['direcao'];
	
	//se o quadro atual for 0, ele volta a ser 1.
	if ($_SESSION['hist_quadro_atual'] == 0) $_SESSION['hist_quadro_atual'] = 1;
	
	//Atualiza o numero de quadros, e zera o quadro atual.
	if ($_SESSION['hist_n_quadros'] < $_SESSION['hist_quadro_atual']){
		$_SESSION['hist_n_quadros'] = $_SESSION['hist_n_quadros'] + 1;
		
		
		$_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] = 1; 
		for ($i = 0; $i < 6; $i++){
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_layout'] = 1;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'] = 100000;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'] = 100000;
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_narracao'] = '';
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'] = '#ccc';
		}
	
	}
	
	include('desenha_layout.php');

?>
