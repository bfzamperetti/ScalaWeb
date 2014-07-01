<!-- 
Formato Salvar: 
1]0]1]1/2**26|12|20|15|11948.png|0|0|)61|40.5|20|15|11930.png|0|0|)-2**-2**-2**-**-**-}

sendo, nessa ordem:
] -> hist_n_quadros, hist_busca_imgs_atual, hist_quadro_atual
/ -> hist_layout_qdr
- -> cada quadrinho
) -> cada imagem
| -> cada elemento da imagem
* -> layout, narração
} -> quadro

-->

<?php
	
	date_default_timezone_set("Brazil/East");
	include_once('../INCLUDES/conecta.php');
	session_start();
	
	//colocar as informações da prancha em uma string, com um formato definido (igual ao arquivo salvo);
	$conteudo = $_SESSION['hist_n_quadros']."]".$_SESSION['hist_busca_imgs_atual']."]".$_SESSION['hist_quadro_atual']."]";
	
	for ($i = 1; $i <= $_SESSION['hist_n_quadros']; $i++){	
		$conteudo .= $_SESSION['hist_layout_qdr'.$i]."¬";
		
		for ($j = 0; $j < 6; $j++){
			$conteudo .= $_SESSION['qdr'.$i.'_quadrinho'.$j.'_layout']."*";
			$conteudo .= $_SESSION['qdr'.$i.'_quadrinho'.$j.'_narracao']."*";
			$conteudo .= $_SESSION['qdr'.$i.'_quadrinho'.$j.'_cenario']."*";
			$inicio = $_SESSION['qdr'.$i.'_quadrinho'.$j.'_ini']; 
			$fim = $_SESSION['qdr'.$i.'_quadrinho'.$j.'_fim'];
			
			for ($k = $inicio; $k < $fim; $k++){
					$conteudo .= $_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_top']."|";
					$conteudo .= $_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_left']."|";
					$conteudo .= $_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_height']."|";
					$conteudo .= $_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_width']."|";
					$img_id1 = end(explode("/",$_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_path']));
					$img_id = explode(".",$img_id1);
					if ($_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_path'] == "")
						$conteudo .= "|";
					else
						$conteudo .= $img_id[0].".".$img_id[1]."|";  
					$conteudo .= $_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_ang']."|";
					$conteudo .= $_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_inv']."|";
					if(isset($_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_text']))
						$conteudo .= $_SESSION['qdr'.$i.'_quadrinho'.$j.'_imgquad'.$k.'_text']."|";
				$conteudo .= ")";		
			}
			$conteudo .= "@";
		}	
		$conteudo .= "}";	
	}	
			
			/*
			$img_id1 = end(explode("/",$_SESSION['pathimg_prancha'.$j.'_qdr'.$i]));
			$img_id = explode(".",$img_id1);
			if ($img_id[0] == "")
				$conteudo .= ",";
			else
				$conteudo .= ",".$img_id[0].".".$img_id[1];
			$conteudo .= "*".$_SESSION['nome_prancha'.$j.'_qdr'.$i];
			$conteudo .= "*".$_SESSION['ocupada_prancha'.$j.'_qdr'.$i];
			$conteudo .= "*".$_SESSION['pathvoz_prancha'.$j.'_qdr'.$i];  */
		
		$sql = "SELECT max(id) as maxid FROM historia_usuario";
		$qry = pg_query($sql);
		$max=1;
		if ($maxid = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
			$max = $maxid['maxid']+1;
		}
		
		//salvar no banco
		$sql = "INSERT INTO historia_usuario (id, nome, historia, tipo, data, id_usuario) VALUES (".$max.", '".$_GET['nome']."', '".$conteudo."', '".$_GET['tipo']."', '".date("Y-m-d")."'  ,  ".$_SESSION['id'].");";
		pg_query($sql) or die("Erro no Banco");
	

?>
