<?php
session_start();
include('../INCLUDES/conecta.php');
include('../INCLUDES/strings.php');
header ('Content-type: text/html; charset=UTF-8');
$sql = "SELECT * FROM usuario WHERE login = '".$_POST['login']."' and senha = '".$_POST['senha']."'";
$qry = pg_query($sql);
if($v = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
	if (($v['login'] == $_POST['login']) && ($v['senha'] == $_POST['senha'])){
		if ($v['autorizado'] == 's'){
			$_SESSION['login'] = $v['login'];
			$_SESSION['nome'] = $v['nome'];
			$_SESSION['id'] = $v['id'];
			header("Location: ../MODULO_PRANCHA/index.php");
		}
		else{
			echo "<script> alert('".$_str['userUnauthorizedMessage']."'); location.href='index.php'; </script>";
		}
	}
}
else
	echo "<script> alert('".$_str['lblIncorrectData']."!'); location.href='index.php'; </script>";

?>
