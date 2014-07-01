<?php
	session_start();
	include_once('../INCLUDES/uses.php');
	include_once('../INCLUDES/conecta.php');
	$layout = "<html> <head>
	<link href='styles/geral.css' rel='stylesheet' type='text/css' /> <style> .nome_prancha_padrao{ font-size: 10px; } </style> </head>
	<body>";
	
	$layout .= "<div class='vis_layout'>";
	$layout .= "<table class='vis_cab'><tr><td width='100%'> Prancha impressa por: ".$_SESSION['nome']." </td> <td> ScalaWeb </td></tr> </table>";
	$layout .= "<table width='30%' height='60%' cellspacing=0 cellpadding=0 border=0>";
	//desenhar primeiro modelo de layout
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
								echo "<h4>Gregori diz: $row[1]</h4>";	
								}
								if($row[4] == 10){
									echo "<h4>Sheila diz: $row[1]</h4>";
								}
								
					    }					   
				}
	
	
		$layout .= "<tr><td>";
		
		$layout .= "</td></tr>";
	
	
	$layout.= "</table></div>";
	
	$layout.= "</body>";
	
	$layout .= "<script> window.print() </script>"; 
	$layout .= "</html> ";
	
	
	echo $layout;
