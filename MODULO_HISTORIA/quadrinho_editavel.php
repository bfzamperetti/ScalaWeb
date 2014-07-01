<?php
	include('narracao.php');
	echo '<div id="tela_quadrinho" class="tela_quadrinho_'.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_layout'].'">';
		include('desenha_quadrinho_editavel.php');
	echo '</div>';
 ?>
