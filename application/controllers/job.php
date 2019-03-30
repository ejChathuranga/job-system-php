<?php 


class Job extends CI_Controller{

	// function oldJob----------------

	function pending(){
		$array =  json_decode(file_get_contents('php://input'),true);
		
		if($array == null) { throw new Exception("request data not setted corretcly", 2);}

		$userId = $array["user_id"];

		if ($userId == NULL) { throw new Exception("user_id is required", 1); }

		// load the job module in context
		$this->load->model('job_model');


	}

	function add(){
		$array =  json_decode(file_get_contents('php://input'),true);
		
		if($array == null) { throw new Exception("request data not setted corretcly", 2);}

		$userId = $array["user_id"];
		$title = $array["title"];
		$description = $array["description"];
		$branchId = $array["branch_id"];
		$priority = $array["priority"];


		if ($userId == NULL) { throw new Exception("user_id is required", 1); }
		if ($title == NULL) { throw new Exception("title is required", 1); }
		if ($description == NULL) { throw new Exception("description is required", 1); }
		if ($branchId == NULL) { throw new Exception("branch_id is required", 1); }
		if ($pri == NULL) { throw new Exception("priority is required", 1); }


		$this->load->helper('date');
		$timestamp = time();

		$data = array(
			'branch_manager_id' => $userId,
			'maintence_manager_id' => 1,
			'technical_officer_id' => NULL,
			'warehouse_manager_id' => NULL,
			'title' => $title,
			'description' => $description,
			'branch_id' => $branchId,
			'priority' => $priority,
			'timestamp' => $timestamp,
			'state_id' => 1,
			'job_hours' => NULL
		);

		// load the job module in context
		$this->load->model('job_model');

		// call insert function in the module
		if ($this->job_model->insert($data)) {
			$response = array(
					'code'=> 1,
					'message' => "data insert success",
					'data' => ""
					);

			echo json_encode($response);
		}else{
			$response = array(
					'code'=> 2,
					'message' => "data insert not-success",
					'data' => ""
					);

			echo json_encode($response);
		}
	}
}