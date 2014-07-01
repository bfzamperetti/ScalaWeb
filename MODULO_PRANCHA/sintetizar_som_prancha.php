<?php
/* Para a sintese de audio, foi utilizada uma classe desenvolvida pelo Google.
 * Nesta pagina a classe e chamada. Ela pega uma string e cria um arquivo mp3 a partir dela, na pasta mp3_tts/
 * 
 * */
session_start();

/* verificar se ja existe som salvo para esta imagem */

include ('../INCLUDES/googleTTSphp.class.php');
include_once('../INCLUDES/uses.php');
$ds = new GoogleTTSHTML;
$ds->setStorageFolder('../mp3_tts/');
$ds->setNomeUser($_SESSION['nome']);

$ds->setLang('pt');
$ds->setAutoPlay(true);

header("Content-Type: text/html; charset=utf-8",true);

include ('../INCLUDES/conecta.php');
$img_id1 = end(explode("/",$_SESSION['pathimg_prancha'.$_GET['id'].'_qdr'.$_SESSION['quadro_atual']]));
$img_id = explode(".",$img_id1);
$sql = 'SELECT * FROM som_usuario WHERE id_imagem = '.$img_id[0].' and id_usuario = '.$_SESSION['id'];
$qry = pg_query($sql);
if ($som = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
	echo '<html><head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
		<script type="text/javascript" src="../INCLUDES/js/jPlayer/jquery.jplayer.min.js"></script>
		</head><body>
	<script>
	$(document).ready(function(){
 $("#jquery_jplayer_1").jPlayer({
  ready: function () {
   $(this).jPlayer("setMedia", {
    mp3: "'.$_SESSION['url_sons_usuario'].$som['caminho'].'"
   }).jPlayer("play");
  },
  swfPath: "../INCLUDES/js/jPlayer",
  supplied: "mp3"
	});
	});
 	</script>
	<div id="jquery_jplayer_1"></div>
</body></html>';
	
}
else{

// Nesta linha e enviada a string a ser sintetizada.
$ds->setInput(array(arrumaSintetizar($_SESSION['nome_prancha'.$_GET['id'].'_qdr'.$_SESSION['quadro_atual']])));

// Downloads the Mp3, If the text is large,
// NOTE! the first time it will take some time before they are downloaded and page is ready. When done, they will not need to be downloaded and page will load fast.
$ds->downloadMP3();


echo '<html><head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
	<script type="text/javascript" src="../INCLUDES/js/jPlayer/jquery.jplayer.min.js"></script>
	</head><body>';

 echo $ds->getCoreScriptIncludes(); /* Only include one time, even if you have many class instances... */
 echo $ds->getPlayerDiv(); /*Only include one time, even if you have many class instances. This div is needed and can be included anywhere on your page. */ 
 echo $ds->getJavaScript(); /* Gets javascript for this instance ($ds here...) */
 echo '</body></html>';
}
?>
