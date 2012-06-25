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
	
	
	public function support($user = false, $candidate = false, $publish_id = false) {
		if ($user && $candidate && $publish_id) {
			db("INSERT INTO supports (user,candidate,publish_id) VALUES (" . $user . "," . $candidate . "," . $publish_id . ")");
		}	
	}
	
	public function unsupport($user = false, $candidate = false) {
		if ($user && $candidate) {
			$db 		= db("SELECT publish_id FROM supports WHERE user=" . $user . " AND candidate=" . $candidate);
			$publish_id = (int) $result[0]->publish_id;
			
			if($publish_id) {
				$db = db("DELETE FROM supports WHERE publish_id=" . $publish_id);
				return $publish_id;
			}
		}	
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