<div id="dialog_configuracoes" title="<?php echo $_str['lblConfig']; ?>">
	<form name="form_config_varredura" action="index.php?varAtual=menu_inferior" method="post" >
	<table>		
		<tr><td><?php echo $_str['lblScanner']; ?>:</td>
			<td>
				<select name="estadoVarredura">
					<option value="0" /><?php echo $_str['lblDeactivate']; ?></option>
					<option value="1" /><?php echo $_str['lblActivate']; ?></option>
				</select>
			</td>
		</tr>
		<tr><td><?php echo $_str['lblScannerColor']; ?>:</td>
			<td><button type="button" id="escolher_cor"><?php echo $_str['lblColors']; ?></button></td>
		</tr>
		<tr><td><?php echo $_str['lblSpeed']; ?>:</td>
			<td>
				<select name="velocidadeVar">
					<option value="500"><?php echo $_str['lblHigh']; ?></option>
					<option value="1000"><?php echo $_str['lblMedium']; ?></option>				
					<option value="2000"><?php echo $_str['lblLow']; ?></option>
					<option value="2500"><?php echo $_str['lblVeryLow']; ?></option>
				</select>
			</td>
		</tr>
		<tr><td><?php echo $_str['scannerSound']; ?>: </td>
			<td>
				<select name="somVar">
					<option value="0"><?php echo $_str['lblDeactivate']; ?></option>
					<option value="1"><?php echo $_str['lblActivate']; ?></option>				
				</select>
			</td>
		</tr>
	</table>
	<input type="hidden" name="corVar" id="corVar" />
	</form>
</div>     
		
<script>
	$('#dialog_configuracoes').dialog({
		autoOpen: false,
		width: 360,
		height: 300,
		zIndex: 500000,
		buttons: {
				"Fechar":{
					text: "",
					click: function() {
						$(this).dialog('close');
					}
				},
				"Salvar":{ 
					text: "",
					click: function() {
					document.form_config_varredura.submit();
					}
				}
		},
		create:function () {
			$(this).closest(".ui-dialog").find(".ui-button").eq(1).addClass("dialog_botao_concluir");
			$(this).closest(".ui-dialog").find(".ui-button").eq(0).addClass("dialog_botao_fechar");
		}
	});

	$('#configuracoes').click(function(){
		$('#dialog_configuracoes').dialog('open');
		return false;
	});
</script>

<?php
	include('dialog_escolher_cor_varredura.php');
?>
