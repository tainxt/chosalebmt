<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_Giohang extends CI_Model {
    
    function findID($id){
        $this->db->where('p_id', $id);
        $this->db->where('is_active', 1);
        return $this->db->get('products')->row();
    }
    
    function featureImage($p_id){
        $this->db->select('name');
        $this->db->where('p_id', $p_id);
        $this->db->limit('1');
        return $this->db->get('product_images')->row();
    }
    
}