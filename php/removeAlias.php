<?php
	session_start();

	if (!isset($_SESSION['loggedIn']))
	{
		header("Location: /login");
		exit();
	}

	$lines = file("/spotifynames");

	$aliases = [];
	
	$key = "bob";

	foreach ($lines as $line_num => $line)
	{
		$line = str_replace("\n","",$line);
		$alias = explode(":", $line);
		$aliases[$alias[0]] = $alias[1];
	}

	unset($aliases[$_POST["key"]]);

	$back = [];
	$i = 0;
	foreach (array_keys($aliases) as $key)
	{
		$tmp = array($key, $aliases[$key]);
		$write = implode(":", $tmp);
		$back[$i] = $write;
		$i++;
	}
	$writeBack = implode("\n", $back);
	
	// Ready the file to be written to
	$myfile = fopen("/spotifynames", "w") or die("Unable to open file");
	fwrite($myfile, $writeBack);
	fclose($myfile);

	echo "updated";
?>
