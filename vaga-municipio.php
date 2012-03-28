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
		<pre>VAGAS PARA MUNICÍPIO<br />Listagem especial das vagas e candidatos para o município requisitado</pre>
		
		<pre><?php print_r($_SERVER["REQUEST_URI"]); ?></pre>
	</body>
</html>