<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$query = $this->db->query('SELECT * FROM `roll`');
		echo json_encode($query->result());
	}

	public function login()
	{
		//echo "string";

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->load->model('auth_model');

		if ($this->auth_model->can_login($username, $password)) {

			// $response->data = $this->auth_model->can_login($username, $password);
			// $response->code = 1;
			// $response->message = "Authenticate success"

			$response = array(
				'data' => $this->auth_model->can_login($username, $password),
				'code' => 1,
				'message' => "Authenticate success"
				);

			echo json_encode($response);
			
			// $session_data = array('username' => $username);

			// $this->session->set_userdata($session_data);
			// redirect(base_url().'auth/enter');

		}else{

			$response->code = 2;
			$response->message = "Authenticate fails";
			$response->data = "";
			echo $response;
			// $this->session->set_flashdata('error', 'invalid username and password');
			// redirect(base_url().'auth/login');
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
