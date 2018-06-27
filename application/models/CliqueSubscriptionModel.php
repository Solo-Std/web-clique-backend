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

    public function addSubscription($data)
    {
        $this->db->select('clique_id');
        $this->db->where('title', $data['clique_name']);
        $clique_id = $this->db->get('clique_master');

        $subscription = array(
            'clique_id' => $clique_id->result(),
            'user_id' => $data['user_id']
        );

        $this->db->insert('subscribed_clique_relation', $subscription);

        return true;
    }
}