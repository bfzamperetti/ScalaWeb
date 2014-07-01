<?php
session_start();

$nome_arquivo = $_SESSION['nome'].".hsw";

if (file_exists($_SESSION['url_hist_temp'].$nome_arquivo))
	unlink($_SESSION['url_hist_temp'].$nome_arquivo);

$xml = new XMLWriter;
	 
# Cria memoria para armazenar a saida
$xml->openMemory();
	 
# Inicia o cabeçalho do documento XML
$xml->startDocument( '1.0' , 'iso-8859-1' );
	 
# Adiciona/Inicia um Elemento / Nó Pai <item>
$xml->startElement("arquivo");

$xml->startElement("config");
	$xml->writeElement("historia_numero_de_quadros", $_SESSION['hist_n_quadros']);
	$xml->writeElement("historia_quadro_atual", $_SESSION['hist_quadro_atual']);
	$xml->writeElement("historia_busca_imgs_atual", $_SESSION['hist_busca_imgs_atual']);
$xml->endElement();

$xml->startElement("quadros");
	for ($i = 1; $i <= $_SESSION['hist_n_quadros']; $i++){
	$xml->startElement("quadro");
		$xml->writeElement("tipo_layout", $_SESSION['hist_layout_qdr'.$i]);
			
		for ($j = 0; $j < 6; $j++){
			$xml->startElement("quadrinho");
				$xml->writeElement("layout_quadrinho", $_SESSION['qdr'.$i.'_quadrinho'.$j.'_layout']);
				$xml->writeElement("narracao", $_SESSION['qdr'.$i.'_quadrinho'.$j.'_narracao']);
				$xml->writeElement("cenario", $_SESSION['qdr'.$i.'_quadrinho'.$j.'_cenario']);
				
			for ($k = $_SESSION['qdr'.$i.'_quadrinho'.$j.'_ini']; $k < $_SESSION['qdr'.$i.'_quadrinho'.$j.'_fim']; $k++){
				$xml->startElement("figura");						
					$xml->writeElement("top", $_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_top']);
					$xml->writeElement("left", $_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_left']);
					$xml->writeElement("height", $_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_height']);
					$xml->writeElement("width", $_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_width']);
					$img_id1 = end(explode("/",$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_path']));
					$img_id = explode(".",$img_id1);
					if ($_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_path'] == "")
						$xml->writeElement("path", "");	
					else
						$xml->writeElement("path", $img_id[0].".".$img_id[1]);
					$xml->writeElement("ang", $_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_ang']);
					$xml->writeElement("inv", $_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_inv']);
					if (isset($_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_text']))
						$xml->writeElement("text", $_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_text']);
				$xml->endElement();			
			}
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
$file = fopen($_SESSION['url_hist_temp'].$nome_arquivo, "w+");
fwrite($file,$xml->outputMemory(true));
fclose($file);

echo $nome_arquivo;

?>
