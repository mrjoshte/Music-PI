<?php
	error_reporting(E_ALL | E_WARNING | E_NOTICE);
	ini_set('display_errors', TRUE);
	
	$lines = file("/root/.config/mopidy/mopidy.conf", FILE_SKIP_EMPTY_LINES);

	foreach ($lines as $line_num => $line)
	{
		//if (strpos($line, 'username') !== false)
		//{
			echo $line."<br>";
		//}
		//if (strpos($line, 'password') !== false)
		//{
		//	echo $line."<br>";
		//}
	}

?>
