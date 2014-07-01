<?php
session_start();
if (isset($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$_GET['id'].'_text']))
	echo 'document.getElementById("textoquad").style.display = "block"';
?>
		
