<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/MProducts');
    }

    public function index() {
        $this->load->view('backend/templates/backend_head');
        $this->load->view('backend/templates/backend_top');
        $this->load->view('backend/modules/products/list_products');
        $this->load->view('backend/templates/backend_bot');
    }

    public function EditProduct() {
        
    }

    public function Categories() {

        $categories = $this->MProducts->getAll();
        $getParents = $this->MProducts->getParent();

        $data = array(
            'categories' => $categories,
            'parents' => $getParents
        );

        $this->load->view('backend/templates/backend_head');
        $this->load->view('backend/templates/backend_top');
        $this->load->view('backend/modules/products/list_categories', $data);
        $this->load->view('backend/templates/backend_bot');
    }

    public function ProcessAddCategory() {
        $cat_slug = $this->input->post('cat_slug');
        if ($cat_slug):
            $data = array(
                'cat_name' => $this->input->post('cat_name'),
                'cat_img' => $this->input->post('cat_img'),
                'cat_slug' => $this->input->post('cat_slug'),
                'cat_font_awesome' => $this->input->post('cat_font_awesome'),
                'cat_keyword' => $this->input->post('cat_keyword'),
                'cat_description' => $this->input->post('cat_description'),
                'cat_parent' => $this->input->post('cat_parent'),
            );
            $this->MProducts->addCat($data);
            echo "done";
        endif;
    }

    public function ProcessEditCategory() {
        $cat_id = $this->input->post('cat_id');
        if ($cat_id):
            $data = array(
                'cat_name' => $this->input->post('cat_name'),
                'cat_img' => $this->input->post('cat_img'),
                'cat_slug' => $this->input->post('cat_slug'),
                'cat_font_awesome' => $this->input->post('cat_font_awesome'),
                'cat_keyword' => $this->input->post('cat_keyword'),
                'cat_description' => $this->input->post('cat_description'),
                'cat_parent' => $this->input->post('cat_parent'),
            );
            $this->MProducts->editCat($cat_id, $data);
            echo "done";
        endif;
    }

    public function ProcessGetIDCategory() {
        $cat_id = $this->input->post('cat_id');
        if ($cat_id):
            $data = $this->MProducts->getID($cat_id);
            echo json_encode($data);
        endif;
    }

    public function ProcessDelCategory() {
        $cat_id = $this->input->post('cat_id');
        if ($cat_id):
            $this->MProducts->delCat($cat_id);
            echo "done";
        endif;
    }

}
