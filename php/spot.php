<?php
	session_start();

	if (!isset($_SESSION['loggedIn']))
	{
		header("Location: /login");
		exit();
	}
	
	$lines = file("/root/.config/mopidy/mopidy.conf");
	
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
