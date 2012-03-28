<?php
  
  require("facebook-sdk/facebook.php");
  
  define("APPID", "202465246524252");
  define("SECRET", "3150c34907ad4e82e727405f32f4f863");
  define("URL", $_SERVER['HTTP_HOST']);
  
  $fb_config = array(
    'appId' => APPID,
    'secret' => SECRET,
    'fbconnect' => 1
  );

  $fb   		= new Facebook($fb_config);
  $auth			= false;
  $user 		= null;
  $user_data 	= null;
  $login_url    = null;
  $logout_url   = null;
  	  
  check_auth($fb);
  
  function check_auth() {
  	
	global $fb, $auth, $user, $user_data, $login_url, $logout_url;

  	$_user = $fb->getUser();
  	
  	if($_user) {
  		
  		echo('Está logado.');
  		
  		try {
			
			$user 	   = $_user;
  			$user_data = $fb->api('/me','GET');
  			$auth 	   = true;
  			$params = array( 'next' => 'https://www.myapp.com/after_logout' );

			$logout_url = $fb->getLogoutUrl(); 
  		
		} catch (FacebookApiException $e) {
			
			$user 	   = null;
  			$user_data = null;
  			$auth 	   = false;
  			$login_url = null; 
  			$logout_url = null;
  		
			d($e);
				
		}
  		
  	} else {
  	
  		echo('Não está logado.');
  	
    	$login_url = $fb->getLoginUrl();
  			
  	}
  	
  }
  
  function check_login() {
  
  	global $auth, $user_data, $login_url, $logout_url;
  							
	$output = "<a id='login' href='" . $login_url . "' target='self'>Conectar-se</a>";
  	
  	if($auth)
  	{	
		$output 	 = "<div id='user-info'>";
		$output 	.= "<img src='https://graph.facebook.com/". $user_data['username'] . "/picture' />";
		$output 	.= "<p>". $user_data['name'] . "</p><a href='" . $logout_url . "'>Sair</a>";
		$output 	.= "</div>";
  	}
		
	print $output;

  }
  
  function d($d) {
  	
  	echo '<pre>';
    print_r($d);
    echo '</pre>';
  
  }

?>