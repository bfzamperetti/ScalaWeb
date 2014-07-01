<?php
session_start();

$nome_arquivo = $_SESSION['nome'].".swp";

if (file_exists($_SESSION['url_pranchas_temp'].$nome_arquivo))
	unlink($_SESSION['url_pranchas_temp'].$nome_arquivo);

$xml = new XMLWriter;
	 
# Cria memoria para armazenar a saida
$xml->openMemory();
	 
# Inicia o cabeçalho do documento XML
$xml->startDocument( '1.0' , 'iso-8859-1' );
	 
# Adiciona/Inicia um Elemento / Nó Pai <item>
$xml->startElement("arquivo");

$xml->startElement("config");
	$xml->writeElement("numero_de_quadros", $_SESSION['n_quadros']);
	$xml->writeElement("quadro_atual", $_SESSION['quadro_atual']);
	$xml->writeElement("busca_imgs_atual", $_SESSION['busca_imgs_atual']);
$xml->endElement();

$xml->startElement("quadros");
	for ($i = 1; $i <= $_SESSION['n_quadros']; $i++){
	$xml->startElement("quadro");
		$xml->writeElement("tipo_layout", $_SESSION['layout_qdr'.$i]);
		for ($j = 0; $j < 12; $j++){
			$xml->startElement("prancha");
			$img_id1 = end(explode("/",$_SESSION['pathimg_prancha'.$j.'_qdr'.$i]));
			$img_id = explode(".",$img_id1);
			if ($_SESSION['pathimg_prancha'.$j.'_qdr'.$i] == "")
				$xml->writeElement("pathimg_prancha", "");	
			else
				$xml->writeElement("pathimg_prancha", $img_id[0].".".$img_id[1]);	
			$xml->writeElement("nome_prancha", $_SESSION['nome_prancha'.$j.'_qdr'.$i]);	
			$xml->writeElement("ocupada_prancha", $_SESSION['ocupada_prancha'.$j.'_qdr'.$i]);	
			$xml->writeElement("pathvoz_prancha", $_SESSION['pathvoz_prancha'.$j.'_qdr'.$i]);	
			$xml->endElement();			
		}
	$xml->endElement();				
	}
$xml->endElement();

$xml->endElement();


	 
#  Configura a saida do conteúdo para o formato XML
header( 'Content-type: text/xml' );
	 	 
# Salvando o arquivo em disco
# retorna erro se o header foi definido
# retorna erro se outputMemory já foi chamado
$file = fopen($_SESSION['url_pranchas_temp'].$nome_arquivo, "w+");
fwrite($file,$xml->outputMemory(true));
fclose($file);

echo $nome_arquivo;

?>
