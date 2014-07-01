<?php
session_start();
$texto = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_text'];
if(strcmp($texto, $_str['lblInsertATextHere'].'...')==0) //se texto padrão apaga automaticamente
	$texto = '';
$left = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_left'];
$top = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_top'];
echo "
	<textarea id='novoTextoBalao' width='100%' height='100%' style='margin-left=auto; margin-right=auto; text-align=center'>".$texto."</textarea><br />
	<input type='submit' onclick='alterarTextoBalao(document.getElementById(\"novoTextoBalao\").value)' value='OK' />
";
?>
