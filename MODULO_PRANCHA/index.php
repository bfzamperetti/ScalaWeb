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
include('verificarConfiguracoes.php'); ?>
</head>
<body onload="carregado();">
	<?php
	include('verificar_abrirArquivo.php');
	include('verificar_abrirPrancha.php');
	include('verificar_importarSom.php');
	?>	
	<?php include('../INCLUDES/preloader.php'); //pagina que aparece antes do aplicativo ser carregado completamente ?>

	<?php if ($_SESSION['estado_varredura'] == 1) { 
	echo '<div class="camada_transparente" id="camada_index" onclick="clicks();"></div>'; 
	
	}
	?>
	<div id="tudo">
       	<div id="esquerda">
        	<form id="menu_esquerda" action="index.php" method="post" name="frm_esq_itens">
					<div class="item_menu_esquerda" onclick="escolherCatImagens(1,1)" id="catPessoas"> <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico10.png" width="100%" height="100%" />  </div>
					<div class="item_menu_esquerda" onclick="escolherCatImagens(2,2)" id="catObjetos" > <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico11.png" width="100%" height="100%" />  </div>
					<div class="item_menu_esquerda" onclick="escolherCatImagens(3,3)" id="catNatureza" > <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico12.png" id="catNatureza" width="100%" height="100%" />  </div>
					<div class="item_menu_esquerda" onclick="escolherCatImagens(4,4)" id="catAcoes" > <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico13.png" id="catAcoes" width="100%" height="100%" />  </div>
					<div class="item_menu_esquerda" onclick="escolherCatImagens(5,5)" id="catAlimentos" > <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico14.png" id="catAlimentos" width="100%" height="100%" />  </div>
					<div class="item_menu_esquerda" onclick="escolherCatImagens(6,6)" id="catSentimentos" > <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico15.png" id="catSentimentos" width="100%" height="100%" />  </div>
					<div class="item_menu_esquerda" onclick="escolherCatImagens(7,7)" id="catQualidades" > <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico16.png" id="catQualidades" width="100%" height="100%" />  </div>
					<div class="item_menu_esquerda" onclick="escolherCatImagens(8,0)" id="catMinhasI" > <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico17.png" width="100%" height="100%" />  </div>
					 <?php if ($_SESSION['estado_varredura'] == 1) { 
					echo'<div class="item_menu_esquerda" id="catMenuInferior" > <img src="imagens/site/tela1/categorias_'.$_SESSION['lang'].'/ico_func.png" width="100%" height="105%"/>  </div>';
					}
					?>
					<input type="hidden" name="tipo_lista_imagens" value="0" />
			</form>
			<div id="listaimagens">
				<div id='listarImagens'>
					
				</div>
			</div>
		</div>
		<div id="superior">
            <?php include('../INCLUDES/menu_superior.php'); ?>
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
				  <a class="dock-item2" href="#"><span><?php echo $_str['lblOpen']; ?></span><img class="ico_menu_inferior" src="imagens/site/tela1/ico1.png" id="abrir" style="border: 2px solid transparent;" /></a> 
                  <?php if ($_SESSION['estado_varredura'] == 1) { ?>
				  <a class="dock-item2" href="#"><span><?php echo $_str['lblSave']; ?></span><img class="ico_menu_inferior" src="imagens/site/tela1/ico2.png" id="salvar_varredura" style="border: 2px solid transparent;" /></a>
                  <?php } else { ?>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblSave']; ?></span><img class="ico_menu_inferior" src="imagens/site/tela1/ico2.png" id="salvar" style="border: 2px solid transparent;" /></a>
                  <?php } ?>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblUndo']; ?></span><img class="ico_menu_inferior" src="imagens/site/tela1/ico19.png" id="desfaz" onclick="desfazer();" style="border: 2px solid transparent;"/></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblImport']; ?></span></span><img class="ico_menu_inferior" src="imagens/site/tela1/ico3.png" id="importar" style="border: 2px solid transparent;"/></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblExport']; ?></span><img class="ico_menu_inferior" src="imagens/site/tela1/ico4.png" id="exportar" onclick="exportarPDF('<?php echo $_str['waitForTheExport']; ?>')" style="border: 2px solid transparent;"/></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblPrint']; ?></span><img class="ico_menu_inferior" src="imagens/site/tela1/ico5.png" id="imprime" onclick="window.open('imprimir.php');" style="border: 2px solid transparent;"/></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblLayout']; ?></span><img class="ico_menu_inferior" src="imagens/site/tela1/ico6.png" id="escolher_layout" style="border: 2px solid transparent;"/></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblView']; ?></span><img class="ico_menu_inferior" src="imagens/site/tela1/ico7.png" id="visualizar" onclick="location.href='visualizar.php';" style="border: 2px solid transparent;"/></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblClean']; ?></span><img class="ico_menu_inferior" src="imagens/site/tela1/ico8.png" id="limpar" onclick="jConfirm('<?php echo $_str['sureToCleanBoards']; ?>','<?php echo $_str['lblWarning']; ?>',function(r){ if(r){ novoLayout(0) }});" style="border: 2px solid transparent;"/></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblHelp']; ?></span><img class="ico_menu_inferior" src="imagens/site/tela1/ico9.png" id="ajuda"  onclick="inTutorial('<?php echo $_SESSION['lang']; ?>')" style="border: 2px solid transparent;"/></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblExit']; ?></span><img class="ico_menu_inferior" src="imagens/site/tela1/ico18.png" id="sair" onclick="location.href = 'index.php?logout=1';" style="border: 2px solid transparent;"/></a>
                  <?php if ($_SESSION['estado_varredura'] == 0) { ?>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblScannerActivate']; ?></span><img class="ico_menu_inferior" src="imagens/site/tela1/varredura.png" id="ativar_var" onclick="ativar_varredura()" style="border: 2px solid transparent;" /></a> 
                  <?php } else { ?>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblScannerDesactivate'];?></span><img class="ico_menu_inferior" src="imagens/site/tela1/varredura.png" id="desativar_var" style="border: 2px solid transparent;"/></a>
                  <?php } ?>

                <?php if ($_SESSION['estado_varredura'] == 1) { 
                 echo' <div id="ItemMenuCategoria"><a class="dock-item2" href="#"><span>'.$_str['lblCategories'].'</span><img src="imagens/site/tela1/ico_categorias.png" id="categorias" onclick="varreduraCategorias();" style="border: 2px solid transparent;" /></a></div>';
				}
				?>
              
              </div>
            </div>
        </div>
	</div>
	
	<div id="sintetizador_de_som"></div>
	<div id="som_varredura"></div>
	
	<!-- Incluir adds -->
	<?php
	include('dialog_alterar_legenda.php'); 
	include('dialog_escolher_layout.html'); 
	include('dialog_opcoes_prancha.html'); 
	include('dialog_abrirArquivo.php');
	include('dialog_salvar.php');
	include('dialog_salvar_varredura.php');
	include('dialog_importar_imagem.php'); 
	include('dialog_upload_som.php'); 
	include('dialog_escolher_tutorial.php');
	include('verificar_importarImagem.php');
	include('dialog_configuracoes.php');
	?>
	
