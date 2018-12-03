<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
		parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        $this->load->view("templates/header/header");
        $this->load->view("app/home");
        $this->load->view("templates/footer/footer");

    }

} //class ends
