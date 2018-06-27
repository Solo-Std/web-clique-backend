<?php
/**
 * Created by PhpStorm.
 * User: Adjie
 * Date: 6/26/2018
 * Time: 9:37 PM
 */

class CliqueSubscriptionController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('CliqueSubscriptionModel');
    }

    public function addSubscription(){
        $raw =  json_decode($this->input->raw_input_stream, true);
        $data = array(
            'clique_name' => $raw['clique_name'],
            'user_id' => $raw['user_id']
        );
        
        echo json_encode($this->SubscribedCliqueModel->getSubscribedClique($data));
    }
}