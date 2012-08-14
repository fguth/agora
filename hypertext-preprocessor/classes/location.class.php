<?php
class CurrentLocation {
	
	public $config;
	public $status;
	public $state;
	public $city;
	
	function __construct() {
		
		// set config 
		$this->config				= new stdClass();
		$this->config->key			= 'SAK5D4YJMZ74754AM94Z';
		// $this->config->ip	 		= IS_LOCAL ? '187.40.46.183' : $_SERVER["REMOTE_ADDR"];
		$this->config->ip	 		= IS_LOCAL ? '200.188.161.30' : $_SERVER["REMOTE_ADDR"];
		$this->config->data			= simplexml_load_file('http://services.ipaddresslabs.com/iplocation/locateip?key=' . $this->config->key . '&ip=' . $this->config->ip);

		// verify data 
		$this->status();

		// apply values
		$this->state();
		$this->city();	
	}

	private function status() {

		if ($this->config->data->query_status->query_status_code == "OK") {
			$this->status = 1;
		} else {
			$this->status = 0;
		}

	}

	private function state() {

		if ($this->status) {
			$this->state = strval($this->config->data->geolocation_data->region_name);
		} else {
			//Default
			$this->state = "Rio Grande do Sul";
		}

	}

	private function city() {

		if ($this->status) {
			$this->city = strval($this->config->data->geolocation_data->city);
		} else {
			//Default
			$this->city = "Porto Alegre";
		}

	}
}
?>