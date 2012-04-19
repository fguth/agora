<?php

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

?>