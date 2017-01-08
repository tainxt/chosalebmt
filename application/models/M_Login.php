<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Login extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function check_login($username, $password){
        $this->db->select('*');
        $this->db->where('u_username', $username);
        $this->db->where('u_password', $password);
        return $this->db->get('ta_users')->row();
    }
    
    function register($data){
        $this->db->insert('ta_users', $data);
        return $this->db->insert_id();
    }
    
    function register_user_detail($data_user){
        $this->db->insert('user_details', $data_user);
    }
    
    function check_username($u_username){
        $this->db->where('u_username', $u_username);
        return $this->db->count_all_results('ta_users');
    }
    
    function check_email($u_email){
        $this->db->where('u_email', $u_email);
        return $this->db->count_all_results('ta_users');
    }
    
    function check_phone($phone_number){
        $this->db->where('ud_phone', $phone_number);
        return $this->db->count_all_results('user_details');
    }
    
    function register_shop($data){
        $this->db->insert('shop', $data);
        return $this->db->insert_id();
    }
    
    function add_shop_post($data){
        $this->db->insert('shop_posts', $data);
    }
    
    function update_user_info( $u_id, $data_info = array() ){
        $this->db->where('u_id', $u_id);
        $this->db->update('user_details', $data_info);
    }
    
    function update_shop_info( $u_id, $shop_info = array() ){
        $this->db->where('p_id', $u_id);
        $this->db->update('shop', $shop_info);
    }

}
