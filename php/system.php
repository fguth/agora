<?php
	
	require("config.php");
	require("library.php");
	require("user.class.php");
	
	define("CHECK_USER", "8b5b422abef67a034aac2d83f07afbcd");

	$system   	= new stdClass();
	$user		= new User();

	if (preg_match("/^[0-9A-Z]{32}\$/i", $_POST["action"])) {
		$system->action = $_POST["action"]; 
	}

	if ($_POST["user"] && $_POST["token"]) { 
		$user->token($_POST["token"]);
		$user->data($_POST["user"]);
	}
    	
	switch ($system->action) {
	
		case CHECK_USER :
		
			if ($user->validate()) {
				
				if ($user->exist()) {
					$user->update();
					$system->return->action = "Update";
				} else {
					$user->create();
					$system->return->action = "Create";
				}
	
				$system->return->user		= $user;
				$system->return->sucess 	= true;
				$system->return->mensage 	= "User validated.";
				
			} else {
	
				$system->return->sucess  = false;
				$system->return->mensage = "User data or/and token error.";
	
			}
				
		break;
	
		default:

			$system->return->sucess  = false;
			$system->return->mensage = "Undefined Action.";
	
		break;
	
	}

	echo(json_encode($system->return));
	
?>