<?php
session_start();
/* incluir paginas necessarias (nao mudar a ordem) */
include('../INCLUDES/conecta.php');
?>
<?php	
if (isset($_GET['retrieve'])) include('retrieve.php');
else if (isset($_GET['create'])) include('create.php');
else if ($_SERVER['REQUEST_METHOD'] == "PUT"){
	parse_str(file_get_contents('php://input'), $_PUT);
	include('update.php');
}
else if ($_SERVER['REQUEST_METHOD'] == "DELETE"){
	parse_str(file_get_contents('php://input'), $_DELETE);
    include('delete.php');   
}
else echo 'Esta requisição não existe.';
?>	
