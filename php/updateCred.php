<?php
	session_start();

	if (!isset($_SESSION['loggedIn']))
	{
		header("Location: /login");
		exit();
	}

	// Get all lines of the config file into an array
	$contents = file_get_contents("/root/.config/mopidy/mopidy.conf");
	
	$lines = explode("\n", $contents);

	// Find the Spotify section and update the username and password
	foreach ($lines as $line_num => $line)
	{
		if (strpos($line, "[spotify]") !== false)
		{
			$tmp = explode(" ", $lines[$line_num + 2]);
			$tmp[2] = $_POST["user"];
			$line = implode(" ", $tmp);
			$lines[$line_num + 2] = $line;
			
			$tmp = explode(" ", $lines[$line_num + 3]);
			$tmp[2] = $_POST["pass"];
			$line = implode(" ", $tmp);
			$lines[$line_num + 3] = $line;

			break;
		}
	}
	$writeBack = implode("\n", $lines);

	// Ready the file to be written to
	$myfile = fopen("/root/.config/mopidy/mopidy.conf", "w") or die("Unable to open file");
	fwrite($myfile, $writeBack);
	fclose($myfile);

	exec("/root/killMopidy");
	sleep(10);
	exec("/root/startMopidy > /dev/null 2>&1");

	echo "updated";
?>
