<?php
session_start();
$diretorio = "imagens/exportar_temp/".$_SESSION['login'];
if (rmdir($diretorio)) echo "oi";
mkdir($diretorio, 777);
chmod ($diretorio, 0777);
header("Location: exportar_pdf.php");
?>
