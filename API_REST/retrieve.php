<?php
$req = $_GET['retrieve'];

if ($req == 'serverInfo'){
	$info['url_imagens'] = $_SESSION['url_imagens'];
	$info['url_mini_imagens'] = $_SESSION['url_mini_imagens'];

	//caminho dos baloes de textos
	$info['url_imagens_textos'] = $_SESSION['url_imagens_textos'];

	//caminho dos cenarios
	$info['url_imagens_cenarios'] = $_SESSION['url_imagens_cenarios'];

	//caminho das imagens do usuario
	$info['url_imagens_usuario'] = $_SESSION['url_imagens_usuario'];
	$info['url_mini_imagens_usuario'] = $_SESSION['url_mini_imagens_usuario'];

	//caminho dos sons do usuario
	$info['url_sons_usuario'] = $_SESSION['url_sons_usuario'];

	echo json_encode($info);		
}

if ($req == 'usuario'){
	if (isset($_GET['id'])){
		$sql = 'SELECT * FROM usuario WHERE id = '.$_GET['id'];
		$qry = pg_query($sql);
		echo json_encode(pg_fetch_array($qry, NULL, PGSQL_ASSOC));
	
	}
	else {
		$sql = 'SELECT * FROM usuario ORDER BY id';
		$qry = pg_query($sql);
		$usuarios = array();
		for ($i = 0; $res = pg_fetch_array($qry, NULL, PGSQL_ASSOC); $i++)
			$usuarios[$i] = $res;
		echo json_encode($usuarios);
	}
}	

if ($req == 'prancha'){
	if (isset($_GET['tipo'])){
		if ($_GET['tipo'] == 'publica')
			$sql = "SELECT * FROM prancha_usuario WHERE tipo = 'publica'";
		if ($_GET['tipo'] == 'privada')
			$sql = "SELECT * FROM prancha_usuario WHERE tipo = 'privada' AND id_usuario = ".$_GET['id'];
		$qry = pg_query($sql);
		$prancha = array();
		for ($i = 0; $p = pg_fetch_array($qry, NULL, PGSQL_ASSOC); $i++){
			$prancha[$i]['id'] = $p['id'];
			$prancha[$i]['nome'] = $p['nome'];
			$prancha[$i]['tipo'] = $p['tipo'];
			$prancha[$i]['data'] = $p['data'];
			$prancha[$i]['idCriador'] = $p['id_usuario'];
		}
		echo json_encode($prancha);		
	}
	else {
		$sql = 'SELECT * FROM prancha_usuario WHERE id = '.$_GET['id'];
		$qry = pg_query($sql);
		$p = pg_fetch_array($qry, NULL, PGSQL_ASSOC);
		$prancha['id'] = $p['id'];
		$prancha['nome'] = $p['nome'];
		$prancha['tipo'] = $p['tipo'];
		$prancha['data'] = $p['data'];
		$prancha['idCriador'] = $p['id_usuario'];
		$dados = explode("|", $p['prancha']);
		$prancha['numQuadros'] = $dados[0];
		$prancha['quadroAtual'] = $dados[1];
		for ($i = 3; $i < count($dados); $i++){
			$dados2 = explode(",",$dados[$i]);
			$prancha['prancha'][$i-2]['tipoLayout'] = $dados2[0];
			for ($j = 0; $j < 12; $j++){
				$dados3 = explode("*",$dados2[$j+1]);
				if ($dados3[0] != ""){
					$img_id = explode(".",$dados3[0]);
					if ($img_id[0] >= 100000) //quer dizer que é prancha do usuario
						$prancha['prancha'][$i-2][$j]['caminhoImagem'] = $dados3[0];
					else
						$prancha['prancha'][$i-2][$j]['caminhoImagem'] = $dados3[0];
				}
				else
					$prancha['prancha'][$i-2][$j]['caminhoImagem'] = "";
				$prancha['prancha'][$i-2][$j]['legenda'] = $dados3[1];
				$prancha['prancha'][$i-2][$j]['ocupada'] = $dados3[2];
				$prancha['prancha'][$i-2][$j]['caminhoVoz'] = $dados3[3];
			}
		}
		echo json_encode($prancha);	
	}
}

