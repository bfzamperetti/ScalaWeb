<?php
session_start();
include('atualizar_desfazer.php');
$n = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_inv'];
$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_inv'] = (-$n)+1;
include('desenha_quadrinho_editavel.php');
?>

