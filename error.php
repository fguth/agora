<?php
require("hypertext-preprocessor/direct-access.php");
?>

<!DOCTYPE HTML>

<html lang="pt-br" xmlns:fb="http://ogp.me/ns/fb#">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<title>Vish - Ágora</title>

		<link rel="stylesheet" href="stylesheets/basic.css" />
		<link rel="stylesheet" href="stylesheets/modules.css" />
		<link rel="stylesheet" href="stylesheets/layout.css" />
		<link rel="stylesheet" href="stylesheets/error.css" />
		
		<link rel="shortcut icon" href="images/favicon.ico">
		
		<script type="text/javascript" src="javascripts/library/jquery-1.7.2.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.fuckingplay').click(function(){
					var video = "<iframe width='560' height='315' src='http://www.youtube.com/embed/CduA0TULnow?autoplay=1&controls=0&showinfo=0' frameborder='0' allowfullscreen></iframe>"
					$('.fuckingvideo').html(video);
				});
			});
		</script>
		
	</head>

	<body>
		
		<div class="fuckingerror">
			
			<div class="fuckingmeme">
				<a href="javascript:void(0)" class="fuckingplay"></a>
			</div>
			
			<div class="fuckingvideo">
			</div>
			
			<h2 class="fuckingtitle">Ooooops!</h2>
			
			<p class="fuckingapologies">Ocorreu um erro e <strong>não foi possível encontrar</strong> a página que você procura. Nossa equipe já foi notificada.</p>
			
			<div class="fuckingbuttons">
				<a href="http://<?php echo($_SERVER['HTTP_HOST']); ?>" class="fuckingback">Voltar para a home</a>
				<a href="http://facebook.com/agora.vc" class="fuckingzuckerberg">Facebook</a>
			</div>
			
			<div class="fuckingfooter">
				<p>© Ágora 2012. Alguns direitos reservados. <a href="#" class="fuckingfooterlink">Política de privacidade</a> • <a href="#" class="fuckingfooterlink">Termos de uso</a> • <a href="#" class="fuckingfooterlink">Contato</a></p>
			</div>
			
		</div>
		
	</body>

</html>