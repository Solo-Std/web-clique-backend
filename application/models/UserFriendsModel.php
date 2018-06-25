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

    function get_friends($user_id){
        $query = "SELECT CASE WHEN user_1_id=7 THEN user_2_id
                              WHEN user_2_id=7 THEN user_1_id
                         END
                  FROM user_friends_relation AS friends
                  WHERE user_1_id=7 OR user_2_id=7";
        $result = $this->db->query($query);

        $data = array();
        foreach($result->result() as $idx=>$row) {
            $data[$idx] = $row['friends'];
        }
        return $data;
    }
}