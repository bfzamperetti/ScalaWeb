<div class="forms_capa" style="width: 780px;">
	<div class="titulo_form" style="width: 760px;"> Autorizar Usuario. </div>
	<a href="index.php"><div class="voltar" style="top: 40px;"></div></a>
	<style>
		.autorizado{
			color: #222;
			font-size: 18px;
			margin-top: 20px;
			position: relative;
		}
		
	</style>
<?php
if ((!isset($_GET['id'])) || (!isset($_GET['k'])))
	header("Location: index.php");
if ($_GET['k'] != 'jaopijdf890uj20f98g87agh8vbano9sd8y985')
	header("Location: index.php");


include_once("../INCLUDES/conecta.php");
include("../INCLUDES/VARS_SCALA.php");

$sql = "UPDATE usuario SET autorizado = 's' WHERE id = ".$_GET['id'];
pg_query($sql);	

$sql = "SELECT * FROM usuario WHERE id = ".$_GET['id'];
$qry = pg_query($sql);
$v = pg_fetch_array($qry, NULL, PGSQL_ASSOC);

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
$mail->AddAddress($v['email'], $v['nome']);
//	$mail->AddAddress('fulano_forum@ugabuga.com.br','Fulano');
//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta

// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$msg = "Ola ".$v['nome'].",
Voce foi aceito para participar do aplicativo Scalaweb!<br /><br />
Entre no link abaixo e usufrua de todos os beneficios do nosso sistema.<br/><br />

<a href='http://scala.ufrgs.br/Scalaweb'>http://scala.ufrgs.br/Scalaweb</a>
";
$mail->Subject  = "Scalaweb - Cadastro Aceito"; // Assunto da mensagem
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
			
?>

<div class="autorizado"> Usuário autorizado com sucesso! </div>

</div>
