<?php

    //Purpose: launch DB
    //Copyright Mad Rockers (Evan K) 2017.

    //Pre-Requirements: REQUIRED-NONE

    //Note(s):
    //This provides global access to the database madrockers, start switching other files to use this
	
	if (defined("_MRDB_PHP_"))
		die("mrdb.php repeat");
	define("_MRDB_PHP_", true);

	$GLOBALS['mrdb'] = new mysqli("localhost", "web", "g5843g87y334g9j0h8e5", "web");
    if ($GLOBALS['mrdb']->connect_error) {die("An error has occured.");} 

	try {
		$pdo = new PDO("mysql:dbname=web;host=localhost", "web", "g5843g87y334g9j0h8e5");
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$GLOBALS['mrdb_pdo'] = $pdo;
	}
	catch (PDOException $e) {
		die("An error has occurred. (mrDb / 2)");
	}
    
?>