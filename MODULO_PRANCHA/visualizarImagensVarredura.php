<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ScalaWeb</title>
<script>cor = '<?php echo $_SESSION['cor_varredura'];  ?>';</script>
<?php include_once('../INCLUDES/cabecalhos.php'); ?>
</head>
<body style="position: absolute; width:100%; height:100%; display:block;">
<?php if ($_SESSION['estado_varredura'] == 1) { 
	echo '<div class="camada_transparente" id="camada_index" onclick="clicks();"></div>'; 
	
}?>
<div id="centroVar" class="visualizar">
	<script>
		VetorVarreduraImagens = [];
		VetorVarreduraImgsDivs = [];
	</script>
<?php
	include_once('../INCLUDES/conecta.php');
	include_once('../INCLUDES/uses.php');
	if (!isset($_SESSION['url_imagens']))
		session_start();
		
	$ultimapag = 'nao';
		
	if ($_GET['categoria'] >= 0){ //escolher nova categoria
		$categoria = $_GET['categoria'];
		$_SESSION['categoria_varredura'] = $_GET['categoria'];
	}
	else //voltando para escolher mais imagens na categoria anterior
		$categoria = $_SESSION['categoria_varredura'];
	
	$_SESSION['busca_imgs_atual'] = $categoria;
	
	if(isset($_GET['maisImgs'])) //utilizou as setas de navegação
		if($_GET['maisImgs'] == 1)
			$_SESSION['pagina_atual_varredura']++;
		else 
			$_SESSION['pagina_atual_varredura']--;
	
	$paginaAtual = $_SESSION['pagina_atual_varredura'];
		
	if ($categoria == 0){ //se for uma requisição de "MINHAS IMAGENS"
		$sql = 'SELECT * FROM imagem_usuario WHERE id_usuario = '.$_SESSION['id'].' and visivel = 1 ORDER BY id DESC';
		$qry = pg_query($sql);
		$i = 0;
		
		while ($imgs = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
			if($_SESSION['pagina_atual_varredura']*60 <= $i){
				$i++;
				
				if (($i + 11)%12 == 0){
					echo "<div style='position:relative; left:0; top:0; display:table;  border:solid 2px transparent;' id='divImg".$i."'>";
					echo "<script> VetorVarreduraImgsDivs.push('divImg".$i."'); </script>";
				}
				
				if (!file_exists($_SESSION['url_mini_imagens_usuario'].$imgs['caminhoimagem'])) {

					echo "<script>VetorVarreduraImagens.push('".$imgs['id']."'); </script>";
					
					echo "<div class='img_imagem_lista_varredura' id='".$imgs['id']."' onclick='javascript: selecionar(".$imgs['id'].", 1);'>
								<div class='img_apagar_minha_imagem' onclick='javascript: apagar_minha_img(".$imgs['id'].");'> </div>
								<img src='".$_SESSION['url_mini_imagens_usuario'].$imgs['caminhoimagem']."' width='100%' >
					
								<div class='nome_imagem_lista'>
									".$imgs['nome']."
								</div>
							</div>";
									
					if ($i%12 == 0) echo "</div>";					
					if ($i == ($paginaAtual+1)*60) break;
				}
				else $i++;					
			}
		}
		
				$i = $i - $paginaAtual*60;
							
		if (($i > 0) && ($i < 12)){
			echo "</div>";
			$ultimapag = 'sim';
		}		
			
		if (($i > 12) && ($i < 24)){
			echo "</div>";
			$ultimapag = 'sim';
		}	
			
		if (($i > 24) && ($i < 36)){
			echo "</div>";
			$ultimapag = 'sim';
		}	

		if (($i > 36) && ($i < 48)){
			echo "</div>";
			$ultimapag = 'sim';
		}	

		if (($i > 48) && ($i < 60)){
			echo "</div>";
			$ultimapag = 'sim';
		}			
	}
	
