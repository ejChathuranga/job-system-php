<?php 


class State extends CI_Controller{

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

	
}
