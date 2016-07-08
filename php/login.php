<?php
	error_reporting(E_ALL | E_WARNING | E_NOTICE);
	ini_set('display_errors', TRUE);

//	include("config.php");
	session_start();

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'rootOfMysql');
	define('DB_DATABASE', 'MY_DB');
	$db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

	
	//if ($_SERVER["REQUEST_METHOD"] == "POST")
	//{
		$user = $_POST['user'];
		$pass = $_POST['pwd'];

//		error_log("given user: ".$user." given pass: ".$pass, 3, "/var/www/log.txt");

		$request = "SELECT id FROM Passwords WHERE user='".$user."' and pass='".$pass."'";
		$result = $db->query($request);

//		error_log(" db pass: ".$dbPass->fetch_assoc()["pass"]."\n", 3, "/var/www/log.txt");

//		if ($dbPass->fetch_assoc()["pass"] === $pass)
		if ($result->num_rows > 0)
		{
			error_log("yay, good!\n", 3, "/var/www/log.txt");
			$_SESSION['loggedIn'] = true;
			header("Location: /admin");
			exit();
		}
		else
		{
			header("Location: /login");
		}
	//}
?>
