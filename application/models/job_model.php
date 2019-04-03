<?php

// model for auth user request. Inhere will check existing user's and weill genarate response according to that
class Job_model extends CI_Model
{

    /**
     * state ids
     * 1 = pending, 2= assigned, 3=acccept, 4=material req, 5=onProgress, 6=finish, 7=re-open, 8=close
     *
     *roll ids
     * 1 = maintences manager, 2 = branch manager, 3 = technical officer, 4 = store manager
     */
    public function getQuickSearch($word)
    {
        $this->db->like('name', $word);
        $res = $this->db->get('item');

        if ($res->num_rows() > 0) {
            $response = array();

            foreach ($res->result() as $array) {
                $data = array();
                $data['id'] = $array->id;
                $data['name'] = $array->name;
                array_push($response, $data);
            }
            return $response;

        } else {
            return "";
        }
    }

    public function getStateData($userId, $state)
    {
        $roll_id = $this->getUserRoll($userId);

        if ($roll_id == null) {return "User not found";}

        return $this->getData($roll_id, $state, $userId);
    }

    public function getData($rollId, $stateId, $userId)
    {

        switch ($rollId) {
            case '1':{
                    $this->db->where('maintence_manager_id', $userId);
                    $this->db->where('state_id', $stateId);
                    $jobList = $this->db->get('job');
                    if ($jobList->num_rows() > 0) {
                        return $this->jobResponse($jobList->result());
                    } else {
                        return "no data to fetch";
                    }
                    break;
                }
            case '2':{
                    $this->db->where('branch_manager_id', $userId);
                    $this->db->where('state_id', $stateId);
                    $jobList = $this->db->get('job');
                    if ($jobList->num_rows() > 0) {
                        return $this->jobResponse($jobList->result());
                    } else {
                        return "no data to fetch";
                    }
                    break;
                }
            case '3':{
                    $this->db->where('technical_officer_id', $userId);
                    $this->db->where('state_id', $stateId);
                    $jobList = $this->db->get('job');
                    if ($jobList->num_rows() > 0) {
                        return $this->jobResponse($jobList->result());
                    } else {
                        return "no data to fetch";
                    }
                    break;
                }
            case '4':{
                    $this->db->where('warehouse_manager_id', $userId);
                    $this->db->where('state_id', $stateId);
                    $jobList = $this->db->get('job');
                    if ($jobList->num_rows() > 0) {
                        return $this->jobResponse($jobList->result());
                    } else {
                        return "no data to fetch";
                    }
                    break;
                }

            default:
                break;
        }

    }

    public function jobResponse($arrayList)
    {
        $response = array();
        if ($arrayList != null) {
            foreach ($arrayList as $job) {
                $data = array();
                $data['id'] = $job->id;
                $data['title'] = $job->title;
                $data['description'] = $job->description;
                $data['items'] = json_decode($job->items);
                $data['branch_id'] = $job->branch_id;
                $data['priority'] = $job->priority;
                $data['timestamp'] = $job->timestamp;
                $data['state_id'] = $job->state_id;
                if ($job->state_id != null) {

                    $this->db->select('state');
                    $this->db->where('id', $job->state_id);
                    $data['state'] = $this->db->get('state')->result()[0]->state;
                }
                $data['job_hours'] = $job->job_hours;

                array_push($response, $data);
            }
        }

        return $response;

    }

    public function allJobs($userId)
    {

        $roll_id = $this->getUserRoll($userId);

        if ($roll_id == null) {
            return "Not registered user";
        }

        return $this->getJobs($roll_id, $userId);

    }

    public function getJobs($roll_id, $userId)
    {

        switch ($roll_id) {
            case '1':{
                    $this->db->where('maintence_manager_id', $userId);
                    $query = $this->db->get('job');
                    if ($query->num_rows() > 0) {
                        return $this->jobResponse($query->result());
                    } else {
                        return "No data to show";
                    }
                    break;
                }

            case '2':{
                    $this->db->where('branch_manager_id', $userId);
                    $query = $this->db->get('job');
                    if ($query->num_rows() > 0) {
                        return $this->jobResponse($query->result());
                    } else {
                        return "No data to show";
                    }
                    break;
                }

            case '3':{
                    $this->db->where('technical_officer_id', $userId);
                    $query = $this->db->get('job');
                    if ($query->num_rows() > 0) {
                        return $this->jobResponse($query->result());
                    } else {
                        return "No data to show";
                    }
                    break;
                }

            case '4':{
                    $this->db->where('warehouse_manager_id', $userId);
                    $query = $this->db->get('job');
                    if ($query->num_rows() > 0) {
                        return $this->jobResponse($query->result());
                    } else {
                        return "No data to show";
                    }
                    break;
                }

            default:
                break;
        }

    }

    public function getUserRoll($userId)
    {
        $this->db->where('id', $userId);
        $query = $this->db->get('employee');
        if ($query->num_rows() > 0) {
            return $query->result()[0]->roll_id;
        }
    }

    // insert job details into table
    public function addNewJob($data)
    {
        $query = $this->db->insert('job', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
