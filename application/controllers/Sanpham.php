<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sanpham extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_Sanpham');
    }

    public function index($slug) {
        if ($slug) {
            $product = $this->M_Sanpham->getProductbySlug($slug);
            if ($product):
                $shop_info = $this->M_Sanpham->get_shop_by_id($product->poster);
                $data = array(
                    'product' => $product,
                    'product_imgs' => $this->M_Sanpham->getProductImg($product->p_id),
                    'shop_info' => $shop_info
                );

                ## Update View cho sản phẩm
                $ck_view = $this->input->cookie('view_product', true);
                if (!$ck_view):
                    $cookie_view = array(
                        'name' => 'view_product',
                        'value' => '1',
                        'expire' => '86500',
                    );
                    $this->input->set_cookie($cookie_view);

                    ## lấy view hiện tại
                    $curent_view = $product->views;
                    $product_id = $product->p_id;
                    $data_view = array(
                        'views' => $curent_view + 1
                    );
                    $this->M_Sanpham->update_product_view($product_id, $data_view);

                endif;

                $this->load->view('default/templates/header');
                $this->load->view('default/templates/main_menu');
                $this->load->view('default/templates/end_header');
                $this->load->view('default/modules/products/detail_product', $data);
                $this->load->view('default/templates/footer');
            else:
                redirect(base_url() . "notfound");
            endif;
        } else {
            redirect(base_url() . "notfound");
        }
    }

}
