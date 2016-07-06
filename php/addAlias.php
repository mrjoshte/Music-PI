<?php
	error_reporting(E_ALL | E_WARNING | E_NOTICE);
	ini_set('display_errors', TRUE);

	session_start();

	if (!isset($_SESSION['loggedIn']))
	{
		header("Location: /login");
		exit();
	}

	$lines = file("/root/spotifynames");

	$aliases = str_replace("\n", "", $lines);
	
	$pieces = array($_POST["actual"], $_POST["alias"]);
	$newEntry = implode(":", $pieces);

	array_push($aliases, $newEntry);

	$writeBack = implode("\n", $aliases);

	$myfile = fopen("/root/spotifynames", "w") or die("Unable to open file");
	fwrite($myfile, $writeBack);
	fclose($myfile);	

	echo count($lines);
?>
