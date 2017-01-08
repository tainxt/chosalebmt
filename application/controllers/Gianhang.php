<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gianhang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_Shop');
    }

    public function index($shop, $type, $slug) {

        $u_id = $this->M_Shop->get_id_by_username($shop);
        $shop_master = $this->M_Shop->check_shop_available($u_id->u_id);
        $ses_id = $this->session->userdata('uid');
        ## Kiểm tra tồn tại gian hàng không
        if (count($shop_master) > 0):
            //$shop_categories = $this->M_Shop->get_shop_product_cat_id($u_id->u_id);
            $shop_master_id = $u_id->u_id;
            $shop_banner = $this->M_Shop->get_banner_images($shop_master_id);
            $shop_info = array(
                'shop_slug' => $shop,
                'shop_info' => $shop_master,
                'shop_master_id' => $shop_master_id,
                'shop_banner' => $shop_banner
            );

            ## Update lượt view cho shop
            $ck_view = $this->input->cookie('view_shop', true);
            if (!$ck_view):
                $cookie_view = array(
                    'name' => 'view_shop',
                    'value' => '1',
                    'expire' => '86500',
                );
                $this->input->set_cookie($cookie_view);

                ## lấy view hiện tại
                $curent_view = $shop_master->views;
                $shop_id = $shop_master->shop_id;
                $data_view = array(
                    'views' => $curent_view + 1
                );
                $this->M_Shop->update_shop_view($shop_id, $data_view);

            endif;




            $this->load->view('default/templates/shop/my_shop_head', $shop_info);
            ## Có tồn tại, lấy sản phẩm ra
            switch ($type) {

                ## Trang chủ gian hàng
                case 'page':
                    $data = array(
                        'new_10' => $this->M_Shop->get_10_products_shop_new($shop_master_id),
                        'discounts' => $this->M_Shop->get_discount_products_shop($shop_master_id)
                    );
                    $this->load->view('default/modules/shop/my_shop', $data);
                    break;

                ## Trang bài viết
                case 'baiviet':
                    if ($slug === 'danhsach' && $shop_master->p_id == $ses_id):
                        $this->load->view('default/modules/shop/my_list_posts');
                    else:
                        $data = array(
                            'slug' => $slug
                        );
                        $this->load->view('default/modules/shop/my_post', $data);
                    endif;
                    break;

                ## Trang danh mục sản phẩm
                case 'danhmuc':
                    if ($slug):
                        $data = array(
                            'slug' => $slug
                        );
                        $this->load->view('default/modules/shop/my_products', $data);
                    else:
                        redirect(base_url() . "notfound");
                    endif;
                    break;

                ## Trang đơn hàng
                case 'donhang':
                    if ($slug === 'danhsach'):
                        $this->load->view('default/modules/shop/orders/list_orders');
                    else:
                        $data = array(
                            'slug' => $slug
                        );
                        $this->load->view('default/modules/shop/orders/detail_order', $data);
                    endif;
                    break;

                ## Trang thống kê
                case 'thongke':
                    if ($slug === 'danhsach'):
                        $this->load->view('default/modules/shop/my_shop_statistic');
                    else:
                        redirect(base_url() . "notfound");
                    endif;
                    break;

                ## Trang cấu hình
                case 'cauhinh':
                    if ($slug === 'danhsach'):
                        $this->load->view('default/modules/shop/my_shop_config');
                    else:
                        redirect(base_url() . "notfound");
                    endif;

                    break;

                ## Mặc định nếu không có gì
                default:
                    redirect(base_url() . "notfound");
                    break;
            }
            $this->load->view('default/templates/shop/my_shop_foot');
        else:
            redirect(base_url() . "notfound");
        endif;
    }

    function get_shop_categories() {
        $shop_categories = $this->M_Shop->get_shop_product_cat_id("1");
        $list_parent = array();
        foreach ($shop_categories as $category):
            if ($category->cat_parent > 0):
                $cat_parent = $this->M_Shop->get_parent_category($category->cat_parent);
                array_push($list_parent, $cat_parent->cat_id);
            endif;
        endforeach;
        $results = array_unique($list_parent);

        ## Lấy tất cả danh mục con

        foreach ($results as $result):
            $parent_name = $this->M_Shop->get_nam_cat_by_id($result);
            echo $parent_name->cat_name . "<br/ >";
            $childs = $this->M_Shop->get_all_cat_child($result);
            foreach ($childs as $child):
                echo "--" . $child->cat_name . "<br />";
            endforeach;
        endforeach;
    }

    function xxx() {
        $ck_view = $this->input->cookie('view', true);
        if (!$ck_view):
            echo "chưa có";
        endif;
    }

}
