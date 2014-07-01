<?php

if (isset($_POST['importarSom'])){
	$arquivo_som = $_FILES['arquivo_som'];
	if($arquivo_som["name"] != ''){
		//pegar novo id
		$sql = 'SELECT max(id) as maxid FROM som_usuario';
		$qry = pg_query($sql);
		$som = pg_fetch_array($qry, NULL, PGSQL_ASSOC);
		$novo_id = $som['maxid']+1;
		
		
		$caminho = $_SESSION['url_sons_usuario'];
		
		//pegar extensao da imagem
		$ext_som = strtolower(end(explode('.', $arquivo_som["name"])));
		$array_ext_sons = array('mp3');
		
		//verificar se o formato da imagem e valido
		if (in_array( $ext_som, $array_ext_sons )){
			if ($arquivo_som['size'] < 1024 * 1024 * 8){ //8 megas, para alterar este valor, tem que alterar tambem no php.ini
			
				//aloca a imagem com o nome = novo id na pasta corespondente
				$destino_som = $caminho.$novo_id.".".$ext_som;
				move_uploaded_file($arquivo_som['tmp_name'],$destino_som);
				
				$img_id1 = end(explode("/",$_SESSION['pathimg_prancha'.$_POST['id_prancha'].'_qdr'.$_SESSION['quadro_atual']]));
				$img_id = explode(".",$img_id1);
				
				$tipo = 0;
				if ($img_id1[1] == 'imgs_usuario') 
					$tipo = 1;
					
				$sql2 = 'SELECT * FROM som_usuario WHERE id_imagem = '.$img_id[0].' and id_usuario = '.$_SESSION['id'];
				$qry2 = pg_query($sql2);
				if ($som = pg_fetch_array($qry2, NULL, PGSQL_ASSOC)){
					$sql = "UPDATE som_usuario  SET id = ".$novo_id.", caminho = '".$novo_id.".".$ext_som."', tipo =".$tipo.", id_imagem = ".$img_id[0].", id_usuario = ".$_SESSION['id']." WHERE id_imagem = ".$img_id[0]." and id_usuario = ".$_SESSION['id'];
					$qry = pg_query($sql) or die ($sql);
				}
				else{
					$sql = "INSERT INTO som_usuario (id, caminho, tipo, id_imagem, id_usuario) VALUES (".$novo_id.", '".$novo_id.".".$ext_som."' ,".$tipo.",".$img_id[0].", ".$_SESSION['id'].");";
					$qry = pg_query($sql) or die ($sql);
				}
				echo "<script > jAlert('Som enviado!','Aviso de Som'); </script>";
			}
			else{
				echo '<script> jAlert("Som com um tamanho muito grande","Aviso de Som"); </script>';
			}
		}
		else{
			echo '<script> jAlert("O formato do som escolhido esta incorreto.","Aviso de Som"); </script>';
		}
	}
	else{
		echo '<script> jAlert("Nenhum arquivo foi enviado!","Aviso de Som"); </script>';
	}
}

?>
