<?php

/*
 * @author: Evandro Eisinger
 */
    //facebook application configuration
    $fbconfig['appid' ]     = "202465246524252";
    $fbconfig['secret']     = "3150c34907ad4e82e727405f32f4f863";
    $fbconfig['baseurl']    = "http://agora.vc/";
	
	//facebook aplication
	
	$fbapp['loginUrl']		= null;
	$fbapp['logoutUrl']		= null;
	
	//facebook user
	$fbuser['user']			= null;
	$fbuser['profile']		= null;
	$fbuser['info']			= null;

	try {
    	
		echo("<pre>__FILE__ " . __FILE__ . "</pre>");
		echo("<pre>__DIR__ " . __DIR__ . "</pre>");
	    require "php/facebook-sdk/facebook.php";
    
	} catch(Exception $o) {
        
		error_log($o);
		
    }
	
	function main() {
	
	    // Create our Application instance.
		$facebook = new Facebook(array(
		  'appId'  => $fbconfig['appid'],
		  'secret' => $fbconfig['secret'],
		  'cookie' => true,
		));
	
		//Facebook Authentication part
		$fbuser['user'] 		= $facebook->getUser();
		
		$fbapp['logoutUrl'] 	= $facebook->getLogoutUrl();
			
		$fbapp['loginUrl']  	= $facebook->getLoginUrl(
		
				array(
					'scope'         => 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown',
					'redirect_uri'  => $fbconfig['baseurl']
				)
				
		);
		
		if ($fbuser['user']) {
		  
		  try {
			  
			// Proceed knowing you have a logged in user who's authenticated.
			$fbuser['profile'] = $facebook->api('/me');
			
			//get user data
			$fbuser['info'] = $facebook->api("/$user");
		  
		  } catch (FacebookApiException $e) {
			d($e);
			$fbuser['user'] = null;
		  
		  }
		
		}
	   
	}
	
	function login() {
		
		$output = "<a id='login' href='" . $fbapp['loginUrl'] . "'>Conectar-se</a>"; 
		
		if($fbuser['user']){
		
			$output = "<div id='user-info'><img src='' /><p>Nome do usuário</p><a href='" . $fbapp['loginUrl'] . "'>Sair</a></div>";
		}
		
		return $output;

	}
    
    function d($d) {
        echo '<pre>';
        print_r($d);
        echo '</pre>';
    }
	
?>
