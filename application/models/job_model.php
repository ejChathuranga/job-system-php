<?php

// model for auth user request. Inhere will check existing user's and weill genarate response according to that
class Job_model extends CI_Model{


	function reopen($jobId){
		$this->db->set('state_id', 7);
		$this->db->where('id', $jobId);
		$isAccepted = $this->db->update('job');

		if ($isAccepted) {
			return true;
		}else{
			return false;
		}
	}

	function close($jobId){
		$this->db->set('state_id', 8);
		$this->db->where('id', $jobId);
		$isAccepted = $this->db->update('job');

		if ($isAccepted) {
			return true;
		}else{
			return false;
		}
	}

	function finish($jobId){
		$this->db->set('state_id', 6);
		$this->db->where('id', $jobId);
		$isAccepted = $this->db->update('job');

		if ($isAccepted) {
			return true;
		}else{
			return false;
		}
	}


	function onProgress($jobId){
		$this->db->set('state_id', 5);
		$this->db->where('id', $jobId);
		$isAccepted = $this->db->update('job');

		if ($isAccepted) {
			return true;
		}else{
			return false;
		}
	}


	function materialRequisition($jobId){
		$this->db->set('warehouse_manager_id', 4);
		$this->db->set('state_id', 4);
		$this->db->where('id', $jobId);
		$isAccepted = $this->db->update('job');

		if ($isAccepted) {
			return true;
		}else{
			return false;
		}
	}

	function accept($userId, $jobId){
		$this->db->set('state_id', 3);
		$this->db->where('id', $jobId);
		$isAccepted = $this->db->update('job');

		if ($isAccepted) {
			return true;
		}else{
			return false;
		}
	}

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