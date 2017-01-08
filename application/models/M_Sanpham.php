<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_Sanpham extends CI_Model {
    
    function getProductbySlug($slug){
        $this->db->select('products.*, ta_users.u_fullname, ta_users.u_username, categories.cat_id, categories.cat_name, categories.cat_slug, categories.cat_parent');
        $this->db->join('ta_users', 'ta_users.u_id = products.poster');
        $this->db->join('categories', 'categories.cat_id = products.p_cat');
        $this->db->where('products.slug', $slug);
        $this->db->where('products.is_active', 1);
        return $this->db->get('products')->row();
    }
    
    function getProductImg($p_id){
        $this->db->where('p_id', $p_id);
        return $this->db->get('product_images')->result();
    }
    
    function getParentProduct($p_id){
        $this->db->select('products.p_cat, categories.cat_name, categories.cat_id, categories.cat_parent');
        $this->db->join('categories', 'categories.cat_id = products.p_cat');
        $this->db->where('p_id', $p_id);
        return $this->db->get('products')->row();
    }
    
    function get_parent_cat($cat_parent){
        $this->db->select('cat_id, cat_name, cat_parent');
        $this->db->where('cat_id', $cat_parent);
        return $this->db->get('categories')->row();
    }
    
    function get_shop_by_id($u_id){
        $this->db->select('shop.*, ta_users.u_username, ta_users.u_fullname');
        $this->db->join('ta_users', 'ta_users.u_id = shop.p_id');
        $this->db->where('p_id', $u_id);
        return $this->db->get('shop')->row();
    }
    
    ## Update view
    function update_product_view( $product_id, $data_view = array() ){
        $this->db->where('p_id', $product_id);
        $this->db->update('products', $data_view);
    }
    
}