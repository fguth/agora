<?php
require("php/direct-access.php");
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
				background-image: url("images/4XX.gif");
				background-position: center middle;
				background-repeat: repeat;
				text-align: center;
				height: 100%;
			}
		</style>
	</head>
	<body>
		<div id="content">
			<img src="images/4XX.gif" height="100%" />
		</div>
	</body>
</html>