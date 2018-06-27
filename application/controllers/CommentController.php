<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/06/2018
 * Time: 01.52
 */

class CommentController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('CommentModel');
        $this->load->model('UserModel');
    }

    public function index(){
        $raw = json_decode($this->input->raw_input_stream, true);
        echo json_encode($this->CommentModel->getAll($raw['id']));
    }

    public function insert(){
        $raw = json_decode($this->input->raw_input_stream, true);
        $data = array(
            'comment' => $raw['comment'],
            'date_created' => date('Y-m-d H:i:s',strtotime("+7 hours")),
            'user_id' => $this->UserModel->get_user_id($raw['username']),
            'post_id' => $raw['post_id']
        );
        if($this->CommentModel->insert($data)){
            echo json_encode("FAILED");
        }
        else echo json_encode("SUCCESS");
    }
}