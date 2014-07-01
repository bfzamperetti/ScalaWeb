<?php
session_start();
	include_once('../INCLUDES/uses.php');
	$layout = "<html> 
	<head> <link href='styles/geral.css' rel='stylesheet' type='text/css' /> </head>
	<body>";
	
	//angulo que irá virar a div que engloba toda a folha de impressão
	$ang = 90;
	$cos = cos($ang);
	$sin = sin ($ang);
	
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
	if ($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] == 1){
		$layout .= "<tr><td>";
		
		for ($i = 0; $i < 4; $i++){
			$layout.= "<div class='imprimir_quadrinho_padrao' style=' height: 300px; width: 450px; margin: 5px;'>";						
				include("desenha_quadrinho_imprimir.php");
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
		$layout.= "<div class='imprimir_quadrinho_grande' style=' height: 600px; width: 920px;'>";
				include("desenha_quadrinho_imprimir.php");		  
		$layout.= "</div>";	
		$layout.="</td></tr>";
	}
	
	//desenhar terceiro modelo de layout
	if ($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] == 3){
		$i = 0;
		$layout.= "<tr><td colspan=2>";
		
		$layout.= "<div class='imprimir_quadrinho_emcima_grande' style='clear:both; height: 300px; width: 910px; margin: 5px;'>";
				include("desenha_quadrinho_imprimir.php");		  
		$layout.= "</div>";	
		
		$layout.= "</td></tr><tr><td>";
		for ($i = 1; $i < 3; $i++){
			$layout.= "<div class='imprimir_quadrinho_padrao' style='height: 300px; width: 450px; margin: 5px;'>";
				include("desenha_quadrinho_imprimir.php");		  
			$layout.= "</div>";	
			$layout .= "</td><td>";
						
		}
		$layout.= "</td></tr>";
	}
	
	//desenhar quarto modelo de layout
	if ($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] == 4){
		$i = 0;
		$layout.= "<tr><td>";
		
		for ($i = 0; $i < 6; $i++){
			$layout.= "<div class='imprimir_quadrinho_seis_iguais' style=' background:".$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario']."; height: 270px; width: 300px; margin: 3px;'>";
				include("desenha_quadrinho_imprimir.php");
			$layout.="</div>";
				
			if ($i == 2) $layout .= "</td></tr><tr><td>";
			else $layout .= "</td><td>";
			
		}
		$layout .= "</td></tr>";
	}
	
	//desenhar quinto modelo de layout
	if ($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] == 5){
		$layout .= "<tr><td>";
		
		for ($i = 0; $i < 2; $i++){
			$layout.= "<div class='imprimir_quadrinho_meio' style=' background:".$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario']."; height: 600px; width: 450px; margin: 5px;'>";
				include("desenha_quadrinho_imprimir.php");		  
		    $layout.="</div>";
		    
		    if ($i == 1) $layout .= "</td></tr><tr><td>";
			else $layout .= "</td><td>";	
		}	
		$layout .= "</td></tr>";
	}
	
	$layout.= "</table></div></div>";
		
	$layout.= "</body>";
	
	$layout .= "<script> window.print() </script>"; 
	$layout .= "</html> ";
	
	
	echo $layout;

?>
