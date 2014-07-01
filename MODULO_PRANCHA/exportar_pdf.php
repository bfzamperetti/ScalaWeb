<?php
	session_start();
	include_once('../INCLUDES/uses.php');
	$layout = "<html> <head>
	<link href='styles/geral.css' rel='stylesheet' type='text/css' /> </head>
	<body>";
	
	$layout .= "<div class='vis_layout'>";
	$layout .= "<table class='vis_cab'><tr><td width='100%'> Prancha desenvolvida por: <span class='nome_usr_cab'>".$_SESSION['nome']."</span> </td> <td> ScalaWeb </td></tr> </table>";
	$layout .= "<table width='85%' height='75%' cellspacing=0 cellpadding=0 border=0>";
	//desenhar primeiro modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 1){
		$layout .= "<tr><td>";
		for ($i = 0; $i < 12; $i++){
			$layout.= "<div class='vis_prancha_padrao' style='height: 180px; width: 195px; margin: 10px;' id='vis_prancha".$i."'>";
				$layout.= "<div id='vis_img_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "") 
						$layout.=  "<img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='126px' />";
				else
					    $layout.=  "<img src='imagens/site/transparente.png' height='126px' />";
					$layout.=   "</div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_padrao' style='color: #000; z-index:99; position: relative;' id='vis_nome_prancha".$i."'>
						     ".tiraAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
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
		$layout.= "<div class='vis_prancha_superior_grande'  style='height: 400px; width: 845px; margin: 10px;' id='vis_prancha".$i."'>";
				$layout.= "<div id='vis_img_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "") 
						$layout.=  "<img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='320px' />";
				else
					    $layout.=  "<img src='imagens/site/transparente.png' height='320px' />";
					$layout.=   "</div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_superior_grande' id='vis_nome_prancha".$i."'>
						     ".tiraAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		$layout.= "</div>";	
		$layout.= "</td></tr><tr><td>";
		for ($i = 1; $i < 5; $i++){
			$layout.= "<div class='vis_prancha_padrao' style='height: 180px; width: 195px; margin: 10px;' id='vis_prancha".$i."' >";
				$layout.= "<div id='vis_img_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "") 
						$layout.=  "<img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='126px' />";
				else
					    $layout.=  "<img src='imagens/site/transparente.png' height='126px' />";
					$layout.=   "</div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_padrao' id='vis_nome_prancha".$i."'>
						     ".tiraAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
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
		$layout.= "<div class='vis_prancha_esquerda_grande' style='height: 590px; width: 420px; margin: 10px;' id='vis_prancha".$i."'>";
				$layout.= "<div id='vis_img_prancha".$i."' style='margin-top: 20px;'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "") 
						$layout.=  "<img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='400px' />";
				else
					    $layout.=  "<img src='imagens/site/transparente.png' height='400px' />";
					$layout.=   "</div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_esquerda_grande' id='vis_nome_prancha".$i."'>
						     ".tiraAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		$layout.= "</div>";	
		$layout.= "</td><td>";
		for ($i = 1; $i < 7; $i++){
			$layout.= "<div class='vis_prancha_padrao' style='height: 180px; width: 195px; margin: 10px;'  id='vis_prancha".$i."'>";
				$layout.= "<div id='vis_img_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "") 
						$layout.=  "<img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='126px' />";
				else
					    $layout.=  "<img src='imagens/site/transparente.png' height='126px' />";
					$layout.=   "</div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_padrao' id='vis_nome_prancha".$i."'>
						     ".tiraAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
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
		$layout.= "<div class='vis_prancha_superior_pequena' style='height: 180px; width: 845px; margin: 10px;' id='vis_prancha".$i."'>";
				$layout.= "<div id='vis_img_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "") 
						$layout.=  "<img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='126px' />";
				else
					    $layout.=  "<img src='imagens/site/transparente.png' height='126px' />";
					$layout.=   "</div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_superior_pequena' id='vis_nome_prancha".$i."'>
						     ".tiraAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		$layout.= "</div>";	
		$layout.= "</td></tr><tr><td rowspan=2>";
		$i++;
		$layout.= "<div class='vis_prancha_esquerda_pequena' style='height: 385px; width: 195px; margin: 10px;' id='vis_prancha".$i."'>";
				$layout.= "<div id='vis_img_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "") 
						$layout.=  "<img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' style='margin-top: 80px;' width='150px;' />";
				else
					    $layout.=  "<img src='imagens/site/transparente.png' height='150px' />";
					$layout.=   "</div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_esquerda_pequena' id='vis_nome_prancha".$i."'>
						     ".tiraAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		$layout.= "</div>";	
		$layout.= "</td><td>";
		for ($i = 2; $i < 8; $i++){
			$layout.= "<div class='vis_prancha_padrao' style='height: 180px; width: 195px; margin: 10px;' id='vis_prancha".$i."' >";
				$layout.= "<div id='vis_img_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "") 
						$layout.=  "<img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='126px' />";
				else
					    $layout.=  "<img src='imagens/site/transparente.png' height='126px' />";
					$layout.=   "</div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_padrao' id='vis_nome_prancha".$i."'>
						     ".tiraAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
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
		$layout.= "<tr>";
		for($i=0; $i<2; $i++){
			$layout.= "<td>";
			$layout.= "<div class='vis_prancha_esquerda_grande' style='height: 590px; width: 420px; margin: 10px;' id='vis_prancha".$i."'>";
					$layout.= "<div id='vis_img_prancha".$i."' style='margin-top: 20px;'>";
					if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "") 
							$layout.=  "<img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='400px' />";
					else
						    $layout.=  "<img src='imagens/site/transparente.png' height='400px' />";
						$layout.=   "</div>";
					if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
						$layout.= "<div class='nome_prancha_grande' id='vis_nome_prancha".$i."'>
							     ".tiraAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."

							  </div>";		  
			$layout.= "</div>";	
			$layout.= "</td>";
		}
		$layout.= "</tr>";
	}
	
	$layout.= "</table></div>";
	
	$layout .= "</body></html>";
	require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html($layout);
	$dompdf->set_paper('letter', 'landscape');
	$dompdf->render();
	$dompdf->stream("Prancha_".$_SESSION['nome']."(".date("d-m-y").").pdf");
echo $layout;
?>
