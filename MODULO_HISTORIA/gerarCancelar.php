<?php
session_start();

$_SESSION['quadrinho_atual'] = $_GET['id'];
$hist_cancelar = "";
$hist_cancelar .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_layout']."*";
	$hist_cancelar .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_narracao']."*";
	$hist_cancelar .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_cenario']."*";
	$inicio = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_ini']; 
	$fim = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_fim'];
		
	for ($k = $inicio; $k < $fim; $k++){
		$hist_cancelar .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_top']."|";
		$hist_cancelar .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_left']."|";
		$hist_cancelar .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_height']."|";
		$hist_cancelar .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_width']."|";
		$img_id1 = end(explode("/",$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_path']));
		$img_id = explode(".",$img_id1);
		if ($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_path'] == "")
			$hist_cancelar .= "|";
		else
			$hist_cancelar .= $img_id[0].".".$img_id[1]."|";  
		$hist_cancelar .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_ang']."|";
		$hist_cancelar .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_inv']."|";
		if(isset($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_text']))
			$hist_cancelar .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_text']."|";
		$hist_cancelar .= ")";		
	}
$_SESSION['hist_cancelar'] = $hist_cancelar;
$_SESSION['hist_desfazer'] = '';

header('Location: quadrinho.php?id='.$_GET['id']);
?>
