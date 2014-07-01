<?php
/*
 * O algoritmo de abrir Arquivo é na verdade um upload de arquivo. O usuario 
 * enviara o arquivo a ser aberto 
 * e o algoritmo salvara este arquivo no servidor, 
 * posteriormente lera o arquivo e executara as operacoes necessarias, 
 * e depois apagara do servidor
 */

if (isset($_POST['abrirArquivo'])){
	$arquivo = $_FILES['arquivo'];
	$caminho = $_SESSION['url_pranchas_temp'];
	
	//verificar se algum arquivo foi enviado
	if(!(empty($arquivo))){
		
		//verificar se o arquivo é do tipo .scalaweb
		if(strtolower(end(explode('.', $arquivo["name"]))) == 'swp'){
			
			//define o nome do novo arquivo como a data e hora atuais e o login do usuario, isso serve para nunca sobrepor arquivos e perder dados.
			$destino = $caminho.date("y-m-d-H-i-s").$_SESSION['login'].".swp";
			move_uploaded_file($arquivo['tmp_name'],$destino);
			
			
			#define o encoding do cabeçalho para utf-8
			@header('Content-Type: text/html; charset=utf-8');
			#carrega o arquivo XML e retornando um Array
			$xml = simplexml_load_file($destino);
			# se o xml for um link e nao um arquivo como livros.xml, troque -o pelo link ex.
			#para cada nó LIVRO  atribui à variavel $livro (obj simplexml)
			$_SESSION['n_quadros'] = (int) $xml->config->numero_de_quadros;
			$_SESSION['quadro_atual'] = (int) $xml->config->quadro_atual;
			$_SESSION['busca_imgs_atual'] = (int) $xml->config->busca_imgs_atual;
			$i = 1;
			foreach($xml->quadros->quadro as $quadro){
				$_SESSION['layout_qdr'.$i] = (int) $quadro->tipo_layout;
				$j = 0;
				foreach($quadro->prancha as $prancha){
					if ((string) $prancha->pathimg_prancha == "")
						$_SESSION['pathimg_prancha'.$j.'_qdr'.$i] = "";
					else{
						$img_id = explode(".", (string) $prancha->pathimg_prancha);
						if ($img_id[0] >= 100000) //se for imagem do usuario
							$_SESSION['pathimg_prancha'.$j.'_qdr'.$i] =  $_SESSION['url_imagens_usuario'].$img_id[0].".".$img_id[1];	 
						else
							$_SESSION['pathimg_prancha'.$j.'_qdr'.$i] =  $_SESSION['url_imagens'].$img_id[0].".".$img_id[1];	 
					}
					$_SESSION['nome_prancha'.$j.'_qdr'.$i] = (string) $prancha->nome_prancha;
					$_SESSION['ocupada_prancha'.$j.'_qdr'.$i] = (string) $prancha->ocupada_prancha;
					$_SESSION['pathvoz_prancha'.$j.'_qdr'.$i] = (string) $prancha->pathvoz_prancha;
					$j++;
				}
				$i++;
			}
			//apaga o arquivo
			unlink($destino);
		}
		else{
			echo '<script> alert("Somente arquivos com o formato .swp podem ser abertos"); </script>';
		}
	}
	else{
		echo '<script> alert("Falha ao abrir"); </script>';
	}
}
?>
