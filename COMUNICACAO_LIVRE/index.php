<?php
session_start();
/* incluir paginas necessarias (nao mudar a ordem) */
include('../INCLUDES/verificar_se_esta_logado.php');
include('verifica_se_online.php');
include('../INCLUDES/uses.php');
include('verificar_logout.php');
include('../INCLUDES/conecta.php');
include('inicializar_variaveis.php');
include('verificar_abrirArquivo.php');
include('verificar_importarImagem.php');
include('verificar_importarSom.php');
include('../INCLUDES/conecta.php');

?>
<?php
/* Seta usuario como online */
$logadid = $_SESSION['id'];
$sql = "UPDATE usuario set chat_status = '1' where id= '".$logadid."'";
$qery = pg_query($sql) or die ("erro");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ScalaWeb</title>
<link rel="stylesheet" title="classic" type="text/css" href="style/generic.css" />
  <link rel="stylesheet" title="classic" type="text/css" href="style/header.css" />
  <link rel="stylesheet" title="classic" type="text/css" href="style/footer.css" />
  <link rel="stylesheet" title="classic" type="text/css" href="style/menu.css" />
  <link rel="stylesheet" title="classic" type="text/css" href="style/content.css" />
  <link href="styles/geral.css" rel="stylesheet" type="text/css">
  <!-- Sintetizador -->
 <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script> -->
	<script type="text/javascript" src="../INCLUDES/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="../INCLUDES/js/jPlayer/jquery.jplayer.min.js"></script>
	<!-- Fim Sintetizador -->

<?php include_once('../INCLUDES/cabecalhos.php'); ?>

<!-- SCRIPTS AQUI, DEPOIS VOU TIRAR -->
<script type="text/javascript" language="javascript">
	function carregado(){
		document.frm_esq_itens.tipo_lista_imagens.value = '0';
		zerarSelecao();
		buscarImgs(1000);
		setTimeout("$('#carregando').hide()",500);
	}
    function envia(){
		document.frm_escrever.escrever.value = document.getElementById('chat_mensagem').innerHTML;
		document.frm_escrever.submit();
	}
	function appendImg(obj){
		window.alert(obj);
	}
	function som(){
			setTimeout(function(){
				document.getElementById('sintetizador_de_som').innerHTML = '<iframe src="musicPlayer.php" style="display:block; border:0; position: absolute;"></iframe>';
			},3000);
		
	}
	$(function($) {
		$("#frm_escrever").submit(function() {
			var mensagem = $("#escrever").val();
			$.post('envia_mensagem.php', {mensagem: mensagem }, function(resposta) {
					$("#escrever").val("");
			});
		});
	});
	
	$(function($) {
		$("#frm_escrever").submit(function() {
			var mensagem = $("#escrever").val();
			$.post('sintetizar_som_chat.php', {mensagem: mensagem });
		});
	});
	
	
	function limpa(){
	
		document.getElementById("chat_mensagem").innerHTML=""; 

	};

	setInterval(function() {
	$("#chat_frases_montadas").load("mostra_frases_montadas.php");
	}, 1000);
</script>



