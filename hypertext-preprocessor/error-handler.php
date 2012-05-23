<?php
/**
 * HANDLE ALL ERROS THAT MAY OCCUR EXPECT FOR E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR AND E_COMPILE_WARNING THAT IS UNCATCHABLE D:
 */

function errorHandler($type, $text, $file, $line) {
	header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error", true, 500);
	
	$error = new stdClass();
	$folder = "";
	$path = array();
	$root = "";
	
	$error->type = $type;
	$error->text = $text;
	$error->file = $file;
	$error->line = $line;
	
	$_SERVER["REDIRECT_STATUS"] = 500;
	$_SERVER["REDIRECT_STATUS_ERROR"] = $error;
	
	$path = explode(DIRECTORY_SEPARATOR, $_SERVER["PHP_SELF"]);
	
	array_shift($path);
	array_pop($path);
	
	foreach ($path as $folder) {
		$root .= "../";
	}
	
	require($root . "error.php");
	
	exit();
}

error_reporting(E_ALL ^ E_NOTICE);
set_error_handler("errorHandler", E_ALL);