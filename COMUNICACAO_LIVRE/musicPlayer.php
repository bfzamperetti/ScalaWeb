<!doctype html>  
<?php
include('../INCLUDES/conecta.php');
session_start();
$busca = "SELECT nome FROM usuario WHERE id =".$_SESSION['id'];
$query = pg_query($busca) or die ("erros");
		if($mmsg = pg_fetch_array($query, NULL, PGSQL_ASSOC)){
			$nome = $mmsg['nome'];	
		}
						
echo '<body>';
echo   '<audio id="PlayAudio" autoplay="true" display="none">';
echo   '<source src="../mp3_tts/'.$nome.'1.mp3" type="audio/ogg" />';
echo   '</audio>';
echo    '</body>';
echo     '</html>';

?>

