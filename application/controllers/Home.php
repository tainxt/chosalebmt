<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_Login');
    }

    public function index() {

        $data = array(
            'new_10' => $this->S_Default->select_new_10()
        );
        $this->load->view('default/templates/header');
        $this->load->view('default/templates/main_menu');
        $this->load->view('default/templates/main_slider');
        $this->load->view('default/templates/end_header');
        $this->load->view('default/modules/home/home', $data);
        $this->load->view('default/templates/footer');
    }

    ## <editor-fold defaultstate="collapsed" desc="PROCESS UPDATE INFO">

    function procee_update_info() {
        $respone = "";

        if (($_FILES['avatar']['name'])):
            ## Cấu hình Upload
            $uploadPath = 'uploads/shop/avatar';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '8000';

            ## Lấy input thông tin cá nhân
            $u_id = $this->session->userdata('uid');
            $data_info = array(
                'u_id' => $u_id,
                'ud_avatar' => $_FILES['avatar']['name'],
                'ud_phone' => $this->input->post('ud_phone'),
                'ud_dob' => date('Y/m/d', strtotime($this->input->post('ud_dob'))),
                'ud_address' => $this->input->post('ud_address')
            );
            $isVali = TRUE;

            ## Kiểm tra dữ liệu rỗng
            foreach ($data_info as $info):
                if ($info == ""):
                    $isVali = FALSE;
                endif;
            endforeach;

            ## Điều kiện dữ liệu đầy đủ
            if ($isVali):

                ## Kiểm tra tồn tại số điện thoại
                $phone_number = $this->input->post('ud_phone');
                $check_phone = $this->M_Login->check_phone($phone_number);

                if ($check_phone > 0):
                    $respone = "Số điện thoại đã được đăng ký. Nếu bạn quên tài khoản hoặc email hãy <a href='" . base_url() . "Home/Khoiphuctaikhoan" . "'> nhấn vào đây</a>";
                else:
                    ## Thực hiện Upload
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    ## Kiểm tra đã upload đc chưa
                    if ($this->upload->do_upload('avatar')):

                        $fileData = $this->upload->data();

                        ## Cấu hình Upload Thumbnail
                        $source_path = 'uploads/shop/avatar/' . $fileData['file_name'];
                        $target_path = 'uploads/shop/avatar/thumb/';
                        $config_manip = array(
                            'image_library' => 'gd2',
                            'source_image' => $source_path,
                            'new_image' => $target_path,
                            'maintain_ratio' => TRUE,
                            'create_thumb' => TRUE,
                            'thumb_marker' => '',
                            'width' => 200,
                            'height' => 200
                        );

                        ## Thực hiện resize
                        $this->load->library('image_lib', $config_manip);
                        $this->image_lib->initialize($config_manip);
                        $this->image_lib->resize();

                        ## Cập nhật thông tin cá nhân
                        $new_img_name = array(
                            'ud_avatar' => $fileData['file_name']
                        );

                        ## Tạo array chứa thông tin shop
                        $info_shop = array(
                            'phone' => $this->input->post('ud_phone'),
                            'address' => $this->input->post('ud_address'),
                        );

                        ## Thay thế tên hình
                        $new_info = array_replace($data_info, $new_img_name);

                        $this->M_Login->update_shop_info($u_id, $info_shop);
                        $this->M_Login->update_user_info($u_id, $new_info);
                        $respone = "Cập nhật thành công";

                    else:

                        ## Xuất lỗi
                        $respone = $this->upload->display_errors();
                    endif;
                endif;

            else:
                $respone = "Vui lòng nhập đầy đủ dữ liệu!";
            endif;

        else:
            $respone = "Vui lòng chọn một hình";
        endif;

        echo $respone;
    }

    ## </editor-fold>
    ## <editor-fold defaultstate="collapsed" desc="AJAX LOGIN">

    public function ajax_login() {
        if (($this->input->post("login_account") !== "") || ($this->input->post("login_password") !== "")) {
            $username = preg_replace('/[^a-zA-Z0-9\-_]/', '', $this->input->post("login_account"));
            $password = $this->input->post("login_password");
            $result = $this->M_Login->check_login($username, md5($password));
            if (count($result) > 0) {
                $uid = $result->u_id;
                $username = $result->u_username;

                $data = array(
                    'uid' => $uid,
                    'username' => $username,
                );

                $this->session->set_userdata($data);
                echo ($this->session->userdata('username'));
            }
        }
    }

    ## </editor-fold>
    ## <editor-fold defaultstate="collapsed" desc="AJAX REGISTER">

    function ajax_regsiter() {
        ## Đặt múi giờ
        $timezone = +7;
        $create_date = gmdate("Y-m-d H:i:s", time() + 3600 * ($timezone + date("I")));
        ## Validate = True
        $isVali = TRUE;

        ## Bỏ ký tự đặc biệt ra khỏi username
        $u_username = preg_replace('/[^a-zA-Z0-9\-_]/', '', $this->input->post("u_username"));

        ## Tạo array gắn dữ liệu vào.
        $data = array(
            'r_id' => 2,
            'u_fullname' => $this->input->post('u_fullname'),
            'u_username' => $u_username,
            'u_password' => md5($this->input->post('u_password')),
            'u_gender' => $this->input->post('u_gender'),
            'u_email' => $this->input->post('u_email'),
            'u_createdate' => $create_date,
            'u_image' => " ",
            'u_point' => 0,
            'u_status' => 1
        );

        ## Duyệt array tìm dữ liệu rỗng
        foreach ($data as $item):
            if ($item === ""):
                $isVali = FALSE;
            endif;
        endforeach;

        ## Kiểm tra nếu ko rỗng dữ liệu thì ghi vào db
        if ($isVali):
            try {

                ## Kiểm tra tài khoản tồn tại
                $check_username = $this->M_Login->check_username($u_username);

                ## Kiểm tra email tồn tại
                $check_email = $this->M_Login->check_email($this->input->post("u_email"));

                ## Kiểm tra captcha trùng
                $captcha = $this->session->userdata('word');
                $re_captcha = $this->input->post("captcha");

                if ($check_username > 0):
                    echo "Tài khoản đã tồn tại";
                elseif ($check_email > 0):
                    echo "Email đã tồn tại";
                elseif ($captcha != $re_captcha):
                    echo "Mã bảo vệ không đúng";
                else:
                    ## Thêm user vào db
                    $u_id = $this->M_Login->register($data);

                    ## Nếu thêm thành công thì tạo gian hàng
                    if ($u_id):
                        $data_shop = array(
                            'p_id' => $u_id,
                            'name' => $this->input->post('u_fullname'),
                            'phone' => 0,
                            'address' => "",
                            'email' => $this->input->post("u_email"),
                            'keyword' => "",
                            'description' => "",
                            'vip' => 0,
                            'vote' => 0,
                            'vote_point' => 0,
                            'views' => 0
                        );
                        ## Tạo gian hàng
                        $shop_id = $this->M_Login->register_shop($data_shop);

                        ## Tạo các bài viết cho gian hàng
                        $this->create_post($shop_id, $create_date);

                        $data_user = array(
                            'u_id' => $u_id,
                            'ud_phone' => 0,
                            'ud_dob' => "",
                            'ud_address' => "",
                            'ud_pincode' => md5(rand()),
                            'ud_last_login' => ""
                        );
                        ## Tạo chi tiết user
                        $this->M_Login->register_user_detail($data_user);

                        ## Gắn session login cho user mới tạo
                        $data_login = array(
                            'uid' => $u_id,
                            'username' => $u_username,
                        );

                        $this->session->set_userdata($data_login);
                        echo "1";
                    endif;
                endif;
            } catch (Exception $ex) {
                echo $ex;
            }
        else:
            echo "0";
        endif;
    }

    ## </editor-fold>

    public function logout() {
        $this->session->unset_userdata('uid');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        redirect(base_url());
    }

    function created() {
        $vals = array(
            'word' => '',
            'img_path' => './public/captcha/',
            'img_url' => base_url('public') . '/captcha/',
            'img_width' => '100',
            'img_height' => 34,
            'expiration' => 7200,
            'word_length' => 5,
            'font_size' => 16,
            'pool' => '0123456789abcdefghijklmnopqrstuvwxyz',
            'colors' => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(232, 232, 232)
            )
        );
        $cap = create_captcha($vals);
        $this->session->set_userdata($cap);
        echo $cap['image'];
    }

    ## <editor-fold defaultstate="collapsed" desc="GET PRODUCTS BY PARENT">

    function testParent() {

        ## Lấy post parent_id;
        $parent_id = $this->input->post('parent_id');
        if ($parent_id > 0):

            ## Tạo mảng id con cháu
            $arr_child = array();

            ## Lấy danh sách id con
            $list_child = $this->S_Default->findChild($parent_id);

            ## Duyệt id con ra
            foreach ($list_child as $child):

                ## Kiểm tra nếu có cháu
                if ($this->S_Default->checkSubChild($child->cat_id) > 0):

                    ## Lấy danh sách id cháu
                    $list_subChild = $this->S_Default->findChild($child->cat_id);

                    ## Duyệt id cháu
                    foreach ($list_subChild as $subChild):

                        ## Cho id cháu vào mảng
                        array_push($arr_child, $subChild->cat_id);
                    endforeach;

                endif;

            endforeach;

            ## Lấy danh sách sản phẩm theo id con cháu @@
            $listProducts = $this->S_Default->findListChild($arr_child);


        else:
            $listProducts = $this->S_Default->select_new_10();
        endif;

        $result = "";

        if (count($listProducts) > 0):

            ## Duyệt danh sách sản phẩm
            foreach ($listProducts as $k => $product):
                $k+=1;
                $feature_img = $this->S_Default->feature_image($product->p_id);

                $result .= '<div id="form-add-to-cart" class="item">';
                $result .= '<div class="view view-first">';
                $result .= '<img src="' . base_url() . 'uploads/files/thumb/' . $feature_img->name . '" class="img-responsive" alt="">';
                $result .= '<div class="mask">';

                $result .= '<a href=" ' . base_url() . 'sanpham/' . $product->slug . ' " class="info btn-info btn">Chi tiết</a>';
                $result .= '<div class="product-rating" data-score="4">';
                $result .= '<i class="fa fa-star star-voted" aria-hidden="true"></i>';
                $result .= '<i class="fa fa-star star-voted" aria-hidden="true"></i>';
                $result .= '<i class="fa fa-star star-voted" aria-hidden="true"></i>';
                $result .= '<i class="fa fa-star star-voted" aria-hidden="true"></i>';
                $result .= '<i class="fa fa-star star-unvoted" aria-hidden="true"></i>';
                $result .= '</div>';
                $result .= '</div>';
                if ($product->discount):

                    $result .= '<button class="btn btn-xs btn-warning btn-product-discount">-' . $product->discount_val . '% <i class="fa fa-tag" aria-hidden="true"></i></button>';

                endif;
                $result .= '</div>';

                $result .= '<div class="product-content">';
                $result .= '<div class="product-name"><a data-id="' . $product->p_id . '" title="' . $product->name . '" href="' . base_url() . 'sanpham/' . $product->slug . '">' . $product->name . '</a></div>';
                $result .= '<div class="product-time">';
                $result .= '<span title=" ' . date('H:i d/m/Y', strtotime($product->create_date)) . ' ">';
                $result .= '<i class="fa fa-clock-o" aria-hidden="true"></i> ';
                $result .= '<span class="create-date create-date-' . $k . '">' . $product->create_date . '</span>';
                $result .= '</span> | người bán  ';
                $result .= '<a href=" ' . base_url() . 'gianhang/' . $product->u_fullname . ' ">';
                $result .= $product->u_fullname;
                $result .= '</a>';
                $result .= '</div>';
                $result .= '<div class="product-price">';

                $price = $product->price;
                $discount_val = $product->discount_val;
                if ($product->discount > 0):
                    $new_price = $price - ($price / $discount_val);
                    $result .= '<span class="product-discont"><i class="fa fa-angle-down" aria-hidden="true"></i>' . number_format($price) . '₫  </span>';
                    $result .= "&nbsp; &nbsp; ";
                    $result .= '<span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> ' . number_format($new_price) . '₫</span>';
                else:
                    $result .= '<span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> ' . number_format($price) . '₫</span>';
                endif;


                $result .= '</div>';
                $result .= '</div>';
                $result .= '<div class="product-controll">';
                $result .= '<button id="icon-cart" class="btn btn-primary btn-sm add-to-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Thêm vào giỏ</button>';
                $result .= '<button class="btn btn-danger btn-sm"><i class="fa fa-heart" aria-hidden="true"></i></button>';
                $result .= '</div>';

                $result .= '</div>';

            endforeach;

        else:

            $result = "Không có dữ liệu!  <style>.owl-carousel{opacity: 1 !important; display: block;}</style>";
        endif;

        echo ($result);
    }

    ## </editor-fold>

    function create_post($shop_id, $create_date) {
        $posts_name = array(
            '1' => array(
                'title' => 'Giới thiệu',
                'slug' => 'gioithieu',
            ),
            '2' => array(
                'title' => 'Chính sách',
                'slug' => 'chinhsach',
            ),
            '3' => array(
                'title' => 'Liên hệ',
                'slug' => 'lienhe',
            )
        );

        foreach ($posts_name as $post):
            $data = array(
                'shop_id' => $shop_id,
                'title' => $post['title'],
                'slug' => $post['slug'],
                'create_date' => $create_date,
                'content' => "",
                'type' => 0,
            );
            $this->M_Login->add_shop_post($data);
        endforeach;
    }

}
