<?php
//  O conteudo tera o seguinte formato:   
//layoutqdr*narracao*cenario*top|left|height|width|path|ag|inv|)top|left|height|width|path|ag|inv|)..)}...
if (!session_id()) session_start();

$hist_desfazer = "";
$hist_desfazer .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_layout']."*";
	$hist_desfazer .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_narracao']."*";
	$hist_desfazer .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_cenario']."*";
	$inicio = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_ini']; 
	$fim = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_fim'];
		
	for ($k = $inicio; $k < $fim; $k++){
		$hist_desfazer .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_top']."|";
		$hist_desfazer .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_left']."|";
		$hist_desfazer .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_height']."|";
		$hist_desfazer .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_width']."|";
		$img_id1 = end(explode("/",$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_path']));
		$img_id = explode(".",$img_id1);
		if ($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_path'] == "")
			$hist_desfazer .= "|";
		else
			$hist_desfazer .= $img_id[0].".".$img_id[1]."|";  
		$hist_desfazer .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_ang']."|";
		$hist_desfazer .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_inv']."|";
		if(isset($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_text']))
			$hist_desfazer .= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_imgquad'.$k.'_text']."|";
		$hist_desfazer .= ")";		
	}

$hist_desfazer .= "}"; // separador de linhas

$linhas = explode("}", $_SESSION['hist_desfazer'], 10);

for($i = 0; $i < count($linhas)-1; $i++){
		$hist_desfazer .= $linhas[$i]."}"; //echo "<br />Linha ".$i." - ".$linhas[$i]; 
		}
		
$_SESSION['hist_desfazer'] = $hist_desfazer;

?>
