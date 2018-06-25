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
        $temp = array();
        $data = array();

        $this->db->select('clique_id');
        $this->db->where('user_id',$user_id);
        $subscribeID = $this->db->get('subscribed_clique_relation');

        foreach($subscribeID->result() as $idx=>$row){
            $temp[$idx]['clique_id'] = $row->clique_id;
        }

        $this->db->select('title');
        $this->db->where('clique_id', $temp);
        $subscribe_title = $this->db->get('clique_master');


        foreach($subscribe_title->result() as $idx=>$row){
            $data[$idx]['title'] = $row->title;
        }

        return $data;
    }

}