<?php

	if (defined("_SCOUT_CONFIG_PHP_")) {
		die("scoutConfig.php included more than once");
	}

	$scoutSecureMode = false;

	if ($scoutSecureMode) {
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	}


	define('SCOUT_PATH', dirname(__FILE__)."/");

	define("_SCOUT_CONFIG_PHP_", true);

	require(SCOUT_PATH."../sitescript/mrDb.php");

	$scoutPDO = $GLOBALS['mrdb_pdo'];

	function placeStandardHeader() {
		require("standardHeader.php");
	}

?>