if ($req == 'historia'){
	if (isset($_GET['tipo'])){
		if ($_GET['tipo'] == 'publica')
			$sql = "SELECT * FROM historia_usuario WHERE tipo = 'publica'";
		if ($_GET['tipo'] == 'privada')
			$sql = "SELECT * FROM historia_usuario WHERE tipo = 'privada' AND id_usuario = ".$_GET['id'];
		$qry = pg_query($sql);
		$historia = array();
		for ($i = 0; $p = pg_fetch_array($qry, NULL, PGSQL_ASSOC); $i++){
			$historia[$i]['id'] = $p['id'];
			$historia[$i]['nome'] = $p['nome'];
			$historia[$i]['tipo'] = $p['tipo'];
			$historia[$i]['data'] = $p['data'];
			$historia[$i]['idCriador'] = $p['id_usuario'];
		}
		echo json_encode($historia);		
	}
	else {
		$sql = 'SELECT * FROM historia_usuario WHERE id = '.$_GET['id'];
		$qry = pg_query($sql);
		$p = pg_fetch_array($qry, NULL, PGSQL_ASSOC);
		$historia['id'] = $p['id'];
		$historia['nome'] = $p['nome'];
		$historia['tipo'] = $p['tipo'];
		$historia['data'] = $p['data'];
		$historia['idCriador'] = $p['id_usuario'];
		
		$config = explode("]", $p['historia']);		
		$historia['numQuadros'] = $config[0];
		$historia['quadroAtual'] = $config[2];
		
		$quadros = explode("}",$config[3]);
		
		for ($i = 1; $i <= $config[0]; $i++){
			$layout = explode("¬",$quadros[$i-1]);
			$historia[$i]['tipoLayout'] = $layout[0];
			$quadrinho = explode("@",$layout[1]);			
						
			//inicializa informações de cada quadrinho
			for ($j = 0; $j < 6; $j++){			
				$layout_quadrinho = explode('*',$quadrinho[$j]);
				$historia[$i][$j]['tipoLayout'] = $layout_quadrinho[0];	
				$historia[$i][$j]['narracao'] = $layout_quadrinho[1];	
				$historia[$i][$j]['cenario'] =  $layout_quadrinho[2];
										
				//caso tenha alguma imagem no quadrinho
				if ($layout_quadrinho[3] != ""){
					$figura = explode(")",$layout_quadrinho[3]);
					$tamanho = 100000 + count($figura);
										
					//inicializa informações de cada imagem
					for ($k = 100000; $k < $tamanho-1; $k++){	
						$itens_figura = explode("|",$figura[$k-100000]);
						$historia[$i][$j]['imagem'][$k]['top'] = $itens_figura[0];
						$historia[$i][$j]['imagem'][$k]['left'] = $itens_figura[1];
						$historia[$i][$j]['imagem'][$k]['height'] = $itens_figura[2];
						$historia[$i][$j]['imagem'][$k]['width'] = $itens_figura[3];
						
						//se o caminho for em branco, a imagem foi apagada
						if ($itens_figura[4] == "")
								$historia[$i][$j]['imagem'][$k]['caminhoimagem'] = "";
					
						else{
							$img_id = explode(".", $itens_figura[4]);							
							if ($img_id[0] <= 100) //se for imagem de texto
								$historia[$i][$j]['imagem'][$k]['caminhoimagem'] =  $_SESSION['url_imagens_textos'].$img_id[0].".".$img_id[1];
							else if ($img_id[0] >= 100000) //se for imagem do usuario
								$historia[$i][$j]['imagem'][$k]['caminhoimagem'] =  $_SESSION['url_imagens_usuario'].$img_id[0].".".$img_id[1];	 
							else  //se for imagem comum
								$historia[$i][$j]['imagem'][$k]['caminhoimagem'] =  $_SESSION['url_imagens'].$img_id[0].".".$img_id[1];	 
						}
						$historia[$i][$j]['imagem'][$k]['angulo'] = $itens_figura[5];
						$historia[$i][$j]['imagem'][$k]['invertido'] = $itens_figura[6];	
						//caso tenha texto na imagem
						if ($itens_figura[7] != '') 
							$historia[$i][$j]['imagem'][$k]['texto'] = $itens_figura[7];
					}
				}
			} 	
		}	
		echo json_encode($historia);	
	}
}

if ($req == 'imagem'){
	if (isset($_GET['id'])){
		$sql = "SELECT * FROM imagem WHERE id = ".$_GET['id'];
		$qry = pg_query($sql);
		$imagem = false;
		if ($imagem = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
			unset($imagem['caminhosom']); // coluna em desuso porem não pode ser apagada
			$ext = end(explode("/", $imagem['mimetype']));
			if ($ext == "jpeg") $ext = "jpg";
			$caminho_img = $imagem['id'].".".$ext;
			$imagem['caminhoimagem'] = $caminho_img;		
		}
		echo json_encode($imagem);
	}
	else {
		if (isset($_GET['idUsuario']))
			$sql = "SELECT * FROM imagem_usuario WHERE id_usuario = ".$_GET['idUsuario'];
		else
			$sql = "SELECT * FROM imagem WHERE categoria_id = ".$_GET['idCategoria'];
					
		$qry = pg_query($sql);
		$imagem = array();
		for ($i = 0; $p = pg_fetch_array($qry, NULL, PGSQL_ASSOC); $i++){
			$imagem[$i] = $p;
			unset($imagem[$i]['caminhosom']); // coluna em desuso porem não pode ser apagada
			$ext = end(explode("/", $p['mimetype']));
			if ($ext == "jpeg") $ext = "jpg";
			$caminho_img = $p['id'].".".$ext;
			$imagem[$i]['caminhoimagem'] = $caminho_img;		
		}
		echo json_encode($imagem);
	}		
}


if ($req == 'categoria'){
	if (isset($_GET['id'])){
		$sql = "SELECT * FROM categoria WHERE id = ".$_GET['id'];
		$qry = pg_query($sql);
		$categoria = pg_fetch_array($qry, NULL, PGSQL_ASSOC);
		echo json_encode($categoria);
	}
	else {
		$sql = "SELECT * FROM categoria";
		$qry = pg_query($sql);
		$categoria  = array();
		for ($i = 0; $p = pg_fetch_array($qry, NULL, PGSQL_ASSOC); $i++)
			$categoria[$i] = $p;		
		echo json_encode($categoria);		
	}
}

?>
