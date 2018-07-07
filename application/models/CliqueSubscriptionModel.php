<?php
/**
 * Created by PhpStorm.
 * User: Adjie
 * Date: 6/26/2018
 * Time: 9:39 PM
 */

class CliqueSubscriptionModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function addSubscription()
    {
        $raw = json_decode($this->input->raw_input_stream, true);
        $data = array('clique_name' => $raw['clique_name'],
            'username' => $raw['username']);

        $this->db->select('clique_id');
        $this->db->where('title', $data['clique_name']);
        $clique_id = $this->db->get('clique_master');

        $this->db->select('user_id');
        $this->db->where('username', $data['username']);
        $user_id = $this->db->get('user_master');

        $subscription = array(
            'clique_id' => $clique_id->result()[0]->clique_id,
            'user_id' => $user_id->result()[0]->user_id
        );

        $this->db->insert('subscribed_clique_relation', $subscription);
    }

    public function checkSubscription($user_id, $clique_name){
        $data = array();

        $this->db->select('clique_id');
        $this->db->where('title', $clique_name);
        $clique = $this->db->get('clique_master');

        foreach($clique->result() as $idx=>$row){
            $this->db->select('clique_id');
            $this->db->where('clique_id', $clique->result()[0]->clique_id);
            $subbedClique = $this->db->get('subscribed_clique_relation');

            $data[$idx]['cliques'] = $subbedClique->row($idx)->clique_id;
        }

        if (count($data) > 0){
            return $data;
        }
        else{
            return false;
        }
    }
}