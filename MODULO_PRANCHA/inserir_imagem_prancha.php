<?php
//funcao para arrumar acentos.
	include('../INCLUDES/conecta.php');
	include('../INCLUDES/uses.php');
	session_start();
	include('atualizar_desfazer.php');
	
	if ($_SESSION['busca_imgs_atual'] == 0){ //se for do minhas imagens
		$sql = 'SELECT * FROM imagem_usuario WHERE id = '.$_GET['id_imagem'];
		$qry = pg_query($sql);
		$img = pg_fetch_array($qry, NULL, PGSQL_ASSOC);
		$_SESSION['pathimg_prancha'.$_GET['prancha'].'_qdr'.$_SESSION['quadro_atual']] = $_SESSION['url_imagens_usuario'].$img['caminhoimagem'];
		$_SESSION['nome_prancha'.$_GET['prancha'].'_qdr'.$_SESSION['quadro_atual']] = strtoupper(strtr($img['nome'] ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
		$_SESSION['pathvoz_prancha'.$_GET['prancha'].'_qdr'.$_SESSION['quadro_atual']] = $img['caminhosom']; 
		$_SESSION['ocupada_prancha'.$_GET['prancha'].'_qdr'.$_SESSION['quadro_atual']] = 1;
	}else{ //se for uma categoria normal.
		$sql = 'SELECT * FROM imagem WHERE id = '.$_GET['id_imagem'];
		$qry = pg_query($sql);
		$img = pg_fetch_array($qry, NULL, PGSQL_ASSOC);
		$ext = end(explode("/", $img['mimetype']));
			if ($ext == "jpeg") $ext = "jpg";
		$caminho_img = $img['id'].".".$ext;
		$_SESSION['pathimg_prancha'.$_GET['prancha'].'_qdr'.$_SESSION['quadro_atual']] = $_SESSION['url_imagens'].$caminho_img;
		$_SESSION['nome_prancha'.$_GET['prancha'].'_qdr'.$_SESSION['quadro_atual']] = strtoupper(strtr($img['nome_'.$_SESSION['lang']] ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
		$_SESSION['pathvoz_prancha'.$_GET['prancha'].'_qdr'.$_SESSION['quadro_atual']] = $img['caminhosom']; 
		$_SESSION['ocupada_prancha'.$_GET['prancha'].'_qdr'.$_SESSION['quadro_atual']] = 1;	
	}
	include('desenha_layout.php');
?>
