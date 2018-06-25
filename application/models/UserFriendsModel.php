<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25/06/2018
 * Time: 15.34
 */

class UserFriendsModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_friends($user_id){
        $query = "SELECT CASE WHEN user_1_id=".$user_id." THEN user_2_id ".
                              "WHEN user_2_id=".$user_id." THEN user_1_id ".
                         "END AS friends ".
                  "FROM user_friends_relation ".
                  "WHERE user_1_id=".$user_id." OR user_2_id=".$user_id;
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function is_friend($visitor, $visited){
        $this->db->select('user_id');
        $this->db->where('username',$visitor);
        $uid_1 = $this->db->get('user_master')->row()->user_id;

        $this->db->select('user_id');
        $this->db->where('username',$visited);
        $uid_2 = $this->db->get('user_master')->row()->user_id;

        $query = "SELECT *
                    FROM user_friends_relation
                    WHERE (user_1_id=".$uid_1." AND user_2_id=".$uid_2.") 
                    OR (user_1_id=".$uid_2." AND user_2_id=".$uid_1.");";
        $result = $this->db->query($query);
        return $result->num_rows()>0?true:false;
    }
}