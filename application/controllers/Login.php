<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
		parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('login_model');
    }

    public function index() {
        // no index method for now
    }


    public function login() {
        if($this->session->logged_in) {
            redirect('home');
        }

        $data['login_msg'] = $this->session->flashdata('login_msg');
        $this->load->view("templates/header/login_header");
        $this->load->view("app/login_view", $data);
        $this->load->view("templates/footer/login_footer");
    }


    public function authenticate() {
        $valid_form = $this->validate_form();

        if(!$valid_form)
        {
            redirect('login');
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $valid_user = $this->validate_login_credentials($username, $password);
        if ($valid_user) {
            $this->set_session_data($username);
            redirect('home');
        } else {
            $this->session->set_flashdata('login_msg', "Invalid login credentials");
            redirect('login', 'refresh');
        }
    }

    public function validate_form()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        return $this->form_validation->run();
    }


    public function validate_login_credentials($username, $password)
    {
        $username = trim($username);
        $username = $this->security->xss_clean($username);
        $password = trim($password);
        $password = $this->security->xss_clean($password);

        return $this->login_model->validate_user($username, $password);
    }

    
    public function set_session_data($username)
    {
        $user_details = $this->login_model->get_details_from_username($username);
        $session_data =  array(
            'username'   => $user_details['username'],
            'first_name' => $user_details['first_name'],
            'last_name'  => $user_details['last_name'],
            'email'      => $user_details['email'],
            'logged_in'  => TRUE
        );
            
        $this->session->set_userdata($session_data);
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function register()
    {
        $data['user_registered'] = $this->session->flashdata('user_registered');
        
        $this->load->view("templates/header/login_header");
        $this->load->view("app/register_view", $data);
        $this->load->view("templates/footer/login_footer");
        
    }

    public function create_user()
    {

        $user_details = [
            'first_name' => $this->input->post('firstname'),
            'last_name' => $this->input->post('lastname'),
            'user_name' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'confirm_password' => $this->input->post('confirm-password')
        ];

        $create_user_status = $this->login_model->store_user($user_details);

        if($create_user_status)
        {
            $this->session->set_flashdata('user_registered', ['success' => true, 'msg' => 'Account created successfully.']);
        }
        else
        {
            $this->session->set_flashdata('user_registered', ['success' => false, 'msg' => 'Account could not be created at this time. Please try again after some time.']);
        }

        redirect('register', 'refresh');
    }
    
    

} //class ends
