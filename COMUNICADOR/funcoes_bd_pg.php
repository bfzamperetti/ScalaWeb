<?php 

include('../INCLUDES/conecta.php');

/*
 $sql = "SELECT id FROM usuario ";
 $rs = pg_query($sql);


 while($obj= pg_fetch_array($rs, NULL, PGSQL_ASSOC)) 
 {
	$return[] = $obj["id"];
 }

 


for($i=0; $i<count($return); $i++)
{
	$sql2="INSERT INTO amigos (id,avatar) VALUES (".$return[$i].",'avat_h1.png')";
		print_r($sql2);
	$rs2 = pg_query($sql2);
 }

*/

function VerificaUsuario($id)	
{
	$sql= "SELECT 
				id 
			FROM 
				amigos 
			WHERE 
				id =".$id."";
	 $rs = pg_query($sql);
	 $obj = pg_fetch_array($rs, NULL, PGSQL_ASSOC);
	
	if(empty($obj))
	{
		
		  $sql2="INSERT INTO amigos (id,avatar) VALUES (".$id.",'avat_h1.png')";
			
		  $rs2 = pg_query($sql2);
	}	
}

function GetPictoUsuario($id)
{
	$sql = 'SELECT * FROM imagem_usuario WHERE id_usuario = '.$id.' and visivel = 1 ORDER BY id DESC';
	$qry = pg_query($sql);
	$return = array();
		
		while ($imgs = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
			
		$ext = end(explode("/", $imgs['mimetype']));
		if ($ext == "jpeg") $ext = "jpg";
		$caminho_imgs = $imgs['id'].".".$ext;
		if ($imgs['mimetype'] == "image/gif")
			$caminho_final= "../../scalaserver/imagens/imagens_usuario/".$caminho_imgs;
		else
			$caminho_final="../../scalaserver/imagens/mini_imagens_usuario/".$caminho_imgs;

		$return[] = $caminho_final;
		

		}
	return $return;	
}

function NomesPictoUsuario($id)
{

	$sql = 'SELECT * FROM imagem_usuario WHERE id_usuario = '.$id.' and visivel = 1 ORDER BY id DESC';
	$qry = pg_query($sql);
	$return = array();
		
	while ($imgs = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){

		$return[] = $imgs['nome'];

	}
	
	return $return;

}



function GetPicto($cat)
{
	$sql = 'SELECT * FROM imagem WHERE categoria_id = '.($cat+132).' and removida = false ORDER BY nome'; //o 132 é para sincronizar com o indice usado pelo scala Android
	$qry = pg_query($sql);
	$return = array();
		
		while ($imgs = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
			
		$ext = end(explode("/", $imgs['mimetype']));
		if ($ext == "jpeg") $ext = "jpg";
		$caminho_imgs = $imgs['id'].".".$ext;
		if ($imgs['mimetype'] == "image/gif")
			$caminho_final= "../../scalaserver/imagens/imagens/".$caminho_imgs;
		else
			$caminho_final="../../scalaserver/imagens/mini_imagens/".$caminho_imgs;

		$return[] = $caminho_final;
		

		}
	return $return;

}

function NomesPicto($cat)
{

	$sql = 'SELECT * FROM imagem WHERE categoria_id = '.($cat+132).' and removida = false ORDER BY nome'; //o 132 é para sincronizar com o indice usado pelo scala Android
	$qry = pg_query($sql);
	$return = array();
		
	while ($imgs = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){

		$return[] = $imgs['nome'];

	}
	
	return $return;

}



function SelecionarAmigo($id)
{
	$lista_amigos=0;
	$id_amigos=idAmigos($id);
	
	if(!empty($id_amigos))
		$lista_amigos=implode(",",$id_amigos);
		
	$sql = "SELECT 
				nome,id,email 
			FROM 
				usuario 
			WHERE 
				usuario.id !=".$id."  AND usuario.id NOT IN (".$lista_amigos.")";
	
		// $qry = pg_query($sql);
		// $img = pg_fetch_array($qry, NULL, PGSQL_ASSOC);
	$rs = pg_query($sql);
		
	$return = array();

	if($rs)
	{
		while($obj = pg_fetch_array($rs, NULL, PGSQL_ASSOC)) 
		{
			$return[] = array('id'=> $obj['id'],'nome'=> $obj['nome'],'email'=>$obj['email']);
		}
	}
	
	
	return $return;

}


function idAmigos($id)
{
	$sql = "SELECT lista_amigos FROM amigos WHERE id=".$id."";
	
	$rs = pg_query( $sql);
	
	$row = pg_fetch_array($rs,NULL, PGSQL_ASSOC);
	
	if(!empty($row['lista_amigos']))
		$id_amigos= explode(",", $row['lista_amigos']);
	else
		$id_amigos='';
	
	return $id_amigos;

}


