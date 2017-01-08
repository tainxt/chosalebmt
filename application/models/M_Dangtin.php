<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_Dangtin extends CI_Model {

    function get_cur_address($ses_u_id) {
        $this->db->select('user_details.ud_phone, user_details.ud_address, ta_users.u_fullname');
        $this->db->join('ta_users', 'ta_users.u_id = user_details.u_id');
        $this->db->where('user_details.u_id', $ses_u_id);
        return $this->db->get('user_details')->row();
    }

    function insert_product($data = array()) {
        $this->db->insert('products', $data);
        return $this->db->insert_id();
    }

    function check_slug($slug) {
        $this->db->where('slug', $slug);
        return $this->db->count_all_results('products');
    }

    function insert_img($data) {
        $this->db->insert('product_images', $data);
    }

    function get_regions() {
        return $this->db->get('regions')->result();
    }

    function get_shop_by_id($u_id) {
        $this->db->select('shop.*, ta_users.u_username, ta_users.u_fullname');
        $this->db->join('ta_users', 'ta_users.u_id = shop.p_id');
        $this->db->where('p_id', $u_id);
        return $this->db->get('shop')->row();
    }

    function getProductImg($p_id) {
        $this->db->where('p_id', $p_id);
        return $this->db->get('product_images')->result();
    }

    function get_my_recent($p_id) {
        $this->db->select('products.*, product_detail.*, ta_users.u_fullname, ta_users.u_username, categories.cat_id, categories.cat_name, categories.cat_slug, categories.cat_parent');
        $this->db->join('ta_users', 'ta_users.u_id = products.poster');
        $this->db->join('categories', 'categories.cat_id = products.p_cat');
        $this->db->join('product_detail', 'product_detail.p_id = products.p_id');
        $this->db->where('products.p_id', $p_id);
        return $this->db->get('products')->row();
    }
    
    function get_parent_cat($cat_parent){
        $this->db->select('cat_id, cat_name, cat_parent');
        $this->db->where('cat_id', $cat_parent);
        return $this->db->get('categories')->row();
    }
    
    function insert_new_address( $data = array() ){
        $this->db->insert( 'product_detail', $data );
    }

}
