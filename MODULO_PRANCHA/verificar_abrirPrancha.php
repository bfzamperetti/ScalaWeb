<?php
if (isset($_POST['abrirPranchaLista'])){
		session_start();
		$sql = 'SELECT * FROM prancha_usuario WHERE id = '.$_POST['id'];
		$qry = pg_query($sql);
		$p = pg_fetch_array($qry, NULL, PGSQL_ASSOC);
		$dados = explode("|", $p['prancha']);
		$_SESSION['n_quadros'] = $dados[0];
		$_SESSION['quadro_atual'] = $dados[1];
		$_SESSION['busca_imgs_atual'] = $dados[2];
		for ($i = 3; $i < count($dados); $i++){
			$dados2 = explode(",",$dados[$i]);
			$_SESSION['layout_qdr'.($i-2)] = $dados2[0];
			for ($j = 0; $j < 12; $j++){
				$dados3 = explode("*",$dados2[$j+1]);
				if ($dados3[0] != ""){
					$img_id = explode(".",$dados3[0]);
					if ($img_id[0] >= 100000) //quer dizer que é prancha do usuario
						$_SESSION['pathimg_prancha'.$j.'_qdr'.($i-2)] = $_SESSION['url_imagens_usuario'].$dados3[0];
					else
						$_SESSION['pathimg_prancha'.$j.'_qdr'.($i-2)] = $_SESSION['url_imagens'].$dados3[0];
				}
				else
					$_SESSION['pathimg_prancha'.$j.'_qdr'.($i-2)] = "";
				$_SESSION['nome_prancha'.$j.'_qdr'.($i-2)] = $dados3[1];
				$_SESSION['ocupada_prancha'.$j.'_qdr'.($i-2)] = $dados3[2];
				$_SESSION['pathvoz_prancha'.$j.'_qdr'.($i-2)] = $dados3[3];
			}
		}
	}
?>
