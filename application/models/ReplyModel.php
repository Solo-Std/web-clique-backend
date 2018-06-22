<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/06/2018
 * Time: 01.52
 */

class ReplyModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function insert($data){
        $this->db->insert('comment_master',$data);
    }
}