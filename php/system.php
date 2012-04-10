<?php

	define("HT", chr(9));
	define("LF", chr(10));
	define("CR", chr(13));
	define("CHECK_USER", "8b5b422abef67a034aac2d83f07afbcd");

	$data   = new stdClass();
	$return = new stdClass();

	if (preg_match("/^[0-9A-Z]{32}\$/i", $_POST["action"])) {$data->action = $_POST["action"]; }

	if ($_POST["user"] && $_POST["token"]) { 
		
		$data->user  = $_POST["user"]; 
		$data->token = $_POST["token"]; 
	
	}
    	
	switch ($data->action) {
	
		case CHECK_USER :
		
			if (count($data->user) && $data->token) {
				
				$data->interests	= getInterests($data->token);
				
				$return->sucess 	= true;
				$return->data   	= $data;
				
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
	
	
	function getInterests($token) {
		
		$interests = new stdClass();
		
		$interests->music 		= json_decode(file_get_contents("https://graph.facebook.com/me/music?access_token=" . $token));
		$interests->books 		= json_decode(file_get_contents("https://graph.facebook.com/me/books?access_token=" . $token));
		$interests->television 	= json_decode(file_get_contents("https://graph.facebook.com/me/television?access_token=" . $token));
		$interests->activities 	= json_decode(file_get_contents("https://graph.facebook.com/me/activities?access_token=" . $token));
		$interests->interests 	= json_decode(file_get_contents("https://graph.facebook.com/me/interests?access_token=" . $token));
		$interests->movies 		= json_decode(file_get_contents("https://graph.facebook.com/me/movies?access_token=" . $token));
		
		return $interests;
		
	}

?>