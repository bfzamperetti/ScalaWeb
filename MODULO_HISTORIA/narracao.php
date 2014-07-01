<?php
if (!session_id()) session_start();
	$narracao = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_narracao'];
	if (strlen($narracao) > 50) $narracao = substr($narracao, 0, 50)."...";
	echo '<div id="narracao" class="narracao">
			<div id="alterar_nar">
				<div class="alterar_narracao"  onclick="document.getElementById(\'alterar_nar\').style.display=\'none\'; document.getElementById(\'alterarnarracao\').style.display=\'block\';"> Alterar Narração </div>
				<div class="mostrar_narracao" title="'. $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_narracao'].'" >'.$narracao.'</div>
			</div>
			<div id="alterarnarracao" style="display:none;">
				<div class="alterar_narracao" id="alterar_narracao" onclick="alterarNarracao(document.getElementById(\'narracao_texto\').value);"> Alterar </div>
				<div class="alterar_narracao" onclick="document.getElementById(\'narracao_texto\').value = \''.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_narracao'].'\'; document.getElementById(\'alterar_nar\').style.display=\'block\'; document.getElementById(\'alterarnarracao\').style.display=\'none\';"> Cancelar </div>
				<input type="text" id="narracao_texto" size="60%%" value="'.$_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_SESSION['quadrinho_atual'].'_narracao'].'" />
			</div>
		  </div>';
?>
