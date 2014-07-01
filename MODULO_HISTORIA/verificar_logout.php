<?php
if (isset($_GET['logout'])){
	// zerar a sessão e enviar para a página inicial do aplicativo.
	$_SESSION = array();
	header("Location: ../index.php");
}
?>
