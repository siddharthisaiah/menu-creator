<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
		parent::__construct();
    }

    public function index() {
        echo "Dashboard page shown after login";
    }

    public function home() {
        echo "home";
    }
    
       

} //class ends
