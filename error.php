<?php
require("hypertext-preprocessor/direct-access.php");
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Ágora</title>
		
		<base href="http://<?php print_r($_SERVER["HTTP_HOST"]); ?>" />
		
		<link rel="stylesheet" type="text/css" href="stylesheets/application.css" />
	</head>
	<body>
		<pre id="content"><?php
// HTTP ERROR CODE PROVIDED BY APACHE
print_r("HTTP " . $_SERVER["REDIRECT_STATUS"]);
 
// FURTHER DETAILS ABOUT THE ERROR PROVIDED BY error-handler.php
if ($_SERVER["REDIRECT_STATUS_ERROR"]) {
	print_r($_SERVER["REDIRECT_STATUS_ERROR"]->text);
}
?></pre>
	</body>
</html>