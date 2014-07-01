<?php

/*
 *   This class was created to abstract GOOGLE UNOFFICAL API FOR TEXT TO SPEECH!
 *   Can be used for help creating features to read whole websites to speech aswell as using simple tts features.
 *   This site is helpful for blinded people to use your website.
 *
 *   Copyright (C) <2010>  Petter Kjelkenes <kjelkenes@gmail.com>
 *   Website HTTP://PKJ.NO
 *
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *
 *
 * ------- REQUIREMENTS --------
 *  * PHP 5.0 and later.
 *
 *  PLEASE KEEP ALL CREDIT INTACT.
 *  Petter Kjelkenes, PKJ.NO
 *
 */

class GoogleTTS{

    public $strings;
    private $mp3folder="../mp3_tts/";
    public $nome;
    
    private $lang='en';

    /**
      * setInput Must be run.
      * @param $texts Array, string or HTML code to translate into file bits of mp3.
      * @param $html If this should be parsed as html, set this to true. If this is an array or string to translate, put false.
      *
      */
    public function setInput($texts, $html=false){
		
        if (is_array($texts)){
            foreach($texts as $t){
                $this->strings[] = $t;
            }
        }elseif ($html==false){
            $this->strings[] = $texts;
        }elseif ($html){
            $this->parseHTMLtoStrings($texts);
        }
        

    }
    /**
      * setLang Set the language. With 2 letter code for language.
      * @param $l Language to speech... Use forexample: 'en' 'se' 'no',
      *
      */
    public function setLang($l){
        $this->lang = $l;
    }
    
    /**
      * Sets the storage path, where this class saves and caches mp3 files.
      * @param $htmlcode A whole html page, or just bits of xml / html.
      * @todo Make it have more functionality, right now it is pretty useless.
      */
    public function parseHTMLtoStrings($htmlcode){
       /* $doc = new DOMDocument();
        $doc->loadHTML($htmlcode);
        $doc->preserveWhiteSpace = false;
        $content = $doc->getElementsByTagname('body');

        foreach ($content as $item){
             echo "\n".$item->nodeValue;
        } */
        
        $str = str_replace(array("\r","\n"),' ',strip_tags($htmlcode));
        $str = trim($str);
        $strA = $this->strSplitWordFriendly($str,100);
        $this->strings = array_merge($this->strings, $strA);
    }

    /**
      * Sets the storage path, where this class saves and caches mp3 files.
      *
      */
    public function setStorageFolder($s){
        $this->mp3folder = $s;
        return true;
    }
    
    public function setNomeUser($s){
        $this->nome = $s;
        return true;
    }
    
    /**
      * Downloads mp3 file(s) to storage, saves file as md5($text), caches is and if the text bit already exists it will NOT dl it, but just move on!
      * This should not be run @ level when user is waiting on the page to load, rather add ajax call to it. Let it load in background.
      */
      
    /*  função original, para gerar nome unico
    public function downloadMP3(){
        if (!file_exists($this->mp3folder))mkdir($this->mp3folder);
        if (!file_exists($this->mp3folder))throw new Exception("You must set the storage folder for storing mp3. Current is: ".$this->mp3folder);
        foreach($this->strings as $s){
            $strA = $this->strSplitWordFriendly($s, 100);
            foreach($strA as $str){
                $filename=md5(trim(strtoupper($str))).'.mp3';

                $filepath = $this->mp3folder.$filename;
                if (!file_exists($filepath)){
                    file_put_contents($filepath, file_get_contents("http://translate.google.com/translate_tts?tl=".$this->lang."&q=".urlencode($str).""));
                }
            }


        }
        return true;
    }
    */
    
    public function downloadMP3(){ //função modificada, pra gerar nome igual ao nome do usuario
        if (!file_exists($this->mp3folder))mkdir($this->mp3folder);
        if (!file_exists($this->mp3folder))throw new Exception("You must set the storage folder for storing mp3. Current is: ".$this->mp3folder);
        foreach($this->strings as $s){
            $strA = $this->strSplitWordFriendly($s, 100);
            $i = 1;
            foreach($strA as $str){
				$filename=$this->nome.$i.'.mp3';

                $filepath = $this->mp3folder.$filename;
                if(file_exists($filepath))
					unlink($filepath);
                if (!file_exists($filepath)){
                    file_put_contents($filepath, file_get_contents("http://translate.google.com/translate_tts?ie=UTF-8&tl=".$this->lang."&q=".urlencode($str).""));
                }
                $i++;
            }


        }
        return true;
    }
    
