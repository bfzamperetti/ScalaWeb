<?php
/* pagina extra, onde eh possivel enviar uma string por GET e a pagina sintetiza utilizando uma classe do Google.
 * 
 * */

include ('googleTTSphp.class.php');
$ds = new GoogleTTSHTML;
$ds->setStorageFolder('mp3_tts/');
$ds->setLang('pt');
$ds->setAutoPlay(true);

$ds->setInput(array(utf8_decode($_GET['str']));

// Downloads the Mp3, If the text is large,
// NOTE! the first time it will take some time before they are downloaded and page is ready. When done, they will not need to be downloaded and page will load fast.
$ds->downloadMP3();


echo '<html><head>

   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
	<script type="text/javascript" src="js/jPlayer/jquery.jplayer.min.js"></script>
	</head><body>';
?>

<?php echo $ds->getCoreScriptIncludes() /* Only include one time, even if you have many class instances... */?>
<?php echo $ds->getPlayerDiv() /*Only include one time, even if you have many class instances. This div is needed and can be included anywhere on your page. */ ?>
<?php echo $ds->getJavaScript() /* Gets javascript for this instance ($ds here...) */?>
<?php echo '</body></html>';
