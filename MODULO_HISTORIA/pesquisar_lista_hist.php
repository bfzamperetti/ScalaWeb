<?php
include('../INCLUDES/conecta.php');
session_start();
include_once('../INCLUDES/uses.php');
$sql = "SELECT * FROM historia_usuario WHERE";
if ($_GET['tipo'] == "privada") 
	$sql .= " id_usuario = ".$_SESSION['id']." and";
$sql .= " tipo='".$_GET['tipo']."' and ( UPPER(nome) LIKE UPPER('%".$_GET['termo']."%') or UPPER(data) LIKE UPPER('%".voltaData($_GET['termo'])."%')) ORDER BY id DESC";
$qry = pg_query($sql);
$i = 0;
while ($p = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
	$i++;
	echo "<div class='hist_lista_hist' id='hist_lista_hist".$p['id']."' onclick='javascript: selecionarHistNaLista(".$p['id'].",\"".$p['tipo']."\");'>
		<div class='foto_hist_lista'>
			<img src='imagens/site/documento.png' width='16px' />
		</div>
		<div class='nome_hist_lista'>
			".$p['nome']."
		</div>";
		if ($p['id_usuario'] == $_SESSION['id'])
			echo "<div class='fechar_hist_lista' onclick='javascript: apagar_hist_lista(".$p['id'].")'>
					<img src='imagens/site/ico2.png' width='16px' />
				</div>";
		echo "<div class='data_hist_lista'>
			".mostraData($p['data']);
		if ($_GET['tipo'] == "publica"){
			$qry2 = pg_query("SELECT nome FROM usuario WHERE id = ".$p['id_usuario']);
			$nome = pg_fetch_array($qry2, NULL, PGSQL_ASSOC);
			$nome_user = split(" ", $nome['nome']);
			echo "-".$nome_user[0];
		}		
		echo "
		</div>
	  </div>";
}
if ($i == 0) echo "<div class='msg_lista_hist'>".$_str['lblAnyHistoryWasFound']."</div>"; 

?>
