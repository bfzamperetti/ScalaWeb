<div id="dialog_visualizar" title="<?php echo $_str['lblBoardView']; ?>">

</div>     
		
<script>
	$('#dialog_visualizar').dialog({
		autoOpen: false,
		width: 720,
		height: 510,
		buttons: {
				"<?php echo $_str['lblClose']; ?>": function() {
					$(this).dialog('close');
				},
				"<?php echo $_str['lblPlay']; ?>": function() {
					 sintetizarVisualizar();				
				}
			}
	});

	$('#visualizar').click(function(){
		montarVisualizacao();
		$('#dialog_visualizar').dialog('open');
		return false;
	});
</script>
