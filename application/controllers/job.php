<?php 


class Job extends CI_Controller{

	function assign(){
		if ($this->input->post("job_id") == NULL) { throw new Exception("job_id is required", 1); }
		if ($this->input->post("technical_officer_id") == NULL) { throw new Exception("technical_officer_id is required", 1); }


		// load the job module in context
		$this->load->model('job_model');

		$isAssigned = $this->job_model->assign($this->input->post("technical_officer_id"), $this->input->post("job_id"));

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


		if ($this->input->post("user_id") == NULL) { throw new Exception("user_id is required", 1); }
		if ($this->input->post("title") == NULL) { throw new Exception("title is required", 1); }
		if ($this->input->post("description") == NULL) { throw new Exception("description is required", 1); }
		if ($this->input->post("branch_id") == NULL) { throw new Exception("branch_id is required", 1); }
		if ($this->input->post("priority") == NULL) { throw new Exception("priority is required", 1); }


		$this->load->helper('date');
		$timestamp = time();

		$data = array(
			'branch_manager_id' => $this->input->post("user_id"),
			'maintence_manager_id' => 1,
			'technical_officer_id' => NULL,
			'warehouse_manager_id' => NULL,
			'title' => $this->input->post("title"),
			'description' => $this->input->post("description"),
			'branch_id' => $this->input->post("branch_id"),
			'priority' => $this->input->post("priority"),
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