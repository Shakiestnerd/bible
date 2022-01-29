<?php

// changed to isset function to clear invalid index error 6/28/2011
if (isset($_GET['lang'])) {
	$lang = $_GET['lang'];
  $expire=time()+60*60*24*30;
	setcookie("lang", $lang, $expire);	
}

function check_lang(&$lang) { 
	//make sure that we have a language selected by using session .. 
  if (!isset($_COOKIE['lang'])) { 
  /* you can either show error message and terminate script 
    die('No language was selected! please go back and choose a langauge!');*/ 
  //or set a default language 
    if ($lang == '') { $lang = 'en'; }
    $expire=time()+60*60*24*30;
		setcookie("lang", $lang, $expire);
  } else { 
    $lang = $_COOKIE['lang']; 
  } 

//directory name 
  $dir = 'languages'; 

//no we return the langauge wanted ! 
//Returned String Format: dirname/filename.ext 
  return "$dir/$lang.lng"; 
} 

?>
