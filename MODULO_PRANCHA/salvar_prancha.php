<?php
	
	date_default_timezone_set("Brazil/East");
	include_once('../INCLUDES/conecta.php');
	session_start();
	
	//colocar as informações da prancha em uma string, com um formato definido (igual ao arquivo salvo);
	$conteudo = $_SESSION['n_quadros']."|".$_SESSION['quadro_atual']."|".$_SESSION['busca_imgs_atual'];
	for ($i = 1; $i <= $_SESSION['n_quadros']; $i++){
	
		$conteudo .= "|".$_SESSION['layout_qdr'.$i];
		for ($j = 0; $j < 12; $j++){
			$img_id1 = end(explode("/",$_SESSION['pathimg_prancha'.$j.'_qdr'.$i]));
			$img_id = explode(".",$img_id1);
			if ($img_id[0] == "")
				$conteudo .= ",";
			else
				$conteudo .= ",".$img_id[0].".".$img_id[1];
			$conteudo .= "*".$_SESSION['nome_prancha'.$j.'_qdr'.$i];
			$conteudo .= "*".$_SESSION['ocupada_prancha'.$j.'_qdr'.$i];
			$conteudo .= "*".$_SESSION['pathvoz_prancha'.$j.'_qdr'.$i]; 
		}
	}
		
		$sql = "SELECT max(id) as maxid FROM prancha_usuario";
		$qry = pg_query($sql);
		$max=1;
		if ($maxid = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
			$max = $maxid['maxid']+1;
		}
		
		//salvar no banco
		$sql = "INSERT INTO prancha_usuario (id, nome, prancha, tipo, data, id_usuario) VALUES (".$max.", '".$_GET['nome']."', '".$conteudo."', '".$_GET['tipo']."', '".date("Y-m-d")."'  ,  ".$_SESSION['id'].");";
		pg_query($sql) or die("Erro no Banco");
	

?>
