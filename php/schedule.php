<?php
	$lines = file("/root/cron-file.txt");
	
	$entries = [];
	
	foreach ($lines as $line_num => $line)
	{
		if (substr($line, 0, 1) !== "#")
		{
			array_push($entries, $line);
		}
	}
	
	$parsed = [];

	for ($i = 0; $i < 5; $i++)
	{
		$tmp = explode(" ", $entries[$i]);
		$hour = explode("-", $tmp[1]);
		$runtime = [];
		$runtime["start"] = $hour[0];
		$runtime["end"] = $hour[1]+1;
		$parsed["".$i] = $runtime;
	}

	echo json_encode($parsed);	
?>
