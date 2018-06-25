<?php
/**
 * Created by PhpStorm.
 * User: Adjie
 * Date: 6/23/2018
 * Time: 8:42 PM
 */
class SubscribedCliqueModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getSubscribedClique($user_id)
    {
        $data = array();

        $this->db->select('clique_id');
        $this->db->where('user_id',$user_id);
        $subscribe = $this->db->get('subscribed_clique_relation');

        foreach($subscribe->result() as $idx=>$row){
            $this->db->select('title');
            $this->db->where('clique_id',$row->clique_id);
            $title = $this->db->get('clique_master');
            $data[$idx]['title'] = $title->row()->title;
        }

        return $data;
    }

}