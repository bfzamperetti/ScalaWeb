<?php
	include_once('../INCLUDES/conecta.php');
	include_once('../INCLUDES/uses.php');
	session_start();

	//desenhar primeiro modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 1){
		for ($i = 0; $i < 12; $i++){
			echo "<div class='vis_prancha_padrao' id='vis_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_img_prancha_padrao' id='vis_img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='70%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_nome_prancha_padrao' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
			echo "</div>";		
		}	
	}
	
	//desenhar segundo modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 2){
		$i = 0;
		echo "<div class='vis_prancha_superior_grande' id='vis_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_img_prancha_superior_grande' id='vis_img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='70%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_nome_prancha_superior_grande' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		echo "</div>";	
		for ($i = 1; $i < 5; $i++){
			echo "<div class='vis_prancha_padrao' id='vis_prancha".$i."' >";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_img_prancha_padrao' id='vis_img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='70%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_nome_prancha_padrao' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
			echo "</div>";		
		}	
	}
	
	//desenhar terceiro modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 3){
		$i = 0;
		echo "<div class='vis_prancha_esquerda_grande' id='vis_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_img_prancha_esquerda_grande' id='vis_img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='70%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_nome_prancha_esquerda_grande' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		echo "</div>";	
		for ($i = 1; $i < 7; $i++){
			echo "<div class='vis_prancha_padrao' id='vis_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_img_prancha_padrao' id='vis_img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='70%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_nome_prancha_padrao' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
			echo "</div>";		
		}	
	}
	
	//desenhar quarto modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 4){
		$i = 0;
		echo "<div class='vis_prancha_superior_pequena' id='vis_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_img_prancha_superior_pequena' id='vis_img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='70%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_nome_prancha_superior_pequena' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		echo "</div>";	
		$i++;
		echo "<div class='vis_prancha_esquerda_pequena' id='vis_prancha".$i."'>";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_img_prancha_esquerda_pequena' id='vis_img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='70%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_nome_prancha_esquerda_pequena' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
		echo "</div>";	
		for ($i = 2; $i < 8; $i++){
			echo "<div class='vis_prancha_padrao' id='vis_prancha".$i."' >";
				if ($_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_img_prancha_padrao' id='vis_img_prancha".$i."'>
						     <img src='".$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']]."' height='70%' />
						  </div>";
				if ($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] != "")
					echo "<div class='vis_nome_prancha_padrao' id='vis_nome_prancha".$i."'>
						     ".upperAcentos($_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']])."
						  </div>";		  
			echo "</div>";		
		}	
	}
	
	
	
?>
