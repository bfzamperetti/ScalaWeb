<?php
include('../INCLUDES/conecta.php');
include('../INCLUDES/strings.php');
include_once('../INCLUDES/uses.php');
if (!session_id())
	session_start();
echo $_str['lblOpenComputerFile'].":
	<form name='frm_dialog_abrirArquivo' method='post' enctype='multipart/form-data' action='index.php' >
		<input type='file' name='arquivo' id='arquivo' onchange='document.frm_dialog_abrirArquivo.submit()' />
		<input type='hidden' name='abrirArquivo' />
	</form>
	<hr />
	<div class='hist_abrir'>
		<form name='frm_abrir_hist' action='index.php' method='post'>
		<div class='lista_de_hist'>
			<div class='cab_lista_hist'>
				<div class='titulo_lista_de_hist'> ".$_str['lblPrivateHistories']." </div>
				<div class='busca_lista_de_hist'> 
					<input type='text' value='".$_str['lblHistoryName']."...' onclick='this.value=\"\"; this.style.color=\"#222\";' onkeyup='pesquisa_lista_hist(this.value, \"privada\",  \"hist_privadas\" );' /> <img src='imagens/site/lupa.png' width='15px' alt='pesquisar...' />
				</div>
			</div>
			<div id='hist_privadas' class='lista_de_hist_quadro'>
			";
				$sql = "SELECT * FROM historia_usuario WHERE id_usuario = ".$_SESSION['id']." and tipo='privada' ORDER BY id DESC";
				$qry = pg_query($sql);
				$i = 0;
				while ($p = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
					$i++;
					echo "<div class='hist_lista_hist' id='hist_lista_privada_hist".$p['id']."' onclick='javascript: selecionarHistNaLista(".$p['id'].",\"".$p['tipo']."\");' title='".$p['nome']."'>
							<div class='foto_hist_lista'>
								<img src='imagens/site/documento.png' width='16px' />
							</div>
							<div class='nome_hist_lista'>
								";
					
							if (strlen($p['nome']) > 20) 
								echo substr($p['nome'],0,20)."...";
							else
								echo $p['nome'];
							
							echo "
							</div>
							<div class='fechar_hist_lista' onclick='javascript: apagar_hist_lista(".$p['id'].")'>
									<img src='imagens/site/ico2.png' width='16px' />
								</div>
							<div class='data_hist_lista'>
								".mostraData($p['data'])."
							</div>
						  </div>";
				}
				if ($i == 0) echo "<div class='msg_lista_hist'>".$_str['lblTheIsNoHistoriesAtThisSection']."</div>"; 
		echo '
			</div>
		</div>
		<div class="lista_de_hist">
			<div class="cab_lista_hist">
				<div class="titulo_lista_de_hist"> '.$_str['lblPublicHistories'].' </div>
				<div class="busca_lista_de_hist"> 
					<input type="text" value="'.$_str['lblHistoryName'].'..." onclick="this.value=\'\'; this.style.color=\'#222\';" onkeyup="pesquisa_lista_hist(this.value, \'publica\',  \'hist_publicas\' );" /> <img src="imagens/site/lupa.png" width="15px" alt="pesquisar..." />
				</div>
			</div>
			<div id="hist_publicas" class="lista_de_hist_quadro">
			';
				$sql = "SELECT * FROM historia_usuario WHERE tipo = 'publica' ORDER BY id DESC";
				$qry = pg_query($sql);
				$i = 0;
				
				while ($p = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
					$qry2 = pg_query("SELECT nome FROM usuario WHERE id = ".$p['id_usuario']);
					$nome = pg_fetch_array($qry2, NULL, PGSQL_ASSOC);
					$nome_user = split(" ", $nome['nome']);
					$i++;
					echo "<div class='hist_lista_hist' id='hist_lista_publica_hist".$p['id']."' onclick='javascript: selecionarHistNaLista(".$p['id'].",\"".$p['tipo']."\");' title='".$p['nome']."'>
							<div class='foto_hist_lista'>
								<img src='imagens/site/documento.png' width='16px' />
							</div>
							<div class='nome_hist_lista'>
						";
					
					if (strlen($p['nome']) > 20) 
						echo substr($p['nome'],0,20)."...";
					else
						echo $p['nome'];
					
					echo "
							</div>";
							if ($p['id_usuario'] == $_SESSION['id'])
								echo "<div class='fechar_hist_lista' onclick='javascript: apagar_hist_lista(".$p['id'].")'>
									<img src='imagens/site/ico2.png' width='16px' />
								</div>";
							echo "<div class='data_hist_lista'>
								".mostraData($p['data'])."-".$nome_user[0]."
							</div>
						  </div>";
				}
				if ($i == 0) echo "<div class='msg_lista_hist'>".$_str['lblTheIsNoHistoriesAtThisSection']."</div>"; 
		echo '
		</div>
		<input type="hidden" value="" name="tipo" /> <!-- estes inputs guardarao a história selecionada -->
		<input type="hidden" value="" name="id" /> 
		<input type="hidden" value="" name="abrirHistLista" /> 
		</form>
	</div>
	';
?>
