<?php
include('../INCLUDES/conecta.php');
/* Seta usuario como online */
$logadid = $_SESSION['id'];

$sql = "UPDATE usuario set chat_status = '0' where id= '".$logadid."'";
$qery = pg_query($sql) or die ("erro");

?>
