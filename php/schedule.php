<?php
	//error_reporting(E_ALL | E_WARNING | E_NOTICE);
	//ini_set('display_errors', TRUE);

	$lines = file("/root/cron-file.txt");
	
	$entries = [];
	
	foreach ($lines as $line_num => $line)
	{
		if (substr($line, 0, 1) !== "#")
		{
//			echo $line."<br>";
			array_push($entries, $line);
		}
	}
	
	$parsed = [];

	for ($i = 0; $i < 5; $i++)
	{
//		echo $entries[$i]."<br>";
		$tmp = explode(" ", $entries[$i]);
//		echo $tmp[1]."<br>";
		$hour = explode("-", $tmp[1]);
//		echo $hour[0]."<br>";
//		echo date("h:i a", strtotime($hour[0].":00"))."-".date("h:i a", strtotime($hour[1].":00"))."<br><hr>";
		$runtime = [];
		$runtime["start"] = date("h a", strtotime($hour[0].":00"));
		$runtime["end"] = date("h a", strtotime($hour[1].":00")); 
		$parsed["".$i] = $runtime;
	}

	echo json_encode($parsed);	
?>
