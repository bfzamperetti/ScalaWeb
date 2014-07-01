<?php
session_start();

if (isset($_GET['id'])) $_SESSION['quadrinho_atual'] = $_GET['id'];

/* incluir paginas necessarias (nao mudar a ordem) */
include('../INCLUDES/verificar_se_esta_logado.php');
include('../INCLUDES/uses.php');
include('../INCLUDES/conecta.php');


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ScalaWeb</title>
<?php 
include_once('../INCLUDES/cabecalhos.php'); 
include('../INCLUDES/strings.php');
?>	
<script>
function atalhos(event)
{
	var key = event.keyCode || event.which;
	switch (key){
		case 13 : concluirQuadrinho(); break;   //ENTER 
		case 27 : jConfirm('<?php echo $_str['lblSureYouWantToLeaveWithoutSave']; ?>?','<?php echo $_str['lblWarning']; ?>',function(r){ if(r){ cancelarQuadrinho(); }}); break; // ESCAPE
	}
	if (selecaoGlobal.tipo != 2) return;
	switch (key){
		case 46 : excluirImgQuad(); break;   //DELETE 
		case 38 : altLugarImgQuad(0,-2); break; // SETA CIMA
		case 40 : altLugarImgQuad(0,2); break; // SETA BAIXO
		case 37 : altLugarImgQuad(-2,0); break; // SETA ESQUERDA
		case 39 : altLugarImgQuad(2,0); break; // SETA DIREITA
	}
}
</script>
</head>
<body onload="carregado();" onkeyup="atalhos(event)">
	<?php include('../INCLUDES/preloader.php'); //pagina que aparece antes do aplicativo ser carregado completamente ?>
	<div id="tudo">
       	<div id="esquerda_quadrinho">
        	<form id="menu_esquerda"  action="index.php" method="post" name="frm_esq_itens">
				<div class="item_menu_esquerda" onclick="mostrarListaTextos(9)" > <img src="imagens/site/mn_sandwich.png" width="100%" height="100%" />  </div>
				<div class="item_menu_esquerda" onclick="escolherCatImagensHist(1,1)" > <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico10.png" width="100%" height="100%" />  </div>
				<div class="item_menu_esquerda" onclick="escolherCatImagensHist(2,2)" > <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico11.png" width="100%" height="100%" />  </div>
				<div class="item_menu_esquerda" onclick="escolherCatImagensHist(3,3)" > <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico12.png" width="100%" height="100%" />  </div>
				<div class="item_menu_esquerda" onclick="escolherCatImagensHist(4,4)" > <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico13.png" width="100%" height="100%" />  </div>
				<div class="item_menu_esquerda" onclick="escolherCatImagensHist(5,5)" > <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico14.png" width="100%" height="100%" />  </div>
				<div class="item_menu_esquerda" onclick="escolherCatImagensHist(6,6)" > <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico15.png" width="100%" height="100%" />  </div>
				<div class="item_menu_esquerda" onclick="escolherCatImagensHist(7,7)" > <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico16.png" width="100%" height="100%" />  </div>
				<div class="item_menu_esquerda" onclick="escolherCatImagensHist(8,0)" > <img src="imagens/site/tela1/categorias_<?php echo $_SESSION['lang']; ?>/ico17.png" width="100%" height="100%" />  </div>
				<input type="hidden" name="tipo_lista_imagens" value="0" />
			</form>
			<div id="listaimagens">
				<div id='listarImagens'>
					
				</div>
			</div>
		</div>
		<div id="superior_quadrinho">
            <a href="http://scala.ufrgs.br" target="_blank">
				<img class="logo_escala" src="imagens/site/tela1/logo_scala.png" height="80%" />
			</a>
        </div>
        <div id="centro_quadrinho">
			<?php include('quadrinho_editavel.php');?>
        </div>
        <div id="inferior_quadrinho">
   			<img src="imagens/site/tela1/fundo_inferior.png" width="100%" height="100%" id="inferior_bg" />
            <div class="dock" id="dock2">
              <div class="dock-container2">
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblConclude']; ?></span><img src="imagens/site/tela1/concluir.png" onclick="concluirQuadrinho();" /></a> 
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblCancel']; ?></span><img src="imagens/site/ico2.png" onclick="jConfirm('Tem certeza que deseja sair sem salvar?','Aviso',function(r){ if(r){ cancelarQuadrinho(); }});" /></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblUndo']; ?></span><img src="imagens/site/tela1/ico19.png" onclick="desfazerQuadrinho();"/></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblClean']; ?></span><img src="imagens/site/tela1/ico8.png" onclick="limparQuadrinho();"  /></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblScenario']; ?></span><img src="imagens/site/colorpicker.png" id="cenario"  /></a>
                  <a class="dock-item2" href="#"><span><?php echo $_str['lblPlay']; ?></span><img src="imagens/site/ico3.png" onclick="sintetizarNarracao();"  /></a>
				  <a class="dock-item2" href="#"><span><?php echo $_str['lblImport']; ?></span><img src="imagens/site/tela1/ico3.png" id="importar" /></a>
                  <a class="dock-item2" style="display:none;" id="textoquad" href="#"><span><?php echo $_str['lblText']; ?></span><img src="imagens/site/texto.png" onclick="montarAlterarTextoBalao();"  /></a>
				  <a class="dock-item2" style="display:none;" id="aumentaquad" href="#"><span><?php echo $_str['lblIncrease']; ?></span><img src="imagens/site/aumenta.png" onclick="ampliarEReduzir(1.2);"  /></a>
                  <a class="dock-item2" style="display:none;" id="diminuiquad" href="#"><span><?php echo $_str['lblDecrease']; ?></span><img src="imagens/site/diminui.png" onclick="ampliarEReduzir(0.8);"  /></a>
				  <a class="dock-item2" style="display:none;" id="frentequad" href="#"><span><?php echo $_str['lblFront']; ?></span><img src="imagens/site/frente.png" onclick="mudarProf(1);"  /></a>
				  <a class="dock-item2" style="display:none;" id="atrasquad" href="#"><span><?php echo $_str['lblBack']; ?></span><img src="imagens/site/atras.png" onclick="mudarProf(-1);"  /></a>
				  <a class="dock-item2" style="display:none;" id="girarquad" href="#"><span><?php echo $_str['lblTwist']; ?></span><img src="imagens/site/girar.png" onclick="mudarAngulo(90);"  /></a>
				  <a class="dock-item2" style="display:none;" id="inverterquad" href="#"><span><?php echo $_str['lblInvert']; ?></span><img src="imagens/site/inverter.png" onclick="inverter();"  /></a>
				  <a class="dock-item2" style="display:none;" id="excluirquad" href="#"><span><?php echo $_str['lblExclude']; ?></span><img src="imagens/site/tela1/ico8.png" onclick="excluirImgQuad();"  /></a>
              </div>
            </div>
        </div>
	</div>
	<div id="sintetizador_de_som"></div>
	
	<!-- Incluir adds -->
	<?php 
	include('dialog_cenario.php'); 
	include('dialog_escolher_cor_cenario.php'); 
	include('dialog_escolher_imagem_cenario.php'); 
	include('dialog_importar_imagem.php');
	include('verificar_importarImagem.php');
	?>
