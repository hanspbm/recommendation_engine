<?php
	$server = "localhost";
	$user	= "root";
	$password = "Xetsum3i";
	$table = "recommendation_engine";

	mysql_connect($server, $user, $password) or die(mysql_error());
	mysql_select_db($table) or die(mysql_error());
?>
    