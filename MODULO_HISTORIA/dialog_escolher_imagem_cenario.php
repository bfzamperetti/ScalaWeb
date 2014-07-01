<div id="dialog_escolher_imagem_cenario" title="<?php echo $_str['lblChooseAnImage']; ?>">
	<?php
	for ($i = 0; true ; $i++){
			$arq = $_SESSION['url_imagens_cenarios'].$i.'.png';
			if (!getimagesize($arq))
				$arq = $_SESSION['url_imagens_cenarios'].$i.'.gif';
			if (!getimagesize($arq))
				$arq = $_SESSION['url_imagens_cenarios'].$i.'.jpg';
			if (!getimagesize($arq))
				$arq = $_SESSION['url_imagens_cenarios'].$i.'.jpeg';
			if (!getimagesize($arq))
				break;
			echo "<div class='ico_dialog_cenario' onclick='mudarImagemCenario(\"".$arq."\")'>
					<img src='".$arq."' width='200px'/>
				 </div>";
		}
	?>
</div>     		
<script>
	$('#dialog_escolher_imagem_cenario').dialog({
		autoOpen: false,
		width: 700,
		height: 390,
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

	$('#escolher_imagem_cenario').click(function(){
		$('#dialog_escolher_imagem_cenario').dialog('open');
		return false;
	});
</script>

