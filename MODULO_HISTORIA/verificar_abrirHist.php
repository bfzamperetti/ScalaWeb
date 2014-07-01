<?php
/* formato da história salva:
	/ - define layout do quadro
	* - define informações do quadrinho
	| - separa informações da imagem
	) - separa imagem
	@ - separa quadrinho
    } - separa quadro
 a informação de text da imagem pode nao existir, ficando ||.
 nro_quadros]busca_img_atual]quadro_atual]layout_quadro/layout_quadrinho*narração*cenario*top|left|height|width|path|ang|inv|text|)
 top|left|height|width|path|ang|inv||)@layout_quadrinho*narração*cenario*top...)@}
*/
if (isset($_POST['abrirHistLista'])){
		
		$sql = 'SELECT * FROM historia_usuario WHERE id = '.$_POST['id'];
		$qry = pg_query($sql);
		$p = pg_fetch_array($qry, NULL, PGSQL_ASSOC);
		$config = explode("]", $p['historia']);		
		$_SESSION['hist_n_quadros'] = $config[0];
		$_SESSION['hist_busca_imgs_atual'] = $config[1];
		$_SESSION['hist_quadro_atual'] = $config[2];
		
		$quadros = explode("}",$config[3]);
		
		for ($i = 1; $i <= $config[0]; $i++){
			$layout = explode("¬",$quadros[$i-1]);
			$_SESSION['hist_layout_qdr'.$i] = $layout[0];
			$quadrinho = explode("@",$layout[1]);			
						
			//inicializa informações de cada quadrinho
			for ($j = 0; $j < 6; $j++){			
				$layout_quadrinho = explode('*',$quadrinho[$j]);
				$_SESSION['qdr'.$i.'_quadrinho'.$j.'_layout'] = $layout_quadrinho[0];	
				$_SESSION['qdr'.$i.'_quadrinho'.$j.'_narracao'] = $layout_quadrinho[1];	
				$_SESSION['qdr'.$i.'_quadrinho'.$j.'_ini'] = 100000;
				$_SESSION['qdr'.$i.'_quadrinho'.$j.'_fim'] = 100000;
				$_SESSION['qdr'.$i.'_quadrinho'.$j.'_cenario'] =  $layout_quadrinho[2];
										
				//caso tenha alguma imagem no quadrinho
				if ($layout_quadrinho[3] != ""){
					$figura = explode(")",$layout_quadrinho[3]);
					$tamanho = 100000 + count($figura);
										
					//inicializa informações de cada imagem
					for ($k = 100000; $k < $tamanho-1; $k++){	
						$itens_figura = explode("|",$figura[$k-100000]);
						$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_top'] = $itens_figura[0];
						$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_left'] = $itens_figura[1];
						$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_height'] = $itens_figura[2];
						$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_width'] = $itens_figura[3];
						//se o caminho for em branco, a imagem foi apagada
						if ($itens_figura[4] == "")
								$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_path'] = "";
					
						else{
							$img_id = explode(".", $itens_figura[4]);							
							if ($img_id[0] <= 100) //se for imagem de texto
								$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_path'] =  $_SESSION['url_imagens_textos'].$img_id[0].".".$img_id[1];
							else if ($img_id[0] >= 100000) //se for imagem do usuario
								$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_path'] =  $_SESSION['url_imagens_usuario'].$img_id[0].".".$img_id[1];	 
							else  //se for imagem comum
								$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_path'] =  $_SESSION['url_imagens'].$img_id[0].".".$img_id[1];	 
						}
						$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_ang'] = $itens_figura[5];
						$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_inv'] = $itens_figura[6];	
						//caso tenha texto na imagem
						if ($itens_figura[7] != '') 
							$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_text'] = $itens_figura[7];
					}
					$_SESSION['qdr'.$i.'_quadrinho'.$j.'_fim'] = $k;
				}
			} 	
		}	
	}
?>