</head>
<body onload="carregado();">
	<?php include('../INCLUDES/preloader.php'); //pagina que aparece antes do aplicativo ser carregado completamente ?>
	<div id="tudo">
       	<div id="esquerda">
        	<div id="menu_esquerda" />
				<form action="index.php" method="post" name="frm_esq_itens">
					<div class="item_menu_esquerda" onclick="escolherCatImagens(1,1)" > <img src="imagens/site/tela1/ico10.png" width="100%" height="100%" />  </div>
					<div class="item_menu_esquerda" onclick="escolherCatImagens(2,2)" > <img src="imagens/site/tela1/ico11.png" width="100%" height="100%" />  </div>
					<div class="item_menu_esquerda" onclick="escolherCatImagens(3,3)" > <img src="imagens/site/tela1/ico12.png" width="100%" height="100%" />  </div>
					<div class="item_menu_esquerda" onclick="escolherCatImagens(4,4)" > <img src="imagens/site/tela1/ico13.png" width="100%" height="100%" />  </div>
					<div class="item_menu_esquerda" onclick="escolherCatImagens(5,5)" > <img src="imagens/site/tela1/ico14.png" width="100%" height="100%" />  </div>
					<div class="item_menu_esquerda" onclick="escolherCatImagens(6,6)" > <img src="imagens/site/tela1/ico15.png" width="100%" height="100%" />  </div>
					<div class="item_menu_esquerda" onclick="escolherCatImagens(7,7)" > <img src="imagens/site/tela1/ico16.png" width="100%" height="100%" />  </div>
					<div class="item_menu_esquerda" onclick="escolherCatImagens(8,0)" > <img src="imagens/site/tela1/ico17.png" width="100%" height="100%" />  </div>
					<div class="item_menu_esquerda" onclick="escolherCatImagens(8,0)" > <img src="imagens/site/tela1/ico17.png" width="100%" height="100%" />  </div>

					<input type="hidden" name="tipo_lista_imagens" value="1" />
				</form>
			</div>
			<div id="listaimagens">
				<div id='listarImagens' class='scroll-pane' onload="fechar_tela_carregar_ajax()">
					<?php if (($_SESSION['busca_imgs_atual'] != 1000) && ($_SESSION['busca_imgs_atual'] != 0)){
							$_GET['cat'] = $_SESSION['busca_imgs_atual'];
							include("desenha_lista_imagens.php");
						}
						else
						{
							$_GET['cat']= 1;
							include("desenha_lista_imagens.php");
						}
					?>
				</div>
			</div>
		</div>
		<div id="superior">
            <?php include('../INCLUDES/menu_superior.php'); ?>
            <a href="http://scala.ufrgs.br" target="_blank">
				<img class="logo_escala" src="imagens/site/tela1/logo_scala.png" height="80%" />
			</a>
        </div>
        <div id="centro">
			<?php include 'chat.php'?>
        </div>


        <div id="inferior">
   			<img src="imagens/site/tela1/fundo_inferior.png" width="100%" height="100%" id="inferior_bg" />
            <div class="dock" id="dock2">
              <div class="dock-container2">
                  <a class="dock-item2" href="#"><span>Importar</span><img src="imagens/site/tela1/ico3.png" id="importar" /></a>
                  <a class="dock-item2" href="#"><span>Imprimir</span><img src="imagens/site/tela1/ico5.png" onclick="window.open('imprimir.php');" /></a>
                  <a class="dock-item2" href="#"><span>Limpar</span><img src="imagens/site/tela1/ico8.png" onclick="if (confirm('Tem certeza que deseja apagar todas as pranchas?')) novoLayout(0);" /></a>
                  <a class="dock-item2" href="#"><span>Visualizar</span><img src="imagens/site/tela1/ico7.png" id="visualizar"/></a>
                  <a class="dock-item2" href="#"><span>Ajuda</span><img src="imagens/site/tela1/ico9.png" onclick="inTutorial()"/></a>
                  <a class="dock-item2" href="#"><span>Sair</span><img src="imagens/site/tela1/ico18.png" onclick="location.href = 'index.php?logout=1';" /></a>
              </div>
            </div>
        </div>
	</div>

	<div id="sintetizador_de_som"></div>

	<div id="tutorial" style="position: absolute; width: 99%; height: 99%;">
		<div onclick="outTutorial()" class="voltar"></div>
		<iframe src="../INCLUDES/Tutorial_Scala/tutorial_scala.html" width="100%" height="100%"></iframe>
	</div>

	<div id="creditos" style="position: absolute; width: 99%; height: 99%;">
		<div onclick="outCreditos()" class="voltar"></div>
		<iframe src="../INCLUDES/Creditos_Scala/creditos_Scala.html" width="100%" height="100%"></iframe>
	</div>

	<!-- Incluir adds -->
	<?php
	include('dialog_alterar_legenda.php');
	include('dialog_opcoes_prancha.html');
	include('dialog_importar_imagem.php'); 
	include('dialog_visualizar.php');
	include('dialog_abrirArquivo.php');
	include('dialog_salvar.php');
	include('dialog_upload_som.php');
	?>

<script type="text/javascript">
	var selecaoGlobal = new varGlobal(-1000, 0); //guarda o objeto selecionado -1000 é pra nao ter incompatibilidades.
	function carregado(){
		document.frm_esq_itens.tipo_lista_imagens.value = '0';
		zerarSelecao();
		buscarImgs(1000);
		setTimeout("$('#carregando').hide()",500);
	}
	// barras de menu superior e inferior:
	$(document).ready(
		function()
		{
			window.onresize = redimensionar;
			$('#dock').Fisheye(
				{
					maxWidth: 10,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container',
					itemWidth: 130,
					proximity: 90,
					halign : 'center'
				}
			)
			$('#dock2').Fisheye(
				{
					maxWidth: 10,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container2',
					itemWidth: 80,
					proximity: 80,
					alignment : 'left',
					valign: 'bottom',
					halign : 'center'
				}
			)
		}
	);

	/* funcoes para mostrar o tutorial, no botao "ajuda" */
	$('#tutorial').hide();
	function inTutorial(){
		$('#tudo').fadeOut();
		$('#tutorial').fadeIn();
		zerarSelecao();
	}
	function outTutorial(){
		<?php if(isset($_SESSION['id'])){ //se está logado ?>
		$('#tudo').fadeIn('slow');
		$('#tutorial').fadeOut('slow');
		<?php }else{ ?>
		location.href='index.php';
		<?php } ?>
	}

	/* funcoes para mostrar os creditos, no botao "creditos" */
	$('#creditos').hide();
	function inCreditos(){
		$('#tudo').fadeOut();
		$('#creditos').fadeIn();
		zerarSelecao();
	}
	function outCreditos(){
		$('#tudo').fadeIn('slow');
		$('#creditos').fadeOut('slow');
	}

	/* funcoes para executar a busca de imagens e criar o scroll estilizado da lista */
	var api = $('.scroll-pane').jScrollPane(
		{
			maintainPosition: false,
			reinitialiseOnImageLoad: true,
			autoReinitialise: true,
			showArrows:true
		}
	).data('jsp');

	function buscarImgs(cat)
	{
		api.getContentPane().load(
			'desenha_lista_imagens.php?cat='+cat,
			function()
			{
				api.reinitialise();
			}
		);
		return true;
	}

</script>

</body>
</html>
