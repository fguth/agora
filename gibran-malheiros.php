<?php require("php/config.php"); ?>
	<head prefix="og: http://ogp.me/ns# <?php echo APP_NAME; ?>: 
	                  http://ogp.me/ns/apps/<?php echo APP_NAME; ?>#">
	<meta property="fb:app_id" content="<?php echo APP_ID; ?>" /> 
	<meta property="og:title" content="Gibran Malheiros" />
	<meta property="og:type" content="<?php echo APP_NAME; ?>:<?php echo APP_OBJECT; ?>">
	<meta property="og:url" content="http://<?php print_r($_SERVER['SERVER_NAME']); print_r($_SERVER['REDIRECT_URL']); ?>" />
	<meta property="og:image" content="https://graph.facebook.com/gibatronic/picture?type=large" />
	<meta property="og:site_name" content="Ágora" />
	<meta property="og:description" content="Gibran Malheiros está concorrendo para o cargo de prefeito da cidade de Dois Irmãos." />
	
</head>

<body>
	
	<div id="fb-root"></div>
	
	<div class="center">
	
		<div id="header">
			<h1><a href="http://<?php print_r($_SERVER["HTTP_HOST"]); ?>"><img src="images/logo-agora.png" alt="Ágora" /></a></h1>
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