<?php
require("../config.php");	
require("functions.php");
require("../classes/user.class.php");
require("../classes/candidate.class.php");

define("SET_HOMETOWN", "dc82dd58115798afdb98d8ea2efefbc3");
define("CANDIDATES_LIST", "75720f54472ffabfca3fcb0a08e19bd9");
define("CHECK_USER", "8b5b422abef67a034aac2d83f07afbcd");
define("SUPPORT", "256fc6e4dbf98308ceca2b9b924b25af");
define("UNSUPPORT", "89e3d438a10459f93076b8750c1a664f");

$system = new stdClass();

// GRAB DATA PASSED TROUGHT $_POST

// PAGE REQUEST

if (preg_match("/^[0-9A-Z]{32}\$/i", $_REQUEST["action"])) {
	$system->action = $_REQUEST["action"]; 
}

if (preg_match("/^[0-9]+\$/", $_REQUEST["city_id"])) { 
	$system->city_id = (integer) $_REQUEST["city_id"];
}

if ($_REQUEST["filter"]) { 
	$system->filter = $_REQUEST["filter"];
}

if (preg_match("/^[0-9]+\$/", $_REQUEST["limit"])) { 
	$system->limit = (integer) $_REQUEST["limit"];
} else {
	$system->limit = 8;
}

if (preg_match("/^[0-9]+\$/", $_REQUEST["post_id"])) { 
	$system->post_id = (integer) $_REQUEST["post_id"];
}

if (preg_match("/^[0-9]+\$/", $_REQUEST["start"])) { 
	$system->start = (integer) $_REQUEST["start"];
} else {
	$system->start = 0;
}

// CANDIDATE REQUEST

if ($_REQUEST["candidate_id"]) { 
	$system->candidate_id = $_REQUEST["candidate_id"];
}

// USER REQUEST

if ($_REQUEST["user_token"]) { 
	$system->user_token = $_REQUEST["user_token"];
}

if ($_REQUEST["user_data"]) { 
	$system->user_data = $_REQUEST["user_data"];
}

if ($_REQUEST["user_id"]) { 
	$system->user_id = $_REQUEST["user_id"];
}

// HOME TOWN

if ($_REQUEST["city_id"]) { 
	$system->city_id = $_REQUEST["city_id"];
}

// SWITCH ACTIONS

switch ($system->action) {
	// GET CANDIDATES INFO
	case CANDIDATES_LIST:
		$candidates = db("CALL user_supported_candidates(" . ELLECTION_YEAR . ", " . $system->user_id . ", " . ($system->city_id ? "'" . $system->city_id . "'" : "NULL") . ", " . ($system->post_id ? "'" . $system->post_id . "'" : "NULL") . ", " . ($system->filter ? "'" . $system->filter . "'" : "NULL") . ", " . $system->start . ", " . $system->limit . ")");

		// DONE, POPULATE THE BUFFER
		$system->return->sucess = true;
		$system->return->candidates = $candidates;
		$system->return->filter = $system->filter;
		$system->return->limit = $system->limit;
		$system->return->start = $system->start;
		
		break;
	case SUPPORT:
		
		$system->return->action = "Support";
		
		$user = new User($system->user_id,$system->user_token);
		
		if ($user->exist()) {
			
			$candidate = new Candidate();
			
			if (/*$candidate->exist($system->candidate_id)*/1 == 1) {
				
				//$candidate->support($system->user_id);
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
	
	case UNSUPPORT:
	
		$system->return->action = "Unsupport";
		
		$user = new User($system->user_id,$system->user_token);
		
		if ($user->exist()) {
			
			$candidate = new Candidate();
			
			if (/*$candidate->exist($system->candidate_id)*/1 == 1) {
				
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
	
	case SET_HOMETOWN:
	
		$system->return->action = "Hometown";
		
		$user = new User($system->user_id,$system->user_token);
		
		if ($user->exist()) {
			$system->return->city_id = $system->city_id;
			$user->hometown($system->city_id);
			
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