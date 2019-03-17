<?php

class User_model extends CI_Model{

	function getHomeMain($userId){
		$this->db->where('maintence_manager_id', $userId);
		$jobList = $this->db->get('job');

		if ($jobList->num_rows() > 0) {
			return $jobList->result();
		}else{
			return "no data to show";
		}
	}
}
