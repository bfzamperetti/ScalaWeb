<?php

$req = $_GET['create'];

if ($req == 'usuario'){
	$login_cad = $_POST['login'];
	$nome = $_POST['nome'];
	$senha_cad = $_POST['senha'];
	$cidade = $_POST['cidade'];
	$email = $_POST['email'];
	$profissao = $_POST['profissao'];
	$local = $_POST['local'];
	$autorizado = $_POST['autorizado'];
	
	
	$sql = "SELECT max(id) as maxid FROM usuario";
	$qry = pg_query($sql);
	$max=1;
	if ($maxid = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
		$max = $maxid['maxid']+1;
	}
	 
	$chave_senha = md5(uniqid(rand(), true));
	$sql = "INSERT INTO usuario (id, login, nome, senha, cidade, email, profissao, comunicacao_alternativa, local, chave_senha, autorizado) 
	VALUES (".$max.", '".$login_cad."', '".$nome."', '".$senha_cad."' , '".$cidade."' , '".$email."', '".$profissao."','n','".$local."', '".$chave_senha."', '".$autorizado."');";
	pg_query($sql) or die("Erro no Banco");
}
else if ($req == 'prancha'){
	$nome = $_POST['nome'];
	$tipo = $_POST['tipo'];
	$idUser = $_POST['idUser'];
	$numQuadros = $_POST['numQuadros'];
	$quadroAtual = $_POST['quadroAtual'];
	$prancha = $_POST['prancha']; 
	/* prancha[indiceTela]['tipoLayout']
	 * prancha[indiceTela][indicePrancha]['caminhoImagem']
	 * prancha[indiceTela][indicePrancha]['legenda']
	 * prancha[indiceTela][indicePrancha]['ocupada']
	 * prancha[indiceTela][indicePrancha]['caminhoVoz']
	 * */
	
	//colocar as informações da prancha em uma string, com um formato definido (igual ao arquivo salvo);
	$conteudo = $numQuadros."|".$quadroAtual."|133";
	for ($i = 1; $i <= $numQuadros; $i++){
	
		$conteudo .= "|".$prancha[$i]['tipoLayout'];
		for ($j = 0; $j < 12; $j++){
			$img_id1 = end(explode("/",$prancha[$i][$j]['caminhoImagem']));
			$img_id = explode(".",$img_id1);
			if ($img_id[0] == "")
				$conteudo .= ",";
			else
				$conteudo .= ",".$img_id[0].".".$img_id[1];
			$conteudo .= "*".$prancha[$i][$j]['legenda'];
			$conteudo .= "*".$prancha[$i][$j]['ocupada'];
			$conteudo .= "*".$prancha[$i][$j]['caminhoVoz'];
		}
	}
		
	$sql = "SELECT max(id) as maxid FROM prancha_usuario";
	$qry = pg_query($sql);
	$max=1;
	if ($maxid = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
		$max = $maxid['maxid']+1;
	}
		
	//salvar no banco
	$sql = "INSERT INTO prancha_usuario (id, nome, prancha, tipo, data, id_usuario) VALUES (".$max.", '".$nome."', '".$conteudo."', '".$tipo."', '".date("Y-m-d")."'  ,  ".$idUser.");";
	pg_query($sql) or die("Erro no Banco");
}

else if ($req == 'historia'){
	$nome = $_POST['nome'];
	$tipo = $_POST['tipo'];
	$idUser = $_POST['idUser'];
	$numQuadros = $_POST['numQuadros'];
	$quadroAtual = $_POST['quadroAtual'];
	$historia = $_POST['historia']; 
	/* historia[indiceTela]['tipoLayout']
	 * historia[indiceTela][indiceQuadrinho]['tipoLayout'] numero indicando qual o tipo do layout
	 * historia[indiceTela][indiceQuadrinho]['narracao'] string
	 * historia[indiceTela][indiceQuadrinho]['cenario'] cor em hexa, ex: "#000000" ou caminho absoluto da imagem
	 * historia[indiceTela][indiceQuadrinho]['imagem'][indiceImagem]['top'] em %
	 * historia[indiceTela][indiceQuadrinho]['imagem'][indiceImagem]['left'] em %
	 * historia[indiceTela][indiceQuadrinho]['imagem'][indiceImagem]['height'] em %
	 * historia[indiceTela][indiceQuadrinho]['imagem'][indiceImagem]['width'] em %
	 * historia[indiceTela][indiceQuadrinho]['imagem'][indiceImagem]['caminhoimagem'] caminho absoluto da imagem
	 * historia[indiceTela][indiceQuadrinho]['imagem'][indiceImagem]['angulo']  em degrees
	 * historia[indiceTela][indiceQuadrinho]['imagem'][indiceImagem]['invertido']  1 = invertido
	 * historia[indiceTela][indiceQuadrinho]['imagem'][indiceImagem]['texto'] VARIAVEL OPCIONAL
	 * 
	 * */
	
	//colocar as informações da prancha em uma string, com um formato definido (igual ao arquivo salvo);
	$conteudo = $numQuadros."]133]".$quadroAtual."]";
	
	for ($i = 1; $i <= $numQuadros; $i++){	
		$conteudo .= $historia[$i]['tipoLayout']."¬";
		
		for ($j = 0; $j < 6; $j++){
			if (!isset($historia[$i][$j])){ $conteudo .= "***@"; continue; }
			
			$conteudo .= $historia[$i][$j]['tipoLayout']."*";
			$conteudo .= $historia[$i][$j]['narracao']."*";
			$conteudo .= $historia[$i][$j]['cenario']."*";
			
			for ($k = 0; $k < count($historia[$i][$j]['imagem']); $k++){
				$conteudo .= $historia[$i][$j]['imagem'][$k]['top']."|";
				$conteudo .= $historia[$i][$j]['imagem'][$k]['left']."|";
				$conteudo .= $historia[$i][$j]['imagem'][$k]['height']."|";
				$conteudo .= $historia[$i][$j]['imagem'][$k]['width']."|";
				$conteudo .= end(explode("/",$historia[$i][$j]['imagem'][$k]['caminhoimagem']))."|";
				$conteudo .= $historia[$i][$j]['imagem'][$k]['angulo']."|";
				$conteudo .= $historia[$i][$j]['imagem'][$k]['invertido']."|";
				if (isset($historia[$i][$j]['imagem'][$k]['texto']))
					$conteudo .= $historia[$i][$j]['imagem'][$k]['texto']."|";
					
				$conteudo .= ")";		
			}
			$conteudo .= "@";
		}	
		$conteudo .= "}";	
	}	
		
	$sql = "SELECT max(id) as maxid FROM historia_usuario";
	$qry = pg_query($sql);
	$max=1;
	if ($maxid = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
		$max = $maxid['maxid']+1;
	}
	
	//salvar no banco
	$sql = "INSERT INTO historia_usuario (id, nome, historia, tipo, data, id_usuario) VALUES (".$max.", '".$_GET['nome']."', '".$conteudo."', '".$_GET['tipo']."', '".date("Y-m-d")."'  ,  ".$_GET['idUser'].");";
	pg_query($sql) or die("Erro no Banco");
}
?>
