
<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ScalaWeb</title>
<?php include_once('../INCLUDES/cabecalhos.php'); ?>
</head>
<body style="position: absolute; width:100%; height:100%; display:block;">
<?php if ($_SESSION['estado_varredura'] == 1) { 
	echo '<div class="camada_transparente" id="camada_index" style="top: 0;" onclick="clicks();"></div>'; 
	
}?>
<script>VetorLimparImagens = [];</script>

<div id="centro" class="visualizar">
<?php

	if (isset($_GET['id_prancha_limpar'])){
		include('atualizar_desfazer.php');
		$_SESSION['pathimg_prancha'.$_GET['id_prancha_limpar'].'_qdr'.$_SESSION['quadro_atual']] = "";
		$_SESSION['nome_prancha'.$_GET['id_prancha_limpar'].'_qdr'.$_SESSION['quadro_atual']] = "";
		$_SESSION['ocupada_prancha'.$_GET['id_prancha_limpar'].'_qdr'.$_SESSION['quadro_atual']] = 0;
		$_SESSION['pathvoz_prancha'.$_GET['id_prancha_limpar'].'_qdr'.$_SESSION['quadro_atual']] = ""; 			
	}
	
	if (isset($_GET['tipo_novo_layout'])){
		include('apagar_tudo_varredura.php');
	}


	if (isset($_GET['quadro_atual']))
		 if (($_GET['quadro_atual'] > 0) && ($_GET['quadro_atual'] <= $_SESSION['n_quadros']))
			$_SESSION['quadro_atual'] = $_GET['quadro_atual'];
		
	include_once('../INCLUDES/uses.php');
//	header("Content-Type: text/html; charset=utf-8",true);
	$layout = "<div class='layout'>";
	//desenhar primeiro modelo de layout
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 1){
		for ($i = 0; $i < 12; $i++){
			echo "<script>VetorLimparImagens.push('prancha".$i."');</script>";
			$layout.= "<div style='border: 2px solid transparent;' class='prancha_padrao' id='prancha".$i."' onclick='repPrancha(".$i.");'>";
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
		echo "<script>VetorLimparImagens.push('prancha".$i."');</script>";
		$layout.= "<div style='border: 2px solid transparent;' class='prancha_superior_grande' id='prancha".$i."' onclick='repPrancha(".$i.");'>";
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
			echo "<script>VetorLimparImagens.push('prancha".$i."');</script>";
			$layout.= "<div style='border: 2px solid transparent;' class='prancha_padrao' id='prancha".$i."' onclick='repPrancha(".$i.");'>";
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
		echo "<script>VetorLimparImagens.push('prancha".$i."');</script>";
		$layout.= "<div style='border: 2px solid transparent;' class='prancha_esquerda_grande' id='prancha".$i."' onclick='repPrancha(".$i.");'>";
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
			echo "<script>VetorLimparImagens.push('prancha".$i."');</script>";
			$layout.= "<div style='border: 2px solid transparent;' class='prancha_padrao' id='prancha".$i."' onclick='repPrancha(".$i.");'>";
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
		echo "<script>VetorLimparImagens.push('prancha".$i."');</script>";
		$layout.= "<div style='border: 2px solid transparent;' class='prancha_superior_pequena' id='prancha".$i."' onclick='repPrancha(".$i.");'>";
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
		echo "<script>VetorLimparImagens.push('prancha".$i."');</script>";
		$layout.= "<div style='border: 2px solid transparent;' class='prancha_esquerda_pequena' id='prancha".$i."' onclick='repPrancha(".$i.");'>";
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
			echo "<script>VetorLimparImagens.push('prancha".$i."');</script>";
			$layout.= "<div style='border: 2px solid transparent;' class='prancha_padrao' id='prancha".$i."' onclick='repPrancha(".$i.");'>";
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
	
	
	if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 5){
		$i = 0;
		for ($i = 0; $i < 2; $i++){
			echo "<script>VetorLimparImagens.push('prancha".$i."');</script>";
			$layout.= "<div style='border: 2px solid transparent;' class='prancha_esquerda_grande' id='prancha".$i."' onclick='repPrancha(".$i.");'>";
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

	include("stylesThatNeedLanguageSpecification.php");
	include("../INCLUDES/strings.php");

	echo "<div class='barra_navegacao_layout'>";
		echo "<table width='100%'><tr><td width='20%'>";
			echo "<div id='seta_esq_visualizar' class='seta_esq_barra_nav_layout' onclick='location.href=\"visualizar.php?quadro_atual=".($_SESSION['quadro_atual']-1)."\";'></div>";
		echo "</td><td width='60%' align='center'>";		
			echo "<div class='informar_quadro_atual_nav_layout'> ".$_str['lblPage']." " . "".$_SESSION['quadro_atual']." " . "".$_str['lblOf']." " . "".$_SESSION['n_quadros']."</div>";
		echo "</td><td width='20%' align='right'>";			
			echo "<div id='seta_dir_visualizar' class='seta_dir_barra_nav_layout' onclick='location.href=\"visualizar.php?quadro_atual=".($_SESSION['quadro_atual']+1)."\";'></div>";
		echo "</td></tr></table>";
	echo "</div>";	
	echo "<script>
				  VetorLimparImagens.push('seta_esq_visualizar');	
	              VetorLimparImagens.push('seta_dir_visualizar');
	              VetorLimparImagens.push('voltar_visualizar');
				  VetorLimparImagens.push('apagar_tudo');
				  		              			      
		  </script>";
?>

</div>
<div  style="display:block; position: absolute; top: 0; left:94.5%; height: 100%; width: 5%;">
		<a href="index.php"><img  style='border: 2px solid transparent;' id="voltar_visualizar" src="imagens/site/icones_legendados_<?php echo $_SESSION["lang"];?>/voltarLegenda.png" width="100%"/></a>		
		<img id="apagar_tudo" style='border: 2px solid transparent;' src="imagens/site/icones_legendados_<?php echo $_SESSION["lang"];?>/limpar_tudo.png" width="100%"/>
</div>

<div id="som_varredura"></div>

<?php
	echo "<script>
		estadoVarCategorias = 0;
		controlaVarredura = 0;
		varredura_atual = 'pag_limpar';
		cor='".$_SESSION['cor_varredura']."';
		quadro_atual_visualizar = ".$_SESSION['quadro_atual'].";
		varreduraImgsCatEComplexa(".$_SESSION['tempo_varredura'].", -1);
		</script>";		
?>	
</body>
</html>
