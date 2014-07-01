<?php
	include_once('../INCLUDES/uses.php');
	
	$layout = "<div class='layout'>";
	//desenhar primeiro modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 1){
		for ($i = 0; $i < 12; $i++){
			$layout.= "<div class='prancha_padrao' id='prancha".$i."' onclick='clickPrancha(".$i.", ".$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']].");'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_padrao' id='img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='100%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_padrao' id='nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
			$layout.= "</div>";		
		}	
	}
	
	//desenhar segundo modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 2){
		$i = 0;
		$layout.= "<div class='prancha_superior_grande' id='prancha".$i."' onclick='clickPrancha(".$i.", ".$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']].");'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_superior_grande' id='img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='100%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_superior_grande' id='nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		$layout.= "</div>";	
		for ($i = 1; $i < 5; $i++){
			$layout.= "<div class='prancha_padrao' id='prancha".$i."' onclick='clickPrancha(".$i.", ".$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']].");'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_padrao' id='img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='100%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_padrao' id='nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
			$layout.= "</div>";		
		}	
	}
	
	//desenhar terceiro modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 3){
		$i = 0;
		$layout.= "<div class='prancha_esquerda_grande' id='prancha".$i."' onclick='clickPrancha(".$i.", ".$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']].");'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_esquerda_grande' id='img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='100%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_esquerda_grande' id='nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		$layout.= "</div>";	
		for ($i = 1; $i < 7; $i++){
			$layout.= "<div class='prancha_padrao' id='prancha".$i."' onclick='clickPrancha(".$i.", ".$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']].");'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_padrao' id='img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='100%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_padrao' id='nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
			$layout.= "</div>";		
		}	
	}
	
	//desenhar quarto modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 4){
		$i = 0;
		$layout.= "<div class='prancha_superior_pequena' id='prancha".$i."' onclick='clickPrancha(".$i.", ".$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']].");'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_superior_pequena' id='img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='100%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_superior_pequena' id='nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		$layout.= "</div>";	
		$i++;
		$layout.= "<div class='prancha_esquerda_pequena' id='prancha".$i."' onclick='clickPrancha(".$i.", ".$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']].");'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_esquerda_pequena' id='img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='100%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_esquerda_pequena' id='nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		$layout.= "</div>";	
		for ($i = 2; $i < 8; $i++){
			$layout.= "<div class='prancha_padrao' id='prancha".$i."' onclick='clickPrancha(".$i.", ".$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']].");'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='img_prancha_padrao' id='img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='100%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					$layout.= "<div class='nome_prancha_padrao' id='nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
			$layout.= "</div>";		
		}	
	}
	
	//desenhar quinto modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 5){
		for ($i = 0; $i < 2; $i++){
			$layout.= "<div class='prancha_esquerda_grande' id='prancha".$i."' onclick='clickPrancha(".$i.", ".$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']].");'>";
					if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
						$layout.= "<div class='img_prancha_esquerda_grande' id='img_prancha".$i."'>
								 <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='100%' />
							  </div>";
					if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
						$layout.= "<div class='nome_prancha_esquerda_grande' id='nome_prancha".$i."'>
								 ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
							  </div>";		  
			$layout.= "</div>";
		}
	}
	
	
	$layout.= "</div>";
	
	echo $layout;

	echo "<div class='barra_navegacao_layout'>";
		echo "<table width='100%'><tr><td width='20%'>";
			echo "<div class='seta_esq_barra_nav_layout' id='seta_esq_barra_layout' onclick='mudarQuadro(-1);'></div>";
		echo "</td><td width='60%' align='center'>";		
			echo "<div class='informar_quadro_atual_nav_layout'>P&aacute;gina ".$_SESSION['quadro_atual']." de ".$_SESSION['n_quadros']."</div>";
		echo "</td><td width='20%' align='right'>";			
			echo "<div class='seta_dir_barra_nav_layout' id='seta_dir_barra_layout' onclick='mudarQuadro(1);'></div>";
		echo "</td></tr></table>";
	echo "</div>";	
	
?>
