<div class="forms_capa" style="width: 780px;">
	<div class="titulo_form" style="width: 760px;"> Recupere seus dados em um clique. </div>
	<a href="index.php"><div class="voltar" style="top: 40px;"></div></a>
 
<?php
if (isset($_POST['rec_email'])){
// Get a key from https://www.google.com/recaptcha/admin/create
//	$publickey = "6Lez3dESAAAAAI_JTR1qE1ZLQGOEcYIjMlFRYLie";
	$privatekey = "6Ld359ESAAAAABumVMvaNwvFhqeGRYMLsOXC8Vmy";
 
	include_once('../INCLUDES/recaptchalib.php');
 
	$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

	if (!$resp->is_valid) {
		header("Location: index.php?pag=esqueci_dados&captcha=0&email=".$_POST['email']."&user=".$_POST['user']);
		exit;
	}
	else
	{
		$link = "";
		$erro = true;
		include('../INCLUDES/conecta.php');
		include('../INCLUDES/VARS_SCALA.php');
	  
		if ($_POST['user'] != ""){
			$sql = "SELECT * FROM usuario WHERE login = '".$_POST['user']."'";
			$qry = pg_query($sql);
			if($v = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
				$link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?pag=recuperar_senha&k=".$v['chave_senha'];	
				$destinatario = $v['email'];
				$erro = false;
			}  
		}
		if ($_POST['email'] != ""){
			$sql = "SELECT * FROM usuario WHERE email = '".$_POST['email']."'";
			$qry = pg_query($sql);
			if($v = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
				$link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?pag=recuperar_senha&k=".$v['chave_senha'];	
				$destinatario = $v['email'];
				$erro = false;
			}  
		}
		if ($erro){
			echo '<div class="quadro">
		        <img style="left:50%; position: relative; margin-left:-100px;" src="imagens/site/logo_scala.png" width="200px" /> <br /><br />
				O Usuário ou o Email Informado estão incorretos, Tente Novamente.
				</div>';
		}
		else
		{
			$msg = 'Ola '.$v['nome'].',
			
Acesse o link para recuperar seus dados no aplicativo Scalaweb: '.$link.'
			
Acesse o nosso site! http://scala.ufrgs.br/Scalaweb 
			
			'; 
			 
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
			$mail->AddAddress($destinatario, 'Usuário');
		//	$mail->AddAddress('fulano_forum@ugabuga.com.br','Fulano');

			//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
			//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta

			// Define os dados técnicos da Mensagem
			// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
			$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
			//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)

			// Define a mensagem (Texto e Assunto)
			// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
			$mail->Subject  = "Scalaweb - Recuperar seus dados"; // Assunto da mensagem
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

			// Exibe uma mensagem de resultado
			if ($enviado) {
				echo '<div class="quadro">
					<img style="left:50%; position: relative; margin-left:-100px;" src="imagens/site/logo_scala.png" width="200px" /> <br /><br />
					 Em poucos segundos você receberá um email com o link para visualizar seus dados! Aguarde.
					</div>';

			} else {
			echo "Não foi possível enviar o e-mail.<br /><br />";
			echo "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo;
			}
		}
	}
}
else
{ 
?>
  <script>
   var RecaptchaOptions = {
    theme : 'white'
	};
	</script>
	<style type="text/css">
		.text1{ clear: both; font-size: 14px; padding: 5px;  }
		.text2{ clear: both; font-size: 15px; font-weight: bold; }
		.text3{ color: #333; clear: both; font-size: 12px; font-weight: bold; margin: 10px;  }
	</style>
	
	 <form method="post" style="padding: 10px;" action="index.php?pag=esqueci_dados">

		
		<div class="text1">
			Digite seu Usuario: 
			<input type="text" value="<?php if (isset($_GET['user'])) echo $_GET['user']; ?>" name="user" /> <br />
		</div>
		<div class="text2">
				OU <br />
		</div>
		<div class="text1" style="border-bottom: 1px dashed #ccc; margin-bottom: 10px;">
			Digite o e-mail de sua conta: 
		 <input type="text" value="<?php if (isset($_GET['email'])) echo $_GET['email']; ?>" name="email" /> <br />
		</div>
		<div style="width: 360px; left: 50%; margin-left: -180px; position: relative;">
				<?php if (isset($_GET['captcha'])) 
				echo "<div style='padding: 5px; border: 1px solid #770000; background: #ffaaaa;'> Palavras incorretas, tente novamente </div> "; ?>
        <?php
          require_once('../INCLUDES/recaptchalib.php');
          $publickey = "6Ld359ESAAAAAFabo-PL-TWAev3fgVvJ32lsdO9N"; // you got this from the signup page
          echo recaptcha_get_html($publickey);
        ?>
        
        <div class="text3">
			Você receberá um e-mail com o link para visualizar seus dados!  <br />
		</div>
		
        
        <input type="submit" name="rec_email" value="Enviar Email"style="width: 100px; left: 50%; margin-left: -50px; position: relative;" />
        </div>
      </form>

<?php } ?>

</div>
