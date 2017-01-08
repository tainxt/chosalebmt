<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MUsers extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function getAll(){
        $this->db->join('ta_roles', 'ta_users.r_id = ta_roles.r_id');
        return $this->db->get('ta_users')->result();
    }
    
    function findID($u_id){
        $this->db->where('u_id', $u_id);
        return $this->db->get('ta_users')->row();
    }
    
    // Lay danh sach quyen user
    function getAllRole(){
        return $this->db->get('ta_roles')->result();
    }
    
    // Them moi 1 user
    function addUser($data = array()){
        $this->db->insert('ta_users', $data);
    }
    
    function updateUser($u_id, $data = array() ){
        $this->db->where('u_id', $u_id);
        $this->db->update('ta_users', $data);
    }

}
