<?php 

require("hypertext-preprocessor/config.php");
require("hypertext-preprocessor/library.php");
require("hypertext-preprocessor/url.class.php");
require("hypertext-preprocessor/location.class.php");

$url = new Url(HOST,PATH);

?>

<!DOCTYPE html>

<html lang="pt-br" xmlns:fb="http://ogp.me/ns/fb#">

	<head>
		
		<base href="http://<?php echo($url->config->host); ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<title><?php echo($url->title); ?></title>
		<link rel="stylesheet" href="stylesheets/basic.css" />
		<link rel="stylesheet" href="stylesheets/modules.css" />
		<link rel="stylesheet" href="stylesheets/layout.css" />
		<link rel="shortcut icon" href="images/favicon.ico">
		
		<head prefix="og: http://ogp.me/ns# <?php echo($url->config->appName); ?>: 
		                  http://ogp.me/ns/apps/<?php echo($url->config->appName); ?>#">
		
		<meta property="fb:app_id" content="<?php echo($url->config->appId); ?>" /> 
		<meta property="og:title" content="<?php echo($url->title); ?>" />
		<meta property="og:type" content="<?php echo($url->type); ?>">
		<meta property="og:url" content="<?php echo($url->address); ?>" />
		<meta property="og:image" content="<?php echo($url->image); ?>" />
		<meta property="og:site_name" content="Ágora" />
		<meta property="og:description" content="<?php echo($url->desc); ?>" />
		<meta name="description" content="<?php echo($url->desc); ?>" />
		
	</head>
	
	<body>
		
		<div class="wrapper">
			
			<div class="header">
			
				<div class="header__logo">
					<h1><a href="<?php echo($url->address); ?>">
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