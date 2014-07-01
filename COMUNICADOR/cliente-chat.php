<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Chat Pictográfico</title>
<link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="socket.io.min.js"></script>
<script type="application/javascript">

function SelecionarImagem(clicked_src,nome)
{		
		 $('#texto-chat').focus();
		
		var img = document.createElement('img');
		img.src = clicked_src;
		img.style.width="80px";
		img.style.height="80px";

		$('#texto-chat').append('<div contenteditable="false" style="text-align:center; padding-right: 20px; font-size: 26px; display: inline-block;"><p contenteditable="false">'+nome+'</p></div>');
		 $('#texto-chat p').last().before(img);
		
}



(function ($) {

	
		
	
	function montarListaUsuarios(usuarios,avatares) 
	{
		var lista = $("#usuarios");
		
		var itens = "";
		for (var i in usuarios) {
			itens = itens + "<li id=\"usuario_" + usuarios[i] + "\">  ";
			itens=itens + "<img style='max-width:100%;'  src='" + avatares[i] + "'>";
			itens=itens + " <p style='margin-bottom:0px;filter:alpha(opacity=40);'> " + usuarios[i] +" </p>";
			itens=itens + " </li>";
		}
		lista.empty().html(itens);
		

	}
	
	function adicionarLinha(tipo, texto) {
		$("#chat").append("<div class=\"linha " + tipo + "\">" + texto + "</div>");
		$("#chat").scrollTop(1000000);
	}
	
	$(function () {
		
		jQuery(document).mouseup(function(e){ 
			var popocontainer = jQuery(".popover");
			if (popocontainer.has(e.target).length === 0){
				jQuery('.popover').toggleClass('in').remove();
			}
		});
		
		
		$("#pessoas").popover({
			html:true,
			content:function(){
				return $('#popover-pes').html();
			}
		});
		
		$("#objetos").popover({
			html:true,
			content:function(){
				return $('#popover-obj').html();
			}
		});

		$("#natureza").popover({
			html:true,
			content:function(){
				return $('#popover-nat').html();
			}
		});
		
		$("#acoes").popover({
			html:true,
			content:function(){
				return $('#popover-ac').html();
			}
		});
		
		$("#alimentos").popover({
			html:true,
			content:function(){
				return $('#popover-ali').html();
			}
		});
		
		$("#sentimentos").popover({
			html:true,
			content:function(){
				return $('#popover-sen').html();
			}
		});

		$("#qualidades").popover({
			html:true,
			content:function(){
				return $('#popover-qual').html();
			}
		});		

		$("#minhas_imagens").popover({
			html:true,
			content:function(){
				return $('#popover-img').html();
			}
		});

		
		
		
		
		// Inicializa conexão com o servidor
		//var socket = io.connect("http://localhost:3000");
		var socket = io.connect("http://scala.ufrgs.br:3000");
		var iniciado = false;
		
		// Primeira mensagem enviada pelo servidor (assim que a conexão é feita)
		socket.on("ok", function (data) {
			// 1a vez que recebemos OK?
			if (!iniciado) {
				iniciado = true;
				 socket.emit("get user_chat");
			}
			// Se não for, isso significa que por algum motivo caímos e voltamos ao servidor!
			else {
				// Já haviamos entrado em um canal? Se sim, voltamos a ele.
				if (socket.canal) {
					socket.emit("entrar", { nome: socket.nome, sala: socket.canal });
				}
				// Se não, mostramos a tela para digitar o canal novamente
				else {
					 socket.emit("get user_chat");
				}
			}
		});
		
		// Quando o servidor avisar que alguém entrou em um canal
		socket.on("entrou", function (data) {
			if (data.cliente == socket.nome) {
				adicionarLinha("especial entrou", "<strong>Você</strong> entrou na conversa.");
			}
			else {
				adicionarLinha("especial entrou", "<strong>" + data.cliente + "</strong> entrou na conversa.");
			}
			montarListaUsuarios(data.usuarios, data.avatares);
		});
		
		// Quando o servidor avisar que alguém saiu de um canal
		socket.on("partiu", function (data) {
			adicionarLinha("especial saiu", "<strong>" + data.cliente + "</strong> saiu do canal. Motivo: <em>" + data.motivo + "</em>");
			montarListaUsuarios(data.usuarios, data.avatares);
		});
		
		// Quando alguém fala algo no chat
		socket.on("falando", function (data) {
			adicionarLinha("eu", "&lt; <img style='max-width:100%;'  src='" + data.avatar + "'>  &gt;  <p style='margin-bottom:0px;filter:alpha(opacity=40);font-size:26px;'> " + data.cliente +" </p> </div> <div style='min-height: 120px;font-size:26px;'> " + data.texto +" </div> " );
			
		});
		
		// Quando alguém manda uma mensagem privada
		socket.on("falandoPrivado", function (data) {
			adicionarLinha("chat private", "<strong>&lt;" + data.cliente + "&gt;</strong> <em>[privado]</em> " + data.texto);
		});
		
		socket.on("dados_usuario", function (data) {
			// console.log("DADOS RECEBIDOS", data);
			socket.nome = data.dados.nome_usuario;
			socket.canal = data.dados.sala;
			// console.log(socket.canal);
			socket.emit("entrar", { nome: data.dados.nome_usuario, sala: data.dados.sala, avatar: data.dados.avatar_usuario });
		
		});
		
		$(".botaoApagar").click(function (event) {
			event.preventDefault();	
			$("#texto-chat div:last").remove();
			$("#texto-chat").focus();
		
		});
		
		$("#btn-chat").click(function (event) {
			event.preventDefault();
			var inputTextoChat = $("#texto-chat").html();
			var usuarioChatPrivado = $("#usuarios .selecionado").text();
			
			if (usuarioChatPrivado) {
				socket.emit("falarPrivado", { nome: usuarioChatPrivado, texto: inputTextoChat });
				adicionarLinha("chat private", "<strong>&lt;" + socket.nome + "&gt;</strong> <em>[privado para " + usuarioChatPrivado + "]</em> " + inputTextoChat);
			}
			else {
				socket.emit("falar", { texto: inputTextoChat });
			}
			
			$("#texto-chat").text("").focus();
		});
		
	
	});
})(jQuery);

	
</script>

