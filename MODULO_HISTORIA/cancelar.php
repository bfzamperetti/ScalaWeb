<?php
session_start();
	$inicio = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_ini'];
	$fim = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_fim'];
			
	for ($j = $inicio; $j < $fim; $j++){
		if (isset($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$j.'_text'])) 
			unset($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$j.'_text']);
	}

	$layout_quadrinho = explode('*',$_SESSION['hist_cancelar']);
	$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_layout'] = $layout_quadrinho[0];	
	$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_narracao'] = $layout_quadrinho[1];	
	$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_cenario'] = $layout_quadrinho[2];
	$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_ini'] = 100000;
	$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_fim'] = 100000;

	
	if ($layout_quadrinho[3] != ""){
		$figura = explode(")",$layout_quadrinho[3]);
		$tamanho = 100000 + count($figura);		
							
		for ($k = 100000; $k < $tamanho-1; $k++){	
			$itens_figura = explode("|",$figura[$k-100000]);
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_top'] = $itens_figura[0];
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_left'] = $itens_figura[1];
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_height'] = $itens_figura[2];
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_width'] = $itens_figura[3];
			if ($itens_figura[4] == "")
				$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_path'] = "";
			else{
				$img_id = explode(".", $itens_figura[4]);
					if ($img_id[0] < 100) //se for imagem de texto
						$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_path'] =  $_SESSION['url_imagens_textos'].$img_id[0].".".$img_id[1];	 
					else if ($img_id[0] >= 100000) //se for imagem do usuario
						$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_path'] =  $_SESSION['url_imagens_usuario'].$img_id[0].".".$img_id[1];	 
					else
						$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_path'] =  $_SESSION['url_imagens'].$img_id[0].".".$img_id[1];	 
				}
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_ang'] = $itens_figura[5];
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_inv'] = $itens_figura[6];	
				if ($itens_figura[7] != '') 
					$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_text'] = $itens_figura[7];
		}
			$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_fim'] = $k;
	}
header('Location: index.php');
?>
