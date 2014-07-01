<?php
if (!session_id()) session_start();
// Email por onde o scala envia seus emails (ele deve ser obrigatoriamente do GMAIL):
$EMAIL_SCALA = "scala.ufrgs@gmail.com";
$EMAIL_SCALA_SENHA = "passerino";

//Email para autorizar os pedidos de cadastro
$EMAIL_AUTORIZAR = "bezrosangela@gmail.com";

//caminho das imagens
$_SESSION['url_imagens'] = "http://scala.ufrgs.br/scalaserver/imagens/imagens/";
$_SESSION['url_mini_imagens'] = "http://scala.ufrgs.br/scalaserver/imagens/mini_imagens/";

//caminho dos baloes de textos
$_SESSION['url_imagens_textos'] = "http://scala.ufrgs.br/scalaserver/imagens/textos/";

//caminho dos cenarios
$_SESSION['url_imagens_cenarios'] = "http://scala.ufrgs.br/scalaserver/imagens/cenarios/";

//caminho das imagens do usuario
$_SESSION['url_imagens_usuario'] = "../../scalaserver/imagens/imagens_usuario/";
$_SESSION['url_mini_imagens_usuario'] = "../../scalaserver/imagens/mini_imagens_usuario/";

//caminho dos sons do usuario
$_SESSION['url_sons_usuario'] = "../../scalaserver/sons/sons_usuario/";

//Variáveis Varredura
$_SESSION['tempo_varredura'] = 1000; 	//milissegundos
$_SESSION['status_varredura'] = 0;		//1-ligado 0-desligado

//linguagem
if (!isset($_SESSION['lang'])) $_SESSION['lang'] = "ptbr"; // "ptbr" = portugues, "es" = espanhol, "en" = ingles
?>
