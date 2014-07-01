<?php
include('../INCLUDES/conecta.php');
session_start();

$sql = "UPDATE imagem_usuario SET visivel = 0 WHERE id = ".$_GET['id']." and id_usuario = ".$_SESSION['id'];
$qry = pg_query($sql);

?>
