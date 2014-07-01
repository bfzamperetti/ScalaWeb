<div id="dialog_upload_som" title="<?php $_str['changeAudiotitle']; ?>">
	<form name="frm_dialog_uploadSom" method="post" enctype="multipart/form-data" action="index.php" >
		Arquivo de som: <input type="file" name="arquivo_som" id="arquivo_som" /> 
		<input type="hidden" name="importarSom" />
		<input type="hidden" name="id_prancha" />
	</form>
	<div id="div_verificar_se_tem_som"></div>
</div>     
		
<script>
	$('#dialog_upload_som').dialog({
		autoOpen: false,
		width: 400,
		height: 180,
		buttons: {
				"<?php echo $_str['lblClose']; ?>":{ 
					text: "",
					id: "fechar_dialog_salvar",
					click :function() {
					$(this).dialog('close');
					}
				},
				"<?php echo $_str['lblSend']; ?>":{
					text:"",
					click: function() {
					tela_carregar_ajax('Enviando som...');
					document.frm_dialog_uploadSom.id_prancha.value = selecaoGlobal.id;
					document.frm_dialog_uploadSom.submit();					
				}
			}
		},
		create:function () {
			$(this).closest(".ui-dialog").find(".ui-button").eq(1).addClass("dialog_botao_concluir");
			$(this).closest(".ui-dialog").find(".ui-button").eq(0).addClass("dialog_botao_fechar");
		}	
	});

</script>
