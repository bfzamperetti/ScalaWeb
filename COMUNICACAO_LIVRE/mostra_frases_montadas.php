<?php
include('../INCLUDES/conecta.php');
$today = date("Y-m-d"); 
				$sql = "SELECT * FROM mensagem WHERE data = '".$today."' ORDER BY id DESC";
				$qry = pg_query($sql) or die ("erros");				
				

				if($msg = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
						
						$ssql = "SELECT nome FROM usuario WHERE id =".$msg['usuario_id'];
			     		$qqry = pg_query($ssql) or die ("erros");
							if($mmsg = pg_fetch_array($qqry, NULL, PGSQL_ASSOC)){
								$nomepessoa = $mmsg['nome'];
							}
						printf('Ultima mensagem: %s <h4> '.$nomepessoa.' diz: %s </h4>', $msg['hora'], $msg['frase']);
						
						while ($row = pg_fetch_row($qry)) {
						
						
						$ssql = "SELECT nome FROM usuario WHERE id =".$msg['usuario_id'];
			     		$qqry = pg_query($ssql) or die ("erros");
							if($mmsg = pg_fetch_array($qqry, NULL, PGSQL_ASSOC)){
								$nome = $mmsg['nome'];	
							}
							
								echo "<h4>$nome diz: $row[1]</h4>";
								
					    }					   
				}
				
?>
