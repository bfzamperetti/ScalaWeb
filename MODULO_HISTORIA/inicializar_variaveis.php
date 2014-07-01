<?php
if (!isset($_SESSION['hist_busca_imgs_atual'])) $_SESSION['hist_busca_imgs_atual'] = 0;
if (!isset($_SESSION['hist_quadro_atual'])) $_SESSION['hist_quadro_atual'] = 1; 
if (!isset($_SESSION['hist_n_quadros'])) $_SESSION['hist_n_quadros'] = 1; 

// inicializar o primerio quadro com nenhum quadrinho.
if (!isset($_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']])){
	$_SESSION['hist_layout_qdr'.$_SESSION['hist_quadro_atual']] = 1;
	for ($i = 0; $i < 4; $i++){
		$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_narracao'] = '';
		$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_cenario'] = '#ccc';
		$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_layout'] = 1;
		$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_ini'] = 100000;
		$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_fim'] = 100000;
	}
}

include_once('../INCLUDES/VARS_SCALA.php');

//variavel que guarda as informações para conseguir "desfazer" quando necessário
/*if (!isset($_SESSION['desfazer_situacao'])) $_SESSION['desfazer_situacao'] = ""; 
*/

//caminho onde serão salvas as histórias, quando o botão salvar é clicado
if (!is_dir("hist_temp"))
	mkdir("hist_temp");
$_SESSION['url_hist_temp'] = "hist_temp/";
?>
