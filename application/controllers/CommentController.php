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
    }

    public function index($post_id){
        echo json_encode($this->CommentModel->getAll($post_id));
    }

    public function insert(){
        $raw = json_decode($this->input->raw_input_stream, true);
        $data = array(
            'comment' => $raw['comment'],
            'date_created' => date('Y-m-d H:i:s',strtotime("+7 hours")),
            'user_id' => $raw['user_id'],
            'post_id' => $raw['post_id']
        );
        if($this->CommentModel->insert($data)){
            echo json_encode("FAILED");
        }
        else echo json_encode("SUCCESS");
    }
}