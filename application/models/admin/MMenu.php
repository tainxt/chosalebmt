<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MMenu extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function getAll() {
        return $this->db->get('categories')->result();
    }
    
}