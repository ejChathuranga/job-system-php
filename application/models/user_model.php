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

	function getHomeBranch($userId){
		$this->db->where('branch_manager_id', $userId);
		$jobList = $this->db->get('job');

		if ($jobList->num_rows() > 0) {
			return $jobList->result();
		}else{
			return "no data to show";
		}
	}

	function getHomeTech($userId){
		$this->db->where('technical_officer_id', $userId);
		$jobList = $this->db->get('job');

		if ($jobList->num_rows() > 0) {
			return $jobList->result();
		}else{
			return "no data to show";
		}
	}

	function getHomeWare($userId){
		$this->db->where('warehouse_manager_id', $userId);
		$jobList = $this->db->get('job');

		if ($jobList->num_rows() > 0) {
			return $jobList->result();
		}else{
			return "no data to show";
		}
	}
}
