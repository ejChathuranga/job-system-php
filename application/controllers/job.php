<?php 


class Job extends CI_Controller{

	function accept(){

		// $userInput = $this->input->raw_input_stream;
		$array =  json_decode(file_get_contents('php://input'),true);

		if($array == null ){ throw new Exception("request data not setted corretcly", 2); }

		$userId =  $array['user_id'];
		$jobId =  $array['job_id'];


		if ($jobId == NULL) { throw new Exception("job_id is required", 2); }
		if ($userId  == NULL) { throw new Exception("user_id is required", 2); }

		$this->load->model('job_model');

		$isAssigned = $this->job_model->accept($userId, $jobId);

		if ($isAssigned) {
			$response = array(
					'code'=> 1,
					'message' => "user accept success",
					'data' => ""
					);

			echo json_encode($response);
		}else{
			$response = array(
					'code'=> 2,
					'message' => "user accept not-success",
					'data' => ""
					);

			echo json_encode($response);
		}

	}

	function assign(){


		$array =  json_decode(file_get_contents('php://input'),true);

		if($array == null) { throw new Exception("request data not setted corretcly", 2);}

		$jobId = $array["job_id"];
		$technical_officer_id = $array["technical_officer_id"];

		if ($jobId == NULL) { throw new Exception("job_id is required", 1); }
		if ($technical_officer_id == NULL) { throw new Exception("technical_officer_id is required", 1); }


		// load the job module in context
		$this->load->model('job_model');

		$isAssigned = $this->job_model->assign($technical_officer_id, $jobId);

		if ($isAssigned) {
			$response = array(
					'code'=> 1,
					'message' => "user assign success",
					'data' => ""
					);

			echo json_encode($response);
		}else{
			$response = array(
					'code'=> 2,
					'message' => "user assign not-success",
					'data' => ""
					);

			echo json_encode($response);
		}

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