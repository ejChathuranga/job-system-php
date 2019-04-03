<?php
// model for auth user request. Inhere will check existing user's and weill genarate response according to that
class Auth_model extends CI_Model
{

    public function can_login($un, $pw)
    {

        $this->db->where('username', $un);
        $this->db->where('password', $pw);

        $query = $this->db->get('employee');
        if ($query->num_rows() > 0) {

            $id = $query->result()[0]->id;
            $name = $query->result()[0]->name;
            $username = $query->result()[0]->username;
            $address = $query->result()[0]->address;
            $bod = $query->result()[0]->bod;
            $gender = $query->result()[0]->gender;
            $roll_id = $query->result()[0]->roll_id;
            $branch_id = $query->result()[0]->branch_id;
            $userModel = array(
                'id' => $id,
                'name' => $name,
                'username' => $username,
                'address' => $address,
                'bod' => $bod,
                'gender' => $gender,
                'roll_id' => $roll_id,
                'branch_id' => $branch_id,
            );
            return $userModel;
            //return $query->result();
            //return true;
        } else {
            return null;
        }
    }
}
