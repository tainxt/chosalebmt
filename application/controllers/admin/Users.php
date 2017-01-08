<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/MUsers');
    }

    public function index() {
        $allUsers = $this->MUsers->getAll();
        $allRoles = $this->MUsers->getAllRole();
        $data = array(
            'users' => $allUsers,
            'roles' => $allRoles
        );
        $this->load->view('backend/templates/backend_head');
        $this->load->view('backend/templates/backend_top');
        $this->load->view('backend/modules/users/list_users', $data);
        $this->load->view('backend/templates/backend_bot');
    }

    public function EditUser() {
        
    }

    function Find() {
        $u_id = $this->input->post("u_id");
        if (!empty($u_id)) {
            $result = $this->MUsers->findID($u_id);
            echo json_encode($result);
        }
    }

    function ProcessEdit() {
        $u_fullname = $this->input->post("u_fullname");
        $u_point = $this->input->post("u_point");
        $u_id = $this->input->post("u_id");
        if ( !empty($u_id) && !empty($u_fullname) && !empty($u_point)) {
            $data = array(
                'u_id' => $u_id,
                'r_id' => $this->input->post("r_id"),
                'u_fullname' => $u_fullname,
                'u_point' => $u_point,
                'u_status' => $this->input->post("u_status")
            );
            $this->MUsers->updateUser($u_id, $data);
            echo json_encode("1");
        }
    }

    public function AddUser() {
        
    }

    public function Authorities() {
        $this->load->view('backend/templates/backend_head');
        $this->load->view('backend/templates/backend_top');
        $this->load->view('backend/modules/users/list_authorities');
        $this->load->view('backend/templates/backend_bot');
    }

    public function ProcessAdd() {
        $timezone = +6;
        $u_fullname = $this->input->post("u_fullname");
        $u_username = $this->input->post("u_username");
        $u_password = $this->input->post("u_password");
        $u_email = $this->input->post("u_email");
        if (!empty($u_fullname) && !empty($u_username) && !empty($u_password) && !empty($u_email)) {
            $data = array(
                'r_id' => $this->input->post("r_id"),
                'u_fullname' => $u_fullname,
                'u_username' => $u_username,
                'u_password' => $u_password,
                'u_email' => $u_email,
                'u_createdate' => gmdate("Y-m-d ", time() + 3600 * ($timezone + date("I"))),
                'u_image' => "",
                'u_point' => 0,
                'u_status' => 1
            );
            $this->MUsers->addUser($data);
            echo json_encode("1");
        }
    }

}
