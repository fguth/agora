<?php
define("HT", chr(9));
define("LF", chr(10));
define("CR", chr(13));
define("HOST", $_SERVER["HTTP_HOST"]);
define("PATH", $_SERVER["REQUEST_URI"]);
define("IS_LOCAL", HOST == "local.agora.vc");
define("DB_NAME", "db_agora");
define("APP_ACTION", "apoiar");
define("APP_CANDIDATE_OBJECT", "candidato");
define("APP_PROJECT_OBJECT", "projeto");
define("APP_PROJECT_IMAGE", "https://fbcdn-sphotos-a.akamaihd.net/hphotos-ak-ash3/523977_279169475490552_274490955958404_623177_1354285026_n.jpg");
define("ELLECTION_YEAR", "2012");

if (IS_LOCAL) {
	error_reporting(E_ALL ^ E_NOTICE);

	define("DB_HOST", HOST);
	define("DB_USER", "root");
	define("DB_PASS", "root");	
	define("APP_NAME", "agora-local");
	define("APP_ID", "196526257128071");
	define("APP_SECRET", "a126bbc85bb7dd4c3b8a452c0cbe902d");
} else {
	error_reporting(0);

	define("DB_HOST", "db.agora.vc");
	define("DB_USER", "agora_dml");
	define("DB_PASS", "1b6170977bf023b488");
	define("APP_NAME", "agora-master");
	define("APP_ID", "202465246524252");
	define("APP_SECRET", "3150c34907ad4e82e727405f32f4f863");
}
?>