<?php
include('../INCLUDES/conecta.php');
session_start();

$sql = "DELETE FROM prancha_usuario WHERE id = ".$_GET['id']." and id_usuario = ".$_SESSION['id'];
$qry = pg_query($sql);

?>
