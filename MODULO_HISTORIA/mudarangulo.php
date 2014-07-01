<?php
session_start();
include('atualizar_desfazer.php');
$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_ang'] += $_GET['ang'];
include('desenha_quadrinho_editavel.php');
?>

