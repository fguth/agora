<?php
require("php/system.php");
require("php/direct-access.php");
?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<title>This is Ágora</title>
	<base href="<?php print_r($_SERVER["HTTP_REFERER"]); ?>" />
	<link rel="stylesheet/less" type="text/css" href="css/base.less">
	<link rel="icon" type="image/png" href="images/favicon.ico">
	
	<meta property="fb:app_id" content="202465246524252" /> 
	<meta property="og:title" content="Bruno Stein" />
	<meta property="og:type" content="agora-master:candidato">
	<meta property="og:url" content="http://<?php print_r($_SERVER['SERVER_NAME']); print_r($_SERVER['REDIRECT_URL']); ?>" />
	<meta property="og:image" content="https://graph.facebook.com/brunohstein/picture?type=large" />
	<meta property="og:site_name" content="Ágora" />
	<meta property="og:description" content="Bruno Stein está concorrendo para o cargo de prefeito da cidade de Dois Irmãos." />
	
</head>

<body>
	
	<div id="fb-root"></div>
	
	<div class="center">
	
		<div id="header">
			<h1><a href="<?php print_r($_SERVER["HTTP_REFERER"]); ?>"><img src="images/logo-agora.png" alt="Ágora" /></a></h1>
			<div id="login">Conectar-se</div>
			<div id="user-info">
				<img src="" id="user-picture";/>
				<p id="user-name">Carregando</p>
				<div id="logout">Sair</div>
			</div>
		</div>
		
		<ul id="candidates">
			<li>
				<div class="thumb">
					<img src="https://graph.facebook.com/brunohstein/picture?type=large" />
				</div>
				<h3>Bruno Stein</h3>
				<a class="support" href="">Apoiar</a>
				<div class="counter">88</div>
			</li>
		</ul>
		
	</div>
	
</body>

<script type="text/javascript" src="js/less-1.3.0.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/config.js"></script>
<script type="text/javascript" src="js/main.js"></script>

</html>