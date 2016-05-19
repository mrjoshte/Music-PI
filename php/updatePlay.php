<?php
	error_reporting(E_ALL | E_WARNING | E_NOTICE);
	ini_set('display_errors', TRUE);

	$play = "stuff";	

	$lines = file("/root/randomshuffle.sh");

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
	$myfile = fopen("/root/randomshuffle.sh", "w") or die("Unable to open file");
	fwrite($myfile, $writeBack);
	fclose($myfile);

	echo "updated";
?>
