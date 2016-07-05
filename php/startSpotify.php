<?php
	error_reporting(E_ALL | E_WARNING | E_NOTICE);
	ini_set('display_errors', TRUE);

	$endTime = $_POST["end"];

	exec("/root/startMopidy");

	exec("/root/killLater ".$endTime);
?>
