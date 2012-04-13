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
	
	function getUserData($token) {
	
		$return->music 			= json_decode(file_get_contents("https://graph.facebook.com/me/music?access_token=" . $token));
		$return->books 			= json_decode(file_get_contents("https://graph.facebook.com/me/books?access_token=" . $token));
		$return->television 	= json_decode(file_get_contents("https://graph.facebook.com/me/television?access_token=" . $token));
		$return->activities 	= json_decode(file_get_contents("https://graph.facebook.com/me/activities?access_token=" . $token));
		$return->interests 		= json_decode(file_get_contents("https://graph.facebook.com/me/interests?access_token=" . $token));
		$return->movies 		= json_decode(file_get_contents("https://graph.facebook.com/me/movies?access_token=" . $token));
		
		return $return;
		
	}
	
	function existData($data) {
		
		if (empty($data)) { $data = null; }
		
		return $data;
		
	}
	
	function insertUser($user) {
		db("INSERT INTO 
					users (id,name,first_name,last_name,username,email,gender,birthday,timezone,verified,json,created_date,last_access) 
			VALUES ('" . $user->id . "',
					'" . $user->name . "',
					'" . $user->first_name . "',
					'" . $user->last_name . "',
					'" . $user->username . "',
					'" . $user->email . "',
					'" . $user->gender . "',
					'" . $user->birthday . "',
					'" . $user->timezone . "',
					'" . $user->verified . "',
					'" . $user->json . "',
					'" . $user->created_date . "',
					'" . $user->last_access . "')
		");
	}
	
	function updateUser($user) {
		db("UPDATE users SET 
						 	name = '" . $user->name . "',
							first_name = '" . $user->first_name . "',
							last_name = '" . $user->last_name . "',
							username = '" . $user->username . "',
							email = '" . $user->email . "',
							gender = '" . $user->gender . "',
							birthday = '" . $user->birthday . "',
							timezone = '" . $user->timezone . "',
							verified = '" . $user->verified . "',
							json = '" . $user->json . "',
							last_access = '" . $user->last_access . "' 
						WHERE
							id ='" . $user->id . "'
		");
	}
	
	function existUser($id) {
		
		return count(db("SELECT id FROM users WHERE id = " . $id)) == 1 ? true : false;
		
	}
	
	function isVerified($verify) {
		
		return $verify == "true" ? 1 : 0;
		
	}
	
	function gender($type) {
		
		return $type == "male" ? 1 : 2;
		
	}

?>