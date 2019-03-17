<?php

// model for auth user request. Inhere will check existing user's and weill genarate response according to that
class Job_model extends CI_Model{

	function assign($technicalOfficerId, $jobId){
		$this->db->set('technical_officer_id', $technicalOfficerId);
		$this->db->set('state_id', 2);
		$this->db->where('id', $jobId);
		$isUpdated = $this->db->update('job');

		if ($isUpdated) {
			return true;
		}else{
			return false;
		}
	}

	// insert job details into table
	function insert($data){
		$query = $this->db->insert('job', $data);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}
}