<?php

class Header {
	
	/**
	 * Class Parameters
	 */
	
	public $config;
	public $title;
	public $desc;
	public $type;
	public $image;
	public $location;
	public $address;
	public $user;
	
	public $state;
	public $city;
	public $city_id;
	public $post;
	public $candidate;
	
	/**
	 *  Constructor
	 */
	
	public function __construct($user = null) {
		
		// set config 
		$this->config				= new stdClass();
		$this->config->appName 		= APP_NAME;
		$this->config->appId 		= APP_ID;
		$this->config->host 		= HOST;
		$this->config->path 		= PATH;
		$this->config->parameters 	= preg_split("/\\" . DIRECTORY_SEPARATOR . "/", $this->config->path,-1, PREG_SPLIT_NO_EMPTY);
		
		// set default 
		$this->title 	= "Ágora Eleições 2012";
		$this->desc		= "Ágora é uma plataforma para discussão política. Indique sua intenção de voto e debata propostas para as Eleições 2012.";
		$this->type 	= APP_NAME . ":" . APP_PROJECT_OBJECT;
		$this->address 	= "http://" . $this->config->host . $this->config->path;
		$this->image 	= "https://fbcdn-sphotos-a.akamaihd.net/hphotos-ak-ash3/523977_279169475490552_274490955958404_623177_1354285026_n.jpg";
		$this->location = "Localização indisponível";
		$this->user		= $user;
				
		// verify url to set the correct tags
		if ($this->config->parameters) {
			// set location or/and candidate
			$this->page			= $this->config->parameters[0];
			$this->state		= $this->config->parameters[0];
			$this->city			= $this->config->parameters[1];
			$this->post			= $this->config->parameters[2];
			$this->candidate	= $this->config->parameters[3];
			
			if ($this->page && !$this->city && !$this->post && !$this->candidate) {
				
				if($this->user && $this->user->info->hometown) {
					$this->city				 = $this->user->info->hometown;
					$this->location  		 = $this->user->info->city_name . ", " . $this->user->info->state_sa;
					$this->config->path 	 = $this->page;
					$this->address 			 = "http://" . $this->config->host . "/" . $this->page;
					
				} else {				
					// current location
					$currentLocation = new CurrentLocation();

					if ($currentLocation->status) {
						// set current location or/and candidate
						$this->state		= $currentLocation->state;
						$this->city			= $currentLocation->city;

						// url - current location
						$location = $this->validate("location");
						if($location) {
							$this->city			 	 = $location->id;
							$this->config->path 	 = $this->page;
							$this->location  		 = $location->name . ", " . $location->state_sa;
							$this->address 			 = "http://" . $this->config->host . "/" . $this->page;
						}
					}
				}
				
			} else if ($this->state && $this->city && !$this->post && !$this->candidate) {
				// url - has state/city
				$city = $this->validate("city");
				
				if($city) {
					$this->city			= $city->id;
					$this->title 		= $city->name . " - Ágora Eleições 2012";
					$this->location  	= $city->name . ', ' . $city->state_sa;
					$this->address 		= "http://" . $this->config->host . $this->config->path;
				}
				
			} else if ($this->state && $this->city && $this->post && $this->candidate) {
				// url - has state/city/post/candidate
				$this->candidate = $this->validate("candidate");
				
				if($this->candidate) {
					$this->city			= $this->candidate->city_id;
					$this->title 		= ucwords(strtolower($this->candidate->name)) . " - Ágora Eleições 2012";
					$this->desc 		= $this->candidate->name . " está concorrendo para o cargo de " . $this->candidate->post_name . " da cidade de " . $this->candidate->city_name . ".";
					$this->type 		= APP_NAME . ":" . APP_CANDIDATE_OBJECT;
					$this->location  	= $this->candidate->city_name . ", " . $this->candidate->state_sa;
					$this->address 		= "http://" . $this->config->host . $this->config->path;
				}
			}
			
		} else {
			if($this->user && $this->user->info->hometown) {
				$this->city				 = $this->user->info->hometown;
				$this->title 			 = $this->user->info->city_name . " - Ágora Eleições 2012";
				$this->config->path 	 = strtolower($this->user->info->state_sa) . "/" . $this->user->info->city_url;
				$this->location  		 = $this->user->info->city_name . ", " . $this->user->info->state_sa;
				$this->address 			 = "http://" . $this->config->host . "/" . $this->config->path;
			} else {
				// current location
				$currentLocation = new CurrentLocation();

				if ($currentLocation->status) {
					// set current location or/and candidate
					$this->state		= $currentLocation->state;
					$this->city			= $currentLocation->city;

					// url - current location
					$location = $this->validate("location");
					if($location) {
						$this->city			 	 = $location->id;
						$this->title 			 = $location->name . " - Ágora Eleições 2012";
						$this->config->path 	 = strtolower($location->state_sa) . "/" . $location->url;
						$this->location  		 = $location->name . ", " . $location->state_sa;
						$this->address 			 = "http://" . $this->config->host . "/" . $this->config->path;
					}
				}
			}
		}
	}
	
