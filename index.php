<?php header("content-type: text/html; charset=UTF-8", true); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>This is Ágora</title>
	<link rel="stylesheet/less" type="text/css" href="css/base.less">
	<link rel="icon" type="image/png" href="images/favicon.ico">
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
					<img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-snc4/368710_1664574483_389674048_n.jpg" />
				</div>
				<h3>Bruno Stein</h3>
				<div id="1" class="support">Apoiar</div>
				<div class="counter">88</div>
			</li>
			<li>
				<div class="thumb">
					<img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-snc4/275259_100000507365811_494642663_n.jpg" />
				</div>
				<h3>Evandro Eisinger</h3>
				<div id="2" class="support">Apoiar</div>
				<div class="counter">88</div>
			</li>
			<li>
				<div class="thumb">
					<img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-snc4/273869_100000435792178_1121551184_n.jpg" />
				</div>
				<h3>Filipe Guth</h3>
				<div id="3" class="support">Apoiar</div>
				<div class="counter">88</div>
			</li>
			<li>
				<div class="thumb">
					<img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-snc4/41771_725758823_6562_n.jpg" />
				</div>
				<h3>Gibran Malheiros</h3>
				<div id="4" class="support">Apoiar</div>
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