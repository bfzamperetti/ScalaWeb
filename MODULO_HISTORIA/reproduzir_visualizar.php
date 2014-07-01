<?php
/* Para a sintese de audio, foi utilizada uma classe desenvolvida pelo Google.
 * Nesta pagina a classe e chamada. Ela pega uma string e cria um arquivo mp3 a partir dela, na pasta mp3_tts/
 * 
 * */
session_start();
include ('../INCLUDES/googleTTSphp.class.php');
include ('../INCLUDES/conecta.php');
include ('../INCLUDES/uses.php');

//cria uma string com o nome de todas as pranchas do quadro, separadas por virgula
$str = '';
for ($i = 0; isset($_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_narracao']); $i++){
	$str.= $_SESSION['qdr'.$_SESSION['hist_quadro_atual'].'_quadrinho'.$i.'_narracao'].", ";
}
$ds = new GoogleTTSHTML;
$ds->setStorageFolder('../mp3_tts/');
$ds->setNomeUser($_SESSION['nome']);

$ds->setLang('pt');
$ds->setAutoPlay(true);
//envia a string para ser sintetizada
$ds->setInput(array(arrumaSintetizar($str)));

// Downloads the Mp3, If the text is large,
// NOTE! the first time it will take some time before they are downloaded and page is ready. When done, they will not need to be downloaded and page will load fast.
$ds->downloadMP3Sint($t);

$sons .= $ds->getSongs($t);
$t = $ds->getMP3SintT($t);
			

echo '<html><head>

   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
	<script type="text/javascript" src="../INCLUDES/js/jPlayer/jquery.jplayer.min.js"></script>
	</head><body>';

 echo $ds->getCoreScriptIncludes(); /* Only include one time, even if you have many class instances... */
 echo $ds->getPlayerDiv(); /*Only include one time, even if you have many class instances. This div is needed and can be included anywhere on your page. */ 
 echo '<script> ';
 echo $sons;
 echo $ds->getJPlayerActiv(); /* Gets javascript for this instance ($ds here...) */
 echo '</script>';
 echo '</body></html>';
?>

