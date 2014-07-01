<div id="dialog_importar_imagem" title="Importar Imagem">
	<form name="frm_dialog_importarImagem" method="post" enctype="multipart/form-data" action="index.php" >
		Arquivo de imagem: <input type="file" name="arquivo_img" id="arquivo" /> 
		<hr />
		Nome: <input type="text" name="nome" value="" />
		<input type="hidden" name="importarImagem" />
	</form>
</div>     
		
<script>
	$('#dialog_importar_imagem').dialog({
		autoOpen: false,
		width: 400,
		height: 180,
		buttons: {
				"Fechar": function() {
					$(this).dialog('close');
				},
				"Importar": function() {
					tela_carregar_ajax('Enviando imagem...');
					document.frm_dialog_importarImagem.submit();					
				}
			}
	});

	$('#importar').click(function(){
		$('#dialog_importar_imagem').dialog('open');
		return false;
	});
</script>
