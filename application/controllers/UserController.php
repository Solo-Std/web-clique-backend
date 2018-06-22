<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/06/2018
 * Time: 15.50
 */

class UserController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('UserModel');
        $this->load->library('session');
    }

    public function index(){
        echo json_encode($this->UserModel->getAll());
    }

    public function create(){
        $raw = json_decode($this->input->raw_input_stream, true);
        $data = array(
            'username' => $raw['username'],
            'password' => md5($raw['password']),
            'email' => $raw['email'],
            'date_created' => date('Y-m-d G:i:s',strtotime("+7 hours"))
        );
        if($this->UserModel->insert($data)){
            echo json_encode("SUCCESS");
        }
        else echo json_encode("FAILED");
    }

    public function login(){
        $raw = json_decode($this->input->raw_input_stream, true);
        $data = array(
            'username' => $raw['username'],
            'password' => ($raw['password'])
        );

        $session_data = array(
            'username' => $raw['username']
        );

        if($this->UserModel->login($data)){
            $this->session->set_userdata($session_data);
            if($this->UserModel->check_session_token($this->session->__ci_last_regenerate)){
                $this->session->sess_destroy();
                $this->session->set_userdata($session_data);
            }
            else{
                $this->UserModel->update_session_token($this->session->userdata);
            }
            echo json_encode($this->session->userdata);
        }
        else echo json_encode("FAILED");
    }

    public function check_session(){
        $raw = json_decode($this->input->raw_input_stream, true);
        $data = array(
            'session_token' => $raw['session_token']
        );
        if($this->UserModel->check_session_token($data['session_token'])){
            echo json_encode("SUCCESS");
            return true;
        }
        else {
            echo json_encode("FAILED");
            return false;
        }
    }

    public function fb_login(){
        $raw = json_decode($this->input->raw_input_stream, true);
        $data = array(
            'username' => $raw['username'],
            'password' => md5($raw['password']),
            'email' => $raw['email'],
            'facebook_id' => $raw['facebook_id'],
            'date_created' => date('Y-m-d G:i:s')
        );
        if($this->UserModel->sso_login($data)){
            echo json_encode("SUCCESS");
        }
        else echo json_encode("FAILED");
    }

    public function gp_login(){
        $raw = json_decode($this->input->raw_input_stream, true);
        $data = array(
            'username' => $raw['username'],
            'password' => md5($raw['password']),
            'email' => $raw['email'],
            'google_id' => $raw['google_id'],
            'date_created' => date('Y-m-d G:i:s')
        );

        $this->UserModel->sso_login($data);
        echo json_encode("SUCCESS");
    }

    public function check_username(){
        $raw = json_decode($this->input->raw_input_stream, true);
        $data = array(
            'username' => $raw['username']
        );
        if($this->UserModel->check_username($data['username'])){
            echo json_encode("SUCCESS");
        }
        else echo json_encode("FAILED");
    }

    public function check_email(){
        $raw = json_decode($this->input->raw_input_stream, true);
        $data = array(
            'email' => $raw['email']
        );
        if($this->UserModel->check_email($data['email'])){
            echo json_encode("SUCCESS");
        }
        else echo json_encode("FAILED");
    }
}