    public function downloadMP3Sint($i){ //função modificada, pra gerar nome igual ao nome do usuario
        if (!file_exists($this->mp3folder))mkdir($this->mp3folder);
        if (!file_exists($this->mp3folder))throw new Exception("You must set the storage folder for storing mp3. Current is: ".$this->mp3folder);
        foreach($this->strings as $s){
            $strA = $this->strSplitWordFriendly($s, 100);
            foreach($strA as $str){
				$filename=$this->nome.$i.'.mp3';
                $filepath = $this->mp3folder.$filename;
                if(file_exists($filepath))
					unlink($filepath);
                if (!file_exists($filepath)){
                    file_put_contents($filepath, file_get_contents("http://translate.google.com/translate_tts?ie=UTF-8&tl=".$this->lang."&ie=utf8&q=".urlencode($str).""));
                }
                $i++;
            }
        }
        return true;
    }  

    /**
      * Gets the mp3 files from the loaded strings in array.
      *
      */
    /*
    public function getMP3s(){
        $ret = array();
        foreach($this->strings as $s){
            $strA = $this->strSplitWordFriendly($s, 100);
            foreach($strA as $str){
                $filename=md5(trim(strtoupper($str))).'.mp3';

                $filepath = $this->mp3folder.$filename;

                $ret[] = $filepath;
            }
        }
        return $ret;
    }*/
    
    public function getMP3s(){
        $ret = array();
        foreach($this->strings as $s){
            $strA = $this->strSplitWordFriendly($s, 100);
            $i = 1;
            foreach($strA as $str){
                $filename=$this->nome.$i.'.mp3';

                $filepath = $this->mp3folder.$filename;

                $ret[] = $filepath;
				$i++;
            }
        }
        return $ret;
    }
    
    public function getMP3Sint($t){
        $ret = array();
        foreach($this->strings as $s){
            $strA = $this->strSplitWordFriendly($s, 100);
            foreach($strA as $str){
                $filename=$this->nome.$t.'.mp3';

                $filepath = $this->mp3folder.$filename;

                $ret[] = $filepath;
				$t++;
            }
        }
        return $ret;
    }
    
    public function getMP3SintT($t){
        $ret = array();
        foreach($this->strings as $s){
            $strA = $this->strSplitWordFriendly($s, 100);
            foreach($strA as $str){
               $t++;
            }
        }
        return $t;
    }
    

    /**
      * Smart str_split, does not split if in a middle of a word... Goes to next file then.
      * If words are bigger then $size it will use generic str_split.
      *
      * Created because google has 100chars limit. This makes many files, and does nice splitting when it comes to words and limit of chars.
      */
    private function strSplitWordFriendly($str, $size){
        $str = trim(strip_tags($str));
        $length = strlen($str);

        $ex = explode(' ',$str);

        $op = array();

        $newarr = '';
        foreach($ex as $word){
            if (strlen(' '.$word) > $size){
                $op[] = $newarr;
                $newarr = '';
                $splitA = str_split($word, $size);
                $op = array_merge($op, $splitA);
                echo "DASS";
            }elseif (strlen($newarr.' '.$word) <= $size && !( ($size-strlen($newarr)) > $size*0.15 && strstr($newarr,'.'))   ){
                $newarr .= ' '.$word;
            }else {
                $op[] = $newarr;
                $newarr = '';
                $newarr = $word;
            }

        }
        if ($newarr)$op[] = $newarr;
        return $op;
    }
    
    
}

/**
  *  GoogleTTSHTML
  *  This class is used if you want to include ajax loading of mp3 files when loading HTML pages.
  *  What will happen is:
  *
  *  1. User vists your site. It will load the mp3 files to disk if not already exists.
  *  2. The user will get read up the text.
  *
  *
  *
  *
  **/
class GoogleTTSHTML extends GoogleTTS{
    private $jplayerloc='';
    private $jqueryLocation='';

    private $autoplay=true;

