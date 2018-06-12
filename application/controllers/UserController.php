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
        $data = array(
            'username'=>$this->input->post("username"),
            'password'=>$this->input->post("password"),
            'email'=>$this->input->post("email")
        );
        $this->UserModel->insert($data);
        echo json_encode($data);
    }
}