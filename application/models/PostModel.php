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
            $data[$idx]['post_id'] = $row->post_id;
            $data[$idx]['post_title'] = $row->title;
            $data[$idx]['date_created'] = $row->date_created;
            $data[$idx]['clique_name'] = $clique->row()->title;
            $data[$idx]['username'] = $user->row()->username;
        }
        return $data;
    }

    public function get_all_by_clique_id($clique_name){
        $data = array(array());
        $this->db->where("title",$clique_name);
        $this->db->order_by('date_created', "DESC");
        $post = $this->db->get('post_master');
        foreach($post->result() as $idx=>$row){
            $this->db->select('title');
            $this->db->where('clique_id',$row->clique_id);
            $clique = $this->db->get('clique_master');
            $this->db->select('username');
            $this->db->where('user_id',$row->user_id);
            $user = $this->db->get('user_master');
            $data[$idx]['post_id'] = $row->post_id;
            $data[$idx]['post_title'] = $row->title;
            $data[$idx]['date_created'] = $row->date_created;
            $data[$idx]['clique_name'] = $clique->row()->title;
            $data[$idx]['username'] = $user->row()->username;
        }
        return $data;
    }

    public function getProfilePosts($username)
    {
        $data = array();

        $this->db->select('user_id');
        $this->db->from('user_master');
        $this->db->where('username',$username);
        $userid = $this->db->get()->first_row();
        $id = $userid->user_id;
        
        $this->db->order_by('date_created',"DESC");
        $this->db->where('user_id',$id);
        $post = $this->db->get('post_master');

        foreach($post->result() as $idx=>$row)
        {
            $this->db->select('title');
            $this->db->where('clique_id',$post->row()->clique_id);
            $clique = $this->db->get('clique_master');

            $this->db->select('username');
            $this->db->where('user_id',$id);
            $user = $this->db->get('user_master');



            $data[$idx]['post_id'] = $post->row($idx)->post_id;
            $data[$idx]['post_title'] = $post->row($idx)->title;
            $data[$idx]['date_created'] = $post->row($idx)->date_created;
            $data[$idx]['clique_name'] = $clique->row($idx)->title;
            $data[$idx]['username'] = $user->row($idx)->username;
        }
        return $data;
    }

    public function getOne($id){
        $data = array();
        $this->db->order_by('date_created', "DESC");
        $this->db->where('post_id',$id);
        $post = $this->db->get('post_master');

        $this->db->select('title');
        $this->db->where('clique_id',$post->row()->clique_id);
        $clique = $this->db->get('clique_master');

        $this->db->select('username');
        $this->db->where('user_id',$post->row()->user_id);
        $user = $this->db->get('user_master');

        $data['post_id'] = $post->row()->post_id;
        $data['post_title'] = $post->row()->title;
        $data['date_created'] = $post->row()->date_created;
        $data['clique_name'] = $clique->row()->title;
        $data['username'] = $user->row()->username;
        return $data;
    }
}