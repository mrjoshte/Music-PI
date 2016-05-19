<?php
	error_reporting(E_ALL | E_WARNING | E_NOTICE);
	ini_set('display_errors', TRUE);
	
	$lines = file("/root/randomshuffle.sh");

	foreach ($lines as $line_num => $line)
	{
		if (strpos($line, "mpc load") !== false)
		{
			$start = strpos($line, "load ") + 6;
			$end = strpos($line, "\n") - 1;
			$length = $end - $start;
			$playlist = substr($line, $start, $length);
			echo $playlist;
			break;
		}
	}
?>
