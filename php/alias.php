<?php
	session_start();

	if (!isset($_SESSION['loggedIn']))
	{
		header("Location: /login");
		exit();
	}

	$lines = file("/spotifynames");

	$aliases = [];
	
	foreach ($lines as $line_num => $line)
	{
		$line = str_replace("\n","",$line);
		$alias = explode(":", $line);
		$aliases[$alias[0]] = $alias[1];
	}

	echo json_encode($aliases);
?>
