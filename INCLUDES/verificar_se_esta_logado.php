<?php
/* Se nao estiver logado, redireciona para o inicio */

if ((!isset($_SESSION['login'])) || (!isset($_SESSION['nome']))|| (!isset($_SESSION['id']))){ //verificar se esta logado
	header("Location: ../INICIO/index.php");
}
?>
