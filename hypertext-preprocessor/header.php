<?php 

// config
require("hypertext-preprocessor/config.php");

// library
require("hypertext-preprocessor/library/direct-access.php");
require("hypertext-preprocessor/library/facebook.php");
require("hypertext-preprocessor/library/functions.php");

// classes
require("hypertext-preprocessor/classes/header.class.php");
require("hypertext-preprocessor/classes/auth.class.php");
require("hypertext-preprocessor/classes/location.class.php");
require("hypertext-preprocessor/classes/user.class.php");
require("hypertext-preprocessor/classes/candidate.class.php");

$auth   = new Auth();
$header	= new Header($auth->user);

?>

<!DOCTYPE html>
<html lang="pt-br" xmlns:fb="http://ogp.me/ns/fb#" class="no-js">
	
	<?php $header->meta(); ?>

	<body data-token="<?php echo ($auth->token); ?>" data-id="<?php echo ($auth->id); ?>" data-content-type="<?php echo($header->content_type); ?>" data-path="<?php echo($header->path); ?>" data-city-id="<?php echo($header->city_id); ?>">
		<div class="wrapper">
			<div class="header">
				<div class="header__logo">
					<h1><a href="http://<?php echo (HOST); ?>/<?php echo ($header->state_sa); ?>/<?php echo ($header->city_url); ?>">
						<img src="images/logo-agora.png" alt="Ágora" title="Ágora" />
					</a></h1>
				</div>
				<div class="header__nav">
					<?php $header->nav(); ?>
				</div>
				<div class="header__login">
					<?php $header->login(); ?>
				</div>
			</div>