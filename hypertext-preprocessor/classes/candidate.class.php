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
	
	
	public function support($user = false, $candidate = false, $publish_id = false, $post = false, $city = false) {
		if ($user && $candidate && $publish_id && $post && $city) {
			db("CALL user_support_candidate(" . $user . "," .  $publish_id . "," .  $candidate . "," . $post . "," .  $city . ")");
		}	
	}
	
	public function unsupport($user = false, $candidate = false) {
		if ($user && $candidate) {
			$result 	= db("SELECT publish_id FROM supports WHERE user=" . $user . " AND candidate=" . $candidate);
			$publish_id = (int) $result[0]->publish_id;
			
			if($publish_id) {
				$db = db("DELETE FROM supports WHERE user=" . $user . " AND candidate=" . $candidate);
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