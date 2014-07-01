<?php
session_start();
include('conecta.php');

//$sql = "SELECT * FROM admin_chat WHERE usuario = '".$_POST['login']."' and senha = '".$_POST['senha']."'";

$sql = "SELECT * FROM usuario WHERE login = '".$_POST['login']."' and senha = '".$_POST['senha']."'";

$qry = pg_query($sql);

if($v = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
	if (($v['usuario'] == $_POST['login']) && ($v['senha'] == $_POST['senha'])){
			header("Location: inicio.php");
		}
	
}
else
	echo "<script> alert('Dados incorretos!'); location.href='index.php'; </script>";
?>
