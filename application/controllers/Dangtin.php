<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dangtin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_Dangtin');
    }

    public function index() {
        $ses_id = $this->session->userdata('uid');
        if (!$ses_id):
            redirect(base_url() . "Home?login=false");
        endif;
        $this->load->view('default/templates/header');
        $this->load->view('default/modules/products/no_cat_choose');
        $this->load->view('default/templates/footer');
    }

    function get_cur_address() {
        $cur_u_id = $this->session->userdata('uid');
        $data = $this->M_Dangtin->get_cur_address($cur_u_id);
        echo json_encode($data);
    }

    function Category($slug) {
        $ses_id = $this->session->userdata('uid');
        if ($slug && $ses_id) {

            ## Lấy session Upload Hình 
            $upload_file_name = $this->session->userdata('upload_file_name');

            ## Xóa file hình trong Session
            $this->Auto_delete_img($upload_file_name);

            ## Kiểm tra xem có danh mục này ko
            $parent_id = $this->S_Default->findCatbySlug($slug);
            if ($parent_id !== NULL):

                ## Lấy ID danh mục cha
                $choose_id = $parent_id->cat_id;

                ## Lấy danh sách danh mục sản phẩm
                $list_cat = $this->S_Default->getChildbyParent($choose_id);

                ## Xóa session upload ảnh
                $this->session->unset_userdata('count_num_file');

                ## Lấy id người đăng tin
                $cur_u_id = $this->session->userdata('uid');

                ## Lấy thông tin người đăng tin
                $user_info = $this->M_Dangtin->get_cur_address($cur_u_id);

                ## Lấy danh sách khu vực
                $regions = $this->M_Dangtin->get_regions();

                $data = array(
                    'user_info' => $user_info,
                    'list_cat' => $list_cat,
                    'list_regions' => $regions
                );
                $this->load->view('default/templates/header');
                $this->load->view('default/modules/products/add_product', $data);
                $this->load->view('default/templates/footer');
            else:
                redirect(base_url() . "Dangtin");
            endif;
        }
        else {
            redirect(base_url() . "Home?login=false");
        }
    }

    function Auto_delete_img($upload_file_name) {
        if ($upload_file_name):
            foreach ($upload_file_name as $val):
                $big_f = explode(",", $val);
                $location_file = "uploads/files/" . $big_f[0];
                $thumb = explode(".", $big_f[0]);
                $location_thumb = "uploads/files/thumb/" . $thumb[0] . "_thumb." . $thumb[1];
                unlink($location_file);
                unlink($location_thumb);
            endforeach;
            $this->session->unset_userdata('upload_file_name');
        endif;
    }

    function ProcessAdd() {
        $timezone = +7;
        $isVali = TRUE;
        $slug = $this->Check_slug($this->input->post('slug'));
        ## Set Value trong input vào Array 
        $data = array(
            'p_cat' => $this->input->post('p_cat'),
            'p_region' => $this->input->post('region'),
            'name' => $this->input->post('name'),
            'slug' => $slug,
            'price' => str_replace(".", "", $this->input->post('price')),
            'qty' => $this->input->post('qty'),
            'status' => $this->input->post('status'),
            'status_val' => $this->input->post('status_val'),
            'discount' => $this->input->post('discount'),
            'discount_val' => $this->input->post('discount_val'),
            'poster' => $this->session->userdata('uid'),
            'is_active' => 0,
            'activator' => 0,
            'create_date' => gmdate("Y-m-d H:i:s", time() + 3600 * ($timezone + date("I"))),
            'keyword' => $this->input->post('keyword'),
            'tag' => " " . $this->input->post('tag'),
            'description' => " " . $this->input->post('description'),
            'transport' => " " . $this->input->post('transport'),
            'ranks' => 0,
            'views' => 0
        );

        ## Duyệt data để kiểm tra dữ liệu bị rỗng
        foreach ($data as $vali):
            if ($vali === NULL):
                $isVali = FALSE;
            endif;
        endforeach;

        ## Nếu dữ liệu đầy đủ thực hiện thêm sản phẩm
        if ($isVali):

            ## Gỡ bỏ session id sản phẩm thêm lúc trước
            $this->session->unset_userdata('my_product_id');

            ## Lấy Id sản phẩm vừa thêm vào
            $p_id = $this->M_Dangtin->insert_product($data);

            ## Kiểm tra nếu người dùng thêm địa chỉ mới
            $new_address = $this->input->post('cbx-contact');
            if ($new_address === "1"):
                $data_new_address = array(
                    'p_id' => $p_id,
                    'is_info' => 1,
                    'fullname' => $this->input->post('p_seller'),
                    'phone' => $this->input->post('p_seller_phone'),
                    'address' => $this->input->post('p_seller_address')
                );
                $this->M_Dangtin->insert_new_address($data_new_address);
            else:
                $data_new_address = array(
                    'p_id' => $p_id,
                    'is_info' => 0,
                    'fullname' => "",
                    'phone' => "",
                    'address' => ""
                );
                $this->M_Dangtin->insert_new_address($data_new_address);
            endif;

            ## Nếu Thêm sản phẩm thành công thì thực hiện thêm hình
            if ($p_id):
                $upload_file_name = $this->session->userdata('upload_file_name');
                $this->Upload_Ses_Img($upload_file_name, $p_id);
                ## Gán id vừa thêm vào session
                $this->session->set_userdata('my_product_id', $p_id);
                echo "true";
            endif;

        else:

            echo "false";

        endif;
    }

    ## Kiểm tra slug có bị trùng không

    function Check_slug($slug) {
        $count_slug = $this->M_Dangtin->check_slug($slug);
        if ($count_slug > 0) {
            $slug = $slug . "-" . rand(1, 99);
        } else {
            $slug = $slug;
        }
        return $slug;
    }

    ## Thực hiện Upload Hình

    function Upload_Ses_Img($upload_file_name, $p_id) {
        if ($upload_file_name):
            foreach ($upload_file_name as $val):
                $img = explode(",", $val);
                $img_name = $img[0];

                //$img_alt = $img[1];
                if (!isset($img[1])):
                    $img_alt = " ";
                else:
                    $img_alt = $img[1];
                endif;

                //$img_title = $img[2];
                if (!isset($img[2])):
                    $img_title = " ";
                else:
                    $img_title = $img[2];
                endif;
                $data_img = array(
                    'p_id' => $p_id,
                    'name' => $img_name,
                    'alt' => $img_alt,
                    'title' => $img_title
                );
                $this->M_Dangtin->insert_img($data_img);
            endforeach;
            $this->session->unset_userdata('upload_file_name');
        endif;
    }

    function Success() {
        $recent_add = $this->session->userdata('my_product_id');
        if ($recent_add):
            $poster_id = $this->session->userdata('uid');
            $shop_info = $this->M_Dangtin->get_shop_by_id($poster_id);

            $product = $this->M_Dangtin->get_my_recent($recent_add);

            $data = array(
                'product' => $product,
                'product_imgs' => $this->M_Dangtin->getProductImg($product->p_id),
                'shop_info' => $shop_info
            );
            $this->load->view('default/templates/header');
            $this->load->view('default/templates/main_menu');
            $this->load->view('default/templates/end_header');
            $this->load->view('default/modules/products/success_add', $data);
            $this->load->view('default/templates/footer');
        endif;
    }

    function test_time() {
        $this->load->helper('date');
        echo $date = date('Y-m-d H:i:s');
    }

}
