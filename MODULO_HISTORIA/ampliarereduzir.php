<?php
session_start();
include('atualizar_desfazer.php');
$prev_height = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_height'];
$prev_width = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_width']; 
if (($prev_height*$_GET['tam'] > 5) && ($prev_width*$_GET['tam'] > 5) && ($prev_height*$_GET['tam'] < 90) && ($prev_width*$_GET['tam'] < 90)){
	$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_left'] += $prev_width/2;
	$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_top'] += $prev_height/2;
	$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_height'] *= $_GET['tam'];
	$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_width'] *= $_GET['tam'];
	$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_left'] -= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_width']/2;
	$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_top'] -= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_height']/2;
}
include('desenha_quadrinho_editavel.php');
?>
