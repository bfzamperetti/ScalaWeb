<div id="dialog_alterar_legenda" title="Digite uma legenda">
	<form name="frm_novo_legenda">
		<input type="text" value="" name="novo_legenda" maxlength="30" />
	</form>
</div>     
		
<script>
	
	$('#dialog_alterar_legenda').dialog({
		autoOpen: false,
		width: 170,
		height: 150,
		open: function(event, ui) { document.frm_novo_legenda.novo_legenda.value=''; },
		buttons: {
				"Fechar": function() {
					$(this).dialog('close');
				},
				"Alterar": function() {
					alterarLegenda(document.frm_novo_legenda.novo_legenda.value);
					$(this).dialog('close');
				}
			}
	});

</script>
