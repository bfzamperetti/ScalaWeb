<?php
session_start();
include('atualizar_desfazer.php');
$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_cenario'] = '#'.$_GET['cor'];
//include('gerar_imagem_cenario.php');
include('desenha_quadrinho_editavel.php');
?>
