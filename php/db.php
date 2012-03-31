<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "db_agora");

/**
 * MYSQL DATABASE FUNCTION TO QUICKLY SELECT, DELETE, INSERT OR UPDATE
 * 
 * @param string $query
 * 
 * @return array
 * 
 * @author Gibran Malheiros <gibatronic@gmail.com>
 */

function db($query) {
	$PDO = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$query = trim($query);
	
	if (preg_match("/^SELECT/", $query)) {
		$statement = $PDO->query($query);
		
		return $statement->fetchALL(PDO::FETCH_OBJ);
	} else if (preg_match("/^(DELETE|INSERT|UPDATE)/", $query)) {
		return $PDO->exec($query);
	} else {
		return false;
	}
}