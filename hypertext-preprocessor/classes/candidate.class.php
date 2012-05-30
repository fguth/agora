<?php

class Candidate {
	
	/**
	 * Class Parameters
	 */
	
	public $id;
	public $token;
	 
	
	/**
	 * Public Methods
	 */
	
	public function id($id = false) {
		if ($id) {
			$this->id = $id;
		} else {
			return $this->id;
		}
	}
	
	public function token($token = false) {
		if ($token) {
			$this->token = $token;
		} else {
			return $this->token;
		}
	}
	
	
	public function support($user_id = false) {
		
		if ($user_id) {
			/*db("INSERT INTO 
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
			");*/
		}
		
	}
	
	public function unsupport($user_id = false) {
		
		$support_id = null;
		
		if ($user_id) {
			/*db("INSERT INTO 
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
			");*/
		}
		
		return $support_id;
		
	}
	
	public function exist($id = false) {
		if ($id) {
			return count(db("SELECT id FROM candidates WHERE id = " . $id)) ? true : false;
		} else {
			return count(db("SELECT id FROM candidates WHERE id = " . $this->id)) ? true : false;
		}
		
	}
	
}

?>