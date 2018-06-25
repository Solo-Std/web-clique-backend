<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25/06/2018
 * Time: 15.34
 */

class UserFriendsController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('UserFriendsModel');
    }

    public function get_friends($user_id){
        echo json_encode($this->UserFriendsModel->get_friends($user_id));
    }

    public function is_friend($visitor, $visited){
        echo json_encode($this->UserFriendsModel->is_friend($visitor, $visited));
    }

    public function add_friend($visitor, $visited){
        echo json_encode($this->UserFriendsModel->add_friend($visitor,$visited));
    }

    public function unfriend($visitor, $visited){
        echo json_encode($this->UserFriendsModel->unfriend($visitor,$visited));
    }
}