<?php
require 'mysql.class.php';
$mysql = new mysql();

define('TODAY', gmdate("Y-m-d H:i:s"));

function relative($time) {
    $time = strtotime($time);
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

function post($id, $user, $body, $date) {
	echo '<div class="post" id="post-' . $id . '">
		<a href="index.php?delete=' . $id . '" class="close" title="Delete this post?">&times;</a>
		<h4>
			<i class="icon-github-alt icon-2x"></i>
			' . $user . '
		</h4>
		<p class="body">' . linkify($body) . '</p>
		<p class="time muted">Posted ' . relative($date) . ' ago.</p>
	</div>'."\r\n";
}