    /**
      * Sets the path to the jPlayer javasscript.
      *
      * Empty to include it yourself...
      */
    public function setJplayerLocation($s){
        $this->jplayerloc = $s;
        return true;
    }
    /**
      * Sets the path to the HotKey plugin!
      *
      * Empty to include it yourself...
      */
    /**
      * Autoplays if this is set to true, does not autoplay if false.
      * @param $bool Whenever to play the song when HTML page loads, or wait. True to play, false to not autoplay.
      *
      * Empty to include it yourself...
      */
    public function setAutoPlay($bool=true){
        $this->autoplay = $bool;
        return true;
    }
    /**
      * Sets the storage path, where this class saves and caches mp3 files.
      *
      * Empty to include it yourself...
      */
    public function setJqueryLocation($s){
        $this->jqueryLocation = $s;
        return true;
    }
    
    
    
    /**
      * getCoreScriptIncludes
      * Gets the javascript to print in your <head></head> element.
      * Returns javascript for includes and setups generic functions aswell as global javascript variables needed for the instance(s).
      * Tested Valid XHTML.
      *
      */
    public function getCoreScriptIncludes(){
        return '

        <script type="text/javascript">

        var CURRENT_AUDIO_FOR_HTML_SITE=0;
        var SONGS_FOR_HTML_SITE = new Array();
        

       	function playListNextHtmlGoogleTTS() {
              $("#jquery_jplayerHtmlGoogleTTS").jPlayer("setMedia", { mp3: SONGS_FOR_HTML_SITE[++CURRENT_AUDIO_FOR_HTML_SITE] }).jPlayer("play");
       	}

       	function playListPrevHtmlGoogleTTS() {
              $("#jquery_jplayerHtmlGoogleTTS").jPlayer("setMedia", { mp3: SONGS_FOR_HTML_SITE[--CURRENT_AUDIO_FOR_HTML_SITE] }).jPlayer("play");
       	}

        </script>
        ';
    }
    
    /**
      * helpSoundAtStart
      * Integrates help messages when a new page is reloaded, this will give user short instructions on how to use the sound system.
      *
      */

    /* function propria para retonar apenas a linha do sons */
    public function getSongs($t){
	    $mp3s = $this->getMP3Sint($t);
        $songs='';
        foreach ($mp3s as $line_num => $line)
        {
            $songs .= "SONGS_FOR_HTML_SITE.push(\"$line\" );\n"; // This line updates the script array with new entry
        }
        return $songs;	
	}
	
	/* function para retornar o javascript de ativacao do jplayer */
	public function getJPlayerActiv(){
        $ret = '
		
		//<![CDATA[
		$(document).ready(function(){

			$("#jquery_jplayerHtmlGoogleTTS").jPlayer({
				ready: function () {
					$(this).jPlayer("setMedia", {
						mp3: SONGS_FOR_HTML_SITE[CURRENT_AUDIO_FOR_HTML_SITE] 
					}).jPlayer("play");
				},
				ended: function (event) {
					playListNextHtmlGoogleTTS();
					$(this).jPlayer("play");
				},
				swfPath: "../INCLUDES/js/jPlayer",
				supplied: "mp3"
			});

		});

		//]]>
        
        ';
        return $ret;
	}
    
    /**
      * getJavaScript
      * Gets the javascript to print in your <head></head> element.
      * Returns javascript for this instance.
      * Can be run many times (one time per instance...)
      * Tested Valid XHTML.
      *
      */
    
	
    public function getJavaScript(){


        $mp3s = $this->getMP3s();
        $songs='';
        foreach ($mp3s as $line_num => $line)
        {
            $songs .= "SONGS_FOR_HTML_SITE.push(\"$line\" );\n"; // This line updates the script array with new entry
        }

        $ret = '

        <script type="text/javascript">
        '.$songs.'
		
		//<![CDATA[
		$(document).ready(function(){

			$("#jquery_jplayerHtmlGoogleTTS").jPlayer({
				ready: function () {
					$(this).jPlayer("setMedia", {
						mp3: SONGS_FOR_HTML_SITE[CURRENT_AUDIO_FOR_HTML_SITE] 
					}).jPlayer("play");
				},
				ended: function (event) {
					playListNextHtmlGoogleTTS();
					$(this).jPlayer("play");
				},
				swfPath: "../INCLUDES/js/jPlayer",
				supplied: "mp3"
			});

		});

		//]]>
        
        </script>
        ';



        return $ret;
    }
    

    
    
    

    /**
      * getPlayerDiv
      * Gets the player div, this can be invisible. It is invisible by default!
      * Run one time (NOT one time per class instance)
      * Tested Valid XHTML.
      *
      */
    public function getPlayerDiv(){
        $ret = '
        <div id="jquery_jplayerHtmlGoogleTTS"></div>
        ';
        return $ret;
    }
}





?>
