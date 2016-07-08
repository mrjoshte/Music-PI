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
			$lines[$line_num] = "mpc load \"".$_POST["playlist"]."\"";
			break;
		}
	}

	$writeBack = implode("\n", $lines);

	// Ready the file to be written to
	$myfile = fopen("/etc/init.d/randomshuffle.sh", "w") or die("Unable to open file");
	fwrite($myfile, $writeBack);
	fclose($myfile);

	echo "updated";
?>
