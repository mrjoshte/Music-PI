<?php
	error_reporting(E_ALL | E_WARNING | E_NOTICE);
	ini_set('display_errors', TRUE);

	echo shell_exec("whoami")."<br>";
	//$output = "";
	echo exec("at -f /root/kill.txt -v 1652")."<br>";
	//echo exec("/root/kill.txt");
	//echo $output;
//	echo exec("atq");
	//echo $output;
	echo "fuck";
?>
