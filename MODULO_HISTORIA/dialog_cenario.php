<div id="dialog_cenario" title="<?php echo $_str['putAScenarioOnYourComic']; ?>">
	<img src="imagens/site/colorpicker.png" width="112" height="73" style="cursor:pointer" id="escolher_cor_cenario"/>
    <img src="imagens/site/stage.png" width="112" height="73" style="cursor:pointer" id="escolher_imagem_cenario"/>
</div>     
		
<script>
	$('#dialog_cenario').dialog({
		autoOpen: false,
		width: 280,
		height: 250,
		buttons: {
				"Voltar":{
					text: "",
					click: function() {
					$(this).dialog('close');
				}
			}
		},
		create:function () {
			$(this).closest(".ui-dialog").find(".ui-button").eq(0).addClass("dialog_botao_fechar");
		}
	});

	$('#cenario').click(function(){
		$('#dialog_cenario').dialog('open');
		return false;
	});
</script>

