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
        $this->load->model('UserModel');
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
        $uid_1 = $this->UserModel->get_user_id($visitor);
        $uid_2 = $this->UserModel->get_user_id($visited);
        echo json_encode($uid_1);
        echo json_encode($uid_2);

        $query = "SELECT * 
                    FROM user_friends_relation
                    WHERE (user_1_id=".$uid_1." AND user_2_id=".$uid_2.") 
                    OR (user_1_id=".$uid_2." AND user_2_id=".$uid_1.");";
        $result = $this->db->query($query);
        return $result->num_rows()>0?true:false;
    }

    public function add_friend($visitor, $visited){
        $uid_1 = $this->UserModel->get_user_id($visitor);
        $uid_2 = $this->UserModel->get_user_id($visited);

        $data = array(
            'user_1_id' => $uid_1,
            'user_2_id' => $uid_2
        );

        $this->db->insert('user_friends_relation',$data);
    }

    public function unfriend($visitor, $visited){
        $uid_1 = $this->UserModel->get_user_id($visitor);
        $uid_2 = $this->UserModel->get_user_id($visited);

        $query = "DELETE 
                    FROM user_friends_relation
                    WHERE (user_1_id=".$uid_1." AND user_2_id=".$uid_2.") 
                    OR (user_1_id=".$uid_2." AND user_2_id=".$uid_1.");";
        $this->db->query($query);
    }
}