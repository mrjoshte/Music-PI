<?php
	session_start();

	if (!isset($_SESSION['loggedIn']))
	{
		header("Location: /login");
		exit();
	}

	$lines = file("/spotifynames");

	$aliases = str_replace("\n", "", $lines);
	
	$pieces = array($_POST["actual"], $_POST["alias"]);
	$newEntry = implode(":", $pieces);

	array_push($aliases, $newEntry);

	$writeBack = implode("\n", $aliases);

	$myfile = fopen("/spotifynames", "w") or die("Unable to open file");
	fwrite($myfile, $writeBack);
	fclose($myfile);	

	echo count($lines);
?>
