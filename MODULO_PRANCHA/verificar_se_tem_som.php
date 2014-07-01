<?php
session_start();
include('../INCLUDES/conecta.php');
$img_id1 = end(explode("/",$_SESSION['pathimg_prancha'.$_GET['id_prancha'].'_qdr'.$_SESSION['quadro_atual']]));
$img_id = explode(".",$img_id1);
$sql = 'SELECT * FROM som_usuario WHERE id_imagem = '.$img_id[0].' and id_usuario = '.$_SESSION['id'];
$qry = pg_query($sql);
if ($som = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
	echo "<div style='float:left;'>Esta imagem tem um som adicionado. Apagar?</div> <div style='float:left; cursor:pointer;' onclick='apagarSom(".$som['id'].");'>
		<img src='imagens/site/ico2.png' width='20px' />
	</div>";
}
?>
