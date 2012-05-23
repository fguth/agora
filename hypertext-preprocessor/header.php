<?php require("hypertext-preprocessor/config.php"); ?>

<!DOCTYPE html>

<html lang="pt-br" xmlns:fb="http://ogp.me/ns/fb#">

	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="Ágora é uma plataforma para discussão política. Indique sua intenção de voto e debata propostas para as Eleições 2012." />
		<title>Ágora - Eleições 2012</title>
		<link rel="stylesheet" href="stylesheets/basic.css" />
		<link rel="stylesheet" href="stylesheets/modules.css" />
		<link rel="stylesheet" href="stylesheets/layout.css" />
		<head prefix="og: http://ogp.me/ns# <?php echo APP_NAME; ?>: 
		                  http://ogp.me/ns/apps/<?php echo APP_NAME; ?>#">
		<meta property="fb:app_id" content="<?php echo APP_ID; ?>" /> 
		<meta property="og:title" content="Ágora - Eleições 2012" />
		<meta property="og:type" content="<?php echo APP_NAME; ?>:<?php echo APP_PROJECT_OBJECT; ?>">
		<meta property="og:url" content="http://<?php print_r($_SERVER['SERVER_NAME']); print_r($_SERVER['REDIRECT_URL']); ?>" />
		<meta property="og:image" content="https://fbcdn-sphotos-a.akamaihd.net/hphotos-ak-ash3/523977_279169475490552_274490955958404_623177_1354285026_n.jpg" />
		<meta property="og:site_name" content="Ágora" />
		<meta property="og:description" content="Ágora é uma plataforma para discussão política. Indique sua intenção de voto e debata propostas para as Eleições 2012." />
		
	</head>
	
	<body>
		
		<div class="wrapper">
			
			<div class="header">
			
				<div class="header__logo">
					<h1><a href="http://<?php print_r($_SERVER['HTTP_HOST']); ?>">
						<img src="images/logo-agora.png" alt="Ágora" />
					</a></h1>
				</div>
				
				<div class="header__nav">
					<form class="citynav">
						<a href="javascript:void(0)" title="Minha cidade" class="citynav__gotomycity tooltip">
							<img src="images/icon-gotomycity.png" alt="Minha cidade" />
						</a>
						<input type="text" name="cityname" class="citynav__cityname" />
						<a href="javascript:void(0)" title="Voto aqui" class="citynav__setmycity tooltip">
							<img src="images/icon-setmycity.png" alt="Voto aqui" class="is-normal" />
							<img src="images/icon-setmycity-hover.png" alt="Voto aqui" class="is-hover" />
						</a>
					</form>
				</div>
				
				<div class="header__login">
					
					<a href="javascript:void(0);" class="fbconnect">
						<span class="fbconnect__icon"><img src="images/icon-fbconnect.png" alt="Facebook connect" /></span><span class="fbconnect__text">Conecte-se</span>
					</a>
					
					<div class="userinfo">
						<div class="userinfo__text">
							<p class="userinfo__name"></p>
							<a href="javascript:void(0);" class="userinfo__logout">Sair</a>
						</div>
						<img src="images/loader-userphoto.gif" alt="" class="userinfo__photo" />
					</div>
					
				</div>
			
			</div>