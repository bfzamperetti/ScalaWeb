<?php
session_start();
include('../INCLUDES/conecta.php');
include('atualizar_desfazer.php');

if ($_GET['id'] > 100){ //se nao é tipo texto
	if ($_GET['id'] > 100000) //minhas imagens
		$sql = 'SELECT * FROM imagem_usuario WHERE id = '.$_GET['id'];
	else //imagem normal
		$sql = 'SELECT * FROM imagem WHERE id = '.$_GET['id'];
	$qry = pg_query($sql);
	$img = pg_fetch_array($qry, NULL, PGSQL_ASSOC);
	$ext = end(explode("/", $img['mimetype']));
	if ($ext == 'jpeg') $ext = 'jpg';
	$caminho_img = $img['id'].".".$ext;
}

$t = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_layout'];


if ($t == 1) { $nw = 15; $nh = 25;}
else if ($t == 2) { $nw = 15; $nh = 25;}
else if ($t == 3) { $nw = 12; $nh = 36;}
else if ($t == 4) { $nw = 20; $nh = 25;}
else if ($t == 5) { $nw = 20; $nh = 20;}


$i = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_fim'];
$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_fim'] += 1;
$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_left'] = $_GET['left'];
$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_top'] = $_GET['top'];
$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_height'] = $nh;
$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_width'] = $nw;
$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_ang'] = 0;
$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_inv'] = 0;

if ($_GET['id'] <= 100){ // se for tipo texto
	$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_path'] = $_SESSION['url_imagens_textos'].$_GET['id'].".png";
	$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_text'] = "Insira um texto aqui...";	
}
else if ($img['id'] > 100000) //se for imagem do usuario
	$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_path'] = $_SESSION['url_imagens_usuario'].$caminho_img;
else
	$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$i.'_path'] = $_SESSION['url_imagens'].$caminho_img;

include('desenha_quadrinho_editavel.php');
?>
