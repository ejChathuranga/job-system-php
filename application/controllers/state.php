<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

class State extends CI_Controller
{

    public function reopen()
    {

        // $userInput = $this->input->raw_input_stream;
        $array = json_decode(file_get_contents('php://input'), true);

        if ($array == null) {$this->sendResponse("", "request data not setted corretcly", 2);exit();}

        $jobId = $array['job_id'];

        if ($jobId == null) {$this->sendResponse("", "job_id is required", 2);exit();}

        $this->load->model('state_model');

        $isAssigned = $this->state_model->reopen($jobId);

        if ($isAssigned) {
            $response = array(
                'code' => 1,
                'message' => "job  re-open success",
                'data' => "",
            );

            echo json_encode($response);
        } else {
            $response = array(
                'code' => 2,
                'message' => "job re-open not-success",
                'data' => "",
            );

            echo json_encode($response);
        }

    }

    public function close()
    {

        // $userInput = $this->input->raw_input_stream;
        $array = json_decode(file_get_contents('php://input'), true);

        if ($array == null) {$this->sendResponse("", "request data not setted corretcly", 2);exit();}

        $jobId = $array['job_id'];

        if ($jobId == null) {$this->sendResponse("", "job_id is required", 2);exit();}

        $this->load->model('state_model');

        $isAssigned = $this->state_model->close($jobId);

        if ($isAssigned) {
            $response = array(
                'code' => 1,
                'message' => "job  close success",
                'data' => "",
            );

            echo json_encode($response);
        } else {
            $response = array(
                'code' => 2,
                'message' => "job close not-success",
                'data' => "",
            );

            echo json_encode($response);
        }

    }

    public function finish()
    {

        // $userInput = $this->input->raw_input_stream;
        $array = json_decode(file_get_contents('php://input'), true);

        if ($array == null) {$this->sendResponse("", "request data not setted corretcly", 2);exit();}

        $jobId = $array['job_id'];

        if ($jobId == null) {$this->sendResponse("", "job_id is required", 2);exit();}

        $this->load->model('state_model');

        $isAssigned = $this->state_model->finish($jobId);

        if ($isAssigned) {
            $response = array(
                'code' => 1,
                'message' => "job  finish success",
                'data' => "",
            );

            echo json_encode($response);
        } else {
            $response = array(
                'code' => 2,
                'message' => "job finish not-success",
                'data' => "",
            );

            echo json_encode($response);
        }

    }

    public function matok()
    {

        // $userInput = $this->input->raw_input_stream;
        $array = json_decode(file_get_contents('php://input'), true);

        if ($array == null) {$this->sendResponse("", "request data not setted corretcly", 2);exit();}

        $jobId = $array['job_id'];

        if ($jobId == null) {$this->sendResponse("", "job_id is required", 2);exit();}

        $this->load->model('state_model');

        $isAssigned = $this->state_model->onProgress($jobId);

        if ($isAssigned) {
            $response = array(
                'code' => 1,
                'message' => "job material issued success",
                'data' => "",
            );

            echo json_encode($response);
        } else {
            $response = array(
                'code' => 2,
                'message' => "job material issued not-success",
                'data' => "",
            );

            echo json_encode($response);
        }

    }

    public function matreq()
    {

        // $userInput = $this->input->raw_input_stream;
        $array = json_decode(file_get_contents('php://input'), true);

        if ($array == null) {$this->sendResponse("", "request data not setted corretcly", 2);exit();}

        $jobId = $array['job_id'];

        if ($jobId == null) {$this->sendResponse("", "job_id is required", 2);exit();}

        $this->load->model('state_model');

        $isAssigned = $this->state_model->materialRequisition($jobId);

        if ($isAssigned) {
            $response = array(
                'code' => 1,
                'message' => "job material requisition success",
                'data' => "",
            );

            echo json_encode($response);
        } else {
            $response = array(
                'code' => 2,
                'message' => "job material requisition not-success",
                'data' => "",
            );

            echo json_encode($response);
        }

    }

    public function accept()
    {

        // $userInput = $this->input->raw_input_stream;
        $array = json_decode(file_get_contents('php://input'), true);

        if ($array == null) {$this->sendResponse("", "request data not setted corretcly", 2);exit();}

        $userId = $array['user_id'];
        $jobId = $array['job_id'];

        if ($jobId == null) {$this->sendResponse("", "job_id is required", 2);exit();}
        if ($userId == null) {$this->sendResponse("", "user_id is required", 2);exit();}

        $this->load->model('state_model');

        $isAssigned = $this->state_model->accept($userId, $jobId);

        if ($isAssigned) {
            $response = array(
                'code' => 1,
                'message' => "job accept success",
                'data' => "",
            );

            echo json_encode($response);
        } else {
            $response = array(
                'code' => 2,
                'message' => "job accept not-success",
                'data' => "",
            );

            echo json_encode($response);
        }

    }

    public function assign()
    {
        $array = json_decode(file_get_contents('php://input'), true);

        if ($array == null) {$this->sendResponse("", "request data not setted corretcly", 2);exit();}

        $jobId = $array["job_id"];
        $technical_officer_id = $array["technical_officer_id"];

        if ($jobId == null) {$this->sendResponse("", "job_id is required", 2);exit();}
        if ($technical_officer_id == null) {$this->sendResponse("", "technical_officer_id is required", 2);exit();}

        // load the job module in context
        $this->load->model('state_model');

        $isAssigned = $this->state_model->assign($technical_officer_id, $jobId);

        if ($isAssigned) {
            $response = array(
                'code' => 1,
                'message' => "job assign success",
                'data' => "",
            );

            echo json_encode($response);
        } else {
            $response = array(
                'code' => 2,
                'message' => "job assign not-success",
                'data' => "",
            );

            echo json_encode($response);
        }

    }

    public function sendResponse($data, $code, $message)
    {
        $response = array(
            'data' => $data,
            'code' => $code,
            'message' => $message,
        );

        echo json_encode($response);
    }

}
