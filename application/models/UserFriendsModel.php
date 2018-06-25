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
        $query = "SELECT CASE WHEN user_1_id={$user_id} THEN user_2_id
                              WHEN user_2_id={$user_id} THEN user_1_id
                         END
                  FROM user_friends_relation AS friends
                  WHERE user_1_id={$user_id} OR user_2_id={$user_id}";
        $result = $this->db->query($query);

        $data = array();
        foreach($result->result() as $idx=>$row) {
            $data[$idx] = $result->row($idx)->friends;
        }
        return $data;
    }
}