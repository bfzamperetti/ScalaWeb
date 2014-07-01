<div id="dialog_visualizar" title="Visualiza&ccedil;&atilde;o da Prancha">

</div>     
		
<script>
	$('#dialog_visualizar').dialog({
		autoOpen: false,
		width: 720,
		height: 510,
		buttons: {
				"Fechar": function() {
					$(this).dialog('close');
				},
			}
	});

	$('#visualizar').click(function(){
		montarVisualizacao();
		$('#dialog_visualizar').dialog('open');
		return false;
	});
</script>
