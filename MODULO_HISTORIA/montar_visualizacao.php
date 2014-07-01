<?php
	include_once('../INCLUDES/conecta.php');
	include_once('../INCLUDES/uses.php');
	session_start();
	
	$layout .= "<table width='30%' height='60%' cellspacing=0 cellpadding=0 border=0 style='margin-top:20px;'>";
	//desenhar primeiro modelo de layout
	if ($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] == 1){
		$layout .= "<tr><td>";
		
		for ($i = 0; $i < 4; $i++){
			$layout.= "<div class='imprimir_quadrinho_padrao' style=' height: 150px; width: 260px; margin: 5px;'>";						
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
		$layout.= "<div class='imprimir_quadrinho_grande' style=' background:".$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario']."; height: 320px; width: 570px; margin: 5px;'>";
				include("desenha_quadrinho_imprimir.php");		  
		$layout.= "</div>";	
		$layout.="</td></tr>";
	}
	
	//desenhar terceiro modelo de layout
	if ($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] == 3){
		$i = 0;
		$layout.= "<tr><td colspan=2>";
		
		$layout.= "<div class='imprimir_quadrinho_emcima_grande' style=' background:".$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario']."; clear:both; height: 150px; width: 535px; margin: 5px;'>";
				include("desenha_quadrinho_imprimir.php");		  
		$layout.= "</div>";	
		
		$layout.= "</td></tr><tr><td>";
		for ($i = 1; $i < 3; $i++){
			$layout.= "<div class='imprimir_quadrinho_padrao' style=' background:".$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario']."; height: 150px; width: 260px; margin: 5px;'>";
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
			$layout.= "<div class='imprimir_quadrinho_seis_iguais' style=' background:".$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario']."; height: 130px; width: 190px; margin: 3px;'>";
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
			$layout.= "<div class='quadrinho_meio' style=' background:".$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario']."; height: 600px; width: 450px; margin: 5px;'>";
				include("desenha_quadrinho_imprimir.php");		  
		    $layout.="</div>";	
		}	
		$layout .= "</td></tr>";
	}
	
	$layout.= "</table></div>";
	echo $layout;
	
	
?>

