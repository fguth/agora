<?php require("hypertext-preprocessor/config.php"); ?>

<!DOCTYPE html>

<html lang="pt-br" xmlns:fb="http://ogp.me/ns/fb#">

	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="Ágora é uma plataforma para discussão política. Indique sua intenção de voto e debata propostas para as Eleições 2012." />
		<title>Ágora - Eleições 2012</title>
		<link rel="stylesheet" href="stylesheets/application.css" />
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
						<img src="#" alt="" class="userinfo__photo" /><p class="userinfo__name">
						</p><a href="javascript:void(0);" class="userinfo__logout">Sair</a>
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
							<a href="javascript:void(0);" title="Ver candidatos" class="contexttabs__link is-active tooltip contexttabs__candidates">
								<img src="images/icon-candidates.png" alt="Ver candidatos" />
							</a>
						</li>
						<li class="contexttabs__item">
							<a href="javascript:void(0);" title="Ver discussão" class="contexttabs__link tooltip contexttabs__discussion">
								<img src="images/icon-discussion.png" alt="Ver discussão" />
								<span class="contexttabs__link__news">+</span>
							</a>
						</li>
					</ul>				
				</div><div class="main__content">
						
					<div class="main__content__wrapper">
					
						<dl class="candidateslist">
							
							<dt class="candidateslist__header">
								<div class="candidateslist__header__wrapper">
									<div class="candidateslist__header__content">
										<div class="breadcrumb">
											<h2>Xota</h2>
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
							</dt>
							
							<dd class="candidateslist__item is-first-of-row">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>
							
							<dd class="candidateslist__item">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>
							
							<dd class="candidateslist__item">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>
							
							<dd class="candidateslist__item">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>
							
							<dd class="row-division">
								<hr />
							</dd>
							
							<dd class="candidateslist__item is-first-of-row">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>
							
							<dd class="candidateslist__item">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>
							
							<dd class="candidateslist__item">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>
							
							<dd class="candidateslist__item">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>

							<dt class="candidateslist__header">
								<div class="candidateslist__header__wrapper">
									<div class="candidateslist__header__content">
										<div class="breadcrumb">
											<h2>Gostoso</h2>
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
							</dt>
							
							<dd class="candidateslist__item is-first-of-row">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>
							
							<dd class="candidateslist__item">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>
							
							<dd class="candidateslist__item">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>
							
							<dd class="candidateslist__item">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>
							<dd class="row-division">
								<hr />
							</dd>
							
							<dt class="candidateslist__header">
								<div class="candidateslist__header__wrapper">
									<div class="candidateslist__header__content">
										<div class="breadcrumb">
											<h2>Prefeito</h2>
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
							</dt>
							
							<dd class="candidateslist__item is-first-of-row">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>
							
							<dd class="candidateslist__item">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>
							
							<dd class="candidateslist__item">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>
							
							<dd class="candidateslist__item">
								<a href="http://development.agora.vc/candidate.php" class="candidatecard">
									<img src="#" alt="Candidate photo" class="candidatecard__photo" />
									<p class="candidatecard__name">Candidate name</p>
								</a>
								<div class="support" id="123123123">
									<div class="support__counter">
										<span class="support__counter__number">88</span>
									</div>
									<a href="javascript:void(0);" class="support__button">
										<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
									</a>
									<a href="javascript:void(0);" class="unsupport__button is-hidden">
										<span class="unsupport__button__text">Desfazer</span>
									</a>
								</div>
							</dd>
										
						</dl>
						
						<div class="discussion">
							
							<div class="discussion__header">
								<div class="breadcrumb">
									<h2>São Paulo</h2>
								</div>
								<div class="currentsupport">
									<img src="#" alt="Candidate photo" class="currentsupport__candidatephoto" />
									<p class="currentsupport__label">Você apoia <a href="#" class="currentsupport__candidatename">Candidate name</a></p>
								</div>
								<div class="currentsupport">
									<img src="#" alt="Candidate photo" class="currentsupport__candidatephoto" />
									<p class="currentsupport__label">Você apoia <a href="#" class="currentsupport__candidatename">Candidate name</a></p>
								</div>
							</div>
							
							<div class="row-division">
								<hr />
							</div>
							
							<div class="fbcomments">
								<fb:comments href="http://<?php print_r($_SERVER['SERVER_NAME']); print_r($_SERVER['REQUEST_URI']); ?>" num_posts="5" width="737"></fb:comments>
							</div>
						
						</div>
						
					</div>
					
				</div>
				
			</div><!-- End Main -->
			
		</div><!-- End Wrapper -->

	</body>
	
	<script type="text/javascript" src="javascripts/library/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="javascripts/library/jquery.backstretch.min.js"></script>
	<script type="text/javascript" src="javascripts/library/tooltipsy.min.js"></script>
	<script type="text/javascript" src="javascripts/library/jquery.list.min.js"></script>
	<script type="text/javascript" src="javascripts/config.js"></script>
	<script type="text/javascript" src="javascripts/main.js"></script>
	
</html>