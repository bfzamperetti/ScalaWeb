<?php
if (!session_id()) 
	session_start();
if (isset($_POST['estadoVarredura'])){
	$_SESSION['estado_varredura'] = $_POST['estadoVarredura'];
	$_SESSION['tempo_varredura'] = $_POST['velocidadeVar'];
	$_SESSION['somVar'] = $_POST['somVar'];

	if(isset($_POST['corVar']))
		$_SESSION['cor_varredura'] = $_POST['corVar'];

}

	echo("
	<script>
		estadoSomVarredura = ".$_SESSION['somVar'].";
	</script>
	");
?>
