<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

	function home(){
		$userId = $this->input->get('userid');
		$rollId = $this->input->get('rollid');
		$branchId = $this->input->get('branchid');

		if ($userId == null) { throw new Exception("userId cannot be empty", 2); }
		if ($rollId == null) { throw new Exception("rollId cannot be empty", 2); }

		$this->load->model('user_model');

		// 1 = maintences manager, 2 = branch manager, 3 = technical officer, 4 = store manager
		if ($rollId == 1) {
			$jobList = $this->user_model->getHomeMain($userId);
			sendHomeResponse($jobList);
		}else if ($rollId == 2) {
			$jobList = $this->user_model->getHomeBranch($userId);
			sendHomeResponse($jobList);
		}else if ($rollId == 3) {
			$jobList = $this->user_model->getHomeTech($userId);
			sendHomeResponse($jobList);
		}else if ($rollId == 4) {
			$jobList = $this->user_model->getHomeWare($userId);
			sendHomeResponse($jobList);
		}
	}

	function sendHomeResponse($jobList){
			if ($jobList != null) {
				$response = array(
					'code'=> 1,
					'message' => "data fetch success",
					'data' => $jobList
					);

				echo json_encode($response);
			}else{
				$response = array(
					'code'=> 1,
					'message' => "data fetch success",
					'data' => $jobList
					);

				echo json_encode($response);
			}
	}
}