</head>

<body>

<?php
session_start();

$id=$_SESSION['id'];

include('funcoes_bd_pg.php');




	function montaCategoria($imagens,$nomes)
	{
					 
		//get all image files with a .jpg extension.
		//$images =  glob("" . $diretorio . "{*.jpg,*.gif,*.png}", GLOB_BRACE);
		 
		//print each file name
		for($i=0;$i<count($imagens);$i++)
		{
			echo '
				<li>
					<a class="thumbnail" style="width:80px" >
					<img onclick="SelecionarImagem(this.src,'."'$nomes[$i]'".'); "  alt="close button" style="max-width:100%;" src="'.$imagens[$i].'">
					<div>
						'.$nomes[$i].'
					</div>
					</a>
				</li>';	
		} 
	}
?>

<div class="wrapper"> <!-- início wrapper -->
	
	<div class="colEsquerda"> <!-- início coluna esquerda -->
	
		<div class="topEsq">
		</div>
		
		<div class="conteudoColEsq">
								
				<div class="categorias" style="margin-top: 0px;">
					<a  id="pessoas" data-container=".wrapper" rel="popover" >
						<span>
							<img src="img/icone.png"  />
						</span>
					</a>
				</div>
				
					
				<div class="categorias" >
					<a  id="objetos"  data-container=".wrapper" rel="popover" >
						<span>
							<img src="img/icone2.png" />
						</span>
					</a>
				</div>
				
						
				<div class="categorias">
					<a  id="natureza"   data-container=".wrapper" rel="popover" >
						<span>
							<img src="img/icone3.png" />
						</span>
					</a>
				</div>		
				
				<div class="categorias">
					<a  id="acoes"  data-container=".wrapper" rel="popover" >
						<span>
							<img src="img/icone4.png" />
						</span>
					</a>
				</div>			
				
				<div class="categorias">
					<a  id="alimentos" data-container=".wrapper" rel="popover" >
						<span>
							<img src="img/icone5.png" />
						</span>
					</a>
				</div>			
										
										
				<div class="categorias">
					<a  id="sentimentos" data-container=".wrapper" rel="popover" >
						<span>
							<img src="img/icone6.png" />
						</span>
					</a>
				</div>

				<div class="categorias">
					<a  id="qualidades" data-container=".wrapper" rel="popover" >
						<span>
							<img src="img/icone8.png" />
						</span>
					</a>
				</div>

				<div class="categorias">
					<a  id="minhas_imagens" data-container=".wrapper" rel="popover" >
						<span>
							<img src="img/icone9.png" />
						</span>
					</a>
				</div>			

			
			
		</div>		
	
	</div> <!-- Fim coluna esquerda -->
		
	
	<div id="popover-pes"  style="width: 300px; display:none;" >
		<div class="glb-grid-4" style="margin-right: 0px; margin-left: 0px; width: 230px;">
			<div class="widget widget-atletas-destaques-home">
				<ul class="avatares-destaques" style="margin-left: 0px;">	
	<?php 		
					montaCategoria(GetPicto(1),NomesPicto(1));			
	?>		
				</ul>
			</div>
		</div>
	 </div>
	
	<div id="popover-obj"  style="width: 300px; display:none;" >
		<div class="glb-grid-4" style="margin-right: 0px; margin-left: 0px; width: 230px;">
			<div class="widget widget-atletas-destaques-home">
				<ul class="avatares-destaques" style="margin-left: 0px;">	
	<?php 		
					montaCategoria(GetPicto(2),NomesPicto(2));			
	?>		
				</ul>
			</div>
		</div>
	 </div>
	 
	 <div id="popover-nat"  style="width: 300px; display:none;" >
		<div class="glb-grid-4" style="margin-right: 0px; margin-left: 0px; width: 230px;">
			<div class="widget widget-atletas-destaques-home">
				<ul class="avatares-destaques" style="margin-left: 0px;">	
	<?php 		
					montaCategoria(GetPicto(3),NomesPicto(3));		
	?>		
				</ul>
			</div>
		</div>
	 </div>
	 
	 <div id="popover-ac"  style="width: 300px; display:none;" >
		<div class="glb-grid-4" style="margin-right: 0px; margin-left: 0px; width: 230px;">
			<div class="widget widget-atletas-destaques-home">
				<ul class="avatares-destaques" style="margin-left: 0px;">	
	<?php 		
					montaCategoria(GetPicto(4),NomesPicto(4));			
	?>		
				</ul>
			</div>
		</div>
	 </div>
	 
	 <div id="popover-ali"  style="width: 300px; display:none;" >
		<div class="glb-grid-4" style="margin-right: 0px; margin-left: 0px; width: 230px;">
			<div class="widget widget-atletas-destaques-home">
				<ul class="avatares-destaques" style="margin-left: 0px;">	
	<?php 		
					montaCategoria(GetPicto(5),NomesPicto(5));			
	?>		
				</ul>
			</div>
		</div>
	 </div>
	 
	 <div id="popover-sen"  style="width: 300px; display:none;" >
		<div class="glb-grid-4" style="margin-right: 0px; margin-left: 0px; width: 230px;">
			<div class="widget widget-atletas-destaques-home">
				<ul class="avatares-destaques" style="margin-left: 0px;">	
	<?php 		
					montaCategoria(GetPicto(6),NomesPicto(6));			
	?>		
				</ul>
			</div>
		</div>
	 </div>
	
	 <div id="popover-qual"  style="width: 300px; display:none;" >
		<div class="glb-grid-4" style="margin-right: 0px; margin-left: 0px; width: 230px;">
			<div class="widget widget-atletas-destaques-home">
				<ul class="avatares-destaques" style="margin-left: 0px;">	
	<?php 		
					montaCategoria(GetPicto(7),NomesPicto(7));			
	?>		
				</ul>
			</div>
		</div>
	 </div>
	
	 <div id="popover-img"  style="width: 300px; display:none;" >
		<div class="glb-grid-4" style="margin-right: 0px; margin-left: 0px; width: 230px;">
			<div class="widget widget-atletas-destaques-home">
				<ul class="avatares-destaques" style="margin-left: 0px;">	
	<?php 		
				montaCategoria(GetPictoUsuario($id),NomesPictoUsuario($id));			
	?>		
				</ul>
			</div>
		</div>
	 </div>
	
	
	<div class="colCentro"> <!-- início coluna centro-->
	
	
		<div class="parteSup"> <!-- início parte superior -->
		
			<div id="chat" class="logMensagem">
			
			</div>
			
		</div> <!-- Fim parte superior -->
		
		
		<div class="parteInf"> <!-- início parte inferior -->
		
			<div class="botaoApagar">
				<a><img src="img/apagar.png"/></a>
			</div>
		
			<div class="border"> &nbsp;
			</div>
			
			
				<div id="form-falar" class="conteudoMensagem">			
					<section  id="texto-chat"    contenteditable="true"> </section>
				</div>
			
			
			<div class="border"> &nbsp;
			</div>
		
			<div class="botaoEnviar">
			<a  id="btn-chat"><img src="img/enviar.png"/></a>	
			</div>

		</div> <!-- Fim parte inferior -->

	</div> <!-- Fim col centro -->
	
	
	
	
	
	<div class="colDireita"> <!-- início coluna direita -->

		<div class="topDir"> 
			
		</div>
		
		<div class="conteudoColDir">

				<ul id="usuarios" class="contatoOnline" >
					<li >Aguardando...</li>
				</ul>
				

			
		</div>
		
	</div> <!-- fim coluna direita -->
	
</div>

</body>
</html>
