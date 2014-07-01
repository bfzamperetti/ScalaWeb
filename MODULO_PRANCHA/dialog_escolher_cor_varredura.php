<?php 
function tohexa($i){
	if ($i == 15) return 'F';
	else if ($i == 14) return 'E';
	else if ($i == 13) return 'D';
	else if ($i == 12) return 'C';
	else if ($i == 11) return 'B';
	else if ($i == 10) return 'A';
	return $i;
}


?>
<div id="dialog_escolher_cor_varredura" title="Escolha uma cor para a varredura">
	<div class="tabela de cores">
		<?php
		session_start();
		for ($i = 15; $i >= 0; $i-=3)
			for ($j = 15; $j >= 0; $j-=3)
				for ($k = 15; $k >= 0; $k-=3){
					$cor = tohexa($k).tohexa($i).tohexa($j);
					echo "<div class='cor_tabela_de_cores' onclick='document.getElementById(\"corVar\").value = \"#".$cor."\"; $(\"#dialog_escolher_cor_varredura\").dialog(\"close\");' style='background: #".$cor."'></div>";			
				}
		?>
	</div>
</div>     		
<script>
	$('#dialog_escolher_cor_varredura').dialog({
		autoOpen: false,
		width: 500,
		height: 300,
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

	$('#escolher_cor').click(function(){
		$('#dialog_escolher_cor_varredura').dialog('open');
		return false;
	});
	
</script>

