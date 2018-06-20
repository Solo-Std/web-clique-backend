<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/06/2018
 * Time: 01.52
 */

class PostController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('PostModel');
    }

    public function getProfilePosts($user_id){
        echo json_encode($this->PostModel->getProfilePosts($user_id));
    }

    public function index(){
        echo json_encode($this->PostModel->getAll());
    }

    public function getOne($id){
        echo json_encode($this->PostModel->getOne($id));
    }
}