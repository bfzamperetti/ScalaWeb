<div id="dialog_alterar_legenda" title="<?php echo $_str['lbltypeASubtitle']; ?>">
	<form name="frm_novo_legenda">
		<input type="text" value="" name="novo_legenda" maxlength="30" />
	</form>
</div>     
		
<script>
	
	$('#dialog_alterar_legenda').dialog({
		autoOpen: false,
		width: 200,
		height: 200,
		open: function(event, ui) { document.frm_novo_legenda.novo_legenda.value=''; },
		buttons: {
				"Fechar":{ 
					text: "",
					click: function() {
						$(this).dialog('close');
					}
				},
				"Alterar":{
					
					text: "",
					click: function() {
						alterarLegenda(document.frm_novo_legenda.novo_legenda.value);
						$(this).dialog('close');
					}
				}
		},
		create:function () {
			$(this).closest(".ui-dialog").find(".ui-button").eq(1).addClass("dialog_botao_concluir");
			$(this).closest(".ui-dialog").find(".ui-button").eq(0).addClass("dialog_botao_fechar");
		}
	});

</script>
