<?php
require("config.php");

$content = "Options -Indexes" . LF;
$content .= LF;
$content .= "RewriteEngine On" . LF;

/**
 * DENY ACCESS FOR SOME PHP FILES
 */

// $content .= LF;
// $content .= "# DENY ACCESS FOR SOME PHP FILES" . LF;
// $content .= "RewriteCond %{REQUEST_FILENAME} -f" . LF;
// $content .= "RewriteCond %{REQUEST_URI} ^/(candidato|vaga|vaga-(estado|municipio|pais))\.php [NC]" . LF;
// $content .= "RewriteRule .+ - [R=404,L]" . LF;
// $content .= LF;
// $content .= "# HIDE DE ERROR.PHP" . LF;
// $content .= "RewriteCond %{REQUEST_FILENAME} -f" . LF;
// $content .= "RewriteCond %{REQUEST_URI} ^/error\.php [NC]" . LF;
// $content .= "RewriteRule .+ error.php?404 [L]" . LF;

/**
 * HANDLE THE FRIENDLY URL ECOSYSTEM AND SOME HTTP ERRORS
 */

// AGORA.VC/UF
// $content .= LF;
// $content .= "# AGORA.VC/UF" . LF;
// $content .= "RewriteCond %{REQUEST_FILENAME} !-f" . LF;
// $content .= "RewriteCond %{REQUEST_FILENAME} !-d" . LF;
// $content .= "RewriteCond %{REQUEST_URI} ^/(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)/?\$ [NC]" . LF;
// $content .= "RewriteRule .+ vaga-estado.php [L,NC]" . LF;

// AGORA.VC/PRESIDENTE
// $content .= LF;
// $content .= "# AGORA.VC/PRESIDENTE" . LF;
// $content .= "RewriteCond %{REQUEST_FILENAME} !-f" . LF;
// $content .= "RewriteCond %{REQUEST_FILENAME} !-d" . LF;
// $content .= "RewriteCond %{REQUEST_URI} ^/presidente/?\$ [NC]" . LF;
// $content .= "RewriteRule .+ vaga-pais.php [L,NC]" . LF;

// AGORA.VC/UF/DEPUTADO-ESTADUAL
// AGORA.VC/UF/DEPUTADO-FEDERAL
// AGORA.VC/UF/GOVERNADOR
// AGORA.VC/UF/SENADOR
// $content .= LF;
// $content .= "# AGORA.VC/UF/DEPUTADO-ESTADUAL" . LF;
// $content .= "# AGORA.VC/UF/DEPUTADO-FEDERAL" . LF;
// $content .= "# AGORA.VC/UF/GOVERNADOR" . LF;
// $content .= "# AGORA.VC/UF/SENADOR" . LF;
// $content .= "RewriteCond %{REQUEST_FILENAME} !-f" . LF;
// $content .= "RewriteCond %{REQUEST_FILENAME} !-d" . LF;
// $content .= "RewriteCond %{REQUEST_URI} ^/(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)/(deputado-(estadual|federal)|governador|senador)/?\$ [NC]" . LF;
// $content .= "RewriteRule .+ vaga.php [L,NC]" . LF;

// AGORA.VC/UF/MUNICIPIO/PREFEITO
// AGORA.VC/UF/MUNICIPIO/VEREADOR
// $content .= LF;
// $content .= "# AGORA.VC/UF/MUNICIPIO/PREFEITO" . LF;
// $content .= "# AGORA.VC/UF/MUNICIPIO/VEREADOR" . LF;
// $content .= "RewriteCond %{REQUEST_FILENAME} !-f" . LF;
// $content .= "RewriteCond %{REQUEST_FILENAME} !-d" . LF;
// $content .= "RewriteCond %{REQUEST_URI} ^/(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)/[^/]+/(prefeito|vereador)/?\$ [NC]" . LF;
// $content .= "RewriteRule .+ vaga.php [L,NC]" . LF;

// AGORA.VC/PRESIDENTE/CANDIDATO
// $content .= LF;
// $content .= "# AGORA.VC/PRESIDENTE/CANDIDATO" . LF;
// $content .= "RewriteCond %{REQUEST_FILENAME} !-f" . LF;
// $content .= "RewriteCond %{REQUEST_FILENAME} !-d" . LF;
// $content .= "RewriteCond %{REQUEST_URI} ^/presidente/[^/]+/?\$ [NC]" . LF;
// $content .= "RewriteRule .+ candidato.php [L,NC]" . LF;

// AGORA.VC/UF/DEPUTADO-ESTADUAL/CANDIDATO
// AGORA.VC/UF/DEPUTADO-FEDERAL/CANDIDATO
// AGORA.VC/UF/GOVERNADOR/CANDIDATO
// AGORA.VC/UF/SENADOR/CANDIDATO
// $content .= LF;
// $content .= "# AGORA.VC/UF/GOVERNADOR/CANDIDATO" . LF;
// $content .= "RewriteCond %{REQUEST_FILENAME} !-f" . LF;
// $content .= "RewriteCond %{REQUEST_FILENAME} !-d" . LF;
// $content .= "RewriteCond %{REQUEST_URI} ^/(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)/(deputado-(estadual|federal)|governador|senador)/[^/]+/?\$ [NC]" . LF;
// $content .= "RewriteRule .+ candidato.php [L,NC]" . LF;

// AGORA.VC/UF/MUNICIPIO
$content .= LF;
$content .= "# AGORA.VC/UF/MUNICIPIO" . LF;
$content .= "RewriteCond %{REQUEST_FILENAME} !-f" . LF;
$content .= "RewriteCond %{REQUEST_FILENAME} !-d" . LF;
$content .= "RewriteCond %{REQUEST_URI} ^/(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)/[^/]+/?\$ [NC]" . LF;
$content .= "RewriteRule .+ index.php [L,NC]" . LF;

// AGORA.VC/UF/MUNICIPIO/PREFEITO/CANDIDATO
// AGORA.VC/UF/MUNICIPIO/VEREADOR/CANDIDATO
$content .= LF;
$content .= "# AGORA.VC/UF/MUNICIPIO/PREFEITO/CANDIDATO" . LF;
$content .= "# AGORA.VC/UF/MUNICIPIO/VEREADOR/CANDIDATO" . LF;
$content .= "RewriteCond %{REQUEST_FILENAME} !-f" . LF;
$content .= "RewriteCond %{REQUEST_FILENAME} !-d" . LF;
$content .= "RewriteCond %{REQUEST_URI} ^/(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)/[^/]+/(prefeito|vereador)/[^/]+/?\$ [NC]" . LF;
$content .= "RewriteRule .+ candidate.php [L,NC]" . LF;

/**
 * HANDLE SOME COMMON ERROS
 */

$content .= LF;
$content .= "# HANDLE SOME COMMON ERROS" . LF;
$content .= "ErrorDocument 400 /error.php" . LF;
$content .= "ErrorDocument 401 /error.php" . LF;
$content .= "ErrorDocument 403 /error.php" . LF;
$content .= "ErrorDocument 404 /error.php" . LF;
$content .= "ErrorDocument 500 /error.php" . LF;
$content .= "ErrorDocument 501 /error.php" . LF;
$content .= "ErrorDocument 502 /error.php" . LF;
$content .= "ErrorDocument 503 /error.php" . LF;

/**
 * WRITE DOWN EVERYTHING
 */

$bytes = file_put_contents("../.htaccess", $content);

if ($bytes === false) {
	echo("file_put_contents failure");
} else {
	echo("file_put_contents success");
}

echo(" " . $bytes . " byte" . ($bytes == 1 ? "" : "s") . " written.");