<?php
	
	require("config.php");
	require("library.php");
	
	define("CHECK_USER", "8b5b422abef67a034aac2d83f07afbcd");

	$data   = new stdClass();
	$user   = new stdClass();
	$return = new stdClass();

	if (preg_match("/^[0-9A-Z]{32}\$/i", $_POST["action"])) { 
	
		$data->action = $_POST["action"]; 
	
	}

	if ($_POST["user"] && $_POST["token"]) { 
		
		$data->user  = $_POST["user"]; 
		$data->token = $_POST["token"]; 
	
	}
    	
	switch ($data->action) {
	
		case CHECK_USER :
		
			if (count($data) && $data->token) {
				
				if ($data->user[verified] == "true") {
					
					$user->id					= existData($data->user['id']);
					$user->verified  			= isVerified($data->user['verified']);
					$user->name 				= existData($data->user['name']);
					$user->first_name 			= existData($data->user['first_name']);
					$user->last_name 			= existData($data->user['last_name']);
					$user->username 			= existData($data->user['username']);
					$user->email 				= existData($data->user['email']);
					$user->birthday 			= date('Y/m/d', strtotime(existData($data->user['birthday'])));
					$user->gender 				= gender(existData($data->user['gender']));
					$user->bio	 				= existData($data->user['bio']);
					$user->hometown 			= existData($data->user['hometown']);
					$user->location 			= existData($data->user['location']);
					$user->bio 					= existData($data->user['bio']);
					$user->work 				= existData($data->user['work']);
					$user->sports 				= existData($data->user['sports']);
					$user->favorite_teams 		= existData($data->user['favorite_teams']);
					$user->favorite_athletes	= existData($data->user['favorite_athletes']);
					$user->inspirational_people	= existData($data->user['inspirational_people']);
					$user->education			= existData($data->user['education']);
					$user->languages			= existData($data->user['languages']);
					$user->interests			= getUserData($data->token);
					$user->timezone 			= existData($data->user['timezone']);
					$user->json 				= json_encode($user);
					$user->created_date 		= date('Y/m/d h:i');
					$user->last_access 			= date('Y/m/d h:i');
					
					if (existUser($user->id)) {
					
						updateUser($user);
						$return->status 	= "Updated";
						
					} else {
					
						insertUser($user);
						$return->status 	= "Created";
					
					}
					
					$return->user		= $user;
					$return->sucess 	= true;
					$return->mensage 	= "Facebook user checked.";
					
				} else {
					
					$return->sucess  = false;
					$return->mensage = "Facebook user dont verified.";
					
				}
				
			} else {
				
				$return->sucess  = false;
				$return->mensage = "Facebook data were not received or doesn't have'a acessToken.";
				
			}
		
		break;
	
		default:

			$return->sucess  = false;
			$return->mensage = "Undefined Action.";
	
		break;
	
	}

	echo(json_encode($return));
	
?>