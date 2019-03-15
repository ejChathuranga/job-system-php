<?php

class Auth_model extends CI_Model{

	function can_login($un, $pw){

		$this->db->where('username', $un);
		$this->db->where('password', $pw);

		$query = $this->db->get('employee');
		if ($query->num_rows()>0) {
			return $query->result();
			//return true;
		}else{
			return NULL;
		}

	}

}