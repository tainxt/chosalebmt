<link href="<?php echo base_url(); ?>components/default/css/bootstrap-xxs.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>components/default/css/categories.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>components/default/script/categories.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>components/default/script/paging-categories.js" type="text/javascript"></script>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div id="content-products" class="box" data-total="<?php echo $total_products; ?>">
                <div class="box-header">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
                        <li class="active">Tên danh mục</li> 
                    </ol>

                    <div class="panel panel-primary box-filter">
                        <div class="panel-heading">
                            <h3 class="panel-title">Bộ lọc sản phẩm</h3>
                            <span class="col-xs-3 text-right pull-right clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-down"></i></span>
                        </div>
                        <div class="panel-body row">
                            <div class="col-sm-12">
                                <div class="row"> 
                                    <div class=" col-sm-6 col-xs-12">
                                        <input id="txt-search-category" class="form-control" placeholder="Tên sản phẩm"> 
                                    </div>

                                    <div class="col-sm-6 col-xs-12">
                                        <button id="btn-search" class="btn btn-primary" type="button">
                                            Tìm kiếm
                                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                                        </button>  
                                        <button class="btn btn-success show-advanced-btn" type="button">
                                            Nâng cao
                                            <i class="fa fa-expand" aria-hidden="true"></i>
                                        </button> 

                                    </div>
                                    <div class="col-xs-12 advanced-btns">
                                        <div class="dropdown btn box-hight-low">
                                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <span>Sắp xếp theo giá</span>
                                                <i class="caret"></i>
                                            </button>
                                            <ul class="dropdown-menu list-hight-low">
                                                <li>
                                                    <a href="#" data-hight-low="asc">Từ thấp đến cao</a>
                                                </li>
                                                <li>
                                                    <a href="#" data-hight-low="desc">Từ cao xuống thấp</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dropdown btn box-range">
                                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <span>Khoảng giá</span>
                                                <i class="caret"></i>
                                            </button>
                                            <ul class="dropdown-menu list-range">
                                                <li><a href="#" data-range="0-x">Tất cả giá</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li>
                                                    <a href="#" data-range="0-200000">
                                                        0 - 200k
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-range="200000-1000000">
                                                        200k - 1m
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-range="1000000-5000000">
                                                        1m - 5m
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-range="5000000-x">
                                                        5m+
                                                    </a>
                                                </li>


                                            </ul>
                                        </div>
                                        <div class="dropdown btn box-time">
                                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <span>Tình trạng sản phẩm</span>
                                                <i class="caret"></i>
                                            </button>
                                            <ul class="dropdown-menu list-time">
                                                <li><a href="#" data-time="3">Tất cả sản phẩm</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li>
                                                    <a href="#" data-time="0">Mới 100%</a>
                                                </li>
                                                <li>
                                                    <a href="#" data-time="1">Sản phẩm cũ</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <button class="hidden reset-filter btn btn-danger">Bỏ lọc sản phẩm</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="box-body">
                        <div class="col-md-3 col-sm-12 col-product-ads">
                            <div class="row list-group no-margin-left-sm product-ads">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <label>Sản phẩm được tài trợ</label>
                                        <i class="fa fa-refresh refresh-button pull-right" aria-hidden="true"></i>
                                    </div>
                                    <div class="panel-body row">
                                        <?php for ($u = 0; $u < 1; $u++): ?>
                                            <div class="line-product col-md-12 col-sm-4 col-xs-6">
                                                <div class="border-product">
                                                    <div class="thumbnail">
                                                        <img class="group list-group-image img-responsive" src="" alt="" />
                                                    </div>
                                                    <div class="caption">
                                                        <h4 class="group inner list-group-item-heading product-name">
                                                            <a href="">Tên sản phẩm</a>
                                                        </h4>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <p class="product-price">10,000,000 đ</p>
                                                                <p class="poster">
                                                                    <span class="hidden">
                                                                        <i class="fa fa-clock-o" aria-hidden="true"></i> 
                                                                        1 giờ trước | 
                                                                    </span>

                                                                    Người bán: 
                                                                    <a href="#">Nguyễn Ngọc Hải</a>
                                                                </p>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <button class="btn btn-success">Thêm vào giỏ</button>
                                                                <button class="btn btn-danger">
                                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-time">
                                                        <i class="fa fa-clock-o" aria-hidden="true"></i> 1 giờ trước
                                                    </div>

                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="theAlertModal" class="alert-modal"></div>
                        <button id="btnSuccess" class="hidden"></button>
                        <div class="col-md-9 col-sm-12">
                            <div class="row list-group">
                                <div id="wrap-products" class="panel panel-info">
                                    <div class="panel-heading">
                                        <label>Danh sách sản phẩm</label>
                                        <span class="collapse-product collapse-list pull-right">
                                            <i class="fa fa-2x fa-list" aria-hidden="true"></i>
                                        </span>
                                        <span class="collapse-product collapse-box pull-right">
                                            <i class="fa fa-2x fa-th-large" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="panel-body row panel-box-product">
                                        <?php
                                        foreach ($products as $product):
                                            ?>
                                            <div class="line-product col-xs-6 col-xxs-12 item col-sm-4 col-xs-12 col-lg-4">
                                                <div class="border-product">
                                                    <div class="col-xs-12 thumbnail view view-first">
                                                        <div class="col-xs-12 box-product-image">
                                                            <img class="group list-group-image img-responsive" 
                                                                 src="<?php echo base_url() . "uploads/files/thumb/" . $product['pi_name']; ?>" alt="" />
                                                        </div>
                                                        <div class="mask">
                                                            <p></p>
                                                            <a href="<?php echo base_url() . "sanpham/" . $product['slug']; ?>" class="info btn-info btn">Chi tiết</a>
                                                            <div class="product-rating" data-score="4">
                                                                <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                                                <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                                                <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                                                <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                                                <i class="fa fa-star star-unvoted" aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                        <?php if ($product['discount'] > 0): ?>
                                                            <span class="btn btn-xs btn-warning btn-product-discount">-10% <i class="fa fa-tag" aria-hidden="true"></i></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div id="form-add-to-cart" class="caption">
                                                        <h4 class="group inner list-group-item-heading product-name">
                                                            <a href="<?php echo base_url()."sanpham/".$product['slug']; ?>" data-id="<?php echo $product['p_id']; ?>" title="<?php echo $product['name']; ?>">
                                                                <?php echo $product['name']; ?>
                                                            </a>
                                                        </h4>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="product-price">
                                                                    <?php
                                                                    if ($product['discount'] > 0):
                                                                        $price = $product['price'];
                                                                        $discount_val = $product['discount_val'];
                                                                        $remain = $price - (($price * $discount_val) / 100);
                                                                        ?>
                                                                        <span class="product-discont">
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                            <?php echo number_format($product['price']); ?>
                                                                        </span>
                                                                        &nbsp; &nbsp; 
                                                                        <span>
                                                                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 
                                                                            <?php echo number_format($remain); ?>₫
                                                                        </span>
                                                                    <?php else: ?>
                                                                        <?php echo number_format($product['price']); ?>₫
                                                                    <?php endif; ?>
                                                                </div>
                                                                <p class="poster">
                                                                    <span class="hidden">
                                                                        <i class="fa fa-clock-o" aria-hidden="true"></i> 
                                                                        <script>moment_time("<?php echo $product['create_date']; ?>");</script> | 
                                                                    </span>

                                                                    Người bán: 
                                                                    <a href="<?php echo base_url()."gianhang/".$product['u_username']; ?>"><?php echo $product['u_fullname']; ?></a>
                                                                </p>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <button class="btn btn-success add-to-cart">
                                                                    <i id="icon-cart" class="fa fa-cart-plus" aria-hidden="true"></i>
                                                                    Thêm vào giỏ
                                                                </button>
                                                                <button class="btn btn-warning">
                                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-time">
                                                        <i class="fa fa-clock-o" aria-hidden="true"></i> 
                                                        <script>moment_time("<?php echo $product['create_date']; ?>");</script>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <span id="return-total-products" class="hidden"></span>
                                    <ul id="default-paging" class="pagination categories-paging" paging-type="1" paging-cat="<?php echo $id_cat; ?>">
                                        <?php
                                        ## Tổng số trang
                                        $total_page = ceil($total_products / $per_page);
                                        ?>
                                        <li>
                                            <a class="first-page btn-primary" href="#" data-page="1">
                                                Trang đầu
                                            </a>
                                        </li>
                                        <li>
                                            <a class="preview-page" href="#">
                                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                                                Trang trước
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a href="#">
                                                <span class="curent-page">1</span>/
                                                <span class="total-page"><?php echo $total_page; ?></span>

                                            </a>
                                        </li>
                                        <li>
                                            <a class="next-page" href="#">
                                                Trang sau
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="last-page" href="#" data-page="<?php echo $total_page; ?>">
                                                Trang cuối
                                            </a>
                                        </li>
                                    </ul>
                                    <!--
                                    <ul class="pagination">
                                        <div class="quick-jump">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Đi đến trang...
                                                    <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <div class="form-group col-xs-12">
                                                            <input type="text" placeholder="Nhập trang muốn đến" class="form-control" />
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-group col-xs-12">
                                                            <button class="btn btn-sm btn-success btn-jump">Đi!</button>
                                                        </div>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </ul>
                                    -->
                                    <div class="loading-product-img hidden">
                                        <img src="<?php echo base_url() . "public/images/loading.gif" ?>" class="img-responsive" />
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="box-footer">

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
