<?php
/**
 * SIMPLE FUNCTION TO MANIPULATE DATABASE DATA
 */

function db($query) {
	$PDO = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$query = trim($query);

	if (preg_match("/^SELECT/", $query)) {
		$statement = $PDO->query($query);
		
		if ($PDO->errorCode() == "0000") {
			return $statement->fetchALL(PDO::FETCH_OBJ);
		} else {
			trigger_error(print_r($PDO->errorInfo(), true) . chr(10) . $query, E_USER_ERROR);
		}
	} else if (preg_match("/^(DELETE|INSERT|UPDATE)/", $query)) {
		$PDO->exec($query);
		
		if ($PDO->errorCode() == "0000") {
			return $PDO->lastInsertId();
		} else {
			trigger_error(print_r($PDO->errorInfo(), true) . chr(10) . $query, E_USER_ERROR);
		}
	} else {
		return false;
	}
}