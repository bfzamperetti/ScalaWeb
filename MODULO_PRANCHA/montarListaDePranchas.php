<?php
include('../INCLUDES/conecta.php');
include_once('../INCLUDES/uses.php');
include('../INCLUDES/strings.php');
session_start();
echo $_str['lblOpenComputerFile'];
echo " 
	<form name='frm_dialog_abrirArquivo' method='post' enctype='multipart/form-data' action='index.php' >
		<input type='file' name='Aasasas' id='arquivo' onchange='document.frm_dialog_abrirArquivo.submit()' />
		<input type='hidden' name='abrirArquivo' />
	</form>
	<hr />
	<div class='pranchas_abrir'>
		<form name='frm_abrir_prancha' action='index.php' method='post'>
		<div class='lista_de_pranchas'>
			<div class='cab_lista_prancha'>
				<div class='titulo_lista_de_pranchas'> ".$_str['lblPrivateBoards']."; </div>
				<div class='busca_lista_de_pranchas'> 
					<input type='text' value='".$_str['lblBoardName']."...' onclick='this.value=\"\"; this.style.color=\"#222\";' onkeyup='pesquisa_lista_prancha(this.value, \"privada\",  \"pranchas_privadas\" );' /> <img src='imagens/site/lupa.png' width='15px' alt='pesquisar...' />
				</div>
			</div>
			
			<div id='pranchas_privadas' class='lista_de_pranchas_quadro'>
			";
				$sql = "SELECT * FROM prancha_usuario WHERE id_usuario = ".$_SESSION['id']." and tipo='privada' ORDER BY id DESC";
				$qry = pg_query($sql);
				$i = 0;
				while ($p = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
					$i++;
					echo "<div class='prancha_lista_pranchas' id='prancha_lista_pranchas".$p['id']."' onclick='javascript: selecionarPranchasNaLista(".$p['id'].",\"".$p['tipo']."\");'>
							<div class='foto_prancha_lista'>
								<img src='imagens/site/documento.png' width='16px' />
							</div>
							<div class='nome_prancha_lista'>
								".$p['nome']."
							</div>
							<div class='fechar_prancha_lista' onclick='javascript: apagar_prancha_lista(".$p['id'].")'>
									<img src='imagens/site/ico2.png' width='16px' />
								</div>
							<div class='data_prancha_lista'>
								".mostraData($p['data'])."
							</div>
						  </div>";
				}
				if ($i == 0) echo "<div class='msg_lista_pranchas'>Não Há Pranchas nesta sessão</div>"; 
		echo '
			</div>
		</div>
		<div class="lista_de_pranchas">
			<div class="cab_lista_prancha">
				<div class="titulo_lista_de_pranchas"> '.$_str["lblPublicBoards"].'; </div>
				<div class="busca_lista_de_pranchas"> 
					<input type="text" value="'.$_str["lblBoardName"].'..." onclick="this.value=\'\'; this.style.color=\'#222\';" onkeyup="pesquisa_lista_prancha(this.value, \'publica\',  \'pranchas_publicas\' );" /> <img src="imagens/site/lupa.png" width="15px" alt="pesquisar..." />
				</div>
			</div>
			<div id="pranchas_publicas" class="lista_de_pranchas_quadro">
			';
				$sql = "SELECT * FROM prancha_usuario WHERE tipo = 'publica' ORDER BY id DESC";
				$qry = pg_query($sql);
				$i = 0;
				
				while ($p = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
					$qry2 = pg_query("SELECT nome FROM usuario WHERE id = ".$p['id_usuario']);
					$nome = pg_fetch_array($qry2, NULL, PGSQL_ASSOC);
					$nome_user = split(" ", $nome['nome']);
					$i++;
					echo "<div class='prancha_lista_pranchas' id='prancha_lista_pranchas".$p['id']."' onclick='javascript: selecionarPranchasNaLista(".$p['id'].",\"".$p['tipo']."\");'>
							<div class='foto_prancha_lista'>
								<img src='imagens/site/documento.png' width='16px' />
							</div>
							<div class='nome_prancha_lista'>
								".$p['nome']."
							</div>";
							if ($p['id_usuario'] == $_SESSION['id'])
								echo "<div class='fechar_prancha_lista' onclick='javascript: apagar_prancha_lista(".$p['id'].")'>
									<img src='imagens/site/ico2.png' width='16px' />
								</div>";
							echo "<div class='data_prancha_lista'>
								".mostraData($p['data'])."-".$nome_user[0]."
							</div>
						  </div>";
				}
				if ($i == 0) echo "<div class='msg_lista_pranchas'>Não Há Pranchas nesta sessão</div>"; 
		echo '
		</div>
		<input type="hidden" value="" name="tipo" /> <!-- estes inputs guardarao a prancha selecionada -->
		<input type="hidden" value="" name="id" /> 
		<input type="hidden" value="" name="abrirPranchaLista" /> 
		</form>
	</div>
	';
?>