<script type="text/javascript">
	var mouseX;
	var mouseY;
	var AjaxReqParaMover;
	var imgQuadAnt = 0;
	var TempoUltimoClick = new Date().getTime();
	var selecaoGlobal = new varGlobal(-1000, 0); //guarda o objeto selecionado -1000 é pra nao ter incompatibilidades.
	var permissao_para_selecionar = true; //permissão para selecionar e manipular os objetos
	
	function redimensionarQuadrinho(){
		<?php echo "location.href='quadrinho.php?id=".$_SESSION['quadrinho_atual']."&qdr=".$_SESSION['hist_quadro_atual']."';" ?> 
	}
	
	function ExtractNumber(value) { 
		var n = parseInt(value); 
		return n == null || isNaN(n) ? 0 : n; 
	} 
		
	jQuery(document).ready(function(){
		
		var _startX = 0; 
		var _startY = 0; 
		var _offsetX = 0; 
		var _offsetY = 0; 
		var _dragElement; 
		var _oldZIndex = 0; 
		
		document.getElementById("tela_quadrinho").onmousedown = OnMouseDown;
		document.getElementById("tela_quadrinho").onmouseup = OnMouseUp;
				
		function OnMouseMove(e){
			if (e == null) var e = window.event; 
			var mouseX =  parseInt(100 * (e.pageX - $('#tela_quadrinho').offset().left)/$('#tela_quadrinho').width());
			var mouseY =  parseInt(100 * (e.pageY - $('#tela_quadrinho').offset().top)/$('#tela_quadrinho').height());
	
			_dragElement.style.left = (mouseX - parseInt(_offsetX)) + '%'; 
			_dragElement.style.top = (mouseY - parseInt(_offsetY)) + '%'; 
		}
			
		function OnMouseDown(e){
			
			 if (e == null) e = window.event; // IE uses srcElement, others use target 
			 var target = e.target != null ? e.target : e.srcElement; 
			 if ((target.id == "") && (selecaoGlobal.tipo != 1)){
				zerarSelecaoHist();
				return;
			 } 
			 target = document.getElementById("imgQuad"+target.id.replace(/[^-\d\.]/g, ''));
			 if ( (e.button == 1 && window.event != null) || e.button == 0) {
				 
				 var mouseX =  parseInt(100 * (e.pageX - $('#tela_quadrinho').offset().left)/$('#tela_quadrinho').width());
				 var mouseY =  parseInt(100 * (e.pageY - $('#tela_quadrinho').offset().top)/$('#tela_quadrinho').height());
				
				 _offsetX = mouseX - target.style.left.replace(/[^-\d\.]/g, ''); 
				 _offsetY = mouseY - target.style.top.replace(/[^-\d\.]/g, ''); 

				 if (selecaoGlobal.tipo != 1){
					selecionarHist(target.id.replace(/[^-\d\.]/g, ''), 3);
				 }
			
				 // we need to access the element in OnMouseMove 
				 _dragElement = target; 
				 
				 // tell our code to start moving the element with the mouse 
				 document.getElementById("tela_quadrinho").onmousemove = OnMouseMove; 
				 
				 // cancel out any text selections 
				 document.body.focus(); 
				 
				 // prevent text selection in IE 
				 document.onselectstart = function () { return false; }; 
				 
				 // prevent IE from trying to drag an image 
				 target.ondragstart = function() { return false; }; 
				 
				 // prevent text selection (except IE) 
				 return false;
			
			}
		}
		
		function OnMouseUp(e){
			var mouseX =  parseInt(100 * (e.pageX - $('#tela_quadrinho').offset().left)/$('#tela_quadrinho').width());
			var mouseY =  parseInt(100 * (e.pageY - $('#tela_quadrinho').offset().top)/$('#tela_quadrinho').height());
			
			if ((selecaoGlobal.tipo == 1) && (selecaoGlobal.id != -1000)){ // se for imagem da lista
				insereImagemQuadrinho(mouseX,mouseY);
			}			
			else if (_dragElement != null) { 
				if ((selecaoGlobal.tipo == 3) && (selecaoGlobal.id != -1000)){
					selecionarHist(selecaoGlobal.id, 2);
					trocaLugarImagemQuadrinho(mouseX - parseInt(_offsetX),mouseY - parseInt(_offsetY));
				}
				
				_dragElement.style.zIndex = _oldZIndex; 
				
				// we're done with these events until the next OnMouseDown 
				document.onmousemove = null; 
				document.onselectstart = null; 
				_dragElement.ondragstart = null; 
				
				// this is how we know we're not dragging 
				_dragElement = null;  
			}
		}
	});
	
	function carregado(){
		setTimeout("$('#carregando').hide()",500);
	}

	
	// barras de menu superior e inferior:	
	$(document).ready(
		function()
		{
			var widthItens = $('#inferior_quadrinho').width() / 14;
			window.onresize = redimensionarQuadrinho;
			$('#dock2').Fisheye(
				{
					maxWidth: 10,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container2',
					itemWidth: widthItens-10,
					proximity: 90,
					halign : 'left'
				}
			)
		}
	);

</script>	
</body>
</html>
