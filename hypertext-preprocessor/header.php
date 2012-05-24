<?php 

require("hypertext-preprocessor/config.php");
require("hypertext-preprocessor/library.php");
require("hypertext-preprocessor/header.class.php");
require("hypertext-preprocessor/location.class.php");

$header = new Header(HOST,PATH);

?>

<!DOCTYPE html>

<html lang="pt-br" xmlns:fb="http://ogp.me/ns/fb#">

	<?php $header->render(); ?>
	
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