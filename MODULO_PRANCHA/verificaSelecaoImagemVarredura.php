<?php
session_start();
if ($_SESSION['estado_varredura'] == 1){	
	if (isset($_GET['varAtual'])){
		if ($_GET['varAtual'] == 'categorias')
			echo '<script>
			if("'.$_SESSION["cor_varredura"].'" == "")
				cor = "#000";
			else
				cor = "'.$_SESSION["cor_varredura"].'";
				
			estadoVarreduraFunc1 = 0;
			varredura_atual = "categorias";
			IniciaVarredura('.$_SESSION['tempo_varredura'].', -1); 
			</script>'; 
	}
	else if (isset($_GET['idImgVar'])){ 
		if (!isset($_SESSION['quadro_atual'])) session_start();
		if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 1)
			$tipoLayout = 12;
		if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 2)
			$tipoLayout = 5;
		if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 3)
			$tipoLayout = 7;
		if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 4)
			$tipoLayout = 8;
		if ($_SESSION['layout_qdr'.$_SESSION['quadro_atual']] == 5)
			$tipoLayout = 2;

		echo "<script> 
		estadoVarreduraSimplesImgs = 0;
		varredura_atual = 'selecaoEspacoPrancha';
		controlaVarredura = 0;
		cor='".$_SESSION['cor_varredura']."';	
		idImagemVarredura = ".$_GET['idImgVar'].";
		SelecionaEspacoNaPrancha(".$tipoLayout.",".$_SESSION['tempo_varredura'].", -1);	 
		</script>";
	}
}
?>

