<?php
	session_start();
	include('conecta.php');
	include('inicio.php');
	if(isset($_POST['enviar'])){
		
		$sql = "SELECT id FROM usuario WHERE nome='".$_POST['combo']."'";
		$qryy = pg_query($sql) or die ("eii");
		
		if($v = pg_fetch_array($qryy, NULL, PGSQL_ASSOC)){
			$resultado = $v['id'];
		}
		
		$qryaluno = "SELECT * FROM mensagem WHERE usuario_id='$resultado'";
		$query = pg_query($qryaluno) or die ("aaa");
	

	echo "<div id='resultado'>";
		echo "<br><strong>Frases criadas por ".$_POST['combo']." </strong><br><br>";
		while($row = pg_fetch_assoc($query)){
			echo "<div id='rr'>".$row['data']." ";
			echo $row['hora']."<br></div>";
			echo "<h3>".$row['frase']."</h3>";
			echo "<br>";
		}
	echo "</div>";
	}

?>
