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

    public function is_friend($visitor, $visited)
    {
        $uid_1 = $this->UserModel->get_user_id($visitor);
        $uid_2 = $this->UserModel->get_user_id($visited);
        if ($this->UserFriendsModel->is_friend($uid_1, $uid_2))
            echo json_encode("SUCCESS");
        else echo json_encode("FAILED");
    }

    public function add_friend($visitor, $visited)
    {
        $uid_1 = $this->UserModel->get_user_id($visitor);
        $uid_2 = $this->UserModel->get_user_id($visited);
        $this->UserFriendsModel->add_friend($uid_1, $uid_2);
    }

    public function unfriend($visitor, $visited)
    {
        $uid_1 = $this->UserModel->get_user_id($visitor);
        $uid_2 = $this->UserModel->get_user_id($visited);
        $this->UserFriendsModel->unfriend($uid_1, $uid_2);
    }
}