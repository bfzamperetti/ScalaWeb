<?php

session_start();
	include_once('../INCLUDES/uses.php');
	$layout = "<html> 
	<head> <link href='styles/geral.css' rel='stylesheet' type='text/css' /> </head>
	<body>";
	
	$layout .= "<div id='imprimir'>";
	//$layout .= "<table class='hist_vis_cab'><tr><td width='100%'> Prancha desenvolvida por: <span class='nome_usr_cab'>".$_SESSION['nome']."</span> </td> <td> ScalaWeb </td></tr> </table>";
	$layout .= "<table cellspacing=0 cellpadding=0 border=0 style='margin-top:15px; margin-left:15px;'>"; 

	//desenhar primeiro modelo de layout
	if ($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] == 1){ 
		$layout .= "<tr><td>";
		
		for ($i = 0; $i < 4; $i++){
				$layout.= "<div class='imprimir_quadrinho_padrao' style='height: 250px; width: 500px; margin: 5px;";
					$bg = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'];
					if ($bg[0] == '#')
						$layout.= "background: ".$bg.";'>";
					else
						$layout.= "'> <img src='".$bg."' width='100%' height='100%' style='position: absolute;'>";
											
				$inicio = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'];
				$fim = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'];
				if ($fim == $inicio) 
					$layout.=  "<img src='imagens/site/transparente.png' width='400px' />";
				for($j = $inicio; $j <  $fim; $j++){
					//quando a imagem tiver sido girada
					if (($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'] != 0) &&
						($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_path'] != '')){
							
						//copiar imagem do servidor
						$origem = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_path'];
						$img_id1 = end(explode("/",$origem));
						$nomeimg = $img_id1;  
						$destino = "imagens/exportar_temp/".$_SESSION['login']."/".$j.$nomeimg;
						
						$orig = fopen($origem, "r");
						$dest = fopen($destino, "w");
						while (!feof($orig)) {
							$line = fread ($orig, 1024);
							fwrite($dest, $line);
						}
						fclose($orig);
						fclose($dest);
						
						chmod ($destino, 0777);
						
						//girar imagem copiada
						$filename = $destino;
						$rotang = -$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'];
						$source = imagecreatefrompng($filename) or die('Error opening file '.$filename);
						imagealphablending($source, false);
						imagesavealpha($source, true);
						$rotation = imagerotate($source, $rotang, imageColorAllocateAlpha($source, 0, 0, 0, 127));
						imagealphablending($rotation, false);
						imagesavealpha($rotation, true);
						header('Content-type: image/png');
						imagepng($rotation,$destino);
					}
								
					$left = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_left']*5;
					$top = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_top']*2.5;
					$height = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_height']*2.5;
					$width = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_width']*5;
						
					include("desenha_quadrinho_exportar.php");	
				}
								
			$layout.="</div>";
				
			if ($i != 3){
				if (($i+1)%2 == 0)
					$layout .= "</td></tr><tr><td>";
				else
					$layout .= "</td><td>";
			}
		}
		$layout .= "</td></tr>"; 
	}
	
	//desenhar segundo modelo de layout
	if ($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] == 2){

		$i = 0;		
		$layout.= "<tr><td>";
		//$layout.= "<div class='imprimir_quadrinho_grande' style=' position:relative; height: 500px; width: 1000px;'>";
			
				$layout.= "<div class='imprimir_quadrinho_grande' style='position:relative; color:#000; height: 500px; width: 1000px;";
					$bg = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'];
					if ($bg[0] == '#')
						$layout.= "background: ".$bg.";'>";
					else
						$layout.= "'> <img src='".$bg."' width='100%' height='100%' style='position: absolute;'>";		
			
			$inicio = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'];
			$fim = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'];
			if ($fim == $inicio) 
				$layout.=  "<img src='imagens/site/transparente.png' width='850px' />";
			for($j = $inicio; $j <  $fim; $j++){
				//quando a imagem tiver sido girada
				if (($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'] != 0) &&
				    ($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_path'] != '')){
						
					//copiar imagem do servidor
					$origem = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_path'];
					$img_id1 = end(explode("/",$origem));
					$nomeimg = $img_id1;  
					$destino = "imagens/exportar_temp/".$j.$nomeimg;
					$orig = fopen($origem, "r");
					$dest = fopen($destino, "w");
					while (!feof($orig)) {
						$line = fread ($orig, 1024);
						fwrite($dest, $line);
					}
					fclose($orig);
					fclose($dest);
					
					//girar imagem copiada
					$filename = $destino;
					$rotang = -$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'];
					$source = imagecreatefrompng($filename) or die('Error opening file '.$filename);
					imagealphablending($source, false);
					imagesavealpha($source, true);
					$rotation = imagerotate($source, $rotang, imageColorAllocateAlpha($source, 0, 0, 0, 127));
					imagealphablending($rotation, false);
					imagesavealpha($rotation, true);
					header('Content-type: image/png');
					imagepng($rotation,$destino);
				}
							
				$left = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_left']*10;
				$top = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_top']*5;
				$height = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_height']*5;
				$width = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_width']*10;
				    
				include("desenha_quadrinho_exportar.php");	
				}	  
	$layout.= "</div>";	
	$layout.="</td></tr>";
}
	
	//desenhar terceiro modelo de layout
	if ($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] == 3){
		$i = 0;
		$layout.= "<tr><td colspan=2>";
		
			$layout.= "<div class='imprimir_quadrinho_emcima_grande' style='clear:both; height: 250px; width: 1000px; margin:5px;";
					$bg = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'];
					if ($bg[0] == '#')
						$layout.= "background: ".$bg.";'>";
					else
						$layout.= "'> <img src='".$bg."' width='100%' height='100%' style='position: absolute;'>";
		
		
			$inicio = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'];
			$fim = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'];
			if ($fim == $inicio) 
				$layout.=  "<img src='imagens/site/transparente.png' width='100%' />";
			for($j = $inicio; $j <  $fim; $j++){
				//quando a imagem tiver sido girada
				if (($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'] != 0) &&
				    ($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_path'] != '')){
						
					//copiar imagem do servidor
					$origem = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_path'];
					$img_id1 = end(explode("/",$origem));
					$nomeimg = $img_id1;  
					$destino = "imagens/exportar_temp/".$j.$nomeimg;
					$orig = fopen($origem, "r");
					$dest = fopen($destino, "w");
					while (!feof($orig)) {
						$line = fread ($orig, 1024);
						fwrite($dest, $line);
					}
					fclose($orig);
					fclose($dest);
					
					//girar imagem copiada
					$filename = $destino;
					$rotang = -$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'];
					$source = imagecreatefrompng($filename) or die('Error opening file '.$filename);
					imagealphablending($source, false);
					imagesavealpha($source, true);
					$rotation = imagerotate($source, $rotang, imageColorAllocateAlpha($source, 0, 0, 0, 127));
					imagealphablending($rotation, false);
					imagesavealpha($rotation, true);
					header('Content-type: image/png');
					imagepng($rotation,$destino);
				}
							
				$left = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_left']*10;
				$top = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_top']*2.5;
				$height = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_height']*2.5;
				$width = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_width']*10;
				    
			    include("desenha_quadrinho_exportar.php");				
			}			  
	$layout.= "</div>";	

	$layout.= "</td></tr><tr><td>";
	for ($i = 1; $i < 3; $i++){

		$layout.= "<div class='imprimir_quadrinho_padrao' style=' height: 250px; width: 495px; margin: 5px;";
					$bg = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'];
					if ($bg[0] == '#')
						$layout.= "background: ".$bg.";'>";
					else
						$layout.= "'> <img src='".$bg."' width='100%' height='100%' style='position: absolute;' />";
		
		
		
		$inicio = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'];
		$fim = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'];
		if ($fim == $inicio) 
			$layout.=  "<img src='imagens/site/transparente.png' width='395px' />";
		for($j = $inicio; $j <  $fim; $j++){
			//quando a imagem tiver sido girada
			if (($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'] != 0) &&
				    ($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_path'] != '')){
						
					//copiar imagem do servidor
					$origem = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_path'];
					$img_id1 = end(explode("/",$origem));
					$nomeimg = $img_id1;  
					$destino = "imagens/exportar_temp/".$j.$nomeimg;
					$orig = fopen($origem, "r");
					$dest = fopen($destino, "w");
					while (!feof($orig)) {
						$line = fread ($orig, 1024);
						fwrite($dest, $line);
					}
					fclose($orig);
					fclose($dest);
					
					//girar imagem copiada
					$filename = $destino;
					$rotang = -$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'];
					$source = imagecreatefrompng($filename) or die('Error opening file '.$filename);
					imagealphablending($source, false);
					imagesavealpha($source, true);
					$rotation = imagerotate($source, $rotang, imageColorAllocateAlpha($source, 0, 0, 0, 127));
					imagealphablending($rotation, false);
					imagesavealpha($rotation, true);
					header('Content-type: image/png');
					imagepng($rotation,$destino);
				}
							
				$left = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_left']*4.95;
				$top = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_top']*2.5;
				$height = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_height']*2.5;
				$width = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_width']*4.95;
				    
			    include("desenha_quadrinho_exportar.php");	
					
		}		  
		
		$layout .= "</td><td>";
					
	}
	$layout.= "</div>";	
	$layout.= "</td></tr>";
}
	
	//desenhar quarto modelo de layout
	if ($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] == 4){
		$i = 0;
		$layout.= "<tr><td>";
		
		for ($i = 0; $i < 6; $i++){
				$layout.= "<div class='imprimir_quadrinho_seis_iguais' style=' height: 160px; width: 270px; margin: 3px;";
					$bg = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'];
					if ($bg[0] == '#')
						$layout.= "background: ".$bg.";'>";
					else
						$layout.= "'> <img src='".$bg."' width='100%' height='100%' style='position: absolute;'>";

			
			
			$inicio = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'];
			$fim = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'];
			if ($fim == $inicio) 
				$layout.=  "<img src='imagens/site/transparente.png' width='270px' />";
			for($j = $inicio; $j <  $fim; $j++){
				//quando a imagem tiver sido girada
				if (($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'] != 0) &&
				    ($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_path'] != '')){
						
					//copiar imagem do servidor
					$origem = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_path'];
					$img_id1 = end(explode("/",$origem));
					$nomeimg = $img_id1;  
					$destino = "imagens/exportar_temp/".$j.$nomeimg;
					$orig = fopen($origem, "r");
					$dest = fopen($destino, "w");
					while (!feof($orig)) {
						$line = fread ($orig, 1024);
						fwrite($dest, $line);
					}
					fclose($orig);
					fclose($dest);
					
					//girar imagem copiada
					$filename = $destino;
					$rotang = -$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_ang'];
					$source = imagecreatefrompng($filename) or die('Error opening file '.$filename);
					imagealphablending($source, false);
					imagesavealpha($source, true);
					$rotation = imagerotate($source, $rotang, imageColorAllocateAlpha($source, 0, 0, 0, 127));
					imagealphablending($rotation, false);
					imagesavealpha($rotation, true);
					header('Content-type: image/png');
					imagepng($rotation,$destino);
				}
							
				$left = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_left']*2.7;
				$top = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_top']*1.6;
				$height = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_height']*1.6;
				$width = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_imgquad'.$j.'_width']*2.7;
				    
			    include("desenha_quadrinho_exportar.php");	
			}
			
			$layout.="</div>";
				
			if ($i == 2) $layout .= "</td></tr><tr><td>";
			else $layout .= "</td><td>";
			
		}
		$layout .= "</td></tr>";
	}
	
	$layout.= "</table></div>";
		
	$layout.= "</body>";
	
	$layout .= "</html> ";

	
?>
<?php 
	require_once("../INCLUDES/dompdf/dompdf_config.inc.php");
 
	$dompdf = new DOMPDF();
	$dompdf->load_html($layout);
	$dompdf->set_paper('letter', 'landscape');
	$dompdf->render();
	$dompdf->stream("História_".$_SESSION['nome']."(".date("d-m-y").").pdf");

?>
