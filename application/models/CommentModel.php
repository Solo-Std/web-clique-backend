<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/06/2018
 * Time: 01.52
 */

class CommentModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAll($post_id){
        $data = array(array());
        $this->db->order_by('date_created', "DESC");
        $this->db->where('post_id',$post_id);
        $comment = $this->db->get('comment_master');
        foreach($comment->result() as $idx=>$row){
            $this->db->select('username');
            $this->db->where('user_id',$row->user_id);
            $user = $this->db->get('user_master');
            $data[$idx]['comment'] = $row->comment;
            $data[$idx]['date_created'] = $row->date_created;
            $data[$idx]['username'] = $user->row()->username;
        }
        return $data;
    }
}