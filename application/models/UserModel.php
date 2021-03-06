<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/06/2018
 * Time: 15.51
 */
//namespace SendGrid;
require 'vendor/autoload.php';


class UserModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $data = array(array());
        $query = $this->db->get('user_master');
        foreach ($query->result() as $idx => $row) {
            $data[$idx]['username'] = $row->username;
            $data[$idx]['password'] = $row->password;
        }
        return $data;
    }

    public function getPassword($username)
    {
        $this->db->select('password');
        $this->db->where('username', $username);
        $query = $this->db->get('user_master');
        return $query;
    }

    public function update_image($data)
    {
        $this->db->set('image', $data['file']);
        $this->db->set('image_ext', $data['file_ext']);
        $this->db->where('username', $data['username']);
        $this->db->update('user_master');
    }

    public function get_image($username)
    {
        $this->db->select('image');
        $this->db->select('image_ext');
        $this->db->where('username', $username);
        $res = $this->db->get('user_master');
        foreach ($res->result() as $idx => $row) {
            if($row->image==null || $row->image_ext==null){
                return json_encode("FAILED");
            }
            $data = array(
                'image'=>stream_get_contents($row->image),
                'image_ext'=>$row->image_ext
            );
            return json_encode($data);
        }
    }

    public function helloEmail($email)
    {
        $from = new SendGrid\Email(null, "no-reply@clique.com");
        $subject = "Hello World from the SendGrid PHP Library";
        $to = new SendGrid\Email(null, $email . "@gmail.com");
        $content = new SendGrid\Content("text/plain", "heheheheheh");
        $mail = new SendGrid\Mail($from, $subject, $to, $content);
        $to = new SendGrid\Email(null, "test2@example.com");
        $mail->personalization[0]->addTo($to);
        //echo json_encode($mail, JSON_PRETTY_PRINT), "\n";
        return $mail;
    }

    public function sendMail($email)
    {
        $apiKey = getenv('SENDGRID_API_KEY');
        $sg = new \SendGrid($apiKey);
        $request_body = $this->helloEmail($email);
        $response = $sg->client->mail()->send()->post($request_body);
        echo $response->statusCode();
        echo $response->body();
        print_r($response->headers());
    }

    public function insert($data)
    {
        $this->db->where('username', $data['username']);
        $query = $this->db->get('user_master');
        if ($query->num_rows() > 0) {
            return false;
        } else {
//            $this->sendMail($data['email']);
            $this->db->insert('user_master', $data);
            return true;
        }
    }

    public function sso_login($data)
    {
        $this->db->select('email', 'facebook_id', 'google_id');
        $this->db->from('user_master');
        $this->db->where('email', $data['email']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            if (isset($data['facebook_id'])) {
                if ($query->row('facebook_id') == '') {
                    $this->db->set('facebook_id', $data['facebook_id']);
                    $this->db->where('email', $data['email']);
                    $this->db->update('user_master');
                }
            } else if (isset($data['google_id'])) {
                if ($query->row('google_id') == '') {
                    $this->db->set('google_id', $data['google_id']);
                    $this->db->where('email', $data['email']);
                    $this->db->update('user_master');
                }

            }
        } else {
            $this->db->insert('user_master', $data);
        }
    }

    public function check_username($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('user_master');
        return ($query->num_rows() > 0) ? false : true;
    }

    public function check_email($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('user_master');
        return $query->num_rows() ? false : true;
    }

    public function login($data)
    {
        $this->db->where('username', $data['username']);
        $this->db->where('password', md5($data['password']));
        $query = $this->db->get('user_master');
        return ($query->num_rows() > 0) ? true : false;
    }

    // UTIL
    public function get_user_id($username)
    {
        $this->db->select('user_id');
        $this->db->from('user_master');
        $this->db->where('username', $username);
        $query = $this->db->get();
        foreach ($query->result() as $idx => $row) {
            return json_encode($row->user_id);
        }
    }

    // SESSION TOKEN MANAGER
    public function check_existing_session($data)
    {
        $this->db->where('username', $data['username']);
        $this->db->where('session_token', $data['session_token']);
        $query = $this->db->get('user_master');
        return ($query->num_rows() > 0) ? true : false;
    }

    public function check_if_session_exists($token)
    {
        $this->db->where('session_token', $token);
        $query = $this->db->get('user_master');
        return ($query->num_rows() > 0) ? true : false;
    }

    public function update_session_token($data)
    {
        $this->db->set('session_token', $data['__ci_last_regenerate']);
        $this->db->where('username', $data['username']);
        $this->db->update('user_master');
    }


}