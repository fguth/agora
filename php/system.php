<?php

	define("HT", chr(9));
	define("LF", chr(10));
	define("CR", chr(13));
	define("CHECK_USER", "8b5b422abef67a034aac2d83f07afbcd");

	$data = new stdClass();
	$return = new stdClass();

	if (preg_match("/^[0-9A-Z]{32}\$/i", $_POST["action"])) {$data->action = $_POST["action"]; }

	if ($_POST["user"]) { $data->user = $_POST["user"]; }
    	
	switch ($data->action) {
	
		case CHECK_USER :
		
			if (count($data->user)) {
			
				$return->sucess = true;
				$return->user   = $data->user;
			
			} else {
				
				$return->sucess  = false;
				$return->mensage = "Facebook data were not received.";
				
			}
		
		break;
	
		default:

			$return->sucess  = false;
			$return->mensage = "Undefined Action.";
	
		break;
	
	}

	echo(json_encode($return));

?>