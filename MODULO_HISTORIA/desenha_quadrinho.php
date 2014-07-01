<?php
if (!session_id()) session_start();
//$_SESSION['Qual quadro:história | prancha'.$_SESSION['Qual Layout'].'Qual quadrinho'.$numeroDoQuadrinho.'Qual imagem'];
$inicio = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'];
$fim = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'];
$layout .= '<div style="position: relative; width: 100%; height: 100%;">';

$layout .= '<div class="cenario"';
	$bg = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'];
	if ($bg[0] == '#')
		$layout .= ' style="background: '.$bg.';">';
	else
		$layout .= '><img src="'.$bg.'" width="100%" height="100%" style="margin:0; padding:0; top:0; left:0; position:absolute">';
$layout .= '</div>';
	
//percorrendo todas as imagens	
for($j = $inicio; $j <  $fim; $j++){
	//define a orientação de cada imagem
	$ang = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'];
	$cos = cos($ang);
	$sin = sin($ang);
	$layout .= '<div class="imgquad_vis" 
				style=" 
				-moz-transform: rotate('.$ang.'.0deg);  
				-o-transform: rotate('.$ang.'.0deg);  
				-webkit-transform: rotate('.$ang.'.0deg);  
				-ms-transform: rotate('.$ang.'.0deg);  
				transform: rotate('.$ang.'.0deg);  
				filter: progid:DXImageTransform.Microsoft.Matrix( 
                 M11='.$cos.', M12=-'.$sin.', M21='.$sin.', M22='.$cos.', sizingMethod=\'auto expand\');
				zoom: 1;
				display:block;
				left:'.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_left'].'%; 
				top:'.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_top'].'%;
				height:'.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_height'].'%; 
				width:'.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_width'].'%; 
				">
				<img ';
				//se invertida
				if ($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_inv'] == 1)
				 $layout .= 'style=" 
				-webkit-transform: scaleX(-1);
				-moz-transform: scaleX(-1);
				-ms-transform: scaleX(-1);
				-o-transform: scaleX(-1);
				transform: scaleX(-1);
				filter: fliph;
				"' ;
				$layout .= ' src="'.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_path'].'" height="100%" width="100%"/>';
				//se possui texto
				if (isset($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_text'])){
					$alturaBalao = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_height'];
					$larguraBalao = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_width'];
					$tamTexto = strlen($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_text']);
					$t = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_layout'];
					if ($t == 1) 		$stdFontSize = 1;
					else if ($t == 2) 	$stdFontSize = 2;
					else if ($t == 3) 	$stdFontSize = 1;
					else if ($t == 4) 	$stdFontSize = 1;
					else if ($t == 5) 	$stdFontSize = 1.4;
					$newFontSize = round(sqrt(pow($larguraBalao,2)+pow($alturaBalao,2))*$stdFontSize/log($tamTexto*2.4+2));//proporção entre tamanho do balão e o texto
					$layout .= '<div class="texto_balao" style="font-size: '.$newFontSize.'px; text-align:center;">'.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_text'].'</div>';
				}
				
				$layout .='</div>';	

}
	$layout .= '</div>';

?>

