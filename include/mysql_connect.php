<?php
	$db_host = "localhost";
	$db_username = "username";
	$db_pass = "password";
	$db_name = "databasename";

	($GLOBALS["___mysqli_ston"] = mysqli_connect($db_host,  $db_username,  $db_pass)) or die ("Could not connect connect to MySQL Server");
	((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE $db_name")) or die ("No database");
	mysqli_set_charset($GLOBALS["___mysqli_ston"], 'utf8');
?>
