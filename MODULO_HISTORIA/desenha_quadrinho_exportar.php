<?php
//div que vai a imagem
$layout .= '<div class="imgquad_vis" 
			style=" ';						
			$layout .= 'zoom: 1;
			display:block;
			position:absolute;';
						
			//reposicionando div no lugar certo caso tenha sido invertida a imagem
			if ($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_inv'] == 1){
				if (($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'] == 90) || 
					($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'] == 270))
					$layout .= 'margin-left:'.$left.'px; 
					margin-top:'.($top+$height).'px;
					height:'.$height.'px; 
					width:'.$width.'px;';
												
				else 
					$layout .= 'margin-left:'.($left+$width).'px; 
					margin-top:'.$top.'px;
					height:'.$height.'px; 
					width:'.$width.'px;';
																					
				}
			else 
				$layout .= 'margin-left:'.$left.'px; 
				margin-top:'.$top.'px;
				height:'.$height.'px; 
				width:'.$width.'px;';
				
			$layout .= '"><img ';
			
			if ($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_inv'] == 1){
				if (($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'] == 90) || 
					($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'] == 270))
					$layout .= 'style=" 
					-webkit-transform: scaleY(-1);
					-moz-transform: scaleY(-1);
					-ms-transform: scaleY(-1);
					-o-transform: scaleY(-1);
					transform: scaleY(-1);
					filter: fliph;
					"';
				else 
					$layout .= 'style=" 
					-webkit-transform: scaleX(-1);
					-moz-transform: scaleX(-1);
					-ms-transform: scaleX(-1);
					-o-transform: scaleX(-1);
					transform: scaleX(-1);
					filter: flipw;
					"';
			}
			$layout .= ' src="';
			if ($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'] != 0)
				$layout .= $destino;
			else 
				$layout .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_path'];
				
			$layout .= '" height="100%" width="100%"/>';
			if (isset($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_text'])){
				$alturaBalao = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_height'];
				$larguraBalao = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_width'];
				$tamTexto = strlen($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_text']);
				$t = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_layout'];
					if ($t == 1) 		$stdFontSize = 1.6;
					else if ($t == 2) 	$stdFontSize = 3;
					else if ($t == 3) 	$stdFontSize = 1.6;
					else if ($t == 4) 	$stdFontSize = 1.5;
					else if ($t == 5) 	$stdFontSize = 2.2;
					$newFontSize = round(sqrt(pow($larguraBalao,2)+pow($alturaBalao,2))*$stdFontSize/log($tamTexto*2.4+2));//proporção entre tamanho do balão e o texto
				$layout .= '<div font-color="#000" style="text-align: center; position:absolute; display:block; width:'.($width*0.8).'px; height:'.($height*0.6).'px;
					top:'.($height*0.2).'px; left:'.($width*0.1).'px; font-size: '.$newFontSize.'px; color:#000; ">'.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_text'].'</div>';
			}
			$layout .='</div>';
?>
