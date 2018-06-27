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

    public function index(){
        $raw = json_decode($this->input->raw_input_stream, true);
        echo json_encode($this->ReplyModel->getAll($raw['id']));
    }


    public function insert(){
        $raw = json_decode($this->input->raw_input_stream, true);
        $data = array(
            'reply' => $raw['reply'],
            'date_created' => date('Y-m-d H:i:s',strtotime("+7 hours")),
            'user_id' => $this->UserModel->get_user_id($raw['username']),
            'comment_id' => $raw['comment_id']
        );
        if($this->ReplyModel->insert($data)){
            echo json_encode("FAILED");
        }
        else echo json_encode("SUCCESS");
    }

//    public function insert(){
//        $raw = json_decode($this->input->raw_input_stream, true);
//        $data = array(
//            'reply' => $raw['reply'],
//            'date_created' => date('Y-m-d G:i:s'),
//            'user_id' => $raw['user_id'],
//            'comment_id' => $raw['user_id'],
//        );
//        if($this->UserModel->insert($data)){
//            echo json_encode("SUCCESS");
//        }
//        else echo json_encode("FAILED");
//    }
}