<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_Shop extends CI_Model {
    ## Lấy ID user bằng username

    function get_id_by_username($u_username) {
        $this->db->select('u_id');
        $this->db->where('u_username', $u_username);
        return $this->db->get('ta_users')->row();
    }

    ## Kiểm tra gian hàng tồn tại

    function check_shop_available($u_id) {
        $this->db->select('shop.*, ta_users.u_username, ta_users.u_fullname, ta_users.u_createdate, ta_users.u_image');
        $this->db->join('ta_users', 'ta_users.u_id = shop.p_id');
        $this->db->where('p_id', $u_id);
        return $this->db->get('shop')->row();
    }

    ## Lấy 10 sản phẩm mới của gian hàng

    function get_10_products_shop_new($p_id) {
        $this->db->select('products.*, ta_users.u_fullname, ta_users.u_username');
        $this->db->join('ta_users', 'ta_users.u_id = products.poster');
        $this->db->where('products.is_active', 1);
        $this->db->where('products.poster', $p_id);
        $this->db->limit(10);
        return $this->db->get('products')->result();
    }

    ## Lấy 10 sản phẩm mới của gian hàng

    function get_discount_products_shop($p_id) {
        $this->db->select('products.*, ta_users.u_fullname, ta_users.u_username');
        $this->db->join('ta_users', 'ta_users.u_id = products.poster');
        $this->db->where('products.is_active', 1);
        $this->db->where('products.poster', $p_id);
        $this->db->limit(10);
        return $this->db->get('products')->result();
    }

    ## Lấy tất cả sản phẩm ID của shop

    function get_shop_product_cat_id($u_id) {
        $this->db->distinct();
        $this->db->select('products.p_cat, categories.cat_name, categories.cat_slug, categories.cat_parent');
        $this->db->join('categories', 'categories.cat_id = products.p_cat');
        $this->db->where('poster', $u_id);
        $this->db->where('products.is_active', '1');
        return $this->db->get('products')->result();
    }

    ## Lấy danh mục cha

    function get_parent_category($cat_id) {
        $this->db->select('cat_id, cat_name, cat_slug');
        $this->db->where('cat_id', $cat_id);
        return $this->db->get('categories')->row();
    }

    ## Lấy tất cả danh mục con

    function get_all_cat_child($cat_parent, $shop_master) {
        $this->db->distinct();
        $this->db->select('categories.cat_id, categories.cat_name, categories.cat_slug');
        $this->db->join('products', 'products.p_cat = categories.cat_id');
        $this->db->where_in('categories.cat_parent', $cat_parent);
        $this->db->where('products.poster', $shop_master);
        return $this->db->get('categories')->result();
    }

    ## Lấy tên danh mục theo ID

    function get_nam_cat_by_id($cat_id) {
        
        $this->db->select('cat_id, cat_name, cat_slug');
        $this->db->where('cat_id', $cat_id);
        return $this->db->get('categories')->row();
    }

    ## Lấy banner của shop

    function get_banner_images($shop_id) {
        $this->db->where('shop_id', $shop_id);
        return $this->db->get('shop_images')->result();
    }

    ## Update lượt views
    function update_shop_view( $shop_id, $data = array() ){
        $this->db->where('shop_id', $shop_id);
        $this->db->update('shop', $data);
        
    }
}
