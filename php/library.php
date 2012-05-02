<?php
/**
 * SIMPLE MYSQL DATABASE FUNCTION TO QUICKLY SELECT, DELETE, INSERT OR UPDATE
 * 
 * @param string $query
 * 
 * @return boolean|integer|object[]
 */

function db($query) {
	$PDO = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$query = trim($query);

	if (preg_match("/^\s*SELECT/", $query)) {
		$statement = $PDO->query($query);
		
		if ($PDO->errorCode() == "0000") {
			return $statement->fetchALL(PDO::FETCH_OBJ);
		} else {
			trigger_error(print_r($PDO->errorInfo(), true) . chr(10) . $query, E_USER_ERROR);
		}
	} else if (preg_match("/^\s*(DELETE|INSERT|UPDATE)/", $query)) {
		$PDO->exec($query);
		
		if ($PDO->errorCode() == "0000") {
			if (preg_match("/^\s*INSERT/", $query)) {
				return $PDO->lastInsertId();
			} else {
				return true;
			}
		} else {
			trigger_error(print_r($PDO->errorInfo(), true) . chr(10) . $query, E_USER_ERROR);
		}
	} else {
		return false;
	}
}

/**
 * CONVERT ANY SHIT TO A SEARCH ENGINE FRIENDLY NAME
 * 
 * @param string $name
 * 
 * @return string
 * 
 * @example
 * sef("Bob's Place") will output bobs-place
 */

function sef($name) {
	$name = mb_strtolower($name, "UTF-8");
	$name = str_replace(array(" ", "à", "á", "â", "ã", "ä", "å", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï", "ñ", "ò", "ó", "ô", "õ", "ö", "ù", "ú", "û", "ü", "ý"), array("-", "a", "a", "a", "a", "a", "a", "c", "e", "e", "e", "e", "i", "i", "i", "i", "n", "o", "o", "o", "o", "o", "u", "u", "u", "u", "y"), $name);
	$name = preg_replace("/[^a-z-]/", "", $name);
	
	return $name;
}