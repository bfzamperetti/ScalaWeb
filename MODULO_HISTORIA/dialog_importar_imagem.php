<div id="dialog_importar_imagem" title="<?php echo $_str['lblImportImage']; ?>">
	<form name="frm_dialog_importarImagem" method="post" enctype="multipart/form-data" action="quadrinho.php" >
		<?php echo $_str['lblImageFile']; ?>: (jpg, png, jpeg, gif)
		<?php echo $_str['lblMaxSize']; ?>: 8Mb<input type="file" name="arquivo_img" id="arquivo" /> 
		<hr />
		<?php echo $_str['lblName']; ?>: <input type="text" name="nome" value="" />
		<input type="hidden" name="importarImagem" />
	</form>
</div>     
		
<script>
	$('#dialog_importar_imagem').dialog({
		autoOpen: false,
		width: 400,
		height: 220,
		buttons: {
				"Fechar":{
				text: "",
				click: function() {
					$(this).dialog('close');
					}
				},
				"Importar":{
				text: "",
				click: function() {
					tela_carregar_ajax('<?php echo $_str['lblSendingImage']; ?>...');
					document.frm_dialog_importarImagem.submit();					
					}
				}
		},
		create:function () {
			$(this).closest(".ui-dialog").find(".ui-button").eq(0).addClass("dialog_botao_fechar");
			$(this).closest(".ui-dialog").find(".ui-button").eq(1).addClass("dialog_botao_concluir");
		}
	});

	$('#importar').click(function(){
		$('#dialog_importar_imagem').dialog('open');
		return false;
	});
</script>
