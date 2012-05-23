<?php

define("HT", chr(9));
define("LF", chr(10));
define("CR", chr(13));

define("HOST", $_SERVER["HTTP_HOST"]);
define("PATH", $_SERVER["REQUEST_URI"]);

define("IS_LOCAL", HOST == "local.agora.vc");

if (IS_LOCAL) {
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "db_agora");
	define("APP_NAME", "agora-local");
	define("APP_ID", "196526257128071");
} else {
	define("DB_HOST", "db.agora.vc");
	define("DB_USER", "agora_dml");
	define("DB_PASS", "1b6170977bf023b488");
	define("DB_NAME", "db_agora");
	define("APP_NAME", "agora-master");
	define("APP_ID", "202465246524252");

}

define("APP_ACTION", "apoiar");
define("APP_CANDIDATE_OBJECT", "candidato");
define("APP_PROJECT_OBJECT", "projeto");

?>