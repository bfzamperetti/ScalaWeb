<?php
/*
 * 
 * Esta pagina tem algumas funcoes evetualmente usadas pelo scalaweb 
 * 
 * 
 * */
function mostraData ($data) {
	if ($data!='') {
	   return (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
	}
	else{ 
		return ''; 
	}
}

function voltaData ($data) {
if ($data != '') {
   return (substr($data,3,2).'/'.substr($data,0,2).'/'.substr($data,6,4));
}
else { return ''; }
}

function tiraAcentos($texto){ 
	$acentos = array("À", "Á", "Â", "Ã", "Â", "É", "È", "Ẽ", "Ê", "Í", "Ì", "Ĩ", "Î", "Ó", "Ò", "Õ", "Ô", "Ö", "Ú", "Ù", "Û", "Ü",  "Ç", "à","á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç" ); 
	$novo =    array("A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "SS", "A","A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "SS"); 
	$result = str_replace($acentos, $novo, $texto); 
	return $result; 
}


function utf8($texto){ 
	$acentos = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç"); 
	$utf8 = array("Ã¡","Ã ","Ã¢","Ã£","Ã¤","Ã©","Ã¨","Ãª","Ã«","Ã­","Ã¬","Ã®","Ã¯","Ã³","Ã²","Ã´","Ãµ","Ã¶","Ãº","Ã¹","Ã»","Ã¼","Ã§","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã","Ã"); 
	$result = str_replace($utf8, $acentos, $texto); 
	return $result; 
}

function upperAcentos($texto){
	return strtr($texto ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ");
}

//arrumar string para sintetizar o som corretamente
function arrumaSintetizar($var) {
	$var = utf8($var);
	$var = tiraAcentos($var);
	$var = "h".$var;
	$var = str_replace(" de "," dhhhe ",$var);
	return $var;
}

function resize($img, $w, $h, $newfilename) {
 //Check if GD extension is loaded
 if (!extension_loaded('gd') && !extension_loaded('gd2')) {
  trigger_error("GD is not loaded", E_USER_WARNING);
  return false;
 }

 $imgInfo = getimagesize($img);
 switch ($imgInfo[2]) {
  case 1: $im = imagecreatefromgif($img); break;
  case 2: $im = imagecreatefromjpeg($img);  break;
  case 3: $im = imagecreatefrompng($img); break;
  default:  trigger_error('Unsupported filetype!', E_USER_WARNING);  break;
 }

 if ($imgInfo[0] > $imgInfo[1]){
	$nWidth = $w;
	$nHeight = $imgInfo[1] * $nWidth / $imgInfo[0];
}else{
	$nHeight = $h;
	$nWidth = $imgInfo[0] * $nHeight / $imgInfo[1];
}
 
 
 $nWidth = round($nWidth);
 $nHeight = round($nHeight);
 
 $newImg = imagecreatetruecolor($nWidth, $nHeight);
 /* Check if this image is PNG or GIF, then set if Transparent*/  
 if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){
  imagealphablending($newImg, false);
  imagesavealpha($newImg,true);
  $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
  imagefilledrectangle($newImg, 0, 0, $nWidth, $nHeight, $transparent);
 }
 imagecopyresampled($newImg, $im, 0, 0, 0, 0, $nWidth, $nHeight, $imgInfo[0], $imgInfo[1]);
 //Generate the file, and rename it to $newfilename
 switch ($imgInfo[2]) {
  case 1: imagegif($newImg,$newfilename); break;
  case 2: imagejpeg($newImg,$newfilename);  break;
  case 3: imagepng($newImg,$newfilename); break;
  default:  trigger_error('Failed resize image!', E_USER_WARNING);  break;
 }
   return $newfilename;
}

?>
