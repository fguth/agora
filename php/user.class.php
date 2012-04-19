<?php

class User {
	
	/**
	 * Class Parameters
	 */
	
	public $data;
	public $token; 
	
	/**
	 * Public Methods
	 */
	
	public function data($data) {
		$this->data							= new stdClass();
		$this->data->id						= $this->value($data['id']);
		$this->data->verified  				= $this->verified($this->value($data['verified']));
		$this->data->name 					= $this->value($data['name']);
		$this->data->first_name 			= $this->value($data['first_name']);
		$this->data->last_name 				= $this->value($data['last_name']);
		$this->data->username 				= $this->value($data['username']);
		$this->data->email 					= $this->value($data['email']);
		$this->data->birthday 				= date('Y/m/d', strtotime($this->value($data['birthday'])));
		$this->data->gender 				= $this->gender($this->value($data['gender']));
		$this->data->bio	 				= $this->value($data['bio']);
		$this->data->hometown 				= $this->value($data['hometown']);
		$this->data->location 				= $this->value($data['location']);
		$this->data->bio 					= $this->value($data['bio']);
		$this->data->work 					= $this->value($data['work']);
		$this->data->sports 				= $this->value($data['sports']);
		$this->data->favorite_teams 		= $this->value($data['favorite_teams']);
		$this->data->favorite_athletes		= $this->value($data['favorite_athletes']);
		$this->data->inspirational_people	= $this->value($data['inspirational_people']);
		$this->data->education				= $this->value($data['education']);
		$this->data->languages				= $this->value($data['languages']);
		$this->data->music 					= json_decode(file_get_contents("https://graph.facebook.com/me/music?access_token=" . $this->token));
		$this->data->books 					= json_decode(file_get_contents("https://graph.facebook.com/me/books?access_token=" . $this->token));
		$this->data->television 			= json_decode(file_get_contents("https://graph.facebook.com/me/television?access_token=" . $this->token));
		$this->data->activities 			= json_decode(file_get_contents("https://graph.facebook.com/me/activities?access_token=" . $this->token));
		$this->data->interests 				= json_decode(file_get_contents("https://graph.facebook.com/me/interests?access_token=" . $this->token));
		$this->data->movies 				= json_decode(file_get_contents("https://graph.facebook.com/me/movies?access_token=" . $this->token));
		$this->data->timezone 				= $this->value($data['timezone']);
		$this->data->json 					= json_encode($this);
		$this->data->created_date 			= date('Y/m/d h:i');
		$this->data->last_access 			= date('Y/m/d h:i');
	}
	
	public function token($token = false) {
		if ($token) {
			$this->token = $token;
		} else {
			return $this->token;
		}
	}
	
	public function validate() {
		return $this->data && $this->token ? true : false;
	}
	
	public function create() {
		db("INSERT INTO 
					users (id,name,first_name,last_name,username,email,gender,birthday,timezone,verified,json,created_date,last_access) 
			VALUES ('" . $this->data->id . "',
					'" . $this->data->name . "',
					'" . $this->data->first_name . "',
					'" . $this->data->last_name . "',
					'" . $this->data->username . "',
					'" . $this->data->email . "',
					'" . $this->data->gender . "',
					'" . $this->data->birthday . "',
					'" . $this->data->timezone . "',
					'" . $this->data->verified . "',
					'" . $this->data->json . "',
					'" . $this->data->created_date . "',
					'" . $this->data->last_access . "')
		");
	}
	
	public function update() {
		db("UPDATE users SET 
						 	name = '" . $this->data->name . "',
							first_name = '" . $this->data->first_name . "',
							last_name = '" . $this->data->last_name . "',
							username = '" . $this->data->username . "',
							email = '" . $this->data->email . "',
							gender = '" . $this->data->gender . "',
							birthday = '" . $this->data->birthday . "',
							timezone = '" . $this->data->timezone . "',
							verified = '" . $this->data->verified . "',
							json = '" . $this->data->json . "',
							last_access = '" . $this->data->last_access . "' 
						WHERE
							id ='" . $this->data->id . "'
		");
	}
	
	public function exist() {
		return count(db("SELECT id FROM users WHERE id = " . $this->data->id)) ? true : false;
	}
	
	public function verify() {
		return $this->data->verified == 1 ? true : false;
	}
	
	/**
	 * Private Methods
	 */
	
	private function value($verify) {
		return empty($verify) ? null : $verify;
	}
	
	private function verified($verify) {
		return $verify == "true" ? 1 : 0;
	}
	
	private function gender($verify) {
		return $verify == "male" ? 1 : 2;
	}

}

?>