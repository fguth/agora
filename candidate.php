<?php require("hypertext-preprocessor/config.php"); ?>

<!DOCTYPE html>

<html lang="pt-br">

	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="Gibran Malheiros está concorrendo para o cargo de prefeito da cidade de Dois Irmãos." />
		<title>Ágora - Eleições 2012</title>
		<link rel="stylesheet" href="stylesheets/application.css" />
		<head prefix="og: http://ogp.me/ns# <?php echo APP_NAME; ?>: 
		                  http://ogp.me/ns/apps/<?php echo APP_NAME; ?>#">
		<meta property="fb:app_id" content="<?php echo APP_ID; ?>" /> 
		<meta property="og:title" content="Gibran Malheiros" />
		<meta property="og:type" content="<?php echo APP_NAME; ?>:<?php echo APP_CANDIDATE_OBJECT; ?>">
		<meta property="og:url" content="http://<?php print_r($_SERVER['SERVER_NAME']); print_r($_SERVER['REDIRECT_URL']); ?>" />
		<meta property="og:image" content="https://graph.facebook.com/gibatronic/picture?type=large" />
		<meta property="og:site_name" content="Ágora" />
		<meta property="og:description" content="Gibran Malheiros está concorrendo para o cargo de prefeito da cidade de Dois Irmãos." />
		
	</head>
	
	<body>
		
		<div class="wrapper">
			
			<div class="header">
			
				<div class="header__logo">
					<h1><a href="#">
						<img src="images/logo-agora.png" alt="Ágora" />
					</a></h1>
				</div>
				
				<div class="header__nav">
					<form class="citynav">
						<a href="#" title="Ir para minha cidade" class="citynav__gotomycity tooltip">
							<img src="images/icon-gotomycity.png" alt="Ir para minha cidade" />
						</a>
						<input type="text" name="cityname" class="citynav__cityname" />
						<a href="#" title="Definir como minha cidade" class="citynav__setmycity tooltip">
							<img src="images/icon-setmycity.png" alt="Definir como minha cidade" class="is-normal" />
							<img src="images/icon-setmycity-hover.png" alt="Definir como minha cidade" class="is-hover" />
						</a>
					</form>
				</div>
				
				<div class="header__login">
					
					<a href="javascript:void(0);" class="fbconnect">
						<span class="fbconnect__icon"><img src="images/icon-fbconnect.png" alt="Facebook connect" /></span><span class="fbconnect__text">Conecte-se</span>
					</a>
					
					<div class="userinfo">
						<img src="#" alt="User name" class="userinfo__photo" />
						<p class="userinfo__name">User name</p>
						<a href="javascript:void(0);" class="userinfo__logout">Sair</a>
					</div>
					
				</div>
			
			</div><!-- End Header -->
			
			<div class="middle">
				
				<div class="introduction">
					<div class="introduction__tip">
						<img src="images/info-busque.png" alt="Identifique e acesse sua cidade para conferir os candidatos" class="introduction__tip__image" />
						<span class="introduction__tip__number">1</span>
						<p class="introduction__tip__title">Busque</p>
						<p class="introduction__tip__description">Identifique e acesse sua cidade para conferir os candidatos.</p>
					</div><div class="introduction__tip">
						<img src="images/info-conecte.png" alt="Entre no Ágora utilizando sua conta no Facebook" class="introduction__tip__image" />
						<span class="introduction__tip__number">2</span>
						<p class="introduction__tip__title">Conecte</p>
						<p class="introduction__tip__description">Entre no Ágora utilizando sua conta no Facebook.</p>
					</div><div class="introduction__tip">
						<img src="images/info-interaja.png" alt="Compartilhe sua intenção de voto com os amigos" class="introduction__tip__image" />
						<span class="introduction__tip__number">3</span>
						<p class="introduction__tip__title">Interaja</p>
						<p class="introduction__tip__description">Compartilhe sua intenção de voto com os amigos.</p>
					</div>
				</div>
				
			</div><!-- End Middle -->
			
			<div class="main">
				
				<div class="main__nav">
					<ul class="contexttabs">
						<li class="contexttabs__item">
							<a href="#" title="Ver candidatos" class="contexttabs__link is-active tooltip">
								<img src="images/icon-candidates.png" alt="Ver candidatos" />
							</a>
						</li>
						<li class="contexttabs__item">
							<a href="#" title="Ver discussão" class="contexttabs__link tooltip">
								<img src="images/icon-discussion.png" alt="Ver discussão" />
								<span class="contexttabs__link__news">+</span>
							</a>
						</li>
					</ul>				
				</div><div class="main__content">
					<div class="main__content__header">
						<div class="main__content__header__contextinfo">
							<div class="breadcrumb">
								<h2>Post title</h2>
							</div>
							<div class="currentsupport">
								<img src="#" alt="Candidate photo" class="currentsupport__candidatephoto" />
								<p class="currentsupport__label">Você apoia <a href="#" class="currentsupport__candidatename">Candidate name</a></p>
							</div>
							<form class="listfilter">
								<input type="text" name="filterfield" value="Filtrar" class="listfilter__filterfield" />
								<img src="images/icon-bloom.png" alt="Filtrar" class="listfilter__icon" />
							</form>
						</div>
					</div>
					<div class="main__content__body">
						<ul class="candidateslist">
							<div class="candidateslist__row">
								
								<li class="candidateslist__item">
									<a href="http://candidato-url" class="candidatecard">
										<img src="#" alt="Candidate photo" class="candidatecard__photo" />
										<p class="candidatecard__name">Candidate name</p>
									</a>
									<div class="support">
										<div class="support__counter">
											<span class="support__counter__number">88</span>
										</div>
										<a href="javascript:void(0);" id="123123123" class="support__button">
											<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
										</a>
										<a href="javascript:void(0);" id="123123123" class="unsupport__button is-hidden">
											<span class="unsupport__button__text">Desfazer</span>
										</a>
									</div>
								</li>

							</div>
						</ul>
					</div>
				</div>
				
			</div><!-- End Main -->
			
		</div><!-- End Wrapper -->

	</body>
	
	<script type="text/javascript" src="javascripts/library/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="javascripts/library/jquery.backstretch.min.js"></script>
	<script type="text/javascript" src="javascripts/library/tooltipsy.min.js"></script>
	<script type="text/javascript" src="javascripts/config.js"></script>
	<script type="text/javascript" src="javascripts/main.js"></script>
	
	<script type="text/javascript">
		$('.tooltip').tooltipsy({
			delay:0,
			show:function(e, $el){
				$el.slideDown(150);
			}
		});
	</script>
	
</html>