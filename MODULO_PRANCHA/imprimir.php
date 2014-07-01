<?php
	session_start();
	include_once('../INCLUDES/uses.php');
	$layout = "<html> <head>
	<link href='styles/geral.css' rel='stylesheet' type='text/css' /> <style> .nome_prancha_padrao{ font-size: 10px; } </style> </head>
	<body>";
	
	
	$tamPag = 800;//tamanho de um página em pixels, pranchas são frações de uma página
	
	//vis_prancha_padrao	
	$widthPranchaPadrao = ($tamPag/3)-60;
	$heightPranchaPadrao = ($tamPag/4)-60;
	//vis_prancha_esquerda_grande	
	$tamPranchaQuadrada = ($tamPag/2)+30;
	//vis_prancha_superior_grande
	$heightRetangulo2x4 = (2*$heightPranchaPadrao);
	$widthRetangulo2x4 = (4*$widthPranchaPadrao)+60;
	//vis_prancha_superior_pequena
	$heightRetangulo1x4 = ($heightPranchaPadrao);
	$widthRetangulo1x4 = (4*$widthPranchaPadrao);
	//vis_prancha_esquerda_pequena
	$heightRetangulo2x1 = (2*$heightPranchaPadrao);
	$widthRetangulo2x1 = ($widthPranchaPadrao);
	
	//angulo que irá virar a div que engloba toda a folha de impressão
	$ang = 90;
	$cos = cos($ang);
	$sin = sin ($ang);
	
	$layout .= "<table class='vis_cab'><tr><td width='100%'> Prancha desenvolvida por: <span class='nome_usr_cab'>".$_SESSION['nome']."</span> </td> <td> ScalaWeb </td></tr> </table>";
	$layout .= "<div id='imprimir'>";
	
	//div que irá virar em 90º para a impressão ficar modo paisagem 
	$layout .= "<div style=' 					
				-moz-transform: rotate(".$ang.".0deg);  
				-o-transform: rotate(".$ang.".0deg);  
				-webkit-transform: rotate(".$ang.".0deg);  
				-ms-transform: rotate(".$ang.".0deg);  
				transform: rotate(".$ang.".0deg);  
				filter: progid:DXImageTransform.Microsoft.Matrix( 
                 M11=".$cos.", M12=-".$sin.", M21=".$sin.", M22=".$cos.", sizingMethod=\"auto expand\"); '>";
	
	$layout .= "<table margin=0 cellspacing=0 cellpadding=0 border=0 >";
	
	
	//desenhar primeiro modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 1){
		$layout .= "<tr><td>";
		for ($i = 0; $i < 12; $i++){
			$layout.= "<div class='vis_prancha_padrao' style='height: ".$heightPranchaPadrao."px; width: ".$widthPranchaPadrao."px; margin: 5px;' id='vis_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_padrao' id='vis_img_prancha".$i."'>
								<img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='70%' />
								</div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_padrao' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
								</div>";		  
			$layout.= "</div>";
			if ($i != 11){
				if (($i+1)%4 == 0)
					$layout .= "</td></tr><tr><td>";
				else
					$layout .= "</td><td>";
			}
		}
		$layout .= "</td></tr>";
	}
	
	//desenhar segundo modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 2){
		$i = 0;
		$layout.= "<tr><td colspan=4>";
		$layout.= "<div class='vis_prancha_superior_grande'  style='height: ".$heightRetangulo2x4."px; width: ".$widthRetangulo2x4."px; margin: 5px;' id='vis_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_superior_grande' id='vis_img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='70%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_superior_grande' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		$layout.= "</div>";	
		$layout.= "</td></tr><tr><td>";
		for ($i = 1; $i < 5; $i++){
			$layout.= "<div class='vis_prancha_padrao' style='height: ".$heightPranchaPadrao."px; width: ".$widthPranchaPadrao."px; margin: 5px;' id='vis_prancha".$i."' >";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_padrao' id='vis_img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='70%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_padrao' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
			$layout.= "</div>";		
			if ($i != 4){
				$layout.="</td><td>";
			}
		}	
		$layout.="</td></tr>";
	}
	
	//desenhar terceiro modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 3){
		$i = 0;
		$layout.= "<tr><td rowspan=3>";
		$layout.= "<div class='vis_prancha_esquerda_grande' style='height: ".$tamPranchaQuadrada."px; width: ".$tamPranchaQuadrada."px; margin: 5px;' id='vis_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_esquerda_grande' style='margin-top: 50px;' id='vis_img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' width='90%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_esquerda_grande' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		$layout.= "</div>";	
		$layout.= "</td><td>";
		for ($i = 1; $i < 7; $i++){
			$layout.= "<div class='vis_prancha_padrao' style='height: ".$heightPranchaPadrao."px; width: ".$widthPranchaPadrao."px; margin: 5px;'  id='vis_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_padrao' id='vis_img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='70%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_padrao' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
			$layout.= "</div>";
			if ($i != 6){
				if ($i%2 == 0)
					$layout .= "</td></tr><tr><td>";
				else
					$layout .= "</td><td>";
			}			
		}
		$layout.= "</td><tr>";
	}
	
	//desenhar quarto modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 4){
		$i = 0;
		$layout.= "<tr><td colspan=4>";
		$layout.= "<div class='vis_prancha_superior_pequena' style='height: ".$heightRetangulo1x4."px; width: ".$widthRetangulo1x4."px; margin: 5px;' id='vis_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_superior_pequena' id='vis_img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='70%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_superior_pequena' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		$layout.= "</div>";	
		$layout.= "</td></tr><tr><td rowspan=2>";
		$i++;
		$layout.= "<div class='vis_prancha_esquerda_pequena' style='height: ".$heightRetangulo2x1."px; width: ".$widthRetangulo2x1."px; margin: 5px;' id='vis_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_esquerda_pequena' id='vis_img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' style='margin-top: 40px;' width='90%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_esquerda_pequena' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		$layout.= "</div>";	
		$layout.= "</td><td>";
		for ($i = 2; $i < 8; $i++){
			$layout.= "<div class='vis_prancha_padrao' style='height: ".$heightPranchaPadrao."px; width: ".$widttPranchaPadrao."px; margin: 5px;' id='vis_prancha".$i."' >";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_padrao' id='vis_img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='70%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_padrao' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
			$layout.= "</div>";		
			if ($i != 7){
				if ($i%4 == 0)
					$layout .= "</td></tr><tr><td>";
				else
					$layout .= "</td><td>";
			}	
		}
		$layout .= "</td></tr>";
	}
	//desenhar quinto modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 5){
		for($i=0; $i<2; $i++){
			$layout.= "<tr><td rowspan=3>";
			$layout.= "<div class='vis_prancha_esquerda_grande' style='height: ".$tamPranchaQuadrada."px; width: ".$tamPranchaQuadrada."px; margin: 5px;' id='vis_prancha".$i."'>";
					if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
						$layout.= "<div class='img_prancha_esquerda_grande' style='margin-top: 50px;' id='vis_img_prancha".$i."'>

							     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' width='90%' />
							  </div>";
					if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
						$layout.= "<div class='nome_prancha_grande' id='vis_nome_prancha".$i."'>
							     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
							  </div>";		  
			$layout.= "</div>";	
			$layout.= "</td><td>";
		}
	}
	
	$layout.= "</table></div></div>";
	
	$layout.= "</body>";
	
	$layout .= "<script> window.print() </script>"; 
	$layout .= "</html> ";
	
	
	echo $layout;
