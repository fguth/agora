<?php
	
	require("config.php");
	require("library.php");
	require("user.class.php");
	require("candidate.class.php");
	
	define("CHECK_USER", "8b5b422abef67a034aac2d83f07afbcd");
	define("SUPPORT", "256fc6e4dbf98308ceca2b9b924b25af");
	define("UNSUPPORT", "89e3d438a10459f93076b8750c1a664f");

	$system   	= new stdClass();
	$user		= new User();
	$candidate  = new Candidate();

	if (preg_match("/^[0-9A-Z]{32}\$/i", $_POST["action"])) {
		$system->action = $_POST["action"]; 
	}

	if ($_POST["token"]) { 
		$user->token($_POST["token"]);
	}

	if ($_POST["user"]) { 
		$user->data($_POST["user"]);
	}
	
	if ($_POST["candidate_id"]) { 
		$candidate->id($_POST["candidate_id"]);
	}
	
	if ($_POST["user_id"]) { 
		$user->id($_POST["user_id"]);
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
		
		case SUPPORT :
			
			$system->return->action = "Support";
			
			if ($user->exist($user->id)) {
				
				if (/*$candidate->exist()*/1 == 1) {
					
					//$candidate->support($user->id);
					$system->return->candidate_id = $candidate->id();
					$system->return->sucess  = true;
					$system->return->mensage = "Candidate supported.";
					
				} else {
					$system->return->sucess  = false;
					$system->return->mensage = "Candidate doesnt exist.";
				}
	
				$system->return->user = $user;
				
			} else {
	
				$system->return->sucess  = false;
				$system->return->mensage = "User validated or/and token error.";
	
			}
				
		break;
		
		case UNSUPPORT :
		
			$system->return->action = "Unsupport";
			
			if ($user->exist($user->id)) {
				
				if (/*$candidate->exist()*/1 == 1) {
					
					$system->return->support_id   = $candidate->unsupport($user->id);
					$system->return->candidate_id = $candidate->id();
					$system->return->sucess  = true;
					$system->return->mensage = "Candidate unsupported.";
					
				} else {
					$system->return->sucess  = false;
					$system->return->mensage = "Candidate doesnt exist.";
				}
	
				$system->return->user = $user;
				
			} else {
	
				$system->return->sucess  = false;
				$system->return->mensage = "User validated or/and token error.";
	
			}
				
		break;
	
		default:

			$system->return->sucess  = false;
			$system->return->mensage = "Undefined Action.";
	
		break;
	
	}

	echo(json_encode($system->return));
	
?>