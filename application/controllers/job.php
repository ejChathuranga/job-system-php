<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

class Job extends CI_Controller
{
    // 1 = pending, 2= assigned, 3=acccept, 4=material req, 5=onProgress, 6=finish, 7=re-open, 8=close

    public function itemsearch(){
        $array = json_decode(file_get_contents('php://input'), true);
        if ($array == null) {$this->sendResponse("check request", "requeted data not correct", 2);exit();}
        $word = $array["word"];
        if ($word == null) {$this->sendResponse("searching word is required", "check searching key is entered", 2);exit();}
        // load the job module in context
        $this->load->model('job_model');
        $data = $this->job_model->getQuickSearch($word);
        $this->sendResponse($data, "Data fetch success", 1);
    }

    public function close()
    {
        $array = json_decode(file_get_contents('php://input'), true);
        if ($array == null) {$this->sendResponse("check request", "requeted data not correct", 2);exit();}
        $userId = $array["user_id"];
        if ($userId == null) {$this->sendResponse("user_id is required", "check user id", 2);exit();}
        // load the job module in context
        $this->load->model('job_model');
        $data = $this->job_model->getStateData($userId, 8);
        $this->sendResponse($data, "Data fetch success", 1);
    }

    public function reopen()
    {
        $array = json_decode(file_get_contents('php://input'), true);
        if ($array == null) {$this->sendResponse("check request", "requeted data not correct", 2);exit();}
        $userId = $array["user_id"];
        if ($userId == null) {$this->sendResponse("user_id is required", "check user id", 2);exit();}
        // load the job module in context
        $this->load->model('job_model');
        $data = $this->job_model->getStateData($userId, 7);
        $this->sendResponse($data, "Data fetch success", 1);
    }

    public function finish()
    {
        $array = json_decode(file_get_contents('php://input'), true);
        if ($array == null) {$this->sendResponse("check request", "requeted data not correct", 2);exit();}
        $userId = $array["user_id"];
        if ($userId == null) {$this->sendResponse("user_id is required", "check user id", 2);exit();}
        // load the job module in context
        $this->load->model('job_model');
        $data = $this->job_model->getStateData($userId, 6);
        $this->sendResponse($data, "Data fetch success", 1);
    }

    public function onprogress()
    {
        $array = json_decode(file_get_contents('php://input'), true);
        if ($array == null) {$this->sendResponse("check request", "requeted data not correct", 2);exit();}
        $userId = $array["user_id"];
        if ($userId == null) {$this->sendResponse("user_id is required", "check user id", 2);exit();}
        // load the job module in context
        $this->load->model('job_model');
        $data = $this->job_model->getStateData($userId, 5);
        $this->sendResponse($data, "Data fetch success", 1);
    }

    public function matreq()
    {
        $array = json_decode(file_get_contents('php://input'), true);
        if ($array == null) {$this->sendResponse("check request", "requeted data not correct", 2);exit();}
        $userId = $array["user_id"];
        if ($userId == null) {$this->sendResponse("user_id is required", "check user id", 2);exit();}
        // load the job module in context
        $this->load->model('job_model');
        $data = $this->job_model->getStateData($userId, 4);
        $this->sendResponse($data, "Data fetch success", 1);
    }

    public function acccept()
    {
        $array = json_decode(file_get_contents('php://input'), true);
        if ($array == null) {$this->sendResponse("check request", "requeted data not correct", 2);exit();}
        $userId = $array["user_id"];
        if ($userId == null) {$this->sendResponse("user_id is required", "check user id", 2);exit();}
        // load the job module in context
        $this->load->model('job_model');
        $data = $this->job_model->getStateData($userId, 3);
        $this->sendResponse($data, "Data fetch success", 1);
    }

    public function assigned()
    {
        $array = json_decode(file_get_contents('php://input'), true);
        if ($array == null) {$this->sendResponse("check request", "requeted data not correct", 2);exit();}
        $userId = $array["user_id"];
        if ($userId == null) {$this->sendResponse("user_id is required", "check user id", 2);exit();}
        // load the job module in context
        $this->load->model('job_model');
        $data = $this->job_model->getStateData($userId, 2);
        $this->sendResponse($data, "Data fetch success", 1);
    }

    public function pending()
    {
        $array = json_decode(file_get_contents('php://input'), true);
        if ($array == null) {$this->sendResponse("check request", "requeted data not correct", 2);exit();}
        $userId = $array["user_id"];
        if ($userId == null) {$this->sendResponse("user_id is required", "check user id", 2);exit();}
        // load the job module in context
        $this->load->model('job_model');
        $data = $this->job_model->getStateData($userId, 1);
        $this->sendResponse($data, "Data fetch success", 1);
    }

    public function getjobs()
    {

        $array = json_decode(file_get_contents('php://input'), true);

        if ($array == null) {$this->sendResponse("check request", "requeted data not correct", 2);exit();}

        $userId = $array["user_id"];

        if ($userId == null) {$this->sendResponse("user_id is required", "check user id", 2);exit();}

        // load the job module in context
        $this->load->model('job_model');

        $data = $this->job_model->allJobs($userId);

        $this->sendResponse($data, "Data fetch success", 1);

    }

    public function add()
    {
        $array = json_decode(file_get_contents('php://input'), true);

        if ($array == null) {$this->sendResponse("check request", "requeted data not correct", 2);exit();}

        $userId = $array["user_id"];
        $title = $array["title"];
        $description = $array["description"];
        $branchId = $array["branch_id"];
        $priority = $array["priority"];

        if ($userId == null) {$this->sendResponse("", "user_id is required", 2);exit();}
        if ($title == null) {$this->sendResponse("", "title is required", 2);exit();}
        if ($description == null) {$this->sendResponse("", "description is required", 2);exit();}
        if ($branchId == null) {$this->sendResponse("", "branch_id is required", 2);exit();}
        if ($pri == null) {$this->sendResponse("", "priority is required", 2);exit();}

        $this->load->helper('date');
        $timestamp = time();

        $data = array(
            'branch_manager_id' => $userId,
            'maintence_manager_id' => 1,
            'technical_officer_id' => null,
            'warehouse_manager_id' => null,
            'title' => $title,
            'description' => $description,
            'branch_id' => $branchId,
            'priority' => $priority,
            'timestamp' => $timestamp,
            'state_id' => 1,
            'job_hours' => null,
        );

        // load the job module in context
        $this->load->model('job_model');

        // call insert function in the module
        if ($this->job_model->addNewJob($data)) {
            $response = array(
                'code' => 1,
                'message' => "data insert success",
                'data' => "",
            );

            echo json_encode($response);
        } else {
            $response = array(
                'code' => 2,
                'message' => "data insert not-success",
                'data' => "",
            );

            echo json_encode($response);
        }
    }

    public function sendResponse($data, $message, $code)
    {
        $response = array(
            'code' => $code,
            'message' => $message,
            'data' => $data,
        );

        echo json_encode($response);
    }
}
