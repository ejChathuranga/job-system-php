<?php 


class State extends CI_Controller{

	function reopen(){

		// $userInput = $this->input->raw_input_stream;
		$array =  json_decode(file_get_contents('php://input'),true);

		if($array == null ){ throw new Exception("request data not setted corretcly", 2); }

		$jobId =  $array['job_id'];


		if ($jobId == NULL) { throw new Exception("job_id is required", 2); }

		$this->load->model('state_model');

		$isAssigned = $this->state_model->reopen($jobId);

		if ($isAssigned) {
			$response = array(
					'code'=> 1,
					'message' => "job  re-open success",
					'data' => ""
					);

			echo json_encode($response);
		}else{
			$response = array(
					'code'=> 2,
					'message' => "job re-open not-success",
					'data' => ""
					);

			echo json_encode($response);
		}

	}


	function close(){

		// $userInput = $this->input->raw_input_stream;
		$array =  json_decode(file_get_contents('php://input'),true);

		if($array == null ){ throw new Exception("request data not setted corretcly", 2); }

		$jobId =  $array['job_id'];


		if ($jobId == NULL) { throw new Exception("job_id is required", 2); }

		$this->load->model('state_model');

		$isAssigned = $this->state_model->close($jobId);

		if ($isAssigned) {
			$response = array(
					'code'=> 1,
					'message' => "job  close success",
					'data' => ""
					);

			echo json_encode($response);
		}else{
			$response = array(
					'code'=> 2,
					'message' => "job close not-success",
					'data' => ""
					);

			echo json_encode($response);
		}

	}

	function finish(){

		// $userInput = $this->input->raw_input_stream;
		$array =  json_decode(file_get_contents('php://input'),true);

		if($array == null ){ throw new Exception("request data not setted corretcly", 2); }

		$jobId =  $array['job_id'];


		if ($jobId == NULL) { throw new Exception("job_id is required", 2); }

		$this->load->model('state_model');

		$isAssigned = $this->state_model->finish($jobId);

		if ($isAssigned) {
			$response = array(
					'code'=> 1,
					'message' => "job  finish success",
					'data' => ""
					);

			echo json_encode($response);
		}else{
			$response = array(
					'code'=> 2,
					'message' => "job finish not-success",
					'data' => ""
					);

			echo json_encode($response);
		}

	}

	function matok(){

		// $userInput = $this->input->raw_input_stream;
		$array =  json_decode(file_get_contents('php://input'),true);

		if($array == null ){ throw new Exception("request data not setted corretcly", 2); }

		$jobId =  $array['job_id'];


		if ($jobId == NULL) { throw new Exception("job_id is required", 2); }

		$this->load->model('state_model');

		$isAssigned = $this->state_model->onProgress($jobId);

		if ($isAssigned) {
			$response = array(
					'code'=> 1,
					'message' => "job material issued success",
					'data' => ""
					);

			echo json_encode($response);
		}else{
			$response = array(
					'code'=> 2,
					'message' => "job material issued not-success",
					'data' => ""
					);

			echo json_encode($response);
		}

	}


	function matreq(){

		// $userInput = $this->input->raw_input_stream;
		$array =  json_decode(file_get_contents('php://input'),true);

		if($array == null ){ throw new Exception("request data not setted corretcly", 2); }

		$jobId =  $array['job_id'];


		if ($jobId == NULL) { throw new Exception("job_id is required", 2); }

		$this->load->model('state_model');

		$isAssigned = $this->state_model->materialRequisition($jobId);

		if ($isAssigned) {
			$response = array(
					'code'=> 1,
					'message' => "job material requisition success",
					'data' => ""
					);

			echo json_encode($response);
		}else{
			$response = array(
					'code'=> 2,
					'message' => "job material requisition not-success",
					'data' => ""
					);

			echo json_encode($response);
		}

	}


	function accept(){

		// $userInput = $this->input->raw_input_stream;
		$array =  json_decode(file_get_contents('php://input'),true);

		if($array == null ){ throw new Exception("request data not setted corretcly", 2); }

		$userId =  $array['user_id'];
		$jobId =  $array['job_id'];


		if ($jobId == NULL) { throw new Exception("job_id is required", 2); }
		if ($userId  == NULL) { throw new Exception("user_id is required", 2); }

		$this->load->model('state_model');

		$isAssigned = $this->state_model->accept($userId, $jobId);

		if ($isAssigned) {
			$response = array(
					'code'=> 1,
					'message' => "job accept success",
					'data' => ""
					);

			echo json_encode($response);
		}else{
			$response = array(
					'code'=> 2,
					'message' => "job accept not-success",
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
		$this->load->model('state_model');

		$isAssigned = $this->state_model->assign($technical_officer_id, $jobId);

		if ($isAssigned) {
			$response = array(
					'code'=> 1,
					'message' => "job assign success",
					'data' => ""
					);

			echo json_encode($response);
		}else{
			$response = array(
					'code'=> 2,
					'message' => "job assign not-success",
					'data' => ""
					);

			echo json_encode($response);
		}

	}

	
}
