<?php
require(".sistema/php/sistema.php");

header("content-type: text/html; charset=UTF-8", true);
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Servidor</title>
		
		<meta http-equiv="content-type" content="text/xml; charset=UTF-8" />
		
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no" />
		
		<link href=".sistema/css/sistema.css" media="all" rel="stylesheet" type="text/css" />
		
		<script src=".sistema/js/jquery.js" type="text/javascript"></script>
		<script src=".sistema/js/sistema.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="camada">
			&nbsp;
		</div>
		
		<table id="cabecalho">
			<tbody>
				<tr>
					<td rowspan="2" class="icone"><img src=".sistema/img/icone-32.png" alt="" width="32" height="32" /></td>
					<td class="titulo">Servidor <img src=".sistema/img/opcoes.png" alt="" /></td>
				</tr>
				<tr>
					<td class="caminho"><span class="barra">./</span></td>
				</tr>
			</tbody>
		</table>
		
		<hr />
		
		<table id="lista">
			<tbody>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>