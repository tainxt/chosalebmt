<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Giohang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_Giohang');
        $this->load->library('cart');
    }

    public function index() {
        //Show thong tin chi tiet gio hang
        $id = 8;
        $findID = $this->M_Giohang->findID($id);
        $p_qty = $findID->qty;

        $data = $this->cart->contents();
        $arr = array();

        foreach ($data as $key => $item) {
            $arr[$item['options']['shop_id']][$key] = $item;
        }

        ksort($arr, SORT_NUMERIC);

        foreach ($arr as $k => $val):
            if (count($val) > 1):
                foreach ($val as $sub):
                    echo "<pre>";
                    print_r($sub);
                    echo "</pre>";
                    if ($sub['id'] == $id && $sub['qty'] > $p_qty):
                        echo "<h1>Quá số lượng</h1>";
                    endif;
                endforeach;
                echo $k;
            else:
                foreach ($val as $sub):
                    echo "<pre>";
                    print_r($sub);
                    echo "</pre>";
                    if ($sub['id'] == $id && $sub['qty'] > $p_qty):
                        echo "<h1>Quá số lượng</h1>";
                    endif;
                endforeach;
                echo $k;
            endif;
        endforeach;
    }

    public function removeCart() {
        $this->cart->destroy();
    }

    public function addTocart() {
        $respone = array();

        ## Lấy id và số lượng của sản phẩm
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');

        ## Kiểm tra có id này không?
        $findID = $this->M_Giohang->findID($id);
        if (count($findID) > 0):
            $name = $this->removeSpecial($findID->name);
            $remain = $findID->price - ( ($findID->price * $findID->discount_val) / 100 );
            $amount = $remain * $qty;
            ## Lấy kết quả trả về bỏ vào mảng
            $data_cart = array(
                'id' => $id,
                'qty' => $qty,
                'price' => $findID->price,
                'name' => $name,
                'options' => array(
                    'discount' => $findID->discount_val,
                    'remain' => $remain,
                    'amount' => $amount,
                    'shop_id' => $findID->poster,
                ),
            );

            $out_of_qty = $this->check_qty($id, $qty);
            if ($out_of_qty === "1"):
                $respone = array(
                    'status' => "Số lượng sản phẩm vượt quá mức cho phép trên " . $findID->qty
                );
            else:
                if ($this->cart->insert($data_cart)):
                    $respone = array(
                        'status' => "true",
                        'data' => $data_cart
                    );
                else:
                    $respone = array(
                        'status' => "false"
                    );
                endif;
            endif;


        else:
            $respone = array(
                'status' => "Sản phẩm không tồn tại hoặc đã hết hàng"
            );
        endif;

        echo json_encode($respone);
    }

    function test() {
        $id = 4;
        $input = 1;
        $return = $this->check_qty($id, $input);
        echo $return;
    }

    ## Kiểm tra số lượng

    function check_qty($id, $input_qty) {

        $out_of_qty = 0;

        $findID = $this->M_Giohang->findID($id);
        $p_qty = $findID->qty;

        $data = $this->cart->contents();

        foreach ($data as $sub) {
            if ($sub['id'] == $id && $sub['qty'] > $p_qty || $input_qty > $p_qty):
                $out_of_qty = "1";
            endif;
        }

        return $out_of_qty;
    }

    function reload_cart() {
        $this->load->view('default/modules/cart/modal_cart');
    }
    
    function removeSpecial($string){
        ## Remove ""
        $double = str_replace('"', "", $string);
        $quote = str_replace("'", "", $double);
        $percent = str_replace("%", "", $quote);
        $comam = str_replace(",", "", $percent);
        $dot = str_replace(".", "", $comam);
        $newStr = $dot;
        
        return $newStr;
    }

}
