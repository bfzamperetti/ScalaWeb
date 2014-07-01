<?php
if (!isset($_SESSION['busca_imgs_atual'])) $_SESSION['busca_imgs_atual'] = 0;
if (!isset($_SESSION['quadro_atual'])) $_SESSION['quadro_atual'] = 1; 
if (!isset($_SESSION['n_quadros'])) $_SESSION['n_quadros'] = 1; 

// inicializar o primerio quadro com nenhuma prancha.
if (!isset($_SESSION['layout_qdr'.$_SESSION['quadro_atual']])){
	for ($i = 0; $i < 12; $i++){
			$_SESSION['pathimg_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = "";
			$_SESSION['nome_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = "";
			$_SESSION['ocupada_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = 0;
			$_SESSION['pathvoz_prancha'.$i.'_qdr'.$_SESSION['quadro_atual']] = ""; 
		}
		$_SESSION['layout_qdr'.$_SESSION['quadro_atual']] = 1;
}

include_once('../INCLUDES/VARS_SCALA.php');

//variavel que guarda as informa��es para conseguir "desfazer" quando necess�rio
if (!isset($_SESSION['desfazer_situacao'])) $_SESSION['desfazer_situacao'] = ""; 


//caminho onde ser�o salvas as pranchas, quando o bot�o salvar � clicado
if (!is_dir("pranchas_temp"))
	mkdir("pranchas_temp");
$_SESSION['url_pranchas_temp'] = "pranchas_temp/";

?>
