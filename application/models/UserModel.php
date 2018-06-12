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
        $data = array();
        $query = $this->db->get('user_master');
        foreach ($query->result() as $row){
            $data['username'] = $row->username;
            $data['password'] = $row->password;
        }
        return $data;
    }

    public function insert($data){
//        $query = $this->db->get('user_master');
//        foreach ($query->result() as $row){
//            if($data['username'] == $row->username){
//                return null;
//            }
//        }
//        return $data;
        $this->db->insert('user_master',$data);
    }
}