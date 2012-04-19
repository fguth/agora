<?php

require("php/direct-access.php");
require("php/config.php");

?>

<!DOCTYPE HTML>

<html>

<head>

	<meta charset="utf-8" />
	<title>This is Ágora</title>
	<base href="http://<?php print_r($_SERVER["HTTP_HOST"]); ?>" />
	<link rel="stylesheet" type="text/css" href="css/prototype.css" />
	<link rel="icon" type="image/png" href="images/favicon.ico" />
	
<?php

$candidato = $_SERVER['REDIRECT_URL'];
$candidato = explode("/", $candidato);
$file = $candidato[4].".php";
if (file_exists($file)) { include($file); } else { header("location:/404"); }

?>

</body>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/config.js"></script>
<script type="text/javascript" src="js/main.js"></script>

</html>