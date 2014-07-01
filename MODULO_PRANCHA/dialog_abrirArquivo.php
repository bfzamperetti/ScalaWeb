<div id="dialog_abrirArquivo" style="z-index: 1020;" title="<?php echo $_str['OpenFileDialogTitle']; ?>">
</div>  

<script>
	$('#dialog_abrirArquivo').dialog({
		autoOpen: false,
		width: 800,//750
		height: 550,//480
		buttons: {
				"Abrir":{
				text: "",
				id: "dialog_abrir_prancha",
				click: function() {
							if (document.frm_abrir_prancha.id.value == "")
								jAlert("<?php echo $_str['lblSelectABoardToOpen']; ?>","<?php echo $_str['lblOpenBoard']; ?>");	
							else
								document.frm_abrir_prancha.submit();					
						}
				},
				"Fechar":{
				text: "",
				id: "fechar_dialog_abrir",
				click: function() {
						$(this).dialog('close');
					}
				}
		},
		create:function () {
			$(this).closest(".ui-dialog").find(".ui-button").eq(1).addClass("dialog_botao_fechar");
			$(this).closest(".ui-dialog").find(".ui-button").eq(0).addClass("dialog_botao_abrir");
		}
	});

	$('#abrir').click(function(){
		montarListaDePranchas();
		$('#dialog_abrirArquivo').dialog('open');
		return false;
	});
	
	//detecta o pressionar do enter e abra a prancha que foi selecionada
	$(document).keypress(function(event) {
		var keycode = (event.keyCode ? event.keyCode : event.which);
			if(keycode == '13') { //quando pressionado o enter faz a mesma função do botão abrir
				if (document.frm_abrir_prancha.id.value == "")
						jAlert("<?php echo $_str['lblSelectABoardToOpen']; ?>","<?php echo $_str['lblOpenBoard']; ?>");
				else
						document.frm_abrir_prancha.submit();	
			}
	});
	
	//detecta o duplo clique 
	//aviso: um duplo clique em espaço vazio abrirá a última prancha selecionada
	$(document).dblclick(function() {
	if (document.frm_abrir_prancha.id.value == "")
		jAlert("<?php echo $_str['lblSelectABoardToOpen']; ?>","<?php echo $_str['lblOpenBoard']; ?>");	
	else
		document.frm_abrir_prancha.submit();	
	});

</script>

