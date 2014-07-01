<div id="dialog_salvar" title="<?php echo $_str['saveBoardDialogTitle']; ?>">
	<form name="frm_salvar_prancha" method="post" action="index.php">
		<?php echo $_str['lblBoardName']; ?>: <input type="text" value="" name="nome" maxlength="30" />
		<input type="hidden" value="" name="tipo_salvar_prancha" maxlength="30" />
	</form>
</div>     
		
<script>
	$('#dialog_salvar').dialog({
		autoOpen: false,
		width: 700,
		height: 160,
		buttons: {
				"Fechar":{ 
				text: "",
				click: function() {
					$(this).dialog('close');
				}
				},
				"No Computador":{ 
				text: "",
				click: function() {
					 salvar_arquivo();		
					 $(this).dialog('close');		
				}
				},
				"Em pranchas públicas":{ 
				text: "",
				click: function() {
					 if (document.frm_salvar_prancha.nome.value == "")
						jAlert("<?php echo $_str['lblTypeANameToYourBoard']; ?>", "<?php echo $_str['lblSaveBoard']; ?>");	
					 else{
						 salvar_prancha('publica', document.frm_salvar_prancha.nome.value);
						 $(this).dialog('close');
					 }
				}
				},
				"Em pranchas privadas":{ 
				text: "",
				click: function() {
					 if (document.frm_salvar_prancha.nome.value == "")
						jAlert("<?php echo $_str['lblTypeANameToYourBoard']; ?>", "<?php echo $_str['lblSaveBoard']; ?>");	
					 else{
						salvar_prancha('privada', document.frm_salvar_prancha.nome.value);
						$(this).dialog('close');
					 }
				}
			}
			},
			create:function () {
			$(this).closest(".ui-dialog").find(".ui-button").eq(0).addClass("dialog_botao_fechar");
			$(this).closest(".ui-dialog").find(".ui-button").eq(1).addClass("dialog_botao_computador");
			$(this).closest(".ui-dialog").find(".ui-button").eq(2).addClass("dialog_botao_publicas");
			$(this).closest(".ui-dialog").find(".ui-button").eq(3).addClass("dialog_botao_privadas");
		}
	});

	$('#salvar').click(function(){
		$('#dialog_salvar').dialog('open');
		return false;
	});
</script>