	/**
	 * Public Methods
	 */
	
	public function nav() {
		
		$hometown = "http://" . $this->config->host . "/". strtolower($this->user->info->state_sa) . "/" . $this->user->info->city_url;
		$default  = "http://" . $this->config->host . "/";
		
		$urlHometown = $this->user->info->hometown ? $hometown : $default;
		$isHometown  = $hometown == $this->address ? 'is-active' : 'is-normal';
		
		$html .= '<form class="citynav">';
		$html .= 	'<a href="' . $urlHometown . '" title="Minha cidade" class="citynav__gotomycity tooltip">';
		$html .= 		'<img src="images/icon-gotomycity.png" alt="Minha cidade" />';
		$html .= 	'</a>';
		$html .= 	'<input type="text" name="cityname" class="citynav__cityname" value="' . $this->location . '" autocomplete="off" />';
		$html .= 	'<a href="" id="' . $this->city . '" title="Voto aqui" class="citynav__setmycity tooltip ' . $isHometown . '"></a>';
		$html .=	'<ul class="citynav__searchdropdown is-hidden">';
		$html .=		'<li class="citynav__searchdropdown__item">&nbsp;</li>';
		$html .=	'</ul>';
		$html .= '</form>';
		
		echo $html;
		
	}
	
	public function login() {
		
		$userinfo   = !$this->user ? 'is-hidden' : '';
		$fbconnect  =  $this->user ? 'is-hidden' : '';
		$name		=  $this->user ? $this->user->info->first_name : '';
		$picture	=  $this->user ? 'http://graph.facebook.com/' . $this->user->info->id . '/picture' : 'images/loader-userphoto.gif';
		
		$html .= '<a href="javascript:void(0);" class="fbconnect ' . $fbconnect . '">';
		$html .= 	'<span class="fbconnect__icon"><img src="images/icon-fbconnect.png" alt="Facebook connect" /></span><span class="fbconnect__text">Conecte-se</span>';
		$html .= '</a>';
		$html .= '<div class="userinfo ' . $userinfo . '">';
		$html .= 	'<div class="userinfo__text">';
		$html .= 		'<p class="userinfo__name">' . $name .'</p>';
		$html .= 		'<a href="javascript:void(0);" class="userinfo__logout">Sair</a>';
		$html .= 	'</div>';
		$html .= 	'<img src="' . $picture .'" alt="" class="userinfo__photo" />';
		$html .= '</div>';
		
		echo $html;
		
	}
	
	public function meta() {

		$html = '<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#' . $this->config->appName . ': http://ogp.me/ns/fb/' . $this->config->appName . '#">';
	  	
			$html .= '<base href="http://' . $this->config->host . '" />';
			$html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
			$html .= '<title>' . $this->title . '</title>';
			$html .= '<link rel="stylesheet" href="stylesheets/basic.css" />';
			$html .= '<link rel="stylesheet" href="stylesheets/modules.css" />';
			$html .= '<link rel="stylesheet" href="stylesheets/layout.css" />';
			$html .= '<link rel="shortcut icon" href="images/favicon.ico" />';
			
			$html .= '<meta name="description" content="' . $this->desc . '" />';
			$html .= '<meta name="path" content="' . $this->config->path . '" />';
			
			$html .= '<meta property="fb:app_id" content="' . $this->config->appId . '" /> ';
			$html .= '<meta property="og:title" content="' . $this->title . '" />';
			$html .= '<meta property="og:type" content="' . $this->type . '" />';
			$html .= '<meta property="og:url" content="' . $this->address . '" />';
			$html .= '<meta property="og:image" content="' . $this->image . '" />';
			$html .= '<meta property="og:site_name" content="Ágora" />';
			$html .= '<meta property="og:description" content="' . $this->desc . '" />';
			$html .= '<meta property="og:locale" content="pt_BR" />';

		$html .= '</head>';
		
		echo $html;
		
	}
	
	/**
	 * Private Methods
	 */
	
	private function validate($type) {
		switch($type) {
			case "city" :
			 	$data = db("SELECT id,name,state_sa,url FROM cities_data WHERE url = '" . $this->city . "' AND state_sa = '" . $this->state . "'");
				return count($data) ? $data[0] : 0; 
			break;
			case "candidate" : 
				$data = db("SELECT LOWER(name) AS name,number,party_name,party_acronym,birth_si,supports,id_tse,post_name,city_name,state_sa FROM candidates_data WHERE state_sa = '" . $this->state ."' AND city_url = '" . $this->city ."' AND post_name = '" . $this->post ."' AND url = '" . $this->candidate ."'");
				return count($data) ? $data[0] : 0; 
			break;
			case "location" :
				$data = db("SELECT id,name,state_sa,url FROM cities_data WHERE name = '" . $this->city . "' AND state_name = '" . $this->state . "'");
				return count($data) ? $data[0] : 0;
			break; 
		}	
	}
	
}

?>