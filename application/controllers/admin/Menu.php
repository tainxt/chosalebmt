<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/MMenu');
    }

    public function index() {
        $categories = $this->MMenu->getAll();
        $data = array(
            'categories' => $categories
        );
        $this->load->view('backend/templates/backend_head');
        $this->load->view('backend/templates/backend_top');
        $this->load->view('backend/modules/config_menu/menu', $data);
        $this->load->view('backend/templates/backend_bot');
    }

}
