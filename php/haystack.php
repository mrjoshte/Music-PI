<?php
	error_reporting(E_ALL | E_WARNING | E_NOTICE);
	ini_set('display_errors', TRUE);
	
	$lines = file_get_contents("/root/.config/mopidy/mopidy.conf");

	$part = strstr($lines, "[spotify]");
	
	echo $part;
?>
