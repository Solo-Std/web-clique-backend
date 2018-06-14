<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/06/2018
 * Time: 01.52
 */

class PostModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAll(){
        $data = array(array());
        $this->db->order_by('date_created', "DESC");
        $post = $this->db->get('post_master');
        foreach($post->result() as $idx=>$row){
            $this->db->select('title');
            $this->db->where('clique_id',$row->clique_id);
            $clique = $this->db->get('clique_master');
            $this->db->select('username');
            $this->db->where('user_id',$row->user_id);
            $user = $this->db->get('user_master');
            $data[$idx]['post_title'] = $row->title;
            $data[$idx]['date_created'] = $row->date_created;
            $data[$idx]['clique_name'] = $clique->row()->title;
            $data[$idx]['username'] = $user->row()->username;
        }
        return $data;
    }
}