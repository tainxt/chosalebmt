<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Danhmuc extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_Danhmuc');
    }

    public function index($id, $slug) {

        ## Kiểm tra ID có tồn tại không
        $isset_id = $this->M_Danhmuc->check_id_ivali($id);

        if ($isset_id > 0 && $slug):
            ## Tạo mảng chứa dữ liệu
            $data = array();

            ## Lấy templates
            $this->load->view('default/templates/header');
            $this->load->view('default/templates/main_menu');
            $this->load->view('default/templates/end_header');

            ## Số sản phẩm mỗi trang
            $per_page = 1;

            ## Trang hiện tại là 1
            $curent_page = 1;

            ## Kiểm tra ID có mục con không
            $get_cat_childs = $this->M_Danhmuc->get_categories_childs($id);
            if (count($get_cat_childs) > 0):

                ## Lấy danh sách ID con cháu
                $arr_child_id = $this->findChild($get_cat_childs);

                ## Tổng sản phẩm tìm thấy
                $total_products = $this->M_Danhmuc->count_all_products_by_id($arr_child_id);

                ## Tìm LIMIT và OFSET
                $offset = $curent_page * $per_page - $per_page;

                $products = $this->M_Danhmuc->get_products_by_cats(implode(",", $arr_child_id), $offset, $per_page);

                $data = array(
                    'products' => $products,
                    'per_page' => $per_page,
                    'total_products' => $total_products,
                    'id_cat' => $id
                );

            else:

                ## Tổng sản phẩm tìm thấy
                $total_products = $this->M_Danhmuc->count_all_products_by_id($id);

                ## Tìm LIMIT và OFSET
                $offset = $curent_page * $per_page - $per_page;

                $products = $this->M_Danhmuc->get_products_by_cats($id, $offset, $per_page);

                $data = array(
                    'products' => $products,
                    'per_page' => $per_page,
                    'total_products' => $total_products,
                    'id_cat' => $id
                );
            endif;

            $this->load->view('default/modules/categories/products', $data);

            ## Lấy templates
            $this->load->view('default/templates/footer');
        else:
            redirect(base_url() . 'notfound');
        endif;
    }

    public function ajax_paging($type_page, $curent_page, $id_cat) {

        /*
         * $type_page là biến loại trang tìm kiếm sản phẩm hay danh mục sản phẩm
         * $curent_page là biến trang hiện tại
         * $id_cat là biến ID danh mục
         */

        ## Sản phẩm mỗi trang
        $per_page = 1;

        ## Tạo array
        $data = array();

        ## type = 1 là trang danh mục
        if ($type_page === "1"):

            ## Tìm con của danh mục ID_cat
            $get_cat_childs = $this->M_Danhmuc->get_categories_childs($id_cat);

            ## Kiểm tra ID_cat có mục con không
            if (count($get_cat_childs) > 0):
                $arr_child_id = $this->findChild($get_cat_childs);

                ## Tổng sản phẩm tìm thấy
                $total_products = $this->M_Danhmuc->count_all_products_by_id($arr_child_id);
                if ($total_products == 0):
                    $data = array(
                        'respone' => "Không có sản phẩm tìm thấy!",
                        'total_products' => $total_products
                    );
                endif;
                ## Tổng số trang
                $total_page = ceil($total_products / $per_page);

                ## Tìm LIMIT và OFSET
                $offset = ($curent_page * $per_page) - $per_page;
                if ($curent_page < 0):
                    $offset = 0;
                elseif ($curent_page > $total_page):
                    $offset = $total_page * $per_page - $per_page;
                endif;

                ## Lấy sản phẩm
                $products = $this->M_Danhmuc->get_products_by_cats(implode(",", $arr_child_id), $offset, $per_page);

                //echo $this->foreach_products($products);
                $data = array(
                    'respone' => $this->foreach_products($products),
                    'total_products' => $total_products
                );

            ## Không có danh mục con
            else:

                ## Tổng sản phẩm tìm thấy
                $total_products = $this->M_Danhmuc->count_all_products_by_id($id_cat);
                if ($total_products == 0):
                    $data = array(
                        'respone' => "Không có sản phẩm tìm thấy!",
                        'total_products' => $total_products
                    );
                endif;

                ## Tổng số trang
                $total_page = ceil($total_products / $per_page);

                ## Tìm LIMIT và OFSET
                $offset = ($curent_page * $per_page) - $per_page;
                if ($curent_page < 0):
                    $offset = 0;
                elseif ($curent_page > $total_page):
                    $offset = $total_page * $per_page - $per_page;
                endif;

                ## Lấy sản phẩm
                $products = $this->M_Danhmuc->get_products_by_cats($id_cat, $offset, $per_page);
                $data = array(
                    'respone' => $this->foreach_products($products),
                    'total_products' => $total_products
                );

            endif;
            echo json_encode($data);

        endif;
    }

    public function ajax_search_paging($type, $keyword, $curent_page, $id) {
        ## Sản phẩm mỗi trang
        ## Tạo mảng chứa dữ liệu
        $data = array();

        if ($type === "2"):

            $trim_keyword = str_replace("%20", " ", $keyword);

            ## Tìm con của danh mục ID_cat
            $get_cat_childs = $this->M_Danhmuc->get_categories_childs($id);

            ## Kiểm tra ID_cat có mục con không
            if (count($get_cat_childs) > 0):
                $arr_child_id = $this->findChild($get_cat_childs);

                ## Đếm sản phẩm tìm kiếm được
                $total_products = $this->M_Danhmuc->count_all_search_products_by_id($trim_keyword, $arr_child_id);
                if ($total_products == 0):
                    $data = array(
                        'respone' => "Không có sản phẩm tìm thấy!",
                        'total_products' => $total_products,
                        'type' => $type
                    );

                else:
                    ## Tổng số trang
                    $total_page = ceil($total_products / $per_page);

                    ## Tìm LIMIT và OFSET
                    $offset = ($curent_page * $per_page) - $per_page;
                    if ($curent_page <= 0):
                        $offset = 0;
                    elseif ($curent_page > $total_page):
                        $offset = ($total_page * $per_page) - $per_page;
                    endif;

                    ## Lấy sản phẩm
                    $products = $this->M_Danhmuc->get_products_search_by_cats($trim_keyword, implode(",", $arr_child_id), $offset, $per_page);
                    $data = array(
                        'respone' => $this->foreach_products($products),
                        'total_products' => $total_products,
                        'type' => $type
                    );
                endif;
            endif;

            echo json_encode($data);

        endif;
    }

    public function findChild($get_cat_childs) {

        $arr_child_id = array();

        ## Duyệt lấy id con
        foreach ($get_cat_childs as $child):
            $childs_of_child = $this->M_Danhmuc->get_categories_childs($child->cat_id);

            ## Kiểm tra có cháu không
            if (count($childs_of_child) > 0):
                foreach ($childs_of_child as $sub_child):
                    array_push($arr_child_id, $sub_child->cat_id);
                endforeach;
            endif;
            array_push($arr_child_id, $child->cat_id);
        endforeach;

        return $arr_child_id;
    }

    function foreach_products($products) {

        $result = "";

        foreach ($products as $product):

            $result .= '<div class="line-product col-xs-6 col-xxs-12 item col-sm-4 col-xs-12 col-lg-4">';
            $result .= '<div class="border-product">';
            $result .= '<div class="col-xs-12 thumbnail view view-first">';
            $result .= '<div class="col-xs-12 box-product-image">';
            $result .= '<img class="group list-group-image img-responsive" src=" ' . base_url() . 'uploads/files/thumb/' . $product['pi_name'] . '" alt="" />';

            $result .= '</div>';
            $result .= '<div class="mask">';
            $result .= '<p></p>';
            $result .= '<a href="' . base_url() . 'sanpham/' . $product['slug'] . '" class="info btn-info btn">Chi tiết</a>';
            $result .= '<div class="product-rating" data-score="4">';
            $result .= '<i class="fa fa-star star-voted" aria-hidden="true"></i>';
            $result .= '<i class="fa fa-star star-voted" aria-hidden="true"></i>';
            $result .= '<i class="fa fa-star star-voted" aria-hidden="true"></i>';
            $result .= '<i class="fa fa-star star-voted" aria-hidden="true"></i>';
            $result .= '<i class="fa fa-star star-unvoted" aria-hidden="true"></i>';
            $result .= '</div>';
            $result .= '</div>';
            if ($product['discount'] > 0):
                $result .= '<span class="btn btn-xs btn-warning btn-product-discount">-10% <i class="fa fa-tag" aria-hidden="true"></i></span>';
            endif;
            $result .= '</div>';
            $result .= '<div id="form-add-to-cart" class="caption">';
            $result .= '<h4 class="group inner list-group-item-heading product-name">';
            $result .= '<a title="' . $product['name'] . '" href="' . base_url() . 'sanpham/' . $product['slug'] . '" data-id="' . $product['p_id'] . '">' . $product['name'] . '</a>';
            $result .= '</h4>';
            $result .= '<div class="row">';
            $result .= '<div class="col-xs-12">';
            $result .= '<div class="product-price">';

            if ($product['discount'] > 0):
                $price = $product['price'];
                $discount_val = $product['discount_val'];
                $remain = $price - (($price * $discount_val) / 100);

                $result .= '<span class="product-discont">';
                $result .= '<i class="fa fa-angle-down" aria-hidden="true"></i>';
                $result .= number_format($product['price']);
                $result .= '</span>';
                $result .= '&nbsp; &nbsp; ';
                $result .= '<span>';
                $result .= '<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> ';
                $result .= number_format($remain);
                $result .= '₫</span>';
            else:
                $result .= number_format($product['price']) . "₫";
            endif;
            $result .= '</div>';
            $result .= '<p class="poster">';
            $result .= '<span class="hidden">';
            $result .= '<i class="fa fa-clock-o" aria-hidden="true"></i> ';
            $result .= '<script>moment_time("' . $product['create_date'] . '");</script> | ';
            $result .= '</span>';

            $result .= 'Người bán: ';
            $result .= '<a href="' . base_url() . "gianhang/" . $product['u_username'] . '">' . $product['u_fullname'] . '</a>';
            $result .= '</p>';
            $result .= '</div>';
            $result .= '<div class="col-xs-12">';
            $result .= '<button class="btn btn-success add-to-cart"><i id="icon-cart" class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ</button>';
            $result .= '<button class="btn btn-warning">';
            $result .= '<i class="fa fa-heart" aria-hidden="true"></i>';
            $result .= '</button>';
            $result .= '</div>';
            $result .= '</div>';
            $result .= '</div>';
            $result .= '<div class="product-time">';
            $result .= '<i class="fa fa-clock-o" aria-hidden="true"></i> ';
            $result .= '<script>moment_time("' . $product['create_date'] . '");</script>';
            $result .= '</div>';
            $result .= '</div>';

            $result .= '</div>';

        endforeach;

        return $result;
    }

    ## Bộ lọc sản phâm

    public function filter_products($keyword, $page, $id, $highTolow, $price, $time) {
        ## Số sản phẩm mỗi trang
        $per_page = 1;

        ## Tạo mảng chứa dữ liệu
        $data = array();

        ## Sắp xếp giá

        if ($highTolow === "0"):
            $sql_hight_low = "";
        else:
            $sql_hight_low = "ORDER BY products.price " . $highTolow;
        endif;

        ## Sắp xếp thời gian
        if ($time === "3"):
            $sql_time = "";
        else:
            $sql_time = "AND products.status = " . $time;
        endif;


        ## Lấy khoảng giá
        $sql_price = "";
        $arrangePrice = explode("-", $price);
        $fromPrice = $arrangePrice[0];
        $toPrice = $arrangePrice[1];
        if ($toPrice === "x"):
            $sql_price = " products.price > " . $fromPrice;
        else:
            $sql_price = " products.price BETWEEN " . $fromPrice . " AND " . $toPrice;
        endif;

        ## SQL Lấy 1 hình sản phẩm
        $sql_image = "(
                        SELECT product_images.name
                        FROM product_images
                        WHERE product_images.p_id = products.p_id
                        LIMIT 1
                    ) as pi_name";

        ## SQL nếu có từ khóa tìm kiếm sản phẩm   
        $sql_keyword = "";
        if ($keyword !== "_null_"):
            ## Trim Keyword
            $trim_keyword = str_replace("%20", " ", $keyword);
            $sql_keyword = "AND products.name LIKE '%$trim_keyword%' ";
        endif;

        ## Tìm con của danh mục ID_cat
        $get_cat_childs = $this->M_Danhmuc->get_categories_childs($id);

        ## Gán ID hiện tại vào $list_childs
        $list_childs = array();

        ## Kiểm tra ID_cat có mục con không
        if (count($get_cat_childs) > 0):
            ## Lấy danh mục con
            $arr_child_id = $this->findChild($get_cat_childs);

            ## Array To String 
            $list_childs = implode(",", $arr_child_id);
        else:
            $list_childs = $id;
        endif;

        ## Đếm tổng sản phẩm tìm thấy
        $query_total = "SELECT count(p_id) as total
                        FROM products 
                        WHERE products.p_cat IN ($list_childs) AND
                        products.is_active = 1
                        $sql_keyword
                        AND $sql_price
                        $sql_time";
        $result_total = $this->M_Danhmuc->count_filter_products($query_total);
        $total_products = $result_total->total;

        if ($total_products == 0):
            $data = array(
                'respone' => 'Không có sản phẩm tìm thấy!',
                'total_products' => $total_products
            );
        else:

            ### Tổng số trang
            $total_page = ceil($total_products / $per_page);

            ## Tìm LIMIT và OFSET
            $offset = ($page * $per_page) - $per_page;
            if ($page <= 0):
                $offset = 0;
            elseif ($page > $total_page):
                $offset = ($total_page * $per_page) - $per_page;
            endif;

            ## Hoàn chỉnh câu SQL
            $sql = "SELECT products.*, $sql_image, ta_users.u_fullname, ta_users.u_username
                        FROM products 
                        JOIN ta_users ON ta_users.u_id = products.poster
                        WHERE products.p_cat IN ($list_childs) AND
                        products.is_active = 1
                        $sql_time
                        $sql_keyword
                        AND $sql_price
                        $sql_hight_low
                        LIMIT $offset, $per_page";
            $products = $this->M_Danhmuc->get_by_filter($sql);
            $data = array(
                'respone' => $this->foreach_products($products),
                'total_products' => $total_products,
            );
        endif;

        echo json_encode($data);
    }

}
