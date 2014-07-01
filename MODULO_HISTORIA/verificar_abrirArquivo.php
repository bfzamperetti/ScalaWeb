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
	$caminho = $_SESSION['url_hist_temp'];
	
	//verificar se algum arquivo foi enviado
	if(!(empty($arquivo))){
		
		//verificar se o arquivo é do tipo .scalaweb
		if(strtolower(end(explode('.', $arquivo["name"]))) == 'hsw'){
			
			//define o nome do novo arquivo como a data e hora atuais e o login do usuario, isso serve para nunca sobrepor arquivos e perder dados.
			$destino = $caminho.date("y-m-d-H-i-s").$_SESSION['login'].".hsw";
			move_uploaded_file($arquivo['tmp_name'],$destino);
			
			
			#define o encoding do cabeçalho para utf-8
			@header('Content-Type: text/html; charset=utf-8');
			#carrega o arquivo XML e retornando um Array
			$xml = simplexml_load_file($destino);
			# se o xml for um link e nao um arquivo como livros.xml, troque -o pelo link ex.
			#para cada nó LIVRO  atribui à variavel $livro (obj simplexml)
			$_SESSION['hist_n_quadros'] = (int) $xml->config->historia_numero_de_quadros;
			$_SESSION['hist_quadro_atual'] = (int) $xml->config->historia_quadro_atual;
			$_SESSION['hist_busca_imgs_atual'] = (int) $xml->config->historia_busca_imgs_atual;
			$i = 1;
			foreach($xml->quadros->quadro as $quadro){
				$_SESSION['hist_layout_qdr'.$i] = (int) $quadro->tipo_layout;
				$j = 0;
				
				foreach($quadro->quadrinho as $quadrinho){
					$k = 100000;
					$_SESSION['qdr'.$i.'_quadrinho'.$j.'_ini'] = 100000;
					$_SESSION['qdr'.$i.'_quadrinho'.$j.'_fim'] = 100000;
					$_SESSION['qdr'.$i.'_quadrinho'.$j.'_layout'] = (int)$quadrinho->layout_quadrinho;
					$_SESSION['qdr'.$i.'_quadrinho'.$j.'_narracao'] = (string)$quadrinho->narracao;
					$_SESSION['qdr'.$i.'_quadrinho'.$j.'_cenario'] = (string)$quadrinho->cenario;
					
					foreach($quadrinho->figura as $figura){
						
						$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_top'] = (int)$figura->top;
						$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_left'] = (int)$figura->left;
						$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_height'] = (int)$figura->height;
						$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_width'] = (int)$figura->width;
						if ((string) $figura->path == "")
							$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_path'] = "";
						else{
							$img_id = explode(".", (string) $figura->path);
							if ($img_id[0] <= 100) //se for imagem de texto
								$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_path'] =  $_SESSION['url_imagens_textos'].$img_id[0].".".$img_id[1];
							else if ($img_id[0] >= 100000) //se for imagem do usuario
								$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_path'] =  $_SESSION['url_imagens_usuario'].$img_id[0].".".$img_id[1];	 
							else
								$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_path'] =  $_SESSION['url_imagens'].$img_id[0].".".$img_id[1];	 
						}
						$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_ang'] = (int)$figura->ang;
						$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_inv'] = (int)$figura->inv;
						if (isset($figura->inv)) 
							$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_text'] = (string)$figura->text;
						$k++;
				    }
				$_SESSION['qdr'.$i.'_quadrinho'.$j.'_fim'] = $k;
				$j++;
				}
			$i++;
			}		
			
			//apaga o arquivo
			unlink($destino);
			
		}
		else{
			echo '<script> jAlert("Somente arquivos com a extens&atilde;o .hsw s&atilde;o permitidos","Aviso de Arquivo"); </script>';
		}
	}
	else{
		echo '<script> jAlert("Falha ao abrir","Aviso de Arquivo"); </script>';
	}
}
?>
