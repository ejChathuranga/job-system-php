<?php

// model for auth user request. Inhere will check existing user's and weill genarate response according to that
class Job_model extends CI_Model{

	/**
	* state ids
	* 1 = pending, 2= assigned, 3=acccept, 4=material req, 5=onProgress, 6=finish, 7=re-open, 8=close
	*
	*roll ids
	* 1 = maintences manager, 2 = branch manager, 3 = technical officer, 4 = store manager
	*/

	function allJobs($userId){

		$roll_id = $this->getUserRoll($userId);

		return $this->getJobs($roll_id, $userId);
		
	}

	function getJobs($roll_id, $userId){
		
		switch ($roll_id) {
			case '1':
				$this->db->where('maintence_manager_id', $userId);
				$query = $this->db->get('job');
				if($query->num_rows()>0){
					return $query->result();
				}else{
					return "No data to show";
				}
				break;
			
			case '2':
				$this->db->where('branch_manager_id', $userId);
				$query = $this->db->get('job');
				if($query->num_rows()>0){
					return $query->result();
				}else{
					return "No data to show";
				}
				break;
			
			case '3':
				$this->db->where('technical_officer_id', $userId);
				$query = $this->db->get('job');
				if($query->num_rows()>0){
					return $query->result();
				}else{
					return "No data to show";
				}
				break;
			
			case '4':
				$this->db->where('warehouse_manager_id', $userId);
				$query = $this->db->get('job');
				if($query->num_rows()>0){
					return $query->result();
				}else{
					return "No data to show";
				}
				break;
			
			default:
				break;
		}

	}

	function pending($userId, $jobId){

		$roll_id = $this->getUserRoll($userId);

		$this->db->where('id', $jobId);
		$this->db->where('password', $pw);
	}

	function getPendings($rollId, $stateId, $userId){

		switch ($rollId) {
			case '1':
				$this->db->where('maintence_manager_id', $userId);
				$this->db->where('state_id', $stateId);
				$jobList = $this->db->get('job');
				break;
			
			default:
				break;
		}

	}

	function getUserRoll($userId){
		$this->db->where('id', $userId);
		$query = $this->db->get('employee');
		if($query->num_rows()>0){
			return $query->result()[0]->roll_id;
		}
	}

	// insert job details into table
	function addNewJob($data){
		$query = $this->db->insert('job', $data);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}
}