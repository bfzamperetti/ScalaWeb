<?php
if(!session_id())session_start();

$hex = $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$_GET['quadrinho'].'_cenario']; 

	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} 
	else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
		$rgb = array($r, $g, $b);
		
  // informamos ao browser que o conteúdo é uma imagem PNG
  header("Content-type: image/png");
  // criamos uma imagem com largura de 200 e altura de 150 pixels
  $imagem = imagecreate(1,1);
  // cor de fundo será azul
  $cor_fundo = imagecolorallocate($imagem, $r, $g, $b);
  // mandamos para o browser
  imagepng($imagem);
  // liberamos a memória
  imagedestroy($imagem);
?>
