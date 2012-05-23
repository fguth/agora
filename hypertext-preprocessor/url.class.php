<?php

class Url {
	
	/**
	 * Class Parameters
	 */
	
	public $config;
	public $title;
	public $desc;
	public $type;
	public $image;
	public $address;
	
	public $state;
	public $city;
	public $post;
	public $candidate;
	
	/**
	 *  Constructor
	 */
	
	public function __construct($host,$path) {
		
		// set config 
		$this->config				= new stdClass();
		$this->config->appName 		= APP_NAME;
		$this->config->appId 		= APP_ID;
		$this->config->host 		= $host;
		$this->config->path 		= $path;
		$this->config->parameters 	= preg_split("/\\" . DIRECTORY_SEPARATOR . "/", $this->config->path,-1, PREG_SPLIT_NO_EMPTY); 
		
		// verify url to set the correct tags
		if ($this->config->parameters) {
			
			// set location or/and candidate
			$this->state		= $this->config->parameters[0];
			$this->city			= $this->config->parameters[1];
			$this->post			= $this->config->parameters[2];
			$this->candidate	= $this->config->parameters[3];
			
			if ($this->state && $this->city && !$this->post && !$this->candidate) {
				// url - has state/city
				$city = $this->validate("city");
				
				if($city) {
					$this->title 		= $city . " - Ágora Eleições 2012";
					$this->desc 		= "Ágora é uma plataforma para discussão política. Indique sua intenção de voto e debata propostas para as Eleições 2012.";
					$this->type 		= APP_NAME . ":" . APP_PROJECT_OBJECT;
					$this->image 		= "https://fbcdn-sphotos-a.akamaihd.net/hphotos-ak-ash3/523977_279169475490552_274490955958404_623177_1354285026_n.jpg";
					$this->address 		= 'http://' . $this->config->host . $this->config->path;
				} else {
					
				}
				
			} else if ($this->state && $this->city && $this->post && $this->candidate) {
				// url - has state/city/post/candidate
				$candidate = $this->validate("candidate");
				
				if($candidate) {
					$this->title 		= $candidate->name . " - Ágora Eleições 2012";
					$this->desc 		= $candidate->name . " está concorrendo para o cargo de " . $candidate->post_name . " da cidade de " . $candidate->city_name . ".";
					$this->type 		= APP_NAME . ":" . APP_CANDIDATE_OBJECT;
					$this->image 		= "https://fbcdn-sphotos-a.akamaihd.net/hphotos-ak-ash3/523977_279169475490552_274490955958404_623177_1354285026_n.jpg";
					$this->address 		= 'http://' . $this->config->host . $this->config->path;
				} else {
					
				}
				
			}
		} else {
			
			// current location
			$currentLocation = new CurrentLocation();
			
			// set current location or/and candidate
			$this->state		= $currentLocation->state;
			$this->city			= $currentLocation->city;
			
			// url - current location
			$location = $this->validate("location");
			
			if($location) {
				$this->title 		= $location->name . " - Ágora Eleições 2012";
				$this->desc 		= "Ágora é uma plataforma para discussão política. Indique sua intenção de voto e debata propostas para as Eleições 2012.";
				$this->type 		= APP_NAME . ":" . APP_PROJECT_OBJECT;
				$this->image 		= "https://fbcdn-sphotos-a.akamaihd.net/hphotos-ak-ash3/523977_279169475490552_274490955958404_623177_1354285026_n.jpg";
				$this->address 		= 'http://' . $this->config->host . '/' . strtolower($location->state_sa) . '/' . $location->url;
			} else {
				
			}
		}
		
	}
	
	/**
	 * Private Methods
	 */
	
	private function validate($type) {
		switch($type) {
			case "city" :
			 	$data = db("SELECT name FROM cities_data WHERE url = '" . $this->city . "' AND state_sa = '" . $this->state . "'");
				return count($data) ? $data[0]->name : false; 
			break;
			case "candidate" : 
				$data = db("SELECT name,post_name,city_name FROM candidates_data WHERE state_sa = '" . $this->state ."' AND city_url = '" . $this->city ."' AND post_name = '" . $this->post ."' AND url = '" . $this->candidate ."'");
				return count($data) ? $data[0] : false; 
			break;
			case "location" :
				$data = db("SELECT name,state_sa,url FROM cities_data WHERE name = '" . $this->city . "' AND state_name = '" . $this->state . "'");
				return count($data) ? $data[0] : false;
			break; 
		}	
	}
	
}

?>