<?php
defined('BASEPATH') or exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

// class for authenticate user
//

class Auth extends CI_Controller
{

    // user auth endpoint
    public function login()
    {

        $array = json_decode(file_get_contents('php://input'), true);

        $username = $array["username"];
        $password = $array["password"];

        if ($username == null) {
            $this->response("username cannot be empty", 2, "Auth Fail");
            exit();
        }
        if ($password == null) {
            $this->response("password cannot be empty", 2, "Auth Fail");
            exit();
        }

        $this->load->model('auth_model');

        $data = $this->auth_model->can_login($username, $password);

        if ($data == null) {
            $this->response("auth fail, username and password not matched", 2, "Auth Fail");
        } else {
            $this->response($data, 1, "Auth success!");
        }
    }

    public function response($data, $code, $message)
    {
        $response = array(
            'data' => $data,
            'code' => $code,
            'message' => $message,
        );

        echo json_encode($response);
    }

    public function enter()
    {
        if ($this->session->userdata('username') != '') {
            echo "<h2>welcome - " . $this->session->userdata('username') . "</h2>";

        } else {
            redirect(base_url . 'auth/login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        redirect(base_url() . 'auth/login');
    }
}
