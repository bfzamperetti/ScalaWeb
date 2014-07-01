<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Comunicador Livre</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css"/>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/bootstrap.css" rel="stylesheet" media="screen">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="socket.io.min.js"></script>

<script type="application/javascript">
	function SalvaAvatar(clicked_src)
	{	
		var avatares = clicked_src.split('/');
		var tamanho=avatares.length;
		var avatar = avatares[tamanho-1];
		
		$('#perfil').attr('src', 'imagens/avatares/'+avatar);
		$('#modal_troca_avatar').modal('hide');
		
		$.ajax({
			type: "POST",
			url: "comunicador.php",
			data:{ src: avatar }			 	
		});
		
	}
	
	
	
	function montarListaAmigosOnline(usuarios) 
	{
		// var lista = $("#usuarios");
	    var amigos_string= $("#id_amigos_user").val();
		var amigos_array = amigos_string.split(',');

		for (var i in usuarios) 
		{
			//torna os amigos online
			if(($.inArray( usuarios[i], amigos_array ))> -1)
			{
			    $("#usuario_1_"+usuarios[i]+"").css('visibility','visible');
				$("#usuario_"+usuarios[i]+"").css('visibility','hidden');
	
			}					
		}
		
	}
	
	function montarListaAmigosOffline(usuario) 
	{
		var amigos_string= $("#id_amigos_user").val();
		var amigos_array = amigos_string.split(',');
		//torna os amigos offline
		if(($.inArray( usuario, amigos_array ))> -1)
		{	
			$("#usuario_"+usuario+"").css('visibility','visible');
			$("#usuario_1_"+usuario+"").css('visibility','hidden');
		}
	
	}
	
	
	
	$(document).ready(function(){

		var pessoas_excluidas= [];
		$(  "li", $( "#lista_excluir" ) ).draggable({
			revert: "invalid", // when not dropped, the item will revert back to its initial position
			containment: "#modal_excluir_amigo",
			appendTo: "#modal_excluir_amigo",
			helper: "clone",
			cursor: "move"
		});
		
		 
		 $( "#lixeira" ).droppable({
			accept: "#lista_excluir > li",
			ctiveClass: "ui-state-highlight",
			drop: function( event, ui ) {
				ui.draggable.fadeOut();
				pessoas_excluidas.push((ui.draggable).attr("id"));
			}
			});
		
	
		$("#excluir_amigo_modal").click(function() {
			
			$.ajax({
				type: "POST",
				url: "comunicador.php",
				data:{ amigos_excluidos: pessoas_excluidas },
				success: function(data) {
						for (var i in pessoas_excluidas) 
						{
							socket.emit("atualizar_amizade", { 
								id: pessoas_excluidas[i]
							});
						}
						  window.location.reload();			
					}				
			});
			
			$('#modal_excluir_amigo').modal('hide');
		});
		
		
		console.log($("[rel=tooltip]"));
		$("[rel=tooltip]").tooltip({placement: "top"});
	
		$(".tips").tooltip({
			placement: "top"		
		});
		
			
		$( "#excluir_amigo").click(function() {
			$("li", $( "#lista_excluir" )).fadeIn();
			pessoas_excluidas= [];
			$('#modal_excluir_amigo').modal('show');
		});
	
		$( "#troca_avatar" ).click(function() {
			$('#modal_troca_avatar').modal('show');
		});
		
		$( "#add_amigo" ).click(function() {
			$('#modal_add_amigo').modal('show');
		});
		
	    $('#modal_add_amigo').on('hidden', function () {
			$('input.typeahead').val('');	
		});
		
		
		
		
		var productNames = new Array();
		var productIds = new Object();
		
		var jsonData=JSON.parse($('#selecionar_amigo').val())
           	
		$.each(jsonData, function ( index, product )
		{
			var nome_email= String(product.nome+' -'+product.email+'-');
			
			productNames.push( nome_email );
			productIds[nome_email] = product.id;
		} );
		
		$( 'input.typeahead' ).typeahead( { source:productNames } );
        
		
		$("#add_amigo_modal").click(function() {
			
			var amigo=productIds[$( 'input.typeahead' ).val()];		
			
			//verifica se o q ele digitou é um amigo valido
			if(typeof amigo !='undefined')
			{
				
				$.ajax({
					type: "POST",
					url: "comunicador.php",
					data:{ 
						novo_amigo: amigo					
					},
					success: function(data) {						socket.emit("atualizar_amizade", { 
							id: amigo
						});
						 window.location.reload();				
					}
				});
				
				$('#modal_add_amigo').modal('hide');
				
			}
			else
				alert("Amigo Invalido");
				
				
				
				
				
		
		});
	
		
		
		
	
/////////////////////////////////////////////CONEXAO COM O SERVIDOR NODE////////////////////////////////////		
		
		// Inicializa conexão com o servidor
		//var socket = io.connect("http://localhost:3000");
		var socket = io.connect("http://scala.ufrgs.br:3000");
		var iniciado = false;
		
		// Primeira mensagem enviada pelo servidor (assim que a conexão é feita)
		socket.on("ok", function (data) {
			// 1a vez que recebemos OK?
			if (!iniciado) {
				iniciado = true;
				var inputNome = $("#id").val();
				
			
				socket.nome = inputNome;
				socket.canal =  "comunicador";
				socket.emit("entrar", { nome: inputNome, sala: "comunicador" });
			}
			// Se não for, isso significa que por algum motivo caímos e voltamos ao servidor!
			else { 
				// Já haviamos entrado em um canal? Se sim, voltamos a ele.
				if (socket.canal) {
				
					socket.emit("entrar", { nome: socket.nome, sala: socket.canal });
				}
				// Se não, mostramos a tela para digitar o canal novamente
				else {
					var inputNome = $("#id").val();
				
			
					socket.nome = inputNome;
					socket.canal =  "comunicador";
					
					socket.emit("entrar", { nome: inputNome, sala: "comunicador" });
				}
			}
		});
		
		// Quando o servidor avisar que alguém entrou em um canal
		socket.on("entrou", function (data) {
			montarListaAmigosOnline(data.usuarios);
		});
		
		// Quando o servidor avisar que alguém saiu de um canal
		socket.on("partiu", function (data) {			
			montarListaAmigosOffline(data.cliente);
		});
		
		socket.on("atualizar_user", function (data) {			
			 window.location.reload();
		});

		//caso alguem entre no bate-papo com o usuario
		socket.on("convite_chat", function (data) {
			$('#usuario_1_'+data.id).css("background-color", "#F6ACB5");
			alert(data.nome_amigo+" quer conversar");
		});
	
		$("#lista_online li").click(function(e) {
			e.preventDefault();
			
			var sala_aux=''; 
			var id_user=$("#id").val();
		        var id_amigo=$(this).find("input").val();
			var nome_user=$("#nome_usuario").val();
			//definiçao da sala: menor id concatenado cm o maior
			if(id_user < id_amigo)
				sala_aux=id_user + id_amigo;
			else
				sala_aux=id_amigo + id_user;
		
	
			socket.emit("set user_chat", { 
				id_usuario: $("#id").val(),
				nome_usuario: $("#nome_usuario").val(),
				avatar_usuario: $("#perfil").attr('src'),
				sala: sala_aux
			});
			
			// socket.emit("get user_chat");
			
			 window.open('cliente-chat.php','Conversa','height=' + screen.height + ',width=' + screen.width + '');

			 if($(this).css("background-color")=="rgb(255, 255, 255)")
			 {
				socket.emit("convidar_amigo", {
					id:id_amigo,
					id_usuario:id_user,
					nome:nome_user,
					sala: sala_aux
				}); 
			 }
			 else
				$(this).css("background-color", "rgb(255, 255, 255)");




		});
		
		 
		
	});

