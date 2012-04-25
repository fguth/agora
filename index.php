<?php 

header("content-type: text/html; charset=UTF-8", true);
require("php/config.php"); 

?>

<!DOCTYPE HTML>

<html>

<head>

	<meta charset="utf-8" />
	<title>This is Ágora</title>
	<link rel="stylesheet" type="text/css" href="css/prototype.css">
	<link rel="icon" type="image/png" href="images/favicon.ico" />
	<head prefix="og: http://ogp.me/ns# <?php echo APP_NAME; ?>: 
	                  http://ogp.me/ns/apps/<?php echo APP_NAME; ?>#">
	<meta property="fb:app_id" content="<?php echo APP_ID; ?>" /> 
	<meta property="og:title" content="Ágora" />
	<meta property="og:type" content="<?php echo APP_NAME; ?>">
	
</head>

<body>

	<div id="fb-root"></div>
	
	<div class="center">
		
		<div id="header">
			<h1><img src="images/logo-agora.png" alt="Ágora" /></h1>
			<div id="login">Conectar-se</div>
			<div id="user-info">
				<img src="" id="user-picture";/>
				<p id="user-name">Carregando</p>
				<div id="logout">Sair</div>
			</div>
		</div>
        
		<ul id="candidates">
			<h2>Candidatos</h2>
			<li>
				<div class="thumb">
					<a href="rs/dois-irmaos/prefeito/bruno-stein">
						<img src="https://graph.facebook.com/brunohstein/picture?type=large" />
					</a>
				</div>
				<h3><a href="rs/dois-irmaos/prefeito/bruno-stein">Bruno Stein</a></h3>
				<div id="1" class="support">Apoiar</div>
				<div class="counter">88</div>
			</li>
			<li>
				<div class="thumb">
					<a href="rs/dois-irmaos/prefeito/evandro-eisinger">
						<img src="https://graph.facebook.com/evandroeisinger21/picture?type=large" />
					</a>
				</div>
				<h3><a href="rs/dois-irmaos/prefeito/evandro-eisinger">Evandro Eisinger</a></h3>
				<div id="2" class="support">Apoiar</div>
				<div class="counter">88</div>
			</li>
			<li>
				<div class="thumb">
					<a href="rs/dois-irmaos/prefeito/filipe-guth">
						<img src="https://graph.facebook.com/fguth/picture?type=large" />
					</a>
				</div>
				<h3><a href="rs/dois-irmaos/prefeito/filipe-guth">Filipe Guth</a></h3>
				<div id="3" class="support">Apoiar</div>
				<div class="counter">88</div>
			</li>
			<li>
				<div class="thumb">
					<a href="rs/dois-irmaos/prefeito/gibran-malheiros">
						<img src="https://graph.facebook.com/gibatronic/picture?type=large" />
					</a>
				</div>
				<h3><a href="rs/dois-irmaos/prefeito/gibran-malheiros">Gibran Malheiros</a></h3>
				<div id="4" class="support">Apoiar</div>
				<div class="counter">88</div>
			</li>
		</ul>
        
	</div>
    
</body>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/config.js"></script>
<script type="text/javascript" src="js/main.js"></script>

</html>