<?php
require("php/direct-access.php");

$_SERVER["REDIRECT_STATUS"] = 500;
$_SERVER["REDIRECT_STATUS_ERROR"] = $error;
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Ágora</title>
		
		<base href="http://<?php print_r($_SERVER["HTTP_HOST"]); ?>" />
		
		<link rel="stylesheet" type="text/css" href="css/prototype.css" />
		<link rel="icon" type="image/png" href="images/favicon.ico" />
		
		<style type="text/css">
			body {
				overflow: hidden;
				margin: 0px;
			}
			
			body, html {
				height: 100%;
			}
			
			div#content {
				position: relative;
				text-align: center;
				height: 100%;
			}
			
			div#content > pre {
				position: absolute;
				left: 20%;
				bottom: 0px;
				background: #FFFFFF;
				border-radius: 4px 4px 0px 0px;
				display: block;
				padding: 10px;
				text-align: left;
				width: 60%;
			}
		</style>
	</head>
	<body>
		<div id="content">
			<img src="images/4XX.gif" height="100%" />
			
<?php
if ($_SERVER["REDIRECT_STATUS_ERROR"]) {
	echo("<pre>");
	print_r($_SERVER["REDIRECT_STATUS_ERROR"]->text);
	echo("</pre>");
}
?>
		</div>
	</body>
</html>