<?php
session_start();

	$linha = explode("#",$_SESSION['desfazer_situacao']);
	$dados = explode("|", $linha[0]);
	for ($i = 1; $i < count($dados); $i++){
		$dados2 = explode(",",$dados[$i]);
		$_SESSION['layout_qdr'.$i] = $dados2[0];
		for ($j = 0; $j < 12; $j++){
			$dados3 = explode("*",$dados2[$j+1]);
			$_SESSION['pathimg_prancha'.$j.'_qdr'.$i] = $dados3[0];
			$_SESSION['nome_prancha'.$j.'_qdr'.$i] = $dados3[1];
			$_SESSION['ocupada_prancha'.$j.'_qdr'.$i] = $dados3[2];
			$_SESSION['pathvoz_prancha'.$j.'_qdr'.$i] = $dados3[3];
		}
	}
	
	if ($dados[0] != "")
		$_SESSION['quadro_atual'] = $dados[0];
	
	$_SESSION['desfazer_situacao'] = "";

	for($i = 1; $i < count($linha)-1; $i++)
		$_SESSION['desfazer_situacao'] .= $linha[$i]."#";
	
	
	include ('desenha_layout.php');
?>
