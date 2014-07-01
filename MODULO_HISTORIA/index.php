<?php
session_start();
/* incluir paginas necessarias (nao mudar a ordem) */
include('../INCLUDES/verificar_se_esta_logado.php');
include('../INCLUDES/uses.php');
include('verificar_logout.php');
include('../INCLUDES/conecta.php');
include('inicializar_variaveis.php');
include('stylesThatNeedLanguageSpecification.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ScalaWeb</title>
<?php 
include_once('../INCLUDES/cabecalhos.php'); 
include('../INCLUDES/strings.php');
?>	

</head>
<body onload="carregado();">
	<?php
	include('verificar_abrirArquivo.php');
	include('verificar_abrirHist.php');
	?>
	<?php include('../INCLUDES/preloader.php'); //pagina que aparece antes do aplicativo ser carregado completamente ?>
	<div id="tudo">
       	<div id="superior">
            <?php include('../INCLUDES/menu_superior_historia.php'); ?>
            <a href="http://scala.ufrgs.br" target="_blank">
				<img class="logo_escala" src="imagens/site/tela1/logo_scala.png" height="80%" />
			</a>
        </div>
        <div id="centro" class="centro">
			<?php include('desenha_layout.php'); ?>
        </div>
        <div id="inferior">
   			<img src="imagens/site/tela1/fundo_inferior.png" width="100%" height="100%" id="inferior_bg" />
            <div class="dock" id="dock2">
              <div class="dock-container2">
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblOpen']; ?></span><img src="imagens/site/tela1/ico1.png" id="abrir" /></a> 
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblSave']; ?></span><img src="imagens/site/tela1/ico2.png" id="salvar" /></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblExport']; ?></span><img src="imagens/site/tela1/ico4.png" onclick="exportarPDF_hist()" /></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblPrint']; ?></span><img src="imagens/site/tela1/ico5.png" onclick="window.open('imprimir.php');" /></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblLayout']; ?></span><img src="imagens/site/tela1/ico6.png" id="escolher_layout"/></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblView']; ?></span><img src="imagens/site/tela1/ico7.png" onclick="location.href='visualizar.php';"/></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblClean']; ?></span><img src="imagens/site/tela1/ico8.png" onclick="jConfirm('Tem certeza que deseja apagar todos os quadrinhos?','Aviso', function(r){ if (r){ novoLayout(0); }});" /></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblHelp']; ?></span><img src="imagens/site/tela1/ico9.png" onclick="inTutorial()"/></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblExit']; ?></span><img src="imagens/site/tela1/ico18.png" onclick="location.href = 'index.php?logout=1';" /></a>
              </div>
            </div>
        </div>
	</div>
	
	<div id="sintetizador_de_som"></div>
	
	<!-- Incluir adds -->
	<?php 
	include('dialog_escolher_layout.html'); 
	include('dialog_salvar.php');
	include('dialog_abrirArquivo.php');
	include('dialog_visualizar.php');
	?>
	
<script type="text/javascript">
	
	
	var selecaoGlobal = new varGlobal(-1000, 0); //guarda o objeto selecionado -1000 é pra nao tem incompatibilidades.
	
	function carregado(){
		setTimeout("$('#carregando').hide()",500);
	}
	
	
	// barras de menu superior e inferior:	
	$(document).ready(
		function()
		{
			var widthItens = 150;
			if ($('#superior').width() / 5 < widthItens) widthItem = $('#superior').width() / 5;
			window.onresize = redimensionar;
			$('#dock').Fisheye(
				{
					maxWidth: 10,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container',
					itemWidth: widthItens-10,
					proximity: 90,
					halign : 'center'
				}
			)
			widthItens = 100;
			if ($('#inferior').width() / 5 < widthItens) widthItem = $('#inferior').width() / 9;
			$('#dock2').Fisheye(
				{
					maxWidth: 10,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container2',
					itemWidth: widthItens-10,
					proximity: 80,
					alignment : 'left',
					valign: 'bottom',
					halign : 'center'
				}
			)
		}
	);
	
	/* funcoes para mostrar o tutorial, no botao "ajuda" */
	function inTutorial(){
		var left=(screen.width-700)/2
		var top = (screen.height-500)/2
		<?php if($_SESSION['lang']=='ptbr'){ ?>
		window.open('../INCLUDES/Tutorial_Historia/tutorial_historia.html', '_blank', 'width=700, height=500, left='+left+', top='+top+', scrollbars=yes,titlebars=yes,toolbars=no,location=no');
		<?php } else if($_SESSION['lang']=='es'){ ?>
		window.open('../INCLUDES/Tutorial_Historia/tutorial_historia_espanhol.html', '_blank', 'width=700, height=500, left='+left+', top='+top+', scrollbars=yes,titlebars=yes,toolbars=no,location=no');
		<?php } else { ?>
		window.open('../INCLUDES/Tutorial_Historia/tutorial_historia.html', '_blank', 'width=700, height=500, left='+left+', top='+top+', scrollbars=yes,titlebars=yes,toolbars=no,location=no');
		<?php } ?>
	}
	
	/* funcoes para mostrar os creditos, no botao "creditos" */
	function inCreditos(){
		var left=(screen.width-700)/2
		var top = (screen.height-500)/2
		window.open('../INCLUDES/Creditos_Scala/creditos_Scala.html', '_blank', 'width=700, height=500, left='+left+', top='+top+', scrollbars=yes,titlebars=yes,toolbars=no,location=no');
	}

</script>	
</body>
</html>