</script>	
	
	
</head>

<body>




	
<?php	
session_start();


//tem que ve como q o nome da pessoa eh passada nas paginas
// $usuario_conectado=$_SESSION['pessoa'];

//id da pessoa que esta logada no sistema
$id=$_SESSION['id'];

?>


	
	
	
	
<?php

include('funcoes_bd_pg.php');




// $link = mysqli_connect('localhost','root','','scala');

// if (!$link) {
    // die('Connect Error (' . mysqli_connect_errno() . ') '
            // . mysqli_connect_error());
// }

VerificaUsuario($id);

$nome_amigos=nomeAmigos($id);
$avatar_amigos=avatarAmigos($id);
$id_amigos=idAmigos($id);
$posssiveis_amigos= SelecionarAmigo($id);

$email_amigos=EmailAmigos($id);

$nome_user=getNome($id);




if(isset($_POST['src']))
{
	
	atualizaAvatar($id,$_POST['src']);
}

if(isset($_POST['novo_amigo']))
{
	
	atualizaAmigos($id,$_POST['novo_amigo']);
}

if(isset($_POST['amigos_excluidos']))
{
	excluiAmigos($id,$_POST['amigos_excluidos']);
	
}






$avatar_usuario=getAvatar($id);




			
?>	
	
		<input id="id" type="hidden" value="<?php echo $id;?>">
		<input id="id_amigos_user" type="hidden" value="<?php if(!empty($id_amigos)) echo implode(",",$id_amigos); else echo ''; ?>">
		<input id="selecionar_amigo" type="hidden" value='<?php echo json_encode($posssiveis_amigos);?>'>
		<input id="nome_usuario" type="hidden" value="<?php echo $nome_user;?>">
	
	
	
	<div id="container" style="height: 180px; width:100%;">
	 <!--start header-->
	   <header>

	
	   
	   <!--start logo-->
			<div class="well" style="float:left; width:12%;">
				<div class="row">
					<div class="span1"><img id="perfil" src="<?php echo 'imagens/avatares/' . $avatar_usuario;?>" alt="example"></div>
					<div class="span3">				
						<p>BEM VINDO</p>
						<p><strong><?php echo $nome_user;?></strong></p>
						<span class=" badge badge-warning"><?php echo count($nome_amigos);?> amigos</span> 
						
					</div>
				</div>
			</div>
			   <!--end logo <span class=" badge badge-info">15 online</span>-->

		   <nav>
			   <ul>
				   <li><a id="troca_avatar"   class="btn btn-large" ><img style="width:130px;" src="imagens/selecionar-avatar.png"></a></li>
				   <li><a id="add_amigo"   class="btn btn-large" ><img style="width:130px;" src="imagens/adicionar-amigo.png"></a></li> 
				   <li><a id="excluir_amigo"   class="btn btn-large" ><img style="width:130px;" src="imagens/excluir-amigo.png"></a></li> 
			<li><a id="ajuda" onclick=" window.open('../COMUNICADOR/TUTORIAL_CHAT/tutorial.html','Conversa','height=' + screen.height + ',width=' + screen.width + ',scrollbars=yes,titlebars=yes');"   class="btn btn-large" title="Ajuda"  ><img style="width:50px;" src="imagens/ico9.png"></a></li> 
				   <li><a id="sair"   class="btn btn-large" href="javascript:history.back(-1);" title="Sair" ><img style="width:50px;" src="imagens/ico18.png"></a></li> 
				   
			   </ul>   
		   </nav>   
			   
			<div id="modal_excluir_amigo" style="bottom: 10px; top: 0px;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">Arraste na lixeira para excluir</h3>
					
				</div>
				<div class="modal-body" >
				   
					<div class="glb-grid-4">

						<div class="widget widget-atletas-destaques-home" >
							<ul id="lista_excluir" class="avatares-destaques">
			
						
		<?php 
										//print each file name
								if(is_array($id_amigos))
								{
									for($i=0;$i<count($id_amigos);$i++)
									{					
										echo '
												<li  style="list-style-type: none;"  id="'.$id_amigos[$i].'"  >
													<a data-container="#modal_excluir_amigo" rel="tooltip" title="'.$email_amigos[$id_amigos[$i]].'" class="thumbnail" style="width:80px" >
														<img onclick=""  alt="close button" style="max-width:100%;" src="imagens/avatares/'.$avatar_amigos[$id_amigos[$i]].'">
														<p style="margin-bottom:0px;opacity:0.4;filter:alpha(opacity=40);">'.$nome_amigos[$id_amigos[$i]].' </p>
													</a>
												</li>';	
									} 
								}

		?>
							</ul>
						</div>
					</div>
						
			   
				
				</div>
		
					
				
				<div class="modal-footer">
					<a id="lixeira"  class="ui-lixeira tips "  title="arraste para excluir">
							<img  src="img/24_empty_trash.ico"  ></img>
						</a>
					<button id="excluir_amigo_modal"  class="btn btn-primary">Salvar</button>
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
				</div>
			</div>
		
		
		
		
		
		
		
		
			<div id="modal_add_amigo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">Digite o nome do amigo</h3>
					
				</div>
				<div class="modal-body" style="overflow-y:visible; padding: 100px;">
				   
					<input class="typeahead" style=" width: 400px;" type="text" data-provide="typeahead" autocomplete="off">
			   
				</div>
				<div class="modal-footer">
					<button id="add_amigo_modal"  class="btn btn-primary">Adicionar</button>
					<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
				</div>
			</div>
			
			   
			   
			   
			   
			   
			<div id="modal_troca_avatar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel"> Escolha um avatar</h3>
					
				</div>
				<div class="modal-body">
				
				
						
					<div class="glb-grid-4">

						<div class="widget widget-atletas-destaques-home">
							<ul class="avatares-destaques">
			
						
		<?php 
							$directory = "imagens/avatares/";
							 
							//get all image files with a .jpg extension.
							$images =  glob("" . $directory . "{*.jpg,*.gif,*.png}", GLOB_BRACE);
							$cont=0;
							//print each file name
							foreach($images as $image)
							{
								echo '
										<li>
											<a class="thumbnail" style="width:80px" >
												<img onclick="SalvaAvatar(this.src)"  alt="close button" style="max-width:100%;" src="'.$image.'">
											</a>
										</li>';	
							} 
		?>
							</ul>
						</div>
					</div>
					

				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
				</div>
			</div>
			
			

		
			   
		  
	   </header>
	</div>
	
	
    <form id="myForm" action="cliente-chat.php"   style="margin-top: 50px;">
		<fieldset class="scheduler-border">
			<legend><img style="width:150px;" src="imagens/amigos-conectados.png"></legend>
			<div id="container">
				<div id="div_online" class="widget widget-atletas-destaques-home">
					<ul id="lista_online" class="avatares-destaques">	

