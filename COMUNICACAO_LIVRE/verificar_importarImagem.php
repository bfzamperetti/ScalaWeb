<?php

include_once('../INCLUDES/uses.php');

if (isset($_POST['importarImagem'])){
	$arquivo_img = $_FILES['arquivo_img'];
	if($arquivo_img["name"] != ''){
		//pegar novo id
		$sql = 'SELECT max(id) as maxid FROM imagem_usuario';
		$qry = pg_query($sql);
		$img = pg_fetch_array($qry, NULL, PGSQL_ASSOC);
		$novo_id = $img['maxid']+1;
		if ($novo_id < 100000) $novo_id = 100000; //as imagens do usuario começam com id = 100000, para nao terem o mesmo id que imagens de categorias
		
		$caminho = $_SESSION['url_imagens_usuario'];
		$caminho_mini = $_SESSION['url_mini_imagens_usuario'];
		
		//pegar extensao da imagem
		$ext_img = strtolower(end(explode('.', $arquivo_img["name"])));
		$array_ext_imgs = array('jpg', 'png', 'jpeg', 'gif' );
		
		//verificar se o formato da imagem e valido
		if (in_array( $ext_img, $array_ext_imgs )){
			if ($arquivo_img['size'] < 1024 * 1024 * 8){ //8 megas, para alterar este valor, tem que alterar tambem no php.ini
			
				//aloca a imagem com o nome = novo id na pasta corespondente
				$destino_img = $caminho.$novo_id.".".$ext_img;
				move_uploaded_file($arquivo_img['tmp_name'],$destino_img);
				$mini_destino_img = $caminho_mini.$novo_id.".".$ext_img;
				
				if ($ext_img == 'gif'){
					copy($destino_img, $mini_destino_img);	
				}else{			
				//cria a miniatura da imagem, para que imagens muito grandes sejam reduzidas
				#
				$mini500 = resize($destino_img, 500, 500, $destino_img);
				$mini100 = resize($destino_img, 100, 100, $mini_destino_img);
				}
					
					
				$banco_som = '';
			
				$sql = "INSERT INTO imagem_usuario (id, nome, caminhoimagem, caminhosom, mimetype, id_usuario, visivel) VALUES (".$novo_id.", '".$_POST['nome']."', '".$novo_id.".".$ext_img."' ,'".$banco_som."' ,'".$ext_img."' , ".$_SESSION['id'].", 1);";
				$qry = pg_query($sql);
				echo "<script > alert('Imagem enviada. Acesse a categoria \'Minhas Imagens\'!'); </script>";
			}
			else{
				echo '<script> alert("A imagem tem um tamanho muito grande."); </script>';
			}
		}
		else{
			echo '<script> alert("O formato da imagem escolhido esta incorreto."); </script>';
		}
	}
	else{
		echo '<script> alert("Nenhum arquivo foi enviado!"); </script>';
	}
}

?>
