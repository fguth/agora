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
		<pre>VAGA<br />Listagem dos candidatos para a vaga requisitada</pre>
		
		<pre><?php print_r($_SERVER["REQUEST_URI"]); ?></pre>
	</body>
</html>