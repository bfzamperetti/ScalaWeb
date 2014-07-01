<?php
if (!session_id()) session_start();
$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_narracao'] = $_GET['texto'];
include('narracao.php');
?>
