<div id="dialog_salvar" title="<?php echo $_str['lblChooseTheWayYouWantToSaveYourHistory']; ?>">
	<form name="frm_salvar_hist" method="post" action="index.php">
		<?php echo $_str['lblHistoryName']; ?>: <input type="text" value="" name="nome" maxlength="30" />
		<input type="hidden" value="" name="tipo_salvar_hist" maxlength="30" />
		<hr />
		<?php echo $_str['lblWhenYouSaveInPublicHistoriesUseANameThatHelpsOnTheThemeIdentification']; ?>.
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
					 salvar_arquivo_hist();		
					 $(this).dialog('close');		
				}
				},
				"Em historias públicas":{ 
				text: "",
				click: function() {
					 if (document.frm_salvar_hist.nome.value == "")
						jAlert("<?php echo $_str['lblTypeANametoSaveYourHistory']; ?>", "<?php echo $_str['lblSaveHistory']; ?>");	
					 else{
						 salvar_hist('publica', document.frm_salvar_hist.nome.value);
						 $(this).dialog('close');
					 }
				}
				},
				"Em historias privadas":{ 
				text: "",
				click: function() {
					 if (document.frm_salvar_hist.nome.value == "")
						jAlert("<?php echo $_str['lblTypeANametoSaveYourHistory']; ?>","<?php echo $_str['lblSaveHistory']; ?>");	
					 else{
						salvar_hist('privada', document.frm_salvar_hist.nome.value);
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
