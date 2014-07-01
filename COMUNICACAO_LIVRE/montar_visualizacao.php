<?php
	include_once('../INCLUDES/conecta.php');
	include_once('../INCLUDES/uses.php');
	session_start();
	$today = date("Y-m-d"); 

		$i = 0;
		echo "Todas as frases montadas no dia de hoje (".$today.") <br>";
		
		
				$sql = "SELECT * FROM mensagem WHERE data = '".$today."' ORDER BY id DESC";
				// Um dos WHERE estava usuario_id ='".$_SESSION['id']."' and
				$qry = pg_query($sql) or die ("erros");				
				if($msg = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
						if ($msg['usuario_id'] == 16){
							$msg['usuario_id'] = "Grégori";
						}
						if ($msg['usuario_id'] == 10){
							$msg['usuario_id'] = "Sheila";
						}
						printf('Ultima mensagem: %s <h4> '.$msg['usuario_id'].' diz: %s </h4>', $msg['hora'], $msg['frase']);
						while ($row = pg_fetch_row($qry)) {
								if($row[4] == 16){
								echo "<h4>Grégori diz: $row[1]</h4>";	
								}
								if($row[4] == 10){
									echo "<h4>Sheila diz: $row[1]</h4>";
								}
								
								
					    }					   
				}
				
?>
