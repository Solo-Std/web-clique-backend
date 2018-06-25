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
        echo json_encode($this->db->get_friends($user_id));
    }
}