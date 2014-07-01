<div id="dialog_salvar_varredura" title="<?php echo $_str['lblSaveBoard']; ?>">
	<form name="frm_salvar_prancha_varredura" method="post" action="index.php">
		<?php echo $_str['lblTheBoardWillBeSavedWithTheName'].$_SESSION['nome'].date("d/m/y-h:i:s"); ?>
		<input type="hidden" value="<?php echo $_SESSION['nome'].date("d/m/y-h:i:s"); ?>" name="nome" />  
		<input type="hidden" value="" name="tipo_salvar_prancha" maxlength="30" />
	</form>
</div>     
		
<script>
	$('#dialog_salvar_varredura').dialog({
		autoOpen: false,
		width: 500,
		height: 160,
		buttons: {
				"<?php echo $_str['lblClose']; ?>":{ 
					text: "",
					id: "fechar_dialog_salvar",
					click :function() {
					$(this).dialog('close');
					}
				},
				"<?php echo $_str['lblSave']; ?>": {
					text: "",
					id: "salvar_dialog_salvar",
					click: function() {
						salvar_prancha('privada', document.frm_salvar_prancha.nome.value);
						$(this).dialog('close');
					}
				}
		},
		create:function () {
			$(this).closest(".ui-dialog").find(".ui-button").eq(1).addClass("dialog_botao_salvar");
			$(this).closest(".ui-dialog").find(".ui-button").eq(0).addClass("dialog_botao_fechar");
		}	
	});
</script>
