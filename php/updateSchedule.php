<?php
	session_start();

	if (!isset($_SESSION['loggedIn']))
	{
		header("Location: /login");
		exit();
	}

	$times = json_decode($_POST['data']);

	$lines = file("/root/cron-file.txt");
	
	$index = 0;
	foreach ($lines as $line_num => $line)
	{
		if (substr($line, 0, 1) !== "#")
		{
			$index = $line_num;
			break;
		}
	}

	$j = 0;	
	for ($i = $index; $i < $index + 5; $i++)
	{
		$tmp = explode(" ", $lines[$i]);
		$end = $times[$j][1] - 1;
		$tmp[1] = $times[$j][0]."-".$end;
		$lines[$i] = implode(" ", $tmp);
		$j++;
	}

	$j = 0;
	for ($i = $index + 6; $i < $index + 11; $i++)
	{
		$tmp = explode(" ", $lines[$i]);
		$tmp[1] = $times[$j][1];
		$lines[$i] = implode(" ", $tmp);
		$j++;
	}

	foreach ($lines as $line_num => $line)
	{
		$lines[$line_num] = str_replace("\n", "", $line);
	}

	$writeback = implode("\n", $lines);

	$myfile = fopen("/root/cron-file.txt", "w") or die("Unable to open file");
	fwrite($myfile, $writeback);
	fclose($myfile);

	exec("/root/chCron");

	echo "updated";	
?>
