<?php
	error_reporting(E_ALL | E_WARNING | E_NOTICE);
	ini_set('display_errors', TRUE);
	
	$lines = file("/root/mopidy.conf");
	
	foreach ($lines as $line_num => $line)
	{
		if (strpos($line, "[spotify]") !== false)
		{
			$tmp = explode(" ", $lines[$line_num + 2]);
			$username = $tmp[2];
			$tmp = explode(" ", $lines[$line_num + 3]);
			$length = strlen($tmp[2]);
			break;
		}
	}
	echo $username;
?>
