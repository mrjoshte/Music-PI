<?php
	error_reporting(E_ALL | E_WARNING | E_NOTICE);
	ini_set('display_errors', TRUE);

	$startTime = $_POST["start"];
	$endTime = $_POST["end"];

	exec("/root/startLater ".$starTime);

	exec("/root/killLater ".$endTime);
?>
