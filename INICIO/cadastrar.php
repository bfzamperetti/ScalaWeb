<?php
include("../INCLUDES/conecta.php");
include("../INCLUDES/strings.php");
include("../INCLUDES/VARS_SCALA.php");
header ('Content-type: text/html; charset=UTF-8');
	
$sql = "SELECT login FROM usuario WHERE login = '".$_POST['login_cad']."'";
$qry = pg_query($sql);
if($v = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
	echo "<script> alert('".$_str['thereIsAlreadyAnUserWithThisLogin']."'); location.href='index.php'; </script>";
	exit;
} 

$sql = "SELECT max(id) as maxid FROM usuario";
$qry = pg_query($sql);
$max=1;
if ($maxid = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
	$max = $maxid['maxid']+1;
}

if ($_POST['profissao'] == 0)
	$_POST['profissao'] = $_POST['profissao_outros'];
 
$chave_senha = md5(uniqid(rand(), true));
$sql = "INSERT INTO usuario (id, login, nome, senha, cidade, email, profissao, comunicacao_alternativa, local, chave_senha, autorizado) VALUES (".$max.", '".$_POST['login_cad']."', '".$_POST['nome']."', '".$_POST['senha_cad']."' , '".$_POST['cidade']."' , '".$_POST['email']."', '".$_POST['profissao']."','n','".$_POST['local']."', '".$chave_senha."', 'n');";
pg_query($sql) or die("Erro no Banco");

// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
require("../INCLUDES/phpmailer/class.phpmailer.php");

// Inicia a classe PHPMailer
$mail = new PHPMailer();

// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem será SMTP
$mail->Mailer = "smtp";
$mail->Host = "ssl://smtp.gmail.com";
$mail->Port = 465;
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = $EMAIL_SCALA; // SMTP username - Seu e-mail
$mail->Password = $EMAIL_SCALA_SENHA; // SMTP password


// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->From = $EMAIL_SCALA; // Seu e-mail
$mail->FromName = "Scala"; // Seu nome

// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->AddAddress($_POST['email'], $_POST['nome']);
//	$mail->AddAddress('fulano_forum@ugabuga.com.br','Fulano');
//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta

// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$msg = "
Prezado(a) ".$_POST['nome'].",
<br /><br />
Esta mensagem foi gerada automaticamente porque foi solicitado o cadastro no sistema Scala em seu nome. Para confirmar o cadastro, clique no link abaixo:
<br /><br />
http://".str_replace("cadastrar.php","index.php",$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'])."?pag=autorizar&k=".$chave_senha." 
<br /><br />
Qualquer dúvida, entre em contato com scala.ufrgs@gmail.com,
<br /><br />
Favor não responder a este email.
<br /><br />
Cordialmente,
<br />
Equipe Scala.";

$mail->Subject  = "Scalaweb - Cadastro"; // Assunto da mensagem
$mail->Body = $msg;
$mail->AltBody = $msg;

// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo


// Envia o e-mail
$enviado = $mail->Send();

// Limpa os destinatários e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();
			
echo "<script> alert('".$_str['lblSignUpSuccess']."!'); location.href='index.php'; </script>";

?>
