<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/06/2018
 * Time: 20.29
 */

class SubscribedCliqueController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('SubscribedCliqueModel');
    }

    public function getSubscribedClique($username){
        echo json_encode($this->SubscribedCliqueModel->getSubscribedClique($username));
    }

}