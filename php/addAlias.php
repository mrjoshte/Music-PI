<?php
	ierror_reporting(E_ALL | E_WARNING | E_NOTICE);
	ini_set('display_errors', TRUE);

	$lines = file("/root/spotifynames");

	$aliases = [];
	
	$pieces = array($_POST["actual"], $_POST["alias"]);
	$newEntry = implode(":", $pieces);

	array_push($lines, $newEntry);

	$myfile = fopen("/root/spotifynames", "w") or die("Unable to open file");
	fwrite($myfile, $lines);
	fclose($myfile);	

	echo count($lines);
?>
