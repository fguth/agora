<?php

	define("HT", chr(9));
	define("LF", chr(10));
	define("CR", chr(13));

	define("IS_LOCAL", $_SERVER["HTTP_HOST"] == "local.agora.vc");

	if(IS_LOCAL) {
	
		define("DB_HOST", "localhost");
		define("DB_USER", "root");
		define("DB_PASS", "");
		define("DB_NAME", "db_agora");
		
	} else {
		
		define("DB_HOST", "");
		define("DB_USER", "");
		define("DB_PASS", "");
		define("DB_NAME", "");
		
	}

?>