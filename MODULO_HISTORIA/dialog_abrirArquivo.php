<div id="dialog_abrirArquivo" title="<?php echo $_str['lblChooseTheHistoryYouWantToOpen']; ?>">
	
</div>     
		
<script>
	$('#dialog_abrirArquivo').dialog({
		autoOpen: false,
		width: 800,
		height: 500,
		buttons: {
				"Abrir":{
				text: "",
				click: function() {
							if (document.frm_abrir_hist.id.value == "")
								jAlert("<?php echo $_str['lblChooseTheHistoryYouWantToOpen']; ?>","<?php echo $_str['lblOpenHistory']; ?>");	
							else
								document.frm_abrir_hist.submit();					
						}
				},
				"Fechar":{
				text: "",
				click: function() {
						$(this).dialog('close');
					}
				}
		},
		create:function () {
			$(this).closest(".ui-dialog").find(".ui-button").eq(0).addClass("dialog_botao_abrir");
			$(this).closest(".ui-dialog").find(".ui-button").eq(1).addClass("dialog_botao_fechar");
		}
	});

	$('#abrir').click(function(){
		montarListaDeHist();
		$('#dialog_abrirArquivo').dialog('open');
		return false;
	});

	//detecta o pressionar do enter e abra a prancha que foi selecionada
	$(document).keypress(function(event) {
		var keycode = (event.keyCode ? event.keyCode : event.which);
			if(keycode == '13') {
				if (document.frm_abrir_hist.id.value == "")
						jAlert("<?php echo $_str['lblChooseTheHistoryYouWantToOpen']; ?>","<?php echo $_str['lblOpenHistory']; ?>");	
					else
						document.frm_abrir_hist.submit();	
			}
	});
	
	
	//detecta o duplo clique 
	//aviso: um duplo clique em espaço vazio abrirá a última prancha selecionada
	$(document).dblclick(function() {
	if (document.frm_abrir_hist.id.value == "")
		jAlert("<?php echo $_str['lblChooseTheHistoryYouWantToOpen']; ?>","<?php echo $_str['lblOpenHistory']; ?>");	
	else
		document.frm_abrir_hist.submit();		
	});
	
</script>