<script type="text/javascript">
	
	var selecaoGlobal = new varGlobal(-1000, 0); //guarda o objeto selecionado -1000 é pra nao ter incompatibilidades.
	
	function carregado(){
		setTimeout("$('#carregando').hide()",500);
		<?php	 	
				if(isset($_SESSION['estado_varredura']))
					if($_SESSION['estado_varredura'] == 1)
						if($_GET['varAtual'] == 'menu_inferior'){
						echo "
							if('".$_SESSION['cor_varredura']."' == '')
								cor = '#000';
							else
								cor = '".$_SESSION['cor_varredura']."';
				
							estadoVarreduraFunc1 = 0;
							varredura_atual = 'menu_inferior';
							IniciaVarredura(".$_SESSION['tempo_varredura'].",12);";
					    }
			?>
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
			widthItens = $('#inferior').width() / 13;
			$('#dock2').Fisheye(
				{
					maxWidth: 10,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container2',
					itemWidth: widthItens-10,
					proximity: 90,
					alignment : 'left',
					valign: 'bottom',
					halign : 'center'
				}
			)
		}
	);
	
	/* funcoes para mostrar o tutorial, no botao "ajuda" */
	function inTutorial(lang){
		var left=(screen.width-700)/2
		var top = (screen.height-500)/2
		if(lang == 'ptbr')
			window.open('../INCLUDES/Tutorial_Scala/tutorial_scala.html', '_blank', 'width=700, height=500, left='+left+', top='+top+', scrollbars=yes,titlebars=yes,toolbars=no,location=no');
		else
			if(lang == 'es')
				window.open('../INCLUDES/Tutorial_Scala/tutorial_scala_espanhol.html', '_blank', 'width=700, height=500, left='+left+', top='+top+', scrollbars=yes,titlebars=yes,toolbars=no,location=no');
			
	}
	
	/* funcoes para mostrar os creditos, no botao "creditos" */
	function inCreditos(){
		var left=(screen.width-700)/2
		var top = (screen.height-500)/2
		window.open('../INCLUDES/Creditos_Scala/creditos_Scala.html', '_blank', 'width=700, height=500, left='+left+', top='+top+', scrollbars=yes,titlebars=yes,toolbars=no,location=no');
	}
	
		
</script>
<?php
	include('verificaSelecaoImagemVarredura.php');
?>
</body>
</html>