function getId($nome)
{
	$sql = "SELECT id FROM usuario WHERE nome LIKE '".$nome."'";

	$rs = pg_query( $sql);
		
	$row = pg_fetch_array($rs,NULL, PGSQL_ASSOC);

	return $row['id'];

}

function getEmail($id)
{
	$sql = "SELECT email FROM usuario WHERE id=".$id."";
		
	$rs = pg_query( $sql);
		
	$row = pg_fetch_array($rs,NULL, PGSQL_ASSOC);

	return $row['email'];

}





function getNome($id)
{
	$sql = "SELECT nome FROM usuario WHERE id=".$id."";
		
	$rs = pg_query( $sql);
		
	$row = pg_fetch_array($rs,NULL, PGSQL_ASSOC);

	return $row['nome'];

}

function getAvatar($id)
{

	$sql = "SELECT avatar FROM amigos WHERE id=".$id."";

	$rs = pg_query( $sql);

	$row = pg_fetch_array($rs,NULL, PGSQL_ASSOC);

	return $row['avatar'];
}



//retorna um array com indice=id e valor=nome
 //array(1 => "Leonardo", 4 => "Luiz");
function nomeAmigos($id)
{
	$nome_amigos=array();
	
	$id_amigos=idAmigos($id);
	
	if(!empty($id_amigos))
	{
		for($i=0; $i<count($id_amigos); $i++)
		{
			$nome=getNome($id_amigos[$i]);
			$nome_amigos[$id_amigos[$i]]= $nome;
			
		}
	}
	return $nome_amigos;
	

}

function EmailAmigos($id)
{
	$email_amigos=array();
	
	$id_amigos=idAmigos($id);
	
	if(!empty($id_amigos))
	{
		for($i=0; $i<count($id_amigos); $i++)
		{
			$email=getEmail($id_amigos[$i]);
			$email_amigos[$id_amigos[$i]]= $email;
			
		}
	}
	return $email_amigos;
}



//retorna um array com indice=id e valor=avatar
 //array(1 => "avatar_1", 4 => "avatar_2");
function avatarAmigos($id)
{
	$avatar_amigos=array();
	
	$id_amigos=idAmigos($id);
	if(!empty($id_amigos))
	{
		for($i=0; $i<count($id_amigos); $i++)
		{
			$avatar=getAvatar($id_amigos[$i]);	
			$avatar_amigos[$id_amigos[$i]]=$avatar;
			
		}
	}
	return $avatar_amigos;
	

}

function atualizaAvatar($id,$src)
{
	$sql1 = "UPDATE amigos SET avatar='" .$src."' WHERE id=".$id."";
	
	$rs1 = pg_query( $sql1);
}



//esta funçao atualiza o novo amigo cadastrado e tambem adiciona a pessoa q o adicionou como amigo
function atualizaAmigos($id,$id_amigo_novo)
{
	$ids_amigos_antigos=implode(",",idAmigos($id));
	
	
	if(!empty($ids_amigos_antigos))
		$nova_lista_amigos=$ids_amigos_antigos.",".$id_amigo_novo;
	else
		$nova_lista_amigos=$id_amigo_novo;
	

	$sql1 = "UPDATE amigos SET lista_amigos='".$nova_lista_amigos."' WHERE id=".$id."";
	
	$rs1 = pg_query( $sql1);
	
	atualizaAmigos2($id_amigo_novo,$id);

}

function atualizaAmigos2($id,$id_amigo_novo)
{
	$ids_amigos_antigos=implode(",",idAmigos($id));
	
	if(!empty($ids_amigos_antigos))
		$nova_lista_amigos=$ids_amigos_antigos.",".$id_amigo_novo;
	else
		$nova_lista_amigos=$id_amigo_novo;
	
	$sql1 = "UPDATE amigos SET lista_amigos='".$nova_lista_amigos."' WHERE id=".$id."";
	
	$rs1 = pg_query( $sql1);

}

function excluiAmigos($id,$lista_excluidos)
{
	$ids_amigos_antigos=idAmigos($id);

	$diff = array_diff($ids_amigos_antigos, $lista_excluidos);
	
	if(!empty($diff))
		$nova_lista_amigos=implode(",",$diff);
	else
		$nova_lista_amigos='';
	
	$sql1 = "UPDATE amigos SET lista_amigos='".$nova_lista_amigos."' WHERE id=".$id."";
	
	$rs1 = pg_query( $sql1);
	
    for($i=0; $i< count($lista_excluidos); $i++)
		excluiAmigos2($lista_excluidos[$i],array($id));
}	

function excluiAmigos2($id,$lista_excluidos)
{
	$ids_amigos_antigos=idAmigos($id);

	$diff = array_diff($ids_amigos_antigos, $lista_excluidos);
	
	if(!empty($diff))
		$nova_lista_amigos=implode(",",$diff);
	else
		$nova_lista_amigos='';
	
	$sql1 = "UPDATE amigos SET lista_amigos='".$nova_lista_amigos."' WHERE id=".$id."";
	
	$rs1 = pg_query($sql1);
	
}
?>
