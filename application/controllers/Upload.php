<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_upload');
        $this->load->helper('url');
    }

    function index() {

        $this->load->view('view_upload');
    }

    function process() {
        ## Get number image uploaded
        $cur_count_file = $this->session->userdata('count_num_file');

        ## Kiểm tra hình đã có sự kiện upload chưa?
        if (($_FILES['userFiles']['name']) != "") {
            $error = '';
            $img = '';

            ## Kiểm tra số lượng hình hiện tại đã upload là bao nhiêu
            if (($cur_count_file) == NULL) {
                $ses_count_upload = 0;
            } else {
                $ses_count_upload = $cur_count_file;
            }

            ## Đếm số lượng hình đang tải lên.
            $filesCount = count($_FILES['userFiles']['name']);

            ## Nếu số lượng lớn hơn 6 thì out!
            if ($cur_count_file > 5 || $filesCount > 6) {
                $error = 'Bạn chỉ có thể upload tối đa 6 hình!';
            } else {

                ## Vòng lặp upload hình
                for ($i = 0; $i < $filesCount; $i++) {
                    // Get Info File Name
                    $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                    $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                    $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                    $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                    $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

                    // Config Upload
                    $uploadPath = 'uploads/files/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = '8000';

                    // Do Upload
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    // Check Do Upload
                    if ($this->upload->do_upload('userFile')) {
                        $ses_count_upload+=1;
                        $fileData = $this->upload->data();

                        // Set Upload times Session
                        $upload_file_name = $this->session->userdata('upload_file_name');
                        $upload_file_name[$ses_count_upload] = $fileData['file_name'];
                        $this->session->set_userdata('upload_file_name', $upload_file_name);

                        // Config Upload Thumbs
                        $source_path = 'uploads/files/' . $fileData['file_name'];
                        $target_path = 'uploads/files/thumb/';
                        $config_manip = array(
                            'image_library' => 'gd2',
                            'source_image' => $source_path,
                            'new_image' => $target_path,
                            'maintain_ratio' => TRUE,
                            'create_thumb' => TRUE,
                            'thumb_marker' => '',
                            'width' => 150,
                            'height' => 150
                        );

                        // Do Resize
                        $this->load->library('image_lib', $config_manip);
                        $this->image_lib->initialize($config_manip);
                        $this->image_lib->resize();

                        ## Lấy tên hình thumb
                        $thumbnail = $fileData['raw_name'] . '' . $fileData['file_ext'];

                        ## HTML gắn hình thumb vừa upload và trả về $img
                        $img .= '<div class="col-sm-4 preview-upload-img"><div class="col-sm-12 col-xs-12 thumbnail">';
                        $img .= '<img src="' . base_url() . $target_path .  $thumbnail . ' " class="img-responsive"/></div>';
                        $img .= '<div class="row"><div class="col-sm-12 col-xs-12 form-group image-info-update"><input type="text" class="form-control alt-img" placeholder="Tiêu đề ảnh"><input type="text" class="form-control title-img" placeholder="Nội dung ảnh">';
                        $img .= '<a href="#" del_file_name="' . $fileData['file_name'] . '" class="btn btn-danger delete-upload-img">';
                        $img .= 'Xóa ảnh  <i class="fa fa-trash fa-1x" aria-hidden="true"></i> </a> ';
                        $img .= '<button type="button" class="btn btn-success update-info-img-btn"> Cập nhật <i class="fa fa-save fa-1x" aria-hidden="true"></i></button> </div></div>';
                        $img .= '</div>';

                        $uploadData[$i]['file_name'] = $fileData['file_name'];
                        
                        
                        
                    } else {

                        $error = $this->upload->display_errors();
                    }

                    $this->session->set_userdata('count_num_file', $ses_count_upload);
                }
            }

            echo (json_encode(array('error' => $error, 'img' => $img)));
        }
    }

    function removeC() {
        $cur_count_file = $this->session->userdata('upload_file_name');
        echo "<pre>";
        var_dump($cur_count_file);
        echo "</pre>";
    }

    function delete_image() {
        $file_name = $this->input->post('del_file_name');
        if ($file_name) {
            $location_file = "uploads/files/" . $file_name;
            $upload_file_name = $this->session->userdata('upload_file_name');
            $cur_count_file = $this->session->userdata('count_num_file');

            foreach ($upload_file_name as $i => $val):
                $ex_val = explode(",", $val);
                if ($file_name === $ex_val[0]):
                    if (unlink($location_file)) {
                        $thumb = explode(".", $file_name);
                        $location_thumb = "uploads/files/thumb/" . $thumb[0] . "_thumb." . $thumb[1];
                        unlink($location_thumb);
                        unset($upload_file_name[$i]);
                        $foo2 = array_values($upload_file_name);
                        $this->session->set_userdata('upload_file_name', $foo2);
                        $this->session->set_userdata('count_num_file', $cur_count_file - 1);

                        echo "0";
                    } else {
                        echo $val;
                    }

                endif;

            endforeach;
        }
    }

    function add_info_img() {
        $name = $this->input->post('name');
        $alt1 = str_replace( ",", " ", $this->input->post('alt') );
        $alt = str_replace( ".", " ", $alt1 );
        
        $title1 = str_replace(",", " ", $this->input->post('title') );
        $title = str_replace(".", " ", $title1 );
        
        
        if (($alt != "") || ($title != "")):

            $cur_count_file = $this->session->userdata('upload_file_name');

            $xx = $name . "," . $alt . "," . $title;

            for ($i = 1; $i <= count($cur_count_file); $i++):
                $ex_cur_f = explode(",", $cur_count_file[$i]);
                if ($ex_cur_f[0] === $name):
                    $replacements2 = array($i => $xx);
                    $basket = array_replace($cur_count_file, $replacements2);
                    $this->session->set_userdata('upload_file_name', $basket);
                    echo "Thành công!";
                endif;
            endfor;
        endif;
    }

}
