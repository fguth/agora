<?php
require("php/system.php");
require("php/direct-access.php");
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Ágora</title>
		
		
	</head>
	<body>
		<pre>CANDIDATO<br />Informações sobre o candidato requisitado</pre>
		
		<pre><?php print_r($_SERVER["REQUEST_URI"]); ?></pre>
	</body>
</html>