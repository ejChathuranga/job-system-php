<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// class for authenticate user
// 

class Auth extends CI_Controller {


	// user auth endpoint 
	public function login()
	{

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if ($username == null) {
			throw new Exception("username cannot be empty", 2);
			
		}
		if ($password == null) {
			throw new Exception("password cannot be empty", 2);
			
		}

		$this->load->model('auth_model');

		if ($this->auth_model->can_login($username, $password)) {

			$response = array(
				'data' => $this->auth_model->can_login($username, $password),
				'code' => 1,
				'message' => "Authenticate success"
				);

			echo json_encode($response);

		}else{
			$response = array(
				'data' => null,
				'code' => 2,
				'message' => "Authenticate fails"
			);
			echo json_encode($response);
		}
	}


	function enter(){
		if ($this->session->userdata('username') != '') {
			echo "<h2>welcome - " . $this->session->userdata('username') ."</h2>";

		}else{
			redirect(base_url. 'auth/login');
		}
	}

	function logout(){
		$this->session->unset_userdata('username');
		redirect(base_url(). 'auth/login');
	}
}
