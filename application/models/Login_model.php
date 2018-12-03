<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
		$this->load->helper('string');
	}

    public function validate_user($username, $temp_password) {
        $username_exists = $this->username_exists($username);
        $hashed_user_password = $this->get_details_from_username($username)['password'];
        $hashed_temp_password = sha1($temp_password);
        $password_hashes_match = ($hashed_temp_password == $hashed_user_password);

        return ($username_exists && $password_hashes_match);
    }

    public function username_exists($username) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
        
        return $this->db->get()->num_rows() > 0;
    }

    public function get_details_from_username($username) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);

        return $this->db->get()->row_array();
    }

    public function store_user($user_details)
    {
        $first_name = $user_details['first_name'];
        $last_name = $user_details['last_name'];
        $username = $user_details['user_name'];
        $email = $user_details['email'];
        $hashed_password = sha1($user_details['password']);
        $hashed_confirm_password = sha1($user_details['confirm_password']);

            $data = array(
                'username' => $username,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => $hashed_password,
                'created_on' => date('Y-m-d H:i:s')
            );

            return $this->db->insert('users', $data);
    }

    public function email_exists($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        
        return $this->db->get()->num_rows() > 0;        
    }


} //class ends
