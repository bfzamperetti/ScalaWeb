<?php
	include_once('../INCLUDES/conecta.php');
	include_once('../INCLUDES/uses.php');
	if (!isset($_SESSION['url_imagens']))
		session_start();
		
	$_SESSION['busca_imgs_atual'] = $_GET['cat'];
	
	echo "<div id='lista_imgs'>";
	
	if ($_GET['cat'] == 0){ //se for uma requisi��o de "MINHAS IMAGENS"
		$sql = 'SELECT * FROM imagem_usuario WHERE id_usuario = '.$_SESSION['id'].' and visivel = 1 ORDER BY id DESC';
		$qry = pg_query($sql);
		$i = 0;
		
		echo "<script> imgc = 0; function imgs_carregadas(){ imgc++; if (imgc >= ".pg_num_rows($qry)."){ imgc = 0; fechar_tela_carregar_ajax(); } }  </script>";
			
		while ($imgs = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
			$i++;
			if (!file_exists($_SESSION['url_mini_imagens_usuario'].$imgs['caminhoimagem']))
				echo '<script> imgs_carregadas(); </script>';
			$imagemselecionada = $imgs['nome'];
			echo "<div class='qdr_imagem_lista' id='qdr_imagem_lista".$imgs['id']."' onclick='javascript: selecionar(".$imgs['id'].", 1);'>
						<div class='img_apagar_minha_imagem' onclick='javascript: apagar_minha_img(".$imgs['id'].");'> </div>
						<div class='img_imagem_lista'>
							<img onload='imgs_carregadas();' src='".$_SESSION['url_mini_imagens_usuario'].$imgs['caminhoimagem']."' width='100%' >
						</div>
						<div class='nome_imagem_lista'>
							".$imgs['nome']."
						</div>
					  </div>";
			
		}
		
		if ($i == 0){
			echo "<div class='img_nao_encontrada'> N&atilde;o existem imagens nesta categoria.<br /><br /> Para adicionar imagens, clique no icone \"Importar\"'</div>";	
		}		
	}
	else{ // SE FOR BUSCA POR CATEGORIAS
		$sql = 'SELECT * FROM imagem WHERE categoria_id = '.($_GET['cat']+132).' and removida = false ORDER BY nome'; //o 132 � para sincronizar com o indice usado pelo scala Android
		$qry = pg_query($sql);
		$i = 0;
		
		echo "<script> imgc = 0; function imgs_carregadas(){ imgc++; if (imgc >= ".pg_num_rows($qry)."){ imgc = 0; fechar_tela_carregar_ajax(); } }  </script>";
		
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
			$imagemselect = $imgs['nome'];
			echo "<div class='qdr_imagem_lista' id='qdr_imagem_lista".$imgs['id']."' onclick='javascript: selecionar(".$imgs['id'].", 1);'>
					<div class='img_imagem_lista'>";
						if ($imgs['mimetype'] == "image/gif")
							echo "<img id='img_".$imgs['id']."' name='img_".$imgs['nome']."' onload='imgs_carregadas();' src='".$_SESSION['url_imagens'].$caminho_imgs."' width='100%' >";
						else
							echo "<img id='img_".$imgs['id']."' name='img_".$imgs['nome']."' onload='imgs_carregadas();' src='".$_SESSION['url_mini_imagens'].$caminho_imgs."' width='100%' >";
						echo "
					</div>
					<div class='nome_imagem_lista'>
						<input type='hidden' id='".$imgs['id']."' value='".$imgs['nome']."'/>
						".$imgs['nome']."
					</div>
				  </div>";
		}
			
	}
	echo "<script>imgs_carregadas();</script></div>";
?>
