<?php
	include_once('../INCLUDES/uses.php');
	//header("Content-Type: text/html; charset=utf-8",true);
	$layout = "<div class='layout'>";
	
	//desenhar primeiro modelo de layout
	if ($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] == 1){
		for ($i = 0; $i < 4; $i++){
			$layout.= "<div class='quadrinho_padrao' id='quadrinho".$i."' onclick='entrarQuadrinho(".$i.")'>";
				include("desenha_quadrinho.php");		  
			$layout.= "</div>";		
		}	
	}
	
	//desenhar segundo modelo de layout
	if ($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] == 2){
		$i = 0;
		$layout.= "<div class='quadrinho_grande' id='quadrinho".$i."' onclick='entrarQuadrinho(".$i.")'>";
				include("desenha_quadrinho.php");		  
		$layout.= "</div>";	
	}
	
	//desenhar terceiro modelo de layout
	if ($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] == 3){
		$i = 0;
		$layout.= "<div class='quadrinho_emcima_grande' id='quadrinho".$i."' onclick='entrarQuadrinho(".$i.")'>";
				include("desenha_quadrinho.php");		  
		$layout.="</div>";	
		
		for ($i = 1; $i < 3; $i++){
			$layout.= "<div class='quadrinho_padrao' id='quadrinho".$i."' onclick='entrarQuadrinho(".$i.")'>";
				include("desenha_quadrinho.php");		  
		    $layout.="</div>";	
		}	
	}
	
	//desenhar quarto modelo de layout
	if ($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] == 4){
		for ($i = 0; $i < 6; $i++){
			$layout.= "<div class='quadrinho_seis_iguais' id='quadrinho".$i."' onclick='entrarQuadrinho(".$i.")'>";
				include("desenha_quadrinho.php");		  
		    $layout.="</div>";	
		}	
	}
	
	//desenhar quinto modelo de layout
	if ($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] == 5){
		for ($i = 0; $i < 2; $i++){
			$layout.= "<div class='quadrinho_meio' id='quadrinho".$i."' onclick='entrarQuadrinho(".$i.")'>";
				include("desenha_quadrinho.php");		  
		    $layout.="</div>";	
		}	
	}
	
	
	$layout.= "</div>";
	
	echo $layout;

	echo "<div class='barra_navegacao_layout'>";
		echo "<table width='100%'><tr><td width='20%'>";
			echo "<div class='seta_esq_barra_nav_layout' onclick='mudarQuadro(-1);'></div>";
		echo "</td><td width='60%' align='center'>";		
			echo "<div class='informar_quadro_atual_nav_layout'>".$_str["lblPage"]." ".$_SESSION['hist_quadro_atual']." ".$_str["lblOf"]." ".$_SESSION['hist_n_quadros']."</div>";
		echo "</td><td width='20%' align='right'>";			
			echo "<div class='seta_dir_barra_nav_layout' onclick='mudarQuadro(1);'></div>";
		echo "</td></tr></table>";
	echo "</div>";	
	
?>
