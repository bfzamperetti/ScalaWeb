<div class="forms_capa" style="width: 780px;">
	<div class="titulo_form" style="width: 760px;"> Autorizar Usuario. </div>
	<a href="index.php"><div class="voltar" style="top: 40px;"></div></a>
	<style>
		.autorizado{
			color: #222;
			font-size: 18px;
			margin-top: 20px;
			position: relative;
		}
		
	</style>
<?php
if (!isset($_GET['k']))
	header("Location: index.php");

include_once("../INCLUDES/conecta.php");
include("../INCLUDES/VARS_SCALA.php");

$sql = "UPDATE usuario SET autorizado = 's' WHERE chave_senha = '".$_GET['k']."'";
pg_query($sql);	

$sql = "SELECT * FROM usuario WHERE chave_senha = '".$_GET['k']."'";
$qry = pg_query($sql);
if (!pg_fetch_array($qry, NULL, PGSQL_ASSOC))
	echo '<div class="autorizado"> Chave inválida! </div>';
else
	echo '<div class="autorizado"> Usuário autorizado com sucesso! </div>';
?>
</div>
