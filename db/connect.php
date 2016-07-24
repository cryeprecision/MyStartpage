<?php
	//Datenbank parameter [loc -> location]
	$db_name = "facebin";
	$db_pass = "anoninternet";
	$db_user = "facebin";
	$db_loc  = "localhost";

	//Create connection
	$sqli = new mysqli($db_loc, $db_user, $db_pass, $db_name);

	if ($sqli->connect_error){
		return 'Failed to connect to database:<br>' . sqli_connect_error();
	}
?>