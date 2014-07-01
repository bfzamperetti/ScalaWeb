<?php 

// $host = "scala.ufrgs.br";
// $port = "5433";
// $dbname = "scala";
// $user = "postgres";
// $password = "scala"; 
// $con_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
// $bdcon4 = pg_connect($con_string);


// $sql = "SELECT id FROM usuario ";
// $rs = pg_query($sql);


// while($obj= pg_fetch_array($rs, NULL, PGSQL_ASSOC)) 
// {
	// $return[] = $obj["id"];
// }

// print_r($return);


// print_r($return);
	// for($i=0; $i<count($return); $i++)
	// {
		// $sql2="INSERT INTO teste (id) VALUES (".$return[$i].")";
		
		// $rs2 = mysqli_query($link, $sql2);
	// }
	









// $link = mysqli_connect('localhost','root','','scala');

// if (!$link) {
    // die('Connect Error (' . mysqli_connect_errno() . ') '
            // . mysqli_connect_error());
// }

// $sql = "SELECT 
				// id 
			// FROM 
				// usuario ";
		
	// $rs = mysqli_query($link, $sql);
	

	
	
	
	// while($obj = mysqli_fetch_array($rs)) 
	// {
		// $return[] = $obj["id"];
	// }
	
	// print_r($return);
	// for($i=0; $i<count($return); $i++)
	// {
		// $sql2="INSERT INTO teste (id) VALUES (".$return[$i].")";
		
		// $rs2 = mysqli_query($link, $sql2);
	// }
	
	
	
	
	
	


function SelecionarAmigo($conexao,$id)
{
	$lista_amigos=0;
	$id_amigos=idAmigos($conexao,$id);
	
	if(!empty($id_amigos))
		$lista_amigos=implode(",",$id_amigos);
		
	$sql = "SELECT 
				nome 
			FROM 
				usuario 
			WHERE 
				usuario.id !=".$id."  AND usuario.id NOT IN (".$lista_amigos.")";
	
		
	$rs = mysqli_query($conexao, $sql);
		
	$return = array();

	if($rs)
	{
		while($obj = mysqli_fetch_array($rs)) 
		{
			$return[] = $obj["nome"];
		}
	}
	
	
	return $return;

}






function SelecionarAmigodddd($conexao,$id,$busca=null)
{
	$query = 'SELECT nome FROM usuario WHERE id!="'.$id.'"';
 
	if(isset($busca))
	{
		// Add validation and sanitization on $_POST['query'] here
		// Now set the WHERE clause with LIKE query
		$query .= ' AND nome LIKE "%'.$busca.'%"';
	}
	
 
	$return = array();
 
	if($result = mysqli_query($conexao,$query))
	{
		// fetch object array
		while($obj = mysqli_fetch_array($result)) 
		{
			$return[] = $obj["nome"];
		}
	
		 // mysqli_close($result);
	}
	
	$json = json_encode($return);
	
	// return $return;
}





function verificaStatus($conexao,$id)
{
	$session=session_id();
	$time=time();
	$time_check=$time-600; //SET TIME 10 Minute

	$tbl_name='amigos'; // Table name

	// $sql="SELECT * FROM ".$tbl_name." WHERE session='".$session."'";
	// $result=mysqli_query($conexao,$sql);
	
	// $count=mysqli_num_rows($result);

	// if($count=="0")
	// {
		// $sql1="INSERT INTO ".$tbl_name."(session, time)VALUES('".$session."', '".$time."')";
		// print_r($sql1);
		// $result1=mysqli_query($conexao,$sql1);
	// }

	// else
	// {
		$sql2="UPDATE ".$tbl_name." SET tempo='".$time."' , sessao = '".$session."' WHERE id=".$id."";
		$result2=mysqli_query($conexao,$sql2);
	// }

	$sql3="SELECT * FROM ".$tbl_name." WHERE sessao!=''"  ;
	$result3=mysqli_query($conexao,$sql3);

	$count_user_online=mysqli_num_rows($result3);

	echo "User online : ".$count_user_online."";

//	if over 10 minute, delete session
	$sql4="UPDATE ".$tbl_name." SET tempo=0 , sessao='' WHERE tempo<'".$time_check."'";
	$result4=mysqli_query($conexao,$sql4);

	// Open multiple browser page for result
	
	

}


function idAmigos($conexao,$id)
{
	$sql = "SELECT lista_amigos FROM amigos WHERE id=".$id."";
	
	$rs = mysqli_query($conexao, $sql);
	
	$row = mysqli_fetch_array($rs);
	
	if(!empty($row['lista_amigos']))
		$id_amigos= explode(",", $row['lista_amigos']);
	else
		$id_amigos='';
	
	return $id_amigos;

}