<?php 
				// configurarChat('.$id_amigos[$i].')	
					//print each file name
					if(is_array($id_amigos))
					{
						for($i=0;$i<count($id_amigos);$i++)
						{					
							echo '
									<li id="usuario_1_'.$id_amigos[$i].'" style="background-color:#FFFFFF; visibility:hidden;" >
										<input type="hidden" value="'.$id_amigos[$i].'">
			<a data-container="body" rel="tooltip" title="'.$email_amigos[$id_amigos[$i]].'" class="thumbnail" style="width:80px" >
											<img onclick=""  alt="close button" style="max-width:100%;" src="imagens/avatares/'.$avatar_amigos[$id_amigos[$i]].'">
											<p style="margin-bottom:0px;opacity:0.4;filter:alpha(opacity=40);">'.$nome_amigos[$id_amigos[$i]].' </p>
										</a>
									</li>';	
						} 
					}
?>
					</ul>
				</div>
				
			</div>
			
		

			
		</fieldset>
    </form>

	<form style="margin-top: 50px;">
		<fieldset class="scheduler-border">
			<legend><img style="width:150px;" src="imagens/amigos-desconectados.png"></legend>
			<div id="container">
				<div id="div_offline" class="widget widget-atletas-destaques-home">
					<ul id="lista_offline" class="avatares-destaques">	
<?php 
					
					//print each file name
					if(is_array($id_amigos))
					{
						for($i=0;$i<count($id_amigos);$i++)
						{					
							echo '
									<li id="usuario_'.$id_amigos[$i].'">
										<a data-container="body" rel="tooltip" title="'.$email_amigos[$id_amigos[$i]].'" class="thumbnail"  style="width:80px" >
											<img onclick=""  alt="close button" style="opacity:0.4;filter:alpha(opacity=40);max-width:100%;" src="imagens/avatares/'.$avatar_amigos[$id_amigos[$i]].'">
											<p style="margin-bottom:0px;opacity:0.4;filter:alpha(opacity=40);">'.$nome_amigos[$id_amigos[$i]].' </p>
										</a>
									</li>';	
						} 
					}
?>
					</ul>
				</div>
				
			</div>
		
			
			
			
			
			
			
			
			
			
			
			
		</fieldset>
    </form>



</body>
</html>
