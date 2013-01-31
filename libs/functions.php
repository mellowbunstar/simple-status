<?php
require 'libs/mysql.class.php';
$mysql = new mysql();
 
function relative($time,$offset) {
    $time = strtotime($time) + ($offset * 60 * 60);
	$gap = time() - $time;
    if ($gap < 60) {
        return '1m';
    }
    $gap = round($gap / 60);
    if ($gap < 60)  { 
        return $gap.'m';
    }
    $gap = round($gap / 60);
    if ($gap < 24)  { 
        return $gap.'h';
    }
    return date('j M', $time);
}

function escape($str) {
	if (get_magic_quotes_gpc()) $str = stripslashes($str);
	return mysql_real_escape_string($str);
}

function clean($input) {
	$input = escape(htmlspecialchars(trim($input)));
	return $input;
}

function alert($text,$type) {
	echo '<p class="alert alert-' . $type . '" fade in>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		' . $text . '
	</p>'."\r\n";
}

function linkify($text) {
  // linkify URLs
  $text = preg_replace('/(https?:\/\/\S+)/', '<a href="\1">\1</a>', $text);

  // linkify tags
  $text = preg_replace('/(^|\s)#(\w+)/','\1<a href="/index.php?q=%23\2">#\2</a>',$text);
  
  return $text;
}