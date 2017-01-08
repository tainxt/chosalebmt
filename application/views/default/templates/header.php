<!doctype html>
<html>
    <head>
        <title>Chợ Sale BMT - Chợ rao vặt, mua bán uy tín - giá rẻ tại DakLak</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>favicon.ico"/>
        <link href="<?php echo base_url() ?>components/default/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>components/default/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>components/default/css/easy-sidebar.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>components/default/css/styles.css" type="text/css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <script src="<?php echo base_url() ?>components/default/js/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>components/default/js/moment-with-locales.js"></script>
        <script src="<?php echo base_url() ?>components/default/js/bootstrap-confirm.js"></script>
        <script src="<?php echo base_url() ?>components/default/script/default.js"></script>
        
        <script>
            var base_url = "<?php echo base_url(); ?>";
            function moment_time(p_time) {
                moment.locale('vi');
                var time = moment(p_time, "YYYY-MM-DD HH:mm:ss").fromNow();
                return time;
            }

            function moment_date(p_time) {
                moment.locale('vi');
                var time = moment(p_time, "YYYY-MM-DD HH:mm:ss").fromNow();
                document.write(time);
            }

        </script>
        <script src="<?php echo base_url() ?>components/default/js/menu.js"></script>
        <script src="<?php echo base_url() ?>components/default/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>components/default/js/jquery.touchSwipe.min.js"></script>
        <script src="<?php echo base_url() ?>components/default/js/jquery.detect_swipe.js"></script>
        
        <script src="<?php echo base_url() ?>js/add-to-cart.js"></script>
    </head>
    <body>

        <?php
        $cur_id = $this->session->userdata('uid');
        if ($cur_id):
            ## Kiểm tra có chi tiết liên hệ chưa?
            $detail_user = $this->S_Default->check_detail_user($cur_id);
            if ($detail_user->ud_phone == "" || $detail_user->ud_address == ""):
                $this->load->view('default/modules/auth/modal_update_info');
            endif;
        endif;
        ?>

        <nav id="mobile-menu-scroll" class="navbar navbar-inverse easy-sidebar">
            <div class="container-fluid"> 
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle easy-sidebar-toggle" aria-expanded="false"> 
                        <span class="sr-only">Toggle navigation</span> 
                        <span class="icon-bar"></span> 
                        <span class="icon-bar"></span> 
                        <span class="icon-bar"></span> 
                    </button>
                    <a class="navbar-brand" href="#">Brand</a> 
                </div>

                <div id="mobile-menu-scroll" class="dropdown">
                    <ul id="csm-menu-mobile" class="nav navbar-nav dropdown"></ul> 
                </div>

            </div>
            <!-- /.container-fluid --> 
        </nav>
        <div id="wrapper">

            <div class="container-fluid header-line">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 xs-no-padding">
                            <?php //echo $this->session->userdata('username');  ?>
                            <?php
                            $ses_uid = $this->session->userdata('uid');
                            if ($ses_uid):
                                ?>
                                <div class="menu-header-line">
                                    <a href="#"> <i class="fa fa-support" aria-hidden="true"></i> Hotline: 01634669294</a>
                                    <a href="#"> <i class="fa fa-newspaper-o" aria-hidden="true"></i> Tin tức</a>
                                    <a href="#" data-toggle="modal" data-target="#choose_cat" > <i class="fa fa-upload" aria-hidden="true"></i> Đăng tin</a>
                                </div>    

                                <div class="dropdown pull-right">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">
                                        Xin chào <?php echo $this->session->userdata('username'); ?>
                                        <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url() . "gianhang/" . $this->session->userdata('username'); ?>">
                                                Vào gian hàng
                                            </a>
                                        </li>
                                        <li><a href="#">Thông báo</a></li>
                                        <li><a href="#">Tin nhắn</a></li>
                                        <li><a href="<?php echo base_url() ?>Home/logout" class="logout-btn">Đăng xuất</a></li>
                                    </ul>
                                </div>
                                <?php
                            else:
                                ?>

                                <button class="btn btn-success pull-right login-btn btn-sm" data-toggle="modal" data-target="#loginModal">
                                    <i class="fa fa-key" aria-hidden="true"></i> Tài khoản</button>
                            <?php
                            endif;
                            ?>
                        </div>

                    </div>
                </div>
            </div>


            <div class="container">
                <div class="row banner-line">
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="hidden-lg visible-xs col-xs-3 no-padding easy-sidebar-toggle">
                            <i class="fa fa-bars fa-2x icon-color-green" aria-hidden="true"></i>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-6">
                            <a href="<?php echo base_url(); ?>">
                                <img src="<?php echo base_url() ?>components/default/images/logo.png" class="img-responsive" />
                            </a>
                        </div>
                        <div class="hidden-lg visible-xs col-xs-3 no-padding">
                            <i class="fa fa-shopping-cart fa-2x pull-right icon-color-green" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <form role="form">
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="search" placeholder="Nhập từ khóa tìm kiếm..." required/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-success" type="submit">
                                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                            <span class="hidden-xs">Tìm kiếm</span>
                                        </button>
                                    </span>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3 col-sm-2 hidden-xs">
                        <button class="btn btn-info  pull-right" data-toggle="modal" data-target="#my-cart-modal">
                            <span class="glyphicon glyphicon-shopping-cart my-cart-icon"><span class="hidden-sm"> Giỏ hàng </span>(4)</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="container-fluid main-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <button class="btn btn-success btn-show-all-cat hidden hidden-xs">Toàn bộ danh mục <i class="fa fa-angle-double-down" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-8 box-main-slider"></div>
                </div>
            </div>
            <div class="container box-collapse-menu">
                <div class="row">
