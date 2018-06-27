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
        $this->load->model('UserModel');
    }

    public function get_friends($user_id)
    {
        echo json_encode($this->UserFriendsModel->get_friends($user_id));
    }

    public function is_friend()
    {
        $raw = json_decode($this->input->raw_input_stream, true);
        $data = array(
            'visitor' => $raw['visitor'],
            'visited' => $raw['visited']
        );
        $uid_1 = $this->UserModel->get_user_id($data['visitor']);
        $uid_2 = $this->UserModel->get_user_id($data['visited']);
        if ($this->UserFriendsModel->is_friend($uid_1, $uid_2))
            echo json_encode("SUCCESS");
        else echo json_encode("FAILED");
    }

    public function add_friend()
    {
        $raw = json_decode($this->input->raw_input_stream, true);
        $data = array(
            'visitor' => $raw['visitor'],
            'visited' => $raw['visited']
        );
        $uid_1 = $this->UserModel->get_user_id($data['visitor']);
        $uid_2 = $this->UserModel->get_user_id($data['visited']);
        $this->UserFriendsModel->add_friend($uid_1, $uid_2);
    }

    public function unfriend()
    {
        $raw = json_decode($this->input->raw_input_stream, true);
        $data = array(
            'visitor' => $raw['visitor'],
            'visited' => $raw['visited']
        );
        $uid_1 = $this->UserModel->get_user_id($data['visitor']);
        $uid_2 = $this->UserModel->get_user_id($data['visited']);
        $this->UserFriendsModel->unfriend($uid_1, $uid_2);
    }
}