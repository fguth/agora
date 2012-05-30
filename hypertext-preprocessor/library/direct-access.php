<?php
/**
 * MAKE SURE THIS ISN'T A DIRECT ACCESS, ONLY ALLOW
 * THIS FILE BEING CALLED BY ANOTHER PHP
 */

if (empty($_SERVER["REDIRECT_STATUS"]) && basename($_SERVER["SCRIPT_NAME"]) == basename($_SERVER["REQUEST_URI"])) {
	header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
	
	$_SERVER["REDIRECT_STATUS"] = 404;
	
	require("error.php");
	
	exit();
}