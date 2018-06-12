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

    public function insert(){
        $raw = json_decode($this->input->raw_input_stream, true);
        $data = array(
            'username' => $raw['user']['username'],
            'password' => $raw['user']['password'],
            'email' => $raw['user']['email']
        );
        if($this->UserModel->insert($data)){
            echo json_encode("SUCCESS");
        }
        else echo json_encode("FAILED");
    }

    public function http_options(){
        echo json_encode("200");
    }
}