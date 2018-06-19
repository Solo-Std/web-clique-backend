<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/06/2018
 * Time: 01.52
 */

class ReplyController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('ReplyModel');
    }

    public function index($post_id){
        echo json_encode($this->ReplyModel->getAll($post_id));
    }
}