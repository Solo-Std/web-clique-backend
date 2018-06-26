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

    public function getPassword($username)
    {
     $this->db->select('password');
     $this->db->where('username',$username);
     $query = $this->db->get('user_master');

     return $query;

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

    public function sso_login($data){
        $this->db->select('email','facebook_id','google_id');
        $this->db->from('user_master');
        $this->db->where('email',$data['email']);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if(isset($data['facebook_id'])){
                if($query->row('facebook_id') == ''){
                    $this->db->set('facebook_id',$data['facebook_id']);
                    $this->db->where('email',$data['email']);
                    $this->db->update('user_master');
                }
            }
            else if(isset($data['google_id'])){
                if($query->row('google_id') == ''){
                    $this->db->set('google_id',$data['google_id']);
                    $this->db->where('email',$data['email']);
                    $this->db->update('user_master');
                }

            }
        }
        else{
            $this->db->insert('user_master',$data);
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
        return $query->num_rows()?false:true;
    }

    public function login($data){
        $this->db->where('username',$data['username']);
        $this->db->where('password',md5($data['password']));
        $query = $this->db->get('user_master');
        return ($query->num_rows() > 0)?true:false;
    }

    // UTIL
    public function get_user_id($username){
        $this->db->select('user_id');
        $this->db->from('user_master');
        $this->db->where('username',$username);
        $query = $this->db->get();
        foreach ($query->result() as $idx=>$row){
            return json_encode($row->user_id);
        }
    }

    // SESSION TOKEN MANAGER
    public function check_existing_session($data){
        $this->db->where('username',$data['username']);
        $this->db->where('session_token',$data['session_token']);
        $query = $this->db->get('user_master');
        return ($query->num_rows() > 0)?true:false;
    }

    public function check_if_session_exists($token){
        $this->db->where('session_token',$token);
        $query = $this->db->get('user_master');
        return ($query->num_rows() > 0)?true:false;
    }

    public function update_session_token($data){
        $this->db->set('session_token', $data['__ci_last_regenerate']);
        $this->db->where('username', $data['username']);
        $this->db->update('user_master');
    }


}