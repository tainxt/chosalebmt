<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_Danhmuc extends CI_Model {
    ## Kiểm tra ID có tồn tại không

    function check_id_ivali($id) {
        $this->db->where('cat_id', $id);
        return $this->db->count_all_results('categories');
    }

    function get_categories_childs($id) {
        $this->db->select('cat_id, cat_name, cat_slug');
        $this->db->where('cat_parent', $id);
        return $this->db->get('categories')->result();
    }

    ## Lấy sản phẩm theo danh mục con

    function get_products_by_cats($list_childs, $offset, $limit) {
        $query = $this->db->query(
                "SELECT products.*, ta_users.u_fullname, ta_users.u_username ,
                    (
                        SELECT product_images.name
                        FROM product_images
                        WHERE product_images.p_id = products.p_id
                        LIMIT 1
                    ) as pi_name
                FROM products
                JOIN ta_users ON ta_users.u_id = products.poster
                WHERE products.p_cat IN ($list_childs) 
                AND products.is_active = 1
                ORDER BY products.create_date desc
                LIMIT $offset, $limit");

        $result = $query->result_array();
        return $result;
    }

    ## Lấy sản phẩm tìm kiếm theo danh mục con

    function get_products_search_by_cats($keyword, $list_childs, $offset, $limit) {
        $query = $this->db->query(
                "SELECT products.*, ta_users.u_fullname, ta_users.u_username ,
                    (
                        SELECT product_images.name
                        FROM product_images
                        WHERE product_images.p_id = products.p_id
                        LIMIT 1
                    ) as pi_name
                FROM products
                JOIN ta_users ON ta_users.u_id = products.poster
                WHERE products.p_cat IN ($list_childs) AND
                      products.name LIKE '%$keyword%' AND
                      products.is_active = 1
                ORDER BY products.create_date desc
                LIMIT $offset, $limit");

        $result = $query->result_array();
        return $result;
    }

    ## Lấy sản phẩm theo filter

    function get_by_filter($sql) {
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    ## Đếm tổng sản phẩm theo danh mục

    function count_all_products_by_id($list_childs) {
        $this->db->where('is_active', 1);
        $this->db->where_in('p_cat', $list_childs);
        return $this->db->count_all_results('products');
    }

    ## Đếm tổng sản phẩm tìm kiếm danh mục

    function count_all_search_products_by_id($keyword, $list_childs) {
        $this->db->where('is_active', 1);
        $this->db->like('name', $keyword);
        $this->db->where_in('p_cat', $list_childs);
        return $this->db->count_all_results('products');
    }

    ## Lấy hình đại diện của sản phẩm

    function get_feature_img($p_id) {
        $this->db->where('p_id', $p_id);
        $this->db->limit('1');
        return $this->db->get('product_images')->row();
    }

    ## Đếm sản phẩm theo filter

    function count_filter_products($sql_count) {
        $query = $this->db->query($sql_count);
        $result = $query->row();
        return $result;
    }

}
