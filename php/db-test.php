<?php
require("config.php");
require("library.php");
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Ágora DB Test</title>
	</head>
	<body>
		<pre>States IDs: <?php print_r(db("SELECT id FROM states")); ?></pre>
	</body>
</html>