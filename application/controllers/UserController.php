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
            'date_created' => date('Y-m-d G:i:s')
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
            'password' => md5($raw['password'])
        );
        if($this->UserModel->login($data)){
            echo json_encode("SUCCESS");
        }
        else echo json_encode("FAILED");
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

    public function http_options(){
        echo json_encode("200");
    }
}