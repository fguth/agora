<?php
class CurrentLocation {
	
	public $config;
	public $state;
	public $city;
	
	function CurrentLocation() {
		
		// set config 
		$this->config				= new stdClass();
		$this->config->key			= 'SAK5D4YJMZ74754AM94Z';
		$this->config->ip	 		= IS_LOCAL ? '187.40.46.183' : $_SERVER["REMOTE_ADDR"];
		$this->config->data			= simplexml_load_file('http://services.ipaddresslabs.com/iplocation/locateip?key=' . $this->config->key . '&ip=' . $this->config->ip);
		
		//apply values
		$this->state();
		$this->city();
		
	}
	
	private function state() {
		
		if ($this->config->data) {
			$this->state = strval($this->config->data->geolocation_data->region_name);
		} else {
			return null;
		}
		
	}
	
	private function city() {
		
		if ($this->config->data) {
			$this->city = strval($this->config->data->geolocation_data->city);
		} else {
			return null;
		}
		
	}
	
}
?>