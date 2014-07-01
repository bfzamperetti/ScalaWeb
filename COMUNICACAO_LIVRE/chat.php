<?php include('../INCLUDES/conecta.php'); 
$logadoid = $_SESSION['id'];
$_SESSION['user'] = $logadoid;
//Pega nome do usuario
$sql = "SELECT nome FROM usuario where id = '".$logadoid."'";
$qery = pg_query($sql) or die ("erro");
if($us = pg_fetch_array($qery, NULL, PGSQL_ASSOC)){
 $logadonome = $us['nome'];				
}

$_SESSION['iniciosessao'] = date("H:i:s");

?>

<div class="chat_geral">
	<div class="superior">
		<div id="chat_frases_montadas"> 	
  			<?php 
				include('mostra_frases_montadas.php');
  			?>
		</div>
		<div id="usuarios_online">
		<h3>Usuarios Online</h3>
			<?php
				$sql = "SELECT * FROM usuario where chat_status = '1'";
				$qry = pg_query($sql) or die ("erro online");
				if($usuarios = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
					printf('<h4>'.$usuarios['nome'].'</h4>');
					while($loop = pg_fetch_row($qry)) {
								echo "<h4>$loop[2]</h4>";
					}
				}
			?>
		</div>
	</div>
	
<?php
	echo "O chat iniciou-se às ";
	echo $_SESSION['iniciosessao'];
?>	
		<div id="chat_mensagem" contentEditable="true">
				<!--	<span id="spanTeste" /> -->
		</div>	
		
		<div id="escreve">
			<form id="frm_escrever" name="frm_escrever" action="javascript:func()" method="post">
			<!--<form id="frm_escrever" name="frm_escrever" action="sintetizar_som_chat.php" method="post"> -->
				<textarea name ="escrever" id="escrever" style="display:none" ></textarea>			
		</div>
		
		<div id="botao">
				<input type = "image" src="imagens/img_chat/teste.png" width="80" height="90" onClick="envia();limpa();som();"></a>		   
			</form>
		</div>

</div>
