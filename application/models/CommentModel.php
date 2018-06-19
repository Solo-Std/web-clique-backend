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
        $reply_data = array(array());
        $this->db->order_by('date_created', "DESC");
        $this->db->where('post_id',$post_id);
        $comment = $this->db->get('comment_master');
        foreach($comment->result() as $idx=>$row){
            $this->db->select('username');
            $this->db->where('user_id',$row->user_id);
            $user = $this->db->get('user_master');

            $this->db->order_by('date_created', "DESC");
            $this->db->where('comment_id',$row->comment_id);
            $replies = $this->db->get('reply_master');


            $data[$idx]['comment_id'] = $row->comment_id;
            $data[$idx]['comment'] = $row->comment;
            $data[$idx]['date_created'] = $row->date_created;
            $data[$idx]['username'] = $user->row()->username;
            $data[$idx]['replies'] = array();
            foreach ($replies->result() as $ridx=>$rrow){
                $this->db->select('username');
                $this->db->where('user_id',$rrow->user_id);
                $ruser = $this->db->get('user_master');


                $reply_data[$ridx]['reply_id'] = $rrow->reply_id;
                $reply_data[$ridx]['reply'] = $rrow->reply;
                $reply_data[$ridx]['date_created'] = $rrow->date_created;
                $reply_data[$ridx]['username'] = $ruser->row()->username;
                $data[$idx]['replies'][$ridx] = $reply_data[$ridx];
            }


        }
        return $data;
    }
}