<?php
class Auth {
	
	public $user;
	public $id;
	public $token;
	private $facebook;
	
	function __construct() {
		// set config 
		$this->facebook	= new Facebook(array('appId'  => APP_ID,'secret' => APP_SECRET));
		// session info
		$this->id 		= $this->facebook->getUser();
		$this->token 	= $this->facebook->getAccessToken();
		//check if already login
		$this->check();	
	}
	
	// private functions

	private function check() {
		if ($this->id && $this->token) {
			try {
				$this->user = new User($this->id,$this->token);
				$this->user->validate($this->facebook->api('/me'));
			} catch (FacebookApiException $e) {
				$this->user = null;
			}
		}
	}
	
}
?>