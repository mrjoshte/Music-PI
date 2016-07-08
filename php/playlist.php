<?php
	session_start();

	if (!isset($_SESSION['loggedIn']))
	{
		header("Location: /login");
		exit();
	}

	$lines = file("/etc/init.d/randomshuffle.sh");

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
