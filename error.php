<?php
require("php/system.php");
require("php/direct-access.php");
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Ágora</title>
		
        <base href="<?php print_r($_SERVER["HTTP_REFERER"]); ?>" />
        
	</head>
	<body>
		<img src="images/4XX.gif" alt="" />
		
		<br />
		
		<pre>WATCH OUT WE GOT A <?php echo($_SERVER["REDIRECT_STATUS"]); ?> OVER HERE!</pre>
	</body>
</html>