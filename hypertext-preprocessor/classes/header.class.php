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
	
	public $path;
	public $state;
	public $state_sa;
	public $city;
	public $city_id;
	public $city_url;
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
		$this->image 	= APP_PROJECT_IMAGE;
		$this->location = "Localização indisponível";
		$this->user		= $user;

		// verify url to set the correct tags
		if ($this->config->parameters.lenght > 1) {
			//set the tags values
			$this->state_sa		= $this->config->parameters[0];
			$this->city_url		= $this->config->parameters[1];
			$this->post			= $this->config->parameters[2];
			$this->candidate 	= $this->config->parameters[3];
		} else {
			// set deafult current location
			$default = new CurrentLocation();
			if ($default->status) {
				$this->state 	= $default->state;
				$this->city_url = $default->city;
			}
		}

		// validade city
		$this->validate('city');

		// set relative infos
		$this->path 	 = $this->state_sa ? strtolower($this->state_sa) . "/" : "";
		$this->path 	.= $this->city_url ? $this->city_url . "/" : "";
		$this->path 	.= $this->post ? $this->post . "/" : "";
		$this->path 	.= $this->candidate ? $this->candidate : "";
		$this->address 	 = "http://" . $this->config->host . "/" . $this->path;
		$this->location  = $this->city . ', ' . $this->state_sa;
		$this->candidate = $this->candidate ? $this->validate('candidate', $this->candidate) : null;
		$this->title = $this->candidate ? ucwords(strtolower($this->candidate->name)) . " - Ágora Eleições 2012" : $this->city . " - Ágora Eleições 2012";
		$this->type  = $this->candidate ? APP_NAME . ":" . APP_CANDIDATE_OBJECT : APP_NAME . ":" . APP_PROJECT_OBJECT;
		$this->image = $this->candidate ? "http://" . $this->config->host . "/images/candidates/" . $this->candidate->id_tse . ".jpg" : $this->image;
		$this->desc  = $this->candidate ? ucwords(strtolower($this->candidate->name)) . " está concorrendo para o cargo de " . $this->candidate->post_name . " da cidade de " . $this->candidate->city_name . "." : $this->desc;

	}
	
	/**
	 * Public Methods
	 */
	
	public function nav() {
		
		$hometown = "http://" . $this->config->host . "/". strtolower($this->user->info->state_sa) . "/" . $this->user->info->city_url;
		$default  = "http://" . $this->config->host . "/";
		
		$urlHometown = $this->user->info->hometown ? $hometown : $default;
		$isHometown  = $this->user->info->hometown == $this->city_id ? 'is-active' : 'is-normal';
		
		$html .= '<form class="citynav">';
		$html .= 	'<a href="' . $urlHometown . '" title="Minha cidade" class="citynav__gotomycity tooltip">';
		$html .= 		'<img src="images/icon-gotomycity.png" alt="Minha cidade" />';
		$html .= 	'</a>';
		$html .= 	'<input type="text" name="cityname" class="citynav__cityname" value="' . $this->location . '" autocomplete="off" />';
		$html .= 	'<a href="" id="' . $this->city_id . '" title="Voto aqui" class="citynav__setmycity tooltip ' . $isHometown . '"></a>';
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
	
	private function validate($type, $candidate = null) {
		switch($type) {
			case "city" :
			 	$data = db("SELECT id,name,state_sa,state_name,url FROM cities_data WHERE url = '" . $this->city_url . "' AND (state_sa = '" . $this->state_sa . "' OR state_name = '" . $this->state . "')");
				$this->city			= $data[0]->name;
				$this->city_id		= $data[0]->id;
				$this->city_url		= $data[0]->url;
				$this->state 		= $data[0]->state_name;
				$this->state_sa 	= $data[0]->state_sa;
			break;
			case "candidate" : 
				$data = db("SELECT LOWER(name) AS name,number,party_name,party_acronym,birth_si,supports,id_tse,post_name,city_name,state_sa FROM candidates_data WHERE state_sa = '" . $this->state_sa ."' AND city_url = '" . $this->city_url ."' AND post_name = '" . $this->post ."' AND url = '" . $candidate ."'");
				return count($data) ? $data[0] : header("Location:/ooooops/"); 
			break;
			case "location" :
				$data = db("SELECT id,name,state_sa,url FROM cities_data WHERE name = '" . $this->city . "' AND state_name = '" . $this->state . "'");
				return count($data) ? $data[0] : header("Location:/ooooops/");
			break; 
		}	
	}
	
}

?>