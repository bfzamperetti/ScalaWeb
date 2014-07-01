<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ScalaWeb</title>

<?php include_once('../INCLUDES/cabecalhos.php'); ?>
<?php include('../INCLUDES/strings.php'); ?>

</head>
<body style="position: absolute; width:100%; height:100%; display:block;">

<div id="centro" class="visualizar">
		<?php include('desenha_layout.php'); ?>
</div>
<div style="display:block; position: absolute; left:95%; height: 100%; width: 5%;">
		<a href="index.php" ><img src="imagens/site/icones_legendados_<?php echo $_SESSION['lang']; ?>/voltarLegenda.png" width="100%"/></a>
		<div style="cursor:pointer" onclick="sintetizarVisualizarHist();"><img src="imagens/site/icones_legendados_<?php echo $_SESSION['lang']; ?>/reproduzir_legenda.png" width="100%"/></div>
</div>
<div id="sintetizador_de_som"></div>
</body>

