<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('backend/templates/backend_head');
        $this->load->view('backend/templates/source_css/home_css');
        $this->load->view('backend/templates/backend_top');
        $this->load->view('backend/modules/home/content_file');
        $this->load->view('backend/templates/source_js/home_js');
        $this->load->view('backend/templates/backend_bot');
    }

}
