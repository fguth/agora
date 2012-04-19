<?php
function errorHandler($type, $text, $file, $line) {
	header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error", true, 500);
	
	$error = new stdClass();
	
	$error->type = $type;
	$error->text = $text;
	$error->file = $file;
	$error->line = $line;
	
	$_SERVER["REDIRECT_STATUS"] = 500;
	$_SERVER["REDIRECT_STATUS_ERROR"] = $error;
	
	require("../error.php");
	
	exit();
}

error_reporting(E_ALL ^ E_NOTICE);
set_error_handler("errorHandler");