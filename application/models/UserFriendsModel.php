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
                  "WHERE user_1_id=".$user_id." OR user_2_id=".$user_id.");";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function is_friend($visitor, $visited){
        $query = "SELECT EXISTS(SELECT * 
                    FROM user_friends_relation
                    WHERE (user_1_id=".$visitor." AND user_2_id=".$visited.") 
                    OR (user_1_id=".$visited." AND user_2_id=".$visitor."));";
        $result = $this->db->query($query);
        return $result->result_array()[0]['exists'];
    }

    public function add_friend($visitor, $visited){
        $query = "INSERT INTO user_friends_relation(user_1_id,user_2_id) ".
                    "VALUES (".$visitor.",".$visited.");";
        $res = $this->db->query($query);
        return $res === 1;
    }

    public function unfriend($visitor, $visited){
        $query = "DELETE 
                    FROM user_friends_relation
                    WHERE (user_1_id=".$visitor." AND user_2_id=".$visited.") 
                    OR (user_1_id=".$visited." AND user_2_id=".$visitor.");";
        $res = $this->db->query($query);
        return $res === 1;
    }
}