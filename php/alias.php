<?php
	error_reporting(E_ALL | E_WARNING | E_NOTICE);
	ini_set('display_errors', TRUE);

	$lines = file("/root/spotifynames");

	$aliases = [];
	
	foreach ($lines as $line_num => $line)
	{
		$line = str_replace("\n","",$line);
		$alias = explode(":", $line);
		$aliases[$alias[0]] = $alias[1];
	}

	echo json_encode($aliases);
?>
