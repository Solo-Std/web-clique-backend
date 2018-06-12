<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/06/2018
 * Time: 15.51
 */

class UserModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAll(){
        $data = array(array());
        $query = $this->db->get('user_master');
        foreach ($query->result() as $idx=>$row){
            $data[$idx]['username'] = $row->username;
            $data[$idx]['password'] = $row->password;
        }
        return $data;
    }

    public function insert($data){
        $this->db->where('username',$data['username']);
        $query = $this->db->get('user_master');
        if($query->num_rows() > 0){
            return false;
        }
        else{
            $this->db->insert('user_master',$data);
            return true;
        }
    }

    public function check_username($username){
        $this->db->where('username',$username);
        $query = $this->db->get('user_master');
        return ($query->num_rows() > 0)?false:true;
    }

    public function check_email($email){
        $this->db->where('email',$email);
        $query = $this->db->get('user_master');
        return ($query->num_rows() > 0)?false:true;
    }
}