else{ // SE FOR BUSCA POR CATEGORIAS

		$sql = 'SELECT * FROM imagem WHERE categoria_id = '.($categoria+132).' and removida = false ORDER BY nome_'.$_SESSION["lang"].''; //o 132 é para sincronizar com o indice usado pelo scala Android
		$qry = pg_query($sql);
		$i = 0;
		while ($imgs = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
			if($_SESSION['pagina_atual_varredura']*60 <= $i){
				$i++;
				if (($i + 11)%12 == 0){
					echo "<div style='position:relative; left:0; top:0; display:table; border:solid 2px transparent;' id='divImg".$i."'>";
					echo "<script> VetorVarreduraImgsDivs.push('divImg".$i."'); </script>";
				}

				$ext = end(explode("/", $imgs['mimetype']));
				if ($ext == "jpeg") $ext = "jpg";
				$caminho_imgs = $imgs['id'].".".$ext;
				if (!file_exists($_SESSION['url_mini_imagens'].$caminho_imgs)){
					if (file_exists($_SESSION['url_imagens'].$caminho_imgs))
						resize($_SESSION['url_imagens'].$caminho_imgs, 100, 100, $_SESSION['url_mini_imagens'].$caminho_imgs);				
				}	
				echo "<script>VetorVarreduraImagens.push('".$imgs['id']."'); </script>";
				echo "<div class='img_imagem_lista_varredura' id='".$imgs['id']."' onclick='javascript: selecionar(".$imgs['id'].", 1);'>";
							if ($imgs['mimetype'] == "image/gif")
								echo "<img src='".$_SESSION['url_imagens'].$caminho_imgs."' width='100%' >";
							else
								echo "<img src='".$_SESSION['url_mini_imagens'].$caminho_imgs."' width='100%' >";
							echo "
						<div class='nome_imagem_lista' align='center' style='font-size:140%;'>
							".$imgs['nome_'.$_SESSION["lang"]]."
						</div>
						  </div>";
						  
				if ($i%12 == 0) echo "</div>";					
				if ($i == ($paginaAtual+1)*60) break;
			}
			else $i++;					
		}
		
		$i = $i - $paginaAtual*60;					
		if (($i > 0) && ($i < 12)){
			echo "</div>";
			$ultimapag = 'sim';
		}		
			
		if (($i > 12) && ($i < 24)){
			echo "</div>";
			$ultimapag = 'sim';
		}	
			
		if (($i > 24) && ($i < 36)){
			echo "</div>";
			$ultimapag = 'sim';
		}	

		if (($i > 36) && ($i < 48)){
			echo "</div>";
			$ultimapag = 'sim';
		}	

		if (($i > 48) && ($i < 60)){
			echo "</div>";
			$ultimapag = 'sim';
		}

	}
		$sql = 'SELECT * FROM imagem WHERE categoria_id = '.($categoria+132).' and removida = false ORDER BY nome'; //o 132 é para sincronizar com o indice usado pelo scala Android
		$qry = pg_query($sql);
		$j = 0;

		while ($imgs = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
			$total_imagens++;
		}
		$SESSION['total_paginas'] = ceil($total_imagens/60);
	?>

<div id='numeracao_paginas' align='center' style="font-size:200%">
		<br><br>
		<?php
			$navegacao_paginas = "Página ".($_SESSION['pagina_atual_varredura']+1)." de ".$SESSION['total_paginas']."";
			echo"".$navegacao_paginas."";
		?>
</div>

</div>
<div  style="display:block; position: absolute; left:94.7%; top:0; height: 100%; width: 5%;">
		<a href="index.php"><img id="voltar_escolher_img" style="border: 2px solid transparent;" src="imagens/site/icones_legendados_<?php echo $_SESSION['lang'];?>/voltarLegenda.png" width="100%"/></a>	
		<script> VetorVarreduraImgsDivs.push('voltar_escolher_img'); </script>
		<?php		
			if($ultimapag == 'nao'){
				echo '<a href="visualizarImagensVarredura.php?categoria=-1&maisImgs=1"><img style="border: 2px solid transparent;" id="escolher_mais_img" src="imagens/site/icones_legendados_'.''.$_SESSION["lang"].''.'/avancar.png" width="75%"/></a>';
				echo "<script>VetorVarreduraImgsDivs.push('escolher_mais_img');</script>";
			}
			if($_SESSION['pagina_atual_varredura'] != 0){
				echo '<a href="visualizarImagensVarredura.php?categoria=-1&maisImgs=-1"><img style="border: 2px solid transparent;" id="escolher_menos_img" src="imagens/site/icones_legendados_'.''.$_SESSION["lang"].''.'/retornar.png" width="75%"/></a>';
				echo "<script>VetorVarreduraImgsDivs.push('escolher_menos_img');</script>";
			}
		?>
		<img id="cancelar_selecao" style="border: 2px solid transparent; display:none;" src="imagens/site/transparente.png" width="100%"/>
		<script> VetorVarreduraImagens.push('cancelar_selecao'); </script>
</div>

<div id="som_varredura"></div>

<?php include('verificarConfiguracoes.php');?>

<script>
	varredura_atual = 'selecaoImgComplexa';
	estadoVarCategorias = 0;
	varreduraImgsCatEComplexa(<?php echo $_SESSION['tempo_varredura']; ?>, -1);	
</script>
		
</body>
</html>
