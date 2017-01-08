<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MProducts extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAll() {
        return $this->db->get('categories')->result();
    }

    function getID($cat_id) {
        $this->db->where('cat_id', $cat_id);
        return $this->db->get('categories')->row();
    }

    function getParent() {
        $this->db->where('cat_parent', 0);
        return $this->db->get('categories')->result();
    }

    function getChildOf($parent) {
        $this->db->where('cat_parent', $parent);
        return $this->db->get('categories')->result();
    }

    function addCat($data = array()) {
        $this->db->insert('categories', $data);
    }

    function editCat($cat_id, $data = array()) {
        $this->db->where('cat_id', $cat_id);
        $this->db->update('categories', $data);
    }

    function delCat($cat_id) {
        $this->db->where('cat_id', $cat_id);
        $this->db->delete('categories');
    }

}
