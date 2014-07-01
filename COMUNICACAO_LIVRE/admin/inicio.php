<?php include('conecta.php'); ?>
<html>
	<title>Admin Comunicação Livre</title>
<head>
<link href="../styles/admin.css" rel="stylesheet" type="text/css" />

</head>
<body>

<div class="geral_hist">
	<div id="paragrafos">
		
		Selecione o aluno para obter seu historico	
		<p></p><p></p>
		<form id="form_hist" action="busca.php" method="post">

		<?php
		$query = "SELECT nome FROM usuario;";
		$result = pg_query($conectar, $query);
		
		if($result){
				echo "<select name='combo'>";
					while($row = pg_fetch_assoc($result))
					{
						echo "<option value='" . $row['nome'] . "'>" . $row['nome']. "</option>";
					}
				echo "</select>";	
		}
		?>
			<input type="submit" name="enviar" value="Buscar">
		</form>
    </div>
</div>
</body>
</html>
