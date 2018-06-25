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
        $data = array(array());

        $this->db->select('clique_id');
        $this->db->where('user_id',$user_id);
        $subscribe = $this->db->get('subscribed_clique_relation');

        foreach($subscribe->result() as $idx=>$row){
            $data[$idx]['user_id'] = $row->user_id;
        }

        return $data;
    }

}