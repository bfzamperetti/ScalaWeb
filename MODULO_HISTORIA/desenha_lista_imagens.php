<?php
	include_once('../INCLUDES/conecta.php');
	include_once('../INCLUDES/uses.php');
		include_once('../INCLUDES/strings.php');
	if (!isset($_SESSION['url_imagens']))
		session_start();
		
	$_SESSION['busca_imgs_atual'] = $_GET['cat'];
	

	if ($_GET['cat'] == 0){ //se for uma requisição de "MINHAS IMAGENS"
		$sql = 'SELECT * FROM imagem_usuario WHERE id_usuario = '.$_SESSION['id'].' and visivel = 1 ORDER BY id DESC';
		$qry = pg_query($sql);
		$i = 0;
		
		
		while ($imgs = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
			$i++;
			if (!file_exists($_SESSION['url_mini_imagens_usuario'].$imgs['caminhoimagem']))
				echo '<script> imgs_carregadas(); </script>';
			echo "<div class='qdr_imagem_lista' id='qdr_imagem_lista".$imgs['id']."' onclick='javascript: selecionarHist(".$imgs['id'].", 1);'>
						<div class='img_apagar_minha_imagem' onclick='javascript: apagar_minha_img_hist(".$imgs['id'].");'> </div>
						<div class='img_imagem_lista'>
							<img src='".$_SESSION['url_mini_imagens_usuario'].$imgs['caminhoimagem']."' width='100%' />
						</div>
						<div class='nome_imagem_lista'>
							".$imgs['nome']."
						</div>
					  </div>";
			
		}
		
		if ($i == 0){
			echo "<div class='img_nao_encontrada'> ".$_str['thereIsNoImagesMyImages']." </div>";	
		}		
	}
	else{ // SE FOR BUSCA POR CATEGORIAS
		$sql = 'SELECT * FROM imagem WHERE categoria_id = '.($_GET['cat']+132).' and removida = false ORDER BY nome_'.$_SESSION['lang']; //o 132 é para sincronizar com o indice usado pelo scala Android
		$qry = pg_query($sql);
		$i = 0;
		
		
		while ($imgs = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
			$i++;
			$ext = end(explode("/", $imgs['mimetype']));
			if ($ext == "jpeg") $ext = "jpg";
			$caminho_imgs = $imgs['id'].".".$ext;
			if (!file_exists($_SESSION['url_mini_imagens'].$caminho_imgs)){
				if (file_exists($_SESSION['url_imagens'].$caminho_imgs))
					resize($_SESSION['url_imagens'].$caminho_imgs, 100, 100, $_SESSION['url_mini_imagens'].$caminho_imgs);				
				else
					echo '<script> imgs_carregadas(); </script>';		
			}	
			echo "<div class='qdr_imagem_lista' id='qdr_imagem_lista".$imgs['id']."' onclick='javascript: selecionarHist(".$imgs['id'].", 1);'>
					<div class='img_imagem_lista'>";
						if ($imgs['mimetype'] == "image/gif")
							echo "<img src='".$_SESSION['url_imagens'].$caminho_imgs."' width='100%'  />";
						else
							echo "<img src='".$_SESSION['url_mini_imagens'].$caminho_imgs."' width='100%' />";
						echo "
					</div>
					<div class='nome_imagem_lista'>
						".$imgs['nome_'.$_SESSION['lang']]."
					</div>
				  </div>";
		}
			
	}
?>
