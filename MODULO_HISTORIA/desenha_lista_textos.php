<?php
	session_start();
		for ($i = 0; true ; $i++){
			$arq = $_SESSION['url_imagens_textos'].$i.'.png';
			if (getimagesize($arq))
			echo "<div class='qdr_imagem_lista' id='qdr_imagem_lista".$i."' onclick='javascript: selecionarHist(".$i.", 1);'>
						<div class='img_imagem_lista'>
							<img src='".$arq."' width='100%' />
						</div>
					  </div>";
			else break;
			
		}
?>

