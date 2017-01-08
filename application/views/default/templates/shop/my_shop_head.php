<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $shop_info->name; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="<?php echo $shop_info->keyword; ?>"/>
        <meta itemprop="description" name="description" content="<?php echo $shop_info->description; ?>"/>
        <!-- CSS -->
        <link href="<?php echo base_url(); ?>components/default/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>components/default/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>components/default/css/styles.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>components/default/css/shop.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>components/default/css/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>components/default/css/owl.theme.css" rel="stylesheet" type="text/css"/>

        <!-- JS -->
        <script src="<?php echo base_url(); ?>components/default/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>components/default/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>components/default/js/owl.carousel.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>components/default/js/my-shop.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>components/default/js/moment-with-locales.js" type="text/javascript"></script>
        <script>
            var base_url = "<?php echo base_url(); ?>";
            function moment_time(p_time) {
                moment.locale('vi');
                var time = moment(p_time, "YYYY-MM-DD H:i:s").fromNow();
                document.write(time);
            }

            function imgError(image) {
                image.onerror = "";
                image.src = base_url + "uploads/shop/noavatar.png";
                return true;
            }

        </script>
    </head>
    <body>
        <div id="wrapper">
            <div class="container-fluid header-line">
                <div class="container">
                    <div class="row">
                        <div class="navbar-header"> 
                            <button aria-controls="bs-navbar" aria-expanded="false" class="collapsed navbar-toggle" data-target="#bs-navbar" data-toggle="collapse" type="button"> 
                                <span class="sr-only">Toggle navigation</span> 
                                <span class="icon-bar"></span> 
                                <span class="icon-bar"></span> 
                                <span class="icon-bar"></span> 
                            </button> 
                        </div>
                        <nav class="collapse navbar-collapse" id="bs-navbar"> 
                            <ul class="nav navbar-nav"> 
                                <li>
                                    <a href="<?php echo base_url(); ?>"><b>Chosalebmt.com</b></a> 
                                </li>
                                <li>
                                    <a href="<?php echo base_url() . "gianhang/" . $shop_info->u_username; ?>">Trang chủ</a> 
                                </li>
                                <li>
                                    <a href="<?php echo base_url() . "gianhang/" . $shop_info->u_username . "/baiviet/gioithieu"; ?>">Giới thiệu</a> 
                                </li>
                                <li>
                                    <a href="">Đánh giá</a> 
                                </li>
                                <li>
                                    <a href="<?php echo base_url() . "gianhang/" . $shop_info->u_username . "/baiviet/chinhsach"; ?>">Chính sách</a> 
                                </li>
                                <li>
                                    <a href="<?php echo base_url() . "gianhang/" . $shop_info->u_username . "/baiviet/lienhe"; ?>">Liên hệ</a> 
                                </li>
                            </ul> 
                            <?php
                            $ses_id = $this->session->userdata('uid');
                            $shop_master_id = $shop_info->p_id;
                            if ($ses_id == $shop_master_id):
                                ?>
                                <ul class="nav navbar-nav navbar-right"> 
                                    <li role="presentation" class="dropdown"> 
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
                                            Quản trị
                                            <span class="caret"></span> 
                                        </a> 
                                        <ul class="dropdown-menu"> 
                                            <li><a href="<?php echo base_url() . "gianhang/" . $shop_info->u_username . "/donhang/danhsach"; ?>">Đơn hàng</a></li> 
                                            <li><a href="<?php echo base_url() . "gianhang/" . $shop_info->u_username . "/thongke"; ?>">Thống kê</a></li> 
                                            <li><a href="<?php echo base_url() . "gianhang/" . $shop_info->u_username . "/baiviet/danhsach"; ?>">Chỉnh sửa bài viết</a></li> 
                                            <li role="separator" class="divider"></li> 
                                            <li><a href="<?php echo base_url() . "gianhang/" . $shop_info->u_username . "/cauhinh"; ?>">Cấu hình gian hàng</a></li> 
                                        </ul> 
                                    </li>
                                </ul> 
                            <?php endif; ?>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-10 xs-no-padding">
                            <div id="shop-slider" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->

                                <div class="carousel-inner" role="listbox">
                                    <?php if (count($shop_banner) > 0): ?>
                                        <?php foreach ($shop_banner as $k => $img): ?>
                                            <div class="item <?php echo ($k == 1) ? "active" : "" ?>">
                                                <img src="<?php echo base_url() . "uploads/shop/" . $img->name; ?>" alt="<?php echo $img->alt; ?>" title="<?php echo $img->title; ?>" >
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="item active">
                                            <img src="<?php echo base_url(); ?>components/default/images/default-banner-shop.jpg" alt="<?php echo $shop_info->name; ?>" title="<?php echo $shop_info->description; ?>" >
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Left and right controls -->
                                <?php if (count($shop_banner) > 1): ?>
                                    <a class="left carousel-control" href="#shop-slider" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#shop-slider" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="my-avatar">
                                <?php if ($shop_info->u_image != ""): ?>
                                    <img src="<?php echo base_url() . "uploads/shop/" . $shop_info->u_image; ?>" class="img-responsive" alt="<?php echo $shop_info->name; ?>" onerror="imgError(this);"/>
                                <?php else: ?>
                                    <img src="<?php echo base_url(); ?>uploads/shop/noavatar.png" class="img-responsive" />
                                <?php endif; ?>
                            </div>
                            <div class="myshop-name">
                                <label><?php echo $shop_info->name; ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container box-products">
                <div class="row">
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="list-group">
                                    <li class="list-group-item active label-categories">Danh mục sản phẩm</li>
                                    <?php
                                    $shop_categories = $this->M_Shop->get_shop_product_cat_id($shop_master_id);

                                    if (count($shop_categories) > 0):
                                        ?>
                                        <div class="panel-group" id="accordion">
                                            <?php
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
                                                ?>
                                                <div class="panel panel-info">
                                                    <div class="" data-toggle="collapse" data-parent="#accordion" data-target="#collapse<?php echo $parent_name->cat_id; ?>">
                                                        <span class="accordion-toggle list-group-item">
                                                            <b><?php echo $parent_name->cat_name; ?></b>
                                                        </span>

                                                    </div>
                                                    <div id="collapse<?php echo $parent_name->cat_id; ?>" class="panel-collapse collapse">
                                                        <div class="">
                                                            <?php
                                                            $childs = $this->M_Shop->get_all_cat_child($result, $shop_master_id);
                                                            foreach ($childs as $child):
                                                                echo '<a href="' . base_url() . "gianhang/" . $shop_slug . "/danhmuc/" . $child->cat_slug . '" class="list-group-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i> ' . $child->cat_name . '</a>';

                                                            endforeach;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            endforeach;
                                            ?>

                                        </div>
                                    <?php else: ?>
                                        <li class="list-group-item">Chưa có danh mục</li>
                                    <?php endif; ?>

                                </div>

                                <ul class="list-group info-shop">
                                    <li class="list-group-item active label-categories">Thống kê gian hàng</li>
                                    <?php if ($shop_info->vip == 1): ?>
                                        <li class="list-group-item">
                                            <label class="protect-shop">Gian hàng đảm bảo <i class="fa fa-check" aria-hidden="true"></i></label>
                                        </li>
                                    <?php endif; ?>
                                    <li class="list-group-item"><label><?php echo $shop_info->name; ?></label></li>
                                    <li class="list-group-item">Chủ sở hữu: <label><?php echo $shop_info->u_fullname; ?></label></li>

                                    <li class="list-group-item">Tham gia: <label><?php echo date('d/m/Y', strtotime($shop_info->u_createdate)); ?></label></li>
                                    <li class="list-group-item">Lượt xem: <label><?php echo $shop_info->views; ?></label></li>
                                </ul>

                            </div>