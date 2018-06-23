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

    public function getProfilePosts($username){
        echo json_encode($this->PostModel->getProfilePosts($username));
    }

    public function index(){
        echo json_encode($this->PostModel->getAll());
    }

    public function get_clique_post($id){
        echo json_encode($this->PostModel->get_all_by_clique_id($id));
    }

    public function getOne($id){
        echo json_encode($this->PostModel->getOne($id));
    }
}