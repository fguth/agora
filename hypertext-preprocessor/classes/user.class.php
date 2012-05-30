<?php

class User {

	/**
	 * Class Parameters
	 */
	
	public $id;
	public $token;
	public $info;
	
	/**
	 * Constructor
	 */

	function __construct($id,$token) {
		if($id && $token) {
			$this->id 	 = $id;	
			$this->token = $token;
		} else {
			exit();
		}
	}

	/**
	 * Public Methods
	 */

	public function validate($data = null) {
		if ($this->exist()) {
			if ($this->uptodate()) {
				$this->getInfo();
				$this->release();
			} else {
				$this->parseInfo($data);
				$this->update();
				$this->getInfo();
			}
		} else {
			$this->parseInfo($data);
			$this->create();
		}
	}

	public function getInfo() {
		$result = db("SELECT * FROM users_data WHERE id=" . $this->id);
		$data 	= count($result) ? $result[0] : null;
		if($data) {			
			$this->info							= new stdClass();
			$this->info->id						= $data->id;
			$this->info->name 					= $data->name;
			$this->info->first_name 			= $data->first_name;
			$this->info->last_name 				= $data->last_name;
			$this->info->username 				= $data->username;
			$this->info->email 					= $data->email;
			$this->info->gender 				= $data->gender;
			$this->info->hometown 				= $data->hometown;
			$this->info->city_name 				= $data->city_name;
			$this->info->city_url 				= $data->city_url;
			$this->info->state_name				= $data->state_name;
			$this->info->state_sa				= $data->state_sa;
			$this->info->timezone 				= $data->timezone;
			$this->info->birthday 				= $data->birthday;
			$this->info->created_date 			= $data->created_date;
			$this->info->last_access 			= $data->last_access;
			$this->info->json 					= $data->json;
		}
	}
	
	public function create() {	
		db("INSERT INTO users (id,name,first_name,last_name,username,email,gender,birthday,timezone,json,created_date,last_access) 
			VALUES ('" . $this->info->id . "',
					'" . $this->info->name . "',
					'" . $this->info->first_name . "',
					'" . $this->info->last_name . "',
					'" . $this->info->username . "',
					'" . $this->info->email . "',
					'" . $this->info->gender . "',
					'" . $this->info->birthday . "',
					'" . $this->info->timezone . "',
					'" . $this->info->json . "',
					'" . $this->info->created_date . "',
					'" . $this->info->last_access . "')
		");
	}

	public function update() {
		db("UPDATE users 
			SET name = '" . $this->info->name . "',
				first_name = '" . $this->info->first_name . "',
				last_name = '" . $this->info->last_name . "',
				username = '" . $this->info->username . "',
				email = '" . $this->info->email . "',
				gender = '" . $this->info->gender . "',
				birthday = '" . $this->info->birthday . "',
				timezone = '" . $this->info->timezone . "',
				json = '" . $this->info->json . "',
				last_access = '" . $this->info->last_access . "' 
			WHERE
				id ='" . $this->id . "'
		");
	}
	
	public function hometown($city) {
		db("UPDATE users 
			SET hometown = '" . $city . "'
			WHERE id ='" . $this->id . "'
		");
	}
	
	public function exist() {
		if($id) {
			return count(db("SELECT id FROM users WHERE id = " . $id)) ? true : false;
		} else {
			return count(db("SELECT id FROM users WHERE id = " . $this->id)) ? true : false;
		}
	}
	
	/**
	 * Private Methods
	 */
	
	private function parseInfo($data) {
		$this->info							= new stdClass();
		$this->info->id						= $data['id'];
		$this->info->name 					= $data['name'];
		$this->info->first_name 			= $data['first_name'];
		$this->info->last_name 				= $data['last_name'];
		$this->info->username 				= $data['username'];
		$this->info->email 					= $data['email'];
		$this->info->gender 				= $data['gender'] == "male" ? 2 : 1;
		$this->info->timezone 				= $data['timezone'];
		$this->info->work 					= $data['work'];
		$this->info->sports 				= $data['sports'];
		$this->info->favorite_teams 		= $data['favorite_teams'];
		$this->info->favorite_athletes		= $data['favorite_athletes'];
		$this->info->inspirational_people	= $data['inspirational_people'];
		$this->info->education				= $data['education'];
		$this->info->languages				= $data['languages'];
		$this->info->music 					= json_decode(file_get_contents("https://graph.facebook.com/me/music?access_token=" . $this->token));
		$this->info->books 					= json_decode(file_get_contents("https://graph.facebook.com/me/books?access_token=" . $this->token));
		$this->info->television 			= json_decode(file_get_contents("https://graph.facebook.com/me/television?access_token=" . $this->token));
		$this->info->activities 			= json_decode(file_get_contents("https://graph.facebook.com/me/activities?access_token=" . $this->token));
		$this->info->interests 				= json_decode(file_get_contents("https://graph.facebook.com/me/interests?access_token=" . $this->token));
		$this->info->movies 				= json_decode(file_get_contents("https://graph.facebook.com/me/movies?access_token=" . $this->token));
		$this->info->birthday 				= date('Y/m/d', strtotime($data['birthday']));
		$this->info->created_date 			= date('Y/m/d h:i');
		$this->info->last_access 			= date('Y/m/d h:i');
		$this->info->json 					= addslashes(json_encode($this->info));
	}

	private function release() {
		db("UPDATE users 
			SET last_access = '" . date('Y/m/d h:i') . "' 
			WHERE id ='" . $this->id . "'");
	}
	
	private function uptodate() {
		$result 	= db("SELECT DATE_FORMAT(last_access, '%Y%m%d') as date FROM users WHERE id=" . $this->id);
		$date 		= (int) $result[0]->date;
		$current 	= (int) date('Ymd');
		return $date < $current ? false : true;		
	}

}

?>