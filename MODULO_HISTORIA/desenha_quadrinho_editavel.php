<?php
if (!session_id()) session_start();
// desenhar cenario
echo '<div class="cenario"';
	$bg = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_cenario'];
	if ($bg[0] == '#')
		echo ' style="background: '.$bg.';">';
	else
		echo '><img src="'.$bg.'" width="100%" height="100%" style="position:absolute"  onmousedown="event.preventDefault ? event.preventDefault() : event.returnValue = false">';
echo '</div>';
// fim desenhar cenario


$inicio = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_ini'];
$fim = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_fim'];
for($i = $inicio; $i <  $fim; $i++){
	$ang = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_ang'];
	$cos = cos($ang);
	$sin = sin($ang);
	echo '<div class="imgquad" id="imgQuad'.$i.'" 
				style="
				';
	if (isset($_GET['id'])) if ($i == $_GET['id']) echo ' background: #eee; border: 1px dashed #fff; ';			
	echo '
				-moz-transform: rotate('.$ang.'.0deg);  
				-o-transform: rotate('.$ang.'.0deg);  
				-webkit-transform: rotate('.$ang.'.0deg);  
				-ms-transform: rotate('.$ang.'.0deg);  
				transform: rotate('.$ang.'.0deg);  
				filter: progid:DXImageTransform.Microsoft.Matrix( 
                 M11='.$cos.', M12=-'.$sin.', M21='.$sin.', M22='.$cos.', sizingMethod=\'auto expand\');
				zoom: 1;
				display:block;
				left:'.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_left'].'%; 
				top:'.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_top'].'%;
				height:'.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_height'].'%; 
				width:'.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_width'].'%; 
				">';
				
				$tam = getimagesize($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_path']);
				$css = "";
				if ($tam[0] > $tam[1]){
					$tam[1] = $tam[1]*100 / $tam[0];
					$tam[0] = 100;
					$css = " margin-top: ".(((100 - $tam[1])/2)*0.8)."%; ";
				}
				else{
					$tam[0] = $tam[0]*100 / $tam[1];
					$tam[1] = 100;
					$css = " margin-left: ".((100 - $tam[0])/2)."%; ";
				}
				echo '
				<img height="'.$tam[1].'%" width="'.$tam[0].'%" style=" '.$css;
				if ($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_inv'] == 1)
				echo '
				-webkit-transform: scaleX(-1);
				-moz-transform: scaleX(-1);
				-ms-transform: scaleX(-1);
				-o-transform: scaleX(-1);
				transform: scaleX(-1);
				filter: fliph;
				"' ;
				echo '" id="imgimgQuad'.$i.'" src="'.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_path'].'" />';
				if (isset($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_text'])){
					$alturaBalao = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_height'];
					$larguraBalao = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_width'];
					$tamTexto = strlen($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_text']);
					$t = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_layout'];
					if ($t == 1) 		$stdFontSize = 2.4;
					else if ($t == 2) 	$stdFontSize = 2;
					else if ($t == 3) 	$stdFontSize = 1.2;
					else if ($t == 4) 	$stdFontSize = 1.4;
					else if ($t == 5) 	$stdFontSize = 1.4;
					$newFontSize = round(sqrt(pow($larguraBalao,2)+pow($alturaBalao,2))*$stdFontSize/log($tamTexto*2.4+2));//proporção entre tamanho do balão e o texto
					echo '<div class="texto_balao" id="texto_balao'.$i.'" style="font-size: '.$newFontSize.'px; text-align: center;">'.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_text'].'</div>';
				}

				
		  echo '</div>';	
}
?>
