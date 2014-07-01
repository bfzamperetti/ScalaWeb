<?php
//  O conteudo tera o seguinte formato:   
//  quadro_atual|tipolayout,nomeprancha1*imgprancha1*idprancha1,nomeprancha2*imgprancha2*idprancha2|tipolayout,idprancha1...
$conteudo = $_SESSION['quadro_atual'];

for ($i = 1; $i <= $_SESSION['n_quadros']; $i++){
	$conteudo .= "|".$_SESSION['layout_qdr'.$i];
	for ($j = 0; $j < 12; $j++){
		$conteudo .= ",".$_SESSION['pathimg_prancha'.$j.'_qdr'.$i];
		$conteudo .= "*".$_SESSION['nome_prancha'.$j.'_qdr'.$i];
		$conteudo .= "*".$_SESSION['ocupada_prancha'.$j.'_qdr'.$i];
		$conteudo .= "*".$_SESSION['pathvoz_prancha'.$j.'_qdr'.$i]; 
	}
}

$conteudo .= "#"; // separador de linhas

$linhas = explode("#", $_SESSION['desfazer_situacao'], 10);

for($i = 0; $i < count($linhas)-1 ; $i++)
		$conteudo .= $linhas[$i]."#";

$_SESSION['desfazer_situacao'] = $conteudo;
		
?>
