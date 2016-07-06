<?php
	session_start();

	if (!isset($_SESSION['loggedIn']))
	{
		header("Location: /login");
		exit();
	}

	header("Location: /admin");
?>
