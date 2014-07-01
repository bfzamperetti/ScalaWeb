<?php

session_start();
	if ($_SESSION['hist_desfazer'] == ''){
		include('desenha_quadrinho_editavel.php');
	}
	else {
		include('desfazer.php');
	}
?>
