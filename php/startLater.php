<?php
	error_reporting(E_ALL | E_WARNING | E_NOTICE);
	ini_set('display_errors', TRUE);

	session_start();

	if (!isset($_SESSION['loggedIn']))
	{
		header("Location: /login");
		exit();
	}

	$startTime = $_POST["start"];
	$endTime = $_POST["end"];

	exec("/root/startLater ".$starTime);
	sleep(2);
	exec("/root/killLater ".$endTime);
?>
