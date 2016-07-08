<?php
	session_start();

	if (!isset($_SESSION['loggedIn']))
	{
		header("Location: /login");
		exit();
	}

	$endTime = $_POST["end"];

	exec("/root/startMopidy > /dev/null 2>&1");

	exec("/root/killLater ".$endTime);
?>