function getId($conexao,$nome)
{
	$sql = "SELECT id FROM usuario WHERE nome LIKE '".$nome."'";

	$rs = mysqli_query($conexao, $sql);
		
	$row = mysqli_fetch_array($rs);

	return $row['id'];

}







function getNome($conexao,$id)
{
	$sql = "SELECT nome FROM usuario WHERE id=".$id."";
		
	$rs = mysqli_query($conexao, $sql);
		
	$row = mysqli_fetch_array($rs);

	return $row['nome'];

}

function getAvatar($conexao,$id)
{

	$sql = "SELECT avatar FROM amigos WHERE id=".$id."";

	$rs = mysqli_query($conexao, $sql);

	$row = mysqli_fetch_array($rs);

	return $row['avatar'];
}



//retorna um array com indice=id e valor=nome
 //array(1 => "Leonardo", 4 => "Luiz");
function nomeAmigos($conexao,$id)
{
	$nome_amigos=array();
	
	$id_amigos=idAmigos($conexao,$id);
	
	if(!empty($id_amigos))
	{
		for($i=0; $i<count($id_amigos); $i++)
		{
			$nome=getNome($conexao,$id_amigos[$i]);
			$nome_amigos[$id_amigos[$i]]= $nome;
			
		}
	}
	return $nome_amigos;
	

}



//retorna um array com indice=id e valor=avatar
 //array(1 => "avatar_1", 4 => "avatar_2");
function avatarAmigos($conexao,$id)
{
	$avatar_amigos=array();
	
	$id_amigos=idAmigos($conexao,$id);
	if(!empty($id_amigos))
	{
		for($i=0; $i<count($id_amigos); $i++)
		{
			$avatar=getAvatar($conexao,$id_amigos[$i]);	
			$avatar_amigos[$id_amigos[$i]]=$avatar;
			
		}
	}
	return $avatar_amigos;
	

}

function atualizaAvatar($conexao,$id,$src)
{
	$sql1 = "UPDATE amigos SET avatar='" .$src."' WHERE id=".$id."";
	
	$rs1 = mysqli_query($conexao, $sql1);
}



//esta funçao atualiza o novo amigo cadastrado e tambem adiciona a pessoa q o adicionou como amigo
function atualizaAmigos($conexao,$id,$novo_amigo)
{
	$ids_amigos_antigos=implode(",",idAmigos($conexao,$id));
	
	$id_amigo_novo=(string)getId($conexao,$novo_amigo);
	
	if(!empty($ids_amigos_antigos))
		$nova_lista_amigos=$ids_amigos_antigos.",".$id_amigo_novo;
	else
		$nova_lista_amigos=$id_amigo_novo;
	
	$sql1 = "UPDATE amigos SET lista_amigos='".$nova_lista_amigos."' WHERE id=".$id."";
	
	$rs1 = mysqli_query($conexao, $sql1);
	
	atualizaAmigos2($conexao,$id_amigo_novo,$id);

}

function atualizaAmigos2($conexao,$id,$id_amigo_novo)
{
	$ids_amigos_antigos=implode(",",idAmigos($conexao,$id));
	
	if(!empty($ids_amigos_antigos))
		$nova_lista_amigos=$ids_amigos_antigos.",".$id_amigo_novo;
	else
		$nova_lista_amigos=$id_amigo_novo;
	
	
	$sql1 = "UPDATE amigos SET lista_amigos='".$nova_lista_amigos."' WHERE id=".$id."";
	
	$rs1 = mysqli_query($conexao, $sql1);

}

function excluiAmigos($conexao,$id,$lista_excluidos)
{
	$ids_amigos_antigos=idAmigos($conexao,$id);

	$diff = array_diff($ids_amigos_antigos, $lista_excluidos);

	
	
	if(!empty($diff))
		$nova_lista_amigos=implode(",",$diff);
	else
		$nova_lista_amigos='';
	
	$sql1 = "UPDATE amigos SET lista_amigos='".$nova_lista_amigos."' WHERE id=".$id."";
	
	$rs1 = mysqli_query($conexao, $sql1);
	
    for($i=0; $i< count($lista_excluidos); $i++)
		excluiAmigos2($conexao,$lista_excluidos[$i],array($id));
}	

function excluiAmigos2($conexao,$id,$lista_excluidos)
{
	$ids_amigos_antigos=idAmigos($conexao,$id);

	$diff = array_diff($ids_amigos_antigos, $lista_excluidos);

	
	
	if(!empty($diff))
		$nova_lista_amigos=implode(",",$diff);
	else
		$nova_lista_amigos='';
	
	$sql1 = "UPDATE amigos SET lista_amigos='".$nova_lista_amigos."' WHERE id=".$id."";
	
	$rs1 = mysqli_query($conexao, $sql1);
	
}
?>
