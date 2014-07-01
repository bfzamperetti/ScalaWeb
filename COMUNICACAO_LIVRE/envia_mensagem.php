<?php include('../INCLUDES/conecta.php'); ?>
<?php
session_start();
$today = date("Y-m-d"); 
$hora=date("H:i:s");
$userm=$_SESSION['user'];

$frs=$_POST['mensagem'];


$sql = "INSERT INTO mensagem (frase, data, hora, usuario_id) VALUES ('$frs', '$today', '$hora', '$userm')";
$qry = pg_query($sql) or die ("erro?!");

?>
