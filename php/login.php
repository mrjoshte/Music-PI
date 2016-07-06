<?php
	error_reporting(E_ALL | E_WARNING | E_NOTICE);
	ini_set('display_errors', TRUE);

	session_start();
	
	$user = htmlspecialchars($_POST['user']);
	$pass = htmlspecialchars($_POST['pwd']);

	if (
?>
