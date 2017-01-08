<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class S_Default extends CI_Model {

    function get_parent_cat() {
        $this->db->where('cat_parent', '0');
        return $this->db->get('categories')->result();
    }

    function findCatbySlug($slug) {
        $this->db->select('cat_id');
        $this->db->where('cat_slug', $slug);
        return $this->db->get('categories')->row();
    }

    function getChildbyParent($parentID) {
        $this->db->select('cat_id, cat_name');
        $this->db->where('cat_parent', $parentID);
        return $this->db->get('categories')->result();
    }

    ## Lấy 10 sản phẩm mới nhất

    function select_new_10() {
        $this->db->select('products.*, ta_users.u_fullname, ta_users.u_username');
        $this->db->join('ta_users', 'ta_users.u_id = products.poster');
        $this->db->where('is_active', 1);
        $this->db->order_by("products.p_id", "desc");
        $this->db->limit(10);
        return $this->db->get('products')->result();
    }

    ## Lấy Feature Image sản phẩm

    function feature_image($p_id) {
        $this->db->where('p_id', $p_id);
        $this->db->limit(1);
        return $this->db->get('product_images')->row();
    }

    ## Từ danh mục cha tìm danh mục con

    function findChild($parent_id) {
        $this->db->where('cat_parent', $parent_id);
        return $this->db->get('categories')->result();
    }

    ## Từ danh mục con tìm danh mục cháu :v
    // Kiểm tra xem con có cháu ko ~~

    function checkSubChild($child_id) {
        $this->db->where('cat_parent', $child_id);
        return $this->db->count_all_results('categories');
    }

    function findListChild($ids) {
        $this->db->select('products.*, ta_users.u_fullname, ta_users.u_username');
        $this->db->join('ta_users', 'ta_users.u_id = products.poster');
        $this->db->where_in('p_cat', $ids);
        $this->db->where('is_active', 1);
        $this->db->order_by("products.p_id", "desc");
        $this->db->limit(10);
        return $this->db->get('products')->result();
    }

    ## Kiểm tra thông tin liên hệ.

    function check_detail_user($u_id) {
        $this->db->where('u_id', $u_id);
        return $this->db->get('user_details')->row();
    }

    ## Lấy tên shop

    function getShopname($id) {
        $this->db->select('name');
        $this->db->where('p_id', $id);
        return $this->db->get('shop')->row();
    }

}
